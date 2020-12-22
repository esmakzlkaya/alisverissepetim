<?php 
if (empty($_SESSION["yonetici"])) {
	?><form method="post" action="index.php?SKD=2">
		<table width="500" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #000000; padding: 20px; ">
			<tr height="40">
				<td align="left" width="200">Yönetici Kullanıcı Adı</td>
				<td align="left" width="50">:</td>
				<td align="left" width="200"><input type="text" name="yoneticikullaniciadi" class="inputAlanlari"></td>
				<td width="20">&nbsp;</td>
			</tr>
			<tr height="40">
				<td align="left" width="150">Yönetici Şifresi</td>
				<td align="left" width="50">:</td>
				<td align="left" width="260"><input type="password" name="yoneticisifre" class="inputAlanlari"></td>
				<td width="20">&nbsp;</td>
			</tr>
			<tr height="40">
				<td align="left" width="150">&nbsp;</td>
				<td align="left" width="50">&nbsp;</td>
				<td align="left" width="260"><input type="submit" value="Giriş Yap" class="yesilbuton"></td>
				<td width="20">&nbsp;</td>
			</tr>
		</table>
		</form><?php 
	}
	$DBConnection=null;
	?>