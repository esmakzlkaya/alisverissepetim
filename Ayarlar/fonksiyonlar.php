<?php 
$IPAdresi = $_SERVER["REMOTE_ADDR"];
$zamanDamgasi=time();
$tarihSaat=date("d.m.Y H:i:s",$zamanDamgasi);
$sitekokdizini=$_SERVER["DOCUMENT_ROOT"];
$resimklasoruyolu="/AlışverişSepetim/Resimler/";
$veroticinklasoryolu=$sitekokdizini . $resimklasoruyolu;

function TarihBul($deger){
	$cevir=date("d.m.Y",$deger);
	return $cevir;		
}
function ucgunileritarihbul(){
	global $zamanDamgasi;
		$birgun=86400; //saniye
		$hesapla=$zamanDamgasi+(3*$birgun);
		$cevir=date("d.m.Y",$zamanDamgasi);
		return $cevir;		
	}
	function RakamHaricSil($deger){
		$islem=preg_replace("/[^0-9]/","",$deger);
		return $islem;
	}
	function tumbosluklarısil($deger){
		$islem=preg_replace("/\s|&nbsp;/", "", $deger);
		return $islem;
	}
	function DonusumleriGeriDondur($deger){
		$islem=htmlspecialchars_decode($deger,ENT_QUOTES);
		return $islem;
	}
	function Guvenlik($deger){
		$boslukSil=trim($deger);
		$etiketleriTemizle=strip_tags($boslukSil);
		$tirnaklariEtkisizYap=htmlspecialchars($etiketleriTemizle,ENT_QUOTES);
		return $tirnaklariEtkisizYap;
	}
	function RakamliIfadeler($deger){
		$boslukSil=trim($deger);
		$etiketleriTemizle=strip_tags($boslukSil);
		$tirnaklariEtkisizYap=htmlspecialchars($etiketleriTemizle,ENT_QUOTES);
		$temizle= RakamHaricSil($tirnaklariEtkisizYap);
		return $temizle;		
	}
	function ibanbicimlendir($deger){
		$boslukSil=trim($deger);
		$tumboslukSil=tumbosluklarısil($boslukSil);
		$birblok=substr($tumboslukSil,0,4);
		$ikiblok=substr($tumboslukSil,4,4);
		$ucblok=substr($tumboslukSil,8,4);
		$dortblok=substr($tumboslukSil,12,4);
		$besblok=substr($tumboslukSil,16,4);
		$altiblok=substr($tumboslukSil,20,4);
		$yediblok=substr($tumboslukSil,24,2);
		return $birblok ." ".$ikiblok." ".$ucblok." ".$dortblok." ".$besblok." ".$altiblok." ".$yediblok;
	}
	function AktivasyonKoduuret(){
		$ilkbes=rand(10000,99999);
		$ikincibes=rand(10000,99999);
		$ucuncubes=rand(10000,99999);
		$birlestir=$ilkbes ."-". $ikincibes ."-". $ucuncubes;
		return $birlestir;
	}
	function fiyatbicimlendir($deger){
		$bicimlendir=number_format($deger,"2",",",".");
		return $bicimlendir;
	}
	function resimadiolustur(){
		$olustur=substr(md5(uniqid(time())), 0,25);
		return $olustur;
	}
	?>