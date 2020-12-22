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
		<td align="center"><b>HATA. Bilgilerini güncellerken bir <b style="color: red;">hata oluştu.</b></td>
	</tr>
	<tr>
		<td align="center">İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</td>
	</tr>
	<tr>
		<td align="center" class="sonucsayfalari">Hesabım sayfasına dönmek için <a href="index.php?SK=51">tıklayınız</a>. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</td>
	</tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
</table>
<?php 
}
else{
	header("Location:index.php");
	exit();
}
?>