<?php
include("../header.php");
$key = $_SESSION['id'];
$comid = (int)$_POST['comid'];
$aceptar = no_injection($_POST['aceptar']);

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}
if(empty($comid)){
	die("0: El campo <b>ID de la Comunidad</b> es requerido para esta operacion");
}

$pmico = mysql_query("SELECT * FROM c_suspendidos WHERE idusersu='{$key}' and idcomusu='{$comid}'");
if(mysql_num_rows($pmico)){
	die("0: No podes ingresar a esta comunidad ya que fuiste suspendido de la misma");
}

$pmico = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$key}' and idcomunity='{$comid}'");
if(mysql_num_rows($pmico)){
	die("0: Ya estas en esta comunidad deja de pasarte de listo");
}

$comunisql = mysql_query("SELECT idco,rango_default FROM c_comunidades WHERE idco='{$comid}'");
$co = mysql_fetch_array($comunisql);
mysql_free_result($comunisql);

$rango = $co['rango_default'];
$rango_default = rangocomunidad($rango);

if($aceptar == "1"){
mysql_query("INSERT INTO c_miembros (iduser, idcomunity, rangoco, fechaco) VALUES('$key','$comid','$rango', unix_timestamp())");
mysql_query("UPDATE c_comunidades SET numm=numm+'1' WHERE idco='{$comid}'");
die("1: Felicitaciones!<br> Te has unido a la comunidad");
}
echo'3: &iquest;Realmende deseas ser miembro de esta comunidad?<br>Tu rango dentro de la comunidad ser&aacute;: <b>'.$rango_default.'</b>';
?>