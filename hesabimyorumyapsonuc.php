<?php
if(isset($_SESSION["kullanici"])){
	if(isset($_GET["urunid"])){
		$gelenurunid=Guvenlik($_GET["urunid"]);	
	}else{
		$gelenurunid="";
	}
	if(isset($_POST["puan"])){
		$gelenpuan=Guvenlik($_POST["puan"]);	
	}else{
		$gelenpuan="";
	}
	if(isset($_POST["yorum"])){
		$gelenyorum=Guvenlik($_POST["yorum"]);	
	}else{
		$gelenyorum="";
	}

	if(($gelenurunid!="")and($gelenpuan!="") and ($gelenyorum!="")){
		$yorumekle=$DBConnection->prepare("INSERT INTO yorumlar (urunid, uyeid, puan, yorummetni, yorumtarihi, yorumipadresi) VALUES (?,?,?,?,?,?)");
		$yorumekle->execute([$gelenurunid, $id,$gelenpuan, $gelenyorum, $zamanDamgasi,$IPAdresi ]);
		$sayisi	=	$yorumekle->rowCount();
		if($sayisi>0){ // üye kaydı başarılı

			$yorumsayisiguncelle=$DBConnection->prepare("UPDATE urunler SET  yorumsayisi=yorumsayisi+1, toplamyorumpuani=toplamyorumpuani+? WHERE id=? LIMIT 1");
			$yorumsayisiguncelle->execute([$gelenpuan,$gelenurunid]);
			$guncellenenyorumsayisi	=	$yorumsayisiguncelle->rowCount();
			if ($guncellenenyorumsayisi>0) {
				header("Location:index.php?SK=77");
				exit();
		}else{ //hatalı
			header("Location:index.php?SK=78");
			exit();
		}
	}
	else{ //hatalı
		header("Location:index.php?SK=78");
		exit();
	}
	}else{ // eksik alanlar var
		header("Location:index.php?SK=79");
		exit();
	}
}else{
	header("Location:anasayfa");
	exit();
}
?>