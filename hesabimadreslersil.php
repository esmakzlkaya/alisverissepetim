<?php 
	$id=$_GET["id"];

	$silsorgusu=$DBConnection->prepare("DELETE FROM adresler WHERE id=?");
	$silsorgusu->execute([$id]);
	$sayisi=$silsorgusu->rowCount();
	if ($sayisi>0) {
		header("Location:index.php?SK=68");
		exit();
	}else{
		header("Location:index.php?SK=69");
		exit();
	}
?>