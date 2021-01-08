<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenbannerid=Guvenlik($_GET["id"]);
	}else{
		$gelenbannerid="";
	}
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

	if(($gelenbannerid !="") and ($gelenbanneradi !="") and ($gelenbanneralani !="")){

		$bannerresimsorgusu=$DBConnection->prepare("SELECT * FROM bannerlar WHERE id=? LIMIT 1");
		$bannerresimsorgusu->execute([$gelenbannerid]);
		$bannerresim=$bannerresimsorgusu->rowCount();
		$bannerresimleri=$bannerresimsorgusu->fetch(PDO::FETCH_ASSOC);

		if ($gelenbanneralani==$bannerresimleri["banneralani"]) {

			$bannerguncelleSorgusu=$DBConnection->prepare("UPDATE bannerlar SET banneralani=?, banneradi=? WHERE id=? LIMIT 1");
			$bannerguncelleSorgusu->execute([$gelenbanneralani,$gelenbanneradi,$gelenbannerid]);
			$bannerguncellesayisi=$bannerguncelleSorgusu->rowCount();

			if(($gelenbannerresmi["name"]!="") and ($gelenbannerresmi["type"]!="") and
				($gelenbannerresmi["tmp_name"]!="") and ($gelenbannerresmi["error"]==0) and 
				($gelenbannerresmi["size"]>0)){

				$silinecekdosyayolu="../Resimler/".$bannerresimleri["bannerresmi"];

			unlink($silinecekdosyayolu);

			$yeniresimadiolustur= resimadiolustur();
			$gelenresminuzantisi=substr($gelenbannerresmi["name"],-4);

			if ($gelenresminuzantisi=="jpeg") {
				$gelenresminuzantisi=".".$gelenresminuzantisi;
			}

			$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

			if ($gelenbanneralani=="Anasayfa") {
				$resimgenisligi=1065;
				$resimyuksekligi=186;
			}
			elseif ($gelenbanneralani=="Menü Altı") {
				$resimgenisligi=250;
				$resimyuksekligi=500;
			}elseif ($gelenbanneralani=="Ürün Detay") {
				$resimgenisligi=350;
				$resimyuksekligi=350;
			}

			$bannerresimyukle	=	new upload($gelenbannerresmi, "tr-TR");
			if($bannerresimyukle->uploaded){

				$bannerresimyukle->mime_magic_check		=	true;
				$bannerresimyukle->allowed				=	array("image/*");
				$bannerresimyukle->file_new_name_body		=	$yeniresimadiolustur;
				$bannerresimyukle->file_overwrite			=	true;
				$bannerresimyukle->image_quality			=	100;
				$bannerresimyukle->image_background_color	="#FFFFFF";
				$bannerresimyukle->image_resize			=	true;
				$bankalogoyukle->image_ratio=true;
				$bannerresimyukle->image_x				=	$resimgenisligi;
				$bannerresimyukle->image_y				=	$resimyuksekligi;
				$bannerresimyukle->process($veroticinklasoryolu);

				if($bannerresimyukle->processed){
					$bannerresmiguncelleSorgusu=$DBConnection->prepare("UPDATE bannerlar SET bannerresmi=? WHERE id=? LIMIT 1");
					$bannerresmiguncelleSorgusu->execute([$yenidosyaadi,$gelenbannerid]);
					$bannerresimguncellesayisi=$bannerresmiguncelleSorgusu->rowCount();
					if ($bannerresimguncellesayisi<1) {
						header("Location:index.php?SKD=0&SKI=41");
						exit();	
					}
					$bannerresimyukle->clean();
				}else{
					header("Location:index.php?SKD=0&SKI=41");
					exit();
				} 
			}
		}
		if (($bannerguncellesayisi>0) or ($bannerresimguncellesayisi>0)) {
			header("Location:index.php?SKD=0&SKI=40");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=41");
			exit();
		}
	}else{ ///resmin yalnızca alanı değiştiriliyorsa resim boyutları güncellenip resim güncelleniyor

		if(($gelenbannerresmi["name"]!="") and ($gelenbannerresmi["type"]!="") and($gelenbannerresmi["tmp_name"]!="") and ($gelenbannerresmi["error"]==0) and ($gelenbannerresmi["size"]>0)){
			$silinecekdosyayolu="../Resimler/".$bannerresimleri["bannerresmi"];

			unlink($silinecekdosyayolu);

			$yeniresimadiolustur= resimadiolustur();
			$gelenresminuzantisi=substr($gelenbannerresmi["name"],-4);

			if ($gelenresminuzantisi=="jpeg") {
				$gelenresminuzantisi=".".$gelenresminuzantisi;
			}

			$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

			if ($gelenbanneralani=="Anasayfa") {
				$resimgenisligi=1065;
				$resimyuksekligi=186;
			}
			elseif ($gelenbanneralani=="Menü Altı") {
				$resimgenisligi=250;
				$resimyuksekligi=500;
			}elseif ($gelenbanneralani=="Ürün Detay") {
				$resimgenisligi=350;
				$resimyuksekligi=350;
			}

			$bannerresimyukle	=	new upload($gelenbannerresmi, "tr-TR");
			if($bannerresimyukle->uploaded){

				$bannerresimyukle->mime_magic_check		=	true;
				$bannerresimyukle->allowed				=	array("image/*");
				$bannerresimyukle->file_new_name_body		=	$yeniresimadiolustur;
				$bannerresimyukle->file_overwrite			=	true;
			//$bannerresimyukle->image_convert			=	"png";
				$bannerresimyukle->image_quality			=	100;
				$bannerresimyukle->image_background_color	="#FFFFFF";
				$bannerresimyukle->image_resize			=	true;
				$bankalogoyukle->image_ratio=true;
				$bannerresimyukle->image_x				=	$resimgenisligi;
				$bannerresimyukle->image_y				=	$resimyuksekligi;
				$bannerresimyukle->process($veroticinklasoryolu);

				if($bannerresimyukle->processed){
					$bannerresmiguncelleSorgusu=$DBConnection->prepare("UPDATE bannerlar SET banneralani=?,banneradi=?,bannerresmi=? WHERE id=? LIMIT 1");
					$bannerresmiguncelleSorgusu->execute([$gelenbanneralani,$gelenbanneradi,$yenidosyaadi,$gelenbannerid]);
					$bannerresimguncellesayisi=$bannerresmiguncelleSorgusu->rowCount();
					header("Location:index.php?SKD=0&SKI=40");
					exit();	

					if ($bannerresimguncellesayisi<1) {
						header("Location:index.php?SKD=0&SKI=41");
						exit();	
					}
					$bannerresimyukle->clean();
				}else{
					header("Location:index.php?SKD=0&SKI=41");
					exit();
				} 
			}
		}else{
			header("Location:index.php?SKD=0&SKI=41");
			exit();
		} 
		if (($bannerguncellesayisi>0) or ($bannerresimguncellesayisi>0)) {
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
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>