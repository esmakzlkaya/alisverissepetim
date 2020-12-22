<?php
//POST İŞLEMLERİ
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
//GET İŞLEMLERİ
if (isset($_GET["mail"])){
	$gelenmail=Guvenlik($_GET["mail"]);
}else{
	$gelenmail="";
}
if (isset($_GET["aktivasyonKodu"])){
	$gelenaktivasyonkodu=Guvenlik($_GET["aktivasyonKodu"]);
}else{
	$gelenaktivasyonkodu="";
}
$md5lisifre=md5($gelensifre);

if(($gelenmail!="") and ($gelenaktivasyonkodu!="") and ($gelensifre!="") and ($gelensifretekrar!="")){
	if($gelensifre==$gelensifretekrar){
		$sifreguncelle=$DBConnection->prepare("UPDATE uyeler SET sifre=? WHERE mail=? AND aktivasyonKodu=? LIMIT 1");
		$sifreguncelle->execute([$md5lisifre,$gelenmail,$gelenaktivasyonkodu]);
		$sayisi=$sifreguncelle->rowCount();
		$sifrekaydi=$sifreguncelle->fetch(PDO::FETCH_ASSOC);
		if ($sayisi>0) {
			header("Location:index.php?SK=45");
			exit();
		}else{
			header("Location:index.php?SK=46");
			exit();
		}	
	}else{
		header("Location:index.php?SK=47");
		exit();
	}
}else{
	header("Location:index.php?SK=48");
	exit();
}
?>