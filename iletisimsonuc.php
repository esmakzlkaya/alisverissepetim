<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';
if(isset($_POST["adsoyad"])){
	$gelenisim=Guvenlik($_POST["adsoyad"]);	
}else{
	$gelenisim="";
}
if(isset($_POST["mail"])){
	$gelenmail=Guvenlik($_POST["mail"]);	
}else{
	$gelenmail="";
}
if(isset($_POST["tel"])){
	$gelentel=Guvenlik($_POST["tel"]);	
}else{
	$gelentel="";
}

if(isset($_POST["mesaj"])){
	$Gelenmesaj			=	Guvenlik($_POST["mesaj"]);
}else{
	$Gelenmesaj			=	"";
}
if(($gelenisim!="") and ($gelenmail!="") and ($gelentel!="") and ($Gelenmesaj!="")){
	$mesajicerigihazirla = "İsim Soyisim : " . $gelenisim . "<br/>E-mail adresi : " . $gelenmail . "<br/>Telefon numarası : " .$gelentel . "<br/>Mesajı : " . $Gelenmesaj;
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
    $mailGonder->addAddress(DonusumleriGeriDondur($siteemail), DonusumleriGeriDondur($siteadi));     // Add a recipient
    $mailGonder->addReplyTo($gelenmail,$gelenisim);
    $mailGonder->isHTML(true);                                  // Set email format to HTML
    $mailGonder->Subject =  DonusumleriGeriDondur($siteadi).' İletişim Formu Mesajı';
    $mailGonder->MsgHTML($mesajicerigihazirla);
    $mailGonder->send();

    header("Location:index.php?SK=18");
    exit();
}
catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
	header("Location:index.php?SK=19");
	exit();
}
}else{
	header("Location:index.php?SK=20");
	exit();
}
?>