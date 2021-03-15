	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="50" bgcolor="#FF9900">
			<td align="left"><h2 style="color: white;">&nbsp;SIK SORULAN SORULAR (SSS)</h2></td>
		</tr>
		<tr height="50">
			<td align="left" style="border-bottom: 1px solid #CCCCCC;">En çok merak edilen soruları burada cevaplandırdık.</td>
		</tr>
		<tr height="50">
			<td align="left">Aradığınızı bulamadınız mı? Yeni bir soru sormak için <a class="sonucsayfalari" href="iletisim">buraya tıklayınız.</a></td>
		</tr>
		<tr>
			<td><?php 
			$sorularsorgusu=$DBConnection->prepare("SELECT * FROM sorular");
			$sorularsorgusu->execute();
			$sorusayisi=$sorularsorgusu->rowCount();
			$sorular=$sorularsorgusu->fetchAll(PDO::FETCH_ASSOC);
			if($sorusayisi>0){
				foreach ($sorular as $soru) {
					?>
					<div>
						<div  class="sorualani" id="<?php echo $soru["id"]; ?>" onClick="$.cevapgoster(<?php echo $soru["id"]; ?>)"> <?php echo  "+ " . $soru["soru"]; ?></div>
						<div class="cevapalani" style="display: none;"><?php echo $soru["cevap"]; ?></div>
					</div>
					<?php 
				}
			}
			?>
		</td>
	</tr>
</table>