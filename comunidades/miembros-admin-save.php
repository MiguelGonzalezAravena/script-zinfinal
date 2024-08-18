<?php
include("../header.php");
$admin = $_SESSION['user'];
$key = $_SESSION['id'];
$userid = no_injection($_POST['userid']);
$comid = no_injection($_POST['comid']);
$action = no_injection($_POST['action']);
$causa = no_injection($_POST['causa']);
$dias = no_injection($_POST['dias']);
$new_rango = no_injection($_POST['new_rango']);

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}

if(empty($userid) or empty($comid)){
	die("0: Faltan Datos");
}

$q1 = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND rangoco='5' ");
if(!mysql_num_rows($q1)){
	die("0: Tenes que ser parte de la Comunidad o No Tienes Rango");
}

$q2 = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$userid}' AND idcomunity='{$comid}'");
if(!mysql_num_rows($q2)){
	die("0: El usuario seleccionado no pertenece a la comunidad");
}

if($action=='rango'){
mysql_query("UPDATE c_miembros SET rangoco='{$new_rango}' WHERE iduser='{$userid}' AND idcomunity='{$comid}'");
mysql_query("INSERT INTO c_suspendidos (idusersu, idcomusu, causasu, diasu, porsu, accionsu, fechasu) VALUES('$userid','$comid','$causa','$dias','$admin','2',unix_timestamp())");
die("1: El rango fue modificado correctamente");
}

if($action=='suspender'){
mysql_query("INSERT INTO c_suspendidos (idusersu, idcomusu, causasu, diasu, porsu, accionsu, fechasu) VALUES('$userid','$comid','$causa','$dias','$admin','1',unix_timestamp())");
mysql_query("UPDATE c_miembros SET estado='1' WHERE iduser='{$userid}' AND idcomunity='{$comid}'");
die("1: El usuario fue suspendido satisfactoriamente");
}

if($action=='rehabilitar'){
mysql_query("INSERT INTO c_suspendidos (idusersu, idcomusu, causasu, diasu, porsu, accionsu, fechasu) VALUES('$userid','$comid','$causa','$dias','$admin','3',unix_timestamp())");
mysql_query("UPDATE c_miembros SET estado='0' WHERE iduser='{$userid}' AND idcomunity='{$comid}'");
die("1: El usuario fue rehabilitado satisfactoriamente");
}
?>