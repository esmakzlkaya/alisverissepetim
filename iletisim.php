<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height="">
		<td width="500" valign="top">
			<form action="index.php?SK=17" method="post">
				<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="40">
						<td style="color: #FF9900" ><h3>İLETİŞİM</h3></td>
					</tr>
					<tr height="30">
						<td style="border-bottom: 1px solid #CCCCCC;" class="">Bir sorunuz mu var? Lütfen bizlere ulaşın..</td>
					</tr>
					<tr height="30">
						<td valign="bottom" >İsim soyisim (*) </td>
					</tr>
					<tr height="30">
						<td valign="top" ><input type="text" name="adsoyad" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td valign="bottom"  >E-mail adresi (*) </td>
					</tr>
					<tr height="30">
						<td valign="top" ><input type="E-mail" name="mail" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" >Telefon Numarası (*) </td>
					</tr>
					<tr height="30">
						<td valign="top" ><input type="Telefon" name="tel" maxlength="11" class="inputAlanlari"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" >Mesaj (*)</td>
					</tr>
					<tr height="30">
						<td valign="top" ><textarea name="mesaj" class="textareaalanlari" style="padding: 5px 10px;"></textarea></td>
					</tr>
					<tr>
						<td><h6>(*) Boş bırakmayınız.</h6></td>
					</tr>
					<tr height="40">
						<td align="center"><input type="submit" value="Mesajımı Gönder" class="yesilbuton"></td>
					</tr>
				</table>
			</form>
		</td>
		<td width="20">&nbsp;</td>
		<td width="545"  valign="top">
			<table width="545" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="40">
					<td style="color: #FF9900" colspan="2"><h3>DEĞERLENDİRMEYE ALINMAYAN MESAJLAR</h3></td>
				</tr>
				<tr height="30">
					<td colspan="2" style="border-bottom: 1px solid #CCCCCC;">Geçersiz / spam mesaj içerikleri şunlardır :</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/DokumanKirmiziKalemli20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Geçersiz Bilgi Girişi</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">İsim soyisim, e-mail adresi veya cep telefonu bilgileri rastegele veya geçersiz bir şekilde doldurulan mesajlar.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/UcuncuSahislar20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>3. Şahıslar</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Sitemiz kullanıcı hesapları ile alakalı (bilgi edinme, şifre talebi vb.) herhangi bir yakını, arkadaşı vb. 3 . şahıslar tarafından gönderilen mesajlar.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/HedefMaviOkSiyah20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Reklam / Tanıtım</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Site, kurum veya kuruluşları ile alakalı reklam veya tanıtım içerikli mesajlar.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/InsanlarSiyah20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Politika / Siyaset</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Politik veya siyasi içerikli mesajlar.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Yukarıda belirtilen konular vb. durumlarda gönderilen tüm mesajlar spam olarak işleme alınacaktır.</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php 
$DBConnection=null;
 ?>