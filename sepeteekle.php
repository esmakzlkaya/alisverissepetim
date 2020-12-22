<?php
if(isset($_SESSION["kullanici"])){

	if (isset($_GET["id"])) {
		$gelenurunid=Guvenlik($_GET["id"]);
	}else{
		$gelenurunid="";
	}
	if (isset($_POST["varyantselect"])) {
		$gelenvaryantid=Guvenlik($_POST["varyantselect"]);
	}else{
		$gelenvaryantid="";
	}
	if (($gelenurunid!="") and ($gelenvaryantid!="")) {

		$sepetkontrolsorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? ORDER BY id DESC LIMIT 1");
		$sepetkontrolsorgusu->execute([$id]);
		$sepetkontrolsayisi=$sepetkontrolsorgusu->rowCount();
	if ($sepetkontrolsayisi>0) { //sepet zaten var id'sini güncelle
	$urunsepetkontrolsorgusu=$DBConnection->prepare("SELECT * FROM sepet WHERE uyeid=? AND urunid=? AND varyantid=? LIMIT 1");
	$urunsepetkontrolsorgusu->execute([$id,$gelenurunid,$gelenvaryantid]);
	$urunsepetkontrolsayisi=$urunsepetkontrolsorgusu->rowCount();
	$urunsepetkaydi=$urunsepetkontrolsorgusu->fetch(PDO::FETCH_ASSOC);

	if ($urunsepetkontrolsayisi>0) { 
		$sepetid=$urunsepetkaydi["id"];
		$urunadediguncellemesorgusu=$DBConnection->prepare("UPDATE sepet SET urunadedi=urunadedi+1 WHERE id=? AND uyeid=? AND urunid=? LIMIT 1");
		$urunadediguncellemesorgusu->execute([$sepetid,$id,$gelenurunid]);
		$sepetnosayisi=$urunadediguncellemesorgusu->rowCount();

		if ($sepetnosayisi>0) {
			header("Location:index.php?SK=92");
			exit();
		}else{
			header("Location:index.php?SK=91");
			exit();
		}
	}else{
		$uruneklemesorgusu=$DBConnection->prepare("INSERT INTO sepet (uyeid,urunid,varyantid,urunadedi) VALUES (?,?,?,?)"); //,adresid,varyantid,urunadedi,kargofirmasisecimi,odemesecimi,taksitsecimi   ?,?,?,?,?,?,?,  
		$uruneklemesorgusu->execute([$id,$gelenurunid,$gelenvaryantid,1]);
		$urunsayisi=$uruneklemesorgusu->rowCount();
		$sonurununiddegeri=$DBConnection->lastInsertId();
		if ($urunsayisi>0) {
			//sepet no güncelleme
			$sepetnoguncelle=$DBConnection->prepare("UPDATE sepet SET sepetnumarasi=? WHERE uyeid=?");
			$sepetnoguncelle->execute([$sonurununiddegeri, $id]);
			$sepetnoguncellesayisi=$sepetnoguncelle->rowCount();

			if ($sepetnoguncellesayisi>0) {
				header("Location:index.php?SK=92");
				exit();
			}else{
				header("Location:index.php?SK=91");
				exit();
			}
		}else{
			header("Location:index.php?SK=91");
			exit();
		}
	}
	}else{ // sepet yeni oluşturulacak
		$uruneklemesorgusu=$DBConnection->prepare("INSERT INTO sepet (uyeid, urunid, varyantid,urunadedi) VALUES (?,?,?,?)"); //,adresid,varyantid,urunadedi,kargofirmasisecimi,odemesecimi,taksitsecimi   ?,?,?,?,?,?,?,  
		$uruneklemesorgusu->execute([$id,$gelenurunid,$gelenvaryantid,1]);
		$urunsayisi=$uruneklemesorgusu->rowCount();
		$sonurununiddegeri=$DBConnection->lastInsertId();
		if ($urunsayisi>0) {
			//sepet no güncelleme
			$sepetnoguncelle=$DBConnection->prepare("UPDATE sepet SET sepetnumarasi=? WHERE uyeid=?");
			$sepetnoguncelle->execute([$sonurununiddegeri, $id]);
			$sepetnoguncellesayisi=$sepetnoguncelle->rowCount();
			if ($sepetnoguncellesayisi>0) {
				header("Location:index.php?SK=92");
				exit();
			}else{
				header("Location:index.php");
				exit();
			}
		}else{
			header("Location:index.php?SK=91");
			exit();
		}
	}
}else{
	header("Location:index.php");
	exit();
}
}else{
	header("Location:index.php?SK=31");
	exit();
}
?>