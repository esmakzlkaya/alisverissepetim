<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {
		$urunlerSorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
		$urunlerSorgusu->execute([$gelenid]);
		$urunlersayisi=$urunlerSorgusu->rowCount();
		$urunler=$urunlerSorgusu->fetch(PDO::FETCH_ASSOC);
		if ($urunlersayisi>0) {
			$silinecekurunmenuid=$urunler["menuid"];

			$urunlerSilSorgusu=$DBConnection->prepare("UPDATE urunler SET durumu=? WHERE id=? LIMIT 1");
			$urunlerSilSorgusu->execute([0,$gelenid]);
			$urunsilsayisi=$urunlerSilSorgusu->rowCount();
			if ($urunsilsayisi>0) {

				$yorumlarsilsorgusu=$DBConnection->prepare("DELETE FROM favoriler WHERE urunid=? LIMIT 1");
				$yorumlarsilsorgusu->execute([$gelenid]);
				$sayisi=$yorumlarsilsorgusu->rowCount();

				$yorumlarsilsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE urunid=? LIMIT 1");
				$yorumlarsilsorgusu->execute([$gelenid]);
				$sayisi=$yorumlarsilsorgusu->rowCount();

				$MenuGuncelleSorgusu=$DBConnection->prepare("UPDATE menuler SET urunsayisi=urunsayisi-1 WHERE id=? LIMIT 1");
				$MenuGuncelleSorgusu->execute([$silinecekurunmenuid]);


				header("Location:index.php?SKD=0&SKI=104"); 
				exit();
			}else{
			header("Location:index.php?SKD=0&SKI=105"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=105"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=105"); //hata
	exit();
}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>