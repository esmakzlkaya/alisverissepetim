<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["urunmenusu"])){
		$gelenurunmenusu=Guvenlik($_POST["urunmenusu"]);	
	}else{
		$gelenurunmenusu="";
	}
	if(isset($_POST["urunadi"])){
		$gelenurunadi=Guvenlik($_POST["urunadi"]);	
	}else{
		$gelenurunadi="";
	}
	if(isset($_POST["urunfiyati"])){
		$gelenurunfiyati=Guvenlik($_POST["urunfiyati"]);	
	}else{
		$gelenurunfiyati="";
	}
	if(isset($_POST["parabirimi"])){
		$gelenparabirimi=Guvenlik($_POST["parabirimi"]);	
	}else{
		$gelenparabirimi="";
	}
	if(isset($_POST["kdvorani"])){
		$gelenkdvorani=Guvenlik($_POST["kdvorani"]);	
	}else{
		$gelenkdvorani="";
	}
	if(isset($_POST["kargoucreti"])){
		$gelenkargoucreti=Guvenlik($_POST["kargoucreti"]);	
	}else{
		$gelenkargoucreti="";
	}
	if(isset($_POST["urunaciklamasi"])){
		$gelenurunaciklamasi=Guvenlik($_POST["urunaciklamasi"]);	
	}else{
		$gelenurunaciklamasi="";
	}
	if(isset($_POST["urunvaryant"])){
		$gelenurunvaryant=Guvenlik($_POST["urunvaryant"]);	
	}else{
		$gelenurunvaryant="";
	}
	if(isset($_POST["varyantadi1"])){
		$gelenvaryantadi1=Guvenlik($_POST["varyantadi1"]);	
	}else{
		$gelenvaryantadi1="";
	}
	if(isset($_POST["stokadedi1"])){
		$gelenstokadedi1=Guvenlik($_POST["stokadedi1"]);	
	}else{
		$gelenstokadedi1="";
	}
	if(isset($_POST["varyantadi2"])){
		$gelenvaryantadi2=Guvenlik($_POST["varyantadi2"]);	
	}else{
		$gelenvaryantadi2="";
	}
	if(isset($_POST["stokadedi2"])){
		$gelenstokadedi2=Guvenlik($_POST["stokadedi2"]);	
	}else{
		$gelenstokadedi2="";
	}
	if(isset($_POST["varyantadi3"])){
		$gelenvaryantadi3=Guvenlik($_POST["varyantadi3"]);	
	}else{
		$gelenvaryantadi3="";
	}
	if(isset($_POST["stokadedi3"])){
		$gelenstokadedi3=Guvenlik($_POST["stokadedi3"]);	
	}else{
		$gelenstokadedi3="";
	}
	if(isset($_POST["varyantadi4"])){
		$gelenvaryantadi4=Guvenlik($_POST["varyantadi4"]);	
	}else{
		$gelenvaryantadi4="";
	}
	if(isset($_POST["stokadedi4"])){
		$gelenstokadedi4=Guvenlik($_POST["stokadedi4"]);	
	}else{
		$gelenstokadedi4="";
	}
	if(isset($_POST["varyantadi5"])){
		$gelenvaryantadi5=Guvenlik($_POST["varyantadi5"]);	
	}else{
		$gelenvaryantadi5="";
	}
	if(isset($_POST["stokadedi5"])){
		$gelenstokadedi5=Guvenlik($_POST["stokadedi5"]);	
	}else{
		$gelenstokadedi5="";
	}
	if(isset($_POST["varyantadi6"])){
		$gelenvaryantadi6=Guvenlik($_POST["varyantadi6"]);	
	}else{
		$gelenvaryantadi6="";
	}
	if(isset($_POST["stokadedi6"])){
		$gelenstokadedi6=Guvenlik($_POST["stokadedi6"]);	
	}else{
		$gelenstokadedi6="";
	}
	if(isset($_POST["varyantadi7"])){
		$gelenvaryantadi7=Guvenlik($_POST["varyantadi7"]);	
	}else{
		$gelenvaryantadi7="";
	}
	if(isset($_POST["stokadedi7"])){
		$gelenstokadedi7=Guvenlik($_POST["stokadedi7"]);	
	}else{
		$gelenstokadedi7="";
	}
	if(isset($_POST["varyantadi8"])){
		$gelenvaryantadi8=Guvenlik($_POST["varyantadi8"]);	
	}else{
		$gelenvaryantadi8="";
	}
	if(isset($_POST["stokadedi8"])){
		$gelenstokadedi8=Guvenlik($_POST["stokadedi8"]);	
	}else{
		$gelenstokadedi8="";
	}
	if(isset($_POST["varyantadi9"])){
		$gelenvaryantadi9=Guvenlik($_POST["varyantadi9"]);	
	}else{
		$gelenvaryantadi9="";
	}
	if(isset($_POST["stokadedi9"])){
		$gelenstokadedi9=Guvenlik($_POST["stokadedi9"]);	
	}else{
		$gelenstokadedi9="";
	}
	if(isset($_POST["varyantadi10"])){
		$gelenvaryantadi10=Guvenlik($_POST["varyantadi10"]);	
	}else{
		$gelenvaryantadi10="";
	}
	if(isset($_POST["stokadedi10"])){
		$gelenstokadedi10=Guvenlik($_POST["stokadedi10"]);	
	}else{
		$gelenstokadedi10="";
	}

	$gelenresimbir=$_FILES["resimbir"];
	$gelenresimiki=$_FILES["resimiki"];
	$gelenresimuc=$_FILES["resimuc"];
	$gelenresimdort=$_FILES["resimdort"];

	if(($gelenresimbir["name"]!="") and ($gelenresimbir["type"]!="") and($gelenresimbir["tmp_name"]!="") and
		($gelenresimbir["error"]==0) and ($gelenresimbir["size"]>0) and ($gelenurunmenusu !="") and ($gelenurunadi !="")
		and ($gelenurunfiyati !="") and ($gelenparabirimi !="") and ($gelenkdvorani !="") and ($gelenkargoucreti !="")
		and($gelenurunaciklamasi !="") and ($gelenurunvaryant !="") and ($gelenvaryantadi1 !="") and ($gelenstokadedi1 !="")){

		$menuturuSorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
	$menuturuSorgusu->execute([$gelenurunmenusu]);
	$menuturukontrol=$menuturuSorgusu->rowCount();
	$menuler=$menuturuSorgusu->fetch(PDO::FETCH_ASSOC);

	if ($menuturukontrol>0) {

		$gelenurunturu=$menuler["urunturu"];
		if ($gelenurunturu=="Çocuk Ayakkabısı") {
			$urunresmiklasoru="Cocuk";
		}elseif($gelenurunturu=="Kadın Ayakkabısı"){
			$urunresmiklasoru="Kadin";
		}elseif($gelenurunturu=="Erkek"){
			$urunresmiklasoru="Erkek";
		}

		$birinciResimicinDosyaAdi= resimadiolustur();
		$gelenbirinciresminuzantisi=substr($gelenresimbir["name"],-4);

		if ($gelenbirinciresminuzantisi=="jpeg") {
			$gelenbirinciresminuzantisi=".".$gelenbirinciresminuzantisi;
		}

		$birinciresimyenidosyaadi=$birinciResimicinDosyaAdi.$gelenbirinciresminuzantisi;

		$urunlerekleSorgusu=$DBConnection->prepare("INSERT INTO urunler (menuid,urunturu,urunadi, urunfiyati,parabirimi,kdvorani,urunaciklamasi,resimbir,varyantbasligi, durumu, kargoucreti) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$urunlerekleSorgusu->execute([$gelenurunmenusu,$gelenurunturu,$gelenurunadi, $gelenurunfiyati, $gelenparabirimi,$gelenkdvorani,$gelenurunaciklamasi,$birinciresimyenidosyaadi,$gelenurunvaryant,1,$gelenkargoucreti]);
		$urunlersayisi=$urunlerekleSorgusu->rowCount();
		if ($urunlersayisi>0) {
			$soneklenenurunidsi=$DBConnection->lastInsertId();

			$urunresimbiryukle	=	new upload($gelenresimbir, "tr-TR");
			if($urunresimbiryukle->uploaded){
				$urunresimbiryukle->mime_magic_check		=	true;
				$urunresimbiryukle->allowed				=	array("image/*");
				$urunresimbiryukle->file_new_name_body		=	$birinciResimicinDosyaAdi;
				$urunresimbiryukle->file_overwrite			=	true;
			//$urunresimbiryukle->image_convert			=	"png";
				$urunresimbiryukle->image_quality			=	100;
				$urunresimbiryukle->image_background_color	="#FFFFFF";
				$urunresimbiryukle->image_resize			=	true;
				$urunresimbiryukle->image_ratio=true;
				$urunresimbiryukle->image_y				=	600;
				$urunresimbiryukle->image_x				=	800;
				$urunresimbiryukle->process($verotiUrunResimcinklasoryolu.$urunresmiklasoru);

				if($urunresimbiryukle->processed){
					$urunresimbiryukle->clean();
				}else{
					echo "1";
					die();
					header("Location:index.php?SKD=0&SKI=98");
					exit();
				} 
			}

			$menuGuncelleSorgusu=$DBConnection->prepare("UPDATE menuler SET urunsayisi=urunsayisi+1 WHERE id=? LIMIT 1");
			$menuGuncelleSorgusu->execute([$gelenurunmenusu]);
			$menuguncellesayisi=$menuGuncelleSorgusu->rowCount();	
			if ($menuguncellesayisi>0) {
				
				$BirincivaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
				$BirincivaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi1,$gelenstokadedi1]);
				$birincivaryantsayisi=$BirincivaryantekleSorgusu->rowCount();
				if ($birincivaryantsayisi>0) {
					if (($gelenvaryantadi2!="")and($gelenstokadedi2!="")) {
						$ikivaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$ikivaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi2,$gelenstokadedi2]);
					}
					if (($gelenvaryantadi3!="")and($gelenstokadedi3!="")) {
						$ucvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$ucvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi3,$gelenstokadedi3]);
					}
					if (($gelenvaryantadi4!="")and($gelenstokadedi4!="")) {
						$dortvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$dortvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi4,$gelenstokadedi4]);
					}
					if (($gelenvaryantadi5!="")and($gelenstokadedi5!="")) {
						$besvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$besvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi5,$gelenstokadedi5]);
					}
					if (($gelenvaryantadi6!="")and($gelenstokadedi6!="")) {
						$altivaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$altivaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi6,$gelenstokadedi6]);
					}
					if (($gelenvaryantadi7!="")and($gelenstokadedi7!="")) {
						$yedivaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$yedivaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi7,$gelenstokadedi7]);
					}
					if (($gelenvaryantadi8!="")and($gelenstokadedi8!="")) {
						$sekizvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$sekizvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi8,$gelenstokadedi8]);
					}
					if (($gelenvaryantadi9!="")and($gelenstokadedi9!="")) {
						$dokuzvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$dokuzvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi9,$gelenstokadedi9]);
					}
					if (($gelenvaryantadi10!="")and($gelenstokadedi10!="")) {
						$onvaryantekleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$onvaryantekleSorgusu->execute([$soneklenenurunidsi,$gelenvaryantadi10,$gelenstokadedi10]);
					}
					if (($gelenresimiki["name"]!="") and ($gelenresimiki["type"]!="") and($gelenresimiki["tmp_name"]!="") and ($gelenresimiki["error"]==0) and ($gelenresimiki["size"]>0)) {
						
						$ikiResimicinDosyaAdi= resimadiolustur();
						$gelenikinciresminuzantisi=substr($gelenresimiki["name"],-4);

						if ($gelenikinciresminuzantisi=="jpeg") {
							$gelenikinciresminuzantisi=".".$gelenikinciresminuzantisi;
						}

						$ikiresimyenidosyaadi=$ikiResimicinDosyaAdi.$gelenikinciresminuzantisi;

						$urunresimikiyukle	=	new upload($gelenresimiki, "tr-TR");
						if($urunresimikiyukle->uploaded){
							$urunresimikiyukle->mime_magic_check		=	true;
							$urunresimikiyukle->allowed				=	array("image/*");
							$urunresimikiyukle->file_new_name_body		=	$ikiResimicinDosyaAdi;
							$urunresimikiyukle->file_overwrite			=	true;
			//$urunresimbiryukle->image_convert			=	"png";
							$urunresimikiyukle->image_quality			=	100;
							$urunresimikiyukle->image_background_color	="#FFFFFF";
							$urunresimikiyukle->image_resize			=	true;
							$urunresimikiyukle->image_ratio=true;
							$urunresimikiyukle->image_y				=	600;
							$urunresimikiyukle->image_x				=	800;
							$urunresimikiyukle->process($verotiUrunResimcinklasoryolu.$urunresmiklasoru);

							if($urunresimikiyukle->processed){
								$menuGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimiki=? WHERE id=? LIMIT 1");
								$menuGuncelleSorgusu->execute([$ikiresimyenidosyaadi,$soneklenenurunidsi]);
								$urunresimikiyukle->clean();
							}
						}
					}
					if (($gelenresimiki["name"]!="") and ($gelenresimiki["type"]!="") and($gelenresimiki["tmp_name"]!="") and ($gelenresimiki["error"]==0) and ($gelenresimiki["size"]>0)) {
						
						$ikiResimicinDosyaAdi= resimadiolustur();
						$gelenikinciresminuzantisi=substr($gelenresimiki["name"],-4);

						if ($gelenikinciresminuzantisi=="jpeg") {
							$gelenikinciresminuzantisi=".".$gelenikinciresminuzantisi;
						}

						$ikiresimyenidosyaadi=$ikiResimicinDosyaAdi.$gelenikinciresminuzantisi;

						$urunresimikiyukle	=	new upload($gelenresimiki, "tr-TR");
						if($urunresimikiyukle->uploaded){
							$urunresimikiyukle->mime_magic_check		=	true;
							$urunresimikiyukle->allowed				=	array("image/*");
							$urunresimikiyukle->file_new_name_body		=	$ikiResimicinDosyaAdi;
							$urunresimikiyukle->file_overwrite			=	true;
			//$urunresimbiryukle->image_convert			=	"png";
							$urunresimikiyukle->image_quality			=	100;
							$urunresimikiyukle->image_background_color	="#FFFFFF";
							$urunresimikiyukle->image_resize			=	true;
							$urunresimikiyukle->image_ratio=true;
							$urunresimikiyukle->image_y				=	600;
							$urunresimikiyukle->image_x				=	800;
							$urunresimikiyukle->process($verotiUrunResimcinklasoryolu.$urunresmiklasoru);

							if($urunresimikiyukle->processed){
								$ikimenuGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimiki=? WHERE id=? LIMIT 1");
								$ikimenuGuncelleSorgusu->execute([$ikiresimyenidosyaadi,$soneklenenurunidsi]);
								$urunresimikiyukle->clean();
							}
						}
					}
					if (($gelenresimuc["name"]!="") and ($gelenresimuc["type"]!="") and($gelenresimuc["tmp_name"]!="") and ($gelenresimuc["error"]==0) and ($gelenresimuc["size"]>0)) {
						
						$ucResimicinDosyaAdi= resimadiolustur();
						$gelenucuncuresminuzantisi=substr($gelenresimuc["name"],-4);

						if ($gelenucuncuresminuzantisi=="jpeg") {
							$gelenucuncuresminuzantisi=".".$gelenucuncuresminuzantisi;
						}
						$ucresimyenidosyaadi=$ucResimicinDosyaAdi.$gelenucuncuresminuzantisi;

						$urunresimucyukle	=	new upload($gelenresimuc, "tr-TR");
						if($urunresimucyukle->uploaded){
							$urunresimucyukle->mime_magic_check		=	true;
							$urunresimucyukle->allowed				=	array("image/*");
							$urunresimucyukle->file_new_name_body		=	$ucResimicinDosyaAdi;
							$urunresimucyukle->file_overwrite			=	true;
			//$urunresimbiryukle->image_convert			=	"png";
							$urunresimucyukle->image_quality			=	100;
							$urunresimucyukle->image_background_color	="#FFFFFF";
							$urunresimucyukle->image_resize			=	true;
							$urunresimucyukle->image_ratio=true;
							$urunresimucyukle->image_y				=	600;
							$urunresimucyukle->image_x				=	800;
							$urunresimucyukle->process($verotiUrunResimcinklasoryolu.$urunresmiklasoru);

							if($urunresimucyukle->processed){
								$ucmenuGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimuc=? WHERE id=? LIMIT 1");
								$ucmenuGuncelleSorgusu->execute([$ucresimyenidosyaadi,$soneklenenurunidsi]);
								$urunresimucyukle->clean();
							}
						}
					}
					if (($gelenresimdort["name"]!="") and ($gelenresimdort["type"]!="") and($gelenresimdort["tmp_name"]!="") and ($gelenresimdort["error"]==0) and ($gelenresimdort["size"]>0)) {
						
						$dortResimicinDosyaAdi= resimadiolustur();
						$gelendorduncuresminuzantisi=substr($gelenresimdort["name"],-4);

						if ($gelendorduncuresminuzantisi=="jpeg") {
							$gelendorduncuresminuzantisi=".".$gelendorduncuresminuzantisi;
						}

						$dortresimyenidosyaadi=$dortResimicinDosyaAdi.$gelendorduncuresminuzantisi;

						$urunresimdortyukle	=	new upload($gelenresimdort, "tr-TR");
						if($urunresimdortyukle->uploaded){
							$urunresimdortyukle->mime_magic_check		=	true;
							$urunresimdortyukle->allowed				=	array("image/*");
							$urunresimdortyukle->file_new_name_body		=	$dortResimicinDosyaAdi;
							$urunresimdortyukle->file_overwrite			=	true;
			//$urunresimbiryukle->image_convert			=	"png";
							$urunresimdortyukle->image_quality			=	100;
							$urunresimdortyukle->image_background_color	="#FFFFFF";
							$urunresimdortyukle->image_resize			=	true;
							$urunresimdortyukle->image_ratio=true;
							$urunresimdortyukle->image_y				=	600;
							$urunresimdortyukle->image_x				=	800;
							$urunresimdortyukle->process($verotiUrunResimcinklasoryolu.$urunresmiklasoru);

							if($urunresimdortyukle->processed){
								$dortmenuGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimdort=? WHERE id=? LIMIT 1");
								$dortmenuGuncelleSorgusu->execute([$dortresimyenidosyaadi,$soneklenenurunidsi]);
								$urunresimdortyukle->clean();
							}
						}
					}

				}else{
					header("Location:index.php?SKD=0&SKI=98");
					exit();
				}


			}else{
				header("Location:index.php?SKD=0&SKI=98");
				exit();
			}

			header("Location:index.php?SKD=0&SKI=97");
			exit();
		}else{
			header("Location:index.php?SKD=0&SKI=98");
			exit();
		}
	}
	else{
		header("Location:index.php?SKD=0&SKI=98");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=98");
	exit();
}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>