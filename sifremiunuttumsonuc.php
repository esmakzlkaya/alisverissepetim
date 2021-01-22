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
if(isset($_POST["tel"])){
	$gelentelno=Guvenlik($_POST["tel"]);	
}else{
	$gelentelno="";
}
if(($gelenmail!="") or ($gelentelno!="")){
	$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ? OR telno=? AND silinmedurumu=?LIMIT 1");
	$kontrolSorgusu->execute([$gelenmail,$gelentelno,0]);
	$sayisi=$kontrolSorgusu->rowCount();
	$kullanicikaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
	if ($sayisi>0) {
		$mesajicerigihazirla= "Merhaba " . $kullanicikaydi["adsoyad"] .
		"<br/>Şifre sıfırlama işlemini gerçekleştirmek için lütfen <a href='" .$sitelinki.
		"/index.php?SK=43&aktivasyonKodu=".$kullanicikaydi["aktivasyonKodu"] .
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
			$mailGonder->Subject =  DonusumleriGeriDondur($siteadi).' Şifre Sıfırlama';
			$mailGonder->MsgHTML($mesajicerigihazirla);
			$mailGonder->send();

			header("Location:index.php?SK=39");
			exit();
		}
		catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
			header("Location:index.php?SK=40");
			exit();
		}
	}else{
		header("Location:index.php?SK=41");
		exit();
	}
}else{
	header("Location:index.php?SK=42");
	exit();
}
?>