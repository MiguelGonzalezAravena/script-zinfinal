<?php
include("header.php");
cabecera_normal();

if($zinfinal->global_config['ideas-mostrar']) {
	echo '<iframe id="ideas" style="width:940px;height:600px;border:0px;margin-top:0px" src="'.$zinfinal->global_config['ideas-url'].'"></iframe>';
} else {
	$zinfinal->fatal_error('Esta opci&oacute;n se encuentra temporalmente deshabilitada.');
}

pie();
?>