<?php
if (isset($_SESSION["yonetici"])) {

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

	if(($gelensoru !="") and ($gelencevap !="")){
		$soruekleSorgusu=$DBConnection->prepare("INSERT INTO sorular (soru, cevap) VALUES (?,?)");
		$soruekleSorgusu->execute([$gelensoru,$gelencevap]);
		$sayisi=$soruekleSorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SKD=0&SKI=48");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=49");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=49");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>