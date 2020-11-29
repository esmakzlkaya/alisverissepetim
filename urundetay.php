<?php
if(isset($_GET["id"])){
	$gelenurunid		=	RakamliIfadeler(Guvenlik($_GET["id"]));

	$urunhitiguncelle=$DBConnection->prepare("UPDATE urunler SET goruntulenmesayisi=goruntulenmesayisi+1 WHERE id=? AND durumu=? LIMIT 1");
	$urunhitiguncelle->execute([$gelenurunid,1]);
	
	$urundetaysorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=? AND durumu=? LIMIT 1");
	$urundetaysorgusu->execute([$gelenurunid,1]);
	$urundetaysayisi=$urundetaysorgusu->rowCount();
	$urundetaykaydi = $urundetaysorgusu->fetch(PDO::FETCH_ASSOC);

	if ($urundetaysayisi>0) {
		$UrununFiyati		=	DonusumleriGeriDondur($urundetaykaydi["urunfiyati"]);
		$UrununParaBirimi	=	DonusumleriGeriDondur($urundetaykaydi["parabirimi"]);

		$gelenurunturu=$urundetaykaydi["urunturu"];
		if ($gelenurunturu=="Erkek Ayakkabısı") {
			$urunklasoradi="Erkek";
		}elseif ($gelenurunturu=="Kadın Ayakkabısı") {
			$urunklasoradi="Kadin";
		}else{
			$urunklasoradi="Cocuk";
		}

		if ($UrununParaBirimi=='USD') {
			$urunfiyatihesapla=$UrununFiyati*$dolarkuru;
		}elseif ($UrununParaBirimi=='EUR') {
			$urunfiyatihesapla=$UrununFiyati*$eurokuru;
		}else{
			$urunfiyatihesapla=$UrununFiyati;
		}

		?>
		<table width="1065" align="center" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="350" valign="top"><table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" style="border: 1px solid #CCCCCC;"><img id="buyukresim" src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimbir"]; ?>" width="330" height="440" border="0"></td>
					</tr>
					<tr>
						<td style="font-size: 5px;">&nbsp;</td>
					</tr>
					<tr>
						<td><table width="350" align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimbir"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimbir"]; ?>');"></td>
								<td width="10">&nbsp;</td>
								<?php if ($urundetaykaydi["resimiki"]!="") {
									?>
									<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimiki"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimiki"]; ?>');"></td>
									<td width="10">&nbsp;</td>
								<?php }else{
									?>
									<td width="78">&nbsp;</td>
									<?php
								}
								if ($urundetaykaydi["resimuc"]!="") {
									?>
									<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimuc"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimuc"]; ?>');"></td>
									<td width="10">&nbsp;</td>
								<?php }else{
									?>
									<td width="78">&nbsp;</td>
									<?php
								}
								if ($urundetaykaydi["resimdort"]!="") {
									?>
									<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimdort"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimdort"]; ?>');"></td>
									<td width="10">&nbsp;</td>
								<?php }else{
									?>
									<td width="78">&nbsp;</td>
									<?php
								}  ?>
							</tr>
						</table></td>
					</tr>
					<tr>&nbsp;</tr>
					<tr>
						<td><table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50">
								<td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
							</tr>
							<?php
							$BannerSorgusu		=	$DBConnection->prepare("SELECT * FROM bannerlar WHERE banneralani = 'Ürün Detay' ORDER BY gosterimsayisi ASC LIMIT 1");
							$BannerSorgusu->execute();
							$BannerSayisi		=	$BannerSorgusu->rowCount();
							$BannerKaydi		=	$BannerSorgusu->fetch(PDO::FETCH_ASSOC);
							if ($BannerSayisi>0) {
								?>
								<tr height="350">
									<td><img src="Resimler/Banner/<?php echo $BannerKaydi["bannerresmi"]; ?>" border="0"></td>
								</tr>
								<?php
								$BannerGuncelle		=	$DBConnection->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
								$BannerGuncelle->execute([$BannerKaydi["id"]]);
							}
							?>
						</table></td>
					</tr>
				</table></td>
				<td width="10" valign="top">&nbsp;</td>

				<td width="705" valign="top"><table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr bgcolor="#d53e07" height="50" style="color: white;">
						<td align="center" style="text-align: center; font-size: 18px; font-weight: bold;">&nbsp;<?php echo $urundetaykaydi["urunadi"]; ?></td>
					</tr>
					<tr>
						<td style="font-size: 5px;">&nbsp;</td>
					</tr>
					<tr>
						<td><form method="post" action="index.php?SK=90&id=<?php echo $$urundetaykaydi["id"]; ?>"><table width="705" border="0" cellpadding="0" cellspacing="0" align="center">
							<tr height="45">
								<td width="30">
									<?php if (isset($_SESSION["kullanici"])) {?><a href="index.php?SK=86&id=<?php echo $$urundetaykaydi["id"]; ?>"><img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" border="0" style="margin-top: 5px;"></a>
								<?php }else{ ?> <img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" border="0" style="margin-top: 5px;"><?php } ?>
							</td>
							<td width="10">&nbsp;</td>
							<td width="665" align="right"><input type="submit" value="SEPETE EKLE" class="sepeteeklebutonu"></td>
						</tr>
						<tr>
							<td colspan="3"><table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
								<tr height="45">
									<td width="500" align="left"><select class="selectAlanlari" name="varyantselect">
										<option value="">Lütfen <?php echo $urundetaykaydi["varyantbasligi"]; ?> seçiniz. </option>
										<?php 
										$varyantsorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE urunid=? AND stokadedi>0 ORDER BY varyantadi ASC ");
										$varyantsorgusu->execute([$urundetaykaydi["id"]]);
										$varyantsayisi=$varyantsorgusu->rowCount();
										$varyantlar=$varyantsorgusu->fetchAll(PDO::FETCH_ASSOC);
										if ($varyantsayisi>0) {
											foreach ($varyantlar as $urunvaryantlari) {
												?>
												<option value="<?php echo $urunvaryantlari["id"]; ?>"><?php echo $urunvaryantlari["varyantadi"]; ?></option>
												<?php
											}
											?>
										</select></td>
										<?php 
									} ?>
									<td width="205" align="right" style="font-size: 25px; font-weight: bold; color: black;"><?php echo fiyatbicimlendir($urunfiyatihesapla); ?> TL </td>
								</tr>
							</table></td>
						</tr>
					</table></form>
				</td>
			</tr>
			<tr>
				<td><hr/></td>
			</tr>
			<tr>
				<td>
					<tr height="40">
						<td style="color:#d53e07; border-bottom: 1px solid #d84b20;"><b>ÜRÜN AÇIKLAMASI</b></td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td height="30"><?php echo $urundetaykaydi["urunaciklamasi"]; ?></td>
					</tr>
				</td>
			</tr>
			
			<tr>
				<td>
					<tr height="40">
						<td style="color:#d53e07; margin-top: 20px 0px; border-bottom: 1px solid #d84b20;" ><b>YORUMLAR</b></td>
					</tr>
					<tr height="50">
						<td><div style="width: 705px;  max-height: 300px; overflow-y :scroll;">
							<table width="685" align="center" border="0" cellspacing="0" cellpadding="0">
								<?php 
								$yorumsorgusu=$DBConnection->prepare("SELECT * FROM yorumlar WHERE urunid=? ORDER BY yorumtarihi DESC");
								$yorumsorgusu->execute([$urundetaykaydi["id"]]);
								$yorumsayisi=$yorumsorgusu->rowCount();
								$yorumlar=$yorumsorgusu->fetchAll(PDO::FETCH_ASSOC);
								if ($yorumsayisi>0) {
									foreach ($yorumlar as $urunyorumlari) {
										$yorumyapanuyeID=$urunyorumlari["uyeid"];
										$yorumpuani=$urunyorumlari["puan"];

										if ($yorumpuani==0) {
											?>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<?php
										}elseif(($yorumpuani>0) and ($yorumpuani<=1)){
											$puanresmi="YildizBirDolu.png";
										}elseif(($yorumpuani>1) and ($yorumpuani<=2)){
											$puanresmi="YildizIkiDolu.png";
										}elseif(($yorumpuani>2) and ($yorumpuani<=3)){
											$puanresmi="YildizUcDolu.png";
										}elseif(($yorumpuani>3) and ($yorumpuani<=4)){
											$puanresmi="YildizDortDolu.png";
										}elseif(($yorumpuani>4)){
											$puanresmi="YildizBesDolu.png";
										}

										$uyesorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE id=? LIMIT 1");
										$uyesorgusu->execute([$yorumyapanuyeID]);
										$uyesayisi=$uyesorgusu->rowCount();
										$uyeler=$uyesorgusu->fetch(PDO::FETCH_ASSOC);
										if ($uyesayisi) {
											?>
											<tr height="40">
												<td width="64"><img src="Resimler/<?php echo $puanresmi; ?>"></td>
												<td width="10">&nbsp;</td>
												<td width="451"><?php echo $uyeler["adsoyad"]; ?></td>
												<td width="10">&nbsp;</td>
												<td width="150" style="margin-top: 0px 30px ;" align="right"><?php echo TarihBul($urunyorumlari["yorumtarihi"]); ?>&nbsp;</td>
											</tr>
											<tr height="30">
												<td colspan="5"><?php echo $urunyorumlari["yorummetni"]; ?></td>
											</tr>
											<?php
										}
									}
								}else{
									?>
									<tr height="40">
										<td>Ürün için henüz yorum yapılmamış. </td>
									</tr>
									<?php
								}
								?>
							</table>
						</div></td>
					</tr>
				</td>
			</tr>
			<tr>
				<td><hr/></td>
			</tr>
			<tr>
				<td><table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr><td>&nbsp;</td></tr>
					<tr height="30">
						<td><img src="Resimler/SaatEsnetikGri20x20.png"></td>
						<td>Siparişiniz <?php echo ucgunileritarihbul(); ?> tarihine kadar kargoya verilecektir. </td>
					</tr>
					<tr height="30">
						<td><img src="Resimler/SaatHizCizgiliLacivert20x20.png"></td>
						<td>Ürün süper hızlı gönderi kapsamındadır, aynı gün kargoya verilir. </td>
					</tr>
					<tr height="30">
						<td><img src="Resimler/KrediKarti20x20.png"></td>
						<td>Tüm banka kartları ile peşin veya taksitli ödeme seçeneği. </td>
					</tr>
					<tr height="30">
						<td><img src="Resimler/Banka20x20.png"></td>
						<td>Tüm bankalar ile havale / EFT seçeneği. </td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table>
<?php

}
else{
	header("Location:index.php");
}
}else{
	header("Location:index.php");
	exit();
}
?>
