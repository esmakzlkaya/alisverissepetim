<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height="50" bgcolor="#FF9900">
		<td align="left"><h2 style="color: white;">&nbsp;BANKA HESAPLARIMIZ</h2></td>
	</tr>
	<tr height="50">
		<td align="left" style="border-bottom: 1px solid #CCCCCC;">Ödemeleriniz için çalışmakta olduğumuz tüm banka bilgileri aşağıdadır.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table width="1065" cellspacing="0" cellpadding="0" border="0" align="center">
				<tr>
					<?php 
					$bankalarsorgusu=$DBConnection->prepare("SELECT * FROM bankahesaplari");
					$bankalarsorgusu->execute();
					$bankasayisi=$bankalarsorgusu->rowCount();
					$banka=$bankalarsorgusu->fetchAll(PDO::FETCH_ASSOC);

					$dongusayisi=1;
					$sutunadedi=3;

					foreach ($banka as $b) {
						$bankaadi=$b["bankaadi"];
						$konumsehir=$b["konumsehir"];
						$konumulke=$b["konumulke"];
						$subeadi=$b["subeadi"];
						$subekodu=$b["subekodu"];
						$parabirimi=$b["parabirimi"];
						$hesapsahibi=$b["hesapsahibi"];
						$hesapno=$b["hesapno"];
						$ibanno=$b["ibanno"];
						$bankalogo=$b["bankalogo"];

						?>
						<td width="348" style="">
							<table width="348" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
								<tr height="40">
									<td colspan="4" align="center"><img src="Resimler/<?php echo $bankalogo; ?>"></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="75"><b>Banka Adı</b></td>
									<td width="10">:</td>
									<td width="253"><?php echo $bankaadi; ?></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="80"><b>Konum</b></td>
									<td width="10">:</td>
									<td width="253"><?php echo $konumsehir ." / ". $konumulke; ?></td>
								</tr>
								<tr height="25" >
									<td width="5"><b>&nbsp;</td>
									<td width="80"><b>Şube</td></td>
									<td width="10">:</td>
									<td width="253"><?php echo $subeadi ." / ". $subekodu; ?></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="80"><b>Birim</b></td>
									<td width="10">:</td>
									<td width="253"><?php echo $parabirimi; ?></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="80"><b>Hesap Adı</b></td>
									<td width="10">:</td>
									<td width="253"><?php echo $hesapsahibi; ?></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="80"><b>Hesap No</b></td>
									<td width="10">:</td>
									<td width="253"><?php echo $hesapno; ?></td>
								</tr>
								<tr height="25">
									<td width="5">&nbsp;</td>
									<td width="80"><b>IBAN No</b></td>
									<td width="10">:</td>
									<td width="253" style="font-size: 14px;"><?php echo ibanbicimlendir($ibanno); ?></td>
								</tr>
							</table>
						</td>
						<?php 
						if($dongusayisi<$sutunadedi){
							?>
							<td width="10">&nbsp;</td>	
							<?php
						}

						$dongusayisi++;

						if($dongusayisi>$sutunadedi){
							echo "</tr><tr>";
							$dongusayisi=1;
						}
					}
					?>
				</tr>
			</table>
		</td>
	</tr>
</table>