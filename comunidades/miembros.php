<?php
include("../header.php");
$comid = no_injection($_GET['comid']);
$key = no_injection($_GET['key']);
$ajax = no_injection($_GET['ajax']);
$section = no_injection($_GET['section']);
$p = no_injection($_GET['p']);

if($section=='susp'){
	$cadena="m.estado='1'";
}else{
	$cadena="m.estado='0'";
}

if(empty($comid) or empty($key)){
	die("0: Faltan Datos");
}
$sqluserz=$db->query("SELECT m.*,us.id,us.nick,us.avatar FROM c_miembros m
LEFT JOIN usuarios us ON us.id=m.iduser
WHERE {$cadena} and m.idcomunity='{$comid}'");
if(!$db->num_rows($sqluserz)){
	die('1: <div class="emptyData">No hay mimebros suspendidos en la comunidad</div>');
}
echo'1: ';
while($rowu=$db->fetch_array($sqluserz))
{
	echo'<ul id="userid_'.$rowu['id'].'">
<li class="resultBox">
<h4><a href="/perfil/'.$rowu['nick'].'" title="Perfil de '.$rowu['nick'].'">'.$rowu['nick'].'</a></h4>
<div class="floatL avatarBox">
<a href="/perfil/'.$rowu['nick'].'" title="Perfil de '.$rowu['nick'].'">
<img width="75px" height="75px" src="'.$rowu['avatar'].'" onerror="error_avatar(this)" /></a></div>
<div class="floatL infoBox">
<ul><li>Rango: <strong>Posteador</strong></li>
<li>Sexo: <strong>Masculino</strong></li>
<li><a href="/mensajes/a/arielito23" title="Enviar mensaje">Enviar mensaje</a></li>
<li><a href="javascript:com.admin_users(\''.$rowu['id'].'\');" title="Administrar al usuario">Administrar</a></li>
</ul></div></li></ul>';
}
$db->free_result($sqluserz);
?>