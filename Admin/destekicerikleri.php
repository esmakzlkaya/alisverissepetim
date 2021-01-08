<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="760" height="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td align="left" width="560" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>&nbsp;DESTEK İÇERİKLERİ</h3></td>
			<td align="right" width="200" bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><a href="index.php?SKD=0&SKI=46" style="text-decoration: none; color: white;"> + Sık Sorulan Sorular Ekle&nbsp;</a></td>
		</tr>
		<tr height="1">
			<td colspan="2" style="border: solid 1px #F50000;"></td>
		</tr>
		<?php 

		$sorularSorgusu=$DBConnection->prepare("SELECT * FROM sorular");
		$sorularSorgusu->execute();
		$sorusayisi=$sorularSorgusu->rowCount();
		$sorukayitlari=$sorularSorgusu->fetchAll(PDO::FETCH_ASSOC);
		if($sorusayisi>0){
			foreach ($sorukayitlari as $sorular) {
				$soruid=$sorular["id"];
				$soru=$sorular["soru"];
				$cevap=$sorular["cevap"];
				?>
				<tr height="50"  valign="top">
					<td colspan="2" width="750" align="right" valign="top" style="border-bottom: 1px solid #FF0000;"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td width="590">
								<div>
									<div  class="sorualani" id="<?php echo $soruid; ?>" onClick="$.cevapgoster(<?php echo $soruid; ?>)"> <?php echo  "+ " . $soru; ?></div>
									<div class="cevapalani" style="display: none;"><?php echo $cevap; ?></div>
								</div>
							</td>
							<td align="left" width="10">&nbsp;</td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=50&id=<?php echo DonusumleriGeriDondur($soruid); ?>"><img style="margin-top: 5px;" src="../Resimler/Guncelleme20x20.png" border="0"></a></td>
							<td align="left" width="70"><a href="index.php?SKD=0&SKI=50&id=<?php echo DonusumleriGeriDondur($soruid); ?>"  style="color:  #0000FF; text-decoration: none;">Güncelle</a></td>
							<td align="left" width="25"><a href="index.php?SKD=0&SKI=54&id=<?php echo DonusumleriGeriDondur($soruid); ?>"><img style="margin-top: 5px;" src="../Resimler/Sil20x20.png" border="0"></a></td>
							<td align="left" width="30"><a href="index.php?SKD=0&SKI=54&id=<?php echo DonusumleriGeriDondur($soruid); ?>" style="color:  #FF0000; text-decoration: none;">Sil</a></td>
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
				<td colspan="" style="border: solid 1px #F50000; color: black;">Sık Sorulan Soru bulunmamaktadır. </td>
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