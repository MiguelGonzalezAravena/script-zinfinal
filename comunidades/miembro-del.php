<?php
include("../header.php");
$comid = no_injection($_POST['comid']);

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}
if(empty($comid)){
	die("0: El campo <b>ID de la Comunidad</b> es requerido para esta operacion");
}

$pmico = mysql_query("SELECT cm.* FROM c_miembros cm WHERE cm.iduser='$key' and cm.idcomunity='$comid'");
if(!mysql_num_rows($pmico)){
	die("0: Para salir de esta comunidad Tienes que Ser Miembro.");
}
$rangomd = mysql_query("SELECT iduser,idcomunity FROM c_miembros WHERE iduser='$key' and idcomunity='$comid' and rangoco='5'");
$rango = mysql_num_rows($rangomd);

if($rango){
$sqladmins = mysql_query("SELECT idcomunity,rangoco FROM c_miembros WHERE idcomunity='$comid' and rangoco='5'");
$nadmins = mysql_num_rows($sqladmins);
if($nadmins<=1){
	die("1: Sos el unico administrador de la comunidad.<br>Para poder darte de baja tenes que asignar otro administrador");
}
}

mysql_query("DELETE FROM c_miembros WHERE idcomunity='$comid' and iduser='$key'");
mysql_query("UPDATE c_comunidades SET numm=numm-'1' WHERE idco='$comid'");

die("2: Fuiste eliminado correctamente de la comunidad");
?>