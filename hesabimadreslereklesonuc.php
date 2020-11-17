<?php
if(isset($_SESSION["kullanici"])){
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
		$yeniadres=$DBConnection->prepare("INSERT INTO adresler (uyeid, adsoyad, adres, ilce, sehir, telno) VALUES (?,?,?,?,?,?)");
		$yeniadres->execute([$id, $adsoyad,$adres, $ilce, $sehir,$tel ]);
		$adreskontrol	=	$yeniadres->rowCount();
		if($adreskontrol>0){ // üye kaydı başarılı
			header("Location:index.php?SK=72");
			exit();
		}else{ //hatalı
			header("Location:index.php?SK=73");
			exit();
		}
	}else{ // eksik alanlar var
		header("Location:index.php?SK=74");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
