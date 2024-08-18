<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();
$anick = no_injection($_GET['anick']);
$aid = no_injection($_GET['aid']);
$id = no_injection($_GET['id']);
$t = no_injection($_GET['t']);

if($key==null){
	fatal_error('No pod&eacute;s hacer una denuncia si no est&aacute;s autentificado');
}
echo'<div id="cuerpocontainer">
<!-- inicio cuerpocontainer -->
<div class="container400" style="height:350px;width:400px;margin: 10px auto 0 auto;">
	<div class="box_title">
		<div class="box_txt denunciar_post" style="width:392px;height:22px;text-align:left;font-size:12px">Denunciar post</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo" align="center">
		<form action="/denuncia.php" method="post">

			<b>Denunciar el post:</b>
			<br />
			'.$id.' / '.$t.'			<br />
			<br />
			<b>Creado por:</b>
			<br />
			'.$anick.'			<br />			
			<br />

			<b>Raz&oacute;n de la denuncia:</b>
			<br />
			<select name="razon" style="color:black; background-color: #FAFAFA; font-size:12px">
				<option value="0">Re-post</option>
				<option value="1">Se hace Spam</option>
				<option value="2">Tiene links muertos</option>

				<option value="3">Es Racista o irrespetuoso</option>
				<option value="4">Contiene informaci&oacute;n personal</option>
				<option value="5">El Titulo esta en may&uacute;scula</option>
				<option value="6">Contiene Pedofilia</option>
				<option value="7">Es Gore o asqueroso</option>

				<option value="8">Est&aacute; mal la fuente</option>
				<option value="9">Post demasiado pobre / Crap</option>
				<option value="10">'.$comunidad.' no es un foro</option>
				<option value="11">No cumple con el protocolo</option>
				<option value="12">Otra raz&oacute;n (especificar)</option>

			</select>
			<br />
			<br />
			<b>Aclaraci&oacute;n y comentarios:</b>
			<br />
			<textarea name="cuerpo" cols="40" rows="5" wrap="hard" tabindex="6"></textarea>
			<br />

			<span class="size9">En el caso de ser Re-post se debe indicar el link del post original.</span>
			<br />
			<br />
			<input type="hidden" name="id" value="'.$id.'">
			<input type="submit" class="login" style="font-size:11px" value="Enviar denuncia" title="Enviar denuncia">
			<br />
			<br />
		</form>

	</div>
</div>';
pie();
?>