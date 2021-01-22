<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenmenuid=Guvenlik($_GET["id"]);
	}else{
		$gelenmenuid="";
	}
	$menulersorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
	$menulersorgusu->execute([$gelenmenuid]);
	$menusayisi=$menulersorgusu->rowCount();
	$menuler=$menulersorgusu->fetch(PDO::FETCH_ASSOC);
	if ($menusayisi>0) { 
		?>
		<form method="post" action="index.php?SKD=0&SKI=63&id=<?php echo $gelenmenuid; ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YENİ MENÜ EKLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center"  valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Ürün Türü</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" style="color: black;"><?php echo $menuler["urunturu"]; ?></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Menü Adı</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="menuadi" value="<?php echo $menuler["menuadi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td></td>
								<td></td>
								<td width="500" valign="top"><input class="yesilbuton" type="submit" value="GÜNCELLE"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
		<?php 
	}
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>