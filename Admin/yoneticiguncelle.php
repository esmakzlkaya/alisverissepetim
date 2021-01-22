<?php
if (isset($_SESSION["yonetici"])) {
	if (isset($_GET["id"])) {
		$gelenyoneticiid=Guvenlik($_GET["id"]);
	}else{
		$gelenyoneticiid="";
	}
	$yoneticilerSorgusu=$DBConnection->prepare("SELECT * FROM yoneticiler WHERE id=? LIMIT 1");
	$yoneticilerSorgusu->execute([$gelenyoneticiid]);
	$yoneticisayisi=$yoneticilerSorgusu->rowCount();
	$yoneticiler=$yoneticilerSorgusu->fetch(PDO::FETCH_ASSOC);
	if($yoneticisayisi>0){
		?>
		<form method="post" action="index.php?SKD=0&SKI=76&id=<?php echo $gelenyoneticiid; ?>" enctype="multipart/form-data">
			<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="70">
					<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YÖNETİCİ KAYDI GÜNCELLE</h3></td>
				</tr>
				<tr height="1">
					<td style="border: solid 1px #F50000;"></td>
				</tr>
				<tr>
					<td width="750" align="center"  valign="top">
						<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>İsim soyisim</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" class="inputAlanlari" name="isimsoyisim" value="<?php echo $yoneticiler["isimsoyisim"] ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Kullanıcı Adı</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" ><?php echo $yoneticiler["kullaniciadi"] ?></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>E posta</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" name="mail" class="inputAlanlari" value="<?php echo $yoneticiler["mail"] ?>"></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Şifre **</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" name="sifre" class="inputAlanlari"></td>
							</tr>
							<tr>
								<td colspan="3" style="font-size: 14px;"><b> ** Şifre güncellemek istemiyorsanız lütfen bu alanı boş geçiniz. </b></td>
							</tr>
							<tr height="50" style="border: solid 1px white;">
								<td width="230" style="color: black;"><b>Telefon</b></td>
								<td width="20" style="color: black;" > : </td>
								<td width="500" valign="top"><input type="text" name="telno" class="inputAlanlari" maxlength="11" value="<?php echo $yoneticiler["telno"] ?>"></td>
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