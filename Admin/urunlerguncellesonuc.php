<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}
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
	
	if(($gelenurunmenusu !="") and ($gelenurunadi !="") and ($gelenurunfiyati !="") and ($gelenparabirimi !="") and ($gelenkdvorani !="") and ($gelenkargoucreti !="") and($gelenurunaciklamasi !="") and ($gelenurunvaryant !="") and ($gelenvaryantadi1 !="") and ($gelenstokadedi1 !="")){

		$urunlerSorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
		$urunlerSorgusu->execute([$gelenid]);
		$urunKontrol=$urunlerSorgusu->rowCount();
		$urunler=$urunlerSorgusu->fetch(PDO::FETCH_ASSOC);
		if ($urunKontrol>0) {

			$menuturuSorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
			$menuturuSorgusu->execute([$gelenurunmenusu]);
			$menuturukontrol=$menuturuSorgusu->rowCount();
			$menuler=$menuturuSorgusu->fetch(PDO::FETCH_ASSOC);

			$gelenurunturu=$menuler["urunturu"];
			if($menuler["urunturu"] == "Erkek Ayakkabısı"){
				$urunresmiklasoru	=	"UrunResimleri/Erkek/";
			}elseif($menuler["urunturu"] == "Kadın Ayakkabısı"){
				$urunresmiklasoru	=	"UrunResimleri/Kadin/";
			}elseif($menuler["urunturu"] == "Çocuk Ayakkabısı"){
				$urunresmiklasoru	=	"UrunResimleri/Cocuk/";
			}
			if ($menuturukontrol>0) {


				$urunlerguncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET menuid=?,urunadi=?, urunfiyati=?,parabirimi=?,kdvorani=?,urunaciklamasi=?,varyantbasligi=?, kargoucreti=? WHERE id=? LIMIT 1");
				$urunlerguncelleSorgusu->execute([$gelenurunmenusu,$gelenurunadi, $gelenurunfiyati, $gelenparabirimi,$gelenkdvorani,$gelenurunaciklamasi,$gelenurunvaryant,$gelenkargoucreti,$gelenid]);
				$urunlerGuncelleSayisi=$urunlerguncelleSorgusu->rowCount();
				

				if (($gelenresimbir["name"]!="") and ($gelenresimbir["type"]!="") and($gelenresimbir["tmp_name"]!="") and ($gelenresimbir["error"]==0) and ($gelenresimbir["size"]>0)) {

					$birResimicinDosyaAdi= resimadiolustur();
					$gelenbirinciresminuzantisi=substr($gelenresimbir["name"],-4);

					if ($gelenbirinciresminuzantisi=="jpeg") {
						$gelenbirinciresminuzantisi=".".$gelenbirinciresminuzantisi;
					}

					$birresimyenidosyaadi=$birResimicinDosyaAdi.$gelenbirinciresminuzantisi;

					$urunresimbiryukle	=	new upload($gelenresimbir, "tr-TR");
					if($urunresimbiryukle->uploaded){
						$urunresimbiryukle->mime_magic_check		=	true;
						$urunresimbiryukle->allowed				=	array("image/*");
						$urunresimbiryukle->file_new_name_body		=	$birResimicinDosyaAdi;
						$urunresimbiryukle->file_overwrite			=	true;

						$urunresimbiryukle->image_quality			=	100;
						$urunresimbiryukle->image_background_color	="#FFFFFF";
						$urunresimbiryukle->image_resize			=	true;
						$urunresimbiryukle->image_ratio=true;
						$urunresimbiryukle->image_y				=	600;
						$urunresimbiryukle->image_x				=	800;
						$urunresimbiryukle->process($veroticinklasoryolu.$urunresmiklasoru);

						if($urunresimbiryukle->processed){
							$silinecekdosyayolu2="../Resimler/".$urunresmiklasoru.$urunler["resimbir"];
							unlink($silinecekdosyayolu2);

							$resimbirGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimbir=? WHERE id=? LIMIT 1");
							$resimbirGuncelleSorgusu->execute([$birresimyenidosyaadi,$gelenid]);
							$resimbirGuncelleKontrol=$resimbirGuncelleSorgusu->rowCount();
							if ($resimbirGuncelleKontrol<1) {
								echo "x1";
							//	die();
								header("Location:index.php?SKD=0&SKI=102");
								exit();
							}
							$urunresimbiryukle->clean();
						}else{
							echo "y1";
							//die();
							header("Location:index.php?SKD=0&SKI=102");
							exit();
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

						$urunresimikiyukle->image_quality			=	100;
						$urunresimikiyukle->image_background_color	="#FFFFFF";
						$urunresimikiyukle->image_resize			=	true;
						$urunresimikiyukle->image_ratio=true;
						$urunresimikiyukle->image_y				=	600;
						$urunresimikiyukle->image_x				=	800;
						$urunresimikiyukle->process($veroticinklasoryolu.$urunresmiklasoru);

						if($urunresimikiyukle->processed){
							$silinecekdosyayolu1="../Resimler/".$urunresmiklasoru.$urunler["resimiki"];
							unlink($silinecekdosyayolu1);

							$resimikiGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimiki=? WHERE id=? LIMIT 1");
							$resimikiGuncelleSorgusu->execute([$ikiresimyenidosyaadi,$gelenid]);
							$resimikiGuncelleKontrol=$resimikiGuncelleSorgusu->rowCount();
							if ($resimikiGuncelleKontrol<1) {
								echo "x2";
							//	die();
								header("Location:index.php?SKD=0&SKI=102");
								exit();
							}
							$urunresimikiyukle->clean();
						}else{
							echo "y2";
							//die();
							header("Location:index.php?SKD=0&SKI=102");
							exit();
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

						$urunresimucyukle->image_quality			=	100;
						$urunresimucyukle->image_background_color	="#FFFFFF";
						$urunresimucyukle->image_resize			=	true;
						$urunresimucyukle->image_ratio=true;
						$urunresimucyukle->image_y				=	600;
						$urunresimucyukle->image_x				=	800;
						$urunresimucyukle->process($veroticinklasoryolu.$urunresmiklasoru);

						if($urunresimucyukle->processed){
							$silinecekdosyayolu3="../Resimler/".$urunresmiklasoru.$urunler["resimuc"];
							unlink($silinecekdosyayolu3);

							$resimucGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimuc=? WHERE id=? LIMIT 1");
							$resimucGuncelleSorgusu->execute([$ucresimyenidosyaadi,$gelenid]);
							$resimucGuncelleKontrol=$resimucGuncelleSorgusu->rowCount();
							if ($resimucGuncelleKontrol<1) {
								echo "x3";
							//	die();
								header("Location:index.php?SKD=0&SKI=102");
								exit();
							}
							$urunresimucyukle->clean();
						}else{
							echo "y3";
							//die();
							header("Location:index.php?SKD=0&SKI=102");
							exit();
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

						$urunresimdortyukle->image_quality			=	100;
						$urunresimdortyukle->image_background_color	="#FFFFFF";
						$urunresimdortyukle->image_resize			=	true;
						$urunresimdortyukle->image_ratio=true;
						$urunresimdortyukle->image_y				=	600;
						$urunresimdortyukle->image_x				=	800;
						$urunresimdortyukle->process($veroticinklasoryolu.$urunresmiklasoru);

						if($urunresimdortyukle->processed){
							$silinecekdosyayolu4="../Resimler/".$urunresmiklasoru.$urunler["resimdort"];
							unlink($silinecekdosyayolu4);

							$resimdortGuncelleSorgusu=$DBConnection->prepare("UPDATE urunler SET resimdort=? WHERE id=? LIMIT 1");
							$resimdortGuncelleSorgusu->execute([$dortresimyenidosyaadi,$gelenid]);
							$resimdortGuncelleKontrol=$resimdortGuncelleSorgusu->rowCount();
							if ($resimdortGuncelleKontrol<1) {
								echo "x4";
								//die();
								header("Location:index.php?SKD=0&SKI=102");
								exit();
							}
							$urunresimdortyukle->clean();
						}else{
							echo "y4";
							//die();
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				$urunVaryantSorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE urunid=?");
				$urunVaryantSorgusu->execute([$gelenid]);
				$urunVaryantSayisi=$urunVaryantSorgusu->rowCount();
				$urunVaryantkayit=$urunVaryantSorgusu->fetchAll(PDO::FETCH_ASSOC);

				$varyantisimdizisi[] =array();
				$varyanstokdizisi[] =array();

				foreach ($urunVaryantkayit as $urunvaryantkayitlari) {
					$varyantisimdizisi[]=$urunvaryantkayitlari["varyantadi"];
					$varyanstokdizisi[]=$urunvaryantkayitlari["stokadedi"];
				}
				$birincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[1]);
				$birincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[1]);

				//birinci varyant
				if (array_key_exists(1, $varyantisimdizisi)) {
					if (($gelenvaryantadi1!="")and ($gelenstokadedi1!="")) {
						$birinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?, stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$birinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi1,$gelenstokadedi1,$gelenid,$varyantisimdizisi[1]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}
				}	
				//ikinci varyant
				if (array_key_exists(2, $varyantisimdizisi)) {
					if (($gelenvaryantadi2!="")and ($gelenstokadedi2!="")) {
						$ikinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$ikinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi2,$gelenstokadedi2,$gelenid,$varyantisimdizisi[2]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$ikinciVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$ikinciVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[2]]);
						$ikinciVaryantSilmeKontrol=$ikinciVaryantSilmeSorgusu->rowCount();
						if ($ikinciVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi2!="")and ($gelenstokadedi2!="")) {
						$ikinciVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$ikinciVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi2,$gelenstokadedi2]);
						$ikinciVaryantEkleKontrol=$ikinciVaryantEkleSorgusu->rowCount();
						if ($ikinciVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//ucuncu varyant
				if (array_key_exists(3, $varyantisimdizisi)) {
					if (($gelenvaryantadi3!="")and ($gelenstokadedi3!="")) {
						$ucuncuVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$ucuncuVaryantGuncelleSorgusu->execute([$gelenvaryantadi3,$gelenstokadedi3,$gelenid,$varyantisimdizisi[3]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$ucuncuVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$ucuncuVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[3]]);
						$ucuncuVaryantSilmeKontrol=$ucuncuVaryantSilmeSorgusu->rowCount();
						if ($ucuncuVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi3!="")and ($gelenstokadedi3!="")) {
						$ucuncuVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$ucuncuVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi3,$gelenstokadedi3]);
						$ucuncuVaryantEkleKontrol=$ucuncuVaryantEkleSorgusu->rowCount();
						if ($ucuncuVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//dorduncu varyant
				if (array_key_exists(4, $varyantisimdizisi)) {
					if (($gelenvaryantadi4!="")and ($gelenstokadedi4!="")) {
						$dorduncuVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$dorduncuVaryantGuncelleSorgusu->execute([$gelenvaryantadi4,$gelenstokadedi4,$gelenid,$varyantisimdizisi[4]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$dorduncuVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$dorduncuVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[4]]);
						$dorduncuVaryantSilmeKontrol=$dorduncuVaryantSilmeSorgusu->rowCount();
						if ($dorduncuVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi4!="")and ($gelenstokadedi4!="")) {
						$dorduncuVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$dorduncuVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi4,$gelenstokadedi4]);
						$dorduncuVaryantEkleKontrol=$dorduncuVaryantEkleSorgusu->rowCount();
						if ($dorduncuVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}

				//besinci varyant
				if (array_key_exists(5, $varyantisimdizisi)) {
					if (($gelenvaryantadi5!="")and ($gelenstokadedi5!="")) {
						$besinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$besinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi5,$gelenstokadedi5,$gelenid,$varyantisimdizisi[5]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$besinciVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$besinciVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[5]]);
						$besinciVaryantSilmeKontrol=$besinciVaryantSilmeSorgusu->rowCount();
						if ($besinciVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi5!="")and ($gelenstokadedi5!="")) {
						$besinciVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$besinciVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi5,$gelenstokadedi5]);
						$besinciVaryantEkleKontrol=$besinciVaryantEkleSorgusu->rowCount();
						if ($besinciVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//altinci varyant
				if (array_key_exists(6, $varyantisimdizisi)) {
					if (($gelenvaryantadi6!="")and ($gelenstokadedi6!="")) {
						$altinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$altinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi6,$gelenstokadedi6,$gelenid,$varyantisimdizisi[6]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$altinciVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$altinciVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[6]]);
						$altinciVaryantSilmeKontrol=$altinciVaryantSilmeSorgusu->rowCount();
						if ($altinciVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi6!="")and ($gelenstokadedi6!="")) {
						$altinciVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$altinciVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi6,$gelenstokadedi6]);
						$altinciVaryantEkleKontrol=$altinciVaryantEkleSorgusu->rowCount();
						if ($altinciVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//yedinci varyant
				if (array_key_exists(7, $varyantisimdizisi)) {
					if (($gelenvaryantadi7!="")and ($gelenstokadedi7!="")) {
						$yedinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$yedinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi7,$gelenstokadedi7,$gelenid,$varyantisimdizisi[7]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$yedinciVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$yedinciVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[7]]);
						$yedinciVaryantSilmeKontrol=$yedinciVaryantSilmeSorgusu->rowCount();
						if ($yedinciVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi7!="")and ($gelenstokadedi7!="")) {
						$yedinciVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$yedinciVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi7,$gelenstokadedi7]);
						$yedinciVaryantEkleKontrol=$yedinciVaryantEkleSorgusu->rowCount();
						if ($yedinciVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//sekizinci varyant
				if (array_key_exists(8, $varyantisimdizisi)) {
					if (($gelenvaryantadi8!="")and ($gelenstokadedi8!="")) {
						$sekizinciVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$sekizinciVaryantGuncelleSorgusu->execute([$gelenvaryantadi8,$gelenstokadedi8,$gelenid,$varyantisimdizisi[8]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$sekizinciVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$sekizinciVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[8]]);
						$sekizinciVaryantSilmeKontrol=$sekizinciVaryantSilmeSorgusu->rowCount();
						if ($sekizinciVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi8!="")and ($gelenstokadedi8!="")) {
						$sekizinciVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$sekizinciVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi8,$gelenstokadedi8]);
						$sekizinciVaryantEkleKontrol=$sekizinciVaryantEkleSorgusu->rowCount();
						if ($sekizinciVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//dokuzuncu varyant
				if (array_key_exists(9, $varyantisimdizisi)) {
					if (($gelenvaryantadi9!="")and ($gelenstokadedi9!="")) {
						$dokuzuncuVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$dokuzuncuVaryantGuncelleSorgusu->execute([$gelenvaryantadi9,$gelenstokadedi9,$gelenid,$varyantisimdizisi[9]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$dokuzuncuVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$dokuzuncuVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[9]]);
						$dokuzuncuVaryantSilmeKontrol=$dokuzuncuVaryantSilmeSorgusu->rowCount();
						if ($dokuzuncuVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi9!="")and ($gelenstokadedi9!="")) {
						$dokuzuncuVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$dokuzuncuVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi9,$gelenstokadedi9]);
						$dokuzuncuVaryantEkleKontrol=$dokuzuncuVaryantEkleSorgusu->rowCount();
						if ($dokuzuncuVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				//onuncu varyant
				if (array_key_exists(10, $varyantisimdizisi)) {
					if (($gelenvaryantadi10!="")and ($gelenstokadedi10!="")) {
						$onuncuVaryantGuncelleSorgusu=$DBConnection->prepare("UPDATE urunvaryantlari SET varyantadi=?,stokadedi=? WHERE urunid=? AND varyantadi=? LIMIT 1");
						$onuncuVaryantGuncelleSorgusu->execute([$gelenvaryantadi10,$gelenstokadedi10,$gelenid,$varyantisimdizisi[10]]);
						//$birinciVaryantGuncelleKontrol=$birinciVaryantGuncelleSorgusu->rowCount();
					}else{
						$onuncuVaryantSilmeSorgusu=$DBConnection->prepare("DELETE FROM urunvaryantlari WHERE urunid=? AND varyantadi=? LIMIT 1");
						$onuncuVaryantSilmeSorgusu->execute([$gelenid,$varyantisimdizisi[10]]);
						$onuncuVaryantSilmeKontrol=$onuncuVaryantSilmeSorgusu->rowCount();
						if ($onuncuVaryantSilmeKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}else{
					if (($gelenvaryantadi10!="")and ($gelenstokadedi10!="")) {
						$onuncuVaryantEkleSorgusu=$DBConnection->prepare("INSERT INTO urunvaryantlari (urunid,varyantadi,stokadedi) VALUES (?,?,?)");
						$onuncuVaryantEkleSorgusu->execute([$gelenid,$gelenvaryantadi10,$gelenstokadedi10]);
						$onuncuVaryantEkleKontrol=$onuncuVaryantEkleSorgusu->rowCount();
						if ($onuncuVaryantEkleKontrol<1) {
							header("Location:index.php?SKD=0&SKI=102");
							exit();
						}
					}
				}
				header("Location:index.php?SKD=0&SKI=101");
				exit();
			}else{
				header("Location:index.php?SKD=0&SKI=102");
				exit();
			}
		}else{
			header("Location:index.php?SKD=0&SKI=102");
			exit();
		}
	}else{
		header("Location:index.php?SKD=0&SKI=102");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>