<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=11" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YENİ BANKA HESABI EKLE</h3></td>
			</tr>
			<tr height="1">
				<td style="border: solid 1px #F50000;"></td>
			</tr>
			<tr>
				<td width="750" align="center" bgcolor="#001d26" valign="top">
					<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Banka Adı</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="bankaadi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: white;">Banka Logosu</td>
							<td style="color: white;">:</td>
							<td><input class="inputAlanlari" type="file" name="bankalogo"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Şehir</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="sehir"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Ülke</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="ulke"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Şube Adı</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="subeadi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Para Birimi</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="subekodu"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Hesap Sahibi</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="hesapsahibi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Hesap No</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="hesapno"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">IBAN No</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="ibanno"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td></td>
							<td></td>
							<td width="500" valign="top"><input class="yesilbuton" type="submit" value="Ekle"></td>
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