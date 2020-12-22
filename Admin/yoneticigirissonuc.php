<?php
if (empty($_SESSION["yonetici"])) {
	if(isset($_POST["yoneticikullaniciadi"])){
		$gelenyoneticikullaniciadi=Guvenlik($_POST["yoneticikullaniciadi"]);	
	}else{
		$gelenyoneticikullaniciadi="";
	}
	if(isset($_POST["yoneticisifre"])){
		$gelenyoneticisifre=Guvenlik($_POST["yoneticisifre"]);	
	}else{
		$gelenyoneticisifre="";
	}
	$md5liSifre=md5($gelenyoneticisifre);

	if(($gelenyoneticikullaniciadi!="") and ($gelenyoneticisifre!="")){
		$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler WHERE kullaniciadi= ? AND sifre=? LIMIT 1");
		$kontrolSorgusu->execute([$gelenyoneticikullaniciadi,$md5liSifre]);
		$sayisi=$kontrolSorgusu->rowCount();
		$kullanicikaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
		if ($sayisi>0) {
			$_SESSION["yonetici"]=$gelenyoneticikullaniciadi;
			header("Location:index.php?SKD=0&SKI=0");
			exit();
		}else{
			header("Location:index.php?SKD=3");
			exit();
		}
	}else{
		header("Location:index.php?SKD=1");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=0");
		exit();
}
?>