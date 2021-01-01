<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["hakkimizdametni"])){
		$gelenhakkimizdametni=Guvenlik($_POST["hakkimizdametni"]);	
	}else{
		$gelenhakkimizdametni="";
	}
	if(isset($_POST["uyeliksozlesmesimetni"])){
		$gelenuyeliksozlesmesimetni=Guvenlik($_POST["uyeliksozlesmesimetni"]);	
	}else{
		$gelenuyeliksozlesmesimetni="";
	}
	if(isset($_POST["kullanimkosullarimetni"])){
		$gelenkullanimkosullarimetni=Guvenlik($_POST["kullanimkosullarimetni"]);	
	}else{
		$gelenkullanimkosullarimetni="";
	}
	if(isset($_POST["gizliliksozlesmesimetni"])){
		$gelengizliliksozlesmesimetni=Guvenlik($_POST["gizliliksozlesmesimetni"]);	
	}else{
		$gelengizliliksozlesmesimetni="";
	}
	if(isset($_POST["mesafelisatisozlesmesimetni"])){
		$gelenmesafelisatisozlesmesimetni=Guvenlik($_POST["mesafelisatisozlesmesimetni"]);	
	}else{
		$gelenmesafelisatisozlesmesimetni="";
	}
	if(isset($_POST["teslimatmetni"])){
		$gelenteslimatmetni=Guvenlik($_POST["teslimatmetni"]);	
	}else{
		$gelenteslimatmetni="";
	}
	if(isset($_POST["iptaliadedegisimmetni"])){
		$geleniptaliadedegisimmetni=Guvenlik($_POST["iptaliadedegisimmetni"]);	
	}else{
		$geleniptaliadedegisimmetni="";
	}
	
	if(($gelenhakkimizdametni !="") and ($gelenuyeliksozlesmesimetni !="") and ($gelenkullanimkosullarimetni !="") and ($gelengizliliksozlesmesimetni !="") and ($gelenmesafelisatisozlesmesimetni !="") and ($gelenteslimatmetni !="") and ($geleniptaliadedegisimmetni !="")){

		$SozlesmeveMetinlerGuncelleSorgusu=$DBConnection->prepare("UPDATE sozlesmelervemetinler SET hakkimizdametni=?, uyeliksozlesmesimetni=?, kullanimkosullarimetni=?, gizliliksozlesmesimetni=?, mesafelisatisozlesmesimetni=?, teslimatmetni=?, iptaliadedegisimmetni=?");
		$SozlesmeveMetinlerGuncelleSorgusu->execute([$gelenhakkimizdametni, $gelenuyeliksozlesmesimetni, $gelenkullanimkosullarimetni, $gelengizliliksozlesmesimetni,$gelenmesafelisatisozlesmesimetni,$gelenteslimatmetni, $geleniptaliadedegisimmetni]);
		
		header("Location:index.php?SKD=0&SKI=7");
		exit();
	}else{
		header("Location:index.php?SKD=0&SKI=8");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=0");
	exit();
}
?>