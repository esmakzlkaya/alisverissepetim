<?php 
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelensoruid=Guvenlik($_GET["id"]);
	}else{
		$gelensoruid="";
	}

	if ($gelensoruid!="") {
		$silsorgusu=$DBConnection->prepare("DELETE FROM sorular WHERE id=? LIMIT 1");
		$silsorgusu->execute([$gelensoruid]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SKD=0&SKI=55"); 
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=56"); //hata
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=56"); //hata
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>