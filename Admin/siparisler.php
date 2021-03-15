<?php
if (isset($_SESSION["yonetici"])) {
	$sayfalamaSagsolbutonsayisi=2;
	$birsayfadagosterilecekkayit=10;

	$toplamkayitSorgusu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE onaydurumu=? ORDER BY siparisnumarasi DESC ");
	$toplamkayitSorgusu->execute([0]);
	$toplamkayitsayisi=$toplamkayitSorgusu->rowCount();

	$sayfalamayabaslanacakkayitsayisi=($sayfalama*$birsayfadagosterilecekkayit)-$birsayfadagosterilecekkayit;
	$bulunansayfasayisi=ceil($toplamkayitsayisi/$birsayfadagosterilecekkayit);

	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;SİPARİŞLER BEKLEYEN</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=108" style="text-decoration: none; color: white;"> Tamamlanan Siparişler&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 
		$siparisnosorgu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE onaydurumu=0 AND kargodurumu=0 ORDER BY id DESC LIMIT $sayfalamayabaslanacakkayitsayisi,$birsayfadagosterilecekkayit");
		$siparisnosorgu->execute();
		$siparisnosayisi=$siparisnosorgu->rowCount();
		$siparisnokayitlar=$siparisnosorgu->fetchAll(PDO::FETCH_ASSOC);
		if ($siparisnosayisi>0) {
			foreach ($siparisnokayitlar as $sipno) {
				$siparislerSorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE onaydurumu=0 AND siparisnumarasi=? AND kargodurumu=0 ORDER BY id ASC");
				$siparislerSorgusu->execute([$sipno["siparisnumarasi"]]);
				$siparisSayisi=$siparislerSorgusu->rowCount();
				$yoneticiler=$siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
				if($siparisSayisi>0){
					$toplamfiyat=0;
					foreach ($yoneticiler as $siparis) {
						$urunToplamFiyati=$siparis["toplamurunfiyati"];
						$siparisTarihi=TarihBul($siparis["siparistarihi"]);
						$toplamfiyat+=$urunToplamFiyati;
					}
					?>
					<tr height="50">
						<td colspan="2" width="750" align="right" style="border-bottom: solid 1px #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr height="30">
								<td align="left" width="150"  style="color: black;" ><b>Sipariş Tarihi </b></td>
								<td align="left" width="10"  style="color: black;" ><b> : </b></td>
								<td align="left" width="150"  style="color: black;" ><?php echo $siparisTarihi; ?></td>
								<td align="left" width="200"  style="color: black;" ><b>Sipariş Toplam Tutarı </b></td>
								<td align="left" width="10"  style="color: black;" ><b> : </b></td>
								<td align="left" width="140"  style="color: black;" ><?php echo fiyatbicimlendir($toplamfiyat); ?> TL</td>
								<td align="left" width="150"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td align="left" width="25"><a href="index.php?SKD=0&SKI=107&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>"><img src="../Resimler/DokumanKirmiziKalemli20x20.png"></a></td>
										<td align="left" width="70" style="color: black;"><a href="index.php?SKD=0&SKI=107&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>" style="text-decoration: none; color: black;"><b>DETAY</b></a></td>
										<td align="left" width="25"><a href="index.php?SKD=0&SKI=113&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>"><img src="../Resimler/Sil20x20.png"></a></td>
										<td align="left" width="30" style="color: black;"><a href="index.php?SKD=0&SKI=113&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>" style="text-decoration: none; color: black;"><b>SİL</b></a></td>
									</tr>
								</table></td>
							</tr>
						</table></td>
					</tr>
					<?php
				}else{
					header("Location:index.php?SKD=0&SKI=0");
					exit();
				}
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
									echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=106&page=1'> << </a></span>";
									$gerial=$sayfalama-1;
									echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=106&page=".$gerial."'> < </a></span>";
								}
								for ($i=$sayfalama-$sayfalamaSagsolbutonsayisi; $i <=$sayfalama+$sayfalamaSagsolbutonsayisi; $i++) { 
									if (($i>0) and ($i<=$bulunansayfasayisi)) {
										if ($i==$sayfalama) {
											echo "<span class='sayfalamaaktif'>" . $sayfalama . "</span>";
										}else{
											echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=106&page=".$i."'>" . $i . "</a></span>";
										}
									}
								}
								if ($sayfalama!=$bulunansayfasayisi) {
									$ilerial=$sayfalama+1;
									echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=106&page=".$ilerial."'> > </a></span>";
									echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=106&page=".$bulunansayfasayisi."'> >> </a></span>";
								}
								?>
							</div>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
			<td width="10" colspan="2" style="border-bottom: 1px solid white;" >&nbsp;</td>
			<?php
		}else{
			?>
			<tr height="50">
				<td colspan="" style="border: solid 1px #F50000; color: black;">Kayıtlı sipariş bulunmamaktadır. </td>
			</tr>
			<?php
		}
		?>
	</table>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>