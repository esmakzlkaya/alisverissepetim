<?php
if(isset($_SESSION["kullanici"])){

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
	?>
	<form action="index.php?SK=97" method="post">
		<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="800" valign="top"><table  width="800" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td colspan="2" style="color: #FF9900" ><h3>ALIŞVERİŞ SEPETİ</h3></td>
					</tr>
					<tr height="30" bgcolor="#ffa420">
						<td style="border-bottom: 1px solid #CCCCCC; color: black;" class=""><b>&nbsp;Adres Seçimi</b></td>
						<td style="border-bottom: 1px solid #CCCCCC;" align="right"><b><a href="index.php?SK=70" class="hesabimlink">&nbsp;+ Yeni Adres Ekle&nbsp;</a></b></td>
					</tr>
					<tr>
						<?php 
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
								
								if ($sepettekitoplamurunfiyati>=$ucretsizkargobarajı) {
									$urunlerurunkargoucreti=0;
								}else{
									$urunlerurunkargoucreti=DonusumleriGeriDondur($urunlerkaydi["kargoucreti"]);
								}

								$odenecektoplamtutar=$sepettekitoplamurunfiyati+$urunlerurunkargoucreti;
							}

							$adressorgusu=$DBConnection->prepare("SELECT * FROM adresler WHERE uyeid=? ORDER BY id DESC");
							$adressorgusu->execute([$id]);
							$adressayisi=$adressorgusu->rowCount();
							$adres=$adressorgusu->fetchAll(PDO::FETCH_ASSOC);
							if($adressayisi>0){
								$SecimIcinSayi=1;
								foreach ($adres as $adreskayitlari) {
									?>
									<td  colspan="2" valign="bottom" align="left"><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr height="60"> 
											<td width="50" align="left" style="border-bottom: 1px solid #CCCCCC;"><input type="radio" name="adressecimi" value="<?php echo DonusumleriGeriDondur($adreskayitlari["id"]); ?>" <?php if($SecimIcinSayi==1){ ?> checked="checked" <?php } ?>></td>
											<td width="750" style="border-bottom: 1px solid #CCCCCC;"><?php echo DonusumleriGeriDondur($adreskayitlari["adsoyad"]); ?> - <?php echo DonusumleriGeriDondur($adreskayitlari["adres"]);  ?>  - <?php echo DonusumleriGeriDondur($adreskayitlari["ilce"]);  ?>  / <?php echo DonusumleriGeriDondur($adreskayitlari["sehir"]); ?>  - <?php echo DonusumleriGeriDondur($adreskayitlari["telno"]); ?></td>
										</tr>
									</table></td>
								</tr>
								<?php
								$SecimIcinSayi++;
							}
						}else{
							?>
							<tr height="30">
								<td colspan="2" >Kayıtlı adres bulunmamaktadır. </td>
							</tr>
							<?php
						}
						?>

						<tr height="30" bgcolor="#ffa420">
							<td colspan="2" style="border-bottom: 1px solid #CCCCCC; color: black;" class=""><b>&nbsp;Kargo Seçimi</b></td>
						</tr>
						<tr>
							<td  colspan="2" >&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"  width="800"><table width="800" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
								<tr>
									<?php
									$kargosorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari");
									$kargosorgusu->execute();
									$kargosayisi=$kargosorgusu->rowCount();
									$kargo=$kargosorgusu->fetchAll(PDO::FETCH_ASSOC);
									if($kargosayisi>0){

										$dongusayisi=1;
										$sutunadedi=3;
										$SecimIcinSayi=1;

										foreach ($kargo as $kargokayitlari) {
											?>
											<td width="260">
												<table width="260" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr height="40">
														<td align="center">&nbsp;<img height="" src="Resimler/<?php echo $kargokayitlari["kargofirmasilogosu"]; ?>"></td>
													</tr>
													<tr>
														<td align="center" ><input type="radio" name="kargosecimi" <?php if($SecimIcinSayi==1){ ?>checked="checked" <?php } ?> value="<?php echo DonusumleriGeriDondur($kargokayitlari["id"]); ?>"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
												</table>
											</td>
											<?php
											$SecimIcinSayi++;
											if($dongusayisi<$sutunadedi){
												?>
												<td width="10">&nbsp;</td>	
												<?php
											}

											$dongusayisi++;

											if($dongusayisi>$sutunadedi){
												echo "</tr><tr>";
												$dongusayisi=1;
											}
										}
									}
									?>
								</tr>
							</table></td>
						</tr>

						<?php

					}else{
						header("Location:index.php?SK=92");
						exit();
					}
					?>
				</table></td>
				<td width="15">&nbsp;</td>

				<td width="250"  valign="top"><table width="250" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr height="40">
						<td valign="top" colspan="2" style="color: #FF9900" ><h3>SİPARİŞ ÖZETİ</h3></td>
					</tr>
					<tr height="30">
						<td valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC;">Sepette toplam <b style="color: red;"><?php echo $sepettekitoplamurunsayisi; ?></b> ürün var</td>
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
						<td align="right"><input type="submit" value="ÖDEME SEÇİMİ" class="AlisverisiTamamlaButonu"></td>
					</tr>
				</table></td>
			</tr>
		</table>
	</form>
	<?php 
}else{
	header("Location:index.php");
	exit();
} 
?>