<?php
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
if(isset($_POST["bankasecimi"])){
	$gelenbankaid=Guvenlik($_POST["bankasecimi"]);	
}else{
	$gelenbankaid="";
}
if(isset($_POST["Aciklama"])){
	$GelenAciklama			=	Guvenlik($_POST["Aciklama"]);
}else{
	$GelenAciklama			=	"";
}
if(($gelenisim!="") and ($gelenmail!="") and ($gelentel!="") and ($gelenbankaid!="")){
	$HavaleBildirimiKaydet			=	$DBConnection->prepare("INSERT INTO havalebildirimleri (bankaid, adsoyad, email, telno, aciklama, islemtarihi, durum) values (?, ?, ?, ?, ?, ?, ?)");
	$HavaleBildirimiKaydet->execute([$gelenbankaid, $gelenisim, $gelenmail, $gelentel, $GelenAciklama, $zamanDamgasi, 0]);
	$HavaleBildirimiKaydetKontrol	=	$HavaleBildirimiKaydet->rowCount();
	
	if($HavaleBildirimiKaydetKontrol>0){
		header("Location:index.php?SK=11");
		exit();
	}else{
		header("Location:index.php?SK=12");
		exit();
	}
}else{
	header("Location:index.php?SK=13");
	exit();
}
?>