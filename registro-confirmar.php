<?php
include('header.php');
$titulo = $descripcion;
cabecera_normal();

$id_session = no_injection($_GET["k"]);

$sqlve = mysql_query("SELECT id_zinfinal FROM usuarios Where id_zinfinal = '{$id_session}'");

if(!mysql_num_rows($sqlve)){
	fatal_error('La informaci&oacute;n no es correcta');
}

mysql_query("Update usuarios Set activacion='1', avatar='/images/avatar.gif' Where id_zinfinal = '{$id_session}'");

fatal_error('Tu cuenta fue habilitada. A disfrutar');

?>