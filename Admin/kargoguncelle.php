<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenkargoid=Guvenlik($_GET["id"]);
	}else{
		$gelenkargoid="";
	}
	$kargolarsorgusu=$DBConnection->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
	$kargolarsorgusu->execute([$gelenkargoid]);
	$sayisi=$kargolarsorgusu->rowCount();
	$kargo=$kargolarsorgusu->fetch(PDO::FETCH_ASSOC);
	if ($sayisi>0) { 
		?>
		<form method="post" action="index.php?SKD=0&SKI=27&id=<?php echo $gelenkargoid; ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>KARGO FİRMASI GÜNCELLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center" bgcolor="#001d26" valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: white;">Kargo Firması Adı</td>
								<td width="20" style="color: white;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="kargofirmasiadi" value="<?php echo $kargo["kargofirmasiadi"]; ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td style="color: white;">Kargo Firması Logosu</td>
								<td style="color: white;">:</td>
								<td><input class="inputAlanlari" type="file" name="kargofirmasilogosu" ></td>
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