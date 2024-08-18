<?php
if (!defined('ZinFinal'))
	die('Intentado de Hack');

function AdminMain() {
	global $key,$user,$grupo_perm;
	
	if (!$grupo_perm['acceso_admin']) {
		fatal_error('Acceso Denegado','Los Permisos de tu Rango no te Permite Acceder al Panel de Administracion');
	}
	
	$subSeccion = array(
	    'creditos' => 'creditos',
	    'configuracion-web' => 'configuracion_web',
	    'configuracion-rangos' => 'configuracion_rangos',
	    'publicidad' => 'publicidad',
	    'guardar' => 'guardar',
	);
	
	if (!empty($subSeccion[@$_GET['ss']])) {
		$subSeccion[$_GET['ss']]();
	} else {
		Main();
	}
}

function Main() {
	global $key,$user,$images;
	
	template_menu('Centro de Administraci&oacute;n ZinFinal');
	
	echo '
	<tr>
	<td valign="top"><b>Bienvenido(a), '.$user.'!</b>
	<div style="margin-top: 1ex;">Este es tu Centro de Administraci&oacute;n ZinFinal. Aqu&iacute; puedes modificar la configuraci&oacute;n de la Web, ver logs, administrar usuarios, y muchas otras cosas.
	<div style="margin-top: 1ex;">Si tienes algun problema, por favor revisa la secci&oacute;n de Soporte y Cr&eacute;ditos.
	Si esa informaci&oacute;n no te sirve, puedes <a href="http://www.zinfinal.org/index.php?board=15.0" target="_blank">visitarnos para solicitar ayuda</a> acerca de tu problema.</div></div>
	</td>
	</tr>
			
	<tr>
	<td class="windowbg2" valign="top" style="height: 18ex;"><b>Informaci&oacute;n de versiones:</b>
	<br />Versi&oacute;n de la Web:
	<i id="yourVersion" style="white-space: nowrap;">ZinFinal 3.0 RC3</i>
	<br />Versi&oacute;n del Panel:
	<i style="white-space: nowrap;">ZinFinal 1.5</i><br />
	<a href="'.$url.'/index.php?action=detailedversion">(m&aacute;s detallado)</a><br />
	<br /><b>Administradores del Foro:</b> <a href="'.$url.'/index.php?action=profile;u=1">zinfinal</a></td>
	</tr>';
	
    template_fin();

}

/*INICIO Template*/
function template_menu($title) {
	global $key,$user,$images,$url;
	
	echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-top: 1ex;">
	<tr>
	<td width="150" valign="top" style=" padding-right: 10px; padding-bottom: 10px;">
	    <table width="100%" cellpadding="4" cellspacing="1" border="0" class="bordercolor">
	    <tr>
	    <td class="box_title"><div class="box_txt">Controles de la Web</div></td>
		</tr>
		
		<tr class="box_cuerpo">
		<td class="smalltext" style="line-height: 1.3; padding-bottom: 3ex;">
		<a href="'.$url.'/panel/admin/">Inicio</a><br />
		<a href="'.$url.'/panel/admin/creditos/">Cr&eacute;ditos</a><br /></td>
		</tr>

		<tr>
		<td class="box_title"><div class="box_txt">Configuraci&oacute;nes</div></td>
		</tr>
		
		<tr class="box_cuerpo">
		<td class="smalltext" style="line-height: 1.3; padding-bottom: 3ex;">
		<a href="'.$url.'/panel/admin/configuracion-web/">Caracter&iacute;sticas y Opciones</a><br />
		<a href="'.$url.'/index.php?action=manageboards">Posts</a><br />
		<a href="'.$url.'/index.php?action=manageboards">Comunidades</a><br />
		<a href="'.$url.'/panel/admin/publicidad/">Publicidad</a><br /></td>
		</tr>
		
		<tr>
		<td class="box_title"><div class="box_txt">Usuarios</div></td>
		</tr>
		
		<tr class="box_cuerpo">
		<td class="smalltext" style="line-height: 1.3; padding-bottom: 3ex;">
		<a href="'.$url.'/index.php?action=viewmembers">Usuarios</a><br />
		<a href="'.$url.'/panel/admin/configuracion-rangos/">Grupos de usuarios</a><br />
		<a href="'.$url.'/index.php?action=permissions">Permisos</a><br />
		<a href="'.$url.'/index.php?action=regcenter">Registro de Usuarios</a><br />
		<a href="'.$url.'/index.php?action=ban">Lista de Usuarios Suspendidos</a><br /></td>
		</tr>
		
		<tr>
		<td class="box_title"><div class="box_txt">Mantenimiento</div></td>
		</tr>
		
		<tr class="box_cuerpo">
		<td class="smalltext" style="line-height: 1.3; padding-bottom: 3ex;">
		<a href="'.$url.'/index.php?action=maintain">Mantenimiento de la Web</a><br /></td>
		</tr>
		
		</table>
	</td>
	
	<td valign="top">
	    <table width="100%" cellpadding="3" cellspacing="1" border="0" class="post-contenedor">
	    <tr class="titlebg">
	    <td align="center" colspan="2"><div class="post-title">'.$title.'</div></td>
	    </tr>';
}

function inputs($array) {
	
	foreach ($array as $titulo => $value) {
		echo '<tr>
			<td valign="top" width="16"></td>
			<td valign="top" ><label for="'.$value.'">'.$titulo.'</label></td>
			<td width="50%">
			<input type="text" name="'.$value.'" value="'.$global_input[$value].'" id="'.$value.'">
			</td>
			</tr>'."\n";
	}
}

function template_fin() {
	echo '</table></td></tr></table>';
}

function actualizar_config($changeArray, $update = false) {
	global $global_config;

	if (empty($changeArray) || !is_array($changeArray))
		return;

	if ($update)
	{
		foreach ($changeArray as $variable => $value)
		{
			mysql_query("
				UPDATE configuracion
				SET valor = " . ($valor === true ? 'valor + 1' : ($value === false ? 'valor - 1' : "'$value'")) . "
				WHERE variable = '$variable' LIMIT 1");
				
			$global_config[$variable] = $value === true ? $global_config[$variable] + 1 : ($value === false ? $global_config[$variable] - 1 : stripslashes($value));
		}

		return;
	}

	$replaceArray = array();
	foreach ($changeArray as $variable => $value)
	{
		// Don't bother if it's already like that ;).
		if (isset($global_config[$variable]) && $global_config[$variable] == stripslashes($value))
			continue;
		// If the variable isn't set, but would only be set to nothing'ness, then don't bother setting it.
		elseif (!isset($global_config[$variable]) && empty($value))
			continue;

		$replaceArray[] = "(SUBSTRING('$variable', 1, 255), SUBSTRING('$value', 1, 65534))";
		$global_config[$variable] = stripslashes($value);
	}

	if (empty($replaceArray))
		return;

	mysql_query("
		REPLACE INTO configuracion
			(variable, valor)
		VALUES " . implode(',', $replaceArray)." ");

}
/*FIN Template*/

function creditos() {
	global $key,$user,$images;
	template_menu('Cr&eacute;ditos');
	
	echo '
	<tr>
	<td>
	<span>ZinFinal quiere agradecer a todos los que ayudaron a desarrollar Zinfinal 2.0 RC3, aunque no son muchos el staff y no todos apoyaron, pero de u otra forma apoyaron. Por eso este proyecto no habr&iacute;a sido posible sin ustedes.<br />
	<div style="margin-top: 1ex;">Esto tambien incluye a nuestros usuarios y, especialmente, Miembros Registrados en el foro - gracias por la instalaci&oacute;n y uso de nuestro software, as&iacute; como proporcionar valiosa informaci&oacute;n, informes de fallos y opiniones.</div>
	<div style="margin-top: 2ex;"><b>Project Managers:</b> JesusArauz</div>
	<div style="margin-top: 1ex;"><b>Developers:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Support Specialists:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Mod Developers:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Documentation Writers:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Language Coordinators:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Graphic Designers:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Site team:</b> nadie</div>
	<div style="margin-top: 1ex;"><b>Marketing:</b> nadie</div>
	<div style="margin-top: 1ex;">Y para cualquiera que se nos hayamos olvidado de mensionar, gracias!!</div></span>
	</td>
	</tr>';
	
	template_fin();
}

function configuracion_web() {
	global $key,$user,$images,$url,$global_config;
	
	template_menu('Configuracion de la Web');
	
	echo '
	<tr>
	<td>Esta secci&oacute;n te permite cambiar la configuraci&oacute;n de las caracter&iacute;sticas y opciones b&aacute;sicas de la web.</td>
	</tr>
	
	<tr>
	<td>
	
	<form action="" method="post" accept-charset="UTF-8">
		<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td>
		    <table border="1" cellspacing="0" cellpadding="4" width="100%">
		    
			<tr>
			<td colspan="3">Caracter&iacute;sticas b&aacute;sicas</td>
			</tr>
			
			<tr>
			<td valign="top" width="16"></td>
			<td valign="top" ><label for="ca-pub">Codigo Google Adsense</label></td>
			<td width="50%">
			<input type="text" name="ca-pub" value="'.$global_config['ca-pub'].'"/>
			</td>
			</tr>
			
			<tr>
			<td colspan="3"><hr size="1" width="100%" /></td>
			</tr>
			
			<tr>
			<td valign="top" width="16"></td>
			<td valign="top" ><label for="mantenimiento">Activar la web en Modo Mantenimiento</label></td>
			<td width="50%">
			<input type="checkbox" name="mantenimiento" id="mantenimiento" '.($global_config['mantenimiento'] ? 'checked="checked"' : '').'/>
			</td>
			</tr>
			
			<tr>
			<td valign="top" width="16"></td>
			<td valign="top" ><label for="mantenimiento_m">Mensaje del Mantenimiento</label></td>
			<td width="50%">
			<textarea id="mantenimiento_m" name="mantenimiento_m" rows="3" cols="40">'.$global_config['mantenimiento_m'].'</textarea>
			</td>
			</tr>
			
			<tr>
			<td colspan="3"><hr size="1" width="100%" /></td>
			</tr>
			
			<tr class="windowbg2">
			<td class="windowbg2" valign="top" width="16"></td>
			<td valign="top" ><label for="userLanguage">Activar Idioma seleccionado por el usuario</label></td>
			<td class="windowbg2" width="50%">
			<input type="hidden" name="userLanguage" value="0" />
			<input type="checkbox" name="userLanguage" id="userLanguage"  checked="checked" class="check" />
			</td>
			</tr>
			
			<tr class="windowbg2">
			<td class="windowbg2"></td>
			<td valign="top" ><label for="allow_editDisplayName">&iquest;Permitirle a los usuarios modificar su nombre?</label></td>
			<td class="windowbg2" width="50%">
			<input type="hidden" name="allow_editDisplayName" value="0" />
			<input type="checkbox" name="allow_editDisplayName" id="allow_editDisplayName"  checked="checked" class="check" />
			</td>
			</tr>
			
			<tr class="windowbg2">
			<td class="windowbg2" valign="top" width="16"></td>
			<td valign="top" ><label for="allow_hideOnline">&iquest;Permitirle a los usuarios NO administradores ocultarse?</label></td>
			<td class="windowbg2" width="50%">
			<input type="hidden" name="allow_hideOnline" value="0" />
			<input type="checkbox" name="allow_hideOnline" id="allow_hideOnline"  checked="checked" class="check" />
			</td>
			</tr>
			
			<tr class="windowbg2">
			<td class="windowbg2" valign="top" width="16"><a href="http://www.zinfinal.org/index.php?action=helpadmin;help=pm_posts_per_hour" onclick="return reqWin(this.href);" class="help"><img src="http://www.zinfinal.org/Themes/miscellany/images/helptopics.gif" alt="Help" border="0" align="top" /></a></td>
			<td valign="top" ><label for="pm_posts_per_hour">N&uacute;mero de mensajes personales que pueden ser enviados por un usuario en una hora.<div class="smalltext">(0 para ilimitados, moderadores est&aacute;n exentos)</div></label></td>
			<td class="windowbg2" width="50%">
			<input type="text" name="pm_posts_per_hour" value="20" size="6" />
			</td>
			</tr>
			
			</tr>
			
			<tr>
			<td class="windowbg2" colspan="3" align="center" valign="middle">
			<input type="submit" value="Guardar" />
			</td>
			</tr>
			</table>
			</td>
			</tr>
		</table>
	</form>
	
	</td>
	</tr>
	';
	
	template_fin();
}

function publicidad() {
	global $key,$user,$images,$global_config;
	template_menu('Configuracion de la Publicidad');
	
	if($_POST['publicidad']) {
		actualizar_config(array('ca-pub' => $_POST['ca-pub']));
		echo '<tr><td><b>Los Datos de Guardaron Exitosamente</b></td></tr>';
	}
	
	echo '<tr>
	<td>Esta secci&oacute;n te permite cambiar la configuraci&oacute;n de las Publicidades. Para Obtener un Codigo ADSENSE ingresa a <a href="http://www.google.com/adsense/">Aqui</a> y Registrate.</td>
	</tr>
	
	<tr>
	<td>
	
	<form action="" method="post" accept-charset="UTF-8">
		<table width="80%" border="0" cellspacing="0" cellpadding="0" class="tborder" align="center">
		<tr>
		<td>
		    <table border="1" cellspacing="0" cellpadding="4" width="100%">
		    
			<tr>
			<td colspan="3">Caracter&iacute;sticas b&aacute;sicas</td>
			</tr>
			
			<tr>
			<td valign="top" width="16"></td>
			<td valign="top" ><label for="ca-pub">Codigo Google Adsense</label></td>
			<td width="50%">
			<input type="text" name="ca-pub" value="'.$global_config['ca-pub'].'"/>
			</td>
			</tr>
			
			</tr>
			
			<tr>
			<td class="windowbg2" colspan="3" align="center" valign="middle">
			<input type="submit" name="publicidad" value="Guardar" />
			</td>
			</tr>
			</table>
			</td>
			</tr>
		</table>
	</form>
	
	</td>
	</tr>';

	template_fin();
}

function configuracion_rangos() {
	global $key,$user,$images,$url,$global_config;
	
	template_menu('Configuracion de Rangos');
	
	$empty = empty($_GET['dato']) ? '' : "WHERE id_rango = '{$_GET['dato']}' LIMIT 1";
	
	$dbrangos = mysql_query("SELECT id_rango,nom_rango,img_rango,puntos_pordia,maxpuntos FROM rangos $empty");
	$nun_rangos = mysql_num_rows($dbrangos);
	
	echo '
	<tr>
	<td>Esta secci&oacute;n te permite cambiar la configuraci&oacute;n de todos Los Rangos de la web.</td>
	</tr>
	
	<tr>
	<td>';
	
	if ($_GET['dato']) {
		$global_input = mysql_fetch_array($dbrangos);
		mysql_free_result($dbrangos);
		
		echo '
		<form action="'.$url.'/panel/admin/configuracion-rangos/" method="post">
		<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td>
		    <table border="0" cellspacing="0" cellpadding="4" width="100%">
		    
			<tr>
			<td colspan="3">Caracter&iacute;sticas b&aacute;sicas</td>
			</tr>';
		
		inputs(array("ID" => "id_rango","Nombre" => "nom_rango","Style(imagen)" => "img_rango",
"Puntos Por Dia" => "puntos_pordia",
"N&uacute;mero de Puntos requeridos" => "maxpuntos"));
		
		echo '
						
			</tr>
			
			<tr>
			<td class="windowbg2" colspan="3" align="center" valign="middle">
			<input name="save-rango" type="submit" value="Guardar">
			</td>
			</tr>
			</table>
			</td>
			</tr>
		</table>
	</form>
';
	} elseif($_POST['save-rango']) {
		mysql_query("UPDATE rangos SET nom_rango = '{$_POST['nom_rango']}',
		img_rango = '{$_POST['img_rango']}',
		puntos_pordia = '{$_POST['puntos_pordia']}',
		maxpuntos = '{$_POST['maxpuntos']}' 
		WHERE id_rango = '{$_POST['id_rango']}'");
		
		echo '<b>El Rango se Guardo Correctamente</b>';
	} else {
		echo '
		<table class="linksList">
	    <thead><tr><th>ID</th><th>Nombre</th><th>Puntos por Dias</th><th>N&uacute;mero de Puntos requeridos</th><th>Modificar</th></tr></thead>
		<tbody>';
		
		while($rang = mysql_fetch_array($dbrangos)) {
			echo '<tr BGCOLOR="#f4f4f4">
		<td><span class="color_red">'.$rang['id_rango'].'</span></td>
		<td style="text-align: left;"><a href="/panel/admin/configuracion-rangos/'.$rang['id_rango'].'/">'.$rang['nom_rango'].'</a></td>
		<td>'.$rang['puntos_pordia'].'</td>
		<td>'.$rang['maxpuntos'].'</td>
		<td><a href="/panel/admin/configuracion-rangos/'.$rang['id_rango'].'/">Modificar</a></td>
		</tr>';
		
		}
		mysql_free_result($dbrangos);
		
		echo '</tbody></table>';
	}
		
	echo '</td></tr>';
	
	template_fin();
}

?>