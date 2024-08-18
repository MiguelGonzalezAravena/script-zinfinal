<?php
include("header.php");
$destinarios	=	$_POST['email1'];
$titulo		=	$_POST['titulo'];
$cuerpo		=	$_POST['cuerpo'];
cabecera_normal();
?><div id="cuerpocontainer">
<!-- inicio cuerpocontainer -->
<?php
if (isset($_POST['action'])) {
$dest = $destinarios;
 $head = "From: noreply@tripiante.com\r\n";
 $head.= "To: $dest\r\n";
 // Ahora creamos el cuerpo del mensaje
 $msg = $cuerpo."\n";
 // Finalmente enviamos el mensaje
 
 if (mail($dest, $titulo, $msg, $head)) {
?>
<div class="container400" style="margin: 10px auto 0 auto;">

	<div class="box_title">
		<div class="box_txt show_error">Enviado!</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo"  align="center">
		<br />
		Muchas gracias por compartir <?php echo $comunidad;?> con tus amigos.<br /><br />6 han sido enviados satisfactoriamente		<br />

		<br />
		<br />
	<input type="button" class="login" style="font-size:11px" value="Volver" title="Volver" onclick="history.go(-2)">			<br />
		
	</div>
	
</div>	
		<br />
		<br />
		<br />
		<br />
<?php
 
 
 } else {
  $aviso = "Error de envío.";
}
}
pie();
?>