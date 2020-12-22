<?php
if(isset($_REQUEST["menuid"])){
	$gelenmenuid		=	RakamliIfadeler(Guvenlik($_REQUEST["menuid"]));
	$MenuKosulu			=	 " AND menuid = '" . $gelenmenuid . "' ";
	$SayfalamaKosulu	=	"&menuid=" . $gelenmenuid;
}else{
	$gelenmenuid		=	"";
	$MenuKosulu			=	"";
	$SayfalamaKosulu	=	"";
}
if(isset($_REQUEST["aramaicerigi"])){
	$gelenaramaicerigi		=	Guvenlik($_REQUEST["aramaicerigi"]);
	$aramakosulu= "AND urunadi LIKE '%".$gelenaramaicerigi."%'";
	$SayfalamaKosulu .="&aramaicerigi=" . $gelenaramaicerigi;
}else{
	$gelenaramaicerigi		=	"";
	$aramakosulu="";
	$SayfalamaKosulu .="";
}
$SayfalamaIcinSolVeSagButonSayisi		=	2;
$SayfaBasinaGosterilecekKayitSayisi		=	8;
$ToplamKayitSayisiSorgusu				=	$DBConnection->prepare("SELECT * FROM urunler WHERE urunturu = 'Çocuk Ayakkabısı' AND durumu = '1' $MenuKosulu $aramakosulu ORDER BY id DESC");
$ToplamKayitSayisiSorgusu->execute();
$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi		=	($sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);

$tumurunlersayisisorgusu=$DBConnection->prepare("SELECT SUM(urunsayisi) AS toplamurunsayisi FROM menuler WHERE urunturu='Çocuk Ayakkabısı'");
$tumurunlersayisisorgusu->execute();
$tumurunlersayisikaydi = $tumurunlersayisisorgusu->fetch(PDO::FETCH_ASSOC);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="250" align="left" valign="top"><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="50">
						<td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
					</tr>
					<tr height="30">
						<td><a class="hesabimlink" href="index.php?SK=85" style="text-decoration: none; <?php if($gelenmenuid==""){ ?>color: #FF9900;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler (<?php echo $tumurunlersayisikaydi["toplamurunsayisi"]; ?>) </a></td>
					</tr>
					<?php
					$MenulerSorgusu		=	$DBConnection->prepare("SELECT * FROM menuler WHERE urunturu = 'Çocuk Ayakkabısı' ORDER BY menuadi ASC");
					$MenulerSorgusu->execute();
					$MenuKayitSayisi	=	$MenulerSorgusu->rowCount();
					$MenuKayitlari		=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

					foreach($MenuKayitlari as $Menu){
						?>
						<tr height="30">
							<td><a class="hesabimlink" href="index.php?SK=85&menuid=<?php echo $Menu["id"]; ?>" style="text-decoration: none; <?php if($gelenmenuid==$Menu["id"]){ ?>color: #FF9900;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($Menu["menuadi"]); ?> (<?php echo DonusumleriGeriDondur($Menu["urunsayisi"]); ?>)</a></td>
						</tr>
						<?php
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
					$BannerSorgusu		=	$DBConnection->prepare("SELECT * FROM bannerlar WHERE banneralani = 'Menu Altı' ORDER BY gosterimsayisi ASC LIMIT 1");
					$BannerSorgusu->execute();
					$BannerSayisi		=	$BannerSorgusu->rowCount();
					$BannerKaydi		=	$BannerSorgusu->fetch(PDO::FETCH_ASSOC);
					?>
					<tr height="250">
						<td><img src="Resimler/Banner/<?php echo $BannerKaydi["bannerresmi"]; ?>" border="0"></td>
					</tr>
					<?php
					$BannerGuncelle		=	$DBConnection->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
					$BannerGuncelle->execute([$BannerKaydi["id"]]);
					?>
				</table></td>
			</tr>
		</table></td>
		<td width="11" align="left">&nbsp;</td>
		<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><div class="aramaalani"><form method="post" action="<?php if ($MenuKosulu!=""){ ?> index.php?SK=85&menuid=<?php echo $gelenmenuid; }else{ ?> index.php?SK=85 <?php	} ?> ">
					<div class="aramaalanibuton">
						<input type="submit" value="" class="aramabutonu">
					</div>
					<div class="aramaalaniinput">
						<input type="text" name="aramaicerigi" class="aramainput">
					</div>
				</form></div></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="795" align="left" valign="top"><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<?php
									$UrunlerSorgusu		=	$DBConnection->prepare("SELECT * FROM urunler WHERE urunturu = 'Çocuk Ayakkabısı' AND durumu = '1' $MenuKosulu $aramakosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
									$UrunlerSorgusu->execute();
									$UrunSayisi			=	$UrunlerSorgusu->rowCount();
									$urunler		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

									$DonguSayisi			=	1;
									$SutunAdetSayisi		=	4;
									if ($UrunSayisi>0) {
										foreach($urunler as $urun){
											$UrununFiyati		=	DonusumleriGeriDondur($urun["urunfiyati"]);
											$UrununParaBirimi	=	DonusumleriGeriDondur($urun["parabirimi"]);
											$UrununToplamYorumSayisi	=	DonusumleriGeriDondur($urun["yorumsayisi"]);
											$UrununToplamYorumPuani		=	DonusumleriGeriDondur($urun["toplamyorumpuani"]);

											if ($UrununParaBirimi=="USD") {
												$urunfiyatihesapla=($UrununFiyati*$dolarkuru);
											}elseif ($UrununParaBirimi=="EUR") {
												$urunfiyatihesapla=($UrununFiyati*$eurokuru);
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
											<td width="191" valign="top">
												<table width="191" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
													<tr height="40">
														<td align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>"><img src="Resimler/UrunResimleri/Cocuk/<?php echo DonusumleriGeriDondur($urun["resimbir"]); ?>" border="0" width="180" height="240"></a></td>
													</tr>
													<tr height="25">
														<td width="191" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Çocuk Ayakkabısı</a></td>
													</tr>
													<tr height="25">
														<td width="191" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: black; text-decoration: none;"><div style="width: 191px; max-width: 191px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo DonusumleriGeriDondur($urun["urunadi"]); ?></div></a></td>
													</tr>
													<tr height="25">
														<td width="191" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #646464; text-decoration: none;"><div><img src="Resimler/<?php echo $puanresmi; ?>" border="0"></div></a></td>
													</tr>
													<tr height="25">
														<td width="191" align="center"><a href="index.php?SK=82&id=<?php echo DonusumleriGeriDondur($urun["id"]); ?>" style="color: #990000; text-decoration: none; font-weight: bold;"><div style="width: 191px; max-width: 191px; height: 28px; overflow: hidden; line-height: 14px;"><?php echo fiyatbicimlendir($urunfiyatihesapla); ?> TL </div></a></td>
													</tr>
												</table>
											</td>
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
							<?php
							if($BulunanSayfaSayisi>1){
								?>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr height="50">
									<td align="center"><div class="sayfalamaalanikapsayici">
										<div class="metinalanikapsayici">
											Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
										</div>
										<div class="numaraalanikapsayici">
											<?php
											if($sayfalama>1){
												echo "<span class='sayfalamapasif'><a href='index.php?SK=85" . $SayfalamaKosulu . "&page=1'><<</a></span>";
												$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$sayfalama-1;
												echo "<span class='sayfalamapasif'><a href='index.php?SK=85" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
											}
											for($SayfalamaIcinSayfaIndexDegeri=$sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
												if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
													if($sayfalama==$SayfalamaIcinSayfaIndexDegeri){
														echo "<span class='sayfalamaaktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
													}else{
														echo "<span class='sayfalamapasif'><a href='index.php?SK=85" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
													}
												}
											}
											if($sayfalama!=$BulunanSayfaSayisi){
												$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$sayfalama+1;
												echo "<span class='sayfalamapasif'><a href='index.php?SK=85" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
												echo "<span class='sayfalamapasif'><a href='index.php?SK=85" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
											}
											?>
										</div>
									</div></td>
								</tr>
								<?php
							}
							?>
						</table></td>
					</tr>
				</table></td>
			</tr>
		</table>