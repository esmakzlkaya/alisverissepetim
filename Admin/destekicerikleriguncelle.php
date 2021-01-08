<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelensoruid=Guvenlik($_GET["id"]);
	}else{
		$gelensoruid="";
	}
	$sorularSorgusu=$DBConnection->prepare("SELECT * FROM sorular WHERE id=? LIMIT 1");
	$sorularSorgusu->execute([$gelensoruid]);
	$sorusayisi=$sorularSorgusu->rowCount();
	$sorukayitlari=$sorularSorgusu->fetch(PDO::FETCH_ASSOC);
	if($sorusayisi>0){
		?>
		<form method="post" action="index.php?SKD=0&SKI=51&id=<?php echo $gelensoruid; ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>SIK SORULAN SORULAR GÜNCELLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center"  valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Soru</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="soru" value="<?php echo $sorukayitlari["soru"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Cevap</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><textarea name="cevap" class="selectAlanlari"><?php echo $sorukayitlari["cevap"]; ?></textarea></td>
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