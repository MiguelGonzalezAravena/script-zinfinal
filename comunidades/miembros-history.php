<?php
include("../header.php");
$comid = no_injection($_GET['comid']);

if($key==null){
	die("0: Tenes que estar logueado para realizar esta accion");
}

if(empty($comid)){
	die("0: Faltan Datos");
}

$sqluserz = mysql_query("SELECT s.*,us.nick 
FROM c_suspendidos s 
LEFT JOIN usuarios us ON us.id=s.idusersu
WHERE s.idcomusu='{$comid}' ORDER BY s.idsu DESC");

if(!mysql_num_rows($sqluserz)){
	die('1: <div class="emptyData">No hay nada en el historial de administraci&oacute;n</div>');
}

$dia=86400;
echo'1: ';
while($row = mysql_fetch_array($sqluserz))
{
echo'Usuario: <a href="/perfil/'.$row['nick'].'" target="_blank"><strong>'.$row['nick'].'</strong></a> ';
if($row['accionsu']==1){
	echo'suspendido por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}else if($row['accionsu']==2){
	echo'cambiado de <strong style="color:blue;">rango</strong> por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}else if($row['accionsu']==3){
	echo'desuspendido por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}
echo' el d&iacute;a: <strong>'.date('Y-m-d H:m:s',$row['fechasu']).'</strong>';
if($row['accionsu']==1){
	echo'<br />Raz&oacute;n: <strong style="color:red">'.$row['causasu'].'</strong><br />Duraci&oacute;n: ';
	if($row['diasu']==0){
		echo'<strong>Permanente</strong>';
	}else{
		echo'<strong>'.$row['diasu'].' d&iacute;as </strong> Hasta el: <strong>'.date('Y-m-d',$row['fechasu']+$row['diasu']*$dia).'</strong>';
	}
}else if($row['accionsu']==3){
	echo'<br />Raz&oacute;n: <strong style="color:green">'.$row['causasu'].'</strong>';
}
echo'<hr />';
}

mysql_free_result($sqluserz);

?>