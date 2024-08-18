<?php
	include("includes/configuracion.php");
	$sql = "UPDATE usuarios SET puntosdar='1000' WHERE rango='255'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='300' WHERE rango='100'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='27' WHERE rango='14'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='22' WHERE rango='13'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='17' WHERE rango='10'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='12' WHERE rango='0'";
	mysql_query($sql);
	$sql = "UPDATE usuarios SET puntosdar='10' WHERE rango='12'";
	mysql_query($sql);
	mysql_close($con); 
?>