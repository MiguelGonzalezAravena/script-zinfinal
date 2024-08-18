<?php
include("../header.php");
cabecera_normal();

$comid = no_injection($_POST['comid']);
$titulo = no_injection($_POST['titulo']);
$cuerpo = no_injection($_POST['cuerpo']);
$tags = no_injection(guardartags($_POST['tags']));
$cerrado = no_injection($_POST['cerrado']);
$sticky = no_injection($_POST['sticky']);

if(empty($titulo)){
	fatal_error('El campo <b>Titulo</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($cuerpo)){
	fatal_error('El campo <b>Cuerpo</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($tags)){
	fatal_error('El campo <b>Tags</b> es requerido para esta operacion','Volver','history.go(-1)');
}
if(empty($key)){
	fatal_error('Tenes que Estar Logueado');
}

$q = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND (rangoco='5' OR rangoco='3') ");

if(!mysql_num_rows($q)){
	fatal_error('Tenes que ser parte de la Comunidad o No Tienes Rango.');
}

$comunisql = mysql_query("INSERT INTO c_temas (id_autor, titulo, cuerpo, tagste, calificacion, cerrado, importante, idcomunid, fechate, visitaste) VALUES('$key','$titulo','$cuerpo','$tags','0','$cerrado','$sticky','$comid', unix_timestamp(),'0')");
$idtemf = mysql_insert_id();

mysql_query("UPDATE c_comunidades SET numte=numte+'1' WHERE idco='$comid'");
$shortnamesql = mysql_query("SELECT shortname FROM c_comunidades WHERE idco='$comid'");
$shortnamenew = mysql_fetch_array($shortnamesql);

echo"
<div id='cuerpocontainer'>
<div class='container400' style='margin: 10px auto 0 auto;'>
<div class='box_title'>
<div class='box_txt show_error'>YEAH!</div>
<div class='box_rrs'><div class='box_rss'></div></div></div>
<div class='box_cuerpo'  align='center'>
<br />El nuevo tema fue agregado a la comunidad<br /><br /><br />
<input type='button' class='mBtn btnOk' style='font-size:13px' value='Ir al tema' title='Ir al tema' onclick=\"location.href='/comunidades/{$shortnamenew['shortname']}/{$idtemf}/".corregir($titulo).".html'\">
<br /></div></div><br /><br /><br /><br />
";
pie();
?>