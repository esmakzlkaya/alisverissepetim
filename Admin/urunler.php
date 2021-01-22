<?php
if (isset($_SESSION["yonetici"])) {
	if(isset($_REQUEST["aramaicerigi"])){
		$gelenaramaicerigi		=	Guvenlik($_REQUEST["aramaicerigi"]);
		$aramakosulu= "AND urunadi LIKE '%".$gelenaramaicerigi."%'";
		$SayfalamaKosulu ="&aramaicerigi=" . $gelenaramaicerigi;
	}else{
		$gelenaramaicerigi		=	"";
		$aramakosulu="";
		$SayfalamaKosulu ="";
	}
	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	10;
	$ToplamKayitSayisiSorgusu				=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu=? $aramakosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute([1]);
	$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi		=	($sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
	
	?>
	<table width="760" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;ÜRÜNLER</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=95" style="text-decoration: none; color: white;"> + Yeni Ürün Ekle&nbsp;</a></td>
		</tr>
		<tr height="10">
			<td colspan="2" style="font-size: 10px;"></td>
		</tr>
		<tr>
			<td colspan="2"><table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td><div class="aramaalani"><form method="post" action="index.php?SKD=0&SKI=94">
						<div class="aramaalanibuton">
							<input type="submit" value="" class="aramabutonu">
						</div>
						<div class="aramaalaniinput">
							<input type="text" name="aramaicerigi" class="aramainput">
						</div>
					</form></div></td>
				</tr>
			</table></td>
		</tr>
		<?php 

		$urunlerSorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE durumu=? $aramakosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
		$urunlerSorgusu->execute([1]);
		$urunsayisi=$urunlerSorgusu->rowCount();
		$urunkayitlari=$urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($urunsayisi>0){
			foreach ($urunkayitlari as $urunler) {
				$menuid=$urunler["menuid"];
				$urunturu=DonusumleriGeriDondur($urunler["urunturu"]);
				if ($urunturu=="Erkek Ayakkabısı") {
					$klasoradi="Erkek";
				}elseif ($urunturu=="Kadın Ayakkabısı") {
					$klasoradi="Kadin";
				}else{
					$klasoradi="Cocuk";
				}
				$menulerSorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
				$menulerSorgusu->execute([$menuid]);
				$menuler=$menulerSorgusu->fetch(PDO::FETCH_ASSOC);

				?>
				<tr height="90" valign="top">
					<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="60"><img src="../Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($urunler["resimbir"]); ?>" width="60" height="80" border="0" ></td>
							<td width="10">&nbsp;</td>
							<td align="center" width="680"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr  height="30">
									<td colspan="2" width="680"  style="color: black;" ><?php echo DonusumleriGeriDondur($urunler["urunturu"]); ?> <?php echo DonusumleriGeriDondur($menuler["menuadi"]); ?></td>
								</tr>
								<tr height="30">
									<td width="580"  style="color: black;" ><?php echo DonusumleriGeriDondur($urunler["urunadi"]); ?></td>
									<td width="100" align="right" style="color: black;" ><?php echo fiyatbicimlendir(DonusumleriGeriDondur($urunler["urunfiyati"])); ?> <?php echo DonusumleriGeriDondur($urunler["parabirimi"]); ?></td>
								</tr>
								<tr height="30">
									<td width="540" style="color: black;" ><?php echo DonusumleriGeriDondur($urunler["toplamsatissayisi"]); ?> adet satıldı. <?php echo DonusumleriGeriDondur($urunler["yorumsayisi"]); ?>
									adet yorumda <?php echo DonusumleriGeriDondur($urunler["toplamyorumpuani"]);?> kadar puan aldı. <?php echo DonusumleriGeriDondur($urunler["goruntulenmesayisi"]);?> defa görüntülendi. </td>
									<td width="160"><table width="160" align="right" border="0" cellpadding="0" cellspacing="0"> 
										<tr>
											<td width="25"><a href="index.php?SKD=0&SKI=99&id=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>"><img src="../Resimler/Guncelleme20x20.png"></a></td>
											<td width="70"><a style="color: #0000FF; text-decoration: none;" href="index.php?SKD=0&SKI=99&id=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>">Güncelle</a></td>
											<td width="25"><a href="index.php?SKD=0&SKI=103&id=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>"><img src="../Resimler/Sil20x20.png"></a></td>
											<td width="20"><a style="color: #FF0000; text-decoration: none;" href="index.php?SKD=0&SKI=103&id=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>">Sil</a></td>

										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
					</table></td>
				</tr>

				<?php 
			}
			if($BulunanSayfaSayisi>1){
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr height="50">
					<td colspan="2" align="center"><div class="sayfalamaalanikapsayici">
						<div class="metinalanikapsayici">
							Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
						</div>
						<div class="numaraalanikapsayici">
							<?php
							if($sayfalama>1){
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&page=1'><<</a></span>";
								$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$sayfalama-1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
							}
							for($SayfalamaIcinSayfaIndexDegeri=$sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
								if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
									if($sayfalama==$SayfalamaIcinSayfaIndexDegeri){
										echo "<span class='sayfalamaaktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
									}else{
										echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
									}
								}
							}
							if($sayfalama!=$BulunanSayfaSayisi){
								$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$sayfalama+1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
							}
							?>
						</div>
					</div></td>
				</tr>
				<tr><td width="10" colspan="2" style="border-bottom: 1px solid white;" >&nbsp;</td></tr>
				
				<?php
			}
		}
		else{
			?>
			<tr height="50">
				<td colspan="2" style="border: solid 1px #F50000; color: black;">Kayıtlı ürün bulunmamaktadır. </td>
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