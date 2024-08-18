<?php
require_once("header.php");

$user = (int) $_POST['user'];
$bloqueado = (int) $_POST['bloqueado'];

if($key==null){
	die("0: Logueate");
}

if($key==$user){
	die("0: No puedes blockearte a ti mismo");
}

if(empty($user)){
	die("0: El campo <b>ID del usuario</b> es requerido para esta operacion");
}

function desbloquear($array,$ele) {
	$new_array = array();
	foreach ($array as $key => $value){
		if ($key!=$ele) {
			$new_array[$key] = $value;
		}
	}
	
	return $new_array;
}

function buscar_block($array,$ele) {
	foreach ($array as $key => $value){
		if($key==$ele) {
			return true;
		}
	}
}

$sqlb = mysql_query("SELECT id,nick FROM usuarios WHERE id = '{$user}'");
$char = mysql_fetch_array($sqlb);
mysql_free_result($sqlb);

if($bloqueado) {
	$bloqueados[$char[id]] = array("id" => $char[id],"nick" => $char[nick]);
	$mensaje = '1: El usuario fue bloqueado satisfactoriamente';
} else {
	$bloqueados = desbloquear($bloqueados,$char[id]);
	$mensaje = '1: El usuario fue desbloqueado satisfactoriamente';
}

mysql_query("UPDATE usuarios SET bloqueados='".serialize($bloqueados)."' WHERE id = '$key' ");

die(''.$mensaje.'');
?>
