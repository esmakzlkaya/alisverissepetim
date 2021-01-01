<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=6" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>SÖZLEŞME VE METİNLER</h3></td>
			</tr>
			<tr height="1">
				<td style="border: solid 1px #F50000;"></td>
			</tr>
			<tr>
				<td width="750" align="center" bgcolor="#001d26" valign="top">
					<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Hakkımızda Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="hakkimizdametni"><?php echo DonusumleriGeriDondur($hakkimizdametni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Üyelik Sözleşmesi Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="uyeliksozlesmesimetni"><?php echo DonusumleriGeriDondur($uyeliksozlesmesimetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Kullanım Koşulları Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="kullanimkosullarimetni"><?php echo DonusumleriGeriDondur($kullanimkosullarimetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Gizlilik Sözleşmesi Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="gizliliksozlesmesimetni"><?php echo DonusumleriGeriDondur($gizliliksozlesmesimetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Mesafeli Satış Sözleşmesi Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="mesafelisatisozlesmesimetni"><?php echo DonusumleriGeriDondur($mesafelisatisozlesmesimetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">Teslimat Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="teslimatmetni"><?php echo DonusumleriGeriDondur($teslimatmetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: white;">İptal & İade & Değişim Metni</td>
							<td width="20" style="color: white;" > : </td>
							<td width="500" valign="top"><textarea  class="textareaalanlari" name="iptaliadedegisimmetni"><?php echo DonusumleriGeriDondur($iptaliadedegisimmetni); ?></textarea></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td></td>
							<td></td>
							<td width="500" valign="top"><input class="yesilbuton" type="submit" value="Metinleri Kaydet"></td>
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