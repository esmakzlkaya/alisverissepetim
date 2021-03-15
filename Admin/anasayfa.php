<?php
if (isset($_SESSION["yonetici"])) {
	?>
	<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="100%">
			<td width="300" align="center" bgcolor="#001d26" valign="top">
				<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="70">
						<td align="center" height="100"><a href="index.php?SKD=0&SKI=0"><img src="../Resimler/logo.png" border="0"></a></td>
					</tr>
					<tr height="1">
						<td align="center" bgcolor="#FF0000" style="line-height: 1px; font-size: 1px;">&nbsp;</td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=106">SİPARİŞLER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=116">HAVALE BİLDİRİMLERİ</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=94">ÜRÜNLER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=82">ÜYELER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=90">YORUMLAR</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=1">SİTE AYARLARI</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=57">MENÜLER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=9">BANKA HESAP AYARLARI</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=5">SÖZLEŞMELER VE METİNLER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=21">KARGO AYARLARI</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=33">BANNER AYARLARI</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=45">DESTEK İÇERİKLERİ</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=0&SKI=69">YÖNETİCİLER</a></td>
					</tr>
					<tr height="50">
						<td class="anamenusayfalari" align="center" bgcolor="#f50000" style="color: black;"><a href="index.php?SKD=4">ÇIKIŞ YAP</a></td>
					</tr>
				</table>
			</td>
			<td width="5" align="center" bgcolor="#FF0000" valign="top">&nbsp;</td>
			<td width="760" align="center" valign="top">
				<?php 
				if((!$sayfakoduic) or ($sayfakoduic=="") or ($sayfakoduic==0)){
					include($sayfaic[0]);
				}else{
					include($sayfaic[$sayfakoduic]);
				}
				?>
			</td>
		</tr>
	</table>
	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>