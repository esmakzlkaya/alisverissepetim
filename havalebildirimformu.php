<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height="">
		<td width="500" valign="top">
			<form action="index.php?SK=10" method="post">
				<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="40">
						<td style="color: #FF9900" ><h3>HAVALE BİLDİRİM FORMU</h3></td>
					</tr>
					<tr height="30">
						<td style="border-bottom: 1px solid #CCCCCC;" class="">Tamamlanmış ödeme işlemlerinizi buradan bildiriniz.</td>
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
						<td valign="bottom" >Ödeme Yapılan Banka (*) </td>
					</tr>
					<tr height="30">
						<td valign="top" ><select name="bankasecimi" class="selectAlanlari">
							<?php 
							$bankalarsorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari ORDER BY bankaadi ASC");
							$bankalarsorgusu->execute();
							$sayisi=$bankalarsorgusu->rowCount();
							$bankalar=$bankalarsorgusu->fetchAll(PDO::FETCH_ASSOC);
							foreach ($bankalar as $banka) {								
								?>
								<option value="<?php echo DonusumleriGeriDondur($banka["id"]); ?>"><?php echo DonusumleriGeriDondur($banka["bankaadi"]); ?></option>
								<?php
							}
							?>
						</select></td>
					</tr>
					<tr height="30">
						<td valign="bottom" >Açıklama</td>
					</tr>
					<tr height="30">
						<td valign="top" ><textarea name="Aciklama" class="textareaalanlari" style="padding: 5px 10px;"></textarea></td>
					</tr>
					<tr>
						<td><h6>(*) Boş bırakmayınız.</h6></td>
					</tr>
					<tr height="40">
						<td align="center"><input type="submit" value="Bildirimi Gönder" class="yesilbuton"></td>
					</tr>
				</table>
			</form>
		</td>
		<td width="20">&nbsp;</td>
		<td width="545"  valign="top">
			<table width="545" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="40">
					<td style="color: #FF9900" colspan="2"><h3>İŞLEYİŞ</h3></td>
				</tr>
				<tr height="30">
					<td colspan="2" style="border-bottom: 1px solid #CCCCCC;">Havale / EFT para transferleri kontrolü.</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/Banka20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Havale / EFT işlemi</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Müşteriler tarafından öncelikle banka hesaplarımız sekmesinde belirtilen banka hesaplarından herhangi biri ile havale işlemi gerçekleştirilir.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/DokumanKirmiziKalemli20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Bildirim işlemi</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Ödeme işleminizi tamamladıktan sonra "Havale Bildirim Formu" sayfasından yapmış olduğunuz ödeme için bildirim formunu doldurarak online olarak gönderir. </td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/CarklarSiyah20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Kontroller</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">"Havale Bildirim Formu" tarafınıza ulaştığı anda ilgili departman tarafından yapmış olduğunuz havale / EFT işleminiz kontrol edilir.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/InsanlarSiyah20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Onay / Red</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Havale bildirimi geçerli ise yani hesaba ödeme geçmiş ise, yönetici ilgili ödeme onayını verir, siparişiniz teslimat birimine iletilir.</td>
				</tr>
				<tr>
					<td height="5" colspan="2">&nbsp;</td>
				</tr>
				<tr height="30">
					<td align="left" width="30"><img src="Resimler/SaatEsnetikGri20x20.png" border="0" style="margin-top: 3px;"></td>
					<td align="left"><b>Sipariş Onay / Teslimat</b></td>
				</tr>
				<tr height="">
					<td colspan="2" align="left">Sipariş ödeme onayından sonra vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir ve tarafınıza ulaştırılır. </td>
				</tr>

			</table>
		</td>
	</tr>
</table>
<?php 

$DBConnection=null;
 ?>