<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=35" enctype="multipart/form-data">
		<table width="760" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr height="70">
				<td bgcolor="#001d26" align="center" height="100" style="color: #FF0000;"><h3>YENİ BANNER EKLE</h3></td>
			</tr>
			<tr height="1">
				<td style="border: solid 1px #F50000;"></td>
			</tr>
			<tr>
				<td width="750" align="center"  valign="top">
					<table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>Banner Alan Adı</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top">
								<select name="banneralani" class="selectAlanlari">
									<option value="">Lütfen Seçiniz</option>
									<option value="Anasayfa">Anasayfa</option>		
									<option value="Menü Altı">Menü Altı</option>		
									<option value="Ürün Detay">Ürün Detay</option>		
								</select>
							</td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Banner Resmi</b></td>
							<td style="color: black;">:</td>
							<td><input class="inputAlanlari" type="file" name="bannerresmi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td width="230" style="color: black;"><b>Banner Adı</b></td>
							<td width="20" style="color: black;" > : </td>
							<td width="500" valign="top"><input type="text" class="inputAlanlari" name="banneradi"></td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td></td>
							<td></td>
							<td width="500" valign="top"><input class="yesilbuton" type="submit" value="EKLE"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>