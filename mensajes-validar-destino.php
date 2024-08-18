<?php
require_once("header.php");
$nick = no_injection($_GET["nick"]);
$user  = $_SESSION['user'];

if(empty($nick)){
	die('Falta Datos');
}

if($nick == $user) {
	die('ERROR2');
}

$sqlu = mysql_query("SELECT nick FROM usuarios WHERE nick = '$nick' ");

if(mysql_num_rows($sqlu)){
	die('OK');
} else {
	die('ERROR1');
}

?>