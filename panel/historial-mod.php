<?php
if (!defined('ZinFinal'))
	die('Intentado de Hack');

function Historial_modMain() {
	
	$subSeccion = array(
	    'borrar-post' => 'borrar_post',
	    'ver-post' => 'ver_post',
	);
	
	if (!empty($subSeccion[@$_GET['ss']])) {
		$subSeccion[$_GET['ss']]();
	} else {
		Main();
	}
}

function Main() {
	global $key,$user,$images;
	
	$dbposts = mysql_query("SELECT pe.*,p.titulo 
	FROM posts_eliminados 
	LEFT JOIN posts ON pe.postid = p.postid 
	ORDER BY pe.fecha DESC");
	
	echo '<center><strong>LISTA DE MODERACION</strong></center><br><br>';
	
	while($suspendido = mysql_fetch_array($dbposts)) {
		echo '<div style="color:black; background-color: #dfdfdf;">Usuario: <b>'.$suspendido['nicksu'].'</b> '.($suspendido['accion'] ? 'Desuspendido' : 'Suspendido').' por: <b>'.$suspendido['nickmod'].'</b>
	<br>Razon: <b style="color:'.($suspendido['accion'] ? 'green' : 'red').';">'.$suspendido['causa'].'</b> fecha: <b>'.$suspendido['fecha'].'</b></div><br>';
	}
	
	mysql_free_result($dbposts);
	
	echo '';
}

function borrar_post() {
	global $key,$user,$images;
	echo '';
}

function ver_post() {
	global $key,$user,$images;
	echo '';
}
?>