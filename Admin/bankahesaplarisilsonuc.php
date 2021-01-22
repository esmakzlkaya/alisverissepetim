<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$hesapsorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari WHERE id=?");
		$hesapsorgusu->execute([$gelenid]);
		$hesapsayisi=$hesapsorgusu->rowCount();
		$hesaplar=$hesapsorgusu->fetch(PDO::FETCH_ASSOC);

		$silinecekdosyayolu="../Resimler/".$hesaplar["bankalogo"];


		$silsorgusu=$DBConnection->prepare("DELETE FROM bankahesaplari WHERE id=? LIMIT 1");
		$silsorgusu->execute([$gelenid]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			unlink($silinecekdosyayolu);

			header("Location:index.php?SKD=0&SKI=19"); //Favoriler sayfası
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=20"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=20"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>