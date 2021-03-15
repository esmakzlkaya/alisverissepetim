<?php
if(isset($_SESSION["kullanici"])){
	if (isset($_GET["urunid"])) {
		$gelenurunid=Guvenlik($_GET["urunid"]);
	}else{
		$gelenurunid="";
	}
	if ($gelenurunid!="") {
		?>
		<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3"><hr/></td>
			</tr>
			<tr>
				<td colspan="3">
					<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim" style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
							<td width="10">&nbsp;</td>
							<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-adresler" style="text-decoration: none; color: black;">Adresler</a></td>
							<td width="10">&nbsp;</td>
							<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-favoriler" style="text-decoration: none; color: black;">Favoriler</a></td>
							<td width="10">&nbsp;</td>
							<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-yorumlar" style="text-decoration: none; color: black;">Yorumlar</a></td>
							<td width="10">&nbsp;</td>
							<td width="203" style="border: 1px solid #CCCCCC; padding: 10px 0px; text-align: center; font-weight: bold;"><a href="hesabim-siparisler" style="text-decoration: none; color: black;">Siparişler</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3"><hr/></td>
			</tr>
			<form method="post" action="index.php?SK=76&urunid=<?php echo $gelenurunid; ?>">
				<tr height="">
					<td width="1065" valign="top">
						<table  width="620" align="left" border="0" cellspacing="0" cellpadding="0">
							<tr height="30">
								<td colspan="" style="color: #FF9900" ><h3>HESABIM > YORUM YAP</h3></td>
							</tr>
							<tr height="30">
								<td colspan="" style="border-bottom: 1px solid #CCCCCC;" class="">Lütfen bizi yorumla. </td>
							</tr>
							<tr height="30">
								<td colspan="" valign="bottom">Puanlama (*) </td>
							</tr>
							<tr>
								<td valign="top" align="left">
									<table width="360" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="64"><img src="Resimler/YildizBirDolu.png"></td>
											<td width="10">&nbsp;</td>
											<td width="64"><img src="Resimler/YildizIkiDolu.png"></td>
											<td width="10">&nbsp;</td>
											<td width="64"><img src="Resimler/YildizUCDolu.png"></td>
											<td width="10">&nbsp;</td>
											<td width="64"><img src="Resimler/YildizDortDolu.png"></td>
											<td width="10">&nbsp;</td>
											<td width="64"><img src="Resimler/YildizBesDolu.png"></td>
										</tr>
										<tr>
											<td width="64" align="center"><input type="radio" name="puan" value="1"> </td>
											<td width="10">&nbsp;</td>
											<td width="64" align="center"><input type="radio" name="puan" value="2"> </td>
											<td width="10">&nbsp;</td>
											<td width="64" align="center"><input type="radio" name="puan" value="3"> </td>
											<td width="10">&nbsp;</td>
											<td width="64" align="center"><input type="radio" name="puan" value="4"> </td>
											<td width="10">&nbsp;</td>
											<td width="64" align="center"><input type="radio" name="puan" value="5"> </td>
										</tr>
									</table>
								</td>
								<tr height="30">
									<td colspan="" valign="bottom">Yorum Metni (*) </td>
								</tr>
								<tr>
									<td valign="top"><textarea name="yorum" class="Yorumtextareaalanlari" value="İsteğe bağlı"></textarea></td>
								</tr>
								<tr>
									<td align="center"><input type="submit" name="Yorumu Gönder" class="bilgilerimiguncellebutonu"></td>
								</tr>
							</tr>
						</table>
					</td>
				</tr>
			</form>
		</table>
		<?php 
	}else{
		header("Location:index.php?SK=78");
		exit();	
	}
}else{
	header("Location:anasayfa");
	exit();
} 
?>