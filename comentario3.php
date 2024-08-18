<?php
require_once("header.php");
include("includes/bbcode.php");
$bbcode = new bbcode_zinfinal();

$user  = $_SESSION['user'];
$postid = (int) $_POST['postid'];
$comentario = no_injection(xss($_POST['comentario']));

$lastid = (int)$_POST['lastid'];
$mostrar_resp = no_injection($_POST['mostrar_resp']);

if($key==null) {
	die('0: Conectate');
}

if(empty($postid)) {
	die('0: El campo <b>ID del Post</b> es requerido para esta operacion');
}

if(empty($comentario)) {
	die('0: El campo <b>Comentario</b> es requerido para esta operacion');
}

$minuto = time() - (60);
$sqlflood = mysql_query("SELECT id 
FROM usuarios 
WHERE ultimaaccion2 BETWEEN '$minuto' AND unix_timestamp() AND id = '{$key}' ");

if(mysql_num_rows($sqlflood)){
	die('0: No puedes realizar tantas acciones en tan poco tiempo. Vuelve a intentarlo en unos instantes');
}

$q2 = mysql_query("SELECT id_autor FROM posts WHERE postid = '{$postid}'");

if(!mysql_num_rows($q2)){
	die("0: No Existe este Post");
}

$co = mysql_fetch_array($q2);
mysql_free_result($q2);

mysql_query("Update posts Set comentarios=comentarios+'1' Where postid='".$postid."'");
mysql_query("Update usuarios Set numcomentarios=numcomentarios+'1',ultimaaccion2=unix_timestamp() Where id = '".$key."'");
mysql_query("INSERT INTO comentarios (id_post, id_autor, autor, comentario, fecha) VALUES ('$postid', '$key', '$user', '$comentario', unix_timestamp())");
$idc = mysql_insert_id();

echo '1: 
<div id="div_cmnt_'.$idc.'"'.($co['id_autor'] == $key ? ' class="especial1"' : '').'>
	<span style="display:none" id="citar_comm_'.$idc.'">'.$comentario.'</span>	<div class="comentario-post clearbeta">
		<div class="avatar-box">
			<a href="/perfil/'.$user.'">
				<img width="48" height="48" style="position:relative;z-index:1" class="avatar-48 lazy" src="'.$global_user['avatar'].'" title="Avatar de '.$user.' en '.$comunidad.'" onerror="error_avatar(this, 3479239, 48)" />
			</a>
					</div>
		<div class="comment-box">

			<div class="dialog-c">
			</div>
			<div class="comment-info clearbeta">
				<div class="floatL">
				<a class="nick" href="/perfil/'.$user.'">'.$user.'</a> dijo <span title="'.date('d.m.Y').' a las '.date('H:m').' hs.">Hace instantes</span>:
				</div>
				<div class="floatR answerOptions">

				
					<ul>
										
					
					
					<li class="answerCitar"><a href="javascript:citar_comment('.$idc.', \''.$user.'\')"><span class="citarAnswer"></span></a></li>					
										
					</ul>
				</div>

									
			</div>
			<div class="comment-content">
							'.$bbcode->procesarbbcode($comentario).'						</div>
		</div>

	</div>
</div>';

?>