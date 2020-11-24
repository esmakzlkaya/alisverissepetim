<?php 
if (isset($_REQUEST["id"])) {
	$gelenmenuid=Guvenlik($_REQUEST["id"]);
	$menukosulu=" AND menuid='".$gelenmenuid."' ";
	$sayfalamamenukosulu="&menuid=".$gelenmenuid;
}else{
	$gelenmenuid="";
	$menukosulu="";
	$sayfalamamenukosulu="";
}
$sayfalamaSagsolbutonsayisi=2;
$birsayfadagosterilecekkayit=1;

$toplamkayitSorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE urunturu='Erkek Ayakkabısı' AND durumu='1' $menukosulu ORDER BY id DESC");
$toplamkayitSorgusu->execute();
$toplamkayitsayisi=$toplamkayitSorgusu->rowCount();

$sayfalamayabaslanacakkayitsayisi=($sayfalama*$birsayfadagosterilecekkayit)-$birsayfadagosterilecekkayit;
$bulunansayfasayisi=ceil($toplamkayitsayisi/$birsayfadagosterilecekkayit);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="top"><table  width="250" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="50">
						<td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
					</tr>
					<tr height="30">
						<td align="left"><a class="hesabimlink" style="font-weight: bold; <?php if ($gelenmenuid=="") { ?> color: #FF9900; <?php }else{ ?> color: #646464;" <?php } ?> href="index.php?SK=83">&nbsp;Tüm Ürünler </a></td>
					</tr>
					<?php 
					$menusorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE urunturu = 'Erkek Ayakkabısı' ORDER BY menuadi ASC");
					$menusorgusu->execute();
					$menusayisi=$menusorgusu->rowCount();
					$menuler=$menusorgusu->fetchAll(PDO::FETCH_ASSOC);
					if ($menusayisi>0) {
						foreach ($menuler as $menu) {
							?>
							<tr height="30">
								<td><a class="hesabimlink" style="font-weight: bold; <?php if ($gelenmenuid==$menu["id"]) { ?> color: #FF9900; <?php }else{ ?> color: #646464;" <?php } ?> href="index.php?SK=83&id=<?php echo DonusumleriGeriDondur($menu["id"]); ?>">&nbsp;<?php echo DonusumleriGeriDondur($menu["menuadi"]); ?> ( <?php echo DonusumleriGeriDondur($menu["urunsayisi"]); ?> )</a></td>
							</tr>
							<?php
						}
					}
					?>
				</table></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="50">
						<td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
					</tr>
					<?php 
					$bannersorgusu=$DBConnection->prepare("SELECT * FROM bannerlar WHERE banneralani = 'Menü Altı' ORDER BY gosterimsayisi ASC LIMIT 1");
					$bannersorgusu->execute();
					$bannersayisi=$bannersorgusu->rowCount();
					$bannerlar=$bannersorgusu->fetch(PDO::FETCH_ASSOC);
					$bannerid=$bannerlar["id"];
					if ($bannersayisi>0) {
						?>
						<tr height="250">
							<td><img border="0" src="Resimler/Banner/<?php echo $bannerlar["bannerresmi"]; ?>"></td>
						</tr>
						<?php
						$bannersorgusu=$DBConnection->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id=?");
						$bannersorgusu->execute([$bannerid]);
					}
					?>
				</table></td>
			</tr>
		</table></td>
		<td width="11" align="left" >&nbsp; </td>	
		<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2"><div class="aramaalani"><form method="post" action="index.php?SK=83">
					<div class="aramaalanibuton">
						<input type="submit" value="" class="aramabutonu">
					</div>
					<div class="aramaalaniinput">
						<input type="text" value="" class="aramainput">
					</div>
				</form></div></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><table width="795" cellspacing="0" cellpadding="0" border="0" align="center">
					<tr>
						<?php 
						$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE urunturu='Erkek Ayakkabısı' AND durumu='1' $menukosulu ORDER BY id DESC LIMIT $sayfalamayabaslanacakkayitsayisi,$birsayfadagosterilecekkayit"); 
						$urunlersorgusu->execute();
						$urunlersayisi=$urunlersorgusu->rowCount();
						$urunler=$urunlersorgusu->fetchAll(PDO::FETCH_ASSOC);

						$dongusayisi=1;
						$sutunadedi=4;
						if ($urunlersayisi>0) {
							foreach ($urunler as $urun) {
								$urunadi=$urun["urunadi"];
								$urunfiyati=$urun["urunfiyati"];
								$parabirimi=$urun["parabirimi"];
								$resimbir=$urun["resimbir"];
								$urunaciklamasi=$urun["urunaciklamasi"];
								$goruntulenmesayisi=$urun["goruntulenmesayisi"];
								?>
								<td width="191" style="">
									<table width="191" align="left" cellspacing="0" cellpadding="0" border="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr height="40">
											<td align="center"><img border="0" height="247" width="185" src="Resimler/UrunResimleri/Erkek/<?php echo DonusumleriGeriDondur($resimbir); ?>"></td>
										</tr>
										<tr height="25">
											<td width="253"><?php echo $urunadi; ?></td>
										</tr>
									</table></td>
									<?php 
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
								?>
							</tr>
						</table></td>
					</tr>
					<?php
				}else{
					?>
					<tr height="40" align="center">
						<td colspan="2">Sisteme kayıtlı yorum bulunmamaktadır.</td>
					</tr>
					<?php
				}
				if ($bulunansayfasayisi>1) {
					?>
					<tr height="50">
						<td colspan="2" align="center">
							<div class="sayfalamaalanikapsayici">
								<div class="metinalanikapsayici">
									Toplam <?php echo $bulunansayfasayisi; ?> sayfada <?php echo $toplamkayitsayisi; ?> adet kayıt bulunmaktadır.
								</div>
								<div class="numaraalanikapsayici">
									<?php 
									if ($sayfalama>1) {
										echo "<span class='sayfalamapasif'><a href='index.php?SK=83" . $sayfalamamenukosulu . "&page=1'> << </a></span>";
										$gerial=$sayfalama-1;
										echo "<span class='sayfalamapasif'><a href='index.php?SK=83" . $sayfalamamenukosulu . "&page=".$gerial."'> < </a></span>";
									}
									for ($i=$sayfalama-$sayfalamaSagsolbutonsayisi; $i <=$sayfalama+$sayfalamaSagsolbutonsayisi; $i++) { 
										if (($i>0) and ($i<=$bulunansayfasayisi)) {
											if ($i==$sayfalama) {
												echo "<span class='sayfalamaaktif'>" . $i . "</span>";
											}else{
												echo "<span class='sayfalamapasif'><a href='index.php?SK=83" . $sayfalamamenukosulu . "&page=".$i."'>" . $i . "</a></span>";
											}
										}
									}
									if ($sayfalama!=$bulunansayfasayisi) {
										$ilerial=$sayfalama+1;
										echo "<span class='sayfalamapasif'><a href='index.php?SK=83" . $sayfalamamenukosulu . "&page=" . $ilerial . "'> > </a></span>";
										echo "<span class='sayfalamapasif'><a href='index.php?SK=83 " . $sayfalamamenukosulu . "&page=" . $bulunansayfasayisi . "'> >> </a></span>";
									}
									?>
								</div>
							</div>
						</td>
					</tr>
					<?php
				}
				?>
			</table></td>
		</tr>
	</table>