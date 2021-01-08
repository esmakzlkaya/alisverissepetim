<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;KARGO AYARLARI</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=22" style="text-decoration: none; color: white;"> + Yeni Kargo Firması Ekle&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 

		$kargolarSorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari ORDER BY kargofirmasiadi ASC");
		$kargolarSorgusu->execute();
		$kargosayisi=$kargolarSorgusu->rowCount();
		$kargokayitlari=$kargolarSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($kargosayisi>0){
			foreach ($kargokayitlari as $kargo) {
				$kargoid=$kargo["id"];
				$kargofirmasilogosu=$kargo["kargofirmasilogosu"];
				$kargofirmasiadi=$kargo["kargofirmasiadi"];
				?>
				<tr height="50"  valign="top">
					<td colspan="2" width="750" align="right" valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td align="left" width="220"><img style="margin-top: 5px;" src="../Resimler/<?php echo DonusumleriGeriDondur($kargofirmasilogosu); ?>" border="0"></td>
							<td align="left" width="10">&nbsp;</td>
							<td align="left" width="150" style="color: black;"><b>Kargo Firması Adı</b></td>
							<td align="left" width="20"  style="color: black;" >:</td>
							<td align="left" width="200"  style="color: black;" ><?php echo DonusumleriGeriDondur($kargofirmasiadi); ?></td>
							<td align="left" width="10">&nbsp;</td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=26&id=<?php echo DonusumleriGeriDondur($kargoid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
							<td align="left" width="70"><a href="index.php?SKD=0&SKI=26&id=<?php echo DonusumleriGeriDondur($kargoid); ?>"  style="color:  #0000FF; text-decoration: none;">Güncelle</a></td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=30&id=<?php echo DonusumleriGeriDondur($kargoid); ?>"><img style="margin-top: 5px;" src="../Resimler/Sil20x20.png" border="0"></a></td>
							<td align="left" width="30"><a href="index.php?SKD=0&SKI=30&id=<?php echo DonusumleriGeriDondur($kargoid); ?>" style="color:  #FF0000; text-decoration: none;">Sil</a></td>
							
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
				<td colspan="" style="border: solid 1px #F50000; color: black;">Kargo firması bulunmamaktadır. </td>
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