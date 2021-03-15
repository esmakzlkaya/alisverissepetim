<?php 
if (isset($_SESSION["kullanici"])) {
	if (isset($_GET["id"])) {
		$sepetid=Guvenlik($_GET["id"]);
	}else{
		$sepetid="";
	}
	if ($sepetid!="") {
		$silsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE id=? AND uyeid=? LIMIT 1");
		$silsorgusu->execute([$sepetid,$id]);
		$sayisi=$silsorgusu->rowCount();
		if ($sayisi>0) {
			header("Location:sepet");
			exit();
		}else{
			header("Location:sepet");
			exit();
		}
	}else{
		header("Location:sepet");
		exit();
	}
}else{
	header("Location:anasayfa");
	exit();
}
?>