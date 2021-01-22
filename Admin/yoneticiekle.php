<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=71" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YÖNETİCİ EKLE</h3></td>
			</tr>
			<tr height="1">
				<td style="border: solid 1px #F50000;"></td>
			</tr>
			<tr>
				<td width="750" align="center"  valign="top">
					<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>İsim soyisim</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="isimsoyisim"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>Kullanıcı Adı</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="kullaniciadi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>E posta</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" name="mail" class="inputAlanlari"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>Şifre</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" name="sifre" class="inputAlanlari"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>Telefon</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" name="telno" maxlength="11" class="inputAlanlari"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td></td>
							<td></td>
							<td width="500" valign="top"><input class="yesilbuton" type="submit" value="EKLE"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>