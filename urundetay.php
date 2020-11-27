<?php
if(isset($_GET["id"])){
	$gelenurunid		=	RakamliIfadeler(Guvenlik($_GET["id"]));

	$urundetaysorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=? AND durumu=? LIMIT 1");
	$urundetaysorgusu->execute([$gelenurunid,1]);
	$urundetaysayisi=$urundetaysorgusu->rowCount();
	$urundetaykaydi = $urundetaysorgusu->fetch(PDO::FETCH_ASSOC);
	if ($urundetaysayisi>0) {
		$gelenurunturu=$urundetaykaydi["urunturu"];
		if ($gelenurunturu=="Erkek Ayakkabısı") {
			$urunklasoradi="Erkek";
		}elseif ($gelenurunturu=="Kadın Ayakkabısı") {
			$urunklasoradi="Kadin";
		}else{
			$urunklasoradi="Cocuk";
		}
		?>
		<table width="1065" align="center" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="350" valign="top"><table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" style="border: 1px solid #CCCCCC;"><img id="buyukresim" src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimbir"]; ?>" width="330" height="440" border="0"></td>
					</tr>
					<tr>
						<td style="font-size: 5px;">&nbsp;</td>
					</tr>
					<tr>
						<td><table width="350" align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimbir"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimbir"]; ?>');"></td>
								<td width="10">&nbsp;</td>
								<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimiki"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimiki"]; ?>');"></td>
								<td width="10">&nbsp;</td>
								<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimuc"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimuc"]; ?>');"></td>
								<td width="10">&nbsp;</td>
								<td width="78" style="border:1px solid #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $urunklasoradi; ?>/<?php echo $urundetaykaydi["resimdort"]; ?>" width="78" height="104" border="0" onClick="$.urundetayresmidegistir('<?php echo $urunklasoradi; ?>', '<?php echo $urundetaykaydi["resimdort"]; ?>');"></td>
							</tr>
						</table></td>
					</tr>
					<tr>&nbsp;</tr>
					<tr>
						<td><table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50">
								<td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
							</tr>
							<?php
							$BannerSorgusu		=	$DBConnection->prepare("SELECT * FROM bannerlar WHERE banneralani = 'Ürün Detay' ORDER BY gosterimsayisi ASC LIMIT 1");
							$BannerSorgusu->execute();
							$BannerSayisi		=	$BannerSorgusu->rowCount();
							$BannerKaydi		=	$BannerSorgusu->fetch(PDO::FETCH_ASSOC);
							?>
							<tr height="350">
								<td><img src="Resimler/Banner/<?php echo $BannerKaydi["bannerresmi"]; ?>" border="0"></td>
							</tr>
							<?php
							$BannerGuncelle		=	$DBConnection->prepare("UPDATE bannerlar SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
							$BannerGuncelle->execute([$BannerKaydi["id"]]);
							?>
						</table></td>
					</tr>
				</table></td>
				<td width="10" valign="top">&nbsp;</td>

				<td width="705" valign="top"><table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="50" bgcolor="#F1F1F1">
						<td style="text-align: left; font-size: 18px; font-weight: bold;"><?php echo $urundetaykaydi["urunadi"]; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table>
		<?php
	}else{
		header("Location:index.php");
	}
}else{
	header("Location:index.php");
	exit();
}
?>