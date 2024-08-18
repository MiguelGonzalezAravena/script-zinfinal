<?php
include("header.php");
require_once("class/class.tops.php");

$seccion = $_GET['data'];
$fecha = $_GET['fecha'];
$cat = $_GET['cat'];

$box = array('posts' => array('campo' => array('puntos','favoritos','comentarios','follow'),
                              'titulo' => array('Top post con m&aacute;s puntos',
                                             'Top post m&aacute;s favorito',
                                             'Top post m&aacute;s comentado',
                                             'Top post con m&aacute;s seguidores'),
                              'img' => array('puntos-n',
                                             'favoritos-n',
                                             'comentarios-n',
                                             'follow-n')),
             'comunidades' => array('campo' => array('numm','numte','comentarios','follow'),
                              'titulo' => array('Comunidades m&aacute;s populares',
                                             'Comunidades con m&aacute;s temas',
                                             'Comunidades con m&aacute;s respuestas',
                                             'Comunidades con m&aacute;s seguidores'),
                              'img' => array('popular-n','comunidades-n','comentarios-n-g','follow-n')),
             'temas' => array('campo' => array('votada','visitas'),
                              'titulo' => array('Temas m&aacute;s votados','Temas m&aacute;s visitados'),
                              'img' => array('votada-n ','')),
             'usuarios' => array('campo' => array('puntos','follow'),
                                 'titulo' => array('Top usuario con m&aacute;s puntos','Top usuario con m&aacute;s seguidores'),
                                 'img' => array('puntos-n','follow-n')));

$secciones = array('posts' => 'Post','comunidades' => 'Com','temas' => 'desuspender','usuarios' => 'desuspender');

if (!empty($secciones[$seccion]))
    $seccion = $seccion;
else
    $seccion = 'posts';

$top_zinfinal = new tops($fecha,$cat);

cabecera_normal();

echo '<div class="left" style="float:left;width:150px">
		<div class="boxy">

			<div class="boxy-title">
				<h3>Filtrar</h3>
				<span class="icon-noti"></span>
			</div>
			<div class="boxy-content">
				<h4>Categor&iacute;a</h4>
				<select onchange="location.href=\'/top/'.$seccion.'/?fecha=4&cat=\'+$(this).val()">

					<option value="-1">Todas</option>
					';

foreach($zinfinal->categorias[$seccion] as $categ) {
	echo '<option value="'.$categ['id'].'"'.($cat == $categ['id'] ? 'selected' : '').'>'.$categ['nombre'].'</option>
	';
}

echo '
									</select>

				<hr />
				<h4>Per&iacute;odo</h4>
				<ul>
					<li><a href="/top/'.$seccion.'/?fecha=-1&cat=-1">Todos los tiempos</a></li>
					<li><a href="/top/'.$seccion.'/?fecha=1&cat=-1">Hoy</a></li>
					<li><a href="/top/'.$seccion.'/?fecha=2&cat=-1">Ayer</a></li>
					<li><a href="/top/'.$seccion.'/?fecha=3&cat=-1">&Uacute;ltimos 7 d&iacute;as</a></li>
					<li><a href="/top/'.$seccion.'/?fecha=4&cat=-1" class="selected">Del mes</a></li>
					<li><a href="/top/'.$seccion.'/?fecha=5&cat=-1">Mes anterior</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="right" style="float:left;margin-left:10px;width:775px">
	';

############### MOSTRAMOS LAS CAJAS ###############

foreach ($box[$seccion]['titulo'] as $key => $value) {
	echo '
		<div class="boxy xtralarge">
			<div class="boxy-title">
				<h3>'.$value.'</h3>
				<span class="icon-noti '.$box[$seccion]['img'][$key].'"></span>

			</div>
			<div class="boxy-content">
						<ol>
						';
	
	$top_zinfinal->$seccion($box[$seccion]['campo'][$key]);
	
	foreach($top_zinfinal->top[$seccion] as $top) {
		echo $top['li'];
	}
	
	echo '
							</ol>

						</div>
		</div>';
}

############### TEMINAMOS CON LAS CAJAS ###############

echo '</div>';

pie();

?>