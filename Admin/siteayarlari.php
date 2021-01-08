<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=2" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>SİTE AYARLARI</h3></td>
			</tr>
			<tr height="1">
				<td style="border: solid 1px #F50000;"></td>
			</tr>
			<tr>
				<td width="750" align="center"  valign="top">
					<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Adı</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="siteadi" value="<?php echo DonusumleriGeriDondur($siteadi); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Başlık</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="sitebaslik" value="<?php echo DonusumleriGeriDondur($sitebaslik); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Tanım</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="sitetanim" value="<?php echo DonusumleriGeriDondur($sitetanim); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Anahtar Kelimeleri</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="siteanahtarkelimeler" value="<?php echo DonusumleriGeriDondur($siteanahtarkelimeler); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Copyright</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="sitecopyright" value="<?php echo DonusumleriGeriDondur($sitecopyright); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Logosu</b></td>
							<td style="color: black;">:</td>
							<td><input class="inputAlanlari" type="file" name="siteLogosu"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Email</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="siteemail" value="<?php echo DonusumleriGeriDondur($siteemail); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Şifre</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="sitesifre" value="<?php echo DonusumleriGeriDondur($sitesifre); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Email Host Adresi</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="siteemailHostAdresi" value="<?php echo DonusumleriGeriDondur($siteemailHostAdresi); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Site Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="sitelinki" value="<?php echo DonusumleriGeriDondur($sitelinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Facebook Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="facebooklinki" value="<?php echo DonusumleriGeriDondur($facebooklinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>İnstagram Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="insatgramlinki" value="<?php echo DonusumleriGeriDondur($insatgramlinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Linkedin Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="linkedinlinki" value="<?php echo DonusumleriGeriDondur($linkedinlinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Youtube Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="youtubelinki" value="<?php echo DonusumleriGeriDondur($youtubelinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Twitter linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="twitterlinki" value="<?php echo DonusumleriGeriDondur($twitterlinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Pinterest Linki</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="pinterestlinki" value="<?php echo DonusumleriGeriDondur($pinterestlinki); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Dolar Kuru</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="dolarkuru" value="<?php echo DonusumleriGeriDondur($dolarkuru); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Euro Kuru</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="eurokuru" value="<?php echo DonusumleriGeriDondur($eurokuru); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Ücretsiz Kargo Barajı</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="ucretsizkargobarajı" value="<?php echo DonusumleriGeriDondur($ucretsizkargobarajı); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Sanal POS Client ID</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="clientID" value="<?php echo DonusumleriGeriDondur($clientID); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Sanal POS Store Key</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="storeKey" value="<?php echo DonusumleriGeriDondur($storeKey); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Sanal POS API Kullanıcısı</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="apikullanicisi" value="<?php echo DonusumleriGeriDondur($apikullanicisi); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Sanal POS API Şifresi</b></td>
							<td  style="color: black;" > : </td>
							<td><input class="inputAlanlari" type="text" name="apisifresi" value="<?php echo DonusumleriGeriDondur($apisifresi); ?>"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td></td>
							<td></td>
							<td><input class="yesilbuton" type="submit" value="Ayarları Kaydet"></td>
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