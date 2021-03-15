<?php
if (isset($_SESSION["yonetici"])) {
	$bekleyensiparislersorgusu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE onaydurumu=? AND kargodurumu=?");
	$bekleyensiparislersorgusu->execute([0,0]);
	$bekleyensiparislersayisi=$bekleyensiparislersorgusu->rowCount();

	$tamamlanansiparislersorgusu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler WHERE onaydurumu=? AND kargodurumu=?");
	$tamamlanansiparislersorgusu->execute([1,1]);
	$tamamlanansiparislersayisi=$tamamlanansiparislersorgusu->rowCount();

	$tümsiparislersorgusu=$DBConnection->prepare("SELECT DISTINCT siparisnumarasi FROM siparisler");
	$tümsiparislersorgusu->execute([1,1]);
	$tümsiparislersayisi=$tümsiparislersorgusu->rowCount();	

	$havalebildirimlerisorgusu=$DBConnection->prepare("SELECT * FROM havalebildirimleri");
	$havalebildirimlerisorgusu->execute([1,1]);
	$havalebildirimlerisayisi=$havalebildirimlerisorgusu->rowCount();

	$bankahesaplarisorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari");
	$bankahesaplarisorgusu->execute([1,1]);
	$bankahesaplarisayisi=$bankahesaplarisorgusu->rowCount();

	$menulersorgusu=$DBConnection->prepare("SELECT * FROM menuler");
	$menulersorgusu->execute([1,1]);
	$menulersayisi=$menulersorgusu->rowCount();

	$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler");
	$urunlersorgusu->execute([1,1]);
	$urunlersayisi=$urunlersorgusu->rowCount();

	$uyelersorgusu=$DBConnection->prepare("SELECT * FROM uyeler");
	$uyelersorgusu->execute([1,1]);
	$uyelersayisi=$uyelersorgusu->rowCount();

	$yoneticilersorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler");
	$yoneticilersorgusu->execute([1,1]);
	$yoneticilersayisi=$yoneticilersorgusu->rowCount();

	$kargolarsorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari");
	$kargolarsorgusu->execute([1,1]);
	$kargolarsayisi=$kargolarsorgusu->rowCount();

	$bannerlarsorgusu=$DBConnection->prepare("SELECT * FROM bannerlar");
	$bannerlarsorgusu->execute([1,1]);
	$bannerlarsayisi=$bannerlarsorgusu->rowCount();

	$yorumlarsorgusu=$DBConnection->prepare("SELECT * FROM yorumlar");
	$yorumlarsorgusu->execute([1,1]);
	$yorumlarsayisi=$yorumlarsorgusu->rowCount();

	$sorularsorgusu=$DBConnection->prepare("SELECT * FROM sorular");
	$sorularsorgusu->execute([1,1]);
	$sorularsayisi=$sorularsorgusu->rowCount();
	?>
	<table width="760" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;KARGO AYARLARI</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style=" padding: 10px;"><table width="750" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Bekleyen Siparişler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $bekleyensiparislersayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Tamamlanan Siparişler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $tamamlanansiparislersayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10"  style="color: black;" >&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Tüm Siparişler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $tümsiparislersayisi; ?></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2" style=" padding: 10px;"><table width="750" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Havale Bildirimleri</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $havalebildirimlerisayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Banka Hesapları</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $bankahesaplarisayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10"  style="color: black;" >&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Menü Sayısı</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $menulersayisi; ?></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2" style=" padding: 10px;"><table width="750" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Ürünler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $urunlersayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Üyeler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $uyelersayisi ?></td>
						</tr>
					</table></td>
					<td align="left" width="10"  style="color: black;" >&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Yöneticiler</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $yoneticilersayisi; ?></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2" style=" padding: 10px;"><table width="750" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Kargolar</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $kargolarsayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Bannerlar</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $bannerlarsayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10"  style="color: black;" >&nbsp;</td>
					<td align="left" width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Yorumlar</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $yorumlarsayisi; ?></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2" style=" padding: 10px;"><table width="750" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="243" style="border: 1px solid #CCCCCC; padding: 10px; color: black;"><table width="243" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr height="30">
							<td align="center" style="font-size: 18px;">Sık Sorulan Sorular</td>
						</tr>
						<tr height="30">
							<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $sorularsayisi; ?></td>
						</tr>
					</table></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243"></td>
					<td align="left" width="10">&nbsp;</td>
					<td align="left" width="243"></td>
				</tr>
			</table></td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>