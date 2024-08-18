<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();

if($_SESSION['user']==null){
fatal_error('No pod&eacute;s ver el historial de moderaci&oacute;n si no est&aacute;s autentificado');
}

echo'<div id="cuerpocontainer">
<div id="resultados" style="width:100%">
	<table class="linksList">
		<thead>
			<tr>
				<th>Post</th>

				<th>Acci&oacute;n</th>
				<th>Moderador</th>
				<th>Causa</th>
			</tr>
		</thead>
	<tbody>
		<tbody>';
$sqlhist = mysql_query("SELECT pe.accion, pe.id_modera, pe.id_post, pe.causa, pe.fecha, po.titulo, po.id_autor, po.categoria, us.id as idu , us.nick as moderador, ue.id AS autor_id, ue.nick, ue.rango AS a_rango, c.id_categoria, c.link_categoria, c.nom_categoria
		FROM (posts_eliminados AS pe, posts AS po, usuarios AS us, categorias AS c, usuarios AS ue)
		WHERE pe.id_modera=us.id
		AND po.id_autor=ue.id
		AND pe.id_post=po.postid
		AND po.categoria=c.id_categoria
		ORDER BY pe.id desc
		LIMIT 20");
		
while($mod = mysql_fetch_array($sqlhist)){
	
echo'
	<tr>
		<td style="text-align: left;">'.$mod['titulo'].'<br />
			Por <a href="/perfil/'.$mod['autor_id'].'">'.$mod['nick'].'</a>
		</td>
		<td>'.historial($mod['accion']).'</td>
		<td>
		<a href="/perfil/'.$mod['moderador'].'">'.$mod['moderador'].'</a>
		</td>
		<td>'.($mod['causa']=='' ? '-' : ''.$mod['causa'].'').'</td>
	</tr>
	<tr>';
}
mysql_free_result($sqlhist);
echo'
</tbody>
</tbody>
</table>
</div>';
pie();
?>