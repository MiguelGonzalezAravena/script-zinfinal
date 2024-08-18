<?php
include("../header.php");

$userid = no_injection($_POST['userid']);
$comid = no_injection($_POST['comid']);

if(empty($key)){
	die("0: Tenes que estar logueado para realizar esta accion");
}
$q1 = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$key}' AND idcomunity='{$comid}' AND rangoco='5' and estado='0'");
if(!mysql_num_rows($q1)){
	die("0: Tenes que ser parte de la Comunidad o No Tienes Rango");
}

$q2 = mysql_query("SELECT * FROM c_miembros WHERE iduser='{$userid}' AND idcomunity='{$comid}'");
if(!mysql_num_rows($q2)){
	die("0: El usuario seleccionado no pertenece a la comunidad");
}

$ma = mysql_fetch_array($q2);

mysql_free_result($q2);

echo'1: ';
if($ma['estado']==1){
	$sqluserz = mysql_query("SELECT s.*,us.nick 
FROM c_suspendidos s 
LEFT JOIN usuarios us ON us.id=s.idusersu
WHERE s.idusersu='{$userid}' and s.idcomusu='{$comid}' ORDER BY s.idsu DESC");

$dia=86400;
echo'<div class="suspendido_data">
Suspendido <a id="vermas" href="javascript:com.admin_users_vermas();">Ver m&aacute;s &raquo;</a>
<div id="ver_mas">';

while($row = mysql_fetch_array($sqluserz))
{
if($row['accionsu']==1){
	echo'suspendido por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}else if($row['accionsu']==2){
	echo'cambiado de <strong style="color:blue;">rango</strong> por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}else if($row['accionsu']==3){
	echo'desuspendido por: <a href="/perfil/'.$row['porsu'].'" target="_blank"><strong>'.$row['porsu'].'</strong></a>';
}
echo' el d&iacute;a: <strong>'.date('Y-m-d H:m:s',$row['fechasu']).'</strong>';
if($row['accionsu']==1){
	echo'<br />Raz&oacute;n: <strong style="color:red">'.$row['causasu'].'</strong><br />Duraci&oacute;n: ';
	if($row['diasu']==0){
		echo'<strong>Permanente</strong>';
	}else{
		echo'<strong>'.$row['diasu'].' d&iacute;as </strong> Hasta el: <strong>'.date('Y-m-d',$row['fechasu']+$row['diasu']*$dia).'</strong>';
	}
}else if($row['accionsu']==3){
	echo'<br />Raz&oacute;n: <strong style="color:green">'.$row['causasu'].'</strong>';
}
echo'<hr />';
}

mysql_free_result($sqluserz);

	echo'</div></div>';
}
echo'<form action="javascript:com.admin_users_save(\''.$ma['idcomunity'].'\', \''.$ma['iduser'].'\');" onclick="com.admin_users_check()">';
if($ma['estado']==1){
	echo'<div class="modalForm">
  <input id="r_rehabilitar" name="r_admin_user" type="radio"><label for="r_rehabilitar" class="mTitle">Rehabilitar</label>
  <div class="admin_user_center" onclick="set_checked(\'r_rehabilitar\')">
    <ul>
      <li class="mBlock">
        <ul>
          <li class="mColLeft">
            Causa:
          </li>

          <li class="mColRight">
            <input class="iTxt" id="t_causa" onkeypress="com.admin_users_check()" type="text">
          </li>
          <li class="cleaner"></li>
        </ul>
      </li>
    </ul>
</div>
</div>';
}else{
echo'<div class="modalForm" onclick="set_checked(\'r_suspender\')">
  <input type="radio" id="r_suspender" name="r_admin_user" /><label for="r_suspender" class="mTitle">Suspender</label>
  <div class="admin_user_center">
    <ul>
      <li class="mBlock">
        <ul>
          <li class="mColLeft">
            Causa:
          </li>
          <li class="mColRight">
            <input class="iTxt" type="text" id="t_causa" onkeypress="com.admin_users_check()" />
          </li>
          <li class="cleaner"></li>
        </ul>
      </li>
      <li class="mBlock">

        <ul>
          <li class="mColLeft">
            Tiempo:
          </li>
          <li class="mColRight">
            <input type="radio" id="r_suspender_dias1" name="r_suspender_dias" /> <label for="r_suspender_dias1">Permanente</label>
            <hr />
            <input type="radio" id="r_suspender_dias2" name="r_suspender_dias" /> <input type="text" id="t_suspender" class="mDate iTxt" onclick="set_checked(\'r_suspender_dias2\')" onkeypress="set_checked(\'r_suspender_dias2\'); com.admin_users_check()" /> <label for="r_suspender_dias2">D&iacute;as</label>

          </li>
          <li class="cleaner"></li>
        </ul>
      </li>
    </ul>
  </div>
</div>';
}
echo'
<div class="modalForm">
  <input type="radio" id="r_rango" name="r_admin_user" /> <label for="r_rango" class="mTitle">Cambiar Rango:</label>

  <div class="admin_user_center" onclick="set_checked(\'r_rango\')">
  <script>var rango_actual = \''.$ma['rangoco'].'\';</script>  
  <ul>
    <li class="mBlock">
      <ul>
        <li class="mColLeft">
          Rango Actual  :
        </li>
        <li class="mColRight">

          <strong class="orange">'.rangocomunidad($ma['rangoco']).'</strong>
        </li>
        <li class="cleaner"></li>
      </ul>
    </li>
    <li class="mBlock">
      <ul>
        <li class="mColLeft">

          Rango Nuevo:
        </li>
        <li class="mColRight">
          <select id="s_rango" onchange="com.admin_users_check()">
                    <option value="1"'.($ma['rangoco']=='1' ? ' selected="selected"' : '').'>Visitante</option>
                    <option value="2"'.($ma['rangoco']=='2' ? ' selected="selected"' : '').'>Comentador</option>
                    <option value="3"'.($ma['rangoco']=='3' ? ' selected="selected"' : '').'>Posteador</option>
                    <option value="4"'.($ma['rangoco']=='4' ? ' selected="selected"' : '').'>Moderador</option>
                    <option value="5"'.($ma['rangoco']=='5' ? ' selected="selected"' : '').'>Administrador</option>
                    </select>
        </li>
        <li class="cleaner"></li>
      </ul>
    </li>
  </ul>
  </div>

</div>
</form>';

?>