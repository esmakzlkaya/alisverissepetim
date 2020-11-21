<?php 
session_start(); ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once("Ayarlar/siteSayfalari.php");

//unset($_SESSION["Kullanici"]);
//unset($_SESSION["kullanici"]);
//session_destroy();

if(isset($_REQUEST["SK"])){
	$sayfakodudegeri=RakamliIfadeler($_REQUEST["SK"]);
}
else{
	$sayfakodudegeri=0;
}
if(isset($_REQUEST["page"])){
	$sayfalama=RakamliIfadeler($_REQUEST["page"]);
}
else{
	$sayfalama=1;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="Robots" content="index, follow">
	<meta name="googlebot" content="index, follow">
	<meta name="revisit-after" content="7 Days">
	<title><?php echo DonusumleriGeriDondur($sitebaslik); ?></title>
	<link rel="icon" type="image/png" href="Resimler/logo.png">
	<meta name="description" content="<?php echo DonusumleriGeriDondur($sitetanim); ?>">
	<meta name="KeyWords" content="<?php echo DonusumleriGeriDondur($siteanahtarkelimeler); ?>">
	<script type="text/javascript" src="Frameworks/JQuery/jquery-3.5.1.min.js" language="javascript"></script>
	<link rel="stylesheet" type="text/css" href="Ayarlar/stil.css">
	<script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>
</head>
<body>
	<table width="1065" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
		<tr height="40" bgcolor="#353745">
			<td ><img src="Resimler/HeaderMesajResmi.png" border="0"></td>
		</tr>
		<tr height="90" >
			<td><table width="1065"  height="30" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr bgcolor="#1f2029">
					<td>&nbsp;</td>
					<?php 
					if (isset($_SESSION["kullanici"])){
						?>
						<td width="20"><a href="xxxxx"><img src="Resimler/KullaniciBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="70" class="mansetalti"><a href="index.php?SK=50">Hesabım</a></td>
						<td width="20"><a href="xxxxx"><img src="Resimler/CikisBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="85" class="mansetalti"><a href="index.php?SK=49">Çıkış Yap</a></td>							
						<?php
					}else{
						?>
						<td width="20"><a href="xxxxx"><img src="Resimler/KullaniciBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="70" class="mansetalti"><a href="index.php?SK=31">Giriş Yap</a></td>
						<td width="20"><a href="xxxxx"><img src="Resimler/KullaniciEkleBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="85" class="mansetalti"><a href="index.php?SK=22">Yeni Üyelik</a></td>
						<?php
					}
					?>
					<td width="20"><a href="xxxxx"><img src="Resimler/SepetBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
					<td width="103" class="mansetalti"><a href="xxxxx">Sepetim</a></td>
				</tr>
			</table>
			<table width="1065"  height="60" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td width="192"><a href="index.php"><img src="Resimler/<?php echo DonusumleriGeriDondur($sitelogosu); ?>" border="0"></a></td>
					<td><table width="876"  height="30" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr bgcolor="">
							<td width="456">&nbsp;</td>
							<td width="90" class="anamenu"><b><a href="index.php?SK=0">Ana Sayfa</a></b></td>
							<td width="100" class="anamenu"><b><a href="index.php?SK=85">Kadın Giyim</a></b></td>
							<td width="110" class="anamenu"><b><a href="index.php?SK=87">Çocuk Giyim</a></b></td>
							<td width="120" class="anamenu"><b><a href="index.php?SK=83">Erkek Giyim</a></b></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td align="center"><?php 

			if((!$sayfakodudegeri) or ($sayfakodudegeri=="") or ($sayfakodudegeri==0)){
				include($sayfakodu[0]);
			}else{
				include($sayfakodu[$sayfakodudegeri]);
			}
			?>
			</td>
	</tr>
	<tr height="210">	
		<td><table width="1065"  height="" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#F9F9F9">
			<tr height="30">
				<td width="250" style="border-bottom: 1px solid ;" class="altmenu"><b>&nbsp;<a href="xxxxx">KURUMSAL</a></b></td>
				<td width="22" >&nbsp;</td>
				<td width="250" style="border-bottom: 1px solid ;" class="altmenu"><b><a href="index.php?SK=2">ÜYELİK VE HİZMETLER</a></b></td>
				<td width="22" style="border-bottom: 1px solid ;" class="altmenu">&nbsp;</td>
				<td width="250" style="border-bottom: 1px solid ;" class="altmenu"><b><a href="xxxxx">SÖZLEŞMELER</a></b></td>
				<td width="21">&nbsp;</td>
				<td width="250" style="border-bottom: 1px solid ;" class="altmenu"><b><a href="xxxxx">BİZİ TAKİP EDİN</a></b></td>
			</tr>
			<br>
			<tr height="30">
				<td width="250" class="altmenu">&nbsp;<a href="index.php?SK=1">Hakkımızda</a></td>
				<td width="22" >&nbsp;</td>
				<?php 
				if (isset($_SESSION["kullanici"])){
					?>
					<td width="250" class="altmenu"><a href="index.php?SK=49">Çıkış Yap</a></td>
					<?php 
				}else{
					?>
					<td width="250" class="altmenu"><a href="index.php?SK=31">Giriş Yap</a></td>
					<?php 
				}
				?>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=2">Üyelik Sözleşmesi</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width=""  height="" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="20"><img src="Resimler/Facebook16x16.png" style="margin-top: 5px;"></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($facebooklinki); ?>"  target="blank">Facebook</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td width="250" class="altmenu">&nbsp;<a href="index.php?SK=8">Banka Hesaplarımız</a></td>
				<td width="22" >&nbsp;</td>
				<?php 
				if (isset($_SESSION["kullanici"])){
					?>
					<td width="250" class="altmenu"><a href="index.php?SK=50">Hesabım</a></td>	
					<?php 
				}else{
					?>
					<td width="250" class="altmenu"><a href="index.php?SK=22">Yeni Üye Ol</a></td>
					<?php 
				}
				?>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=3">Kullanım Koşulları</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width="250"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="20"><img src="Resimler/LinkedIn16x16.png" style="margin-top: 5px;"></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($linkedinlinki); ?>" target="blank">Linkedin</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td width="250" class="altmenu">&nbsp;<a href="index.php?SK=9">Havale Bildirim Formu</a></td>
				<td width="22" >&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=21">Sık Sorulan Sorular</a></td>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=4">Gizlilik Sözleşmesi</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width="250"  height="" border="0" cellspacing="0" cellpadding="0" align="center" >
						<tr>
							<td width="20"><img src="Resimler/Pinterest16x16.png" style="margin-top: 5px;" ></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($pinterestlinki); ?>" target="blank">Pinterest</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td width="250" class="altmenu">&nbsp;<a href="index.php?SK=14">Kargom Nerede?</a></td>
				<td width="22" >&nbsp;</td>
				<td width="250"></td>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=5">Mesafeli Satış Sözleşmesi</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width="250"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="20"><img src="Resimler/Instagram16x16.png" style="margin-top: 5px;"></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($insatgramlinki); ?>" target="blank">İnstagram</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td width="250" class="altmenu">&nbsp;<a href="index.php?SK=16">İletişim</a></td>
				<td width="22" >&nbsp;</td>
				<td width="250"></td>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=6">Teslimat</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width="250"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="20"><img src="Resimler/Twitter16x16.png" style="margin-top: 5px;"></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($twitterlinki); ?>" target="blank">Twitter</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td width="250"></td>
				<td width="22" >&nbsp;</td>
				<td width="250"></td>
				<td width="22">&nbsp;</td>
				<td width="250" class="altmenu"><a href="index.php?SK=7">İptal & İade & Değişim</a></td>
				<td width="21">&nbsp;</td>
				<td width="250">
					<table width="250"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="20"><img src="Resimler/YouTube16x16.png" style="margin-top: 5px;"></td>
							<td width="230" class="altmenu"><a href="<?php echo DonusumleriGeriDondur($youtubelinki); ?>" target="blank">Youtube</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table></td>
	</tr>

	<tr height="40">
		<td><table width="1065"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td align="center"><?php echo DonusumleriGeriDondur($sitecopyright); ?></td>
			</tr>
		</table></td>
	</tr>
	<tr height="40">
		<td><table width="1065"  height="" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td align="center"><img src="Resimler/RapidSSL32x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/InternetteGuvenliAlisveris28x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/3DSecure14x12.png"  style="margin-right: 5px;" border="0"><img src="Resimler/BonusCard41x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/MaximumCard46x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/WorldCard48x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/CardFinans78x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/AxessCard46x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/VisaCard37x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/MasterCard21x12.png" style="margin-right: 5px;" border="0"><img src="Resimler/AmericanExpiress20x12.png" style="margin-right: 5px;" border="0"></td>

			</tr>
		</table></td>
	</tr>

</table>

</body>
</html>
<?php $DBConnection=null;
ob_end_flush();
?>