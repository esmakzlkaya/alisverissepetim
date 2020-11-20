<?php
if(isset($_SESSION["kullanici"])){
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr>
			<td colspan="3"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=50" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=58" style="text-decoration: none; color: black;">Adresler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=59" style="text-decoration: none; color: black;">Favoriler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=60" style="text-decoration: none; color: black;">Yorumlar</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="index.php?SK=61" style="text-decoration: none; color: black;">Siparişler</a></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="3"><hr/></td>
		</tr>
		<tr height="">
			<td width="1065" valign="top">
				<table  width="1065" align="left" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td colspan="8" style="color: #FF9900" ><h3>HESABIM > SİPARİŞLER</h3></td>
					</tr>
					<tr height="30">
						<td colspan="8" style="border-bottom: 1px solid #CCCCCC;" class="">Siparişlerine ilişkin bütün bilgiler burada. </td>
					</tr>
					<tr height="40" bgcolor="#F8FFA7" style="color: black; ">
						<td width="150" align="center" style="padding: 0px 5px;"><b>Sipariş Numarası </b></td>
						<td width="100" align="center" ><b>Ürün Resmi </b></td>
						<td width="80" align="center" ><b>Yorum </b></td>
						<td width="205" align="center" ><b>Ürün Adı </b></td>
						<td width="100" align="center" ><b>Ürün Fiyatı </b></td>
						<td width="90" align="center" ><b>Ürün Adedi </b></td>
						<td width="150" align="center" ><b>Toplam Ürün Fiyatı </b></td>
						<td width="190" align="center" style="padding: 0px 5px;"><b>Kargo Durumu / Takip </b></td>
					</tr>
					<?php 
					$siparisnosorgu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE uyeid=? ORDER BY siparisnumarasi DESC ");
					$siparisnosorgu->execute([$id]);
					$siparisnosayisi=$siparisnosorgu->rowCount();
					$siparisnokayitlar=$siparisnosorgu->fetchAll(PDO::FETCH_ASSOC);
					if ($siparisnosayisi>0) {
						foreach ($siparisnokayitlar as $sipno) {
							$siparisno=DonusumleriGeriDondur($sipno["siparisnumarasi"]);

							$adressorgusu=$DBConnection->prepare("SELECT * FROM siparisler WHERE uyeid=? and siparisnumarasi=? ORDER BY id ASC");
							$adressorgusu->execute([$id,$siparisno]);
							$adressayisi=$adressorgusu->rowCount();
							$adres=$adressorgusu->fetchAll(PDO::FETCH_ASSOC);

							if ($adressayisi>0) {
								foreach ($adres as $adress) {
									$urunturu=DonusumleriGeriDondur($adress["urunturu"]);
									if ($urunturu=="Erkek Ayakkabısı") {
										$klasoradi="Erkek";
									}elseif ($urunturu=="Kadın Ayakkabısı") {
										$klasoradi="Kadin";
									}else{
										$klasoradi="Cocuk";
									}
									$kargodurumu=DonusumleriGeriDondur($adress["kargodurumu"]);
									if ($kargodurumu==0) {
										$kargodurumuyazdir="Beklemede";
									}else{
										$kargodurumuyazdir=DonusumleriGeriDondur($adress["kargogonderino"]);
									}
									?>
									<tr height="40" bgcolor="" style="color: black; ">
										<td width="150" align="center" style="padding: 0px 5px;"><?php echo DonusumleriGeriDondur($adress["siparisnumarasi"]); ?></td>
										<td width="100" align="center" ><img src="Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo DonusumleriGeriDondur($adress["urunresmibir"]) ?>" width="60" height="80" border="0"></td>
										<td width="80" align="center" ><a href="xxxxx"><img src="Resimler/DokumanKirmiziKalemli20x20.png"></a></td>
										<td width="205" align="center" ><?php echo DonusumleriGeriDondur($adress["urunadi"]); ?></td>
										<td width="100" align="center" ><?php echo DonusumleriGeriDondur($adress["urunfiyati"]); ?></td>
										<td width="90" align="center" ><?php echo DonusumleriGeriDondur($adress["urunadedi"]); ?></td>
										<td width="150" align="center" ><?php echo DonusumleriGeriDondur($adress["toplamurunfiyati"]); ?></td>
										<td width="190" align="center" style="padding: 0px 5px;"><?php echo $kargodurumuyazdir; ?></td>
									</tr>
									<?php
								}
							}else{
								?>
								<tr height="50">
									<td colspan="8" align="left">Sisteme kayıtlı siparişiniz bulunamadı.</td>
								</tr>
								<?php 
							}
						}
					}
					?>
				</table>
			</td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:index.php");
	exit();
} 
?>