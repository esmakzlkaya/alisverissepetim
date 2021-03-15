<?php
if (isset($_SESSION["yonetici"])) {
	if(isset($_GET["SiparisNo"])){
		$gelensiparisno=Guvenlik($_GET["SiparisNo"]);	
	}else{
		$gelensiparisno="";
	}
	?>
	<table width="760" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="510" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;SİPARİŞ DETAY</h3></td>
			<td align="right" width="250" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=108" style="text-decoration: none; color: white;">Tamamlanan Siparişlere Dön&nbsp;</a></td>
		</tr>
		<tr height="10">
			<td colspan="2" style="font-size: 10px;"></td>
		</tr>
		<?php 
		$siparislerSorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE siparisnumarasi=?");
		$siparislerSorgusu->execute([$gelensiparisno]);
		$siparissayisi=$siparislerSorgusu->rowCount();
		$sipariskayitlari=$siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($siparissayisi>0){
			$donguSayisi=0;
			foreach ($sipariskayitlari as $siparisler) {
				$urunturu=DonusumleriGeriDondur($siparisler["urunturu"]);
				if ($urunturu=="Erkek Ayakkabısı") {
					$klasoradi="Erkek";
				}elseif ($urunturu=="Kadın Ayakkabısı") {
					$klasoradi="Kadin";
				}else{
					$klasoradi="Cocuk";
				}
				?>
				<tr>
					<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<?php 
						if ($donguSayisi==0) {
							?>
							<tr height="30">
								<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="150" style="color: black;" ><b>Adı Soyadı</b></td>
										<td width="10" style="color: black;" ><b> : </b></td>
										<td width="590" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["adresadsoyad"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="30">
								<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="150" style="color: black;" ><b>Telefon</b></td>
										<td width="10" style="color: black;" ><b> : </b></td>
										<td width="590" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["adrestelno"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="30">
								<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="150" style="color: black;" ><b>Adres</b></td>
										<td width="10" style="color: black;" ><b> : </b></td>
										<td width="590" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["adresdetay"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="30">
								<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="150" style="color: black;" ><b>Gönderi Kodu</b></td>
										<td width="10" style="color: black;" ><b> : </b></td>
										<td width="590" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["kargogonderino"]); ?></td>
									</tr>
								</table></td>
							</tr>	
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table></td>
					</tr>
					<?php	
				}
				?>
				<tr height="90" valign="top">
					<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="60"><img src="../Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($siparisler["urunresmibir"]); ?>" width="60" height="80" border="0" ></td>
							<td width="10">&nbsp;</td>
							<td align="center" width="680"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr height="30">
									<td><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="450" align="left" style="color: black;" ><b><?php echo DonusumleriGeriDondur($siparisler["urunadi"]); ?></b></td>
											<td width="230" align="right" style="color: black;" ><b> <?php echo DonusumleriGeriDondur($siparisler["varyantbasligi"]); ?>  :  </b> <?php echo DonusumleriGeriDondur($siparisler["varyantsecimi"]); ?></td>
										</tr>		
									</table></td>
								</tr>
								<tr height="30">
									<td><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="50" style="color: black;" ><b>Fiyat</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="138" style="color: black;" ><?php echo DonusumleriGeriDondur(fiyatbicimlendir($siparisler["urunfiyati"])); ?> TL</td>
											<td width="50" style="color: black;" ><b>Adet</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="50" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["urunadedi"]); ?></td>
											<td width="115" style="color: black;" ><b>Toplam Fiyat</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="125" style="color: black;" ><?php echo DonusumleriGeriDondur(fiyatbicimlendir($siparisler["toplamurunfiyati"])); ?> TL</td>
											<td width="85" style="color: black;" ><b>KDV Oranı</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="27" style="color: black;" ><?php echo DonusumleriGeriDondur(fiyatbicimlendir($siparisler["kdvorani"])); ?></td>
										</tr>
									</table></td>
								</tr>
								<tr height="30">
									<td><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="50" style="color: black;" ><b>Ödeme</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="135" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["odemesecimi"]); ?> </td>
											<td width="50" style="color: black;" ><b>Taksit</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="50" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["taksitsecimi"]); ?></td>
											<td width="65" style="color: black;" ><b>Kargo</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="125" style="color: black;" ><?php echo DonusumleriGeriDondur($siparisler["kargofirmasisecimi"]); ?> </td>
											<td width="105" style="color: black;" ><b>Kargo Ücreti</b></td>
											<td width="10" style="color: black;" ><b> : </b></td>
											<td width="65" style="color: black;" ><?php echo DonusumleriGeriDondur(fiyatbicimlendir($siparisler["kargoucreti"])); ?> TL</td>
										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
					</table></td>
				</tr>
				<?php 
				$donguSayisi++;
			}
		}else{
			header("Location:index.php?SKD=0&SKI=0");
			exit();
		}
		?>
	</table>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>