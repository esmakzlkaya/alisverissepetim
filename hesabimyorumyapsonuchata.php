<?php
if(isset($_SESSION["kullanici"])){
?>
<table width="1065" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr height="75">
		<td>&nbsp;</td>
	</tr>
	<tr height="100">
		<td align="center"><img src="Resimler/Hata.png" border="0"></td>
	</tr>
	<tr height="50">
		<td align="center"><b>HATA. Yorum <b style="color: red;">yapılamadı.</b></td>
	</tr>
	<tr>
		<td align="center">İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</td>
	</tr>
	<tr>
		<td align="center" class="sonucsayfalari">Siparişlerim sayfasına dönmek için <a href="hesabim-siparisler">tıklayınız</a>. Yorumlar sayfasına dönmek için <a href="hesabim-yorumlar">tıklayınız</a>.</td>
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