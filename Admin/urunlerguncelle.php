<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenurunid=Guvenlik($_GET["id"]);
	}else{
		$gelenurunid="";
	}
	$urunlerSorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
	$urunlerSorgusu->execute([$gelenurunid]);
	$urunsayisi=$urunlerSorgusu->rowCount();
	$urunler=$urunlerSorgusu->fetch(PDO::FETCH_ASSOC);
	if($urunsayisi>0){
		?>
		<form method="post" action="index.php?SKD=0&SKI=100&id=<?php echo DonusumleriGeriDondur($gelenurunid); ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>ÜRÜNLER GÜNCELLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center" bgcolor="white" valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50">
								<td width="230" style="color: black;"><b>Ürün Menüsü</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top">
									<select name="urunmenusu" class="selectAlanlari">
										<?php
										$menuUrunTuruSorgusu=$DBConnection->prepare("SELECT * FROM menuler ORDER BY urunturu ASC, menuadi ASC");
										$menuUrunTuruSorgusu->execute();
										$menuUrunTuruSayisi=$menuUrunTuruSorgusu->rowCount();
										$menulerUrunturu=$menuUrunTuruSorgusu->fetchAll(PDO::FETCH_ASSOC);
										if ($menuUrunTuruSayisi>0) {
											foreach ($menulerUrunturu as $menuurunturu) {
												?>
												<option value="<?php echo $menuurunturu["id"]; ?>" <?php if (DonusumleriGeriDondur($urunler["menuid"])==$menuurunturu["id"]) {
													?> selected="selected" <?php } ?>>(<?php echo $menuurunturu["urunturu"]; ?>) <?php echo $menuurunturu["menuadi"]; ?></option>		
													<?php
												}
											}
											?>
										</select>
									</td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Adı</b></td>
									<td width="20" style="color: black;" > : </td>
									<td width="500" valign="top"><input type="text" class="inputAlanlari" name="urunadi" value="<?php echo $urunler["urunadi"]; ?>"></td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Fiyatı</b></td>
									<td width="20" style="color: black;">:</td>
									<td width="500" valign="top"><input class="inputAlanlari" type="text" name="urunfiyati" value="<?php echo $urunler["urunfiyati"]; ?>"></td>
								</tr>
								<tr height="50">
									<td width="230"style="color: black;"><b>Para Birimi</b></td>
									<td width="20" style="color: black;">:</td>
									<td width="500" ><select name="parabirimi" class="selectAlanlari">
										<option value="TRY" <?php if ($urunler["parabirimi"]=="TRY") { ?> selected="selected"	<?php } ?>>Türk Lirası</option>
										<option value="USD" <?php if ($urunler["parabirimi"]=="USD") { ?> selected="selected"	<?php } ?>>Amerikan Doları</option>
										<option value="EUR" <?php if ($urunler["parabirimi"]=="EUR") { ?> selected="selected"	<?php } ?>>EURO</option>
									</select></td>
								</tr>
								<tr height="50">
									<td width="230" style="color: black;"><b>KDV Oranı</b></td>
									<td width="20" style="color: black;" > : </td>
									<td width="500" valign="top"><input type="text" class="inputAlanlari" name="kdvorani" value="<?php echo $urunler["kdvorani"]; ?>"></td>
								</tr>
								<tr height="50">
									<td width="230" style="color: black;"><b>Kargo Ücreti</b></td>
									<td width="20" style="color: black;" > : </td>
									<td width="500" valign="top"><input type="text" class="inputAlanlari" name="kargoucreti" value="<?php echo $urunler["kargoucreti"]; ?>"></td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Açıklaması</b></td>
									<td width="20" style="color: black;" > : </td>
									<td width="500" valign="top"><textarea class="textareaalanlari" name="urunaciklamasi"><?php echo $urunler["urunaciklamasi"]; ?></textarea></td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Resmi 1</b></td>
									<td width="20" style="color: black;" > : </td>
									<td><input type="file" class="inputAlanlari" name="resimbir"></td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Resmi 2</b></td>
									<td width="20" style="color: black;" > : </td>
									<td><input type="file" class="inputAlanlari" name="resimiki"></td>
								</tr>
								<tr height="50" >
									<td width="230" style="color: black;"><b>Ürün Resmi 3</b></td>
									<td width="20" style="color: black;" > : </td>
									<td><input type="file" class="inputAlanlari" name="resimuc"></td>
								</tr>
								<tr height="50" style="border: solid 1px white;">
									<td width="230" style="color: black;"><b>Ürün Resmi 4</b></td>
									<td width="20" style="color: black;" > : </td>
									<td><input type="file" class="inputAlanlari" name="resimdort"></td>
								</tr>
								<tr height="50">
									<td width="230" style="color: black;"><b>Ürün Varyant Başlığı</b></td>
									<td width="20" style="color: black;" > : </td>
									<td width="500" valign="top"><input type="text" class="inputAlanlari" name="urunvaryant" value="<?php echo $urunler["varyantbasligi"]; ?>"></td>
								</tr>
								<?php
								$urunVaryantSorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE urunid=?");
								$urunVaryantSorgusu->execute([$gelenurunid]);
								$urunVaryantSayisi=$urunVaryantSorgusu->rowCount();
								$urunVaryantkayit=$urunVaryantSorgusu->fetchAll(PDO::FETCH_ASSOC);

								$varyantisimdizisi[] =array();
								$varyanstokdizisi[] =array();

								foreach ($urunVaryantkayit as $urunvaryantkayitlari) {
									$varyantisimdizisi[]=$urunvaryantkayitlari["varyantadi"];
									$varyanstokdizisi[]=$urunvaryantkayitlari["stokadedi"];
								}
								$birincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[1]);
								$birincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[1]);

								if (array_key_exists(2, $varyantisimdizisi)) {
									$ikincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[2]);
									$ikincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[2]);
								}else{
									$ikincivaryantadi="";
									$ikincistokadedi="";
								}
								if (array_key_exists(3, $varyantisimdizisi)) {
									$ucuncuvaryantadi=DonusumleriGeriDondur($varyantisimdizisi[3]);
									$ucuncustokadedi=DonusumleriGeriDondur($varyanstokdizisi[3]);
								}else{
									$ucuncuvaryantadi="";
									$ucuncustokadedi="";
								}
								if (array_key_exists(4, $varyantisimdizisi)) {
									$dorduncuvaryantadi=DonusumleriGeriDondur($varyantisimdizisi[4]);
									$dorduncustokadedi=DonusumleriGeriDondur($varyanstokdizisi[4]);
								}else{
									$dorduncuvaryantadi="";
									$dorduncustokadedi="";
								}
								if (array_key_exists(5, $varyantisimdizisi)) {
									$besincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[5]);
									$besincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[5]);
								}else{
									$besincivaryantadi="";
									$besincistokadedi="";
								}
								if (array_key_exists(6, $varyantisimdizisi)) {
									$altincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[6]);
									$altincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[6]);
								}else{
									$altincivaryantadi="";
									$altincistokadedi="";
								}
								if (array_key_exists(7, $varyantisimdizisi)) {
									$yedincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[7]);
									$yedincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[7]);
								}else{
									$yedincivaryantadi="";
									$yedincistokadedi="";
								}
								if (array_key_exists(8, $varyantisimdizisi)) {
									$sekizincivaryantadi=DonusumleriGeriDondur($varyantisimdizisi[8]);
									$sekizincistokadedi=DonusumleriGeriDondur($varyanstokdizisi[8]);
								}else{
									$sekizincivaryantadi="";
									$sekizincistokadedi="";
								}
								if (array_key_exists(9, $varyantisimdizisi)) {
									$dokuzuncuvaryantadi=DonusumleriGeriDondur($varyantisimdizisi[9]);
									$dokuzuncustokadedi=DonusumleriGeriDondur($varyanstokdizisi[9]);
								}else{
									$dokuzuncuvaryantadi="";
									$dokuzuncustokadedi="";
								}
								if (array_key_exists(10, $varyantisimdizisi)) {
									$onuncuvaryantadi=DonusumleriGeriDondur($varyantisimdizisi[10]);
									$onuncustokadedi=DonusumleriGeriDondur($varyanstokdizisi[10]);
								}else{
									$onuncuvaryantadi="";
									$onuncustokadedi="";
								}
								?>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>1. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi1" value="<?php echo $birincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>1. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi1" value="<?php echo $birincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>2. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi2" value="<?php echo $ikincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>2. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi2" value="<?php echo $ikincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>3. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi3" value="<?php echo $ucuncuvaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>3. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi3" value="<?php echo $ucuncustokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>4. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi4" value="<?php echo $dorduncuvaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>4. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi4" value="<?php echo $dorduncustokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>5. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi5" value="<?php echo $besincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>5. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi5" value="<?php echo $besincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>6. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi6" value="<?php echo $altincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>6. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi6" value="<?php echo $altincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>7. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi7" value="<?php echo $yedincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>7. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi7" value="<?php echo $yedincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>8. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi8" value="<?php echo $sekizincivaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>8. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi8" value="<?php echo $sekizincistokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>9. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi9" value="<?php echo $dokuzuncuvaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>9. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi9" value="<?php echo $dokuzuncustokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="40">
									<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="230" style="color: black;"><b>10. Varyant Adı</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="200"><input type="text" class="inputAlanlari" name="varyantadi10" value="<?php echo $onuncuvaryantadi; ?>"></td>
											<td width="20" style="color: black;" >&nbsp;</td>
											<td width="178" style="color: black;"><b>10. Varyant Stok Adedi</b></td>
											<td width="20" style="color: black;" >:</td>
											<td width="60"><input type="text" class="inputAlanlari" name="stokadedi10" value="<?php echo $onuncustokadedi; ?>"></td>
										</tr>
									</table></td>
								</tr>
								<tr height="50" >
									<td></td>
									<td></td>
									<td width="500" valign="top"><input class="yesilbuton" type="submit" value="GÜNCELLE"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
			<?php
		}else{
			header("Location:index.php?SKD=102");
			exit();
		} 
	}else{
		header("Location:index.php?SKD=1");
		exit();
	}
	?>