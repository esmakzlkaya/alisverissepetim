<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenkargoid=Guvenlik($_GET["id"]);
	}else{
		$gelenkargoid="";
	}
	if(isset($_POST["kargofirmasiadi"])){
		$gelenkargofirmasiadi=Guvenlik($_POST["kargofirmasiadi"]);	
	}else{
		$gelenkargofirmasiadi="";
	}

	$gelenkargologosu=$_FILES["kargofirmasilogosu"];

	if(($gelenkargofirmasiadi !="")){

		$kargoguncelleSorgusu=$DBConnection->prepare("UPDATE kargofirmalari SET kargofirmasiadi=? WHERE id=? LIMIT 1");
		$kargoguncelleSorgusu->execute([$gelenkargofirmasiadi,$gelenkargoid]);
		$kargosayisi=$kargoguncelleSorgusu->rowCount();

		if(($gelenkargologosu["name"]!="") and ($gelenkargologosu["type"]!="") and
			($gelenkargologosu["tmp_name"]!="") and ($gelenkargologosu["error"]==0) and 
			($gelenkargologosu["size"]>0)){

			$kargologosorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
		$kargologosorgusu->execute([$gelenkargoid]);
		$logokontrol=$kargologosorgusu->rowCount();
		$kargofirmasilogosu=$kargologosorgusu->fetch(PDO::FETCH_ASSOC);

		$silinecekdosyayolu="../Resimler/".$kargofirmasilogosu["kargofirmasilogosu"];

		unlink($silinecekdosyayolu);

		$yeniresimadiolustur= resimadiolustur();
		$gelenresminuzantisi=substr($gelenkargologosu["name"],-4);

		if ($gelenresminuzantisi=="jpeg") {
			$gelenresminuzantisi=".".$gelenresminuzantisi;
		}

		$yenidosyaadi=$yeniresimadiolustur.$gelenresminuzantisi;

		$kargologoyukle	=	new upload($gelenkargologosu, "tr-TR");
		if($kargologoyukle->uploaded){

			$kargologoyukle->mime_magic_check		=	true;
			$kargologoyukle->allowed				=	array("image/*");
			$kargologoyukle->file_new_name_body		=	$yeniresimadiolustur;
			$kargologoyukle->file_overwrite			=	true;
			//$kargologoyukle->image_convert			=	"png";
			$kargologoyukle->image_quality			=	100;
			$kargologoyukle->image_background_color	="#FFFFFF";
			$kargologoyukle->image_resize			=	true;
			$bankalogoyukle->image_ratio=true;
			$kargologoyukle->image_y				=	35;
			$kargologoyukle->process($veroticinklasoryolu);

			if($kargologoyukle->processed){
				$kargologoguncelleSorgusu=$DBConnection->prepare("UPDATE kargofirmalari SET kargofirmasilogosu=? WHERE id=? LIMIT 1");
				$kargologoguncelleSorgusu->execute([$yenidosyaadi,$gelenkargoid]);
				$kargologosayisi=$kargologoguncelleSorgusu->rowCount();
				if ($kargologosayisi<1) {
					header("Location:index.php?SKD=0&SKI=29");
					exit();	
				}
				$kargologoyukle->clean();
			}else{
				header("Location:index.php?SKD=0&SKI=29");
				exit();
			} 
		}
	}
	if (($kargosayisi>0) or ($kargologosayisi>0)) {
		header("Location:index.php?SKD=0&SKI=28");
		exit();
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