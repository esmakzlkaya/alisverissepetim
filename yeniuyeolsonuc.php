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
if(isset($_POST["sifretekrar"])){
	$gelensifretekrar=Guvenlik($_POST["sifretekrar"]);	
}else{
	$gelensifretekrar="";
}
if(isset($_POST["adsoyad"])){
	$gelenisim=Guvenlik($_POST["adsoyad"]);	
}else{
	$gelenisim="";
}
if(isset($_POST["tel"])){
	$gelentel=Guvenlik($_POST["tel"]);	
}else{
	$gelentel="";
}
if(isset($_POST["cinsiyet"])){
	$gelencinsiyet=Guvenlik($_POST["cinsiyet"]);	
}else{
	$gelencinsiyet="";
}
if(isset($_POST["uyeliksozlesmeonay"])){
	$gelensozlesmeonay=Guvenlik($_POST["uyeliksozlesmeonay"]);	
}else{
	$gelensozlesmeonay="";
}

$gelenaktivasyonkodu=AktivasyonKoduuret();
$md5liSifre=md5($gelensifre);

if(($gelenmail!="") and ($gelensifre!="") and ($gelensifretekrar!="") and ($gelenisim!="")and ($gelentel!="") and ($gelencinsiyet!="")){
	if ($gelensozlesmeonay==0) {
		header("Location:index.php?SK=29");
		exit();
	}else{
		if ($gelensifre!=$gelensifretekrar){
			header("Location:index.php?SK=28");
			exit();
		}else{
			$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ? LIMIT 1");
			$kontrolSorgusu->execute([$gelenmail]);
			$sayisi=$kontrolSorgusu->rowCount();
			if ($sayisi>0) {
				header("Location:index.php?SK=27");
				exit();
			}else{
				$yeniuye=$DBConnection->prepare("INSERT INTO uyeler (mail, sifre, adsoyad, telno, cinsiyet, durumu, kayitTarihi, kayitIPAdresi,aktivasyonKodu) values (?,?,?,?,?,?,?,?,?)");
				$yeniuye->execute([$gelenmail, $md5liSifre,$gelenisim, $gelentel, $gelencinsiyet,0, $zamanDamgasi, $IPAdresi,$gelenaktivasyonkodu]);
				$yeniuyekontrol	=	$yeniuye->rowCount();

				if($yeniuyekontrol>0){

					$mesajicerigihazirla= "Merhaba " . $gelenisim . "<br/>Üyeliğini tamamlamak için lütfen <a href='" .$sitelinki. "/aktivasyon.php?aktivasyonKodu=".$gelenaktivasyonkodu. "&mail=".$gelenmail ."'>BURAYA TIKLAYINIZ</a> . <br/><br/> ".$siteadi;
					$mailGonder = new PHPMailer(true);
					try {
    $mailGonder->SMTPDebug = 0;                      // Enable verbose debug output
    $mailGonder->isSMTP();                                            // Send using SMTP
    $mailGonder->Host       = DonusumleriGeriDondur($siteemailHostAdresi);                    // Set the SMTP server to send through
    $mailGonder->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mailGonder->CharSet 	="UTF-8";
    $mailGonder->Username   = DonusumleriGeriDondur($siteemail);                     // SMTP username
    $mailGonder->Password   = DonusumleriGeriDondur($sitesifre);                             // SMTP password
    $mailGonder->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mailGonder->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mailGonder->SMTPOptions = array(
    	'ssl' => [
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true,
    	],
    );
    //Recipients
    $mailGonder->setFrom(DonusumleriGeriDondur($siteemail), DonusumleriGeriDondur($siteadi));
    $mailGonder->addAddress(DonusumleriGeriDondur($gelenmail), DonusumleriGeriDondur($gelenisim));     // Add a recipient
    $mailGonder->addReplyTo($siteemail,$siteadi);
    $mailGonder->isHTML(true);                                  // Set email format to HTML
    $mailGonder->Subject =  DonusumleriGeriDondur($siteadi).' Üyelik aktivasyonu';
    $mailGonder->MsgHTML($mesajicerigihazirla);
    $mailGonder->send();

    header("Location:index.php?SK=24");
    exit();
}
catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
	header("Location:index.php?SK=25");
	exit();
}

header("Location:index.php?SK=24");
exit();
}else{
	header("Location:index.php?SK=25");
	exit();
}
}
}
}
}
else{
	header("Location:index.php?SK=26");
	exit();
}
?>
