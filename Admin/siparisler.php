<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;SİPARİŞLER</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=108" style="text-decoration: none; color: white;"> Tamamlanan Siparişler&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 
		$siparisnosorgu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE onaydurumu=0 AND kargodurumu=0 ORDER BY id ASC");
		$siparisnosorgu->execute();
		$siparisnosayisi=$siparisnosorgu->rowCount();
		$siparisnokayitlar=$siparisnosorgu->fetchAll(PDO::FETCH_ASSOC);
		if ($siparisnosayisi>0) {
			foreach ($siparisnokayitlar as $sipno) {
				$siparislerSorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE onaydurumu=0 AND siparisnumarasi=? AND kargodurumu=0 ORDER BY id ASC");
				$siparislerSorgusu->execute([$sipno["siparisnumarasi"]]);
				$siparisSayisi=$siparislerSorgusu->rowCount();
				$yoneticiler=$siparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
				if($siparisSayisi>0){
					$toplamfiyat=0;
					foreach ($yoneticiler as $siparis) {
						$urunToplamFiyati=$siparis["toplamurunfiyati"];
						$siparisTarihi=TarihBul($siparis["siparistarihi"]);
						$toplamfiyat+=$urunToplamFiyati;
					}
					?>
					<tr height="50"  valign="top">
						<td colspan="2" width="750" align="right" valign="top" style="border-bottom: solid 1px #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr height="30">
								<td align="left" width="150"  style="color: black;" ><b>Sipariş Tarihi </b></td>
								<td align="left" width="10"  style="color: black;" ><b> : </b></td>
								<td align="left" width="150"  style="color: black;" ><?php echo $siparisTarihi; ?></td>
								<td align="left" width="150"  style="color: black;" ><b>Sipariş Toplam Tutarı </b></td>
								<td align="left" width="10"  style="color: black;" ><b> : </b></td>
								<td align="left" width="150"  style="color: black;" ><?php echo fiyatbicimlendir($toplamfiyat); ?> TL</td>
								<td align="left" width="130"><table width="130" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td align="left" width="25"><a href="index.php?SKD=0&SKI=107&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>"><img src="../Resimler/DokumanKirmiziKalemli20x20.png"></a></td>
										<td align="left" width="105" style="color: black;"><a href="index.php?SKD=0&SKI=107&SiparisNo=<?php echo $sipno["siparisnumarasi"]; ?>" style="text-decoration: none; color: black;"><b>SİPARİŞİ GÖRÜNTÜLE</b></a></td>
									</tr>
								</table></td>
							</tr>
						</table></td>
					</tr>
					<?php
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