<?php 
try {
	$DBConnection=new PDO("mysql:host=localhost; dbname=basiceticaretsitesi; charset=UTF8","root","");
} catch (PDOException $e) {
		// echo $e->getMessage();
	die();
}
$ayarlarSorgusu=$DBConnection->prepare("SELECT * FROM ayarlar");
$ayarlarSorgusu->execute();
$ayarsayisi=$ayarlarSorgusu->rowCount();
$ayar=$ayarlarSorgusu->fetch(PDO::FETCH_ASSOC);
if($ayarsayisi>0){
	$siteadi=$ayar["siteAdi"];
	$sitebaslik=$ayar["siteTitle"];
	$sitetanim=$ayar["siteDescription"];
	$siteanahtarkelimeler=$ayar["siteKeywords"];
	$sitecopyright=$ayar["siteCopyrightMetni"];
	$sitelogosu=$ayar["siteLogosu"];
	$siteemail=$ayar["siteEmail"];
	$sitesifre=$ayar["siteMailSifre"];
	$siteemailHostAdresi=$ayar["siteemailHostAdresi"];
	$sitelinki=$ayar["sitelinki"];
	$facebooklinki=$ayar["facebooklinki"];
	$insatgramlinki=$ayar["insatgramlinki"];
	$linkedinlinki=$ayar["linkedinlinki"];
	$youtubelinki=$ayar["youtubelinki"];
	$twitterlinki=$ayar["twitterlinki"];
	$pinterestlinki=$ayar["pinterestlinki"];
	$dolarkuru=$ayar["dolarkuru"];
	$eurokuru=$ayar["eurokuru"];
	$ucretsizkargobarajı=$ayar["ucretsizkargobarajı"];
	$clientID=$ayar["clientid"];
	$storeKey=$ayar["storekey"];
	$apikullanicisi=$ayar["apikullanicisi"];
	$apisifresi=$ayar["apisifresi"];
}
else{
 		//echo "Ayar sorgusu hatası"->getMessage();
}
$metinlerSorgusu=$DBConnection->prepare("SELECT * FROM sozlesmelervemetinler");
$metinlerSorgusu->execute();
$metinsayisi=$metinlerSorgusu->rowCount();
$metin=$metinlerSorgusu->fetch(PDO::FETCH_ASSOC);
if($metinsayisi>0){
	$hakkimizdametni=$metin["hakkimizdametni"];
	$uyeliksozlesmesimetni=$metin["uyeliksozlesmesimetni"];
	$kullanimkosullarimetni=$metin["kullanimkosullarimetni"];
	$gizliliksozlesmesimetni=$metin["gizliliksozlesmesimetni"];
	$mesafelisatisozlesmesimetni=$metin["mesafelisatisozlesmesimetni"];
	$teslimatmetni=$metin["teslimatmetni"];
	$iptaliadedegisimmetni=$metin["iptaliadedegisimmetni"];
}
else{
 		//echo "Ayar sorgusu hatası"->getMessage();
}
if(isset($_SESSION["kullanici"])){
	$kullaniciSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail='".$_SESSION["kullanici"]."' LIMIT 1 ");
	$kullaniciSorgusu->execute();
	$kullaniciSayisi=$kullaniciSorgusu->rowCount();
	$kullanici=$kullaniciSorgusu->fetch(PDO::FETCH_ASSOC);
	if($kullaniciSayisi>0){
		$id=$kullanici["id"];
		$mail=$kullanici["mail"];
		$sifre=$kullanici["sifre"];
		$adsoyad=$kullanici["adsoyad"];
		$telno=$kullanici["telno"];
		$cinsiyet=$kullanici["cinsiyet"];
		$durumu=$kullanici["durumu"];
		$kayitTarihi=$kullanici["kayitTarihi"];
		$kayitIPAdresi=$kullanici["kayitIPAdresi"];
	}
	else{
 		//echo "Ayar sorgusu hatası"->getMessage();
		die();
	}
}
if(isset($_SESSION["yonetici"])){
	$yoneticiSorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler WHERE kullaniciadi='".$_SESSION["yonetici"]."' LIMIT 1 ");
	$yoneticiSorgusu->execute();
	$yoneticiSayisi=$yoneticiSorgusu->rowCount();
	$yonetici=$yoneticiSorgusu->fetch(PDO::FETCH_ASSOC);
	if($yoneticiSayisi>0){
		$yoneticiid=$yonetici["id"];
		$yoneticikullaniciadi=$yonetici["kullaniciadi"];
		$yoneticisifre=$yonetici["sifre"];
		$yoneticiadsoyad=$yonetici["isimsoyisim"];
		$yoneticimail=$yonetici["mail"];
		$yoneticitelno=$yonetici["telno"];
	}
	else{
 		//echo "Ayar sorgusu hatası"->getMessage();
		die();
	}
}
?>