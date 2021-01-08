<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenbannerid=Guvenlik($_GET["id"]);
	}else{
		$gelenbannerid="";
	}

	if ($gelenbannerid!="") {

		$bannersorgusu=$DBConnection->prepare("SELECT * FROM bannerlar WHERE id=?");
		$bannersorgusu->execute([$gelenbannerid]);
		$bannersayisi=$bannersorgusu->rowCount();
		$bannerlar=$bannersorgusu->fetch(PDO::FETCH_ASSOC);

		$silinecekdosyayolu="../Resimler/".$bannerlar["bannerresmi"];


		$silsorgusu=$DBConnection->prepare("DELETE FROM bannerlar WHERE id=? LIMIT 1");
		$silsorgusu->execute([$gelenbannerid]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			unlink($silinecekdosyayolu);

			header("Location:index.php?SKD=0&SKI=43"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=44"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=44"); //hata
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>