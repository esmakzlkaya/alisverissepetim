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
					$adressorgusu=$DBConnection->prepare("SELECT * FROM adresler WHERE uyeid=?");
					$adressorgusu->execute([$id]);
					$adressayisi=$adressorgusu->rowCount();
					$adres=$adressorgusu->fetchAll(PDO::FETCH_ASSOC);

					$ilkrenk="#FFFFFF";
					$ikincirenk="#F1F1F1";
					$sayi=1;

					if($adressayisi>0){
						foreach ($adres as $k) {
							if ($sayi%2) {
								$arkaplanrenk=$ilkrenk;
							}
							else{
								$arkaplanrenk=$ikincirenk;
							}
							?>
							<tr height="40" bgcolor="<?php echo $arkaplanrenk; ?>">
								<td><?php echo $k["adsoyad"];?> - <?php echo $k["adres"]; ?>  <?php echo $k["ilce"]; ?> / <?php echo $k["sehir"]; ?> - <?php echo $k["telno"]; ?></td>
								<td width="25"><a  href="index.php?SK=62&id=<?php echo $k["id"]; ?>"><img src="Resimler/Guncelleme20x20.png" style="margin-top: 5px;"></a></td>
								<td width="70"><a class="hesabimlink" href="index.php?SK=62&id=<?php echo $k["id"]; ?>">Güncelle</a></td>
								<td width="25"><a  href="index.php?SK=67&id=<?php echo $k["id"]; ?>"><img src="Resimler/Sil20x20.png" style="margin-top: 5px;"></a></td>
								<td width="25"><a class="hesabimlink" href="index.php?SK=67&id=<?php echo $k["id"]; ?>">Sil</a></td>
							</tr>
							<?php
							$sayi++;
						}
					}else{
						?>
						<tr height="50">
							<td colspan="8" align="left">Sisteme kayıtlı siparişiniz bulunamadı.</td>
						</tr>

						<?php 

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