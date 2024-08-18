<?php
include("header.php");
cabecera_normal();

if($key==null){
fatal_error('Para acceder a tus favoritos necesit&aacute;s autentificarte');
}

$sqlf = mysql_query("SELECT f.guardado,p.postid,p.titulo,p.creado,p.puntos,p.visitas,c.link_categoria 
FROM favoritos as f 
LEFT JOIN posts as p ON p.postid = f.id_post 
LEFT JOIN categorias as c ON c.id_categoria = p.categoria 
WHERE f.id_usuario = '$key' ORDER BY guardado DESC");


if(!mysql_num_rows($sqlf)){
	echo'<div class="comunidades">
	<div class="emptyData">No agregaste ningun post a favoritos todavia</div>
</div>';
pie();
exit;
}

$categorias	= mysql_query("SELECT DISTINCT c.id_categoria, c.nom_categoria, COUNT(id_categoria) as number 
FROM (posts AS p, favoritos as f, categorias AS c) 
WHERE c.id_categoria = p.categoria 
AND f.id_usuario = '$key' 
AND f.id_post=p.postid 
GROUP BY c.nom_categoria ORDER BY c.nom_categoria");

echo '<div id="cuerpocontainer">
<div class="comunidades">
<div id="izquierda" style="width:170px">
	<div class="categoriaList">
		<ul>
			<li id="cat_-1" style="margin-bottom: 5px;background:#555555; -moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px"><a href="#" onclick="filtro_favs(\'categorias\', \'-1\'); return false;" style="color:#FFF"><strong>Categor&iacute;as</strong></a></li>';

while($cat = mysql_fetch_array($categorias)) {
	echo '<li id="cat_'.$cat['id_categoria'].'"><a href="#" onclick="filtro_favs(\'categorias\', \''.$cat['id_categoria'].'\'); return false;">'.$cat['nom_categoria'].'</a> ('.$cat['number'].')</li>';
}

mysql_free_result($categorias);

echo '
	</div>
</div>

<div id="centroDerecha">
	<div id="resultados">
		<table class="linksList">
			<thead>
				<tr>
					<th></th>
					<th style="text-align:left;width:350px;overflow:hidden;"><a href="#" onclick="filtro_favs(\'orden\', \'titulo\', this); return false;">T&iacute;tulo</a></th>

					<th><a href="#" onclick="filtro_favs(\'orden\', \'creado\', this); return false;">Creado</a></th>
					<th><a href="#" onclick="filtro_favs(\'orden\', \'guardado\', this); return false;" class="here">Guardado</a></th>
					<th><a href="#" onclick="filtro_favs(\'orden\', \'puntos\', this); return false;">Puntos</a></th>
					<th><a href="#" onclick="filtro_favs(\'orden\', \'visitas\', this); return false;">Visitas</a></th>
					<th></th>
				</tr>
			</thead>

			<tbody>';

			while($favs = mysql_fetch_array($sqlf)){
			echo'
				<tr id="div_'.$favs['postid'].'">
					<td>
						<span class="categoriaPost '.$favs['link_categoria'].'">
						</span>
					</td>
					<td style="text-align:left">
						<a class="titlePost" href="/posts/'.$favs['link_categoria'].'/'.$favs['postid'].'/'.corregir($favs['titulo']).'.html" title="'.$favs['titulo'].'" alt="'.$favs['titulo'].'">'.$favs['titulo'].'</a>

					</td>
					<td title="'.date("d.m.Y", $favs['creado']).' a las '.date("H:m:s", $favs['creado']).' hs.">
						'.hace($favs['creado']).'					</td>
					<td title="'.date("d.m.Y", $favs['guardado']).' a las '.date("H:m:s", $favs['guardado']).' hs.">
						'.hace($favs['guardado']).'					</td>
					<td class="color_green">
						'.$favs['puntos'].'					</td>

					<td>
						'.$favs['visitas'].'					</td>
					<td>
						<a id="change_status" href="javascript:borrar_favs(\''.$favs['postid'].'\')"><img src="'.$images.'/images/borrar.png" alt="borrar" title="Borrar Favorito" /></a>
					</td>
				</tr>';
			}
			
			mysql_free_result($sqlf);
			
			echo'
			</tbody>
		</table>

	</div>
</div>


</div>';

pie();
?>