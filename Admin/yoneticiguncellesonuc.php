<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenyoneticiid=Guvenlik($_GET["id"]);
	}else{
		$gelenyoneticiid="";
	}
	if(isset($_POST["kullaniciadi"])){
		$gelenkullaniciadi=Guvenlik($_POST["kullaniciadi"]);	
	}else{
		$gelenkullaniciadi="";
	}
	if(isset($_POST["isimsoyisim"])){
		$gelenisimsoyisim=Guvenlik($_POST["isimsoyisim"]);	
	}else{
		$gelenisimsoyisim="";
	}
	if(isset($_POST["mail"])){
		$gelenmail=Guvenlik($_POST["mail"]);	
	}else{
		$gelenmail="";
	}
	if(isset($_POST["sifre"])){
		$gelensifre=Guvenlik($_POST["sifre"]);	
	}else{
		$gelensifre="";
	}
	if(isset($_POST["telno"])){
		$gelentelno=Guvenlik($_POST["telno"]);	
	}else{
		$gelentelno="";
	}
	
	if(($gelenyoneticiid!="") and ($gelenisimsoyisim !="") and ($gelenmail !="") and ($gelentelno!="")){
		$yoneticilerSorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler WHERE id=? ");
		$yoneticilerSorgusu->execute([$gelenyoneticiid]);
		$yoneticisayisi=$yoneticilerSorgusu->rowCount();
		$yoneticikayitlari=$yoneticilerSorgusu->fetch(PDO::FETCH_ASSOC);
		if ($yoneticisayisi>0) {
			$mevcutsifre=$yoneticikayitlari["sifre"];
			if ($gelensifre=="") {
				$kaydedileceksifre=$mevcutsifre;
			}else{
				$kaydedileceksifre=md5($gelensifre);
			}

			$yoneticiguncelleSorgusu=$DBConnection->prepare("UPDATE yoneticiler SET sifre=?, isimsoyisim=?, mail=?, telno=? WHERE id=? LIMIT 1");
			$yoneticiguncelleSorgusu->execute([$kaydedileceksifre, $gelenisimsoyisim, $gelenmail, $gelentelno, $gelenyoneticiid]);
			$guncellesayisi=$yoneticiguncelleSorgusu->rowCount();
			if ($guncellesayisi>0) {
				header("Location:index.php?SKD=0&SKI=77");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=78");
				exit();
			}
		}else{
			header("Location:index.php?SKD=0&SKI=78");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=78");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>