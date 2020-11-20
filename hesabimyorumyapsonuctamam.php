<?php
if(isset($_SESSION["kullanici"])){
?>
<table width="1065" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr height="75">
		<td>&nbsp;</td>
	</tr>
	<tr height="100">
		<td align="center"><img src="Resimler/Tamam.png" border="0"></td>
	</tr>
	<tr height="50">
		<td align="center"><b>Tebrikler yorumunuzu kaydettik.</b></td>
	</tr>
	<tr>
		<td align="center">Yorumunuz yetkililer tarafından kontrol edilip yayına alınacaktır..</td>
	</tr>
	<tr>
		<td align="center" class="sonucsayfalari">Yorumlar sayfasına dönmek için <a href="index.php?SK=60">tıklayınız</a>. Siparişlerim sayfasına dönmek için <a href="index.php?SK=61">tıklayınız</a>.</td>
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