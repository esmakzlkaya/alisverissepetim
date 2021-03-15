<?php
if(isset($_SESSION["kullanici"])){
?>
<table width="1065" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr height="75">
		<td>&nbsp;</td>
	</tr>
	<tr height="100">
		<td align="center"><img src="Resimler/Dikkat.png" border="0"></td>
	</tr>
	<tr height="50">
		<td align="center"><b>Girdiğiniz şifreler uyuşmuyor. Bilgilerin doğruluğundan emin olunuz.</b></td>
	</tr>
	<tr>
		<td align="center">Lütfen tekrar deneyiniz.</td>
	</tr>
	<tr>
		<td align="center" class="sonucsayfalari">Hesabım sayfasına dönmek için lütfen<a href="index.php?SK=51"> tıklayınız</a> .</td>
	</tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
</table>
<?php 
}
else{
	header("Location:anasayfa");
	exit();
}
?>