<?php
include_once("../includes/configuracion.php");
include_once("../session.php");
define('ZinFinal', 1);

function no_injection($string)
{
	if(get_magic_quotes_gpc())
    	$string = stripslashes($string);
	return $string;
}

$user = $_SESSION['user'];
$key = $_SESSION['id'];

$dbconfig = mysql_query("SELECT * FROM configuracion");
$global_config = array();

while ($row = mysql_fetch_row($dbconfig))
$global_config[$row[0]] = $row[1];

mysql_free_result($dbconfig);

if($key!=null) {
	
	$dbuser = mysql_query("SELECT u.*, r.permisos 
	FROM usuarios as u 
	LEFT JOIN rangos as r ON r.id_rango = u.rango 
	WHERE u.id='{$key}'");
	
	$global_user = mysql_fetch_array($dbuser);
	mysql_free_result($dbuser);
	
	$grupo_perm = unserialize($global_user['permisos']);
}

function cabecera() {
	global $user,$key,$comunidad,$url,$images;
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html version="XHTML+RDFa 1.0"  xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt" >
<head profile="http://purl.org/NET/erdf/profile">
  <link rel="schema.dc" href="http://purl.org/dc/elements/1.1/" />
  <link rel="schema.foaf" href="http://xmlns.com/foaf/0.1/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$comunidad.' - Panel de Moderacion</title>
<link href="'.$images.'/images/css/beta_estilos3.css?1.0" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="'.$images.'/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="'.$images.'/images/apple-icon.png"/>

</head>
<body>
<div class="rtop"></div>
<div id="maincontainer">
<div id="head">

<div id="logo">
<a href="/panel/" title="'.$comunidad.'" id="logoi"><img src="'.$images.'/images/space.gif" border="0" alt="'.$comunidad.'" title="'.$comunidad.'" align="top" /></a>
</div>

<div id="banner" align="right">
<img width="90" src="http://i48.tinypic.com/2cctdp0.gif"/>
</div>

</div>

<!-- inicio menu -->
<div id="menu">

<span>
<a href="/panel/mod/denuncias/" style="font-weight:bold">Lista de Denuncias</a>
 | <a href="/panel/mod/usuarios/" style="font-weight:bold">Administracion de Usuarios</a>
 | <a href="/panel/mod/historial-mod/" style="font-weight:bold">Historial de Moderacion</a>
 | <a href="/panel/mod/historial-susp/" style="font-weight:bold">Historial de Suspencion</a>
</span>

</div>
<!-- fin menu-->

<div id="cuerpocontainer">';
}

function pie() {
	echo '<div style="clear:both"></div>
</div>
<div id="pie">
<a href="http://www.zinfinal.org/" target="_blank">Desarrollado por ZinFinal 2.0 RC3</a> |
<a href="http://www.zinfinal.org/" title="Web de Software Libre" target="_blank">ZinFinal &copy; 2004-2010, ZinFinal LLC</a>
</div>

</div>
<div class="rbott"></div>

</body>
</html>';
}

function fatal_error($titulo,$mensaje) {
	echo '<div class="container400" style="margin: 10px auto 0 auto;">
<div class="box_title">
<div class="box_txt show_error">'.$titulo.'</div>
<div class="box_rrs"><div class="box_rss"></div></div>
</div>
<div class="box_cuerpo"  align="center">
<br />'.$mensaje.'<br />
<br />
<input type="button" class="login" style="font-size:11px" value="Ir a la p&aacute;gina principal" title="Ir a la p&aacute;gina principal" onclick="location.href=\'/panel/\'">
<br />
</div>
</div>
<br />';
	pie();
	exit;
}

function protocolo() {
	
	echo '<strong>Protocolo para Moderadores</strong>
	<p>
	<ul class="menu_cuenta">
	<li>Un Moderador es un Usuario comun con mayores privilegios los cuales implican una mayor responsabilidad.</li>
	<li>Un error de uno es un error de Todos.</li>
	<li>Hacer un post puede llevar mucho tiempo y dedicacion. Y DEBE SER igualmente Proporcional al tiempo para evaluar si un post debe ser borrado o editado.</li>
	<li>No se pueden Eliminar posts editados por otros mods</li>
	<li>Un moderador NO PUEDE insultar, maltratar, trollear, ni burlarse de los demas usuarios. Si nosotros lo hacemos lo estamos permitiendo.</li>
	<li>No se pueden desuspender usuarios que suspendio otro moderador salvo que aya cumplido el tiempo de suspencion, ante cualquier inquietud hablar con el moderador que puso el suspend para llegar a un acuerdo en comun.</li>
	</ul><hr>';
}

call_user_func(panel_main());

function panel_main() {
	global $grupo_perm,$user;
	cabecera();
	
	if (!$grupo_perm['acceso_mod']) {
		fatal_error('Acceso Denegado','Los Permisos de tu Rango no te Permite Acceder al Panel de Moderacion');
	}
	
	if (empty($_REQUEST['seccion'])) {
		echo '<center><strong>Bienvenido(a), '.$user.'</strong><br><br>
		<center><input type="button" onclick="location.href=\'/panel/mod/denuncias/\'" value="Panel de Moderacion" class="login">
		<input type="button" onclick="location.href=\'/panel/admin/\'" value="Panel de Administracion" class="login"></center>';
		
		pie();
		exit;
	}
	
	$SeccionArray = array(
		'usuarios' => array('usuarios.php', 'UsuariosMain'),
		'denuncias' => array('denuncias.php', 'DenunciasMain'),
		'historial-susp' => array('historial-susp.php', 'Historial_suspMain'),
		'historial-mod' => array('historial-mod.php', 'Historial_modMain'),
		'admin' => array('admin.php', 'AdminMain'),
	);
	
	require_once($SeccionArray[$_REQUEST['seccion']][0]);
	
	return $SeccionArray[$_REQUEST['seccion']][1];
}

pie();
?>