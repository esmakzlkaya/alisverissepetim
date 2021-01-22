<?php
if (isset($_SESSION["yonetici"])) {
	if(isset($_REQUEST["aramaicerigi"])){
		$gelenaramaicerigi		=	Guvenlik($_REQUEST["aramaicerigi"]);
		$aramakosulu= "AND (adsoyad LIKE '%".$gelenaramaicerigi."%' OR  mail LIKE '%".$gelenaramaicerigi."%' OR telno LIKE '%".$gelenaramaicerigi."%' )";
		$SayfalamaKosulu ="&aramaicerigi=" . $gelenaramaicerigi;
	}else{
		$gelenaramaicerigi		=	"";
		$aramakosulu="";
		$SayfalamaKosulu ="";
	}
	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	1;
	$ToplamKayitSayisiSorgusu				=	$DBConnection->prepare("SELECT * FROM uyeler WHERE silinmedurumu = '1' $aramakosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute();
	$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi		=	($sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
	?>
	<table width="760" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;ÜYELER</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=82" style="text-decoration: none; color: white;">AKTİF ÜYELER&nbsp;</a></td>
		</tr>
		<tr height="10">
			<td colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2"><table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<div class="aramaalani"><form method="post" action="index.php?SKD=0&SKI=82">
							<div class="aramaalanibuton">
								<input type="submit" value="" class="aramabutonu">
							</div>
							<div class="aramaalaniinput">
								<input type="text" name="aramaicerigi" class="aramainput">
							</div>
						</form></div>
					</td>
				</tr>
			</table></td>
		</tr>
		<?php 

		$uyelerSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE silinmedurumu = '1' $aramakosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
		$uyelerSorgusu->execute();
		$uyesayisi=$uyelerSorgusu->rowCount();
		$uyekayitlari=$uyelerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($uyesayisi>0){
			foreach ($uyekayitlari as $uyeler) {
				$uyeid=$uyeler["id"];
				$mail=$uyeler["mail"];
				$adsoyad=$uyeler["adsoyad"];
				$telno=$uyeler["telno"];
				$cinsiyet=$uyeler["cinsiyet"];
				$durumu=$uyeler["durumu"];
				$kayitTarihi=$uyeler["kayitTarihi"];
				$kayitIPAdresi=$uyeler["kayitIPAdresi"];
				$aktivasyonKodu=$uyeler["aktivasyonKodu"];
				$silinmedurumu=$uyeler["silinmedurumu"];
				?>
				<tr height="105" valign="top">
					<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td width="85" style="color: black;"><b>Adı Soyadı</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="150"  style="color: black;" ><?php echo DonusumleriGeriDondur($adsoyad); ?></td>
							<td width="90"  style="color: black;" ><b>E-posta</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="200"  style="color: black;" ><?php echo DonusumleriGeriDondur($mail); ?></td>
							<td width="70"  style="color: black;" ><b>Telefon</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="95"  style="color: black;" ><?php echo DonusumleriGeriDondur($telno); ?></td>
						</tr>
						<tr>
							<td width="85" style="color: black;"><b>Cinsiyet</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="150"  style="color: black;" ><?php echo DonusumleriGeriDondur($cinsiyet); ?></td>
							<td width="90"  style="color: black;" ><b>Kayıt Tarihi</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="200"  style="color: black;" ><?php echo TarihBul(DonusumleriGeriDondur($kayitTarihi)); ?></td>
							<td width="70"  style="color: black;" ><b>Kayıt IP</b></td>
							<td width="10"  style="color: black;" >:</td>
							<td width="95"  style="color: black;" ><?php echo DonusumleriGeriDondur($kayitIPAdresi); ?></td>
						</tr>
						<tr>
							<td colspan="9"><table width="95" border="0" align="right" cellspacing="0" cellpadding="0">
								<tr>
									<td align="right" width="25"><a href="index.php?SKD=0&SKI=87&id=<?php echo DonusumleriGeriDondur($uyeid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
									<td align="right" width="50"><a href="index.php?SKD=0&SKI=87&id=<?php echo DonusumleriGeriDondur($uyeid); ?>" style="color:  #009900; text-decoration: none;">Geri Aç</a></td>

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
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=83" . $SayfalamaKosulu . "&page=1'><<</a></span>";
								$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$sayfalama-1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
							}
							for($SayfalamaIcinSayfaIndexDegeri=$sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
								if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
									if($sayfalama==$SayfalamaIcinSayfaIndexDegeri){
										echo "<span class='sayfalamaaktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
									}else{
										echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
									}
								}
							}
							if($sayfalama!=$BulunanSayfaSayisi){
								$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$sayfalama+1;
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
								echo "<span class='sayfalamapasif'><a href='index.php?SKD=0&SKI=83" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
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