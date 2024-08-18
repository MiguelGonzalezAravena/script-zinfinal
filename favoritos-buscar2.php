<?php
require_once("header.php");
$cat = $_POST['cat'];
$sort_by = $_POST['sort_by'];

$sqlf = mysql_query("SELECT f.guardado,p.postid,p.titulo,p.creado,p.puntos,p.visitas,c.link_categoria 
FROM favoritos as f 
LEFT JOIN posts as p ON p.postid = f.id_post 
LEFT JOIN categorias as c ON c.id_categoria = p.categoria 
WHERE f.id_usuario = '$key' and p.categoria = '{$cat}' ORDER BY {$sort_by} DESC ");

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
?>