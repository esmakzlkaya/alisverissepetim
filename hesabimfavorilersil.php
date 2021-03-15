<?php 
if (isset($_SESSION["kullanici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($id!="") {
		$silsorgusu=$DBConnection->prepare("DELETE FROM favoriler WHERE id=? and uyeid=?");
		$silsorgusu->execute([$gelenid,$id]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SK=59"); //Favoriler sayfası
			exit();
		}else{
			header("Location:index.php?SK=81"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SK=81");
		exit();
	}
	
}else{
	header("Location:anasayfa");
	exit();
}
?>