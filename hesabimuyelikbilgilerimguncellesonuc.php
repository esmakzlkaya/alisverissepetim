<?php
if(isset($_SESSION["kullanici"])){
	if(isset($_POST["mail"])){
		$gelenmail=Guvenlik($_POST["mail"]);	
	}else{
		$gelenmail="";
	}
	if(isset($_POST["sifre"])){
		$gelensifre=Guvenlik($_POST["sifre"]);	
	}else{
		$gelensifre="";
	}
	if(isset($_POST["sifretekrar"])){
		$gelensifretekrar=Guvenlik($_POST["sifretekrar"]);	
	}else{
		$gelensifretekrar="";
	}
	if(isset($_POST["adsoyad"])){
		$gelenisim=Guvenlik($_POST["adsoyad"]);	
	}else{
		$gelenisim="";
	}
	if(isset($_POST["tel"])){
		$gelentel=Guvenlik($_POST["tel"]);	
	}else{
		$gelentel="";
	}
	if(isset($_POST["cinsiyet"])){
		$gelencinsiyet=Guvenlik($_POST["cinsiyet"]);	
	}else{
		$gelencinsiyet="";
	}

	$md5liSifre=md5($gelensifre);

	if(($gelenmail!="") and ($gelensifre!="") and ($gelensifretekrar!="") and ($gelenisim!="")and ($gelentel!="") and ($gelencinsiyet!="")){
		//// HİÇBİR BİLGİ DEĞİŞMİYORSA TAMAMA GÖNDER
		if (($gelenmail==$mail) and ($gelensifre=="eskisifre") and ($gelensifretekrar=="eskisifre") and ($gelenisim==$adsoyad)and ($gelentel==$telno) and ($gelencinsiyet==$cinsiyet)) {
			header("Location:index.php?SK=53");
			exit();
		} /////

		// girilen şifreler aynı  mı?
		if ($gelensifre!=$gelensifretekrar){  //değil
			header("Location:index.php?SK=56"); // hata sayfasına git
			exit();
		}else{ // şifreler aynı
			if ($gelensifre=="eskisifre") {
				$sifredegistirmedurumu=0; // şifre aynı kalacak
			}else{
				$sifredegistirmedurumu=1; //şifre değişecek
			}

			//kullanıcı mailini değiştirecek mi?
			if($gelenmail!=$mail){ //yeni bir mail girdi
				//girilen yeni mail başkasına ait mi?
				$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ?");
				$kontrolSorgusu->execute([$gelenmail]);
				$sayisi=$kontrolSorgusu->rowCount();
				if ($sayisi>0) { //tekrarlanan mail
					header("Location:index.php?SK=57"); //hata sayfasına git 
					exit();
				}
			}

			if($sifredegistirmedurumu==1){//şifre değişecek
				$yeniuye=$DBConnection->prepare("UPDATE uyeler SET mail=?, sifre=?, adsoyad=?, telno=?, cinsiyet=? WHERE id=? LIMIT 1");
				$yeniuye->execute([$gelenmail, $md5liSifre,$gelenisim, $gelentel, $gelencinsiyet,$id]);
			}else{ //şifre değişmeyecek
				$yeniuye=$DBConnection->prepare("UPDATE uyeler SET mail=?, adsoyad=?, telno=?, cinsiyet=? WHERE id=? LIMIT 1");
				$yeniuye->execute([$gelenmail,$gelenisim, $gelentel, $gelencinsiyet,$id ]);
			}

			$yeniuyekontrol	=	$yeniuye->rowCount();
			if($yeniuyekontrol>0){ // üye kaydı başarılı
				$_SESSION["kullanici"]	=	$gelenmail;
				header("Location:index.php?SK=53");
				exit();
			}else{ //hatalı
				header("Location:index.php?SK=54");
				exit();
			}
		}
	}else{ // eksik alanlar var
		header("Location:index.php?SK=55");
		exit();
	}
}
else{
	header("Location:index.php");
	exit();
}
?>