<?php
if(isset($_SESSION["kullanici"])){
	if(isset($_POST["odemeturusecimi"])){
		$gelenodemeturusecimi		=	Guvenlik($_POST["odemeturusecimi"]);
	}else{
		$gelenodemeturusecimi		=	"";
	}
	if(isset($_POST["taksitsecimi"])){
		$gelentaksitsecimi		=	Guvenlik($_POST["taksitsecimi"]);
	}else{
		$gelentaksitsecimi		=	"";
	}
	if ($gelenodemeturusecimi!="") {
		if ($gelenodemeturusecimi=="Kredi Kartı") {
			if ($gelentaksitsecimi!="") {
				$sepetguncelmisorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ORDER BY id DESC");
				$sepetguncelmisorgusu->execute([$id]);
				$sepetguncelmi=$sepetguncelmisorgusu->rowCount();
				$sepetguncelmi=$sepetguncelmisorgusu->fetchAll(PDO::FETCH_ASSOC);
				if ($sepetguncelmi>0) {
					foreach ($sepetguncelmi as $key) {
						if (($key["taksitsecimi"]!=$gelentaksitsecimi) or ($key["odemesecimi"]!=$gelenodemeturusecimi)) {

							$taksitsecimiguncellesorgusu=$DBConnection->prepare("UPDATE sepet SET taksitsecimi=?, odemesecimi=? WHERE uyeid=?");
							$taksitsecimiguncellesorgusu->execute([$gelentaksitsecimi,$gelenodemeturusecimi,$id]);
							$taksitsecimiguncellekontrol=$taksitsecimiguncellesorgusu->rowCount();
							if ($taksitsecimiguncellekontrol>0) {
						//	echo "guncelleme yaptı da geldi";
								header("Location:index.php?SK=101");
								exit();	
							}else{
							// echo "guncelleme yapamadı hata";
								header("Location:anasayfa");
								exit();
							}
							echo "KREDİ KARTI İŞLEMLERİ";
						}else{
					//	echo "guncelleme yapmadan geldi";
							header("Location:index.php?SK=101");
							exit();	
						}
					}
				}
			}else{
				header("Location:anasayfa");
				exit();
			}
		}else{
			$sepeturunlerisorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ORDER BY id DESC");
			$sepeturunlerisorgusu->execute([$id]);
			$sepeturunsayisi=$sepeturunlerisorgusu->rowCount();
			$sepeturunlerkaydi=$sepeturunlerisorgusu->fetchAll(PDO::FETCH_ASSOC);
			if ($sepeturunsayisi>0) {
				$sepettekitoplamurunfiyati=0;
				$sepetkargoucreti=0;
				foreach ($sepeturunlerkaydi as $sepeturunkaydi) {
					$sepetid=DonusumleriGeriDondur($sepeturunkaydi["id"]);
					$sepetnumarasi=DonusumleriGeriDondur($sepeturunkaydi["sepetnumarasi"]);
					$sepetuyeid=DonusumleriGeriDondur($sepeturunkaydi["uyeid"]);
					$sepeturunid=DonusumleriGeriDondur($sepeturunkaydi["urunid"]);
					$sepetadresid=DonusumleriGeriDondur($sepeturunkaydi["adresid"]);
					$sepetvaryantid=DonusumleriGeriDondur($sepeturunkaydi["varyantid"]);
					$sepeturunadedi=DonusumleriGeriDondur($sepeturunkaydi["urunadedi"]);
					$sepetkargofirmasiid=DonusumleriGeriDondur($sepeturunkaydi["kargofirmasiid"]);
					$sepetodemesecimi=DonusumleriGeriDondur($sepeturunkaydi["odemesecimi"]);
					$sepettaksitsecimi=DonusumleriGeriDondur($sepeturunkaydi["taksitsecimi"]);

					$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=?  LIMIT 1");
					$urunlersorgusu->execute([$sepeturunid]);
					$urunlersayisi=$urunlersorgusu->rowCount();
					$urunlerkaydi=$urunlersorgusu->fetch(PDO::FETCH_ASSOC);

					$urunlerurunturu=DonusumleriGeriDondur($urunlerkaydi["urunturu"]);
					$urunlerurunadi=DonusumleriGeriDondur($urunlerkaydi["urunadi"]);
					$urunlerurunfiyati=DonusumleriGeriDondur($urunlerkaydi["urunfiyati"]);
					$urunlerkdvorani=DonusumleriGeriDondur($urunlerkaydi["kdvorani"]);
					$urunlerkargoucreti=DonusumleriGeriDondur($urunlerkaydi["kargoucreti"]);

					$urunlerurunresmi=DonusumleriGeriDondur($urunlerkaydi["resimbir"]);
					$urunlerurunparabirimi=DonusumleriGeriDondur($urunlerkaydi["parabirimi"]);
					$urunlerurunvaryantbasligi=DonusumleriGeriDondur($urunlerkaydi["varyantbasligi"]);

					$varyantsorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
					$varyantsorgusu->execute([$sepetvaryantid]);
					$varyantsayisi=$varyantsorgusu->rowCount();
					$varyantkaydi=$varyantsorgusu->fetch(PDO::FETCH_ASSOC);

					$varyantlarvaryantadi=DonusumleriGeriDondur($varyantkaydi["varyantadi"]);
					$varyantlarvaryantstokadedi=DonusumleriGeriDondur($varyantkaydi["stokadedi"]);

					$varyantsorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
					$varyantsorgusu->execute([$sepetkargofirmasiid]);
					$varyantsayisi=$varyantsorgusu->rowCount();
					$varyantkaydi=$varyantsorgusu->fetch(PDO::FETCH_ASSOC);

					$urunlerurunkargofirmasiadi=DonusumleriGeriDondur($varyantkaydi["kargofirmasiadi"]);

					$adressorgusu=$DBConnection->prepare("SELECT * FROM adresler WHERE id=? LIMIT 1");
					$adressorgusu->execute([$sepetadresid]);
					$adressayisi=$adressorgusu->rowCount();
					$adreskaydi=$adressorgusu->fetch(PDO::FETCH_ASSOC);

					$adresadsoyad=DonusumleriGeriDondur($adreskaydi["adsoyad"]);
					$adresadres=DonusumleriGeriDondur($adreskaydi["adres"]);
					$adressehir=DonusumleriGeriDondur($adreskaydi["ilce"]);
					$adresilce=DonusumleriGeriDondur($adreskaydi["sehir"]);
					$adrestelno=DonusumleriGeriDondur($adreskaydi["telno"]);

					$adrestoplam=$adresadres." ".$adresilce." / ".$adressehir;

					if ($urunlerurunturu=="Erkek Ayakkabısı") {
						$klasoradi="Erkek";
					}elseif ($urunlerurunturu=="Kadın Ayakkabısı") {
						$klasoradi="Kadin";
					}else{
						$klasoradi="Cocuk";
					}

					if ($urunlerurunparabirimi=="USD") {
						$urunfiyatihesapla=($urunlerurunfiyati*$dolarkuru);
					}elseif ($urunlerurunparabirimi=="EUR") {
						$urunfiyatihesapla=($urunlerurunfiyati*$eurokuru);
					}else{
						$urunfiyatihesapla=$urunlerurunfiyati;
					}

					$sepettekitoplamurunfiyati=($sepettekitoplamurunfiyati+($urunfiyatihesapla*$sepeturunadedi));
					$urununtoplamfiyati=($urunfiyatihesapla*$sepeturunadedi);

					if ($sepettekitoplamurunfiyati>=$ucretsizkargobarajı) {
						$sepetkargoucreti=0;
					}else{
						$sepetkargoucreti=$urunlerkargoucreti;
					}
					$sepeturunlerisorgusu=$DBConnection->prepare("INSERT INTO siparisler (uyeid,siparisnumarasi,urunid,urunturu,urunadi,urunfiyati,kdvorani,urunadedi,toplamurunfiyati,kargofirmasisecimi,kargoucreti,urunresmibir,varyantbasligi,varyantsecimi,adresadsoyad,adresdetay,adrestelno,odemesecimi,taksitsecimi,siparistarihi,siparisIpAdresi,onaydurumu,kargodurumu,kargogonderino) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$sepeturunlerisorgusu->execute([$sepetuyeid,$sepetnumarasi,$sepeturunid,$urunlerurunturu,$urunlerurunadi,$urunfiyatihesapla,$urunlerkdvorani,$sepeturunadedi,$urununtoplamfiyati,$urunlerurunkargofirmasiadi,$sepetkargoucreti,$urunlerurunresmi,$urunlerurunvaryantbasligi,$varyantlarvaryantadi,$adresadsoyad,$adrestoplam,$adrestelno,$gelenodemeturusecimi,0,$zamanDamgasi,$IPAdresi,0,0,0]);
					$sepeturunsayisi=$sepeturunlerisorgusu->rowCount();
					if ($sepeturunsayisi>0) {
						$sepetsiparissilsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE id=? AND uyeid=? LIMIT 1");
						$sepetsiparissilsorgusu->execute([$sepetid,$sepetuyeid]);

					}else{
						header("Location:index.php?SK=100");
						exit();
					}
				}
				//TAMAM
				header("Location:index.php?SK=99");
				exit();
			}else{
				header("Location:anasayfa");
				exit();
			}
		}
	}else{
		header("Location:anasayfa");
		exit();
	}
}else{
	header("Location:anasayfa");
	exit();
} 
?>