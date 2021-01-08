<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;BANNER AYARLARI</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=34" style="text-decoration: none; color: white;"> + Yeni Banner Ekle&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 

		$bannerlarSorgusu=$DBConnection->prepare("SELECT * FROM bannerlar ORDER BY gosterimsayisi ASC");
		$bannerlarSorgusu->execute();
		$bannersayisi=$bannerlarSorgusu->rowCount();
		$bannerkayitlari=$bannerlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($bannersayisi>0){
			foreach ($bannerkayitlari as $banner) {
				$bannerid=$banner["id"];
				$bannerresmi=$banner["bannerresmi"];
				$banneradi=$banner["banneradi"];
				$banneralani=$banner["banneralani"];
				$bannergosterimsayisi=$banner["gosterimsayisi"];
				?>
				<tr height="50" bgcolor="" valign="top">
					<td colspan="2" width="750" align="right"  valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="40" style="border: solid 1px white;">
							<td align="left" width="175"><img style="margin-top: 5px;" src="../Resimler/<?php echo DonusumleriGeriDondur($bannerresmi); ?>" border="0" height="30"></td>
							
							<td align="left" width="575"><table width="575" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr height="20">
									<td width="1">&nbsp;</td>
									<td align="left" width="50" style="color: black;"><b>Adı</b></td>
									<td align="left" width="10"  style="color: black;" >:</td>
									<td align="left" width="150"  style="color: black;" ><?php echo DonusumleriGeriDondur($banneradi); ?></td>

									<td align="left" width="50" style="color: black;"><b>Yeri</b></td>
									<td align="left" width="10"  style="color: black;" >:</td>
									<td align="left" width="125"  style="color: black;" ><?php echo DonusumleriGeriDondur($banneralani); ?></td>
									
									<td align="left" width="50" style="color: black;"><b>Hit</b></td>
									<td align="left" width="10"  style="color: black;" >:</td>
									<td align="left" width="50"  style="color: black;" ><?php echo DonusumleriGeriDondur($bannergosterimsayisi); ?></td>
								</tr>
								<tr height="20">
									<td colspan="10"><table width="575" align="right" border="0" cellpadding="0" cellspacing="0">
										<tr height="20">
											<td width="425">&nbsp;</td>
											<td align="left" width="25"><a href="index.php?SKD=0&SKI=38&id=<?php echo DonusumleriGeriDondur($bannerid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
											<td align="left" width="70"><a href="index.php?SKD=0&SKI=38&id=<?php echo DonusumleriGeriDondur($bannerid); ?>"  style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
											<td align="left" width="25"><a href="index.php?SKD=0&SKI=42&id=<?php echo DonusumleriGeriDondur($bannerid); ?>"><img style="margin-top: 5px;" src="../Resimler/Sil20x20.png" border="0"></a></td>
											<td align="left" width="30"><a href="index.php?SKD=0&SKI=42&id=<?php echo DonusumleriGeriDondur($bannerid); ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>

										</tr>
									</table></td>
								</tr>	
							</table></td>
						</tr>
					</table></td>
				</tr>
				<?php 
			}
			?>
			<td width="10" colspan="2" style="border-bottom: 1px solid white;" >&nbsp;</td>
			<?php
		}
		else{
			?>
			<tr height="50">
				<td colspan="" style="border: solid 1px #F50000; color: black;">Kayıtlı banner bulunmamaktadır. </td>
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