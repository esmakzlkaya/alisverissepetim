<?php 
session_start(); ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
if(isset($_GET["mail"])){
	$gelenmail=Guvenlik($_GET["mail"]);	
}else{
	$gelenmail="";
}
if(isset($_GET["aktivasyonKodu"])){
	$gelenaktivasyonkodu=Guvenlik($_GET["aktivasyonKodu"]);	
}else{
	$gelenaktivasyonkodu="";
}
if(($gelenmail!="") and ($gelenaktivasyonkodu!="")){
	$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ? AND aktivasyonKodu = ? AND durumu = ? LIMIT 1");
	$kontrolSorgusu->execute([$gelenmail,$gelenaktivasyonkodu,0]);
	$sayisi=$kontrolSorgusu->rowCount();
	if($sayisi>0){
		$uyeguncelle=$DBConnection->prepare("UPDATE uyeler SET durumu = 1 WHERE mail='". $gelenmail."'");
		$uyeguncelle->execute();
		$kontrol	=	$uyeguncelle->rowCount();
		if($kontrol>0){
			header("Location:index.php?SK=30");
			exit();
		}
		else{
			header("Location:" . $sitelinki);
			exit();
		}
	}
	else{
		header("Location:" . $sitelinki);
		exit();	
	}
}
else{
	header("Location:" . $sitelinki);
	exit();
}
$DBConnection=null;
?>