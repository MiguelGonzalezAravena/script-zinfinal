<?php
include("header.php");
$titulo	=	$descripcion;
cabecera_normal();
$avatar = no_injection(xss($_POST["avatar"]));

if($key==null){
fatal_error('Para editar tu avatar debes autentificarte');
}

if(empty($avatar)){
fatal_error('Error de seguridad');
}

mysql_query("Update usuarios Set avatar='{$avatar}' Where id='$key'");

include("cuenta/menu.php");

echo'<div id="form_div">
<div class="container702 floatR">
<br />
<div class="container400" style="margin: 10px auto 0 auto;">
<div class="box_title">
<div class="box_txt cuenta_alerta">Confirmaci&oacute;n</div>
<div class="box_rrs"><div class="box_rss"></div></div></div>
<div class="box_cuerpo" style="text-align: center">
<br>cambio aceptado<br /><br /></div>
</div></div></div><br clear="left"><hr />';

pie();
?>