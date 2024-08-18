<?php
include("../header.php");
$key = $_SESSION['id'];
$comid = no_injection($_POST['comid']);
$nombre = no_injection($_POST['nombre']);
$shortname = $_POST['shortnamez'];
$imagen = no_injection($_POST['imagen']);
$pais = no_injection($_POST['pais']);
$categoria = no_injection($_POST['categoria']);
$subcategoria = no_injection($_POST['subcategoria']);
$descripcion = no_injection($_POST['descripcion']);
$tags = no_injection($_POST['tags']);
$privada = no_injection($_POST['privada']);
$tipo_val = no_injection($_POST['tipo_val']);
$rango_default = no_injection($_POST['rango_default']);
$titulo=$descripcion;
cabecera_normal();

if(empty($key)){
	fatal_error('Tenes que Estar Logueado');
}

$q = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND rangoco='5' ");

if(!mysql_num_rows($q)){
	fatal_error('Tenes que ser parte de la Comunidad o No Tienes Rango.');
}

if(empty($nombre)){
	fatal_error('El campo <b>Nombre</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($categoria)){
	fatal_error('El campo <b>Categor&#237;a</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($descripcion)){
	fatal_error('El campo <b>Descripcion</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($tags)){
	fatal_error('El campo <b>Tags</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(strlen($imagen) < 7){
	fatal_error('La url ingresada en el campo <b>Imagen para mostrar</b> es incorrecta','Volver','history.go(-1)');
}
if($pais==null){
	fatal_error('El pais seleccionado es incorrecto','Volver','history.go(-1)');
}
mysql_query("UPDATE c_comunidades SET nombre='{$nombre}',imagen='{$imagen}',pais='{$pais}',categoria='{$categoria}',subcategoria='{$subcategoria}',descripcion='{$descripcion}',tags='{$tags}',privada='{$privada}',tipo_val='{$tipo_val}',rango_default='{$rango_default}' WHERE idco='{$comid}'");

fatal_error('La comunidad fue editada exitosamente','Ir a la comunidad',"location.href='/comunidades/$shortname/'");
?>