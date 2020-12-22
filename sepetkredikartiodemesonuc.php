<?php
//session_start(); ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once("Ayarlar/siteSayfalari.php");

$oid					=	$_POST['oid'];

$SepetinTaksitSorgusu	=	$DBConnection->prepare("SELECT * FROM sepet WHERE sepetnumarasi = ? LIMIT 1");
$SepetinTaksitSorgusu->execute([$oid]);
$TaksitKaydi			=	$SepetinTaksitSorgusu->fetch(PDO::FETCH_ASSOC);

$TaksitSayisi	=	$TaksitKaydi["taksitsecimi"];
if($TaksitSayisi==1){
	$TaksitSayisi	=	"";
}

$hashparams		=	$_POST["HASHPARAMS"];
$hashparamsval	=	$_POST["HASHPARAMSVAL"];
$hashparam		=	$_POST["HASH"];
$storekey		=	DonusumleriGeriDondur($storeKey);	// Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
$paramsval		=	"";
$index1			=	0;
$index2			=	0;
while($index1<@strlen($hashparams)){
	$index2		=	@strpos($hashparams,":",$index1);
	$vl			=	$_POST[@substr($hashparams,$index1,$index2-$index1)];
	if($vl==null)
		$vl			=	"";
	$paramsval	=	$paramsval.$vl; 
	$index1		=	$index2+1;
}
$hashval		=	$paramsval.$storekey;
$hash			=	@base64_encode(@pack('H*',@sha1($hashval)));
if($paramsval!=$hashparamsval || $hashparam!=$hash) 	
	echo "<h4>Güvenlik Uyarısı! Sayısal İmza Geçerli Değil.</h4>";
$name			=	DonusumleriGeriDondur($apikullanicisi);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Adı
$password		=	DonusumleriGeriDondur($apisifresi);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Şifresi
$clientid		=	$_POST["clientid"];
$mode			=	"P";	// P Çekim İşlemi Demek, T Test İşlemi Demek (Kesinlikle P Olacak Yoksa Çekimler Kart Sahibine Geri Gider)
$type			=	"Auth";	// Auth: Satış PreAuth: Ön Otorizasyon
$expires		=	$_POST["Ecom_Payment_Card_ExpDate_Month"]."/".$_POST["Ecom_Payment_Card_ExpDate_Year"];
$cv2			=	$_POST['cv2'];
$tutar			=	$_POST["amount"];
$taksit			=	$TaksitSayisi;	// Taksit Yapılacak İse Taksit Sayısı Girilmeli, 0 Kesinlikle Girilmeyecektir. Tek Çekim İçin Boş Bırakılacaktır, Taksit İşlemleri İçin Minimum 2 Girilir. Maksimum Bankanın Size Vereceği Taksit Sayısı Kadardır.
$lip			=	GetHostByName($REMOTE_ADDR);
$email			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail adresini Gönderebilirsiniz
$mdStatus		=	$_POST['mdStatus'];
$xid			=	$_POST['xid'];
$eci			=	$_POST['eci'];
$cavv			=	$_POST['cavv'];
$md				=	$_POST['md'];

if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4"){ 	
	$request	=	"DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>"."<CC5Request>"."<Name>{NAME}</Name>"."<Password>{PASSWORD}</Password>"."<ClientId>{CLIENTID}</ClientId>"."<IPAddress>{IP}</IPAddress>"."<Email>{EMAIL}</Email>"."<Mode>P</Mode>"."<OrderId>{OID}</OrderId>"."<GroupId></GroupId>"."<TransId></TransId>"."<UserId></UserId>"."<Type>{TYPE}</Type>"."<Number>{MD}</Number>"."<Expires></Expires>"."<Cvv2Val></Cvv2Val>"."<Total>{TUTAR}</Total>"."<Currency>949</Currency>"."<Taksit>{TAKSIT}</Taksit>"."<PayerTxnId>{XID}</PayerTxnId>"."<PayerSecurityLevel>{ECI}</PayerSecurityLevel>"."<PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>"."<CardholderPresentCode>13</CardholderPresentCode>"."<BillTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."<Company></Company>"."<TelVoice></TelVoice>"."</BillTo>"."<ShipTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."</ShipTo>"."<Extra></Extra>"."</CC5Request>";
	$request	=	@str_replace("{NAME}",$name,$request);
	$request	=	@str_replace("{PASSWORD}",$password,$request);
	$request	=	@str_replace("{CLIENTID}",$clientid,$request);
	$request	=	@str_replace("{IP}",$lip,$request);
	$request	=	@str_replace("{OID}",$oid,$request);
	$request	=	@str_replace("{TYPE}",$type,$request);
	$request	=	@str_replace("{XID}",$xid,$request);
	$request	=	@str_replace("{ECI}",$eci,$request);
	$request	=	@str_replace("{CAVV}",$cavv,$request);
	$request	=	@str_replace("{MD}",$md,$request);
	$request	=	@str_replace("{TUTAR}",$tutar,$request);
	$request	=	@str_replace("{TAKSIT}",$taksit,$request);
	
	$url		=	"https://<sunucu_adresi>/<apiserver_path>"; // Bu adres Banka veya EST Firması Tarafından Verilir
	$ch			=	@curl_init();
	@curl_setopt($ch, CURLOPT_URL,$url);
	@curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
	@curl_setopt($ch, CURLOPT_SSLVERSION, 3);
	@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	@curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	@curl_setopt($ch, CURLOPT_TIMEOUT, 90);
	@curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	$result		=	@curl_exec($ch);
	if(@curl_errno($ch)){
		print @curl_error($ch);
	}else{
		@curl_close($ch);
	}
	$Response		=	"";
	$OrderId		=	"";
	$AuthCode		=	"";
	$ProcReturnCode	=	"";
	$ErrMsg			=	"";
	$HOSTMSG		=	"";
	$HostRefNum		=	"";
	$TransId		=	"";
	$response_tag	=	"Response";
	$posf			=	@strpos($result,("<".$response_tag.">"));
	$posl			=	@strpos($result,("</".$response_tag.">"));
	$posf			=	$posf+@strlen($response_tag)+2 ;
	$Response		=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"OrderId";
	$posf			=	@strpos($result,("<".$response_tag.">"));
	$posl			=	@strpos($result,("</".$response_tag.">")) ;
	$posf			=	$posf+@strlen($response_tag)+2;
	$OrderId		=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"AuthCode";
	$posf			=	@strpos($result,"<".$response_tag.">");
	$posl			=	@strpos($result,"</".$response_tag.">");
	$posf			=	$posf+@strlen($response_tag)+2 ;
	$AuthCode		=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"ProcReturnCode";
	$posf			=	@strpos($result,"<".$response_tag.">");
	$posl			=	@strpos($result,"</".$response_tag.">");
	$posf			=	$posf+@strlen($response_tag)+2 ;
	$ProcReturnCode	=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"ErrMsg";
	$posf			=	@strpos($result,"<".$response_tag.">");
	$posl			=	@strpos($result,"</".$response_tag.">");
	$posf			=	$posf+@strlen($response_tag)+2;
	$ErrMsg			=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"HostRefNum";
	$posf			=	@strpos($result,"<".$response_tag.">");
	$posl			=	@strpos($result,"</".$response_tag.">");
	$posf			=	$posf+@strlen($response_tag)+2;
	$HostRefNum		=	@substr($result,$posf,$posl-$posf);
	$response_tag	=	"TransId";
	$posf			=	@strpos($result,"<".$response_tag.">");
	$posl			=	@strpos($result,"</".$response_tag.">");
	$posf			=	$posf+@strlen($response_tag)+2;
	$$TransId		=	@substr($result,$posf,$posl-$posf);
	if($Response==="Approved"){
		
		$sepettekitoplamurunsayisi=0;
		$sepettekitoplamurunfiyati=0;
		$sepetkargoucreti=0;
		$urununtoplamfiyati=0;
		$odenecektoplamtutar=0;
		$AlisverisSepetiSorgusu		=	$DBConnection->prepare("SELECT * FROM sepet WHERE sepetnumarasi = ?");
		$AlisverisSepetiSorgusu->execute([$oid]);
		$SepetSayisi				=	$AlisverisSepetiSorgusu->rowCount();
		$SepetUrunleri				=	$AlisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($SepetSayisi>0){
			foreach($SepetUrunleri as $SepetSatirlari){
				$SepetIdsi					=	$SepetSatirlari["id"];
				$Sepetsepetnumarasi			=	$SepetSatirlari["sepetnumarasi"];
				$Sepettekiuyeid				=	$SepetSatirlari["uyeid"];
				$Sepettekiurunid			=	$SepetSatirlari["urunid"];
				$Sepettekiadresid			=	$SepetSatirlari["adresid"];
				$Sepettekivaryantid			=	$SepetSatirlari["varyantid"];
				$Sepettekikargofirmasiid	=	$SepetSatirlari["kargofirmasiid"];
				$Sepettekiurunadedi			=	$SepetSatirlari["urunadedi"];
				$Sepettekiodemesecimi		=	$SepetSatirlari["odemesecimi"];
				$Sepettekitaksitsecimi		=	$SepetSatirlari["taksitsecimi"];

				$UrunBilgileriSorgusu			=	$DBConnection->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
				$UrunBilgileriSorgusu->execute([$Sepettekiurunid]);
				$UrunKaydi					=	$UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
				$UrununTuru				=	$UrunKaydi["urunturu"];
				$UrununAdi				=	$UrunKaydi["urunadi"];
				$UrununFiyati			=	$UrunKaydi["urunfiyati"];
				$Urununparabirimi		=	$UrunKaydi["parabirimi"];
				$Urununkdvorani			=	$UrunKaydi["kdvorani"];
				$Urununkargoucreti		=	$UrunKaydi["kargoucreti"];
				$UrununResmi			=	$UrunKaydi["resimbir"];
				$Urununvaryantbasligi	=	$UrunKaydi["varyantbasligi"];

				$UrunVaryantBilgileriSorgusu	=	$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
				$UrunVaryantBilgileriSorgusu->execute([$Sepettekivaryantid]);
				$VaryantKaydi					=	$UrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
				$varyantadi			=	$VaryantKaydi["varyantadi"];

				$KargoBilgileriSorgusu		=	$DBConnection->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
				$KargoBilgileriSorgusu->execute([$Sepettekikargofirmasiid]);
				$KargoKaydi					=	$KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
				$KargonunAdi			=	$KargoKaydi["kargofirmasiadi"];

				$adresBilgileriSorgusu		=	$DBConnection->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
				$adresBilgileriSorgusu->execute([$Sepettekiadresid]);
				$adresKaydi					=	$adresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
				$adresadsoyad			=	$adresKaydi["adsoyad"];
				$adresadres				=	$adresKaydi["adres"];
				$adresilce				=	$adresKaydi["ilce"];
				$adressehir				=	$adresKaydi["sehir"];
				$adresToparla			=	$adresadres . " " . $adresilce . " " . $adressehir;
				$adrestelno	=	$adresKaydi["telno"];

				if ($Urununparabirimi=="USD") {
					$urunfiyatihesapla=($UrununFiyati*$dolarkuru);
				}elseif ($Urununparabirimi=="EUR") {
					$urunfiyatihesapla=($UrununFiyati*$eurokuru);
				}else{
					$urunfiyatihesapla=$UrununFiyati;
				}

				$sepettekitoplamurunsayisi=($sepettekitoplamurunsayisi+$Sepettekiurunadedi);
				$sepettekitoplamurunfiyati=($sepettekitoplamurunfiyati+($urunfiyatihesapla*$Sepettekiurunadedi));
				$urununtoplamfiyati=($urunfiyatihesapla*$Sepettekiurunadedi);
				$odenecektoplamtutar=$sepettekitoplamurunfiyati+$sepetkargoucreti;

				$SiparisEkle	=	$DBConnection->prepare("INSERT INTO siparisler (uyeid, siparisnumarasi, urunid, urunturu, urunadi, urunfiyati, kdvorani, urunadedi, toplamurunfiyati, kargofirmasisecimi, kargoucreti, urunresmibir, varyantbasligi, varyantsecimi, adresadsoyad, adresdetay, adrestelno, odemesecimi, taksitsecimi, siparistarihi, siparisIpAdresi) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$SiparisEkle->execute([$Sepettekiuyeid, $Sepetsepetnumarasi, $Sepettekiurunid, $UrununTuru, $UrununAdi, $urunfiyatihesapla, $Urununkdvorani, $Sepettekiurunadedi, $urununtoplamfiyati, $KargonunAdi, $Urununkargoucreti, $UrununResmi, $Urununvaryantbasligi, $varyantadi, $adresadsoyad, $adresToparla, $adrestelno, 'Kredi Kartı', $TaksitSayisi, $zamanDamgasi, $IPAdresi]);
				$EklemeKontrol	=	$SiparisEkle->rowCount();

				if($EklemeKontrol>0){
					$SepettenSilmeSorgusu	=	$DBConnection->prepare("DELETE FROM sepet WHERE id = ? AND uyeid = ? LIMIT 1");
					$SepettenSilmeSorgusu->execute([$SepetIdsi, $Sepettekiuyeid]);
				}else{
					echo "siparis eklenemedi";
				}

				$UrunSatisiArttirmaSorgusu	=	$DBConnection->prepare("UPDATE urunler SET toplamsatissayisi=toplamsatissayisi + ? WHERE id = ?");
				$UrunSatisiArttirmaSorgusu->execute([$Sepettekiurunadedi, $Sepettekiurunid]);	

				$StokGuncellemeSorgusu	=	$DBConnection->prepare("UPDATE urunvaryantlari SET stokadedi=stokadedi - ? WHERE id = ? LIMIT 1");
				$StokGuncellemeSorgusu->execute([$Sepettekiurunadedi, $Sepettekivaryantid]);	
			}

			if ($sepettekitoplamurunfiyati>=$ucretsizkargobarajı) {
				$SiparisiGuncelle	=	$DBConnection->prepare("UPDATE siparisler SET kargoucreti = ? WHERE uyeid = ? AND siparisnumarasi = ?");
				$SiparisiGuncelle->execute([0, $Sepettekiuyeid, $Sepetsepetnumarasi]);
			}
			

		}	
		
	}else{
		echo "Ödeme isleminiz sırasında hata oluştu. Hata = ".$ErrMsg;
	}
}else{
	echo "Kredi Kartı Bankası 3D Onayı Vermedi, Lütfen Bilgileriniz Kontrol Edip Tekrar Deneyiniz. Sorununuz Devam Eder İse Lütfen Kartınızın Sahibi Olan Bankanın Müşteri Temsilcileriyle İletişime Geçiniz.";
}
$DBConnection	=	null;
ob_end_flush();

?>