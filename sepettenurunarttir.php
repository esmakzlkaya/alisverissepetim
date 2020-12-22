<?php 
if (isset($_SESSION["kullanici"])) {
	if (isset($_GET["id"])) {
		$sepetid=Guvenlik($_GET["id"]);
	}else{
		$sepetid="";
	}
	if ($sepetid!="") {
		$silsorgusu=$DBConnection->prepare("UPDATE sepet SET urunadedi=urunadedi+1 WHERE id=? AND uyeid=?");
		$silsorgusu->execute([$sepetid,$id]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:index.php?SK=92");
			exit();
		}else{
			header("Location:index.php?SK=92");
			exit();
		}
	}else{
		header("Location:index.php?SK=92");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>