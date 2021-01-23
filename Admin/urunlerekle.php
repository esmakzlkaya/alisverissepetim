<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=96" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YENİ ÜRÜNLER EKLE</h3></td>
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
									<option value="">Lütfen Seçiniz</option>
									<?php
									$menuUrunTuruSorgusu=$DBConnection->prepare("SELECT * FROM menuler ORDER BY urunturu ASC, menuadi ASC");
									$menuUrunTuruSorgusu->execute();
									$menuUrunTuruSayisi=$menuUrunTuruSorgusu->rowCount();
									$menulerUrunturu=$menuUrunTuruSorgusu->fetchAll(PDO::FETCH_ASSOC);
									if ($menuUrunTuruSayisi>0) {
										foreach ($menulerUrunturu as $menuurunturu) {
											?>
											<option value="<?php echo $menuurunturu["id"]; ?>">(<?php echo $menuurunturu["urunturu"]; ?>) <?php echo $menuurunturu["menuadi"]; ?></option>		
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
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="urunadi"></td>
						</tr>
						<tr height="50" >
							<td width="230" style="color: black;"><b>Ürün Fiyatı</b></td>
							<td width="20" style="color: black;">:</td>
							<td width="500" valign="top"><input class="inputAlanlari" type="text" name="urunfiyati"></td>
						</tr>
						<tr height="50" >
							<td width="230" style="color: black;"><b>Para Birimi</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="parabirimi"></td>
						</tr>
						<tr height="50">
							<td width="230" style="color: black;"><b>KDV Oranı</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="kdvorani"></td>
						</tr>
						<tr height="50" >
							<td width="230" style="color: black;"><b>Ürün Açıklaması</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><textarea class="textareaalanlari" name="urunaciklamasi"></textarea></td>
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
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="urunvaryant"></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>1. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi1"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>1. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi1"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>2. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi2"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>2. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi2"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>3. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi3"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>3. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi3"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>4. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi4"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>4. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi4"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>5. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi5"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>5. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi5"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>6. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi6"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>6. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi6"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>7. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi7"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>7. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi7"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>8. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi8"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>8. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi8"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>9. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi9"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>9. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi9"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="40">
							<td colspan="3" align="left"><table width="728" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="230" style="color: black;"><b>10. Varyant Adı</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="200"><input type="text" class="inputAlanlari" name="varyantadi10"></td>
									<td width="20" style="color: black;" >&nbsp;</td>
									<td width="178" style="color: black;"><b>10. Varyant Stok Adedi</b></td>
									<td width="20" style="color: black;" >:</td>
									<td width="60"><input type="text" class="inputAlanlari" name="stokadedi10"></td>
								</tr>
							</table></td>
						</tr>
						<tr height="50" >
							<td></td>
							<td></td>
							<td width="500" valign="top"><input class="yesilbuton" type="submit" value="EKLE"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>