<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelensoruid=Guvenlik($_GET["id"]);
	}else{
		$gelensoruid="";
	}
	if(isset($_POST["soru"])){
		$gelensoru=Guvenlik($_POST["soru"]);	
	}else{
		$gelensoru="";
	}
	if(isset($_POST["cevap"])){
		$gelencevap=Guvenlik($_POST["cevap"]);	
	}else{
		$gelencevap="";
	}

	if(($gelensoruid!="") and ($gelensoru !="") and ($gelencevap !="")){

		$soruguncelleSorgusu=$DBConnection->prepare("UPDATE sorular SET soru=?, cevap=? WHERE id=? LIMIT 1");
		$soruguncelleSorgusu->execute([$gelensoru,$gelencevap,$gelensoruid]);
		$sorusayisi=$soruguncelleSorgusu->rowCount();
		if ($sorusayisi>0) {
			header("Location:index.php?SKD=0&SKI=52");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=53");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=53");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>