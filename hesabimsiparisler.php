<?php 
if ($_SESSION["kullanici"]) {
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr>
			<td colspan="3"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=50" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=58" style="text-decoration: none; color: black;">Adresler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=59" style="text-decoration: none; color: black;">Favoriler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=61" style="text-decoration: none; color: black;">Siparişler</a></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr height="">
			<td width="500" valign="top">
				<form action="index.php?SK=51" method="post">
					<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="40">
							<td colspan="2" style="color: #FF9900" ><h3>HESABIM > ÜYELİK BİLGİLERİM</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" style="border-bottom: 1px solid #CCCCCC;" class="">Hesabın ile alakalı tüm bilgilerin burada. </td>
						</tr>
						<tr height="30">
							<td colspan="2"  valign="bottom" ><b>İsim soyisim : </b> </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="top" ><?php echo $adsoyad; ?></td>
						</tr>
						<tr height="30">
							<td  colspan="2"  valign="bottom"  ><b>E-mail adresi : </b> </td>
						</tr>
						<tr height="30">
							<td colspan="2" valign="top" ><?php echo $mail; ?></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom" ><b>Telefon Numarası : </b></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="top" ><?php echo $telno; ?></td>
						</tr>
						<tr height="30">
							<td valign="bottom" colspan="2"><b>Cinsiyet : </b></td>
						</tr>
						<tr height="30">
							<td valign="top" colspan="2"><?php echo $cinsiyet; ?></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom"><b>Kayıt Tarihi : </b> </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom"><?php echo TarihBul($kayitTarihi); ?></td>
						</tr>
						<tr height="40">
							<td align="center" colspan="2"><input type="submit" value="BİLGİLERİMİ DEĞİŞTİRMEK İSTİYORUM" class="bilgilerimiguncellebutonu"></td>
						</tr>
					</table>
				</form>
			</td>
			<td width="20">&nbsp;</td>
			<td width="545"  valign="top">
				<table width="545" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="40">
						<td style="color: #FF9900" ><h3>REKLAM</h3></td>
					</tr>
					<tr height="30">
						<td style="border-bottom: 1px solid #CCCCCC;">REKLAM</td>
					</tr>
					<tr height="30">
						<td align="left" width="30"><img src="Resimler/545x340Reklam.jpg" border="0" style="margin-top: 3px;"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?php 
} 
else{
	header("Location:index.php");
	exit();
} 
?>