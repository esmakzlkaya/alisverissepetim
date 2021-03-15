<?php
if(isset($_SESSION["kullanici"])){
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr>
			<td colspan="3"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-adresler" style="text-decoration: none; color: black;">Adresler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-favoriler" style="text-decoration: none; color: black;">Favoriler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-yorumlar" style="text-decoration: none; color: black;">Yorumlar</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-siparisler" style="text-decoration: none; color: black;">Siparişler</a></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr height="">
			<td width="1065" valign="top">
				<form method="post" action="index.php?SK=71">
					<table  width="1065" align="left" border="0" cellspacing="0" cellpadding="0">
						<tr height="30">
							<td colspan="5" style="color: #FF9900" ><h3>HESABIM > ADRESLER</h3></td>
						</tr>
						<tr height="30">
							<td colspan="5" style="border-bottom: 1px solid #CCCCCC;" class="">Yeni adres ekle. </td>
						</tr>
						<tr height="40" bgcolor="#F8FFA7" style="color: black; ">
							<td colspan="1" align="left" style="padding: 0px 5px;"><b>Adres Ekle </b></td>
							<td colspan="4" align="right" style="padding: 0px 5px;"><b><a class="hesabimlink" href="index.php?SK=70"> + Yeni Adres Ekle</a></b></td>
						</tr>
						<tr height="30" align="left">
							<td align="left" valign="bottom"><b>Ad Soyad (*) </b></td>
						</tr>
						<tr>
							<td align="left" valign="top"><input type="text" name="adsoyad" class="inputAlanlari"></td>
						</tr>
						<tr height="30" align="left">
							<td align="left" valign="bottom" ><b>Adres (*) </b></td>
						</tr>
						<tr>
							<td align="left" valign="top"><input type="text" name="adres" class="inputAlanlari"></td>
						</tr>
						<tr height="30" align="left">
							<td align="left" valign="bottom"><b>İlçe (*) </b></td>
						</tr>
						<tr>
							<td align="left" valign="top"><input type="text" name="ilce" class="inputAlanlari"></td>
						</tr>
						<tr height="30" align="left">
							<td align="left" valign="bottom"><b>Şehir (*) </b></td>
						</tr>
						<tr>
							<td align="left" valign="top"><input type="text" name="sehir" class="inputAlanlari"></td>
						</tr>
						<tr height="30" align="left">
							<td align="left" valign="bottom"><b>Telefon Numarası (*) </b></td>
						</tr>
						<tr height="30">
							<td align="left" valign="top"><input type="text" name="tel" class="inputAlanlari"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;" >(*)Boş bırakmayınız.</td>
						</tr>
						<tr height="50">
							<td align="center"><input type="submit" value="YENİ ADRES EKLE" class="bilgilerimiguncellebutonu"></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:anasayfa");
	exit();
} 
?>