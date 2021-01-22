<?php
if (isset($_SESSION["yonetici"])) {
	if(isset($_REQUEST["aramaicerigi"])){
		$gelenaramaicerigi		=	Guvenlik($_REQUEST["aramaicerigi"]);
		$aramakosulu= "AND (adsoyad LIKE '%".$gelenaramaicerigi."%' OR  mail LIKE '%".$gelenaramaicerigi."%' OR telno LIKE '%".$gelenaramaicerigi."%' )";
	}else{
		$gelenaramaicerigi		=	"";
		$aramakosulu="";
	}
	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	1;
	$ToplamKayitSayisiSorgusu				=	$DBConnection->prepare("SELECT * FROM yorumlar $aramakosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute();
	$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi		=	($sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
	?>
	<table width="760" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="center" width="760" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;YORUMLAR</h3></td>
		</tr>
		<tr height="10">
			<td colspan=""></td>
		</tr>
		
		<?php 

		$yorumlarSorgusu=$DBConnection->prepare("SELECT * FROM yorumlar $aramakosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
		$yorumlarSorgusu->execute();
		$yorumsayisi=$yorumlarSorgusu->rowCount();
		$yorumkayitlari=$yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($yorumsayisi>0){
			foreach ($yorumkayitlari as $yorumlar) {
				$yorumid=$yorumlar["id"];
				$urunid=$yorumlar["urunid"];
				$uyeid=$yorumlar["uyeid"];
				$verilenpuan=$yorumlar["puan"];
				$yorummetni=$yorumlar["yorummetni"];
				$yorumtarihi=$yorumlar["yorumtarihi"];
				$yorumipadresi=$yorumlar["yorumipadresi"];


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

				$urunsorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=?");
				$urunsorgusu->execute([$urunid]);
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
						?>
						<tr height="105" valign="top">
							<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr height="40" bgcolor="" style="color: black; ">
									<td width="250" align="center" style="padding: 0px 5px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></td>
									<td width="250" align="center" style="padding: 0px 5px;"><img width="60" height="80" src="../Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>"></td>
									<td width="85" align="center" ><img  src="../Resimler/<?php echo $puanresmi; ?>"></td>
									<td width="500" valign="center" align="center" ><?php echo DonusumleriGeriDondur($yorumlar["yorummetni"]) ?></td>
									<td width="250" align="center" ><?php echo TarihBul(DonusumleriGeriDondur($yorumlar["yorumtarihi"])); ?></td>
									<td width="250" align="center"><a href="index.php?SKD=0&SKI=91&id=<?php echo DonusumleriGeriDondur($yorumid); ?>" style="color:  #FF0000; text-decoration: none;">Sil</a></td>
									<td><a href="index.php?SKD=0&SKI=91&id=<?php echo DonusumleriGeriDondur($yorumid); ?>"><img src="../Resimler/Sil20x20.png"></a></td>
								</tr>
							</table></td>
						</tr>
						<?php 
					}
				}
			}

			if($BulunanSayfaSayisi>1){
				?>
				<tr>
					<td colspan="">&nbsp;</td>
				</tr>
				<tr height="50">
					<td colspan="" align="center"><div class="sayfalamaalanikapsayici">
						<div class="metinalanikapsayici">
							Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
						</div>
						<div class="numaraalanikapsayici">
							<?php
							if($sayfalama>1){
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=90&page=1'><<</a></span>";
								$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$sayfalama-1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=90&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
							}
							for($SayfalamaIcinSayfaIndexDegeri=$sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
								if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
									if($sayfalama==$SayfalamaIcinSayfaIndexDegeri){
										echo "<span class='sayfalamaaktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
									}else{
										echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=90&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
									}
								}
							}
							if($sayfalama!=$BulunanSayfaSayisi){
								$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$sayfalama+1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=90&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=90&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
							}
							?>
						</div>
					</div></td>
				</tr>
				<?php
			}

		}else{
			?>
			<tr height="50">
				<td colspan="" style="border: solid 1px #F50000; color: black;">Kayıtlı üye bulunmamaktadır. </td>
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