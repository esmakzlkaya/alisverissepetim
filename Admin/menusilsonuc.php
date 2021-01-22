<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$silsorgusu=$DBConnection->prepare("DELETE FROM menuler WHERE id=? LIMIT 1");
		$silsorgusu->execute([$gelenid]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {

			$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE menuid=?");
			$urunlersorgusu->execute([$gelenid]);
			$urunsayisi=$urunlersorgusu->rowCount();
			$urunler=$urunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
			if ($urunsayisi>0) {
				foreach ($urunler as $urun) {
					$urunid=$urun["id"];

					$urunguncellesorgusu=$DBConnection->prepare("UPDATE urunler SET durumu=? WHERE menuid=? AND id=? LIMIT 1");
					$urunguncellesorgusu->execute([0,$gelenid,$urunid]);	

					$yorumlarsilsorgusu=$DBConnection->prepare("DELETE FROM favoriler WHERE urunid=? LIMIT 1");
					$yorumlarsilsorgusu->execute([$urunid]);
					$sayisi=$yorumlarsilsorgusu->rowCount();

					$yorumlarsilsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE urunid=? LIMIT 1");
					$yorumlarsilsorgusu->execute([$urunid]);
					$sayisi=$yorumlarsilsorgusu->rowCount();
				}
			}

			header("Location:index.php?SKD=0&SKI=67"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=68"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=68"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>