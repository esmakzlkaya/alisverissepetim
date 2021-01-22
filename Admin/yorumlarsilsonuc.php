<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$yorumlarsorgusu=$DBConnection->prepare("SELECT * FROM yorumlar WHERE id=? LIMIT 1");
		$yorumlarsorgusu->execute([$gelenid]);
		$yorumsayisi=$yorumlarsorgusu->rowCount();
		$yorumlar=$yorumlarsorgusu->fetch(PDO::FETCH_ASSOC);
		if ($yorumsayisi>0) {
			$urunid=$yorumlar["urunid"];
			$puan=$yorumlar["puan"];

			$silsorgusu=$DBConnection->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
			$silsorgusu->execute([$gelenid]);
			$sayisi=$silsorgusu->rowCount();
			if ($sayisi>0) {

				$urunguncellesorgusu=$DBConnection->prepare("UPDATE urunler SET yorumsayisi=yorumsayisi-1,toplamyorumpuani=toplamyorumpuani-? WHERE id=? LIMIT 1");
				$urunguncellesorgusu->execute([$puan,$urunid]);	
			}

			header("Location:index.php?SKD=0&SKI=92"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=93"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=93"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>