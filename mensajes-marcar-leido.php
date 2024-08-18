<?php
require_once("header.php");
$titulo	= $descripcion;
cabecera_normal();

$leido = $_GET["leido"];
$ids = (int) $_GET["ids"];

if($leido==null or empty($ids)){
	die('Falta Datos');
}

$sqlm = mysql_query("select id_emisor,id_receptor,leido_emisor,leido_receptor from mensajes where id_mensaje = '{$ids}' and (id_receptor = '{$key}' or id_emisor = '{$key}') ");

if(!mysql_num_rows($sqlm)){
	fatal_error('Mensaje no encontrado');
}

$leerm = mysql_fetch_array($sqlm);
mysql_free_result($sqlm);

if($key == $leerm['id_receptor']) {
	mysql_query("Update mensajes Set leido_receptor = '{$leido}' where id_mensaje='{$ids}' and id_receptor = '{$key}'");
}

if($key == $leerm['id_emisor']) {
	mysql_query("Update mensajes Set leido_emisor = '{$leido}' where id_mensaje='{$ids}' and id_emisor = '{$key}'");
}

fatal_error('Cambios aceptados','Centro de mensajes','location.href=\'/mensajes/\'','Confirmaci&oacute;n');
?>