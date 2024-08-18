<?php
if (!defined('ZinFinal'))
	die('Intentado de Hack');

function Historial_suspMain() {
	
	$subSeccion = array(
	    'info' => 'info',
	    'suspender' => 'suspender',
	    'desuspender' => 'desuspender',
	);
	
	if (!empty($subSeccion[@$_GET['ss']])) {
		$subSeccion[$_GET['ss']]();
	} else {
		Main();
	}
}

function Main() {
	
	$dbsuspendidos = mysql_query("SELECT * FROM suspendidos ORDER BY fecha DESC");
	
	echo '<center><strong>LISTA DE SUSPENCIONES</strong></center><br><br>';
	
	while($suspendido = mysql_fetch_array($dbsuspendidos)) {
		echo '<div style="color:black; background-color: #dfdfdf;">Usuario: <b>'.$suspendido['nicksu'].'</b> '.($suspendido['accion'] ? 'Desuspendido' : 'Suspendido').' por: <b>'.$suspendido['nickmod'].'</b>
	<br>Razon: <b style="color:'.($suspendido['accion'] ? 'green' : 'red').';">'.$suspendido['causa'].'</b> fecha: <b>'.$suspendido['fecha'].'</b></div><br>';
	}
	
	mysql_free_result($dbsuspendidos);
	
	echo '';
}
?>