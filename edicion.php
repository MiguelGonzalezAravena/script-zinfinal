<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();
$id = (int) $_POST["id"];
$titulo = no_injection(xss($_POST["titulo"]));
$cuerpo = no_injection(xss($_POST["cuerpo"]));
$tags = no_injection(guardartags($_POST['tags']));
$categoria = (int)$_POST["categoria"];

$privado = no_injection($_POST["privado"]);
$sticky = no_injection($_POST["sticky"]);
$patrocinado = no_injection($_POST["patrocinado"]);
$coments = no_injection($_POST["coments"]);

if(empty($key)){
	fatal_error('Tenes que Estar Logueado');
}

if(empty($titulo)){
	fatal_error('El campo <b>Titulo</b> es requerido para esta operacion');
}

if(empty($cuerpo)){
	fatal_error('El campo <b>Cuerpo</b> es requerido para esta operacion');
}

if(empty($tags)){
	fatal_error('El campo <b>Tags</b> es requerido para esta operacion');
}

$nuntags = explode(',',$tags);

if(count($nuntags)<4){
	fatal_error('Tienes que ingresar por lo menos <b>4</b> tags');
}

if($categoria==NULL){
	fatal_error('El campo <b>Categoria</b> es requerido para esta operacion');
}

$dbpost = mysql_query("SELECT id_autor FROM posts where postid = '{$id}' ");

if(!mysql_num_rows($dbpost)){
	fatal_error('No Existe este Posts');
}

$postz = mysql_fetch_array($dbpost);
mysql_free_result($dbpost);

if($postz['id_autor']!=$key xor $grupo_perm['editar_p']==0){
	fatal_error('Este post no te pertenece y no puedes editarlo!');
}


if($global_user['rango']==11) {
	$privado = 0;
	$sticky = 0;
	$patrocinado = 0;
	$coments = 0;
}

if($global_user['rango']>11 and $global_user['rango']<50) {
	$sticky = 0;
	$patrocinado = 0;
	$coments = 0;
}

$privado = !empty($privado);
$sticky = !empty($sticky);
$patrocinado = !empty($patrocinado);
$coments = !empty($coments);

mysql_query("UPDATE posts SET titulo='$titulo', contenido='$cuerpo', privado=" . ($privado ? '1' : '0') . ", coments=" . ($coments ? '1' : '0') . ", tags='$tags', categoria='$categoria', sticky=" . ($sticky ? '1' : '0') . ", patrocinado=" . ($patrocinado ? '1' : '0') . " WHERE postid = '$id'");

fatal_error('El post ha sido modificado satisfactoriamente! IMPORTANTE: Los cambios ser&aacute;n aplicados en menos de 1 minuto.','Ir a p&aacute;gina principal','location.href=\'/home.php\'','Hecho!');
?>