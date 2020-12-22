<?php 
if(isset($_POST["kargotakipno"])){
	$gelentakipno=RakamliIfadeler(Guvenlik($_POST["kargotakipno"]));
}else{
	$gelentakipno="";
}
if($gelentakipno!=""){
	header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $gelentakipno);
	exit();
}else{
	header("Location:index.php?SK=14");
	exit();
}
?>