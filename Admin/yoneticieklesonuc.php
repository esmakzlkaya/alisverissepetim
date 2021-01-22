<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["isimsoyisim"])){
		$gelenisimsoyisim=Guvenlik($_POST["isimsoyisim"]);	
	}else{
		$gelenisimsoyisim="";
	}
	if(isset($_POST["kullaniciadi"])){
		$gelenkullaniciadi=Guvenlik($_POST["kullaniciadi"]);	
	}else{
		$gelenkullaniciadi="";
	}
	if(isset($_POST["sifre"])){
		$gelensifre=Guvenlik($_POST["sifre"]);	
	}else{
		$gelensifre="";
	}
	if(isset($_POST["mail"])){
		$gelenmail=Guvenlik($_POST["mail"]);	
	}else{
		$gelenmail="";
	}
	if(isset($_POST["telno"])){
		$gelentelno=Guvenlik($_POST["telno"]);	
	}else{
		$gelentelno="";
	}
	$md5lisifre=md5($gelensifre);
	if(($gelenisimsoyisim !="") and ($gelenkullaniciadi !="") and ($gelensifre !="") and ($gelenmail !="") and ($gelentelno !="")){
		$yoneticilerSorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler WHERE kullaniciadi=? or mail=?");
		$yoneticilerSorgusu->execute([$gelenkullaniciadi,$gelenmail]);
		$yoneticisayisi=$yoneticilerSorgusu->rowCount();
		if ($yoneticisayisi>0) {
			header("Location:index.php?SKD=0&SKI=74");
			exit();
		}else{
			$kargoekleSorgusu=$DBConnection->prepare("INSERT INTO yoneticiler (kullaniciadi, sifre, isimsoyisim, mail, telno) VALUES (?,?,?,?,?)");
			$kargoekleSorgusu->execute([$gelenkullaniciadi,$md5lisifre,$gelenisimsoyisim,$gelenmail,$gelentelno]);
			$sayisi=$kargoekleSorgusu->rowCount();
			if ($sayisi>0) {
				header("Location:index.php?SKD=0&SKI=72");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=73");
				exit();
			}
		}
	}else{
		header("Location:index.php?SKD=0&SKI=73");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>