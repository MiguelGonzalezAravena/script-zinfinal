<?php
include("header.php");
cabecera_normal();

$razon = (int) $_POST['razon'];
$cuerpo = $_POST['cuerpo'];
$id = (int) $_POST['id'];

if($user==null){
fatal_error('No pod&eacute;s hacer una denuncia si no est&aacute;s autentificado');
}

if(empty($razon) or empty($cuerpo) or empty($id)){
	fatal_error('Faltan datos');
}

mysql_query("INSERT INTO denuncias (razon,cuerpo,postid,denunciante,fecha) VALUES ('$razon','$cuerpo','$id','$key',NOW())");

fatal_error('La denuncia fue enviada','Ir a p&aacute;gina principal','location.href=\'/home.php\'','Muchas gracias');

pie();
?>