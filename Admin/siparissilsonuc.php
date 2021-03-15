<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["SiparisNo"])) {
		$gelensiparisno=Guvenlik($_GET["SiparisNo"]);
	}else{
		$gelensiparisno="";
	}

	if($gelensiparisno !=""){
		$siparislerSorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE siparisnumarasi=? ");
		$siparislerSorgusu->execute([$gelensiparisno]);
		$siparissayisi=$siparislerSorgusu->rowCount();
		$siparisler=$siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if ($siparissayisi>0) {
			foreach ($siparisler as $siparis) {
				$SiparisId=$siparis["id"];
				$urunId=$siparis["urunid"];
				$urunAdedi=$siparis["urunadedi"];
				$varyantSecimi=DonusumleriGeriDondur($siparis["varyantsecimi"]);

				$siparisSilSorgusu=$DBConnection->prepare("DELETE FROM siparisler WHERE id=? LIMIT 1");
				$siparisSilSorgusu->execute([$SiparisId]);
				$siparissilmesayisi=$siparisSilSorgusu->rowCount();
				if ($siparissilmesayisi>0) {

					$urunGuncellemeSorgusu=$DBConnection->prepare("UPDATE urunler SET toplamsatissayisi=toplamsatissayisi-? WHERE id=? LIMIT 1");
					$urunGuncellemeSorgusu->execute([$urunAdedi,$urunId]);
					$urunGuncellesayisi=$urunGuncellemeSorgusu->rowCount();
					if ($urunGuncellesayisi>0) {

						$varyantGuncellemeSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET stokadedi=stokadedi+? WHERE varyantadi=? AND urunid=? LIMIT 1");
						$varyantGuncellemeSorgusu->execute([$urunAdedi,$varyantSecimi,$urunId]);
						$varyantGuncellesayisi=$varyantGuncellemeSorgusu->rowCount();
						if ($varyantGuncellesayisi<1) {
							header("Location:index.php?SKD=0&SKI=115");
							exit();
						}
					}else{
						header("Location:index.php?SKD=0&SKI=115");
						exit();
					}
				}else{
					header("Location:index.php?SKD=0&SKI=115");
					exit();
				}
			}
			header("Location:index.php?SKD=0&SKI=114");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=115");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=115");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>