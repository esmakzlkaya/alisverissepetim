<?php 

if (isset($_GET["aktivasyonKodu"])){
	$gelenaktivasyonkodu=Guvenlik($_GET["aktivasyonKodu"]);
}else{
	$gelenaktivasyonkodu="";
}
if (isset($_GET["mail"])){
	$gelenmail=Guvenlik($_GET["mail"]);
}else{
	$gelenmail="";
}

if(($gelenmail!="") and ($gelenaktivasyonkodu!="")){
	$kontrolSorgusu=$DBConnection->prepare("SELECT * FROM uyeler WHERE mail= ? AND aktivasyonKodu=? LIMIT 1");
	$kontrolSorgusu->execute([$gelenmail,$gelenaktivasyonkodu]);
	$sayisi=$kontrolSorgusu->rowCount();
	$kullanicikaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
	if ($sayisi>0) {
	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="">
			<td width="500" valign="top">
				<form action="index.php?SK=44&mail=<?php echo $gelenmail; ?>&aktivasyonKodu=<?php echo $gelenaktivasyonkodu; ?>" method="post">
					<table  width="500" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="40">
							<td colspan="2" style="color: #FF9900" ><h3>ŞİFRE SIFIRLAMA</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" style="border-bottom: 1px solid #CCCCCC;" class="">E-mail adresin ve yeni şifren ile şifre sıfırlama işlemini gerçekleştirebilirsin.</td>
						</tr>
						<tr height="30">
							<td valign="" colspan="2">Yeni Şifre (*) </td>
						</tr>
						<tr height="30">
							<td colspan="2" valign=""><input type="password" name="sifre" class="sifremiunuttumInputalanlari"></td>
						</tr>
						<tr height="30">
							<td valign="" colspan="2">Yeni Şifre Tekrar (*) </td>
						</tr>
						<tr height="30">
							<td colspan="2" valign=""><input type="password" name="sifretekrar" class="sifremiunuttumInputalanlari"></td>
						</tr>
						<tr height="30">
							<td style="font-size: 14px;">(*) Boş bırakmayınız.</td>
						</tr>
						<tr height="50">
							<td align="center" colspan="2"><input type="submit" value="ŞİFREMİ SIFIRLA" class="yesilbuton"></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<?php 
}else{
		header("Location:index.php");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}

$DBConnection=null;
?>

