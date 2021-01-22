<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$uyegeriacsorgusu=$DBConnection->prepare("UPDATE uyeler SET silinmedurumu=? WHERE id=? LIMIT 1");
		$uyegeriacsorgusu->execute([0,$gelenid]);
		$uyegeriacsayisi=$uyegeriacsorgusu->rowCount();
		if ($uyegeriacsayisi>0) {
			header("Location:index.php?SKD=0&SKI=88");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=89"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKI=0&SKD=89");
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=1");
	exit();
}
?>