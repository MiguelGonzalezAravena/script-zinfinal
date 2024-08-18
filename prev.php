<?php
include("header.php");

$id	= no_injection($_GET['id']);
$previo	= mysql_query("SELECT p.postid, p.categoria, p.titulo, c.link_categoria FROM (posts as p, categorias AS c) WHERE p.postid='$id'-1 AND p.categoria=c.id_categoria");
$resultado = mysql_fetch_array($previo);

Header("Location: ".$url."/posts/".$resultado['link_categoria']."/".$resultado['postid']."/".corregir($resultado['titulo']).".html");
?>