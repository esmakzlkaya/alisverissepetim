<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;SİPARİŞLER</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=107 style="text-decoration: none; color: white;"> Tamamlanan Siparişler&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 
		$siparisnosorgu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE kargodurumu=0 ORDER BY id ASC");
		$siparisnosorgu->execute([$id]);
		$siparisnosayisi=$siparisnosorgu->rowCount();
		$siparisnokayitlar=$siparisnosorgu->fetchAll(PDO::FETCH_ASSOC);
		if ($siparisnosayisi>0) {
			foreach ($siparisnokayitlar as $sipno) {




				$siparislerSorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE siparisnumarasi=? AND kargodurumu=0 ORDER BY id ASC");
				$siparislerSorgusu->execute([$sipno["siparisnumarasi"]]);
				$siparisSayisi=$siparislerSorgusu->rowCount();
				$yoneticiler=$siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
				if($siparisSayisi>0){
					foreach ($yoneticiler as $siparis) {
						$yoneticiid=$siparis["id"];
						$kullaniciadi=$siparis["kullaniciadi"];
						$isimsoyisim=$siparis["isimsoyisim"];
						$telno=$siparis["telno"];
						$mail=$siparis["mail"];
						?>
						<tr height="50"  valign="top">
							<td colspan="2" width="750" align="right" valign="top" style="border-bottom: solid 1px #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr height="30">
									<td align="left" width="170"  style="color: black;" ><b>Kullanıcı Adı</b></td>
									<td align="left" width="170"  style="color: black;" ><b>İsim Soyisim</b></td>
									<td align="left" width="220"  style="color: black;" ><b>E posta</b></td>
									<td align="left" width="110"  style="color: black;" ><b>Telefon</b></td>
									<td align="left" width="25"><a href="index.php?SKD=0&SKI=75&id=<?php echo DonusumleriGeriDondur($yoneticiid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
									<td align="left" width="50"><a href="index.php?SKD=0&SKI=75&id=<?php echo DonusumleriGeriDondur($yoneticiid); ?>"  style="color:  #0000FF; text-decoration: none;">Güncelle</a></td>
								</tr>
								<tr height="30">
									<td align="left" width="170"  style="color: black;" ><?php echo DonusumleriGeriDondur($kullaniciadi); ?></td>
									<td align="left" width="170"  style="color: black;" ><?php echo DonusumleriGeriDondur($isimsoyisim); ?></td>
									<td align="left" width="220"  style="color: black;" ><?php echo DonusumleriGeriDondur($mail); ?></td>
									<td align="left" width="110"  style="color: black;" ><?php echo DonusumleriGeriDondur($telno); ?></td>
									<td align="left" width="25"><a href="index.php?SKD=0&SKI=79&id=<?php echo DonusumleriGeriDondur($yoneticiid); ?>"><img style="margin-top: 5px;" src="../Resimler/Sil20x20.png" border="0"></a></td>
									<td align="left" width="50"><a href="index.php?SKD=0&SKI=79&id=<?php echo DonusumleriGeriDondur($yoneticiid); ?>" style="color:  #FF0000; text-decoration: none;">Sil</a></td>
								</tr>
							</table></td>
						</tr>
						<?php
					}
				}else{
					header("Location:index.php?SKD=0&SKI=0");
					exit();
				}
				?>
				<td width="10" colspan="2" style="border-bottom: 1px solid white;" >&nbsp;</td>
				<?php
			}
		}else{
			?>
			<tr height="50">
				<td colspan="" style="border: solid 1px #F50000; color: black;">Yönetici kaydı bulunmamaktadır. </td>
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