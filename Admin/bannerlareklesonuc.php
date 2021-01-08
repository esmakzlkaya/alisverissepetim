<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["banneradi"])){
		$gelenbanneradi=Guvenlik($_POST["banneradi"]);	
	}else{
		$gelenbanneradi="";
	}
	if(isset($_POST["banneralani"])){
		$gelenbanneralani=Guvenlik($_POST["banneralani"]);	
	}else{
		$gelenbanneralani="";
	}

	$gelenbannerresmi=$_FILES["bannerresmi"];

	if(($gelenbannerresmi["name"]!="") and ($gelenbannerresmi["type"]!="") and
		($gelenbannerresmi["tmp_name"]!="") and ($gelenbannerresmi["error"]==0) and 
		($gelenbannerresmi["size"]>0) and ($gelenbanneradi !="") and ($gelenbanneralani !="")){

		$yeniresimadiolustur= resimadiolustur();
	$gelenresminuzantisi=substr($gelenbannerresmi["name"],-4);

	if ($gelenresminuzantisi=="jpeg") {
		$gelenresminuzantisi=".".$gelenresminuzantisi;
	}

	$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

	$kargoekleSorgusu=$DBConnection->prepare("INSERT INTO bannerlar (banneralani,banneradi, bannerresmi) VALUES (?,?,?)");
	$kargoekleSorgusu->execute([$gelenbanneralani,$gelenbanneradi,$yenidosyaadi]);
	$sayisi=$kargoekleSorgusu->rowCount();
	if ($sayisi>0) {

		if ($gelenbanneralani=="Anasayfa") {
			$resimgenisligi=1065;
			$resimyuksekligi=186;
		}
		elseif ($gelenbanneralani=="Menu Altı") {
			$resimgenisligi=250;
			$resimyuksekligi=500;
		}elseif ($gelenbanneralani=="Ürün Detay") {
			$resimgenisligi=350;
			$resimyuksekligi=350;
		}

		$bankalogoyukle	=	new upload($gelenbannerresmi, "tr-TR");
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
				header("Location:index.php?SKD=0&SKI=40");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=41");
				exit();
			} 
		}
	}else{
		header("Location:index.php?SKD=0&SKI=41");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=41");
	exit();
}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>