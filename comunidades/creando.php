<?php
include("../header.php");
cabecera_normal();

$nombre = no_injection($_POST['nombre']);
$shortname = no_injection($_POST['shortname']);
$imagen = no_injection($_POST['imagen']);
$pais = no_injection($_POST['pais']);
$categoria = no_injection($_POST['categoria']);
$subcategoria = no_injection($_POST['subcategoria']);
$descripcion = no_injection($_POST['descripcion']);
$tags = no_injection($_POST['tags']);
$privada = no_injection($_POST['privada']);
$tipo_val = no_injection($_POST['tipo_val']);
$rango_default = no_injection($_POST['rango_default']);

if(!$grupo_perm['crear_c']){
	fatal_error('Tu rango no te permite crear comunidades');
}
if(empty($shortname)){
	fatal_error('El campo <b>Nombre corto</b> es requerido para esta operacion','Volver','history.go(-1)');
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
if(empty($key)){
	fatal_error('Tenes que Estar Logueado');
}
if(strlen($shortname) < 5 or strlen($shortname) > 32){
	fatal_error('El nombre debe tener entre 5 y 32 caracteres');
}
if (is_numeric($shortname)){
	fatal_error('El nombre tiene que tener por lo menos una letra');
}
if (!ereg("^([a-zA-Z0-9\-]{1,32})$", $shortname)){
	fatal_error('Solo se permiten letras, n&uacute;meros y guiones medios (-)');
}

$q = mysql_query("SELECT shortname FROM c_comunidades WHERE shortname='{$shortname}'");

if(mysql_num_rows($q)){
	fatal_error('Error: Tu IP y Usuario han sido Guardados.');//Susto XD
}

mysql_query("INSERT INTO c_comunidades (nombre, shortname, imagen, pais, categoria, subcategoria, descripcion, tags, privada, oficial, tipo_val, rango_default, fecha, creadorid, numte, numm) VALUES ('{$nombre}','{$shortname}','{$imagen}','{$pais}','{$categoria}','{$subcategoria}','{$descripcion}','{$tags}','{$privada}',0,'{$tipo_val}','{$rango_default}', unix_timestamp(),'{$key}','0','1')");
$comid = mysql_insert_id();
mysql_query("INSERT INTO c_miembros (iduser, idcomunity, rangoco, fechaco) VALUES('{$key}','{$comid}','5', unix_timestamp())");

echo'
<div id="cuerpocontainer">
<div class="container400" style="margin: 10px auto 0 auto;">
<div class="box_title">
<div class="box_txt show_error">YEAH!</div>
<div class="box_rrs"><div class="box_rss"></div></div>
</div>
<div class="box_cuerpo"  align="center">
<br />El mundo entero est&aacute; ante la presencia de una nueva comunidad. Felicitaciones!<br /><br /><br />
<input type="button" class="mBtn btnOk" style="font-size:13px" value="Ir a mi nueva comunidad!" title="Ir a mi nueva comunidad!" onclick="location.href=\'/comunidades/'.$_POST['shortname'].'/\'">			<br />
</div>
</div>	
<br />
<br />
<br />
<br />';

pie();
?>