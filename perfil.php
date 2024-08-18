<?php
include("header.php");

$id = no_injection($_GET['data']);

if ($id==null) {
	$id = $_SESSION['id'];
}

if (is_numeric($id)){
	$donde = "u.id='{$id}'";
}else{
	$donde = "u.nick='{$id}'";
}

$sqlu = mysql_query("SELECT u.*,r.nom_rango 
FROM usuarios u 
LEFT JOIN rangos r ON r.id_rango=u.rango 
WHERE {$donde} ");

$existe = mysql_num_rows($sqlu);
$row = mysql_fetch_array($sqlu);
mysql_free_result($sqlu);

$descripcion = "Perfil de {$row['nick']}";
cabecera_normal();

if(!$existe){
	fatal_error('Ese usuario no existe ');
}

echo '<div id="cuerpocontainer">
<style>
#cuerpocontainer {
	padding: 0!important;
	width: 960px!important;
}
</style>
<script type="text/javascript">
	function perfil_foto_error(id){
		$(\'#user_photo_\'+id).remove();
	}
	function moreData(){
		if($(\'.moreData\').css(\'display\') == \'none\'){
			$(\'.moreData\').css(\'display\', \'block\');
			$(\'a.seeMore\').html(\'&laquo; Ver menos\');
		}else{
			$(\'.moreData\').css(\'display\', \'none\');
			$(\'a.seeMore\').html(\'Ver m&aacute;s &raquo;\');
		}
	}
</script>

<div class="perfil-user clearfix moderador">
		<div class="perfil-box clearfix">
			<div class="perfil-avatar">
				<a href="/perfil/'.$row['nick'].'"><img src="'.$row['avatar'].'" alt="" onerror="error_avatar(this)" /></a>
			</div>
			<div class="perfil-info">
				<h1 class="nick">'.$row['nick'].' <span class="name">('.$row['nombre'].')</span></h1>
				<span class="frase-personal">'.$row['mensaje'].'</span>

				<br />
				<span class="bio">'.$row['nombre'].' es un hombre de 31 años. Vive en Argentina y se uni&oacute; a la familia de '.$comunidad.' el 24 de Junio de 2005. Trabaja en '.$comunidad.'</span>
								<br />
				<a id="bloquear_cambiar" style="float:left;color:#FFF;display:block;padding:3px 5px;font-weight:bold;background:#ce152e;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px-" href="javascript:bloquear('.$row['id'].', true, \'perfil\')">Bloquear</a>
								<a onclick="notifica.unfollow(\'user\', '.$row['id'].', notifica.userInPostHandle, $(this).children(\'span\'))" class="btn_g unfollow_user_post" style="display: none"><span class="icons unfollow">Dejar de seguir</span></a>
				<a onclick="notifica.follow(\'user\', '.$row['id'].', notifica.userInPostHandle, $(this).children(\'span\'))" class="btn_g follow_user_post"><span class="icons follow">Seguir Usuario</span></a>
							</div>

		</div>
	<div class="menu-tabs-perfil clearfix">

			<ul>
				<li'.($_GET['data2']=='' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'">General</a></li>
				<li'.($_GET['data2']=='informacion' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/informacion">Informaci&oacute;n</a></li>
				<li'.($_GET['data2']=='comunidades' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/comunidades">Comunidades</a></li>
				<li'.($_GET['data2']=='fotos' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/fotos">Fotos</a></li>
				<li'.($_GET['data2']=='comentarios' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/comentarios">Comentarios</a></li>
				<li'.($_GET['data2']=='seguidores' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/seguidores">Seguidores</a></li>
				<li'.($_GET['data2']=='siguiendo' ? ' class="selected"' : '').'><a href="/perfil/'.$row['nick'].'/siguiendo">Siguiendo</a></li>
				<li class="enviar-mensaje">
				<a href="/mensajes/a/'.$row['nick'].'"><span class="systemicons mensaje" style="margin-right:5px"></span>Enviar Mensaje</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="perfil-main clearfix moderador">';

switch ($_GET['data2']) {
	case 'informacion':
		informacion();
		break;
	case 'comunidades':
		comunidades();
		break;
	case 'fotos':
		fotos();
		break;
	case 'comentarios':
		comentarios();
		break;
	case 'seguidores':
		seguidores();
		break;
	case 'siguiendo':
		siguiendo();
		break;
	default:
		Main();
		break;
}

function Main() {
	global $images,$row,$global_config;
	$sqlp = mysql_query("SELECT p.postid, p.titulo, p.puntos, c.link_categoria, c.nom_categoria 
	FROM posts AS p 
	LEFT JOIN categorias AS c ON p.categoria = c.id_categoria 
	WHERE p.id_autor='{$row['id']}' AND p.estado ='0' ORDER BY postid DESC LIMIT 10");
	
	$sqlt = mysql_query("SELECT t.idte,t.titulo,t.cerrado,co.nombre,co.shortname,ca.nom_categoria,ca.link_categoria 
    FROM c_temas t 
    LEFT JOIN c_comunidades co ON co.idco=t.idcomunid 
    LEFT JOIN c_categorias ca ON ca.id_categoria=co.categoria 
    WHERE id_autor='{$row['id']}' AND elimte = '0' ORDER BY idte DESC LIMIT 10");
    
	$sqlf = mysql_query("SELECT * FROM usuarios_fotos WHERE iduser = '{$row['id']}' ORDER BY fotoid DESC");
	
	echo '<script type="text/javascript">
function perfil_foto_error(id){
	$(\'#user_photo_\'+id).remove();
}
</script>

<div class="perfil-content general">
	<div class="widget w-stats clearfix">
	  <div class="title-w clearfix">
		  <h3>Estad&iacute;sticas del usuario</h3>
		</div>
		<ul>
			<li style="width:150px;padding-left: 5px">'.$row['nom_rango'].'<span>Rango</span></li>
			<li>'.$row['puntos'].'<span>Puntos</span></li>
			<li>'.$row['numposts'].'<span>Posts</span></li>
			<li>'.$row['numcomentarios'].'<span>Comentarios</span></li>
			<li>'.$row['seguidores_u'].'<span>Seguidores</span></li>
		</ul>
	</div>
	
	<div class="widget w-posts clearfix">
	  <div class="title-w clearfix">
	  	<h3>&Uacute;ltimos Posts creados</h3>
	  	<span><a class="systemicons sRss" href="/rss/posts-usuario/'.$row['id'].'" title="&Uacute;ltimos Posts de '.$row['nick'].'"></a></span>
	  </div>';

    if(!mysql_num_rows($sqlp)) {
        echo '<div class="emptyData">No hay posts</div>';
    } else {
        echo '<ul class="ultimos">';
        while ($postz = mysql_fetch_array($sqlp)) {
            echo '<li class="clearfix categoriaPost '.$postz['link_categoria'].'"><a href="/posts/'.$postz['link_categoria'].'/'.$postz['postid'].'/'.corregir($postz['titulo']).'.html">'.$postz['titulo'].'</a> <span>'.$postz['puntos'].' Puntos</span></li>';
        }
        mysql_free_result($sqlp);
        echo '<li class="see-more"><a href="/posts/buscador/zinfinal/?autor='.$row['nick'].'">Ver m&aacute;s &raquo;</a></li>';
        echo '</ul>';
    }
				
    echo '
	  </div>
	
	<div class="widget w-temas clearfix">
	  <div class="title-w clearfix">

		  <h3>&Uacute;ltimos Temas creados</h3>
		  <span><a class="systemicons sRss" href="/rss/perfil/temas/'.$row['id'].'/" title="&Uacute;ltimos Temas de '.$row['nick'].'"></a></span>
		</div>';
	if(!mysql_num_rows($sqlt)) {
		echo '<div class="emptyData">No hay temas</div>';
	} else {
		echo '<ul class="ultimos">';
		while ($temaz = mysql_fetch_array($sqlt)) {
			echo '<li class="clearfix categoriaCom interes-general">
				<a title="interes-general | Las estampillas de Star Wars" class="titletema" href="/comunidades/filatelia/404933/Las-estampillas-de-Star-Wars.html">Las estampillas de Star Wars</a>
				En <a href="/comunidades/filatelia/">Filatelistas</a>

				<span>23 respuestas</span>
			</li>';
		}
		mysql_free_result($sqlt);
		echo '<li class="see-more"><a href="http://buscar.zinfinal.net/comunidades?type=temas&q=autor%3A'.$row['nick'].'">Ver m&aacute;s &raquo;</a></li>';
		echo '</ul>';
	}
	
    echo '
			</div>

</div>
<div class="perfil-sidebar">
	<div style="margin-bottom: 10px">
		<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script>	</div>
	<div class="widget w-seguidores clearfix">
	  <div class="title-w clearfix">
		  <h3>Seguidores</h3>
		  <span>927</span>

		</div>
				<ul class="clearfix">
					<li><a href="/perfil/franky9556"><img src="http://a03.t.net.ar/avatares/3/9/4/0/32_3940620.jpg" alt="franky9556" title="franky9556" /></a></li>
					<li><a href="/perfil/Juanma14_9"><img src="http://a02.t.net.ar/avatares/2/8/1/3/32_2813630.jpg" alt="Juanma14_9" title="Juanma14_9" /></a></li>
					<li><a href="/perfil/Kris87"><img src="http://a04.t.net.ar/avatares/4/3/4/6/32_4346964.jpg" alt="Kris87" title="Kris87" /></a></li>
					<li><a href="/perfil/007MANUEL"><img src="http://a03.t.net.ar/avatares/1/8/9/4/32_1894519.jpg" alt="007MANUEL" title="007MANUEL" /></a></li>
				</ul>
				<a class="see-more" href="/perfil/'.$row['nick'].'/seguidores">Ver m&aacute;s &raquo;</a>
			</div>

	
	<div class="widget w-siguiendo clearfix">
	  <div class="title-w clearfix">
		  <h3>Siguiendo</h3>
		  <span>40</span>
		</div>
				<ul class="clearfix">
					<li><a href="/perfil/Atilo"><img src="'.$images.'/images/a32_1.jpg" alt="Atilo" title="Atilo"  /></a></li>
					<li><a href="/perfil/McTreNal"><img src="'.$images.'/images/a32_3.jpg" alt="McTreNal" title="McTreNal"  /></a></li>

					<li><a href="/perfil/Docal"><img src="'.$images.'/images/a32_6.jpg" alt="Docal" title="Docal"  /></a></li>
					<li><a href="/perfil/dysloke"><img src="http://a02.t.net.ar/avatares/2/6/9/8/32_26989.jpg" alt="dysloke" title="dysloke"  /></a></li>
					<li><a href="/perfil/yuyos"><img src="'.$images.'/images/a32_5.jpg" alt="yuyos" title="yuyos"  /></a></li>
					<li><a href="/perfil/k-len"><img src="http://a02.t.net.ar/avatares/0/4/3/2/32_432.jpg" alt="k-len" title="k-len"  /></a></li>
					<li><a href="/perfil/Adrius"><img src="http://a04.t.net.ar/avatares/0/2/9/3/32_293.jpg" alt="Adrius" title="Adrius"  /></a></li>
					<li><a href="/perfil/Greenpeace"><img src="http://a03.t.net.ar/avatares/1/1/1/4/32_111486.jpg" alt="Greenpeace" title="Greenpeace"  /></a></li>
					<li><a href="/perfil/Lazzer"><img src="http://a03.t.net.ar/avatares/1/9/0/8/32_19082.jpg" alt="Lazzer" title="Lazzer"  /></a></li>
					<li><a href="/perfil/ATINAo5"><img src="http://a04.t.net.ar/avatares/2/4/6/7/32_246751.jpg" alt="ATINAo5" title="ATINAo5"  /></a></li>
					<li><a href="/perfil/toiluj23"><img src="http://a04.t.net.ar/avatares/5/6/5/0/32_56505.jpg" alt="toiluj23" title="toiluj23"  /></a></li>

					<li><a href="/perfil/Marcelaflux"><img src="http://a03.t.net.ar/avatares/3/1/6/6/32_316654.jpg" alt="Marcelaflux" title="Marcelaflux"  /></a></li>
					<li><a href="/perfil/veerk"><img src="http://a04.t.net.ar/avatares/3/2/4/9/32_32499.jpg" alt="veerk" title="veerk"  /></a></li>
					<li><a href="/perfil/aeonxx"><img src="http://a04.t.net.ar/avatares/1/7/3/7/32_1737532.jpg" alt="aeonxx" title="aeonxx"  /></a></li>
					<li><a href="/perfil/aleks_47"><img src="http://a02.t.net.ar/avatares/1/3/0/6/32_1306190.jpg" alt="aleks_47" title="aleks_47"  /></a></li>
					<li><a href="/perfil/marco-"><img src="http://a04.t.net.ar/avatares/1/4/5/0/32_14509.jpg" alt="marco-" title="marco-"  /></a></li>
					<li><a href="/perfil/profedemate2001"><img src="http://a04.t.net.ar/avatares/2/9/5/4/32_295417.jpg" alt="profedemate2001" title="profedemate2001"  /></a></li>
					<li><a href="/perfil/pcarrillo"><img src="'.$images.'/images/a32_9.jpg" alt="pcarrillo" title="pcarrillo"  /></a></li>
					<li><a href="/perfil/VASSar"><img src="'.$images.'/images/a32_7.jpg" alt="VASSar" title="VASSar"  /></a></li>
					<li><a href="/perfil/Ferry"><img src="http://a04.t.net.ar/avatares/1/3/9/5/32_13954.jpg" alt="Ferry" title="Ferry"  /></a></li>

					<li><a href="/perfil/CommandZeta"><img src="http://a02.t.net.ar/avatares/1/0/3/2/32_1032615.jpg" alt="CommandZeta" title="CommandZeta"  /></a></li>
				</ul>
				<a  class="see-more" href="/perfil/'.$row['nick'].'/siguiendo">Ver m&aacute;s &raquo;</a>
			</div>

	<div class="widget w-comunidades clearfix">
	  <div class="title-w clearfix">
		  <h3>Mis comunidades</h3>

		  <span>23</span>
		</div>
				<a href="/comunidades/taringa-dev/">Desarrolladores de Taringa!</a>
				 - <a href="/comunidades/macadictos/">Mac Adictos</a>
				 - <a href="/comunidades/twitter/">Twitteros</a>
				 - <a href="/comunidades/greenpeace/">Greenpeace Argentina</a>

				 - <a href="/comunidades/soles/">Soles Asociacion Civil</a>
				 - <a href="/comunidades/beastieboys/">Beastie Boys fans</a>
				 - <a href="/comunidades/amia-comunidad-judia/">AMIA - Comunidad Judia</a>
				 - <a href="/comunidades/untechoparamipais/">Un Techo para mi Pa&iacute;s</a>
				 - <a href="/comunidades/filatelia/">Filatelistas</a>

				 - <a href="/comunidades/guinness/">Guinness World Records</a>
				<a class="see-more" href="/perfil/'.$row['nick'].'/comunidades">Ver m&aacute;s &raquo;</a>
			</div>
	<div class="widget w-fotos clearfix">
	  <div class="title-w clearfix">
		  <h3>Mis Fotos</h3>
		  <span>'.$num_i.'</span>
		</div>';
		
	if(!mysql_num_rows($sqlf)) {
		echo '<div class="emptyData">No public&oacute; ninguna foto</div>';
	} else {
		while ($fotoz = mysql_fetch_array($sqlf)) {
			echo '<div id="user_photo_'.$fotoz['fotoid'].'" class="photo_small">
			<a title="Abrir en nueva ventana" target="_blank" href="'.$fotoz['imagen'].'"><img border="0" onerror="perfil_foto_error('.$fotoz['fotoid'].')" style="max-width: 77px; max-height: 77px;" src="'.$fotoz['imagen'].'"></a>
		</div>';
		}
		mysql_free_result($sqlf);
	}
		
	echo '
			</div>
</div>
	</div>';
}

function informacion() {
	global $images,$row,$global_config;
	echo '<div class="perfil-content general">
	<div class="widget big-info clearfix">
		<div class="title-w clearfix">
			<h3>Informaci&oacute;n de manolo12</h3>

		</div>
		<ul>

			<li><label>Nombre</label><strong>Matias Botbol</strong></li>						<li><label>Edad</label><strong>31 años</strong></li>
			<li><label>Fecha de Nacimiento</label><strong>2 de Septiembre de 1978</strong></li>
						<li><label>Pa&iacute;s</label><strong>Argentina</strong></li>

			<li><label>Mensajero</label><strong><img src="'.$images.'//images/im-twitter.gif" alt="twitter" /> gangachanga</strong></li>
						<li><label>Sitio Web</label><strong>http://www.taringa.net</strong></li>			<li><label>Es usuario desde</label><strong>24 de Junio de 2005</strong></li>
			<li><label>Estudios</label><strong>Terciario completo</strong></li>
							<li class="sep"><h4>Idiomas</h4></li>

				<li><label>Castellano</label><strong>Nativo</strong></li>				<li><label>Ingl&eacute;s</label><strong>Intermedio</strong></li>																							
							<li class="sep"><h4>Datos profesionales</h4></li>
						<li><label>Profesi&oacute;n</label><strong>De todo un poco</strong></li>			<li><label>Empresa</label><strong>Taringa!</strong></li>			<li><label>Sector</label><strong>Internet</strong></li>									
						<li class="sep"><h4>Vida personal</h4></li>

						<li><label>Le gustar&iacute;a</label><strong>Conocer amigos, Conocer gente con sus intereses, Conocer gente de negocios</strong></li>			<li><label>Estado civil</label><strong>Casado/a</strong></li>			<li><label>Hijos</label><strong>Viven conmigo</strong></li>			<li><label>Vive con</label><strong>Con mi pareja</strong></li>
							<li class="sep"><h4>&iquest;C&oacute;mo es?</h4></li>

						<li><label>Mide</label><strong>165 centimetros</strong></li>			<li><label>Pesa</label><strong>63 kilos</strong></li>			<li><label>Su pelo es</label><strong>Casta&ntilde;o oscuro</strong></li>						<li><label>Su f&iacute;sico es</label><strong>Normal</strong></li>							<li><label></label><strong>Tiene tatuajes</strong></li>				<li><label></label><strong>No tiene piercings</strong></li>			
							<li class="sep"><h4>Habitos personales</h4></li>

						<li><label>Mantiene una dieta</label><strong>De todo</strong></li>			<li><label>Fuma</label><strong>No</strong></li>			<li><label>Toma alcohol</label><strong>Casualmente</strong></li>
						<li class="sep"><h4>Sus propias palabras</h4></li>
						<li><label>Intereses</label><strong>Disfrutar cada d&iacute;a como si fuese el ultimo.</strong></li>			<li><label>Hobbies</label><strong>Trabajar dedic&aacute;ndome a Taringa! es la mejor combinaci&oacute;n entre un hobby y un trabajo. Filatelia, Lego Mindstorms.</strong></li>			<li><label>Series de TV favoritas</label><strong>Los Simpsons, CQC, y algunos programas de Canal A y Film and Arts.</strong></li>			<li><label>M&uacute;sica favorita</label><strong>Beastie Boys, Manu Chao, Up, Bustle and out, Las Pelotas, jovanotti, los brujos, vanessa mae, wes, la portuaria, entre rios, etc.</strong></li>			<li><label>Deportes y Equipos</label><strong>depor..que?</strong></li>			<li><label>Libros favoritos</label><strong>No Logo, Las venas abiertas de Am&eacute;rica Latina, Padre Rico Padre Pobre.</strong></li>			<li><label>Pel&iacute;culas favoritas</label><strong>Brazil, Volver al futuro, El Padrino, La cosa, Amelie, Indiana Jones.</strong></li>			<li><label>Comida favor&iacute;ta</label><strong>Japonesa, China, Mexicana</strong></li>			<li><label>Sus heroes son</label><strong>La gente que eleg&iacute; para compartir la vida.</strong></li>		</ul>

	</div>
</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>
	</div>';
}

function comunidades() {
	global $images,$row,$global_config;
	$sqlco = mysql_query("SELECT co.nombre,co.shortname 
	FROM c_miembros m 
	LEFT JOIN c_comunidades co ON co.idco = idcomunity 
	where iduser = {$id_autor} ORDER BY m.idm DESC");
	
	echo '<div class="perfil-content">';
	
	if(mysql_num_rows($sqlco)) {
		echo '<div class="title-w clearfix">
	<h2>Comunidades en las que participa manolo12</h2>
</div>
<ul class="listado">';
		while ($comuz = mysql_fetch_array($sqlco)) {
			echo '<li class="clearfix">
		<div class="listado-content clearfix">
			<div class="listado-avatar">
				<a href="/comunidades/'.$comuz['shortname'].'/"><img src="http://i25.tinypic.com/vjfgk.jpg" alt="" onerror="com.error_logo(this)" width="32" height="32" /></a>
			</div>
			<div class="txt">
				<a href="/comunidades/'.$comuz['shortname'].'/">'.$comuz['nombre'].'</a><br />
				<span class="categoriaCom internet-tecnologia"></span> <span class="grey">Internet y Tecnolog&iacute;a</span>

			</div>
		</div>
	</li>';
		}
		mysql_free_result($sqlco);
		
		echo '</ul>';
		
	} else {
		echo '<div class="emptyData">No es miembro de ninguna comunidad</div>';
	}
	
	echo '

</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>

<style>
.btn_follow a {
	background-image: url(\''.$images.'/images/btn_follow.png\');
	background-repeat: no-repeat;
	background-position: top left;
display:block;
height:26px;
padding-bottom:0;
padding-left:7px;
padding-right:12px;
padding-top:4px;
width:13px;
}

.btn_follow a:hover , .btn_follow a:focus{
	background-position: -33px 0;
}

.btn_follow a:active{
	background-position: -66px 0;
}

.btn_follow a span {
	display: block;
	width: 19px;
	height: 19px;
	background-image: url(\''.$images.'/images/follow_actions.png\');
	background-repeat: no-repeat;
}

.btn_follow a span.remove_follow {
	background-position: top left;
}

.btn_follow a span.add_follow {
	background-position: 0 -20px;
}

.menu-tabs {
	background: #e1e1e1;
	padding: 10px 10px 0 10px ;
}

.menu-tabs li {
	float: left;
	margin-right: 10px;
}

.menu-tabs li a {
	display: block;
	padding: 10px 15px;
	background: #ebeaea;
	font-size: 14px;
	font-weight: bold;
	color: #2b3ed3!important;
}

.menu-tabs li.selected a,.menu-tabs li a:hover {
	background: #fafafa;
	color: #000!important;
}


.listado li {
	border-top: 1px solid #FFF;
	background: #fafafa;
	border-bottom: 1px dotted #CCC;
}

.listado li:first-child {
	border-top: none;
}



.listado li:hover {
	background: #EEE;
}

.listado a {
	color: #2b3ed3!important;
	font-weight: bold;
}

.listado .listado-avatar {
	float:left;
	margin-right: 10px;
}

.listado .listado-avatar img {
	padding: 1px;
	background: #FFF;
	border: 1px solid #CCC;	
	width: 32px;
	height: 32px;
}

.listado .listado-content {
	padding: 5px;
	float: left;
}

.listado .txt  {
	float: left;
	line-height:18px;
}

.listado .txt .grey {
	color: #999;
}

.listado .action {
	float: right;
	border-left: 1px solid #d6d6d6;
	background: #EEE;
	padding: 8px;
}

.listado-paginador {
	padding: 5px;
}

a.siguiente-listado, a.anterior-listado {
	display: block;
	padding: 5px 10px;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius:15px;
	color: #000!important;
	font-size: 13px;
}


/* new clearfix */
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
	}
* html .clearfix             { zoom: 1; } /* IE6 */
*:first-child+html .clearfix { zoom: 1; } /* IE7 */
</style>
	</div>';
}

function fotos() {
	global $images,$row,$global_config;
	$sqlf = mysql_query("SELECT * FROM usuarios_fotos WHERE iduser = '{$row['id']}' ORDER BY fotoid DESC");
	
	echo '<div class="perfil-content general">
	<div class="widget">';
	
	if(!mysql_num_rows($sqlf)) {
		echo '<div class="emptyData">No publico ninguna foto</div>';
	} else {
		while ($fotoz = mysql_fetch_array($sqlf)) {
			echo '<div id="user_photo_'.$fotoz['fotoid'].'" class="photo_small clearfix">
						<a title="" target="_blank" href="'.$fotoz['imagen'].'"><img border="0" onerror="perfil_foto_error('.$fotoz['fotoid'].')" src="'.$fotoz['imagen'].'" alt="" /></a>
		</div>';
		}
		mysql_free_result($sqlf);
	}
	
	echo '
	</div>
</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>
	</div>';
}

function comentarios() {
	global $images,$row,$global_config;
	
	echo '<div class="perfil-content general">
	<div class="widget big-info clearfix">
		<div class="title-w clearfix">
			<h3>Ultimos comentarios de manolo12</h3>

		</div>
		<ul>
				<li class="sep"><h4><a href="/posts/info/5635833/Computaci&oacute;n-para-los-m&aacute;s-chiquitos-de-la-casa.html">Computaci&oacute;n para los m&aacute;s chiquitos de la casa</a></h4></li>
				<li class="clearfix"><div class="comentario-p"><a href="/posts/info/5635833/Computaci&oacute;n-para-los-m&aacute;s-chiquitos-de-la-casa.html">que buen post! van puntos y a favoritos!!!</a></div><span class="fecha-p">Hace 10 horas</span></li>
				
				<li class="sep"><h4><a href="/posts/noticias/5628602/As&iacute;-reaccion&oacute;-un-beb&eacute;-sordo-que-pudo-oir-por-primera-vez.html">As&iacute; reaccion&oacute; un beb&eacute; sordo que pudo oir por primera vez</a></h4></li>
				<li class="clearfix"><div class="comentario-p"><a href="/posts/noticias/5628602/As&iacute;-reaccion&oacute;-un-beb&eacute;-sordo-que-pudo-oir-por-primera-vez.html">faa muy buenoooo!!!</a></div><span class="fecha-p">Hace 16 horas</span></li>

				<li class="sep"><h4><a href="/posts/mac/5616169/LiteSwitch-X-2_7-Beta-1---M&aacute;s-opciones-al-Command+Tab.html">LiteSwitch X 2.7 Beta 1 - M&aacute;s opciones al Command+Tab</a></h4></li>
				<li class="clearfix"><div class="comentario-p"><a href="/posts/mac/5616169/LiteSwitch-X-2_7-Beta-1---M&aacute;s-opciones-al-Command+Tab.html">gracias rodolfogs!!</a></div><span class="fecha-p">Hace 4 d&iacute;as</span></li>
		</ul>
	</div>
	</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>
	</div>';
}

function seguidores() {
	global $images,$row,$global_config;
	
	echo '<div class="perfil-content">
<div class="title-w clearfix">
	<h2>Usuarios que siguen a manolo12</h2>
</div>
<ul class="listado">

	<li class="clearfix">
		<div class="listado-content clearfix">
			<div class="listado-avatar">
				<a href="/perfil/Adrius"><img src="http://a04.t.net.ar/avatares/0/2/9/3/32_293.jpg" alt="Avatar de Adrius en Taringa!" /></a>
			</div>
			<div class="txt">
				<a href="/perfil/Adrius">Adrius</a><br />
				<img src="'.$images.'/images/flags/cy.png" alt="Chipre" /> <span class="grey">Knowledge is Freedom</span>

			</div>
		</div>
	</li>

	<li class="clearfix">
		<div class="listado-content clearfix">
			<div class="listado-avatar">
				<a href="/perfil/zapata"><img src="http://a04.t.net.ar/avatares/1/6/6/3/32_1663.jpg" alt="Avatar de zapata en Taringa!" /></a>
			</div>

			<div class="txt">
				<a href="/perfil/zapata">zapata</a><br />
				<img src="'.$images.'/images/flags/ar.png" alt="Argentina" /> <span class="grey">Fragilinvensible</span>
			</div>
		</div>
	</li>

	<li class="clearfix">

		<div class="listado-content clearfix">
			<div class="listado-avatar">
				<a href="/perfil/nihao"><img src="http://a03.t.net.ar/avatares/5/1/3/9/32_5139.jpg" alt="Avatar de nihao en Taringa!" /></a>
			</div>
			<div class="txt">
				<a href="/perfil/nihao">nihao</a><br />
				<img src="'.$images.'/images/flags/ar.png" alt="Argentina" /> <span class="grey">Gracias a Taringa, que me ha dado tanto.</span>

			</div>
		</div>
	</li>
	
	<li class="listado-paginador clearfix">
		<a class="siguiente-listado floatR" href="/perfil/manolo12/seguidores/1">Siguiente</a>
	</li>
</ul>
</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>

<style>
.btn_follow a {
	background-image: url(\''.$images.'/images/btn_follow.png\');
	background-repeat: no-repeat;
	background-position: top left;
display:block;
height:26px;
padding-bottom:0;
padding-left:7px;
padding-right:12px;
padding-top:4px;
width:13px;
}

.btn_follow a:hover , .btn_follow a:focus{
	background-position: -33px 0;
}

.btn_follow a:active{
	background-position: -66px 0;
}

.btn_follow a span {
	display: block;
	width: 19px;
	height: 19px;
	background-image: url(\''.$images.'/images/follow_actions.png\');
	background-repeat: no-repeat;
}

.btn_follow a span.remove_follow {
	background-position: top left;
}

.btn_follow a span.add_follow {
	background-position: 0 -20px;
}

.menu-tabs {
	background: #e1e1e1;
	padding: 10px 10px 0 10px ;
}

.menu-tabs li {
	float: left;
	margin-right: 10px;
}

.menu-tabs li a {
	display: block;
	padding: 10px 15px;
	background: #ebeaea;
	font-size: 14px;
	font-weight: bold;
	color: #2b3ed3!important;
}

.menu-tabs li.selected a,.menu-tabs li a:hover {
	background: #fafafa;
	color: #000!important;
}


.listado li {
	border-top: 1px solid #FFF;
	background: #fafafa;
	border-bottom: 1px dotted #CCC;
}

.listado li:first-child {
	border-top: none;
}



.listado li:hover {
	background: #EEE;
}

.listado a {
	color: #2b3ed3!important;
	font-weight: bold;
}

.listado .listado-avatar {
	float:left;
	margin-right: 10px;
}

.listado .listado-avatar img {
	padding: 1px;
	background: #FFF;
	border: 1px solid #CCC;	
	width: 32px;
	height: 32px;
}

.listado .listado-content {
	padding: 5px;
	float: left;
}

.listado .txt  {
	float: left;
	line-height:18px;
}

.listado .txt .grey {
	color: #999;
}

.listado .action {
	float: right;
	border-left: 1px solid #d6d6d6;
	background: #EEE;
	padding: 8px;
}

.listado-paginador {
	padding: 5px;
}

a.siguiente-listado, a.anterior-listado {
	display: block;
	padding: 5px 10px;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius:15px;
	color: #000!important;
	font-size: 13px;
}


/* new clearfix */
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
	}
* html .clearfix             { zoom: 1; } /* IE6 */
*:first-child+html .clearfix { zoom: 1; } /* IE7 */
</style>
	</div>';
}

function siguiendo() {
	global $images,$row,$global_config;
	
	echo '<div class="perfil-content">
<h2>Usuarios que manolo12 sigue</h2>
<ul class="listado">

	<li class="clearfix">
		<div class="listado-content clearfix">

			<div class="listado-avatar">
				<a href="/perfil/nihao"><img src="http://a03.t.net.ar/avatares/5/1/3/9/32_5139.jpg" alt="Avatar de nihao en Taringa!" /></a>
			</div>
			<div class="txt">
				<a href="/perfil/nihao">nihao</a><br />
				<img src="'.$images.'/images/flags/ar.png" alt="Argentina" /> <span class="grey">Gracias a Taringa, que me ha dado tanto.</span>
			</div>

		</div>
	</li>

	<li class="clearfix">
		<div class="listado-content clearfix">
			<div class="listado-avatar">
				<a href="/perfil/jazzman181276"><img src="'.$images.'/images/a32_5.jpg" alt="Avatar de jazzman181276 en Taringa!" /></a>
			</div>
			<div class="txt">

				<a href="/perfil/jazzman181276">jazzman181276</a><br />
				<img src="'.$images.'/images/flags/ar.png" alt="Argentina" /> <span class="grey"></span>
			</div>
		</div>
	</li>

	<li class="listado-paginador clearfix">
		<a class="siguiente-listado floatR" href="/perfil/manolo12/siguiendo/1">Siguiente</a>
	</li>
</ul>
</div>
<div class="perfil-sidebar">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_300_general", 300, 250);
</script></div>

<style>
.btn_follow a {
	background-image: url(\''.$images.'/images/btn_follow.png\');
	background-repeat: no-repeat;
	background-position: top left;
display:block;
height:26px;
padding-bottom:0;
padding-left:7px;
padding-right:12px;
padding-top:4px;
width:13px;
}

.btn_follow a:hover , .btn_follow a:focus{
	background-position: -33px 0;
}

.btn_follow a:active{
	background-position: -66px 0;
}

.btn_follow a span {
	display: block;
	width: 19px;
	height: 19px;
	background-image: url(\''.$images.'/images/follow_actions.png\');
	background-repeat: no-repeat;
}

.btn_follow a span.remove_follow {
	background-position: top left;
}

.btn_follow a span.add_follow {
	background-position: 0 -20px;
}

.menu-tabs {
	background: #e1e1e1;
	padding: 10px 10px 0 10px ;
}

.menu-tabs li {
	float: left;
	margin-right: 10px;
}

.menu-tabs li a {
	display: block;
	padding: 10px 15px;
	background: #ebeaea;
	font-size: 14px;
	font-weight: bold;
	color: #2b3ed3!important;
}

.menu-tabs li.selected a,.menu-tabs li a:hover {
	background: #fafafa;
	color: #000!important;
}


.listado li {
	border-top: 1px solid #FFF;
	background: #fafafa;
	border-bottom: 1px dotted #CCC;
}

.listado li:first-child {
	border-top: none;
}



.listado li:hover {
	background: #EEE;
}

.listado a {
	color: #2b3ed3!important;
	font-weight: bold;
}

.listado .listado-avatar {
	float:left;
	margin-right: 10px;
}

.listado .listado-avatar img {
	padding: 1px;
	background: #FFF;
	border: 1px solid #CCC;	
	width: 32px;
	height: 32px;
}

.listado .listado-content {
	padding: 5px;
	float: left;
}

.listado .txt  {
	float: left;
	line-height:18px;
}

.listado .txt .grey {
	color: #999;
}

.listado .action {
	float: right;
	border-left: 1px solid #d6d6d6;
	background: #EEE;
	padding: 8px;
}

.listado-paginador {
	padding: 5px;
}

a.siguiente-listado, a.anterior-listado {
	display: block;
	padding: 5px 10px;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius:15px;
	color: #000!important;
	font-size: 13px;
}


/* new clearfix */
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
	}
* html .clearfix             { zoom: 1; } /* IE6 */
*:first-child+html .clearfix { zoom: 1; } /* IE7 */
</style>

	</div>';
}

pie();
?>
<?php
include("../header.php");

class comunidades {
	
	public $seccion;
	public $key;
	public $comid;
	public $temaid;
	
	public $rango;
	
	public $main;
	public $main_n;
	
	function __construct($seccion,$key,$comid,$temaid) {
		
	}
	
	public function seccion() {
		
	}
	
	public function Main() {
		$dbdestacadas = mysql_query("SELECT co.nombre,co.shortname,co.imagen,co.oficial FROM c_comunidades as co WHERE co.oficial = 1 LIMIT 1");
		$this->main_n['destacadas'] = mysql_num_rows($dbdestacadas);
		
		while($seg = mysql_fetch_array($dbdestacadas))
		    $this->main['destacadas'][] = array('idse' => $seg['idse'],'seguidor' => $seg['seguidor'],'type' => $seg['type'],'obj' => $seg['obj']);
        
        mysql_free_result($dbdestacadas);
        
        /*Ultimos Temas*/
        $categoria = no_injection($_GET['categoria']);
        $limit_posts=20;
        
        if($categoria == '') {
            $cat_condition = "";
        } else {
            $cat_condition = "AND ca.link_categoria='{$categoria}'";
        }
        
        if($categoria == ''){
            $request = mysql_query("SELECT * FROM c_temas");
            $NroRegistros = mysql_num_rows($request);
        } else {
            $request = mysql_query("SELECT t.*,co.*,ca.* 
            FROM c_temas t 
            LEFT JOIN c_comunidades co ON co.idco=t.idcomunid 
            LEFT JOIN c_categorias ca ON ca.id_categoria=co.categoria 
            WHERE 1=1 {$cat_condition}");
            
            $NroRegistros = mysql_num_rows($request);
       }
       
       if(isset($_GET['pagina'])) {
           $RegistrosAEmpezar=($_GET['pagina']-1)*$limit_posts;
           $PagAct=$_GET['pagina'];
       } else {
           $RegistrosAEmpezar=0;
           $PagAct=1;
       }
       
       $PagAnt = $PagAct-1;
       $PagSig = $PagAct+1;
       $PagUlt = $NroRegistros/$limit_posts;
       $Res = $NroRegistros%$limit_posts;
       if ($Res > 0) {
           $PagUlt = floor($PagUlt)+1;
       }
       
       $sqldult = mysql_query("SELECT t.*,co.*,us.nick,ca.* 
       FROM c_temas t 
       LEFT JOIN c_comunidades co ON co.idco=t.idcomunid 
       LEFT JOIN usuarios us ON us.id=t.id_autor 
       LEFT JOIN c_categorias ca ON ca.id_categoria=co.categoria 
       WHERE 1=1 {$cat_condition} ORDER BY t.idte DESC LIMIT $RegistrosAEmpezar, $limit_posts");
       
       $dbdestacadas = mysql_query("
       SELECT t.*,co.*,us.nick,ca.* 
       FROM c_temas t 
       LEFT JOIN c_comunidades co ON co.idco=t.idcomunid 
       LEFT JOIN usuarios us ON us.id=t.id_autor 
       LEFT JOIN c_categorias ca ON ca.id_categoria=co.categoria 
       WHERE 1=1 ORDER BY t.idte DESC LIMIT $RegistrosAEmpezar, $limit_posts");
       
       $this->main_n['destacadas'] = mysql_num_rows($dbdestacadas);
       
       while($seg = mysql_fetch_array($dbdestacadas))
           $this->main['destacadas'][] = array('idse' => $seg['idse'],'seguidor' => $seg['seguidor'],'type' => $seg['type'],'obj' => $seg['obj']);
       
       mysql_free_result($dbdestacadas);
	}
	
	public function arbol_de_enlaces() {
		
	}
	
}

echo 'gggggggg';

function Main_template() {
	global $key;
	
	echo '<div class="comunidades">





	<div class="home">
<div id="izquierda">

		<div class="crear_comunidad">
		<div class="box_cuerpo" style="background:#FFFFCC;border:#b5b539 1px solid; -moz-border-radius:7px">
			<h3 style="margin:5px 0">Comunidades</h3>
			<p style="color: #333">Taringa! te permite crear tu comunidad para que puedas compartir gustos e intereses con los dem&aacute;s.</p>

			<div class="buttons">
				<input id="a_susc" class="mBtn btnYellow" onclick="location.href=\'/comunidades/crear/\'" value="¡Crea la tuya! &raquo;" type="button" />
			</div>
		</div>
	</div>

		<br class="space">
		<script type="text/javascript">
  GA_googleFillSlotWithSize("ca-pub-5717128494977839", "tar_ch_160_general", 160, 600);
</script></div>

<div id="centro">
	<div class="box_title">
		<div class="box_txt ultimos_posts">
			&Uacute;ltimos temas 
		</div>
		<div class="box_rss">
			<a href="/rss/comunidades/" title="&Uacute;ltimos Temas"><span class="systemicons sRss" style="position: relative; z-index: 87;"></span></a>
		</div>
	</div>
	<div class="box_cuerpo">

		<ul>
				<li class="categoriaCom internet-tecnologia">
				<a href="/comunidades/garrysmodjuego/543176/addons-para-gmod.html" class="titletema" title="Internet y Tecnolog&iacute;a | addons para gmod">addons para gmod</a>
				En <a href="/comunidades/garrysmodjuego/">Garrys Mod</a> por <a href="/perfil/vegit0/">vegit0</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">

				<a href="/comunidades/whatthefuck/543175/De-Que-Juego-Es.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | De Que Juego Es?">De Que Juego Es?</a>
				En <a href="/comunidades/whatthefuck/">Comunidad WTF</a> por <a href="/perfil/_SuSpEnDiDo_/">_SuSpEnDiDo_</a>
							</li>
				<li class="categoriaCom musica-bandas">
				<a href="/comunidades/co-gunner/543174/Contacto___.html" class="titletema" title="M&uacute;sica y Bandas | Contacto...">Contacto...</a>

				En <a href="/comunidades/co-gunner/">Comunidad Gunner</a> por <a href="/perfil/Sub0Zero/">Sub0Zero</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/betawtf/543173/+5-al-comentario-Nº-5.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | +5 al comentario Nº 5">+5 al comentario Nº 5</a>
				En <a href="/comunidades/betawtf/">Beta Users!</a> por <a href="/perfil/Administrador9Nahuel/">Administrador9Nahuel</a>

							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/shitbrix/543172/Mindfuck-4.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | Mindfuck 4">Mindfuck 4</a>
				En <a href="/comunidades/shitbrix/">Shitbrix</a> por <a href="/perfil/_Pedro_Picapiedra_/">_Pedro_Picapiedra_</a>
							</li>
				<li class="categoriaCom internet-tecnologia">

				<a href="/comunidades/xbox360/543171/Curiosidades-en-el-MW2_.html" class="titletema" title="Internet y Tecnolog&iacute;a | Curiosidades en el MW2.">Curiosidades en el MW2.</a>
				En <a href="/comunidades/xbox360/">XBOX 360 ! - [Comunidad Oficial]</a> por <a href="/perfil/tainor/">tainor</a>
							</li>
				<li class="categoriaCom interes-general">
				<a href="/comunidades/taringarespuestas/543170/ayuda.html" class="titletema" title="Inter&eacute;s general | ayuda">ayuda</a>

				En <a href="/comunidades/taringarespuestas/">Taringa Respuestas!</a> por <a href="/perfil/santiaguets/">santiaguets</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/whatthefuck/543169/kiando-con-un-carajo___.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | kiando con un carajo...">kiando con un carajo...</a>
				En <a href="/comunidades/whatthefuck/">Comunidad WTF</a> por <a href="/perfil/000100101/">000100101</a>

							</li>
				<li class="categoriaCom deportes">
				<a href="/comunidades/taringa-torneos/543168/Messi-está-entre-los-candidatos-al-Balón-de-Oro.html" class="titletema" title="Deportes | Messi está entre los candidatos al Balón de Oro">Messi está entre los candidatos al Balón de Oro</a>
				En <a href="/comunidades/taringa-torneos/">Taringa! Futbol</a> por <a href="/perfil/Axl_Rose13/">Axl_Rose13</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">

				<a href="/comunidades/resident-evil-4-y-5/543167/q.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | q">q</a>
				En <a class="systemicons cerrada" href="/comunidades/resident-evil-4-y-5/">Resident Evil 4 y 5 [Comunidad Oficial]</a> por <a href="/perfil/shiunsay93/">shiunsay93</a>
							</li>
				<li class="categoriaCom grupos-organizaciones">
				<a href="/comunidades/teamarg/543166/Ladrones-de-Cuentas-Steam-A-La-Vista!!.html" class="titletema" title="Grupos y Organizaciones | Ladrones de Cuentas Steam A La Vista!!">Ladrones de Cuentas Steam A La Vista!!</a>

				En <a href="/comunidades/teamarg/">Clan [A.R.G]</a> por <a href="/perfil/LDSwilm3r/">LDSwilm3r</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/irctaringa/543165/holiissss-soy-nueva!-^^.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | holiissss soy nueva! ^^">holiissss soy nueva! ^^</a>
				En <a href="/comunidades/irctaringa/">Chat TARINGA!</a> por <a href="/perfil/Jony_Zeppelin/">Jony_Zeppelin</a>

							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/hijosdelpueblo/543164/las-caidas-y-golpes-mas-dolorosas-del-mundo.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | las caidas y golpes mas dolorosas del mundo">las caidas y golpes mas dolorosas del mundo</a>
				En <a href="/comunidades/hijosdelpueblo/">HDP`s</a> por <a href="/perfil/marcus04_96/">marcus04_96</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">

				<a href="/comunidades/xdddddddxd/543163/una-musikita-adictivamente-molesta-xD.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | una musikita adictivamente molesta xD">una musikita adictivamente molesta xD</a>
				En <a href="/comunidades/xdddddddxd/">Comunidad XD</a> por <a href="/perfil/juanii000/">juanii000</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/el-nuevo-mundo/543162/Adivinanza-No_-82.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | Adivinanza No. 82">Adivinanza No. 82</a>

				En <a href="/comunidades/el-nuevo-mundo/">Rincon Taringuero!</a> por <a href="/perfil/ivan_2796/">ivan_2796</a>
							</li>
				<li class="categoriaCom interes-general">
				<a href="/comunidades/t-answers/543161/Necesito-ya-saber-si-el-pedal-de-mi-Mini-Bateria-del-Rockban.html" class="titletema" title="Inter&eacute;s general | Necesito ya saber si el pedal de mi Mini-Bateria del Rockban">Necesito ya saber si el pedal de mi Mini-Bateria del Rockban</a>
				En <a href="/comunidades/t-answers/">T! answers</a> por <a href="/perfil/fcpika/">fcpika</a>

							</li>
				<li class="categoriaCom deportes">
				<a href="/comunidades/futtbol/543160/Del-Bosque-no-definió-el-equipo-contra-Holanda.html" class="titletema" title="Deportes | Del Bosque no definió el equipo contra Holanda">Del Bosque no definió el equipo contra Holanda</a>
				En <a class="systemicons cerrada" href="/comunidades/futtbol/">Futbol de Primera!</a> por <a href="/perfil/D3pR3dAt0r/">D3pR3dAt0r</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">

				<a href="/comunidades/shitbrix/543159/Mindfuck-3.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | Mindfuck 3">Mindfuck 3</a>
				En <a href="/comunidades/shitbrix/">Shitbrix</a> por <a href="/perfil/_Pedro_Picapiedra_/">_Pedro_Picapiedra_</a>
							</li>
				<li class="categoriaCom deportes">
				<a href="/comunidades/racingclub/543158/Arma-tu-equipo!.html" class="titletema" title="Deportes | Arma tu equipo!">Arma tu equipo!</a>

				En <a href="/comunidades/racingclub/">Racing Club de Avellaneda</a> por <a href="/perfil/martin_de_tesei_94/">martin_de_tesei_94</a>
							</li>
				<li class="categoriaCom diversion-esparcimiento">
				<a href="/comunidades/dragonballcomu/543157/12-Miembros-!.html" class="titletema" title="Diversi&oacute;n y Esparcimiento | 12 Miembros !">12 Miembros !</a>
				En <a href="/comunidades/dragonballcomu/">Dragon Ball (Z) (GT) (KAI)</a> por <a href="/perfil/ramikpo/">ramikpo</a>

							</li>
			</ul>
		<br clear="left">
		<div class="paginator" align="center">
					<div class="floatR"><a href="/comunidades/pagina.2">Siguiente &raquo;</a></div>
				<div class="clearBoth"></div>
		</div>
	</div>

</div>

<div id="derecha">
	<!-- buscador -->
	<div class="buscador">
		<div class="box_title">
			<span class="box_txt home_buscador">Buscador</span><span class="box_rss"></span>
		</div>
		<div class="box_cuerpo">
			<img class="leftIbuscador" src="http://o2.t26.net/images/InputSleft_2.gif" />

			<form style="padding:0;margin:0" name="buscador_home" method="GET" action="/comunidades/buscador-comunidades.php" onsubmit="return com.buscador_home()">
				<input type="text" name="q" class="ibuscador onblur_effect" onfocus="onfocus_input(this)" onblur="onblur_input(this)" value="Buscar" title="Buscar" />
				<input type="submit" title="Buscar" value="" class="bbuscador" alt="Buscar" />
			</form>
			<div style="margin: 5px 5px 0pt 0pt; color: rgb(135, 135, 135); font-weight: bold;">
				<span class="floatL">Buscar en:</span>
				<div class="floatR buscarEn">
					<input type="radio" value="comunidades" onchange="com.buscador_home_radio(this.value)" name="buscar_en" id="buscar_en_comunidades" class="radio" checked="checked" />

					<label for="buscar_en_comunidades">Comunidades</label> 
					<input type="radio" value="temas" onchange="com.buscador_home_radio(this.value)" name="buscar_en" id="buscar_en_temas" class="radio" />
					<label for="buscar_en_temas">Temas</label> 
				</div>
				<div style="clear: both;"/></div>
			</div>
		</div>
	</div>
	<br class="space">

	<div class="ult_respuestas">
		<div class="box_title">
			<div class="box_txt ultimos_comentarios">&Uacute;ltimas respuestas</div>
			<div class="box_rss">
				<a href="javascript:com.actualizar_respuestas()">
					<span class="systemicons actualizar"></span>
				</a>
			</div>

		</div>
		<div class="box_cuerpo" id="ult_resp">
			<ul>
						<li><strong>Strange19_Audion</strong> <a href="/comunidades/ps2games/543115.ultima/[Bar-XXIX]-Cool.html#respuestas-abajo" class="size10">[Bar XXIX] Cool</a></li>
						<li><strong>motorologo2</strong> <a href="/comunidades/sofwarevario/532231.ultima/Alemania-Se-LLevara-la-Copa\'.html#respuestas-abajo" class="size10">Alemania Se LLevara la Copa?????????????????\'</a></li>
						<li><strong>nicoo28</strong> <a href="/comunidades/whatthefuck/543155.ultima/la-verdad-que-no-entiendo-a-las-mujeres.html#respuestas-abajo" class="size10">la verdad que no entiendo a las mujeres</a></li>

						<li><strong>Batalla_Solari</strong> <a href="/comunidades/codibujante/542363.ultima/3-de-mis-dibujos-con-plumas-de-colores.html#respuestas-abajo" class="size10">3 de mis dibujos con plumas de colores</a></li>
						<li><strong>tserro1</strong> <a href="/comunidades/comunidad-la-hoja/526853.ultima/¡Gran-Concurso-Naruto!.html#respuestas-abajo" class="size10">¡Gran Concurso Naruto!</a></li>
						<li><strong>rat79</strong> <a href="/comunidades/whatthefuck/542956.ultima/una-pregunta-referida-a-robos.html#respuestas-abajo" class="size10">una pregunta referida a robos</a></li>
						<li><strong>Luis_man95</strong> <a href="/comunidades/capsim/542612.ultima/help().html#respuestas-abajo" class="size10">help(?)</a></li>

						<li><strong>ItachiAkatsuki</strong> <a href="/comunidades/naruto-f/543057.ultima/Alto-amv.html#respuestas-abajo" class="size10">Alto amv</a></li>
						<li><strong>emajuegos</strong> <a href="/comunidades/cine--tv/531445.ultima/Tema-positivo!!-º-comenten!!-(nuevos-tops!).html#respuestas-abajo" class="size10">Tema positivo!! º comenten!! (nuevos tops!)</a></li>
						<li><strong>_GerMax_</strong> <a href="/comunidades/teamarg/543166.ultima/Ladrones-de-Cuentas-Steam-A-La-Vista!!.html#respuestas-abajo" class="size10">Ladrones de Cuentas Steam A La Vista!!</a></li>
						<li><strong>superrhijitus</strong> <a href="/comunidades/ateismo/402728.ultima/“Dice-el-necio-en-su-corazón:-No-hay-Dios”-(Salmos-14:1.html#respuestas-abajo" class="size10">“Dice el necio en su corazón: No hay Dios” (Salmos 14:1</a></li>

						<li><strong>therama09</strong> <a href="/comunidades/bocajuniors/542649.ultima/[News]-Caruzzo-ya-es-de-boca.html#respuestas-abajo" class="size10">[News] Caruzzo ya es de boca</a></li>
						<li><strong>ACHUMADO</strong> <a href="/comunidades/cannabis/543071.ultima/Tengo-una-duda__.html#respuestas-abajo" class="size10">Tengo una duda..</a></li>
						<li><strong>Caterpai</strong> <a href="/comunidades/el-nuevo-mundo/543162.ultima/Adivinanza-No_-82.html#respuestas-abajo" class="size10">Adivinanza No. 82</a></li>
						<li><strong>demon235</strong> <a href="/comunidades/dlranigam/537828.ultima/(Ayuda)-Los-Saves-no-agarran-el-juego__-miren__.html#respuestas-abajo" class="size10">(Ayuda) Los Saves no agarran el juego.. miren..</a></li>

					</ul>
		</div>
	</div>
	<br class="space">

	<div class="com_populares">
		<div class="box_title">
			<div class="box_txt">Comunidades Populares</div>
			<div class="box_rrs"><span class="box_rss"></span></div>

		</div>
		<div class="box_cuerpo" style="padding:0 0 0 0; height: 250px;">
			<div class="filterBy">
				Filtrar por: <a id="Semana" href="javascript:com.TopsTabs(\'Semana\')" class="here">Semana</a> - <a id="Mes" href="javascript:com.TopsTabs(\'Mes\')">Mes</a> - <a id="Historico" href="javascript:com.TopsTabs(\'Historico\')">Hist&oacute;rico</a>

			</div>
			<ol class="filterBy" id="filterBySemana">
											<li><a href="/comunidades/ceroenconducta/">Cero En Conducta!</a> (119)</li>
							<li><a href="/comunidades/hijosdelpueblo/">HDP`s</a> (88)</li>
							<li><a href="/comunidades/comunidadwii/">COMUNIDAD WII¡¡¡</a> (61)</li>

							<li><a href="/comunidades/subielvolumen/">Subi El Volumen!</a> (61)</li>
							<li><a href="/comunidades/tolodtargentina/">Tolo Gallego - Brasil 2014</a> (59)</li>
							<li><a href="/comunidades/graff/">Taringraff</a> (53)</li>
							<li><a href="/comunidades/ttedesvela/">Taringa te desvela</a> (52)</li>

							<li><a href="/comunidades/irctaringa/">Chat TARINGA!</a> (50)</li>
							<li><a href="/comunidades/taringuerosytaringueras/">Taringueros/as!</a> (48)</li>
							<li><a href="/comunidades/rambermatica/">Todo Sobre Informatica</a> (47)</li>
							<li><a href="/comunidades/vaplbeeb/">Volver a Poner la Bandera en e...</a> (46)</li>

							<li><a href="/comunidades/ayudadaunnovato/">Queres ayuda? entrá (para nova...</a> (41)</li>
							<li><a href="/comunidades/futbolynadamasquefutbol/">Futbol Y Nada Mas Que Futbol</a> (41)</li>
							<li><a href="/comunidades/copaamerica2011/">Copa America 2011</a> (40)</li>
							<li><a href="/comunidades/soporte-para-linux/">Soporte Tecnico de Linux</a> (39)</li>

						</ol>
			<ol class="filterBy" id="filterByMes">
											<li><a href="/comunidades/ylosantimessi/">y los anti messi?</a> (681)</li>
							<li><a href="/comunidades/facundocisterna/">Games 3DX [Comunidad Oficial]</a> (498)</li>
							<li><a href="/comunidades/cienciainformatica/">Informática: la ciencia de la in...</a> (431)</li>

							<li><a href="/comunidades/trsnochinga/">TrAsNochinga!</a> (328)</li>
							<li><a href="/comunidades/prode-del-mundial/">Prode Taringuero! - [Comunidad O...</a> (311)</li>
							<li><a href="/comunidades/japonteamo/">amantes del  japon</a> (262)</li>
							<li><a href="/comunidades/martinpalermoenelmundial/">Palermo es Mundial</a> (260)</li>

							<li><a href="/comunidades/resident-evil-4-y-5/">Resident Evil 4 y 5 [Comunidad O...</a> (256)</li>
							<li><a href="/comunidades/shsite/">SIlent hill site</a> (231)</li>
							<li><a href="/comunidades/gamersveteranos/">GAMERS VETERANOS</a> (202)</li>
							<li><a href="/comunidades/konoha/">konoha</a> (178)</li>

							<li><a href="/comunidades/xdddddddxd/">Comunidad XD</a> (176)</li>
							<li><a href="/comunidades/comunidadk/">Comunidad K [x2]</a> (173)</li>
							<li><a href="/comunidades/xbox-comu/">XBOX - Comunidad Oficial</a> (164)</li>
							<li><a href="/comunidades/c-m-z/">Comunidad Max Zone</a> (140)</li>

						</ol>
			<ol class="filterBy" id="filterByHistorico">
											<li><a href="/comunidades/gamers/">Gamers</a> (10783)</li>
							<li><a href="/comunidades/whatthefuck/">Comunidad WTF</a> (10460)</li>
							<li><a href="/comunidades/taringarespuestas/">Taringa Respuestas!</a> (9417)</li>

							<li><a href="/comunidades/serviciotecnico/">Servicio Tecnico para PC</a> (8396)</li>
							<li><a href="/comunidades/juegostaringa/">Juegos Taringa!</a> (8132)</li>
							<li><a href="/comunidades/cannabis/">Fumatinga</a> (7204)</li>
							<li><a href="/comunidades/ps2games/">PlayStation 2 · Comunidad Oficia...</a> (5393)</li>

							<li><a href="/comunidades/tanite/">T! At Nite!</a> (4271)</li>
							<li><a href="/comunidades/bbcoder/">BBCoder para T! y P! - Sharkale®</a> (4215)</li>
							<li><a href="/comunidades/riverplate/">Club Atlético River Plate</a> (3770)</li>
							<li><a href="/comunidades/bocajuniors/">Club Atlético Boca Juniors</a> (3632)</li>

							<li><a href="/comunidades/guitarristas-taringueros/">Comunidad de Guitarristas Taring...</a> (3576)</li>
							<li><a href="/comunidades/ciencia-con-paciencia/">Ciencia con paciencia</a> (3163)</li>
							<li><a href="/comunidades/metaleros/">Heavy MeTaleros</a> (3102)</li>
							<li><a href="/comunidades/fansp4mm3r/">Sp4mm3r [Comunidad de Ayuda]</a> (3033)</li>

						</ol>
		</div>
	</div>
		<br class="space">

	<div class="ult_comunidades">
		<div class="box_title">
			<div class="box_txt ultimas_comunidades">&Uacute;ltimas Comunidades</div>
			<div class="box_rrs"><span class="box_rss"></span></div>

		</div>
		<div class="box_cuerpo">
			<ul class="listDisc">
							<li><a href="/comunidades/windows-linux/" class="size10">Microsoft</a></li>
							<li><a href="/comunidades/shitbrix/" class="size10">Shitbrix</a></li>
							<li><a href="/comunidades/comuninternacional/" class="size10">Comunidad Internacional</a></li>
							<li><a href="/comunidades/libertad-de-expresion/" class="size10">Deci Lo que no te gusta !!</a></li>

							<li><a href="/comunidades/anime-lovers/" class="size10">*~ Anime Lovers ~*</a></li>
							<li><a href="/comunidades/garrys-mod-comunidad-oficial/" class="size10">Garrys Mod [Comunidad Oficial]</a></li>
							<li><a href="/comunidades/final-fantasy/" class="size10">Final Fantasy</a></li>
							<li><a href="/comunidades/gmodcons/" class="size10">Gmod Constructors</a></li>
							<li><a href="/comunidades/escritorios-pc/" class="size10">Escritorios</a></li>
							<li><a href="/comunidades/garrysmodjuego/" class="size10">Garrys Mod</a></li>

							<li><a href="/comunidades/bardelospibes/" class="size10">El Bar De Los Pibes</a></li>
							<li><a href="/comunidades/d-novato-a-nfu/" class="size10">De novato a NFU</a></li>
							<li><a href="/comunidades/garrysmod1/" class="size10">Comunidad Garrys Mod</a></li>
							<li><a href="/comunidades/juegosringa/" class="size10">Juegoringa</a></li>
							<li><a href="/comunidades/cualesmejor/" class="size10">Cual Es mejor ?</a></li>
						</ul>

			<div style="background:#FFFFCC; border:1px solid #FFCC33; padding:5px;margin:5px 0 0 0;font-weight: bold; text-align:center;-moz-border-radius: 5px">
				<a href="/comunidades/crear/" style="color:#0033CC">&iquest;Qu&eacute; esperas para crear la tuya?</a>
			</div>
		</div>
	</div>

</div>
</div>

</div>';
}
?>