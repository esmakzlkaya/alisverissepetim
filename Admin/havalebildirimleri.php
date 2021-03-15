<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;HAVALE BİLDİRİMLERİ</h3></td>
		</tr>
		<tr height="1">
			<td style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 

		$bildirimSorgusu=$DBConnection->prepare("SELECT * FROM havalebildirimleri ORDER BY islemtarihi ASC");
		$bildirimSorgusu->execute();
		$bildirimsayisi=$bildirimSorgusu->rowCount();
		$bildirimler=$bildirimSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($bildirimsayisi>0){
			foreach ($bildirimler as $bildirim) {

				$bankaid=$bildirim["bankaid"];
				$Bankalarsorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari WHERE id=? LIMIT 1");
				$Bankalarsorgusu->execute([$bankaid]);
				$bankalarkaydi=$Bankalarsorgusu->fetch(PDO::FETCH_ASSOC);

				$banka_adi=$bankalarkaydi["bankaadi"];
				?>
				<tr height="50"  valign="top">
					<td width="750" align="right" valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="30" style="border: solid 1px white;">
							<td colspan="2" align="left" width="500"><b><?php echo DonusumleriGeriDondur($bildirim["adsoyad"]); ?></b></td>
							<td align="right" width="250"><?php echo TarihBul($bildirim["islemtarihi"]); ?></td>
						</tr>
						<tr height="30" style="border: solid 1px white;">
							<td align="left" width="250"><b>Banka Adı : </b><?php echo DonusumleriGeriDondur($banka_adi); ?></td>
							<td align="left" width="250"><b>Telefon : </b><?php echo DonusumleriGeriDondur($bildirim["telno"]); ?></td>
							<td align="left" width="250"><b>E-mail : </b><?php echo DonusumleriGeriDondur($bildirim["email"]); ?></td>
						</tr>
						<tr height="30" style="border: solid 1px white;">
							<td colspan="3" align="left"><b>Açıklama Metni : </b><?php echo DonusumleriGeriDondur($bildirim["aciklama"]); ?></td>
						</tr>
						<tr height="20">
							<td align="right" colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
								<tr height="20">
									<td width="695">&nbsp;</td>
									<td width="25" align="left" valign="top"><a href="index.php?SKD=0&SKI=117&id=<?php echo DonusumleriGeriDondur($bildirim["id"]); ?>"><img src="../Resimler/Sil20x20.png" border="0" style="margin-top: 1px;"></a></td>
									<td width="25" align="left" valign="top"><a href="index.php?SKD=0&SKI=117&id=<?php echo DonusumleriGeriDondur($bildirim["id"]); ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
								</tr>
							</table></td>
						</tr>
					</table></td>
				</tr>
				<?php 
			}
			?>
			<td width="10" style="border-bottom: 1px solid white;" >&nbsp;</td>
			<?php
		}
		else{
			?>
			<tr>
				<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="750">Kayıtlı havale bildirimi bulunmamaktadır.</td>
					</tr>
				</table></td>
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