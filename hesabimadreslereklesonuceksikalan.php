<?php
if(isset($_SESSION["kullanici"])){
?>
<table width="1065" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr height="75">
		<td>&nbsp;</td>
	</tr>
	<tr height="100">
		<td align="center"><img src="Resimler/Bilinmiyor.png" border="0"></td>
	</tr>
	<tr height="50">
		<td align="center"><b>DİKKAT. Adres ekleme formunda eksik alanlar bulunduğunu farkettik, lütfen tüm alanların dolu olduğuna emin olunuz..</b></td>
	</tr>
	<tr>
		<td align="center">Tekrar deneyiniz.</td>
	</tr>
	<tr>
		<td align="center" class="sonucsayfalari">Adreslerim sayfasına dönmek için <a href="hesabim-adresler"> buraya tıklayınız</a>. Anasayfaya dönmek için <a href="anasayfa">tıklayınız</a>.</td>
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