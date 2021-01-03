<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["kargofirmasiadi"])){
		$gelenkargofirmasiadi=Guvenlik($_POST["kargofirmasiadi"]);	
	}else{
		$gelenkargofirmasiadi="";
	}

	$gelenkargologosu=$_FILES["kargofirmasilogosu"];

	if(($gelenkargologosu["name"]!="") and ($gelenkargologosu["type"]!="") and
		($gelenkargologosu["tmp_name"]!="") and ($gelenkargologosu["error"]==0) and 
		($gelenkargologosu["size"]>0) and ($gelenkargofirmasiadi !="")){

	$yeniresimadiolustur= resimadiolustur();
	$gelenresminuzantisi=substr($gelenkargologosu["name"],-4);

	if ($gelenresminuzantisi=="jpeg") {
		$gelenresminuzantisi=".".$gelenresminuzantisi;
	}

	$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

	$kargoekleSorgusu=$DBConnection->prepare("INSERT INTO kargofirmalari (kargofirmasiadi, kargofirmasilogosu) VALUES (?,?)");
	$kargoekleSorgusu->execute([$gelenkargofirmasiadi,$yenidosyaadi]);
	$sayisi=$kargoekleSorgusu->rowCount();
	if ($sayisi>0) {

		$bankalogoyukle	=	new upload($gelenkargologosu, "tr-TR");
		if($bankalogoyukle->uploaded){

			$bankalogoyukle->mime_magic_check		=	true;
			$bankalogoyukle->allowed				=	array("image/*");
			$bankalogoyukle->file_new_name_body		=	$yeniresimadiolustur;
			$bankalogoyukle->file_overwrite			=	true;
			//$bankalogoyukle->image_convert			=	"png";
			$bankalogoyukle->image_quality			=	100;
			$bankalogoyukle->image_background_color	="#FFFFFF";
			$bankalogoyukle->image_resize			=	true;
			$bankalogoyukle->image_ratio=true;
			$bankalogoyukle->image_y				=	30;
			$bankalogoyukle->process($veroticinklasoryolu);

			if($bankalogoyukle->processed){
				$bankalogoyukle->clean();
				header("Location:index.php?SKD=0&SKI=28");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=29");
				exit();
			} 
		}
	}else{
		header("Location:index.php?SKD=0&SKI=29");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=29");
	exit();
}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>