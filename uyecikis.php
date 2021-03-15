<?php 
unset($_SESSION["kullanici"]);
session_destroy();
header("Location:anasayfa");
exit();
?>