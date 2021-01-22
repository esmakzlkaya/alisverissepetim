<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["urunturu"])){
		$gelenurunturu=Guvenlik($_POST["urunturu"]);	
	}else{
		$gelenurunturu="";
	}
	if(isset($_POST["menuadi"])){
		$gelenmenuadi=Guvenlik($_POST["menuadi"]);	
	}else{
		$gelenmenuadi="";
	}

	if(($gelenurunturu !="") and ($gelenmenuadi !="")){

		$menuekleSorgusu=$DBConnection->prepare("INSERT INTO menuler (urunturu,menuadi) VALUES (?,?)");
		$menuekleSorgusu->execute([$gelenurunturu,$gelenmenuadi]);
		$sayisi=$menuekleSorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SKD=0&SKI=60");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=61");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=61");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>