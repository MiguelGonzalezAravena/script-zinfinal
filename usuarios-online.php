<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();
$cn = 0;
$result = false;

$q = mysql_query("SELECT * FROM usuarios WHERE activacion = 1 
ORDER BY ultimaaccion DESC");
$numero = mysql_num_rows($q);

echo'<div id="cuerpocontainer">

<div class="container740 floatL">

	<div class="box_title">
		<div class="box_txt usuarios_online">Usuarios online</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo">
		<table width="100%" border="0">

			<tr>
				<td width="11%" height="30"><strong>Filtrar:</strong></td>
				<td width="32%">Hombres <input type="radio" name="sexo" id="sexoM" value="m" /> Mujeres <input type="radio" name="sexo" id="sexoF" value="f" /> Ambos sexos <input name="sexo" type="radio" id="sexoA" value="a" checked /></td>
				<td width="14%">S&oacute;lo con fotos<input type="checkbox" name="foto" id="foto" /></td>
				<td width="19%"><input type="button"  class="button" value="Filtrar" onclick="location.href=\'/usuarios-online/0/\'+(document.getElementById(\'sexoM\').checked?\'m\':(document.getElementById(\'sexoF\').checked?\'f\':\'a\'))+\'/\'+(document.getElementById(\'foto\').checked?1:0);" /></td>

			</tr>
		</table>
	</div>
	<br />
		<div class="box_title">
			<div class="box_txt usuarios_registrados_online">Usuarios registrados online: '.$numero.'</div>
			<div class="box_rrs"><div class="box_rss"></div></div>
		</div>

		<div class="box_cuerpo">';
while($conect = mysql_fetch_array($q)) {
	$cn++;

	echo '<div class="container340 floatL">
			<a href="/perfil/'.$conect['nick'].'">
				<img border="0" src="'.$conect['avatar'].'" height="100" align="left" hspace="5" onerror="error_avatar(this)">
     		</a>
			<a href="/perfil/'.$conect['nick'].'"><strong>'.$conect['nick'].'</strong></a><br />'.$conect['ciudad'].'<br />'.($conect['sexo'] == 'f' ? 'Mujer' : 'Hombre').'<br />
			<img src="'.$images.'/images/icon-perfil.png" align="absmiddle" border="0" hspace="3" vspace="2"  /><a href="/perfil/'.$conect['nick'].'">Ver Perfil</a><br />
			<img src="'.$images.'/images/icon-fotos.png" align="absmiddle" border="0" hspace="3" vspace="2" />Con fotos<br />
			<img src="'.$images.'/images/msg.gif" widht="16" height="16" alt="Escribir un mensaje" title="Escribir un mensaje" align="absmiddle" hspace="3" vspace="2"  border="0"> <a href="/mensajes/a/'.$conect['nick'].'">Enviar mensaje</a><br />
		</div>';
	
	if($cn % 2 == 0) {
		echo "\n<br clear=\"left\" /><hr /><br clear=\"left\" />\n";
	}
	if($numero==$cn) {
		echo "\n<br clear=\"left\" /><hr /><br clear=\"left\" />\n";		
	}
}

echo '				
		<center>
		<b> 1 </b>
 | <a href="/usuarios-online/16/a/0">2</a> | <a href="/usuarios-online/32/a/0">3</a> | <a href="/usuarios-online/48/a/0">4</a> | <a href="/usuarios-online/64/a/0">5</a> | <a href="/usuarios-online/80/a/0">6</a> | <a href="/usuarios-online/96/a/0">7</a> | <a href="/usuarios-online/112/a/0">8</a> | <a href="/usuarios-online/128/a/0">9</a>		<a href="/usuarios-online/16/a/0"><b>Siguiente &raquo;</b></a>		</center>

	</div>
	<br clear="left" />
</div>
<div class="container170 floatR">
	<div class="box_title">
		<div class="box_txt usuarios_online_anunciantes">Anunciantes</div>
			<div class="box_rrs"><div class="box_rss"></div>
		</div>
	</div>

	<div class="box_cuerpo">
	'.$publicidadz['160-600'].'
	</div>
</div>';

pie();
?>