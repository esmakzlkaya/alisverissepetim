<?php
if(isset($_SESSION["kullanici"])){
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}
	if(isset($_POST["adsoyad"])){
		$adsoyad=Guvenlik($_POST["adsoyad"]);	
	}else{
		$adsoyad="";
	}
	if(isset($_POST["adres"])){
		$adres=Guvenlik($_POST["adres"]);	
	}else{
		$adres="";
	}
	if(isset($_POST["ilce"])){
		$ilce=Guvenlik($_POST["ilce"]);	
	}else{
		$ilce="";
	}
	if(isset($_POST["sehir"])){
		$sehir=Guvenlik($_POST["sehir"]);	
	}else{
		$sehir="";
	}
	if(isset($_POST["tel"])){
		$tel=Guvenlik($_POST["tel"]);	
	}else{
		$tel="";
	}

	if(($adsoyad!="") and ($adres!="") and ($ilce!="") and ($sehir!="")and ($tel!="")){
		$adresguncelle=$DBConnection->prepare("UPDATE adresler SET adsoyad=?, adres=?, ilce=?, sehir=?, telno=? WHERE id=? AND uyeid=? LIMIT 1");
		$adresguncelle->execute([$adsoyad,$adres, $ilce, $sehir,$tel,$gelenid,$id]);
		$adreskontrol	=	$adresguncelle->rowCount();
		if($adreskontrol>0){ // adres güncelleme başarılı
			header("Location:index.php?SK=64");
			exit();
		}else{ //hatalı
			header("Location:index.php?SK=65");
			exit();
		}
	}else{ // eksik alanlar var
		header("Location:index.php?SK=66");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>