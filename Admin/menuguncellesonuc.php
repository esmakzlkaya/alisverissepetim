<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenmenuid=Guvenlik($_GET["id"]);
	}else{
		$gelenmenuid="";
	}
	if(isset($_POST["menuadi"])){
		$gelenmenuadi=Guvenlik($_POST["menuadi"]);	
	}else{
		$gelenmenuadi="";
	}
	if(($gelenmenuid !="") and ($gelenmenuadi !="")){

		$menuguncelleSorgusu=$DBConnection->prepare("UPDATE menuler SET menuadi=? WHERE id=? LIMIT 1");
		$menuguncelleSorgusu->execute([$gelenmenuadi,$gelenmenuid]);
		$menuguncellesayisi=$menuguncelleSorgusu->rowCount();
		if ($menuguncellesayisi>0) {



			header("Location:index.php?SKD=0&SKI=64");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=65");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=65");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>