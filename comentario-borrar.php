<?php
require_once("header.php");

$comid = (int)$_POST['comid'];
$postid = (int) $_POST['postid'];

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}

$q2 = mysql_query("SELECT id,id_post,id_autor 
FROM comentarios 
WHERE id = '{$comid}' AND id_post = '{$postid}'");

if(!mysql_num_rows($q2)){
	die("0: No Existe el Comentario");
}

$co = mysql_fetch_array($q2);
mysql_free_result($q2);

$autorc = $co['id_autor'];

if($autorc!=$key xor $grupo_perm['elimcomen_p']==0){
	die("0: Este Comentario no te pertenese");
}

mysql_query("DELETE FROM comentarios WHERE id = '{$comid}' AND id_post = '{$postid}'");
mysql_query("UPDATE usuarios SET numcomentarios=numcomentarios-'1' WHERE id='{$autorc}'");
mysql_query("UPDATE posts SET comentarios=comentarios-'1' WHERE id='{$postid}'");

die("1");
?>