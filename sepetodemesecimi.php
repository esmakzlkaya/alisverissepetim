<?php
if(isset($_SESSION["kullanici"])){
	if (isset($_POST["adressecimi"])) {
		$gelenadressecimi=Guvenlik($_POST["adressecimi"]);
	}else{
		$gelenadressecimi="";
	}
	if (isset($_POST["kargosecimi"])) {
		$gelenkargosecimi=Guvenlik($_POST["kargosecimi"]);
	}else{
		$gelenkargosecimi="";
	}
	if (($gelenkargosecimi!="")and($gelenadressecimi!="")) {

		$kargoadresguncellesorgusu=$DBConnection->prepare("UPDATE sepet SET kargofirmasiid=?, adresid=? WHERE uyeid=?");
		$kargoadresguncellesorgusu->execute([$gelenkargosecimi,$gelenadressecimi,$id]);
		$kargoadresguncellekontrol=$kargoadresguncellesorgusu->rowCount();

		$stokicinsepettekiurunlersorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ");
		$stokicinsepettekiurunlersorgusu->execute([$id]);
		$stokicinsepeturunlerisayisi=$stokicinsepettekiurunlersorgusu->rowCount();
		$stokicinsepeturunleri=$stokicinsepettekiurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
		if ($stokicinsepeturunlerisayisi>0) {
			foreach ($stokicinsepeturunleri as $stoksepeturun) {
				$stoksepetid=$stoksepeturun["id"];
				$stoksepeturunid=$stoksepeturun["urunid"];
				$stoksepetvaryantid=$stoksepeturun["varyantid"];
				$stoksepeturunadedi=$stoksepeturun["urunadedi"];

				$stokicinvaryantbilgilerisorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
				$stokicinvaryantbilgilerisorgusu->execute([$stoksepetvaryantid]);
				$stokicinvaryantbilgileri=$stokicinvaryantbilgilerisorgusu->fetch(PDO::FETCH_ASSOC);

				$stokvaryantstokadedi=$stokicinvaryantbilgileri["stokadedi"];
				if ($stokvaryantstokadedi==0) {
					$silsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE id=? AND uyeid=? LIMIT 1");
					$silsorgusu->execute([$stoksepetid,$id]);
				}
				elseif ($stoksepeturunadedi>$stokvaryantstokadedi) {
					$sepetguncellemesorgusu=$DBConnection->prepare("UPDATE sepet SET urunadedi=? WHERE id=? AND uyeid=? LIMIT 1");
					$sepetguncellemesorgusu->execute([$stokvaryantstokadedi,$stoksepetid,$id]);
				}
			}
		}
		$sepettekitoplamurunsayisi=0;
		$sepettekitoplamurunfiyati=0;
		$odenecektoplamtutar=0;
		$sepeturunlerisorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ORDER BY id DESC");
		$sepeturunlerisorgusu->execute([$id]);
		$sepeturunsayisi=$sepeturunlerisorgusu->rowCount();
		$sepeturunlerkaydi=$sepeturunlerisorgusu->fetchAll(PDO::FETCH_ASSOC);
		if ($sepeturunsayisi>0) {
			foreach ($sepeturunlerkaydi as $sepeturunkaydi) {

				$sepetid=DonusumleriGeriDondur($sepeturunkaydi["id"]);
				$sepeturunid=DonusumleriGeriDondur($sepeturunkaydi["urunid"]);
				$sepetvaryantid=DonusumleriGeriDondur($sepeturunkaydi["varyantid"]);
				$sepeturunadedi=DonusumleriGeriDondur($sepeturunkaydi["urunadedi"]);

				$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=?  LIMIT 1");
				$urunlersorgusu->execute([$sepeturunid]);
				$urunlersayisi=$urunlersorgusu->rowCount();
				$urunlerkaydi=$urunlersorgusu->fetch(PDO::FETCH_ASSOC);

				$urunlerurunturu=DonusumleriGeriDondur($urunlerkaydi["urunturu"]);
				$urunlerurunadi=DonusumleriGeriDondur($urunlerkaydi["urunadi"]);
				$urunlerurunparabirimi=DonusumleriGeriDondur($urunlerkaydi["parabirimi"]);
				$urunlerurunfiyati=DonusumleriGeriDondur($urunlerkaydi["urunfiyati"]);
				$urunlerurunkargoucreti=DonusumleriGeriDondur($urunlerkaydi["kargoucreti"]);

				if ($urunlerurunturu=="Erkek Ayakkabısı") {
					$klasoradi="Erkek";
				}elseif ($urunlerurunturu=="Kadın Ayakkabısı") {
					$klasoradi="Kadin";
				}else{
					$klasoradi="Cocuk";
				}

				if ($urunlerurunparabirimi=="USD") {
					$urunfiyatihesapla=($urunlerurunfiyati*$dolarkuru);
				}elseif ($urunlerurunparabirimi=="EUR") {
					$urunfiyatihesapla=($urunlerurunfiyati*$eurokuru);
				}else{
					$urunfiyatihesapla=$urunlerurunfiyati;
				}

				$sepettekitoplamurunsayisi=($sepettekitoplamurunsayisi+$sepeturunadedi);
				$sepettekitoplamurunfiyati=($sepettekitoplamurunfiyati+($urunfiyatihesapla*$sepeturunadedi));
			}
			if ($sepettekitoplamurunfiyati>=$ucretsizkargobarajı) {
				$urunlerurunkargoucreti=0;
			}else{
				$urunlerurunkargoucreti=DonusumleriGeriDondur($urunlerkaydi["kargoucreti"]);
			}
			$odenecektoplamtutar=$sepettekitoplamurunfiyati+$urunlerurunkargoucreti;
			$ikitaksitaylikodemetutari=($odenecektoplamtutar/2);
			$uctaksitaylikodemetutari=($odenecektoplamtutar/3);
			$dorttaksitaylikodemetutari=($odenecektoplamtutar/4);
			$bestaksitaylikodemetutari=($odenecektoplamtutar/5);
			$altitaksitaylikodemetutari=($odenecektoplamtutar/6);
			$yeditaksitaylikodemetutari=($odenecektoplamtutar/7);
			$sekiztaksitaylikodemetutari=($odenecektoplamtutar/8);
			$dokuztaksitaylikodemetutari=($odenecektoplamtutar/9);
		}
		?>
		<form action="index.php?SK=98" method="post">
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="800" valign="top"><table  width="800" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="30">
							<td style="color: #FF9900" ><h3>ALIŞVERİŞ SEPETİ</h3></td>
						</tr>
						<tr height="30" bgcolor="#ffa420">
							<td style="border-bottom: 1px solid #CCCCCC; color: black;" class=""><b>&nbsp;Ödeme Seçimi</b></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="390" align="left"><table width="390" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/KrediKarti92x75.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" name="odemeturusecimi" value="Kredi Kartı" checked="checked" onClick="$.kredikartisecildi();"></td>
										</tr>
									</table></td>
									<td width="20">&nbsp;</td>
									<td width="390" align="right"><table width="390" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/Banka80x75.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center"><input type="radio" name="odemeturusecimi" value="Banka Havalesi" onClick="$.havalesecildi();"></td>
										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
						<tr class="KKalanlari" >
							<td>&nbsp;</td>
						</tr>
						<tr class="KKalanlari" height="30" bgcolor="#ffa420" style="color: black;">
							<td class=""><b>&nbsp;Kredi Kartı ile Ödeme</b></td>
						</tr>
						<tr class="KKalanlari">
							<td >&nbsp;</td>
						</tr>
						<tr class="KKalanlari">
							<td class="">Lütfen ödeme yapmak istediğiniz kartı aşağıdan seçiniz. Aradığınız kart listede yer almıyorsa lütfen 'DİĞER' seçeneğini kullanın. Bankamatik kartları için 'ATM Kartları' seçeneğini kullanabilirsiniz.</td>
						</tr>
						<tr class="KKalanlari">
							<td>&nbsp;</td>
						</tr>
						<tr class="KKalanlari">
							<td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiAxessCard.png" ></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="11"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiMaximumCard.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="11"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiParafCard.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="10"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiWorldCard.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
								</tr>
								<tr>
									<td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiATMKarti.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="11"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiBonusCard.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="11"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiCardFinans.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
									<td width="10"></td>
									<td width="192"><td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr height="40">
											<td align="center">&nbsp;<img height="" src="Resimler/OdemeSecimiDigerKartlar.png"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
						<tr class="KKalanlari" height="30" bgcolor="#ffa420" style="color: black;">
							<td  class=""><b>&nbsp;Taksit Seçimi</b></td>
						</tr>
						<tr class="KKalanlari">
							<td >&nbsp;</td>
						</tr>
						<tr class="KKalanlari">
							<td class="">Lütfen uygulanmasını istediğiniz taksit sayısını belirtiniz. </td>
						</tr>
						<tr class="KKalanlari">
							<td>&nbsp;</td>
						</tr>
						<tr class="KKalanlari">
							<td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height=30>
									<td width="50" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="1" checked="checked"></td>
									<td width="300" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">Tek Çekim</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">1 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
									<td width="200" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="2"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">2 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">2 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($ikitaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="3"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">3 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">3 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($uctaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="4"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">4 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">4 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($dorttaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="5"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">5 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">5 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($bestaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="6"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">6 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">6 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($altitaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="7"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">7 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">7 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($yeditaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="8"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">8 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">8 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($sekiztaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
								<tr height=30>
									<td width="25" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><input type="radio" name="taksitsecimi" value="9"></td>
									<td width="275" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">9 Taksit</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;">9 x <?php echo fiyatbicimlendir(DonusumleriGeriDondur($dokuztaksitaylikodemetutari)); ?> TL</td>
									<td width="250" align="left" style="border-bottom: 1px solid #CCCCCC; color: black;"><?php echo fiyatbicimlendir(DonusumleriGeriDondur($odenecektoplamtutar)); ?> TL</td>
								</tr>
							</table></td>
						</tr>
						<tr  style="display:none;" class="BHalanlari">
							<td>&nbsp;</td>
						</tr>
						<tr style="display:none;" class="BHalanlari" height="30" bgcolor="#ffa420" style="color: black;">
							<td  style="color: black;" class=""><b>&nbsp;HAVALE / EFT </b></td>
						</tr>
						<tr class="BHalanlari" style="display:none;">
							<td >&nbsp;</td>
						</tr>
						<tr class="BHalanlari" style="display:none;">
							<td class="">Havale / EFT ile ürün satın alabilmek için öncelikle alışveriş sepeti ödenecek toplam tutarı kadar "Banka Hesapları" sayfasında bulunan herhangi bir hesaba ödeme yaptıktan sonra "Havale Bildirim Formu" aracılığı ile lütfen tarafımızı bilgilendiriniz. Ödeme yap butonuna tıkladığınız anda siparişiniz sisteme kayıt edilecektir. </td>
						</tr>
						<tr class="BHalanlari" style="display:none;">
							<td>&nbsp;</td>
						</tr>
					</table></td>
					<td width="15">&nbsp;</td>
					<td width="250"  valign="top"><table width="250" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="40">
							<td colspan="2" valign="top" style="color: #FF9900" ><h3>SİPARİŞ ÖZETİ</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" valign="top" style="border-bottom: 1px solid #CCCCCC;">Sepette toplam <b style="color: red;"><?php echo $sepettekitoplamurunsayisi; ?></b> ürün var</td>
						</tr>
						<tr>
							<td valign="top ">Ödenecek Toplam Tutar : </td>
							<td valign="top" style="font-size: 25px;"><?php echo fiyatbicimlendir($odenecektoplamtutar); ?> TL </td>
						</tr>
						<tr>
							<td valign="top ">Ürünler Toplam Tutarı : </td>
							<td valign="top" style="font-size: 25px;"><?php echo fiyatbicimlendir($sepettekitoplamurunfiyati); ?> TL </td>
						</tr>
						<tr>
							<td valign="top ">Kargo Ücreti : </td>
							<td valign="top" style="font-size: 25px;"><?php echo fiyatbicimlendir($urunlerurunkargoucreti); ?> TL </td>
						</tr>
						<tr>
							<td align="right"><input type="submit" value="ÖDEME YAP" class="AlisverisiTamamlaButonu"></td>
						</tr>
					</table></td>
				</tr>
			</table>
		</form>
		<?php 		
	}else{
		header("Location:anasayfa");
		exit();		
	}
}else{
	header("Location:anasayfa");
	exit();
} 
?>