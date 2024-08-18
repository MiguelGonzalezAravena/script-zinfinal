<?php
$resp = null;
require_once("recaptcha/recaptchalib.php");
include('header.php');
cabecera_normal();
$public_key = $public_key;
$msg_to = no_injection(xss($_POST["msg_to"]));
$msg_subject = no_injection(xss($_POST["msg_subject"]));
$msg_body = no_injection(xss($_POST["msg_body"]));
$recaptcha_response_field = $_POST["recaptcha_response_field"];

$recaptcha_challenge_field = htmlspecialchars($_POST["recaptcha_challenge_field"], ENT_QUOTES);
$resp = recaptcha_check_answer($private_key,$_SERVER["REMOTE_ADDR"],$recaptcha_challenge_field,$recaptcha_response_field);

if(empty($msg_subject)){
	$msg_subject = 'Sin Titulo';
}

if($key==null){
	fatal_error('Para ingresar a esta secci&oacute;n es necesario autentificarse.');
}

if(empty($msg_to)){
	fatal_error('Especifica en Receptor');
}

if(empty($msg_body)){
	fatal_error('Especifica en Mensaje');
}

if(empty($recaptcha_response_field)){
	fatal_error('Completa el c&oacute;digo de seguridad.');
}

if(!$resp->is_valid){
	die('El c&oacute;digo es incorrecto');
}

$sqlv = mysql_query("SELECT id FROM usuarios WHERE nick = '".$msg_to."' ");

if (!mysql_num_rows($sqlv)) {
	fatal_error('Lo siento, el usuario especificado no existe');
}

$newmsg = mysql_fetch_array($sqlv);
$para_id = $newmsg['id'];

mysql_query("INSERT INTO mensajes (id_emisor, id_receptor, asunto, contenido, fecha) VALUES ('$key', '$para_id', '$msg_subject', '$msg_body', NOW())");
$idm = mysql_insert_id();

echo '<div id="cuerpocontainer">
<div class="container400" style="margin: 10px auto 0 auto;">
<div class="box_title">
<div class="box_txt show_error">OK</div>
<div class="box_rrs"><div class="box_rss"></div></div>
</div>
<div class="box_cuerpo"  align="center">
<br />Mensaje enviado<br /><br /><br />
<input type="button" class="mBtn btnOk" style="font-size:13px" value="Centro de mensajes" title="Centro de mensajes" onclick="location.href=\'/mensajes/\'">	<input type="button" class="mBtn btnOk" style="font-size:13px" value="Ir a p&aacute;gina principal" title="Ir a p&aacute;gina principal" onclick="location.href=\'/\'"><br />
</div>
</div>	
<br /><br /><br /><br />';

pie();
?>