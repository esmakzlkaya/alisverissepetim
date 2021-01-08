<?php
$SayfalamaKosulu="";
if(isset($_REQUEST["aramaicerigi"])){
	$gelenaramaicerigi		=	Guvenlik($_REQUEST["aramaicerigi"]);
	$aramakosulu= "AND urunadi LIKE '%".$gelenaramaicerigi."%'";
	$SayfalamaKosulu .="&aramaicerigi=" . $gelenaramaicerigi;
}else{
	$gelenaramaicerigi		=	"";
	$aramakosulu="";
	$SayfalamaKosulu .="";
}
$aramaEnyeniUrunlerSorgusu		=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY id DESC ");
$aramaEnyeniUrunlerSorgusu->execute();
$aramaenyeniUrunSayisi			=	$aramaEnyeniUrunlerSorgusu->rowCount();
$aramaurunler		=	$aramaEnyeniUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
if ($aramaenyeniUrunSayisi>0) {
	foreach($aramaurunler as $urunturuurun){
		$urununturu=DonusumleriGeriDondur($urunturuurun["urunturu"]);
		$urunturukosulu=" AND <?php if ($urununturu=='Kadın Ayakkabısı') { ?> urunturu= <?php echo 'Kadin';	}elseif ($urununturu=='Erkek Ayakkabısı') {  ?> urunturu= <?php echo 'Erkek'; }else{  ?> urunturu= <?php echo 'Cocuk'; } ?>";
	}
}
$SayfalamaIcinSolVeSagButonSayisi		=	2;
$SayfaBasinaGosterilecekKayitSayisi		=	10;
$ToplamKayitSayisiSorgusu				=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu = '1' $urunturukosulu $aramakosulu ORDER BY id DESC");
$ToplamKayitSayisiSorgusu->execute();
$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi		=	($sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);

$tumurunlersayisisorgusu=$DBConnection->prepare("SELECT SUM(*) AS toplamenyeniurunsayisi FROM urunler ");
$tumurunlersayisisorgusu->execute();
$tumurunlersayisikaydi = $tumurunlersayisisorgusu->fetch(PDO::FETCH_ASSOC);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="1065" align="left" valign="top"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<?php
					$BannerSorgusu		=	$DBConnection->prepare("SELECT * FROM bannerlar WHERE banneralani = 'Anasayfa' ORDER BY gosterimsayisi ASC LIMIT 1");
					$BannerSorgusu->execute();
					$BannerSayisi		=	$BannerSorgusu->rowCount();
					$BannerKaydi		=	$BannerSorgusu->fetch(PDO::FETCH_ASSOC);
					?>
					<tr height="203">
						<td><img src="Resimler/<?php echo $BannerKaydi["bannerresmi"]; ?>" border="0"></td>
					</tr>
					<?php
					$BannerGuncelle		=	$DBConnection->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
					$BannerGuncelle->execute([$BannerKaydi["id"]]);
					?>
				</table></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr height="35">
				<td bgcolor="#FF9900" style="color: white; font-weight: bold;" >&nbsp;En Yeni Ürünler</td>
			</tr>
			<tr>
				<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<?php
								$EnyeniUrunlerSorgusu		=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY id DESC LIMIT 5");
								$EnyeniUrunlerSorgusu->execute();
								$enyeniUrunSayisi			=	$EnyeniUrunlerSorgusu->rowCount();
								$enyeniurunler		=	$EnyeniUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

								$DonguSayisi			=	1;
								$SutunAdetSayisi		=	5;
								if ($enyeniUrunSayisi>0) {
									foreach($enyeniurunler as $urun){
										$UrununFiyati		=	DonusumleriGeriDondur($urun["urunfiyati"]);
										$UrununParaBirimi	=	DonusumleriGeriDondur($urun["parabirimi"]);
										$UrununToplamYorumSayisi	=	DonusumleriGeriDondur($urun["yorumsayisi"]);
										$UrununToplamYorumPuani		=	DonusumleriGeriDondur($urun["toplamyorumpuani"]);
										$urununturu=DonusumleriGeriDondur($urun["urunturu"]);
										if ($UrununParaBirimi=='USD') {
											$urunfiyatihesapla=$UrununFiyati*$dolarkuru;
										}elseif ($UrununParaBirimi=='EUR') {
											$urunfiyatihesapla=$UrununFiyati*$eurokuru;
										}else{
											$urunfiyatihesapla=$UrununFiyati;
										}
										if($UrununToplamYorumSayisi>0){
											$PuanHesapla			=	number_format($UrununToplamYorumPuani/$UrununToplamYorumSayisi, 2, ".", "");
										}else{
											$PuanHesapla			=	0;
										}
										if ($PuanHesapla==0) {
											$puanresmi="YildizCizgiliBos.png";
										}elseif(($PuanHesapla>0) and ($PuanHesapla<=1)){
											$puanresmi="YildizCizgiliBirDolu.png";
										}elseif(($PuanHesapla>1) and ($PuanHesapla<=2)){
											$puanresmi="YildizCizgiliIkiDolu.png";
										}elseif(($PuanHesapla>2) and ($PuanHesapla<=3)){
											$puanresmi="YildizCizgiliUcDolu.png";
										}elseif(($PuanHesapla>3) and ($PuanHesapla<=4)){
											$puanresmi="YildizCizgiliDortDolu.png";
										}elseif(($PuanHesapla>4)){
											$puanresmi="YildizCizgiliBesDolu.png";
										}
										?>
										<td width="205" valign="top"><table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
											<tr height="40">
												<td align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>"><img src="Resimler/UrunResimleri/<?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadin";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek"; }else{ echo "Cocuk"; } ?>/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>" border="0" width="205" height="240"></a></td>
											</tr>
											<tr height="25">
												<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadın Ayakkabısı";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek Ayakkabısı"; }else{ echo "Çocuk Ayakkabısı "; } ?></a></td>
											</tr>
											<tr height="25">
												<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: black; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></div></a></td>
											</tr>
											<tr height="25">
												<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #646464; text-decoration: none;"><div><img src="Resimler/<?php echo $puanresmi; ?>" border="0"></div></a></td>
											</tr>
											<tr height="25">
												<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #990000; text-decoration: none; font-weight: bold;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo fiyatbicimlendir($urunfiyatihesapla); ?> TL </div></a></td>
											</tr>
										</table></td>
										<?php
										if($DonguSayisi<$SutunAdetSayisi){
											?>
											<td width="10">&nbsp;</td>
											<?php
										}
										?>
										<?php
										$DonguSayisi++;

										if($DonguSayisi>$SutunAdetSayisi){
											echo "</tr><tr>";
											$DonguSayisi	=	1;
										}
									}	
								}else{
									?>
									<td  width="795" align="center" valign="top">Sisteme kayıtlı ürün bulunamadı.</td>
									<?php
								}
								?></tr>
							</table></td>
						</tr>
						<tr height="35">
							<td bgcolor="#FF9900" style="color: white; font-weight: bold;" >&nbsp;En Popüler Ürünler</td>
						</tr>
						<tr>
							<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<?php
											$EnpopulerUrunlerSorgusu		=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY goruntulenmesayisi DESC LIMIT 5");
											$EnpopulerUrunlerSorgusu->execute();
											$enpopulerUrunSayisi			=	$EnpopulerUrunlerSorgusu->rowCount();
											$enpopulerurunler		=	$EnpopulerUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

											$DonguSayisi			=	1;
											$SutunAdetSayisi		=	5;
											if ($enpopulerUrunSayisi>0) {
												foreach($enpopulerurunler as $urun){
													$UrununFiyati		=	DonusumleriGeriDondur($urun["urunfiyati"]);
													$UrununParaBirimi	=	DonusumleriGeriDondur($urun["parabirimi"]);
													$UrununToplamYorumSayisi	=	DonusumleriGeriDondur($urun["yorumsayisi"]);
													$UrununToplamYorumPuani		=	DonusumleriGeriDondur($urun["toplamyorumpuani"]);
													$urununturu=DonusumleriGeriDondur($urun["urunturu"]);
													if ($UrununParaBirimi=='USD') {
														$urunfiyatihesapla=$UrununFiyati*$dolarkuru;
													}elseif ($UrununParaBirimi=='EUR') {
														$urunfiyatihesapla=$UrununFiyati*$eurokuru;
													}else{
														$urunfiyatihesapla=$UrununFiyati;
													}
													if($UrununToplamYorumSayisi>0){
														$PuanHesapla			=	number_format($UrununToplamYorumPuani/$UrununToplamYorumSayisi, 2, ".", "");
													}else{
														$PuanHesapla			=	0;
													}
													if ($PuanHesapla==0) {
														$puanresmi="YildizCizgiliBos.png";
													}elseif(($PuanHesapla>0) and ($PuanHesapla<=1)){
														$puanresmi="YildizCizgiliBirDolu.png";
													}elseif(($PuanHesapla>1) and ($PuanHesapla<=2)){
														$puanresmi="YildizCizgiliIkiDolu.png";
													}elseif(($PuanHesapla>2) and ($PuanHesapla<=3)){
														$puanresmi="YildizCizgiliUcDolu.png";
													}elseif(($PuanHesapla>3) and ($PuanHesapla<=4)){
														$puanresmi="YildizCizgiliDortDolu.png";
													}elseif(($PuanHesapla>4)){
														$puanresmi="YildizCizgiliBesDolu.png";
													}
													?>
													<td width="205" valign="top"><table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
														<tr height="40">
															<td align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>"><img src="Resimler/UrunResimleri/<?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadin";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek"; }else{ echo "Cocuk"; } ?>/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>" border="0" width="205" height="240"></a></td>
														</tr>
														<tr height="25">
															<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadın Ayakkabısı";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek Ayakkabısı"; }else{ echo "Çocuk Ayakkabısı "; } ?></a></td>
														</tr>
														<tr height="25">
															<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: black; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></div></a></td>
														</tr>
														<tr height="25">
															<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #646464; text-decoration: none;"><div><img src="Resimler/<?php echo $puanresmi; ?>" border="0"></div></a></td>
														</tr>
														<tr height="25">
															<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #990000; text-decoration: none; font-weight: bold;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo fiyatbicimlendir($urunfiyatihesapla); ?> TL </div></a></td>
														</tr>
													</table></td>
													<?php
													if($DonguSayisi<$SutunAdetSayisi){
														?>
														<td width="10">&nbsp;</td>
														<?php
													}
													?>
													<?php
													$DonguSayisi++;

													if($DonguSayisi>$SutunAdetSayisi){
														echo "</tr><tr>";
														$DonguSayisi	=	1;
													}
												}	
											}else{
												?>
												<td  width="795" align="center" valign="top">Sisteme kayıtlı ürün bulunamadı.</td>
												<?php
											}
											?></tr>
										</table></td>
									</tr>
									<tr height="35">
										<td bgcolor="#FF9900" style="color: white; font-weight: bold;" >&nbsp;En Çok Satan Ürünler</td>
									</tr>
									<tr>
										<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<?php
														$EncoksatanUrunlerSorgusu		=	$DBConnection->prepare("SELECT * FROM urunler WHERE durumu = '1' ORDER BY toplamsatissayisi DESC LIMIT 5");
														$EncoksatanUrunlerSorgusu->execute();
														$encoksatanUrunSayisi			=	$EncoksatanUrunlerSorgusu->rowCount();
														$encoksatanurunler		=	$EncoksatanUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

														$DonguSayisi			=	1;
														$SutunAdetSayisi		=	5;
														if ($encoksatanUrunSayisi>0) {
															foreach($encoksatanurunler as $urun){
																$UrununFiyati		=	DonusumleriGeriDondur($urun["urunfiyati"]);
																$UrununParaBirimi	=	DonusumleriGeriDondur($urun["parabirimi"]);
																$UrununToplamYorumSayisi	=	DonusumleriGeriDondur($urun["yorumsayisi"]);
																$UrununToplamYorumPuani		=	DonusumleriGeriDondur($urun["toplamyorumpuani"]);
																$urununturu=DonusumleriGeriDondur($urun["urunturu"]);
																if ($UrununParaBirimi=='USD') {
																	$urunfiyatihesapla=$UrununFiyati*$dolarkuru;
																}elseif ($UrununParaBirimi=='EUR') {
																	$urunfiyatihesapla=$UrununFiyati*$eurokuru;
																}else{
																	$urunfiyatihesapla=$UrununFiyati;
																}
																if($UrununToplamYorumSayisi>0){
																	$PuanHesapla			=	number_format($UrununToplamYorumPuani/$UrununToplamYorumSayisi, 2, ".", "");
																}else{
																	$PuanHesapla			=	0;
																}
																if ($PuanHesapla==0) {
																	$puanresmi="YildizCizgiliBos.png";
																}elseif(($PuanHesapla>0) and ($PuanHesapla<=1)){
																	$puanresmi="YildizCizgiliBirDolu.png";
																}elseif(($PuanHesapla>1) and ($PuanHesapla<=2)){
																	$puanresmi="YildizCizgiliIkiDolu.png";
																}elseif(($PuanHesapla>2) and ($PuanHesapla<=3)){
																	$puanresmi="YildizCizgiliUcDolu.png";
																}elseif(($PuanHesapla>3) and ($PuanHesapla<=4)){
																	$puanresmi="YildizCizgiliDortDolu.png";
																}elseif(($PuanHesapla>4)){
																	$puanresmi="YildizCizgiliBesDolu.png";
																}
																?>
																<td width="205" valign="top"><table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
																	<tr height="40">
																		<td align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>"><img src="Resimler/UrunResimleri/<?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadin";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek"; }else{ echo "Cocuk"; } ?>/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>" border="0" width="205" height="240"></a></td>
																	</tr>
																	<tr height="25">
																		<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;"><?php if ($urununturu=="Kadın Ayakkabısı") {	echo "Kadın Ayakkabısı";	}elseif ($urununturu=="Erkek Ayakkabısı") { echo "Erkek Ayakkabısı"; }else{ echo "Çocuk Ayakkabısı "; } ?></a></td>
																	</tr>
																	<tr height="25">
																		<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: black; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></div></a></td>
																	</tr>
																	<tr height="25">
																		<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #646464; text-decoration: none;"><div><img src="Resimler/<?php echo $puanresmi; ?>" border="0"></div></a></td>
																	</tr>
																	<tr height="25">
																		<td width="205" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #990000; text-decoration: none; font-weight: bold;"><div style="width: 205px; max-width: 205px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo fiyatbicimlendir($urunfiyatihesapla); ?> TL </div></a></td>
																	</tr>
																</table></td>
																<?php
																if($DonguSayisi<$SutunAdetSayisi){
																	?>
																	<td width="10">&nbsp;</td>
																	<?php
																}
																?>
																<?php
																$DonguSayisi++;

																if($DonguSayisi>$SutunAdetSayisi){
																	echo "</tr><tr>";
																	$DonguSayisi	=	1;
																}
															}	
														}else{
															?>
															<td  width="795" align="center" valign="top">Sisteme kayıtlı ürün bulunamadı.</td>
															<?php
														}
														?>
													</tr>
												</table></td>
											</tr>
										</table></td>
									</tr>
								</table></td>
							</tr>
						</table></td>
					</tr>
				</table>