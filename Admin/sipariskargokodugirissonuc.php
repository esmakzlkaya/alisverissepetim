<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["SiparisNo"])) {
		$gelensiparisno=Guvenlik($_GET["SiparisNo"]);
	}else{
		$gelensiparisno="";
	}
	if (isset($_POST["gonderikodu"])) {
		$gelenkargogonderino=Guvenlik($_POST["gonderikodu"]);
	}else{
		$gelenkargogonderino="";
	}

	if(($gelensiparisno !="") and ($gelenkargogonderino !="")){

		$siparisguncelleSorgusu=$DBConnection->prepare("UPDATE siparisler SET onaydurumu=1,kargodurumu=1,kargogonderino=? WHERE siparisnumarasi=? LIMIT 1");
		$siparisguncelleSorgusu->execute([$gelenkargogonderino,$gelensiparisno]);
		$siparisguncellesayisi=$siparisguncelleSorgusu->rowCount();
		if ($siparisguncellesayisi>0) {

			header("Location:index.php?SKD=0&SKI=111");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=112");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=112");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>