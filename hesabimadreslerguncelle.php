<?php
if(isset($_SESSION["kullanici"])){
	if (isset($_GET["id"])) {
		$gelenid=Guvenlik($_GET["id"]);
	}else{
		$gelenid="";
	}
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
				<form method="post" action="index.php?SK=63&id=<?php echo $gelenid; ?>">
					<table  width="1065" align="left" border="0" cellspacing="0" cellpadding="0">
						<tr height="30">
							<td colspan="5" style="color: #FF9900" ><h3>HESABIM > ADRESLER</h3></td>
						</tr>
						<tr height="30">
							<td colspan="5" style="border-bottom: 1px solid #CCCCCC;" class="">Adres güncelleme. </td>
						</tr>
						<tr height="40" bgcolor="#F8FFA7" style="color: black; ">
							<td colspan="1" align="left" style="padding: 0px 5px;"><b>Adres Güncelle </b></td>
							<td colspan="4" align="right" style="padding: 0px 5px;"><b><a class="hesabimlink" href="index.php?SK=70"> + Yeni Adres Ekle</a></b></td>
						</tr>
						<?php 
						$adressorgusu=$DBConnection->prepare("SELECT * FROM adresler WHERE id=? AND uyeid=?LIMIT 1");
						$adressorgusu->execute([$gelenid,$id]);
						$adressayisi=$adressorgusu->rowCount();
						$adres=$adressorgusu->fetch(PDO::FETCH_ASSOC);
						if($adressayisi>0){
							?>
							<tr height="30" align="left">
								<td align="left" valign="bottom"><b>Ad Soyad (*) </b></td>
							</tr>
							<tr>
								<td align="left" valign="top"><input type="text" name="adsoyad" value="<?php echo $adres["adsoyad"]; ?>" class="inputAlanlari"></td>
							</tr>
							<tr height="30" align="left">
								<td align="left" valign="bottom" ><b>Adres (*) </b></td>
							</tr>
							<tr>
								<td align="left" valign="top"><input type="text" name="adres" value="<?php echo $adres["adres"]; ?>" class="inputAlanlari"></td>
							</tr>
							<tr height="30" align="left">
								<td align="left" valign="bottom"><b>İlçe (*) </b></td>
							</tr>
							<tr>
								<td align="left" valign="top"><input type="text" name="ilce" value="<?php echo $adres["ilce"]; ?>" class="inputAlanlari"></td>
							</tr>
							<tr height="30" align="left">
								<td align="left" valign="bottom"><b>Şehir (*) </b></td>
							</tr>
							<tr>
								<td align="left" valign="top"><input type="text" name="sehir" value="<?php echo $adres["sehir"]; ?>" class="inputAlanlari"></td>
							</tr>
							<tr height="30" align="left">
								<td align="left" valign="bottom"><b>Telefon Numarası (*) </b></td>
							</tr>
							<tr height="30">
								<td align="left" valign="top"><input type="text" name="tel" value="<?php echo $adres["telno"]; ?>" class="inputAlanlari"></td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td style="font-size: 14px;" >(*)Boş bırakmayınız.</td>
						</tr>
						<tr height="50">
							<td align="center"><input type="submit" value="ADRESİ GÜNCELLE" class="bilgilerimiguncellebutonu"></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:index.php");
	exit();
} 
?>