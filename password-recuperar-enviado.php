<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();

echo '<div id="cuerpocontainer">

<div class="container400" style="margin: 10px auto 0 auto;">
	<div class="box_title">
		<div class="box_txt show_error">Atenci&oacute;n</div>
		<div class="box_rrs"><div class="box_rss"></div></div>

	</div>
	<div class="box_cuerpo"  align="center">
		<br />
		Se envi&oacute; un mensaje con instrucciones a la direcci&oacute;n de email especificada		<br />
		<br />
		<br />
	<input type="button" class="mBtn btnOk" style="font-size:13px" value="Ir a p&aacute;gina principal" title="Ir a p&aacute;gina principal" onclick="location.href=\'/\'">			<br />

		
	</div>
	
</div>	
		<br />
		<br />
		<br />
		<br />';
pie();
?>