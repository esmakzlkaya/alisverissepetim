<?php
if (isset($_SESSION["yonetici"])) {
	?>

	Dashboard / Pano Sayfası

	<?php 
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>