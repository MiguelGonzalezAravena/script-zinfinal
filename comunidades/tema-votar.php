<?php
include("../header.php");
$key = $_SESSION['id'];
$voto = no_injection($_POST['voto']);
$temaid = no_injection($_POST['temaid']);

if($key==null){
	die("0: Tenes que estar logueado para realizar esta operacion");
}
die("1");
?>