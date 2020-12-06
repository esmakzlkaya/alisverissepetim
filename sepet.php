<?php
if(isset($_SESSION["kullanici"])){

	$stokicinsepettekiurunlersorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ");
	$stokicinsepettekiurunlersorgusu->execute([$id]);
	$stokicinsepeturunlerisayisi=$stokicinsepettekiurunlersorgusu->rowCount();
	$stokicinsepeturunleri=$stokicinsepettekiurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
	if ($stokicinsepeturunlerisayisi>0) {
		foreach ($stokicinsepeturunleri as $stoksepeturun) {
			$stoksepetid=$stoksepeturun["id"];
			$stoksepeturunid=$stoksepeturun["urunid"];
			$stoksepetvaryantid=$stoksepeturun["varyantid"];
			$stoksepeturunadedi=$stoksepeturun["urunadedi"];

			$stokicinvaryantbilgilerisorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
			$stokicinvaryantbilgilerisorgusu->execute([$stoksepetvaryantid]);
			$stokicinvaryantbilgileri=$stokicinvaryantbilgilerisorgusu->fetch(PDO::FETCH_ASSOC);

			$stokvaryantstokadedi=$stokicinvaryantbilgileri["stokadedi"];
			if ($stokvaryantstokadedi==0) {
				$silsorgusu=$DBConnection->prepare("DELETE FROM sepet WHERE id=? AND uyeid=? LIMIT 1");
				$silsorgusu->execute([$stoksepetid,$id]);

			}
			elseif ($stoksepeturunadedi>$stokvaryantstokadedi) {
				$sepetguncellemesorgusu=$DBConnection->prepare("UPDATE sepet SET urunadedi=? WHERE id=? AND uyeid=? LIMIT 1");
				$sepetguncellemesorgusu->execute([$stokvaryantstokadedi,$stoksepetid,$id]);
			}
		}
	}



	?>
	<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="">
			<td width="800" valign="top"><form action="index.php?SK=xxxx" method="post"><table  width="800" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="40">
					<td  style="color: #FF9900" ><h3>ALIŞVERİŞ SEPETİ</h3></td>
				</tr>
				<tr height="30">
					<td  style="border-bottom: 1px solid #CCCCCC;" class="">Sepetine eklediğin tüm ürünlere burada, bir sonraki adım ödeme işlemi. </td>
				</tr>
				<?php
				$sepettekitoplamurunsayisi=0;
				$sepettekitoplamurunfiyati=0;
				$sepeturunlerisorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ORDER BY id DESC");
				$sepeturunlerisorgusu->execute([$id]);
				$sepeturunsayisi=$sepeturunlerisorgusu->rowCount();
				$sepeturunlerkaydi=$sepeturunlerisorgusu->fetchAll(PDO::FETCH_ASSOC);
				if ($sepeturunsayisi>0) {
					foreach ($sepeturunlerkaydi as $sepeturunkaydi) {
						
						$sepetid=DonusumleriGeriDondur($sepeturunkaydi["id"]);
						$sepeturunid=DonusumleriGeriDondur($sepeturunkaydi["urunid"]);
						$sepetvaryantid=DonusumleriGeriDondur($sepeturunkaydi["varyantid"]);
						$sepeturunadedi=DonusumleriGeriDondur($sepeturunkaydi["urunadedi"]);

						$urunlersorgusu=$DBConnection->prepare("SELECT * FROM urunler WHERE id=?  LIMIT 1");
						$urunlersorgusu->execute([$sepeturunid]);
						$urunlersayisi=$urunlersorgusu->rowCount();
						$urunlerkaydi=$urunlersorgusu->fetch(PDO::FETCH_ASSOC);

						$urunlerurunturu=DonusumleriGeriDondur($urunlerkaydi["urunturu"]);
						$urunlerurunadi=DonusumleriGeriDondur($urunlerkaydi["urunadi"]);
						$urunlerurunresmi=DonusumleriGeriDondur($urunlerkaydi["resimbir"]);
						$urunlerurunparabirimi=DonusumleriGeriDondur($urunlerkaydi["parabirimi"]);
						$urunlerurunvaryantbasligi=DonusumleriGeriDondur($urunlerkaydi["varyantbasligi"]);
						$urunlerurunfiyati=DonusumleriGeriDondur($urunlerkaydi["urunfiyati"]);
						$urunlerurunkargoucreti=DonusumleriGeriDondur($urunlerkaydi["kargoucreti"]);

						$varyantsorgusu=$DBConnection->prepare("SELECT * FROM urunvaryantlari WHERE urunid=? and id=? LIMIT 1");
						$varyantsorgusu->execute([$sepeturunid,$sepetvaryantid]);
						$varyantsayisi=$varyantsorgusu->rowCount();
						$varyantkaydi=$varyantsorgusu->fetch(PDO::FETCH_ASSOC);

						$varyantlarvaryantadi=DonusumleriGeriDondur($varyantkaydi["varyantadi"]);
						$varyantlarvaryantstokadedi=DonusumleriGeriDondur($varyantkaydi["stokadedi"]);

						if ($urunlerurunturu=="Erkek Ayakkabısı") {
							$klasoradi="Erkek";
						}elseif ($urunlerurunturu=="Kadın Ayakkabısı") {
							$klasoradi="Kadin";
						}else{
							$klasoradi="Cocuk";
						}

						if ($urunlerurunparabirimi=="USD") {
							$urunfiyatihesapla=($urunlerurunfiyati*$dolarkuru);
						}elseif ($urunlerurunparabirimi=="EUR") {
							$urunfiyatihesapla=($urunlerurunfiyati*$eurokuru);
						}else{
							$urunfiyatihesapla=$urunlerurunfiyati;
						}

						$sepettekitoplamurunsayisi=($sepettekitoplamurunsayisi+$sepeturunadedi);
						$sepettekitoplamurunfiyati=($sepettekitoplamurunfiyati+($urunfiyatihesapla*$sepeturunadedi));

						?>
						<tr height="30">
							<td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">

								<tr>
									<td width="80" align="left" style="border-bottom: 1px solid #CCCCCC;"><a href="index.php?SK=82&id=<?php echo $sepeturunid; ?>"><img  width="60" height="80" src="Resimler/UrunResimleri/<?php echo $klasoradi; ?>/<?php echo $urunlerurunresmi; ?>"></a></td>
									<td width="40" align="left" style="border-bottom: 1px solid #CCCCCC;"><a href="index.php?SK=93&id=<?php echo $sepetid; ?>"><img style="margin-top: 5px;" src="Resimler/SilDaireli20x20.png"></a></td>
									<td width="590" align="left" style="border-bottom: 1px solid #CCCCCC;"><?php echo $urunlerurunadi;?><br/> <?php echo $urunlerurunvaryantbasligi; echo " : ".$varyantlarvaryantadi; ?></td>
									<td width="90" align="left" style="border-bottom: 1px solid #CCCCCC;"><table table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center" width="30"><?php if($sepeturunadedi>1){?> <a href="index.php?SK=94&id=<?php echo $sepetid; ?>"><img  style=" margin-top: 5px;" border="0" src="Resimler/AzaltDaireli20x20.png"></a> <?php }else{?>&nbsp;<?php } ?></td>
											<td align="center" width="30"><?php echo $sepeturunadedi;?></td>
											<td align="center" width="30"><a href="index.php?SK=95&id=<?php echo $sepetid; ?>"><img  style="margin-top: 5px;" border="0" src="Resimler/ArttirDaireli20x20.png"></a></td>
										</tr>
									</table></td>
									<td width="100" align="right" style="border-bottom: 1px solid #CCCCCC;"><?php echo fiyatbicimlendir($sepeturunadedi*$urunfiyatihesapla); ?> TL </td>
								</table></td></tr>
								<?php
							}
						}else{
							?>
							<tr height="30">
								<td >Sepetinizde ürün bulunmamaktadır. </td>
							</tr>
							<?php
						}
						?>
					</table></form></td>

					<td width="15">&nbsp;</td>
					<td width="250"  valign="top"><table width="250" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr height="40">
							<td colspan="2" style="color: #FF9900" ><h3>SİPARİŞ ÖZETİ</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" style="border-bottom: 1px solid #CCCCCC;">Sepette toplam <b style="color: red;"><?php echo $sepettekitoplamurunsayisi; ?></b> ürün var</td>
						</tr>

						<tr>
							<td valign="top ">Toplam Tutar : </td>
							<td valign="top" style="font-size: 25px;"><?php echo fiyatbicimlendir($sepettekitoplamurunfiyati); ?> TL </td>
						</tr>
						
						<tr>
							<td colspan="2"><div class="sepeticidevametvealisverisitamamlabutonu"><a href="index.php?SK=96" style="color: white; font-size: 18px; font-weight: bold; text-decoration: none;">
								<img style="margin-top: 5px;" src="Resimler/SepetBeyaz21x20.png" border="0" > DEVAM ET </a></div></td>
							</tr>

						</table></td>
					</tr>
				</table>
				<?php 
			} 
			else{
				header("Location:index.php");
				exit();
			} 
			?>