<?php
include("header.php");
$postid = (int) $_GET['postid'];

if(!empty($postid)) {
	$previo	= mysql_query("SELECT p.postid, p.categoria, p.titulo, c.link_categoria 
	FROM (posts as p, categorias AS c) 
	WHERE p.postid = '$postid' AND p.categoria = c.id_categoria");
	$resultado = mysql_fetch_array($previo);
	mysql_free_result($previo);
	Header("Location: ".$url."/posts/".$resultado['link_categoria']."/".$resultado['postid']."/".corregir($resultado['titulo']).".html");
	exit;
}

$id = $_GET['categoria'];
$seccion = $id == 'novatos' ? 'novatos' : 'index';

cabecera_normal(true);

$zinfinal->ultimos_post('12');
$zinfinal->ultimos_comentarios('-1');

$db1 = mysql_query("SELECT userid FROM usuarios");
$stats['usuarios'] = mysql_num_rows($db1);

$db2 = mysql_query("SELECT postid FROM posts");
$stats['posts'] = mysql_num_rows($db2);

$db3 = mysql_query("SELECT comid FROM comentarios");
$stats['comentarios'] = mysql_num_rows($db3);

$db4 = mysql_query("SELECT userid FROM usuarios WHERE ultimaaccion>unix_timestamp()-2*60 ORDER BY ultimaaccion DESC");
$stats['online'] = mysql_num_rows($db4);

echo '<script type="text/javascript">
(new Image()).src=\''.$images.'/images/big1v12.png\';

</script>
<div id="izquierda">
<div class="box_title" style="_width:380px">

<div class="box_txt ultimos_posts">&Uacute;ltimos posts</div>
<div class="box_rss">
	<a href="/rss/ultimos-post">
		<span style="position:relative;z-index:87" class="systemicons sRss"></span>
	</a>
</div>
</div>
<!-- inicio posts -->
<div class="box_cuerpo">
<ul>
';

foreach ($zinfinal->ultimos['post'] as $key => $value) {
	echo '
	  <li class="categoriaPost '.$value['link'].'">
    <a href="/posts/'.$value['link'].'/'.$value['postid'].'/'.corregir($value['titulo']).'.html" target="_self" title="'.$value['titulo'].'" alt="'.$value['titulo'].'" class="">
    '.$value['titulo'].'  </a>
  </li>';
}

echo '
</ul>
<br clear="left" />
<div align="center" class="size13">
<a href="/pagina1">Siguiente &raquo;</a></div>
</div>
<!-- fin posts -->
</div>

<div id="centro">
<div id="buscadorBox"><!-- buscador -->
	<div class="box_title">
		<span class="box_txt home_buscador">Buscador</span>
		<span class="box_rss"></span>
	</div>
	<div class="box_cuerpo">
		<img src="'.$images.'/images/InputSleft_2.gif" class="leftIbuscador" />
		<input type="text" id="ibuscadorq" class="ibuscador onblur_effect" onkeypress="ibuscador_intro(event)" onfocus="onfocus_input(this)" onblur="onblur_input(this)" value="Buscar" title="Buscar" />

		<input type="button" onclick="home_search()" align="top" vspace="2" hspace="10" alt="Buscar" class="bbuscador" title="Buscar" />
			<div style="clear:both"></div>
		<div style="margin: 5px 5px 0 0; color:#878787;font-weight:bold; ">
			<span class="floatL">Buscar con:</span>
			<div class="floatR searchBy">
				<input class="radio" type="radio" id="c_search_engine" name="search_engine" onchange="change_search_engine()" value="g" checked="checked" />
				<label for="c_search_engine"><img src="http://www.google.com/images/poweredby_transparent/poweredby_EEEEEE.gif" align="absmiddle" /></label> 
				<input class="radio" id="r_b_taringa" type="radio" name="search_engine" onchange="change_search_engine()" value="t" />
				<label for="r_b_taringa"><img align="absmiddle" src="'.$images.'/images/taringa.gif" /></label>

			</div>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
		</div>
	<br class="space" />
</div>
<div id="estadisticasBox"><!-- estadisticas -->

<div class="box_title">
<span class="box_txt estadisticas">Estad&iacute;sticas</span>

<span class="box_rss">
</span>
</div>
<div class="box_cuerpo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td> 
<a href=\'/usuarios-online/\' class=\'usuarios_online\'>'.$stats['online'].' usuarios online</a></td>
<td> '.$stats['usuarios'].'  miembros</td>
</tr>
<tr>
<td>'.$stats['posts'].'  posts</td>
<td>'.$stats['comentarios'].'  comentarios</td>

</tr>
</table>
</div>
<br class="space" />
</div>

<div id="juegosBox">
	<!-- juegos online -->
		<div class="box_title">
	<span class="box_txt home_juegos"><a href="/juegos/">Juegos '.$comunidad.'</a></span>
	<span class="box_rss"></span>
	</div>

	<div class="box_cuerpo">

		<table width="100%" border="0" cellspacing="2" cellpadding="2">

		<tr>
		<td><a href="/juegos/truco/" alt="Truco Multiplayer" title="Truco Multiplayer">Truco Multiplayer</a></td>
		<td><a href="/juegos/damas/" alt="Damas" title="Damas">Damas</a></td>
		</tr>
		
		<tr>
		<td><a href="/juegos/ajedrez/" alt="Ajedrez" title="Ajedrez">Ajedrez</a></td>
		<td><a href="/juegos/bichitos/" alt="Bichitos" title="Bichitos">Bichitos</a></td>
		</tr>
		<td><a href="/juegos/poker/" alt="Poker Texas Hold\'em" title="Poker Texas Hold\'em">Poker Texas Hold\'em</a></td>
		<td><a href="/juegos/xt/" alt="T!tris" title="T!tris">T!tris</a></td>
		<td> </td>

		</tr>
		</table>



	</div>
		
<br class="space" />


<!-- ultimos comentarios -->
<div id="lastCommBox">
<div class="box_title">
  <div class="box_txt ultimos_comentarios">&Uacute;ltimos comentarios</div>

  <div class="box_rss">
    <a href="#" class="size9" onclick="actualizar_comentarios(\'-1\',\'0\'); return false;">
      <span class="systemicons actualizar"></span>
    </a>
  </div>
</div>
</div>
<div class="box_cuerpo" id="ult_comm">
<ul>
';

foreach ($zinfinal->ultimos['comentarios'] as $key => $value) {
	echo '
	<li><strong>'.$value['nick'].'</strong> <a href="/posts/'.$value['link'].'/'.$value['postid'].'.ultima/'.corregir($value['titulo']).'.html#comentarios-abajo" class="size10">'.$value['titulo'].'</a></li>
	';
}

echo '
</ul>
</div>
</div>

<!-- top posts -->
<div id="topsPostBox">
<br class="space" />

<div class="box_title">
<div class="box_txt tops_posts_semana">TOPs posts <a href="/top/?cat=-1" class="size9">(Ver m&aacute;s)</a></div>
<div class="box_rss">
  <a href="/rss/top-post-semana">
    <span class="systemicons sRss"></span>
  </a>
</div>
</div>
<div class="box_cuerpo" style="padding: 0pt; height: 250px;">
    <div class="filterBy">

        Filtrar por: <a id="Semana" href="javascript:TopsTabs(\'topsPostBox\',\'Semana\')" class="here">Semana</a> - <a id="Mes" href="javascript:TopsTabs(\'topsPostBox\',\'Mes\')">Mes</a> - <a id="Historico" href="javascript:TopsTabs(\'topsPostBox\',\'Historico\')">Hist&oacute;rico</a>    </div>
    <ol class="filterBy" id="filterBySemana">
    ';

$semana = time() - (60*60*24*7);
$zinfinal->top_post($semana, false);

foreach ($zinfinal->top['post'] as $key => $value) {
	echo '
	<li><a href="/posts/'.$value['link'].'/'.$value['postid'].'/'.$value['titulo'].'.html">'.$value['titulo'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
    <ol class="filterBy" id="filterByMes">
    ';

$mes = time() - (2592000);
$zinfinal->top_post($mes, false);

foreach ($zinfinal->top['post'] as $key => $value) {
	echo '
	<li><a href="/posts/'.$value['link'].'/'.$value['postid'].'/'.$value['titulo'].'.html">'.$value['titulo'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
    <ol class="filterBy" id="filterByHistorico">
    ';


$zinfinal->top_post();

foreach ($zinfinal->top['post'] as $key => $value) {
	echo '
	<li><a href="/posts/'.$value['link'].'/'.$value['postid'].'/'.$value['titulo'].'.html">'.$value['titulo'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
</div>
</div>
<div id="topsUserBox">
<br class="space" />
<div class="box_title">
<div class="box_txt tops_usuarios">Usuarios TOPs <a href="/top/usuarios/?cat=-1" class="size9">(Ver m&aacute;s)</a></div>
<div class="box_rss">

  <a href="/rss/usuarios-top-mes">
    <span class="systemicons sRss"></span>
  </a>
</div>
</div>
<div class="box_cuerpo" style="padding: 0pt; height: 250px;">
    <div class="filterBy">
        Filtrar por: <a id="SemanaUser" href="javascript:TopsTabs(\'topsUserBox\',\'SemanaUser\')">Semana</a> - <a id="MesUser" href="javascript:TopsTabs(\'topsUserBox\',\'MesUser\')" class="here">Mes</a> - <a id="HistoricoUser" href="javascript:TopsTabs(\'topsUserBox\',\'HistoricoUser\')">Hist&oacute;rico</a>    </div>
    <ol class="filterBy" id="filterBySemanaUser">
    ';

$semana = time() - (60*60*24*7);
$zinfinal->top_usuarios($semana, false);

foreach ($zinfinal->top['user'] as $key => $value) {
	echo '
	<li><a href="/perfil/'.$value['id'].'">'.$value['nick'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
    <ol class="filterBy" id="filterByMesUser" style="display: block">
    ';

$mes = time() - (2592000);
$zinfinal->top_usuarios($mes, false);

foreach ($zinfinal->top['user'] as $key => $value) {
	echo '
	<li><a href="/perfil/'.$value['id'].'">'.$value['nick'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
    <ol class="filterBy" id="filterByHistoricoUser">
    ';

$zinfinal->top_usuarios();

foreach ($zinfinal->top['user'] as $key => $value) {
	echo '
	<li><a href="/perfil/'.$value['id'].'">'.$value['nick'].'</a> ('.$value['puntos'].')</li>';
}

echo '
    </ol>
</div>
</div>
</div>

<div id="derecha">
		<div class="climaHome clearbeta">
		<div class="clima-h-city">
			<a href="/clima" style="color:#000;text-decoration:none">El clima en Lima</a>
					</div>
		<div class="clima-h-data" onclick="$(\'.climaH-ext\').toggle()">
		<img style="vertical-align:top" src="'.$images.'/images/clima/i_0001.png" alt="" /> <strong><span style="color:#666">Temp</span> 17&deg; <span style="color:#666"> - Hum</span> 68%</strong>

		<a class="expand"></a>
		<div class="climaH-ext" style="display: none">
		    <ul>
			    <li>
			    	<div class="floatL" style="font-weight:normal;text-transform:uppercase;color:#333">Mañana</div>
				    <div class="floatR"><img src="'.$images.'/images/clima/i_0001.png" alt="" /> <strong><span style="color:#666">Min</span> <span style="color:#007ADE">14&deg;</span><span style="color:#666"> - Max</span> <span style="color:#F40000">24&deg;</span></strong></div>

			    </li>
			    <li>
			    	<div class="floatL" style="font-weight:normal;text-transform:uppercase;color:#333">Pasado</div>
				    <div class="floatR"><img src="'.$images.'/images/clima/i_0001.png" alt="" /> <strong><span style="color:#666">Min</span> <span style="color:#007ADE">13&deg;</span><span style="color:#666"> - Max</span> <span style="color:#F40000">24&deg;</span></strong></div>

			    </li>
			    <li style="text-align:center;padding-top:7px;background:#f1f1f1"><a href="/clima" style="color:#1571ba;">Más información sobre el tiempo »</a></li>
			</ul>
			</div>
		</div>
				<div style="border-top:#CCCCCC 1px solid ; text-align:center; padding:4px 3px 3px 3px;margin-top:6px;">
			<a onclick="registro_load_form(); return false">Registrate para cambiar de ciudad</a>
		</div>

			</div>

		
		<div id="takeover_div"></div>
		
		<div style="padding:0;">
		<center>
	
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$zinfinal->global_config['ca-pub'].'", "tar_h_250x500_general", 250, 500);
</script>
<br />


<script type="text/javascript">
	GA_googleFillSlotWithSize("'.$zinfinal->global_config['ca-pub'].'", "tar_h_250_general", 250, 250);
</script>

		</center>
		</div>

	
	
	<br class="space" />



		
	<br class="space" />

	<div class="box_cuerpo">
		<center>

	<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$zinfinal->global_config['ca-pub'].'", "tar_h_160_general", 160, 600);
</script>	</center>
	</div>

</div>';

pie();
?>