<?php
include("header.php");
cabecera_normal();

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

if(count(explode(',',$tags)) < 4){
	fatal_error('Tienes que ingresar por lo menos <b>4</b> tags');
}

if($categoria==NULL){
	fatal_error('El campo <b>Categoria</b> es requerido para esta operacion');
}

if($global_user['rango']==11) {
	$privado = 0;
	$sticky = 0;
	$patrocinado = 0;
	$coments = 0;
}

if($global_user['rango'] > 11 and $global_user['rango']<50) {
	$sticky = 0;
	$patrocinado = 0;
	$coments = 0;
}

$privado = !empty($privado);
$sticky = !empty($sticky);
$patrocinado = !empty($patrocinado);
$coments = !empty($coments);

$minuto = time() - (60);
$sqlflood = mysql_query("SELECT id 
FROM usuarios 
WHERE ultimaaccion2 
BETWEEN '$minuto' AND unix_timestamp() AND id='{$key}'");

if(mysql_num_rows($sqlflood)){
	fatal_error('No podes realizar tantas acciones en tan poco tiempo. Vuelve a intentarlo en unos instantes','Volver','history.go(-1)','Anti-Flood!');
}

mysql_query("INSERT INTO posts (estado, id_autor, titulo, contenido, creado, privado, coments, comentarios, tags, categoria, sticky, patrocinado) 
VALUES (0, '$key', '$titulo', '$cuerpo', unix_timestamp(), " . ($privado ? '1' : '0') . ", " . ($coments ? '1' : '0') . ", 0, '$tags', '$categoria', " . ($sticky ? '1' : '0') . ", " . ($patrocinado ? '1' : '0') . ")");

$idp = mysql_insert_id();

mysql_query("UPDATE usuarios SET numposts=numposts+'1',ultimaaccion2=unix_timestamp() WHERE id='{$key}'");

$sqlnp = mysql_query("SELECT p.postid, p.titulo, c.link_categoria FROM (posts AS p, categorias AS c) WHERE c.id_categoria = '{$categoria}' AND p.postid = '{$idp}' ");
$datos = mysql_fetch_array($sqlnp);
mysql_free_result($sqlnp);

$seguidores->db_seguidores('post');
$seguidores->notificar('friend-post');

fatal_error('El post <b>'.$datos['titulo'].'</b> fue agregado!','Acceder al post',"location.href='/posts/{$datos['link_categoria']}/{$datos['postid']}/".corregir($datos['titulo']).".html'",'YEAH!');

?>