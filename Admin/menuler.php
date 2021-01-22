<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;MENÜLER</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=58" style="text-decoration: none; color: white;"> + Yeni Menü Ekle&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 

		$menulerSorgusu=$DBConnection->prepare("SELECT * FROM menuler ORDER BY urunturu ASC");
		$menulerSorgusu->execute();
		$menusayisi=$menulerSorgusu->rowCount();
		$menuler=$menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($menusayisi>0){
			foreach ($menuler as $menu) {
				$menuid=$menu["id"];
				$menuadi=$menu["menuadi"];
				$menuurunturu=$menu["urunturu"];
				$urunsayisi=$menu["urunsayisi"];
				?>
				<tr height="50"  valign="top">
					<td colspan="2" width="750" align="right" valign="top" style="border-bottom: solid 1px #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="left" width="600"  style="color: black;" ><b><?php echo DonusumleriGeriDondur($menuurunturu); ?></b></td>
						</tr>
						<tr height="30">
							<td align="left" width="600"  style="color: black;" ><?php echo DonusumleriGeriDondur($menuadi); ?> (<?php echo $urunsayisi; ?>) </td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=62&id=<?php echo DonusumleriGeriDondur($menuid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
							<td align="left" width="70"><a href="index.php?SKD=0&SKI=62&id=<?php echo DonusumleriGeriDondur($menuid); ?>"  style="color:  #0000FF; text-decoration: none;">Güncelle</a></td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=66&id=<?php echo DonusumleriGeriDondur($menuid); ?>"><img style="margin-top: 5px;" src="../Resimler/Sil20x20.png" border="0"></a></td>
							<td align="left" width="30"><a href="index.php?SKD=0&SKI=66&id=<?php echo DonusumleriGeriDondur($menuid); ?>" style="color:  #FF0000; text-decoration: none;">Sil</a></td>
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
				<td colspan="" style="border: solid 1px #F50000; color: black;">Menü kaydı bulunmamaktadır. </td>
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