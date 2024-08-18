<?php
include("header.php");
$titulo	=	$descripcion;
cabecera_normal();

echo '<div id="cuerpocontainer">';
include("cuenta/menu.php");

if($_POST)
{
foreach($_POST as $imagen) 
{
  if($imagen == '') { continue; }
  $imagenes .= no_injection($imagen).'@*';
}
 $imagenes = substr($imagenes, 0, (strlen($imagenes)-2));
 mysql_query("UPDATE `usuarios` SET imagenes = '".$imagenes."' WHERE id = '".$_SESSION['id']."'");
}
?>
<div id="form_div">
				<div class="container702 floatR">
			<br />
			<div class="container400" style="margin: 10px auto 0 auto;">
				<div class="box_title">

					<div class="box_txt cuenta_alerta">Confirmaci&oacute;n</div>
					<div class="box_rrs"><div class="box_rss"></div></div>
				</div>
				<div class="box_cuerpo" style="text-align: center">
					<br>
					Los cambios fueron aceptados y ser&aacute;n aplicados en los pr&oacute;ximos minutos					<br />

					<br />
												</div>
			</div>
		</div>
	</div>
	<br clear="left">
	<hr />
<?php
pie();
?>