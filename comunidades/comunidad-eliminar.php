<?php
include("../header.php");
$key = $_SESSION['id'];
$comid = no_injection($_POST['comid']);

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}
if(empty($comid)){
	die("0: El campo <b>ID de la Comunidad</b> es requerido para esta operacion");
}
$q1=$db->query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND rangoco='5' and estado='0'");
if(!$db->num_rows($q1)){
	die("0: Tenes que ser parte de la Comunidad o No Tienes Rango");
}

$sqlfin=$db->query("DELETE FROM c_miembros WHERE idcomunity='$comid' and iduser='$key'");
$db->query("UPDATE c_comunidades SET numm=numm-'1' WHERE idco='$comid'");
die("2: Fuiste eliminado correctamente de la comunidad");
?>