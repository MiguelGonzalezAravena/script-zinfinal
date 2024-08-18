<?php
include("header.php");
cabecera_normal();
$autor	=	no_injection($_GET['data']);

$dbuser = mysql_query("SELECT id, nick FROM usuarios WHERE nick = '{$autor}' ");

if(mysql_num_rows($dbuser)==0){
	fatal_error('Ese usuario no existe');
}

$comentarios = mysql_query("SELECT c.id AS CID, c.fecha, c.autor, c.id_autor, c.id_post, c.comentario, u.id, u.nick, p.postid, p.id_autor, p.categoria, p.titulo, ca.id_categoria, ca.link_categoria, ca.nom_categoria
					FROM (comentarios AS c, usuarios AS u, posts AS p, categorias AS ca)
					WHERE c.autor='$autor'
					AND c.id_post=p.postid
					AND p.id_autor=u.id
					AND p.categoria=ca.id_categoria
					ORDER BY c.fecha DESC");

echo'<div id="cuerpocontainer">
<div class="container720 floatL">
  <div class="box_title">
    <span class="box_txt ultimos_comentarios_de">&Uacute;ltimos comentarios de '.$autor.'</span>
    <span class="box_rss"></span>
  </div>
  <div class="box_cuerpo">';
  
if(mysql_num_rows($comentarios)==0) {
	echo 'Nada por aqu&iacute;... ';
} else {
	
	while($row = mysql_fetch_array($comentarios)) {
		echo '<span class="categoria '.$row['link_categoria'].'" alt="'.$row['nom_categoria'].'" title="'.$row['nom_categoria'].'"></span> <a href="/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html"><strong>'.$row['titulo'].'</strong></a>
		<br /><div style="clear:both"></div>
		<div class="perfil_comentario">'.date("d.m.Y H:m:s",$row['fecha']).': <a href="/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html#cmnt_'.$row['CID'].'">'.$row['comentario'].'</a></div>
		<hr />';
	}
	mysql_free_result($comentarios);
}

echo'
	</div>
</div>

<div class="container208 floatR">
	<div class="box_title">
    <span class="box_txt publicidad_ultimos_comentarios_de">Publicidad</span>
    <span class="box_rss"></span>
	</div>
	<div class="box_cuerpo">
		<center>'.$publicidadz['160-600'].'</center>
	</div>
</div>
<div style="clear:both"></div>
<hr />
<br clear="left" />
<center>'.$publicidadz['728-90'].'</center>';

pie();
?>
