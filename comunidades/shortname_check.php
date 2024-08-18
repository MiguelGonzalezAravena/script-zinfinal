<?php
include("../header.php");
$shortname = no_injection($_POST['shortname']);

if(empty($shortname)){
	die("0: El campo <b>Nombre corto</b> es requerido para esta operacion");
}
if(strlen($shortname) < 5 or strlen($shortname) > 32){
	die("0: El nombre debe tener entre 5 y 32 caracteres");
}
if (is_numeric($shortname)){
	die("0: El nombre tiene que tener por lo menos una letra");
}
if (!ereg("^([a-zA-Z0-9\-]{1,32})$", $shortname)){
	die("0: Solo se permiten letras, n&uacute;meros y guiones medios (-)");
}

$pmico = mysql_query("SELECT shortname FROM c_comunidades WHERE shortname='{$shortname}'");

if(mysql_num_rows($pmico)){
	die("0: El nombre seleccionado ya est&aacute; en uso");
}

die("1: El nombre est&aacute; disponible! :)");

?>