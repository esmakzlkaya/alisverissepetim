<?php
if(isset($_SESSION["kullanici"])){

	$sayfalamaSagsolbutonsayisi=2;
	$birsayfadagosterilecekkayit=10;

	$toplamkayitSorgusu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE uyeid=? ORDER BY siparisnumarasi DESC ");
	$toplamkayitSorgusu->execute([$id]);
	$toplamkayitsayisi=$toplamkayitSorgusu->rowCount();

	$sayfalamayabaslanacakkayitsayisi=($sayfalama*$birsayfadagosterilecekkayit)-$birsayfadagosterilecekkayit;
	$bulunansayfasayisi=ceil($toplamkayitsayisi/$birsayfadagosterilecekkayit);
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr>
			<td colspan="3">
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-adresler" style="text-decoration: none; color: black;">Adresler</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-favoriler" style="text-decoration: none; color: black;">Favoriler</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-yorumlar" style="text-decoration: none; color: black;">Yorumlar</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-siparisler" style="text-decoration: none; color: black;">Siparişler</a></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr height="">
			<td width="1065" valign="top">
				<table  width="1065" align="left" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td colspan="8" style="color: #FF9900" ><h3>HESABIM > SİPARİŞLER</h3></td>
					</tr>
					<tr height="30">
						<td colspan="8" style="border-bottom: 1px solid #CCCCCC;" class="">Siparişlerine ilişkin bütün bilgiler burada. </td>
					</tr>
					<tr height="40" bgcolor="#F8FFA7" style="color: black; ">
						<td width="150" align="center" style="padding: 0px 5px;"><b>Sipariş Numarası </b></td>
						<td width="100" align="center" ><b>Ürün Resmi </b></td>
						<td width="80" align="center" ><b>Yorum </b></td>
						<td width="205" align="center" ><b>Ürün Adı </b></td>
						<td width="100" align="center" ><b>Ürün Fiyatı </b></td>
						<td width="90" align="center" ><b>Ürün Adedi </b></td>
						<td width="150" align="center" ><b>Toplam Ürün Fiyatı </b></td>
						<td width="190" align="center" style="padding: 0px 5px;"><b>Kargo Durumu / Takip </b></td>
					</tr>
					<?php 
					$siparisnosorgu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE uyeid=? ORDER BY siparisnumarasi DESC  LIMIT $sayfalamayabaslanacakkayitsayisi,$birsayfadagosterilecekkayit");
					$siparisnosorgu->execute([$id]);
					$siparisnosayisi=$siparisnosorgu->rowCount();
					$siparisnokayitlar=$siparisnosorgu->fetchAll(PDO::FETCH_ASSOC);
					if ($siparisnosayisi>0) {
						foreach ($siparisnokayitlar as $sipno) {
							$siparisno=DonusumleriGeriDondur($sipno["siparisnumarasi"]);

							$adressorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE uyeid=? and siparisnumarasi=? ORDER BY id ASC");
							$adressorgusu->execute([$id,$siparisno]);
							$adressayisi=$adressorgusu->rowCount();
							$adres=$adressorgusu->fetchAll(PDO::FETCH_ASSOC);
							
							foreach ($adres as $adress) {
								$urunturu=DonusumleriGeriDondur($adress["urunturu"]);
								if ($urunturu=="Erkek Ayakkabısı") {
									$klasoradi="Erkek";
								}elseif ($urunturu=="Kadın Ayakkabısı") {
									$klasoradi="Kadin";
								}else{
									$klasoradi="Cocuk";
								}

								$kargodurumu=DonusumleriGeriDondur($adress["kargodurumu"]);
								if ($kargodurumu==0) {
									$kargodurumuyazdir="Beklemede";
								}else{
									$kargodurumuyazdir=DonusumleriGeriDondur($adress["kargogonderino"]);
								}
								?>
								<tr height="40" bgcolor="" style="color: black; ">
									<td width="150" align="center" style="padding: 0px 5px;">#<?php echo DonusumleriGeriDondur($adress["siparisnumarasi"]); ?></td>
									<td width="100" align="center" ><img src="Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($adress["urunresmibir"]) ?>" width="60" height="80" border="0"></td>
									<td width="80" align="center" ><a href="hesabim-adresler&urunid=<?php echo $adress["urunid"]; ?>"><img src="Resimler/DokumanKirmiziKalemli20x20.png"></a></td>
									<td width="205" align="center" ><?php echo DonusumleriGeriDondur($adress["urunadi"]); ?></td>
									<td width="100" align="center" ><?php echo fiyatbicimlendir(DonusumleriGeriDondur($adress["urunfiyati"])); ?> TL </td>
									<td width="90" align="center" ><?php echo DonusumleriGeriDondur($adress["urunadedi"]); ?></td>
									<td width="150" align="center" ><?php echo fiyatbicimlendir(DonusumleriGeriDondur($adress["toplamurunfiyati"])); ?> TL </td>
									<td width="190" align="center" style="padding: 0px 5px;"><?php echo $kargodurumuyazdir; ?></td>
								</tr>
								<?php
							}
							?>
							<tr>
								<td colspan="8"><hr/></td>
							</tr>
							<?php
						}
						if ($bulunansayfasayisi>1) {
							?>
							<tr height="50">
								<td colspan="8" align="center">
									<div class="sayfalamaalanikapsayici">
										<div class="metinalanikapsayici">
											Toplam <?php echo $bulunansayfasayisi; ?> sayfada <?php echo $toplamkayitsayisi; ?> adet kayıt bulunmaktadır.
										</div>
										<div class="numaraalanikapsayici">
											<?php 
											if ($sayfalama>1) {
												echo "<span class='sayfalamapasif'><a href='hesabim-adresler&page=1'> << </a></span>";
												$gerial=$sayfalama-1;
												echo "<span class='sayfalamapasif'><a href='hesabim-adresler&page=".$gerial."'> < </a></span>";
											}
											for ($i=$sayfalama-$sayfalamaSagsolbutonsayisi; $i <=$sayfalama+$sayfalamaSagsolbutonsayisi; $i++) { 
												if (($i>0) and ($i<=$bulunansayfasayisi)) {
													if ($i==$sayfalama) {
														echo "<span class='sayfalamaaktif'>" . $sayfalama . "</span>";
													}else{
														echo "<span class='sayfalamapasif'><a href='hesabim-adresler&page=".$i."'>" . $i . "</a></span>";
													}
												}
											}
											if ($sayfalama!=$bulunansayfasayisi) {
												$ilerial=$sayfalama+1;
												echo "<span class='sayfalamapasif'><a href='hesabim-adresler&page=".$ilerial."'> > </a></span>";
												echo "<span class='sayfalamapasif'><a href='hesabim-adresler&page=".$bulunansayfasayisi."'> >> </a></span>";
											}
											?>
										</div>
									</div>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr height="40" align="center">
							<td colspan="8">Sisteme kayıtlı siparişiniz bulunmamaktadır.</td>
						</tr>
						<?php 
					}
					?>
				</table>
			</td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:anasayfa");
	exit();
} 
?>