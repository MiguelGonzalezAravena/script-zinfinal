<?php
include("../header.php");
$respuesta = no_injection(xss($_POST['respuesta']));
$lastid = (int)$_POST['lastid']+1;
$mostrar_resp = no_injection($_POST['mostrar_resp']);
$temaid = (int)$_POST['temaid'];
$key = $_SESSION['id'];

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}
if(empty($respuesta) or empty($temaid)){
	die("0: Faltan Datos");
}
$minuto = time() - (60);
$sqlflood=$db->query("SELECT id FROM usuarios WHERE ultimaaccion2 BETWEEN '$minuto' AND unix_timestamp() AND id='{$key}'");
if($db->num_rows($sqlflood)){
	die("0: No puedes realizar tantas acciones en tan poco tiempo. Vuelve a intentarlo en unos instantes");
}
$qte=$db->query("SELECT idcomunid,cerrado FROM c_temas WHERE idte='{$temaid}'");
$tem=$db->fetch_array($qte);
$comid=$tem['idcomunid'];

if($tem['cerrado']=='on'){
	die("0: No se Permite Comentarios en este Tema Loco.");
}

$q1=$db->query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND rangoco!='1' ");
if(!$db->num_rows($q1)){
	die("0: Tenes que ser parte de la Comunidad o No Tienes Rango");
}

$inserr=$db->query("INSERT INTO c_respuestas (idtemare, idautorre, respuesta, fechare) VALUES('$temaid','$key','$respuesta', unix_timestamp())");
$i=$db->insert_id();
$db->query("UPDATE c_temas SET numco=numco+'1' WHERE idte='{$temaid}'");
$db->query("Update usuarios Set ultimaaccion2=unix_timestamp() Where id='{$key}'");
echo'1; ';

echo'<div class="respuesta clearfix  mia" id="id_'.$i.'">
	<span style="display:none" id="citar_resp_'.$i.'">'.$_POST['respuesta'].'</span>
<div class="answerInfo">
	<h3><a href="/perfil/'.$_SESSION['id'].'">'.$_SESSION['user'].'</a></h3>

</div>
<div class="answerTxt">
	<div class="answerContainer">
		<div class="Container"><img class="dialogBox" src="'.$url.'/images/dialog.gif" alt="" />
			<div class="answerOptions">
				<div class="floatL metaDataA">
					#'.$lastid.' - <span title="'.date('d.m.Y').' a las '.date('H:m:s').' hs.">Menos de 1 Minuto</span>
				</div>
				<ul class="floatR">

									<li class="answerCitar"><a title="Citar Respuesta" href="javascript:com.citar_resp(\''.$i.'\', \''.$_SESSION['user'].'\')"><span class="citarAnswer"></span></a></li>
																				</ul>
				<div class="clearBoth"></div>
			</div>
			<div class="textA">'.BBparse($_POST['respuesta']).'</div>
		</div>
	</div>
</div>
</div>';
?>