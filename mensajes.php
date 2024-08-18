<?php
include('header.php');
cabecera_normal();

if($key==null){
	fatal_error('Para ingresar a esta secci&oacute;n es necesario autentificarse.');
}

menu();

switch($_GET['data']) {
case "enviados":
enviados();
break;
case "eliminados":
eliminados();
break;
case "redactar":
redactar();
break;
case "leer":
leer();
break;
case "carpetas_personales":
carpetas_personales();
break;
default:
mensajes();
}

function menu() {
	global $images,$key,$global_user;
	echo '<div id="cuerpocontainer">

<script src="'.$images.'/images/js/es/mensajes.js?1.1" type="text/javascript"></script>
<div class="container230 floatL">
	<div class="box_title"><div class="box_txt mensajes_carpetas">Carpetas</div><div class="box_rss"/>
	</div></div>
	<div class="box_cuerpo">
		<img src="'.$images.'/images/icon-mensajes-recibidos.gif" align="absmiddle" /> <a href="/mensajes/" class="m-menu">Mensajes Recibidos</a>'.($global_user['sms'] ? ' ('.$global_user['sms'].')' : '').'<br />
		<img src="'.$images.'/images/icon-mensajes-enviados.gif" align="absmiddle" /> <a href="/mensajes/enviados/" class="m-menu">Mensajes Enviados</a><br />
		<img src="'.$images.'/images/icon-mensajes-eliminados.gif" align="absmiddle" /> <a href="/mensajes/eliminados/" class="m-menu">Mensajes Eliminados</a><br /><br />
		<img src="'.$images.'/images/icon-escribir-mensaje.gif" align="absmiddle" /> <a href="/mensajes/redactar/"  class="m-menu">Escribir mensaje</a><br /><br />
		Carpetas personales:<br />
No hay carpetas creadas.<br /><br />
<div id="crear_carpeta_link" onclick="mensajes_crear_carpeta_form(1);return false;" onmouseover="this.style.cursor=\'pointer\'">+ Crear carpeta<br /><br /></div>
<div id="crear_carpeta_div" style="display:none">
<form method=post action="/mensajes-carpeta-crear.php">
Crear nueva carpeta:<br />
<input type="text" name="carpeta_nombre" size="30" /><br />
<input type="hidden" name="key" value="'.$key.'" /><input style="margin-top:5px;" class="button" type="submit" value="Crear carpeta" /> <input style="margin-top:5px;" class="button" type="button" value="Cancelar" onclick="mensajes_crear_carpeta_form(0)" />
</form>
</div></div></div>';
}

function mensajes() {
	global $con,$key;
	$sqlm = mysql_query("select m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_receptor, s.id, s.nick
		from mensajes as m
		inner join usuarios as s on m.id_emisor = s.id
		where m.id_receptor = '".$key."' and m.id_carpeta='0' and m.papelera_receptor='0' and m.eliminado_receptor='0'
		order by id_mensaje desc");
		
	echo '<form name="mensajes" method="GET">

		<div class="container702 floatR">
			<div id="m-mensaje" style="display:none;"></div>
      <div class="box_title">
				<div class="box_txt mensajes_titulo">Carpeta: inbox</div>
				<div class="box_rss"></div>
			</div>
			
			<div class="box_cuerpo" style="padding:0">
				<div class="m-top">

					<div class="m-opciones"></div>
					<div class="m-remitente">Remitente</div>
										<div class="m-asunto">Asunto</div><div class="m-fecha">Fecha</div>
				</div>';
	while ($menz = mysql_fetch_array($sqlm)) {
		echo '<div class="m-linea-mensaje'.($menz['leido_receptor'] == '1' ? '-open' : '').'">
					<div class="m-opciones'.($menz['leido_receptor'] == '1' ? '-open' : '').'"><input name="m_'.($menz['leido_receptor'] == '1' ? 'o' : 'c').'_'.$menz['id_mensaje'].'" type="checkbox"> <a href="/mensajes/leer/'.$menz['id_mensaje'].'" alt="Leer mensaje" title="Leer mensaje"><img src="'.$images.'/images/icon-email'.($menz['leido_receptor'] == '1' ? '-open' : '').'.png" align="texttop" border="0"></a></div>
					<div class="m-remitente'.($menz['leido_receptor'] == '1' ? '-open' : '').'"><a href="/perfil/'.$menz['id'].'"  alt="Ver Perfil" title="Ver Perfil">'.$menz['nick'].'</a></div>
					<div class="m-asunto'.($menz['leido_receptor'] == '1' ? '-open' : '').'"><a href="/mensajes/leer/'.$menz['id_mensaje'].'"  alt="Leer mensaje" title="'.$menz['asunto'].'">'.$menz['asunto'].'</a></div>
					<div class="m-fecha'.($menz['leido_receptor'] == '1' ? '-open' : '').'">'.$menz['fecha'].'</div>
				</div>';
	}
	
	mysql_free_result($sqlm);
	
	echo '<div class="m-bottom">
				  <div class="m-seleccionar">

Seleccionar: <a class="m-seleccionar-text" href="#" onclick="mensajes_check(1);return false;">Todos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(2);return false;">Ninguno</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(3);return false;">Le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(4);return false;">No le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(5);return false;">Invertir</a>
				  </div>
					<div class="m-borrar">

<input type="button" class="button" value="Eliminar" onclick="mensajes_eliminar(\'9fb8c8\')">
							<select name="marcar" onchange="mensajes_acciones(\'9fb8c8\')">
								<option value="0">Acciones:</option>
								<option value="L">Marcar como le&iacute;do</option>
								<option value="NL">Marcar como no le&iacute;do</option>
							</select> 
</div>

				  				</div>
			</div>
		</div>
		</form>
	<div style="clear:both"></div>
	<hr />';

}

function enviados() {
	global $con,$key;
	$sqlm = mysql_query("select m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_emisor, s.id, s.nick 
		from mensajes as m
		inner join usuarios as s
		on m.id_receptor = s.id
		where m.id_emisor = '".$key."' and eliminado_emisor='0'
		order by id_mensaje desc");
		
	echo '<form name="mensajes" method="GET">

		<div class="container702 floatR">
			<div id="m-mensaje" style="display:none;"></div>
      <div class="box_title">
				<div class="box_txt mensajes_titulo">Carpeta: outbox</div>
				<div class="box_rss"></div>
			</div>
			
			<div class="box_cuerpo" style="padding:0">
				<div class="m-top">

					<div class="m-opciones"></div>
					<div class="m-remitente">Destinatario</div>
										<div class="m-asunto">Asunto</div><div class="m-fecha">Fecha</div>
				</div>';
	while ($menz = mysql_fetch_array($sqlm)) {
		echo '<div class="m-linea-mensaje'.($menz['leido_emisor'] == '1' ? '-open' : '').'">
					<div class="m-opciones'.($menz['leido_emisor'] == '1' ? '-open' : '').'"><input name="m_'.($menz['leido_emisor'] == '1' ? 'o' : 'c').'_'.$menz['id_mensaje'].'" type="checkbox"> <a href="/mensajes/leer/'.$menz['id_mensaje'].'" alt="Leer mensaje" title="Leer mensaje"><img src="'.$images.'/images/icon-email'.($menz['leido_emisor'] == '1' ? '-open' : '').'.png" align="texttop" border="0"></a></div>
					<div class="m-remitente'.($menz['leido_emisor'] == '1' ? '-open' : '').'"><a href="/perfil/'.$menz['id'].'"  alt="Ver Perfil" title="Ver Perfil">'.$menz['nick'].'</a></div>
					<div class="m-asunto'.($menz['leido_emisor'] == '1' ? '-open' : '').'"><a href="/mensajes/leer/'.$menz['id_mensaje'].'"  alt="Leer mensaje" title="'.$menz['asunto'].'">'.$menz['asunto'].'</a></div>
					<div class="m-fecha'.($menz['leido_emisor'] == '1' ? '-open' : '').'">'.$menz['fecha'].'</div>
				</div>';
	}
	
	echo '<div class="m-bottom">
				  <div class="m-seleccionar">
Seleccionar: <a class="m-seleccionar-text" href="#" onclick="mensajes_check(1);return false;">Todos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(2);return false;">Ninguno</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(3);return false;">Le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(4);return false;">No le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(5);return false;">Invertir</a>

				  </div>
					<div class="m-borrar">
<input type="button" class="button" value="Eliminar" onclick="mensajes_eliminar(\'9fb8c8\')">
							<select name="marcar" onchange="mensajes_acciones(\'9fb8c8\')">
								<option value="0">Acciones:</option>
								<option value="L">Marcar como le&iacute;do</option>
								<option value="NL">Marcar como no le&iacute;do</option>
							</select> 
</div>
				  				</div>
			</div>
		</div>
		</form>
	<div style="clear:both"></div>
	<hr />';
	
}

function eliminados() {
	global $con,$key;
	$sqlm = mysql_query("select m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_receptor, s.id, s.nick
		from mensajes as m
		inner join usuarios as s on m.id_emisor = s.id
		where m.id_receptor = '".$key."' and m.id_carpeta='0' and m.papelera_receptor = '1' and m.eliminado_receptor = '0'
		order by id_mensaje desc");
		
	echo '<form name="mensajes" method="GET">

		<div class="container702 floatR">
			<div id="m-mensaje" style="display:none;"></div>
      <div class="box_title">
				<div class="box_txt mensajes_titulo">Carpeta: trash</div>
				<div class="box_rss"></div>
			</div>
			
			<div class="box_cuerpo" style="padding:0">
				<div class="m-top">

					<div class="m-opciones"></div>
					<div class="m-remitente">Remitente</div>
					<div class="m-destinatario">Destinatario</div>					<div class="m-asunto-carpetas">Asunto</div><div class="m-fecha">Fecha</div>
				</div>
				<div class="m-linea-mensaje-open">
					<div class="m-opciones-open"><input name="m_o_101775" type="checkbox"> <a href="/mensajes/leer/101775" alt="Leer mensaje" title="Leer mensaje"><img src="'.$images.'/images/icon-email-open.png" align="texttop" border="0"></a></div>

					<div class="m-remitente-open"><a href="/perfil/3164170"  alt="Ver Perfil" title="Ver Perfil">josefano</a></div>
					<div class="m-destinatario-open"><a href="/perfil/3479239"  alt="Ver Perfil" title="Ver Perfil">zinfinal2010</a></div>					<div class="m-asunto-carpetas-open"><a href="/mensajes/leer/101775"  alt="Leer mensaje" title="RE: provandoo">RE: provandoo</a></div>
					<div class="m-fecha-open">2010-01-07 17:44:36</div>
				</div>
				<div class="m-bottom">
				  <div class="m-seleccionar">

Seleccionar: <a class="m-seleccionar-text" href="#" onclick="mensajes_check(1);return false;">Todos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(2);return false;">Ninguno</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(3);return false;">Le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(4);return false;">No le&iacute;dos</a>, <a class="m-seleccionar-text" href="#" onclick="mensajes_check(5);return false;">Invertir</a>
				  </div>
					<div class="m-borrar">

<input type="button" class="button" value="Eliminar definitivamente" onclick="mensajes_eliminar_2(\'9fb8c8\')">
							<select name="marcar" onchange="mensajes_acciones(\'9fb8c8\')">
								<option value="0">Acciones:</option>
								<option value="L">Marcar como le&iacute;do</option>
								<option value="NL">Marcar como no le&iacute;do</option>
							</select> 
</div>

				  				</div>
<p style="text-align:center;"><a class="m-seleccionar-text" href="#" onclick="mensajes_vaciar_eliminados(\'9fb8c8\'); return false;">Vaciar la carpeta de Mensajes Eliminados ahora</a></p>
			</div>
		</div>
		</form>
	<div style="clear:both"></div>
	<hr />';
}

function leer() {
	global $con,$key;
	
	$id_mensaje = (int) $_GET['mensaje'];
	
	$sqlm = mysql_query("select m.*,s.id,s.nick 
		from mensajes as m
		inner join usuarios as s
		on m.id_emisor = s.id
		where m.id_mensaje = '".$id_mensaje."' and m.id_receptor = '".$key."'
		order by id_mensaje desc LIMIT 1");
	
	if(!mysql_num_rows($sqlm)){
		fatal_error('Mensaje no encontrado');
	}
	
	$leerm = mysql_fetch_array($sqlm);
	mysql_free_result($sqlm);
	
	if($leerm['leido_receptor'] == '0' and $key == $leerm['id_receptor']) {
		mysql_query("Update mensajes Set leido_receptor='1' where id_mensaje='".$id_mensaje."' and id_receptor = '".$key."'");
	}
	if($leerm['leido_emisor'] == '0' and $key == $leerm['id_emisor']) {
		mysql_query("Update mensajes Set leido_emisor='1' where id_mensaje='".$id_mensaje."' and id_emisor = '".$key."'");
	}
	
	echo '<form name="mensaje">

		<div class="container702" style="width:702px;float:left;padding-left:5px;">
			<div class="box_title">
				<div class="box_txt mensajes_ver" style="width:694px;height:2px;text-align:center;font-size:12px">'.$leerm['asunto'].'</div>
				<div class="box_rss"></div>
			</div>
			<div class="box_cuerpo" style="width:686px">
				<div class="m-col1">De:</div>
				<div class="m-col2"><strong><a href="/perfil/'.$leerm['id'].'" alt="Ver Perfil" title="Ver Perfil">'.$leerm['nick'].'</a></strong></div>

				<div class="m-col1">Enviado:</div>
				<div class="m-col2">'.$leerm['fecha'].'</div>
				<div class="m-col1">Asunto:</div>
				<div class="m-col2">'.$leerm['asunto'].'</div>
				<div class="m-col1">Mensaje:</div>
				<div class="m-col2m"><br />'.BBparse($leerm['contenido']).'<br /></div>

				<br clear="left" />
			</div>
			<div class="m-bottom">
				<div class="m-borrar" style="width:700px;"><input type="button" class="button" value="Responder" onclick="mensajes_responder_actual(\''.$id_mensaje.'\')">&nbsp;&nbsp;<input type="button" class="button" value="Eliminar" onclick="mensajes_eliminar(\''.$key.'\',\''.$id_mensaje.'\')">&nbsp;&nbsp;<input type="button" class="button" value="Marcar como no le&iacute;do" onclick="mensajes_acciones(\''.$key.'\',\''.$id_mensaje.'\')">
        </div>
			</div>
		</div>
		</form>
		<br clear="left" />

		<br clear="left" />
		<hr />';

}

function redactar() {
	global $con,$key,$public_key,$global_user,$images;
	
	echo '<div class="container702 floatR">

	<div class="box_title">
		<div class="box_txt mensajes_enviar">Enviar un mensaje</div>
		<div class="box_rss"></div>
	</div>
	<div class="box_cuerpo">
  <form name="compose" action="/mensajes-enviar.php" method="post" style="padding:0px; margin:0px;">
		<div class="m-col1">De:</div>
		<div class="m-col2"><strong>'.$global_user['nick'].'</strong></div>

		<div class="m-col1">Para:</div>
		<div class="m-col2"><input name="msg_to" type="text" size="20" tabindex="0" maxlength="120" value="'.$_GET['a'].'"> <span style="font-size:10px">(Ingrese el nombre de usuario)</span>
    </div>
		<div class="m-col1">Asunto:</div>
		<div class="m-col2"><input name="msg_subject" type="text" size="35" tabindex="1" maxlength="120" value=""></div>
		<div class="m-col1">Mensaje:</div>

		<div class="m-col2e">
			<textarea id="markItUp" name="msg_body" rows="10" style="width:590px; height:200px;" tabindex="2"></textarea>
			<div id="emoticons" style="float:left">
								<a href="#" smile=":)"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-286px; clip:rect(286px 16px 302px 0px);" alt="sonrisa" title="sonrisa" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=";)"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-308px; clip:rect(308px 16px 324px 0px);" alt="gui&ntilde;o" title="gui&ntilde;o" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":roll:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-330px; clip:rect(330px 16px 346px 0px);" alt="duda" title="duda" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":P"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-352px; clip:rect(352px 16px 368px 0px);" alt="lengua" title="lengua" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":D"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-374px; clip:rect(374px 16px 390px 0px);" alt="alegre" title="alegre" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>

				<a href="#" smile=":("><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-396px; clip:rect(396px 16px 412px 0px);" alt="triste" title="triste" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile="X("><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-418px; clip:rect(418px 16px 434px 0px);" alt="odio" title="odio" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":cry:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-440px; clip:rect(440px 16px 456px 0px);" alt="llorando" title="llorando" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":twisted:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-462px; clip:rect(462px 16px 478px 0px);" alt="endiablado" title="endiablado" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":|"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-484px; clip:rect(484px 16px 500px 0px);" alt="serio" title="serio" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":?"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-506px; clip:rect(506px 16px 522px 0px);" alt="duda" title="duda" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":cool:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-528px; clip:rect(528px 16px 544px 0px);" alt="picaro" title="picaro" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":oops:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-550px; clip:rect(550px 16px 566px 0px);" alt="timido" title="timido" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile="^^"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-572px; clip:rect(572px 16px 588px 0px);" alt="sonrizota" title="sonrizota" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>

				<a href="#" smile="8|"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-594px; clip:rect(594px 16px 610px 0px);" alt="increible!" title="increible!" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
				<a href="#" smile=":F"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-616px; clip:rect(616px 16px 632px 0px);" alt="babaaa" title="babaaa" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
			</div>
			<script type="text/javascript">function openpopup(){var winpops=window.open("/emoticones.php","","width=180px,height=500px,scrollbars,resizable");}</script>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'javascript:openpopup()\'>M&aacute;s Emoticones</a>
		</div>
				<div class="m-col1">C&oacute;digo:</div>

		<div class="m-col2">
			<div id="recaptcha_ajax">
				<div id="recaptcha_image"></div>
				<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
			</div>
		</div>
		<script type="text/javascript">
			$.getScript(
				\'http://api.recaptcha.net/js/recaptcha_ajax.js\',
				function(){ Recaptcha.create(\''.$public_key.'\', \'recaptcha_ajax\', { theme:\'custom\', lang:\'es\', tabindex:\'13\', custom_theme_widget: \'recaptcha_ajax\' }); }
			);
		</script>
				<br clear="left">	
	</div>

	<div class="m-bottom"><input type="hidden" name="key" tabindex="3" value="'.$key.'"><input type="button" class="button" value="Enviar mensaje" onclick="mensajes_validar()"></div>
	</form>
</div>
<div style="clear:both"></div>
<hr />';
}

echo '<center><script type="text/javascript">
  GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "tar_general_728_general", 728, 90);
</script></center>';

pie();
?>