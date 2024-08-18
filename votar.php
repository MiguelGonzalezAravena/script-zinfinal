<?php
require_once("header.php");
$id_user = $_SESSION['id'];

$puntos = (int) $_POST["puntos"];
$postid = (int) $_POST["postid"];
$x = $_POST["x"];

if($key==null){
	die("0: No pod&eacute;s votar si no est&aacute;s autentificado");
}

if(empty($puntos)){
	die("0: El campo <b>Puntos</b> es requerido para esta operacion");
}

if(empty($x)){
	die("0: El campo <b>C&oacute;digo de Seguridad</b> es requerido para esta operacion");
}

if(empty($postid)){
	die("0: El campo <b>ID del Post</b> es requerido para esta operacion");
}

if($global_user['rango']=='11'){
	die("0: No pod&eacute;s votar si sos Novato");
}

$ppp = mysql_query("SELECT id_autor FROM posts WHERE postid = '{$postid}' ");
$row = mysql_fetch_array($ppp);
$receptor = $row['id_autor'];

if (!mysql_num_rows($ppp)){
	die("0: No Existe este Post");
}

if ($key==$receptor){
	die("0: No puedes votar tus propios posts");
}

$pver = mysql_query("SELECT postid FROM puntos WHERE iduser = '{$id_user}' AND postid = '{$postid}' ");

if (mysql_num_rows($pver)){
	die("0: No es posible votar a un mismo post mas de una vez");
}

if($puntos > $global_user['puntosdar']){
	die("0: No Tienes Suficientes Puntos");
}

mysql_query("UPDATE usuarios SET puntos=puntos+'{$puntos}' WHERE id='{$receptor}' ");
mysql_query("UPDATE usuarios SET puntosdar=puntosdar-'{$puntos}' WHERE id='{$key}' ");
mysql_query("UPDATE posts SET puntos=puntos+'{$puntos}' WHERE postid='{$postid}' ");
mysql_query("INSERT INTO puntos (postid, iduser, puntos, fecha) VALUES ('$postid','$key','$puntos', unix_timestamp())");

die("1: Puntos agregados!");

?>