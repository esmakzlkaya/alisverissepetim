<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="250" align="left">
			<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
				<?php 
				$menusorgusu=$DBConnection->prepare("SELECT * FROM menuler WHERE urunturu = 'Erkek Ayakkabısı' ORDER BY menuadi ASC");
				$menusorgusu->execute();
				$menusayisi=$menusorgusu->rowCount();
				$menuler=$menusorgusu->fetchAll(PDO::FETCH_ASSOC);
				if ($menusayisi>0) {
					foreach ($menuler as $menu) {
						?>
						<tr>
							<td align="left"><?php echo $menu["menuadi"]; ?></td>
						</tr>
						<?php
					}
				}
				?>
				
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Banner</td>
				</tr>
			</table>
		</td>
		<td align="left" >&nbsp; </td>
		<td align="left">Ürünler</td>
	</tr>
</table>