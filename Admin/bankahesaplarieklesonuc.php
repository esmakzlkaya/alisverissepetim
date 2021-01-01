<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["bankaadi"])){
		$gelenbankaadi=Guvenlik($_POST["bankaadi"]);	
	}else{
		$gelenbankaadi="";
	}
	if(isset($_POST["sehir"])){
		$gelensehir=Guvenlik($_POST["sehir"]);	
	}else{
		$gelensehir="";
	}
	if(isset($_POST["ulke"])){
		$gelenulke=Guvenlik($_POST["ulke"]);	
	}else{
		$gelenulke="";
	}
	if(isset($_POST["subeadi"])){
		$gelensubeadi=Guvenlik($_POST["subeadi"]);	
	}else{
		$gelensubeadi="";
	}
	if(isset($_POST["subekodu"])){
		$gelensubekodu=Guvenlik($_POST["subekodu"]);	
	}else{
		$gelensubekodu="";
	}
	if(isset($_POST["hesapsahibi"])){
		$gelenhesapsahibi=Guvenlik($_POST["hesapsahibi"]);	
	}else{
		$gelenhesapsahibi="";
	}
	if(isset($_POST["hesapno"])){
		$gelenhesapno=Guvenlik($_POST["hesapno"]);	
	}else{
		$gelenhesapno="";
	}
	if(isset($_POST["ibanno"])){
		$gelenibanno=Guvenlik($_POST["ibanno"]);	
	}else{
		$gelenibanno="";
	}

	$gelenbankalogosu=$_FILES["bankalogo"];

	if(($gelenbankalogosu["name"]!="") and ($gelenbankalogosu["type"]!="") and
		($gelenbankalogosu["tmp_name"]!="") and ($gelenbankalogosu["error"]==0) and 
		($gelenbankalogosu["size"]>0) and ($gelenbankaadi !="") and ($gelensehir !="") and 
		($gelenulke !="") and ($gelensubeadi !="") and ($gelensubekodu !="") and
		($gelenhesapsahibi !="") and ($gelenhesapno !="") and ($gelenibanno !="")){

	$yeniresimadiolustur= resimadiolustur();
	$gelenresminuzantisi=substr($gelenbankalogosu["name"],-4);

	if ($gelenresminuzantisi=="jpeg") {
		$gelenresminuzantisi=".".$gelenresminuzantisi;
	}

	$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

	$bankahesabiekleSorgusu=$DBConnection->prepare("INSERT INTO bankahesaplari (bankaadi, konumsehir, konumulke, subeadi, subekodu, hesapsahibi, hesapno,ibanno,bankalogo) VALUES (?,?,?,?,?,?,?,?,?)");
	$bankahesabiekleSorgusu->execute([$gelenbankaadi,$gelensehir, $gelenulke, $gelensubeadi,$gelensubekodu,$gelenhesapsahibi, $gelenhesapno,$gelenibanno,$yenidosyaadi]);
	$bankahesabisayisi=$bankahesabiekleSorgusu->rowCount();
	if ($bankahesabisayisi>0) {

		$bankalogoyukle	=	new upload($gelenbankalogosu, "tr-TR");
		if($bankalogoyukle->uploaded){

			$bankalogoyukle->mime_magic_check		=	true;
			$bankalogoyukle->allowed				=	array("image/*");
			$bankalogoyukle->file_new_name_body		=	$yeniresimadiolustur;
			$bankalogoyukle->file_overwrite			=	true;
			$bankalogoyukle->image_convert			=	"png";
			$bankalogoyukle->image_quality			=	100;
			$bankalogoyukle->image_background_color	="#FFFFFF";
			$bankalogoyukle->image_resize			=	true;
			$bankalogoyukle->image_y				=	35;
			$bankalogoyukle->process($veroticinklasoryolu);

			if($bankalogoyukle->processed){
				$bankalogoyukle->clean();
				header("Location:index.php?SKD=0&SKI=12");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=13");
				exit();
			} 
		}
	}else{
		header("Location:index.php?SKD=0&SKI=13");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=13");
	exit();
}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>