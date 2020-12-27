<?php 
session_start(); ob_start();
require_once("../Ayarlar/ayar.php");
require_once("../Ayarlar/fonksiyonlar.php");
require_once("../Frameworks/Verot/src/class.upload.php");
require_once("../Ayarlar/yonetimsayfalaridis.php");
require_once("../Ayarlar/yonetimsayfalariic.php");
if(isset($_REQUEST["SKI"])){
	$sayfakoduic=RakamliIfadeler($_REQUEST["SKI"]);
}
else{
	$sayfakoduic=0;
}
if(isset($_REQUEST["SKD"])){
	$sayfakodudis=RakamliIfadeler($_REQUEST["SKD"]);
}
else{
	$sayfakodudis=0;
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
	<meta name="Robots" content="noindex, nofollow, noarchive">
	<meta name="googlebot" content="noindex, nofollow, noarchive">
	<title><?php echo DonusumleriGeriDondur($sitebaslik); ?></title>
	<link rel="icon" type="image/png" href="../Resimler/logo.png">
	<script type="text/javascript" src="../Frameworks/JQuery/jquery-3.5.1.min.js" language="javascript"></script>
	<link rel="stylesheet" type="text/css" href="../Ayarlar/stilyonetim.css">
	<script type="text/javascript" src="../Ayarlar/fonksiyonlar.js" language="javascript"></script>
</head>
<body>
	<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="100%">
			<td align="center"><?php  
			if (empty($_SESSION["yonetici"])) {
				if((!$sayfakodudis) or ($sayfakodudis=="") or ($sayfakodudis==0)){
					include($sayfadis[1]);
				}else{
					include($sayfadis[$sayfakodudis]);
				}
			}else{
				if((!$sayfakodudis) or ($sayfakodudis=="") or ($sayfakodudis==0)){
					include($sayfadis[0]);
				}else{
					include($sayfadis[$sayfakodudis]);
				}
			}
			?></td>
		</tr>
	</table>
</body>
</html>
<?php $DBConnection=null;
ob_end_flush();
?>