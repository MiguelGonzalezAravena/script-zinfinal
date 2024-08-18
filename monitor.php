<?php
include("header.php");
cabecera_normal();

$section = $_GET['section'];

if($key==null) {
	fatal_error('Para ingresar a esta secci&oacute;n es necesario autentificarse.');
}

$seguidores->x_full();

echo '
<div id="centroDerecha" style="width:705px;float:left">
	<div class="">
		<h2 style="font-size:15px">&Uacute;ltimas notificaciones</h2>
	</div>
	<ul class="notification-detail">';

foreach ($seguidores->array_n['full'] as $key => $value) {
	echo '<li class="'.$value['x'].'">
		<div class="avatar-box"><a href="/perfil/'.$value['nick'].'"><img src="'.$value['avatar'].'" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/'.$value['nick'].'">'.$value['nick'].'</a> <span class="time" ts="'.$value['enviado'].'" title="20.05.2010 a las 12:49 hs.">'.hace($value['enviado']).'</span></span><span class="action">'.$seguidores->x_full[$value['x']][$value['idno']]['full'].'</div>
		</li>';
}

echo '
	</ul>
</div>

<div id="post-izquierda" style="width:210px;float:right">
	<div class="categoriaList">
		<h6>Filtrar Actividad</h6>
		<ul>
			<li><strong>Mis Posts</strong></li>
			<li><label><span class="icon-noti favoritos-n"></span><input type="checkbox" onclick="notifica.filter(\'fav\', this)" checked="checked" /> Favoritos</label></li>
			<li><label><span class="icon-noti comentarios-n"></span><input type="checkbox" onclick="notifica.filter(\'comment-own\', this)" checked="checked" /> Comentarios</label></li>

			<li><label><span class="icon-noti puntos-n"></span><input type="checkbox" onclick="notifica.filter(\'points\', this)" checked="checked" /> Puntos Recibidos</label></li>
			<li><strong>Usuarios que sigo</strong></li>
			<li><label><span class="icon-noti follow-n"></span><input type="checkbox" onclick="notifica.filter(\'new\', this)" checked="checked" /> Nuevos</label></li>
			<li><label><span class="icon-noti post-n"></span><input type="checkbox" onclick="notifica.filter(\'post\', this)" checked="checked" /> Posts</label></li>
			<li><label><span class="icon-noti comunidades-n"></span><input type="checkbox" onclick="notifica.filter(\'thread\', this)" checked="checked"  /> Temas</label></li>

			<li><strong>Posts que sigo</strong></li>
			<li><label><span class="icon-noti comentarios-n-b"></span><input type="checkbox" onclick="notifica.filter(\'comment\', this)" checked="checked" /> Comentarios</label></li>
			<li><strong>Comunidades</strong></li>
			<li><label><span class="icon-noti comunidades-n"></span><input type="checkbox" onclick="notifica.filter(\'threadc\', this)" checked="checked"  /> Temas</label></li>
			<li><label><span class="icon-noti comentarios-n-g"></span><input type="checkbox" onclick="notifica.filter(\'reply\', this)" checked="checked"  /> Respuestas</label></li>

		</ul>
	</div>
	<div class="categoriaList estadisticasList">
		<h6>Estadísticas</h6>
		<ul>
			<li class="clearfix"><a href="/monitor/seguidores"><span class="floatL">Seguidores</span><span class="floatR number">5</span></a></li>
			<li class="clearfix"><a href="/monitor/siguiendo"><span class="floatL">Usuarios Siguiendo</span><span class="floatR number">1</span></a></li>
			<li class="clearfix"><a href="/monitor/posts"><span class="floatL">Posts</span><span class="floatR number">1</span></a></li>
			<li class="clearfix"><a href="/monitor/comunidades"><span class="floatL">Comunidades</span><span class="floatR number">1</span></a></li>
			<li class="clearfix"><a href="/monitor/temas"><span class="floatL">Temas</span><span class="floatR number">0</span></a></li>
		</ul>
	</div>
</div>';

pie();
?>