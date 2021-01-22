<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$silsorgusu=$DBConnection->prepare("UPDATE uyeler SET silinmedurumu=? WHERE id=? LIMIT 1");
		$silsorgusu->execute([1,$gelenid]);
		$uyesilmesayisi=$silsorgusu->rowCount();
		if ($uyesilmesayisi>0) {

			$sepetsilmeSorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE uyeid=? LIMIT 1");
			$sepetsilmeSorgusu->execute([$gelenid]);
			$sepetsilmesayisi=$sepetsilmeSorgusu->rowCount();

			$yorumlarSorgusu=$DBConnection->prepare("SELECT * FROM yorumlar WHERE uyeid=? ");
			$yorumlarSorgusu->execute([$gelenid]);	
			$yorumsayisi=$yorumlarSorgusu->rowCount();
			$yorumlar=$yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
			if ($yorumsayisi>0) {
				foreach ($yorumlar as $yorum) {
					$yorumid=$yorum["id"];
					$yorumdakiurunid=$yorum["urunid"];
					$yorumpuani=$yorum["puan"];

					$urunguncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET yorumsayisi=yorumsayisi-1, toplamyorumpuani=toplamyorumpuani-? WHERE id=? LIMIT 1");
					$urunguncelleSorgusu->execute([$yorumpuani,$yorumdakiurunid]);
					$guncellemekontrol=$urunguncelleSorgusu->rowCount();
					if ($guncellemekontrol<1) {
							header("Location:index.php?SKD=0&SKI=86"); //hata
							exit();

						}
						$yorumsilmeSorgusu=$DBConnection->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
						$yorumsilmeSorgusu->execute([$yorumid]);
						$yorumsilmesayisi=$yorumsilmeSorgusu->rowCount();
						if ($yorumsilmesayisi<1) {
							header("Location:index.php?SKD=0&SKI=86"); //hata
							exit();
						}
					}
				}

				header("Location:index.php?SKD=0&SKI=85"); 
				exit();


			}else{
			header("Location:index.php?SKD=0&SKI=86"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKI=0&SKD=86");
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=1");
	exit();
}
?>