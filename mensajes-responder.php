<?php
include('header.php');
$titulo	= $descripcion;
cabecera_normal();
$id_mensaje = (int) $_GET['id'];

if($key==null){
	fatal_error('Para ingresar a esta secci&oacute;n es necesario autentificarse.');
}

$sqlm = mysql_query("select m.asunto, m.contenido, m.fecha, m.id_receptor, s.nick 
		from mensajes as m
		inner join usuarios as s
		on m.id_emisor = s.id
		where m.id_mensaje = '".$id_mensaje."' and m.id_receptor = '".$key."'
		order by id_mensaje desc");

if(!mysql_num_rows($sqlm)){
	fatal_error('Mensaje no encontrado');
}

$leerm = mysql_fetch_array($sqlm);
mysql_free_result($sqlm);

echo '<div id="cuerpocontainer">
<script src="'.$images.'/images/js/es/mensajes.js?1.1" type="text/javascript"></script>
<div class="container230 floatL">
	<div class="box_title"><div class="box_txt mensajes_carpetas">Carpetas</div><div class="box_rss"/>
	</div></div>
	<div class="box_cuerpo">
		<img src="'.$images.'/images/icon-mensajes-recibidos.gif" align="absmiddle" /> <a href="/mensajes/" class="m-menu">Mensajes Recibidos</a> <br />

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
<input type="hidden" name="key" value="9fb8c8" /><input style="margin-top:5px;" class="button" type="submit" value="Crear carpeta" /> <input style="margin-top:5px;" class="button" type="button" value="Cancelar" onclick="mensajes_crear_carpeta_form(0)" />
</form>
</div>
</div>

</div><div class="container702 floatR">

	<div class="box_title">
		<div class="box_txt mensajes_enviar">Enviar un mensaje</div>
		<div class="box_rss"></div>
	</div>
	<div class="box_cuerpo">
  <form name="compose" action="/mensajes-enviar.php" method="post" style="padding:0px; margin:0px;">
		<div class="m-col1">De:</div>
		<div class="m-col2"><strong>'.$global_user['nick'].'</strong></div>

		<div class="m-col1">Para:</div>
		<div class="m-col2"><input name="msg_to" type="text" size="20" tabindex="0" maxlength="120" value="'.$leerm['nick'].'"> <span style="font-size:10px">(Ingrese el nombre de usuario)</span>
    </div>
		<div class="m-col1">Asunto:</div>
		<div class="m-col2"><input name="msg_subject" type="text" size="35" tabindex="1" maxlength="120" value="RE: '.$leerm['asunto'].'"></div>
		<div class="m-col1">Mensaje:</div>

		<div class="m-col2e">
			<textarea id="markItUp" name="msg_body" rows="10" style="width:590px; height:200px;" tabindex="2">


El '.date("d.m.Y", $leerm['fecha']).' a las '.date("H:m:s", $leerm['fecha']).', '.$leerm['nick'].' escribi&oacute;:
&gt;'.$leerm['contenido'].'</textarea>
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

	<div class="m-bottom"><input type="hidden" name="key" tabindex="3" value="9fb8c8"><input type="button" class="button" value="Enviar mensaje" onclick="mensajes_validar()"></div>
	</form>
</div>
<div style="clear:both"></div>
<hr />
<center>'.$publicidadz['728-90'].'</center>';

pie();
?>