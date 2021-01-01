<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=2" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" bgcolor="#001d26" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;BANKA HESAPLARI AYARLARI</h3></td>
				<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=10" style="text-decoration: none; color: white;"> + Yeni Banka Hesabı Ekle&nbsp;</a></td>
			</tr>
			<tr height="1">
				<td colspan="2" style="border: solid 1px #F50000;"></td>
			</tr>
			<?php 

			$bankahesaplariSorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari ORDER BY bankaadi ASC");
			$bankahesaplariSorgusu->execute();
			$bankahesapsayisi=$bankahesaplariSorgusu->rowCount();
			$bankakayitlari=$bankahesaplariSorgusu->fetchAll(PDO::FETCH_ASSOC);
			if($bankahesapsayisi>0){
				foreach ($bankakayitlari as $bankalar) {
					$bankaid=$bankalar["id"];
					$bankaadi=$bankalar["bankaadi"];
					$konumsehir=$bankalar["konumsehir"];
					$konumulke=$bankalar["konumulke"];
					$subeadi=$bankalar["subeadi"];
					$subekodu=$bankalar["subekodu"];
					$parabirimi=$bankalar["parabirimi"];
					$hesapsahibi=$bankalar["hesapsahibi"];
					$hesapno=$bankalar["hesapno"];
					$ibanno=$bankalar["ibanno"];
					$bankalogo=$bankalar["bankalogo"];
					
					?>
					<tr height="120" bgcolor="#001d26" valign="top">
						<td colspan="2" width="750" align="right" bgcolor="#001d26" valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="150"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr height="60">
										<td><img src="../Resimler/<?php echo DonusumleriGeriDondur($bankalogo); ?>" border="0"></td>
									</tr>
									<tr height="60">
										<td align="center"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="30" valign="top"><a href="index.php?SKD=0&SKI=14&id=<?php echo DonusumleriGeriDondur($bankaid); ?>"><img src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
												<td width="100" valign="top"><a href="index.php?SKD=0&SKI=14&id=<?php echo DonusumleriGeriDondur($bankaid); ?>"  style="color: white; text-decoration: none;">Güncelle</a></td>
												<td width="30" valign="top"><a href="index.php?SKD=0&SKI=18&id=<?php echo DonusumleriGeriDondur($bankaid); ?>"><img src="../Resimler/Sil20x20.png" border="0"></a></td>
												<td width="40" valign="top"><a href="index.php?SKD=0&SKI=18&id=<?php echo DonusumleriGeriDondur($bankaid); ?>" style="color: white; text-decoration: none;">Sil</a></td>
											</tr>
										</table></td>
									</tr>
								</table></td>
								<td width="10" >&nbsp;</td>
								<td height="90" width="590" align="right" bgcolor="#001d26" valign="top"><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width=""><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="590"><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
													<tr height="40" style="border: solid 1px white;">
														<td width="110" style="color: white;"><b>Banka Adı</b></td>
														<td width="20"  style="color: white;" >:</td>
														<td width="150"  style="color: white;" ><?php echo DonusumleriGeriDondur($bankaadi); ?></td>
														<td width="130"  style="color: white;" ><b>Hesap Sahibi</b></td>
														<td width="20"  style="color: white;" >:</td>
														<td width="170"  style="color: white;" ><?php echo DonusumleriGeriDondur($hesapsahibi); ?></td>
													</tr>
												</table></td>
											</tr>
										</table></td>
									</tr>
									<tr>
										<td><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="590"><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
													<tr height="40" style="border: solid 1px white;">
														<td width="185" style="color: white;"><b>Şube ve Konum Bilgileri</b></td>
														<td width="20"  style="color: white;" >:</td>
														<td width="385"  style="color: white;" ><?php echo DonusumleriGeriDondur($subeadi); ?> (<?php echo DonusumleriGeriDondur($subekodu); ?>) - <?php echo DonusumleriGeriDondur($konumsehir); ?> - <?php echo DonusumleriGeriDondur($konumulke); ?></td>
													</tr>
												</table></td>
											</tr>
										</table></td>
									</tr>
									<tr>
										<td><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="590"><table width="590" align="right" border="0" cellpadding="0" cellspacing="0">
													<tr height="40" style="border: solid 1px white;">
														<td width="130"  style="color: white;" ><b>Hesap Bilgileri</b></td>
														<td width="15"  style="color: white;" >:</td>
														<td width="435"  style="color: white;" ><?php echo DonusumleriGeriDondur($parabirimi); ?> / <?php echo DonusumleriGeriDondur($hesapno); ?> / <?php echo DonusumleriGeriDondur($ibanno); ?></td>	
													</tr>
												</table></td>
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
					<td colspan="" style="border: solid 1px #F50000; color: white;">Banka hesabı bulunmamaktadır. </td>
				</tr>
				<?php
			}
			?>
		</table>
	</form>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>