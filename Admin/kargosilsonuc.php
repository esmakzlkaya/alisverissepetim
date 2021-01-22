<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$kargosorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari WHERE id=?");
		$kargosorgusu->execute([$gelenid]);
		$kargosayisi=$kargosorgusu->rowCount();
		$kargolar=$kargosorgusu->fetch(PDO::FETCH_ASSOC);

		$silinecekdosyayolu="../Resimler/".$kargolar["kargofirmasilogosu"];


		$silsorgusu=$DBConnection->prepare("DELETE FROM kargofirmalari WHERE id=? LIMIT 1");
		$silsorgusu->execute([$gelenid]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			unlink($silinecekdosyayolu);

			header("Location:index.php?SKD=0&SKI=31"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=32"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=32"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>