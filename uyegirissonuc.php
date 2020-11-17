<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';


if(isset($_POST["mail"])){
	$gelenmail=Guvenlik($_POST["mail"]);	
}else{
	$gelenmail="";
}
if(isset($_POST["sifre"])){
	$gelensifre=Guvenlik($_POST["sifre"]);	
}else{
	$gelensifre="";
}

$md5liSifre=md5($gelensifre);

if(($gelenmail!="") and ($gelensifre!="")){
	$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ? AND sifre=? LIMIT 1");
	$kontrolSorgusu->execute([$gelenmail,$md5liSifre]);
	$sayisi=$kontrolSorgusu->rowCount();
	$kullanicikaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
	if ($sayisi>0) {
		if($kullanicikaydi["durumu"]==1){
			$_SESSION["kullanici"]=$gelenmail;
			if ($_SESSION["kullanici"]==$gelenmail){
				header("Location:index.php?SK=50");
				exit();
			}
			else{
				header("Location:index.php?SK=33");
				exit();
			}
		}else{
			$mesajicerigihazirla= "Merhaba " . $kullanicikaydi["adsoyad"] .
			"<br/>Üyeliğini tamamlamak için lütfen <a href='" .$sitelinki.
			"/aktivasyon.php?aktivasyonKodu=".$kullanicikaydi["aktivasyonKodu"] .
			"&mail=".$gelenmail ."'>BURAYA TIKLAYINIZ</a> . <br/><br/> ".$siteadi;
			$mailGonder = new PHPMailer(true);
			try {
				$mailGonder->SMTPDebug = 0;                    
				$mailGonder->isSMTP();                         
				$mailGonder->Host       = DonusumleriGeriDondur($siteemailHostAdresi);
				$mailGonder->SMTPAuth   = true;
				$mailGonder->CharSet 	="UTF-8";
				$mailGonder->Username   = DonusumleriGeriDondur($siteemail);
				$mailGonder->Password   = DonusumleriGeriDondur($sitesifre);
				$mailGonder->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mailGonder->Port       = 587;
				$mailGonder->SMTPOptions = array(
					'ssl' => [
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true,
					],
				);
				$mailGonder->setFrom(DonusumleriGeriDondur($siteemail), DonusumleriGeriDondur($siteadi));
				$mailGonder->addAddress(DonusumleriGeriDondur($gelenmail), DonusumleriGeriDondur($kullanicikaydi["adsoyad"]));
				$mailGonder->addReplyTo($siteemail,$siteadi);
				$mailGonder->isHTML(true);
				$mailGonder->Subject =  DonusumleriGeriDondur($siteadi).' Üyelik aktivasyonu';
				$mailGonder->MsgHTML($mesajicerigihazirla);
				$mailGonder->send();

				header("Location:index.php?SK=36");
				exit();
			}
			catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
				header("Location:index.php?SK=33");
				exit();
			}
		}
	}else{
		header("Location:index.php?SK=34");
		exit();
	}
}else{
	header("Location:index.php?SK=35");
	exit();
}
?>
