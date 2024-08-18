<?php
require_once('includes/configuracion.php');
require_once('includes/funciones.php');
require_once("class/class.web.php");
require_once("class/class.seguidores.php");

session_start();

$key = $_SESSION['id'];

$zinfinal = new web_zinfinal();
$zinfinal->session();
$zinfinal->cargar_usuario($key);
$zinfinal->cabecera();

$seguidores = new seguidores($key);
$seguidores->db_notificaciones();

function cabecera_normal($index = false,$posts = false) {
	global $zinfinal,$seguidores,$comunidad,$descripcion,$titulo,$con,$url,$images,$seccion,$submenu;
	global $comid,$temaid,$key,$postid;
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html version="XHTML+RDFa 1.0"  xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
<head profile="http://purl.org/NET/erdf/profile">

	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<link rel="schema.dc" href="http://purl.org/dc/elements/1.1/" />
	<link rel="schema.foaf" href="http://xmlns.com/foaf/0.1/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

	if($index) {
		echo '<meta http-equiv="refresh" content="600" />
<meta name="keywords" content="'.$zinfinal->global_config['meta_keywords'].'" />
<link rel="alternate" type="application/atom+xml" title="&Uacute;ltimos posts" href="http://rss.taringa.net/Taringa/ultimos-post" />
<link rel="alternate" type="application/atom+xml" title="TOPs post de la semana" href="http://rss.taringa.net/Taringa/ultimos-post" />
<link rel="alternate" type="application/atom+xml" title="Usuarios TOP - &uacute;ltimos 30 d&iacute;as" href="http://rss.taringa.net/Taringa/ultimos-post" />'."\n";
	}
	
	if($posts) {
		echo '<META NAME="KEYWORDS" CONTENT="'.$postz['tags'].'"><META name="ROBOTS" content="ALL" />
<meta name="revisit-after" content="1 days" />
<meta name="title" content="'.$postz['titulo'].'" />
<meta property="dc:date" content="2010-05-20 10:04:29"/>
<meta property="dc:creator" content="'.$postz['nick'].'" />

<link rel="prev" href="/prev.php?id='.$postid.'" />
<link rel="next" href="/next.php?id='.$postid.'" />
<link rel="alternate" type="application/atom+xml" title="Comentarios del post" href="/rss/comentarios/'.$postid.'" />
<link rel="alternate" type="application/atom+xml" title="Post del usuario" href="/rss/posts-usuario/'.$postz['id'].'" />'."\n";

	}
	
	echo '
	<title>'.$comunidad.' - '.$descripcion.'</title>
<link href="'.$images.'/images/css/beta_estilos3.css?3.0" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="'.$images.'/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="'.$images.'/images/apple-icon.png" />

<link rel="search" type="application/opensearchdescription+xml" title="'.$comunidad.'" href="'.$url.'/lab/opensearch/zinfinal.xml" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="'.$images.'/images/js/es/beta_acciones2.js?6.2.0" type="text/javascript"></script>
<!--[if IE 6]>
<script src="'.$images.'/images/js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>DD_belatedPNG.fix(\'#logo a,li, li a, .systemicons, .categoriaPost,.thumb-clima\');</script>
<script src="'.$images.'/images/js/bgiframe.js"></script>
<![endif]-->

<script type="text/javascript">
var global_data={
user_key:\''.$key.'\',
postid:\''.$postid.'\',
comid:\''.$comid.'\',
temaid:\''.$temaid.'\',
img:\''.$images.'/\'
};
$(document).ready(function(){
timelib.current = 1277747299;
timelib.upd();
'.($key==null ? '' : 'notifica.popup('.$seguidores->notificaciones.');').'
})
</script>

<script type="text/javascript" src="http://partner.googleadservices.com/gampad/google_service.js"></script>

<script type="text/javascript">
  GS_googleAddAdSenseService("'.$zinfinal->global_config['ca-pub'].'");
  GS_googleEnableAllServices();
</script>

<script type="text/javascript">
  GA_googleAddAttr("k", "na");	
  </script>

<script type="text/javascript">
  GA_googleAddAttr("d", "na");
  GA_googleAddAttr("s", "na");
  GA_googleAddAttr("e", "na");
  GA_googleAddAttr("c", "general");
</script>

<script type="text/javascript">
  GA_googleUseIframeRendering();
</script>

</head>
<body>

<div class="brandday">
<div id="mask"></div>
<div id="mydialog"></div>
<div class="rtop"></div>
<div id="maincontainer">
<div id="head">
	<div id="logo">
		<a href="/" title="'.$comunidad.'" id="logoi"><img src="'.$images.'/images/space.gif" border="0" alt="'.$comunidad.'" title="'.$comunidad.'" align="top" /></a>
	</div>
<div id="banner">
<script type="text/javascript">
  GA_googleFillSlotWithSize("'.$zinfinal->global_config['ca-pub'].'", "tar_general_468_general", 468, 60);
</script>
</div>
</div>

<script type="text/javascript">
	var menu_section_actual = \''.$zinfinal->menu[$zinfinal->REQUEST_URI[1]].'\';
</script>
<div id="menu">
	<ul class="menuTabs">
		<li id="tabbedPosts" class="tabbed'.($zinfinal->menu[''] ? ' here' : '').'">
			<a href="/" onclick="menu(\'Posts\', this.href); return false;" title="Ir a Posts">Posts <img src="'.$images.'/images/arrowdown.png" alt="Drop Down" /></a>
		</li>
		<li id="tabbedComunidades" class="tabbed'.($zinfinal->menu['comunidades'] ? ' here' : '').'">
			<a href="/comunidades/" onclick="menu(\'Comunidades\', this.href); return false;" title="Ir a Comunidades">Comunidades <img src="'.$images.'/images/arrowdown.png" alt="Drop Down" /></a>
		</li>
		<li id="tabbedTops" class="tabbed'.($zinfinal->menu['top'] ? ' here' : '').'">
			<a href="/top/" onclick="menu(\'Tops\', this.href); return false;" title="Ir a TOPs">TOPs <img src="'.$images.'/images/arrowdown.png" alt="Drop Down" /></a>
		</li>';
		
		if($key == null) {
			echo '<li class="tabbed registrate">
			<a href="" onclick="registro_load_form(); return false" title="Registrate!"><b>Registrate ahora!</b></a>
		</li>';
		}
		
		echo '
		<li class="clearBoth"></li>
	</ul>';
	
	if($key == null) {
		echo '<div class="opciones_usuario anonimo">
<div class="identificarme">
	<a class="iniciar_sesion" href="javascript:open_login_box()" title="Identificarme">Identificarme</a></b>
</div>

<div id="login_box"><div class="login_header"><img style="display:none" src="'.$images.'/images/cerrar.png" class="login_cerrar" onclick="close_login_box();" title="Cerrar mensaje" /></div>
<div class="login_cuerpo">
  <span id="login_cargando" class="gif_cargando floatR"></span>
  <div id="login_error"></div>
    <form method="post" action="javascript:login_ajax()">
      <label>Usuario</label>
      <input maxlength="64" name="nick" id="nickname" class="ilogin" type="text" />
      <label>Contrase&ntilde;a</label>

      <input maxlength="64" name="pass" id="password" class="ilogin" type="password" />
      <input class="mBtn btnOk" value="Entrar" title="Entrar" type="submit" />
      <div class="floatR" style="color: #666; padding:5px;font-weight: normal; display:none">
        <input type="checkbox" /> Recordarme?
      </div>
    </form>
    <div class="login_footer">
      <strong>AYUDA</strong><br />

      <a href="/password/">
        &iquest;Olvidaste tu contrase&ntilde;a?      </a>
      <hr />
      <a href="" onclick="open_login_box(); registro_load_form(); return false" style="color:green;">
        <strong>Registrate Ahora!</strong>
      </a>
    </div>

  </div>
</div>';
	} else {
		echo '<div class="opciones_usuario">
      <style>
      	.notificaciones-list {
      		display: none;
      		background: #FFF;
      		position: absolute;
      		z-index: 300;
      		width: 300px;
      		text-align: left;
					font-weight: normal;
					color: #444;
					-moz-box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
					
					border-left: 0px solid #CCC;
					border-bototm:1px solid #CCC;
					border-right:1px solid #CCC;
      	}

      	.notificaciones-list ul {
      	
      		max-height:250px;		
      		overflow-y:auto;
      		padding: 0 10px;
      		margin: 5px 0;
      	}

		.notificaciones-list ul li:hover {
			background-color: #F7F7F7;
      	}
      	.userInfoLogin ul li div.notificaciones-list ul li {
      		display: block;
      		border-top: 1px solid #EEE!important;
      		float: none;
					padding:5px 3px;
      		border: none;
					line-height: 18px;
      		margin: 0;
      		
      	}
      	
      	.userInfoLogin ul li div.notificaciones-list ul li:hover {
      		cursor: pointer;
      	}



      	.userInfoLogin li div.notificaciones-list ul li.unread {
      		background-color: #FFFFCC!important;
      	}

      	li.monitor-notificaciones {
      		background: #FFF!important;
      	}
      	.userInfoLogin ul li div.notificaciones-list ul li a {
					display: inline;
					width: auto;
					height: auto;
					margin: 0;
					color: #007394;
					padding: 0;
					border-right: none;
					font-weight: bold;
					text-shadow: none;
      	}
      	
      	.userInfoLogin ul li div.notificaciones-list ul li a:hover {
					text-decoration: underline;
      	}
      	
      	

      	.ver-mas {
      		display: block;
      		padding: 6px;
      		text-align: center;
      		background: #EEE;
      		font-weight: bold;
      		text-shadow: none;
      		color: #0f385b;
      		border-top: #CCC 1px solid;
      	}

      	.ver-mas:hover {
      		background: #a7d1f5;
      		color: #010b13;
      		text-shadow: none;
      		border-top: #000;
      		border-top: 1px solid #5a93c3;
      	}
      	
      	
      	

      </style>
<div class="userInfoLogin">
  <ul>
    <li style="position: relative" class="monitor">

		<a name="Monitor" title="Monitor de usuario" alt="Monitor de usuario" onclick="notifica.last(); return false" href="/monitor">
			<span class="systemicons monitor"></span>
		</a>
      <div class="notificaciones-list">
				<div style="padding: 10px 10px 0 10px;font-size:13px">
					<strong onclick="location.href=\'/monitor\'" style="cursor:pointer">Notificaciones</strong>
				</div>
      	<ul>

      	</ul>
      	<a class="ver-mas" href="/monitor/">Ver m&aacute;s notificaciones</a>
      </div>
	</li>
    <li>
      <a href="/favoritos.php" title="Mis Favoritos" alt="Mis Favoritos">
        <span class="systemicons favoritos"></span>
      </a>
    </li>
    <li>
		<a href="/mis-borradores" title="Mis Borradores" alt="Mis Borradores">
			<span class="systemicons borradores"></span>
		</a>
	</li>
    <li>
      <a href="/mensajes/" title="Mensajes">
        <img src="'.$images.'/images/'.($zinfinal->global_user['sms'] ? 'new' : 'old').'Msg.png" alt="Mensajes" />
        '.($zinfinal->global_user['sms'] ? '<span style="margin-left: 5px;font-size:12px">'.$zinfinal->global_user['sms'].'</span>' : '').'
      </a>
    </li>
    <li>
      <a href="/cuenta/" title="Mi cuenta" alt="Editar mi perfil">
        <span class="systemicons micuenta"></span>
      </a>
    </li>
    <li class="usernameMenu">
      <a class="username" href="/perfil/'.$_SESSION['user'].'" title="Mi Perfil">'.$_SESSION['user'].'</a>

    </li>
    <li class="logout">
      <a title="Salir" style="vertical-align: middle" href="/logout.php?key='.$key.'">
        <span class="systemicons logout"></span>
      </a>
    </li>
  </ul>
  <div style="clear:both"></div>
</div>';
	}
	
	echo '

	</div>
	<div class="clearBoth"></div>
</div><!-- menu -->

<div class="subMenuContent">
<div class="subMenu'.($zinfinal->menu[''] ? ' here' : '').'" id="subMenuPosts">
	<ul class="floatL tabsMenu">
		<li'.($seccion=='index' ? ' class="here"' : '').'><a href="/" title="Inicio">Inicio</a></li>
		<li'.($seccion=='novatos' ? ' class="here"' : '').'><a href="/posts/novatos/" title="Novatos" style="font-weight:bold">Novatos</a></li>
		<li><a href="http://buscar.taringa.net/posts" title="Buscador">Buscador</a></li>
		';
	
	if ($key) {
		echo '
	    <li'.($seccion=='agregar' ? ' class="here"' : '').'><a href="/agregar/" title="Agregar Post">Agregar Post</a></li>
		<li><a href="/mod-history/" title="Historial de Moderaci&oacute;n">Historial</a></li>
';
	}
	
	if ($grupo_perm['acceso_panel']) {
		echo '<li><a href="/panel/" title="Panel">Panel</a></li>';
	}
	
	echo '
				<div class="clearBoth"></div>
	</ul>
  <div class="floatR filterCat">
    <span>Filtrar por Categor&iacute;as:</span>
    <select onchange="ir_a_categoria(this.value)">
			<option value="root" selected="selected">Seleccionar categor&iacute;a</option>
			<option value="-1">Ver Todas</option>
			<option value="linea">-----</option>
		';
	
	foreach($zinfinal->categorias['posts'] as $categ) {
		echo '<option value="'.$categ['link'].'">'.$categ['nombre'].'</option>
		';
	}
    
    echo '
        </select>
  </div>

	<div class="clearBoth"></div>
</div>
<div class="subMenu'.($zinfinal->menu['comunidades'] ? ' here' : '').'" id="subMenuComunidades">
	<ul class="floatL tabsMenu">
		<li><a href="/comunidades/" title="Inicio">Inicio</a></li>

<li >
	<a href="/comunidades/dir/" title="Directorio">Directorio</a>
</li>
					<li ><a href="http://buscar.taringa.net/comunidades" title="Buscador">Buscador</a></li>
				<div class="clearBoth"></div>
	</ul>
<div class="floatR filterCat">
	<span>Filtrar por Categor&iacute;as:</span>

	<select onchange="com.ir_a_categoria(this.value)">
		<option value="root" selected="selected">Seleccionar categor&iacute;a</option>
		<option value="-1">Ver Todas</option>
		<option value="linea">-----</option>
	';
	
	foreach($zinfinal->categorias['comunidades'] as $categ) {
		echo '<option value="'.$categ['link'].'">'.$categ['nombre'].'</option>
		';
	}
	
	echo '
	</select>
</div>
	<div class="clearBoth"></div>
</div>

<div class="subMenu'.($zinfinal->menu['top'] ? ' here' : '').'" id="subMenuTops">
	<ul class="floatL tabsMenu">
		<li><a href="/top/posts/">Posts</a></li>
		<li><a href="/top/comunidades/">Comunidades</a></li>
		<li><a href="/top/temas/">Temas</a></li>
		<li><a href="/top/usuarios/">Usuarios</a></li>
	</ul>

	<div class="clearBoth"></div>
</div>

<div class="subMenu" id="subMenuCapsula">
	<ul class="floatL tabsMenu">
		<li id="mi_capsula"><a href="" onclick="document.capsule.ir(\'http://www.capsula2210.com/0/vnc/mi-capsula.vnc\', \'mi_capsula\'); return false" title="Mi Capsula">Mi Capsula</a></li>
		<li id="llenar"><a href="" onclick="window.capsule.ir(\'http://www.capsula2210.com/0/vnc/participa.vnc\', \'llenar\'); return false" title="Llen&aacute; tu capsula">Llen&aacute; tu capsula</a></li>
		<li id="explorar"><a href="" onclick="capsule.ir(\'http://www.capsula2210.com/0/vnc/explora.vnc\', \'explorar\'); return false" title="Explorar">Explorar</a></li>
		<div class="clearBoth"></div>
	</ul>
	<div class="clearBoth"></div>
</div>
</div><!-- subMenuContent -->
<div id="cuerpocontainer">
<!-- inicio cuerpocontainer -->';

}

function pie()
{
	global $con, $bd_host, $bd_usuario, $bd_password, $bd_base, $comunidad;
	global $url;
	
	echo '<div style="clear:both"></div>
<!-- fin cuerpocontainer -->
</div>
<div id="pie">
<a href="/anuncie/">Anuncie en '.$comunidad.'</a> - 
<a href="http://ayuda.itaringa.net/">Ayuda</a> - 
<a href="'.$url.'/chat/">Chat</a> -
<a href="/contactenos/">Contacto</a> - 
<a href="/denuncia-publica/">Denuncias</a> - 
<a href="/enlazanos/">Enlazanos</a> - 
<a href="/mapa-del-sitio/">Mapa del sitio</a> - 
<a href="/protocolo/">Protocolo</a>
<br />
<a href="/terminos-y-condiciones/">T&eacute;rminos y condiciones</a> - <a href="/privacidad-de-datos/">Privacidad de datos</a>
</div>
</div>
<div class="rbott"></div>
<div id="footer">
</div><!--FOOTER -->

</div>
</body>
</html>';

	mysql_close($con);
}

if($zinfinal->global_config['mantenimiento']) {
	cabecera_normal();
	echo '<center>
<br />
<span style="font-size:13px;font-weight: bold;">'.$zinfinal->global_config['mantenimiento_m'].'</span><br />
<br />
<img src="'.$images.'/images/mejorastecnicas.png" title="Haciendo mejoras" hspace="15" vspace="15" />
<br />';
	pie();
	exit;
}

?>