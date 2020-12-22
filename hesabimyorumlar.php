<?php
if(isset($_SESSION["kullanici"])){

	$sayfalamaSagsolbutonsayisi=2;
	$birsayfadagosterilecekkayit=10;

	$toplamkayitSorgusu=$DBConnection->prepare("SELECT id FROM yorumlar WHERE uyeid=?  ORDER BY yorumtarihi DESC");
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
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=50" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=58" style="text-decoration: none; color: black;">Adresler</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=59" style="text-decoration: none; color: black;">Favoriler</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
						<td width="10">&nbsp;</td>
						<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=61" style="text-decoration: none; color: black;">Siparişler</a></td>
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
						<td colspan="5" style="color: #FF9900" ><h3>HESABIM > YORUMLAR</h3></td>
					</tr>
					<tr height="30">
						<td colspan="5" style="border-bottom: 1px solid #CCCCCC;" class="">Ürünlere yaptığın yorumlar burada. </td>
					</tr>
					<tr height="40" bgcolor="#F8FFA7" style="color: black; ">
						<td width="250" align="center" style="padding: 0px 5px;"><b>Ürün Adı </b></td>
						<td width="250" align="center" style="padding: 0px 5px;"><b>Ürün Resmi </b></td>
						<td width="250" align="center" ><b>Puan </b></td>
						<td width="250" align="center" ><b>Yorum </b></td>
						<td width="250" align="center" ><b>Yorum Tarihi </b></td>
					</tr>
					<?php
					$yorumlarsorgusu=$DBConnection->prepare("SELECT * FROM yorumlar WHERE uyeid=? ORDER BY yorumtarihi DESC  LIMIT $sayfalamayabaslanacakkayitsayisi,$birsayfadagosterilecekkayit");
					$yorumlarsorgusu->execute([$id]);
					$yorumsayisi=$yorumlarsorgusu->rowCount();
					$yorumlar=$yorumlarsorgusu->fetchAll(PDO::FETCH_ASSOC);
					$no=$sayfalama;
					if ($yorumsayisi>0) {
						foreach ($yorumlar as $yorum) {
							$gelenurunid=$yorum["urunid"];

							$urunsorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=?");
							$urunsorgusu->execute([$gelenurunid]);
							$urunsayisi=$urunsorgusu->rowCount();
							$urunler=$urunsorgusu->fetchAll(PDO::FETCH_ASSOC);
							if ($urunsayisi>0) {
								foreach ($urunler as $urun) {

									$urunturu=DonusumleriGeriDondur($urun["urunturu"]);
									if ($urunturu=="Erkek Ayakkabısı") {
										$klasoradi="Erkek";
									}elseif ($urunturu=="Kadın Ayakkabısı") {
										$klasoradi="Kadin";
									}else{
										$klasoradi="Cocuk";
									}
									$verilenpuan=$yorum["puan"];
									if ($verilenpuan==5) {
										$puanresmi="YildizBesDolu.png";
									}elseif ($verilenpuan==4) {
										$puanresmi="YildizDortDolu.png";
									}elseif ($verilenpuan==3) {
										$puanresmi="YildizUcDolu.png";
									}elseif ($verilenpuan==2) {
										$puanresmi="YildizIkiDolu.png";
									}else{
										$puanresmi="YildizBirDolu.png";
									}
									?>
									<tr height="40" bgcolor="" style="color: black; ">
										<td width="250" align="center" style="padding: 0px 5px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></td>
										<td width="250" align="center" style="padding: 0px 5px;"><img width="60" height="80" src="Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>"></td>
										<td width="85" align="center" ><img  src="Resimler/<?php echo $puanresmi; ?>"></td>
										<td width="500" valign="center" align="center" ><?php echo DonusumleriGeriDondur($yorum["yorummetni"]) ?></td>
										<td width="250" align="center" ><?php echo TarihBul(DonusumleriGeriDondur($yorum["yorumtarihi"])); ?></td>
									</tr>
									<tr>
										<td colspan="5"><hr/></td>
									</tr>
									<?php
								}
							}
						}
					}else{
						?>
						<tr height="40" align="center">
							<td colspan="5">Sisteme kayıtlı yorumunuz bulunmamaktadır. </td>
						</tr>
						<?php
					}
					if ($bulunansayfasayisi>1) {
						?>
						<tr height="50">
							<td colspan="5" align="center">
								<div class="sayfalamaalanikapsayici">
									<div class="metinalanikapsayici">
										Toplam <?php echo $bulunansayfasayisi; ?> sayfada <?php echo $toplamkayitsayisi; ?> adet kayıt bulunmaktadır.
									</div>
									<div class="numaraalanikapsayici">
										<?php 
										if ($sayfalama>1) {
											echo "<span class='sayfalamapasif'><a href='index.php?SK=60&page=1'> << </a></span>";
											$gerial=$sayfalama-1;
											echo "<span class='sayfalamapasif'><a href='index.php?SK=60&page=".$gerial."'> < </a></span>";
										}
										for ($i=$sayfalama-$sayfalamaSagsolbutonsayisi; $i <=$sayfalama+$sayfalamaSagsolbutonsayisi; $i++) { 
											if (($i>0) and ($i<=$bulunansayfasayisi)) {
												if ($i==$sayfalama) {
													echo "<span class='sayfalamaaktif'>" . $sayfalama . "</span>";
												}else{
													echo "<span class='sayfalamapasif'><a href='index.php?SK=60&page=".$i."'>" . $i . "</a></span>";
												}
											}
										}
										if ($sayfalama!=$bulunansayfasayisi) {
											$ilerial=$sayfalama+1;
											echo "<span class='sayfalamapasif'><a href='index.php?SK=60&page=".$ilerial."'> > </a></span>";
											echo "<span class='sayfalamapasif'><a href='index.php?SK=60&page=".$bulunansayfasayisi."'> >> </a></span>";
										}
										?>
									</div>
								</div>
							</td>
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
	header("Location:index.php");
	exit();
} 
?>