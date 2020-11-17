<?php if ($_SESSION["kullanici"]) {
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="">
			<td width="500" valign="top">
				<form action="index.php?SK=52" method="post">
					<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="40">
							<td colspan="2" style="color: #FF9900" ><h3>HESABIM > ÜYELİK BİLGİLERİM</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" style="border-bottom: 1px solid #CCCCCC;" class="">Hesap bilgilerini değiştir.</td>
						</tr>

						<tr height="30">
							<td  colspan="2"  valign="bottom"  >E-mail adresi (*) </td>
						</tr>
						<tr height="30">
							<td colspan="2" valign="top" ><input type="E-mail" name="mail" value="<?php echo $mail; ?>" class="inputAlanlari"></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom">Şİfre (*) </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom"><input type="password" name="sifre" value="eskisifre" class="inputAlanlari"></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom">Şİfre Tekrar(*) </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom"><input type="password" name="sifretekrar"  value="eskisifre" class="inputAlanlari"></td>
						</tr>
						<tr height="30">
							<td colspan="2"  valign="bottom" >İsim soyisim (*) </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="top" ><input type="text" name="adsoyad" value="<?php echo $adsoyad; ?>" class="inputAlanlari"></td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="bottom" >Telefon Numarası (*) </td>
						</tr>
						<tr height="30">
							<td  colspan="2" valign="top" ><input type="Telefon" name="tel" maxlength="11" value="<?php echo $telno; ?>" class="inputAlanlari"></td>
						</tr>
						<tr>
							<td height="30" colspan="2">Cinsiyet (*) </td>
						</tr>
						<tr>
							<td colspan="2"><select name="cinsiyet" class="selectAlanlari">
								<option value="Kadın" <?php if ($cinsiyet=="Kadın") { ?> selected="selected" <?php } ?>>Kadın</option>
								<option value="Erkek" <?php if ($cinsiyet=="Erkek") { ?> selected="selected" <?php } ?>>Erkek</option>
							</select></td>
						</tr>
						<tr height="30">
							<td colspan="2" ><h6>(*) Boş bırakmayınız.</h6></td>
						</tr>
						<tr height="40">
							<td align="center" colspan="2"><input type="submit" value="BİLGİLERİMİ GÜNCELLE" class="bilgilerimiguncellebutonu"></td>
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
}else{
	header("Location:index.php");
	exit();
}
?>