<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenbankaid=Guvenlik($_GET["id"]);
	}else{
		$gelenbankaid="";
	}
	$bankahesapsorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari WHERE id=? LIMIT 1");
	$bankahesapsorgusu->execute([$gelenbankaid]);
	$bankahesabisayisi=$bankahesapsorgusu->rowCount();
	$hesaplar=$bankahesapsorgusu->fetch(PDO::FETCH_ASSOC);
	if ($bankahesabisayisi>0) { 
		?>
		<form method="post" action="index.php?SKD=0&SKI=15&id=<?php echo $gelenbankaid; ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>BANKA HESABI GÜNCELLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center" bgcolor="#001d26" valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Banka Adı</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="bankaadi" value="<?php echo $hesaplar["bankaadi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td style="color: white;">Banka Logosu</td>
								<td style="color: white;">:</td>
								<td><input class="inputAlanlari" type="file" name="bankalogo" ></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Şehir</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="sehir" value="<?php echo $hesaplar["konumsehir"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Ülke</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="ulke" value="<?php echo $hesaplar["konumulke"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Şube Adı</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="subeadi" value="<?php echo $hesaplar["subeadi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Şube Kodu</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="subekodu" value="<?php echo $hesaplar["subekodu"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Para Birimi</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="parabirimi" value="<?php echo $hesaplar["parabirimi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Hesap Sahibi</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="hesapsahibi" value="<?php echo $hesaplar["hesapsahibi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Hesap No</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="hesapno" value="<?php echo $hesaplar["hesapno"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">IBAN No</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="ibanno" value="<?php echo $hesaplar["ibanno"]; ?>"></td>
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
	}else{
		header("Location:index.php?SKD=0&SKI=17");
		exit();	
	}
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>