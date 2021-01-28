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
			echo $soneklenenurunidsi;
			die();


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
				


			}else{
				header("Location:index.php?SKD=0&SKI=98");
				exit();
			}

			header("Location:index.php?SKD=0&SKI=97");
			exit();
		}else{
			echo "2";
			die();
			header("Location:index.php?SKD=0&SKI=98");
			exit();
		}
	}
	else{
		echo "3";
		die();
		header("Location:index.php?SKD=0&SKI=98");
		exit();
	}
}else{
	echo "4";
	die();
	header("Location:index.php?SKD=0&SKI=98");
	exit();
}
}else{
	header("Location:index.php?SKD=0&SKI=1");
	exit();
}
?>