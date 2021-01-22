<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenyoneticiid=Guvenlik($_GET["id"]);
	}else{
		$gelenyoneticiid="";
	}

	if ($gelenyoneticiid!="") {
		$silsorgusu=$DBConnection->prepare("DELETE FROM yoneticiler WHERE id=? and kullaniciadi!=? LIMIT 1");
		$silsorgusu->execute([$gelenyoneticiid,$yoneticikullaniciadi]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SKD=0&SKI=80"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=81"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=81"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>