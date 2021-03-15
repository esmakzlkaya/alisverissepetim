<?php
if(isset($_SESSION["kullanici"])){
	$gelenuyemail=$_SESSION["kullanici"];

	if (isset($_GET["id"])) {
		$gelenurunid=$_GET["id"];
	}else{
		$gelenurunid="";
	}
	if(($id!="")){
		$favorikontrolsorgusu=$DBConnection->prepare("SELECT * FROM favoriler WHERE urunid=? AND uyeid=? LIMIT 1");
		$favorikontrolsorgusu->execute([$gelenurunid,$id]);
		$favorikontrolsayisi=$favorikontrolsorgusu->rowCount();
		if ($favorikontrolsayisi>0) {
			header("Location:index.php?SK=89");
			exit();
		}else{
			$favoriekle=$DBConnection->prepare("INSERT INTO favoriler (urunid, uyeid) VALUES (?,?)");
			$favoriekle->execute([$gelenurunid,$id]);
			$favorikontrol	=	$favoriekle->rowCount();
		if($favorikontrol>0){ // üye kaydı başarılı
			header("Location:index.php?SK=87");
			exit();
		}else{ //hatalı
			header("Location:index.php?SK=88");
			exit();
		}
	}
	}else{ // eksik alanlar var
		header("Location:anasayfa");
		exit();
	} 
}else{
	header("Location:anasayfa");
	exit();
}
?>
