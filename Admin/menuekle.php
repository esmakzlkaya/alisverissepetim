<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<form method="post" action="index.php?SKD=0&SKI=59" enctype="multipart/form-data">
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
							<td width="500" valign="top">
								<select name="urunturu" class="selectAlanlari">
									<option value="">Lütfen Seçiniz</option>
									<option value="Çocuk Ayakkabısı">Çocuk Ayakkabısı</option>		
									<option value="Erkek Ayakkabısı">Erkek Ayakkabısı</option>		
									<option value="Kadın Ayakkabısı">Kadın Ayakkabısı</option>		
								</select>
							</td>
						</tr>
						<tr height="50" style="border: solid 1px white;">
							<td style="color: black;"><b>Menü Adı</b></td>
							<td style="color: black;">:</td>
							<td><input class="inputAlanlari" type="text" name="menuadi"></td>
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