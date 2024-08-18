<?php
require_once("header.php");

$id_post = (int) $_POST['postid'];
$id_user = (int) $_POST['key'];

if ($id_user==null or $id_post==null){
	die("0: Faltan Datos");
}

if ($key!=$id_user){
	die("0: Error");
}

$sqlf = mysql_query("SELECT idfa FROM favoritos WHERE id_post = '{$id_post}' AND id_usuario = '{$id_user}' ");

if (mysql_num_rows($sqlf)){
	die("0: Ese favorito ya lo tienes");
}

mysql_query("INSERT INTO favoritos (id_post, id_usuario, guardado) VALUES ('$id_post', '$id_user', unix_timestamp())");
$ult_id = mysql_insert_id($con);

mysql_query("Update posts Set favoritos=favoritos+1 WHERE postid='{$id_post}' ");

die("1: Agregado a favoritos!");

?>
