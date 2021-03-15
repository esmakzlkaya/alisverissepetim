<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}

	if ($gelenid!="") {

		$havalesilsorgusu=$DBConnection->prepare("DELETE FROM havalebildirimleri WHERE id=? LIMIT 1");
		$havalesilsorgusu->execute([$gelenid]);
		$havalesilsayisi=$havalesilsorgusu->rowCount();
		if ($havalesilsayisi>0) {
			header("Location:index.php?SKD=0&SKI=118"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=119"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=119"); //hata
		exit();
	}
}else{
	header("Location:index.php?SKI=0&SKD=0");
	exit();
}
?>