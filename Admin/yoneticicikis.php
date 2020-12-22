<?php 
unset($_SESSION["yonetici"]);
session_destroy();
header("Location:index.php");
exit();
?>