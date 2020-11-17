<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height="">
		<td width="500" valign="top">
			<form action="index.php?SK=23" method="post">
				<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="40">
						<td colspan="2" style="color: #FF9900" ><h3>ÜYE OL</h3></td>
					</tr>
					<tr height="30">
						<td colspan="2" style="border-bottom: 1px solid #CCCCCC;" class="">Hesabın yok mu? Hemen oluştur.</td>
					</tr>
					
					<tr height="30">
						<td  colspan="2"  valign="bottom"  >E-mail adresi (*) </td>
					</tr>
					<tr height="30">
						<td colspan="2" valign="top" ><input type="E-mail" name="mail" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="bottom">Şİfre (*) </td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="bottom"><input type="password" name="sifre" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="bottom">Şİfre Tekrar(*) </td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="bottom"><input type="password" name="sifretekrar" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td colspan="2"  valign="bottom" >İsim soyisim (*) </td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="top" ><input type="text" name="adsoyad" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="bottom" >Telefon Numarası (*) </td>
					</tr>
					<tr height="30">
						<td  colspan="2" valign="top" ><input type="Telefon" name="tel" maxlength="11" class="inputAlanlari"></td>
					</tr>
					<tr>
						<td height="30" colspan="2">Cinsiyet (*) </td>
					</tr>
					<tr>
						<td colspan="2"><select name="cinsiyet" class="selectAlanlari">
							<option >Lütfen seçiniz</option>
							<option value="Kadın">Kadın</option>
							<option value="Erkek">Erkek</option>
						</select></td>
					</tr>
					<tr height="30">
						<td colspan="2" ><h6>(*) Boş bırakmayınız.</h6></td>
					</tr>
					<tr height="30"> 
						<td align="left" width="25"><input type="checkbox" name="uyeliksozlesmeonay" value="1"></td>
						<td  align="left" width="475" class="uyelikFormu"><a href="index.php?SK=2" target="_blank">Üyelik sözleşmesi </a>' ni okudum, onaylıyorum. (*) </td>
					</tr>
					<tr height="40">
						<td align="center" colspan="2"><input type="submit" value="ÜYE OL" class="yesilbuton"></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php 

$DBConnection=null;
?>