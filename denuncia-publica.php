<?php
include("header.php");
cabecera_normal();

echo '
<script type="text/javascript">
function validate_data(){
	var f=document.forms.Fdenuncia;
	var fit=\'nombre,email,post,comentarios\'.split(\',\');
	for(var i=0; i<fit.length; i++){
		if(f[fit[i]].value==\'\'){
			alert(\'El campo \' + fit[i] + \' es obligatorio.\');
			f[fit[i]].focus();
			return false;
		}
	}
	if(document.forms.Fdenuncia.post.value==\'http://\'){
		alert(\'El campo post es obligatorio.\');
		document.forms.Fdenuncia.post.focus();
		return false;
	}
	if($(\'#recaptcha_response_field\').val()==\'\'){
		alert(\'El campo captcha es obligatorio.\');
		$(\'#recaptcha_response_field\').focus();
		return false;
	}
}
</script>
<div class="container600" style="margin: 10px auto 0 auto;">
	<div class="box_title">
		<div class="box_txt denunciar_post2" style="width:592px;height:22px;text-align:center;font-size:12px">Denunciar post</div>

		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo" style="text-align:center;">
		<strong>Mecanismos de denuncia</strong><br />
		<textarea cols="65" rows="10">
En el supuesto que cualquier persona deseare formular un reclamo, queja o sugerencia en relaci&oacute;n a los servicios provistos por Taringa!, podr&aacute; recurrir al presente Mecanismo de Denuncias. 

1. Uso del Mecanismo de Denuncias
Este sistema consiste en un canal de comunicaci&oacute;n directa con Taringa!, destinado a una r&aacute;pida atenci&oacute;n de las inquietudes de los usuarios. Sin embargo podr&aacute;n hacer utilizaci&oacute;n del mismo no solo los usuarios de Taringa! sino toda persona que tuviere inter&eacute;s o el deseo de señalar determinada circunstancia acontecida en el Sitio o relacionada con el mismo.

2. Hechos que pueden reportarse
Los hechos que las personas podr&aacute;n reportar a trav&eacute;s del Mecanismo de Denuncias, no reconocen una limitaci&oacute;n establecida a priori, por consiguiente cualquier circunstancia que a criterio de la persona que efect&uacute;a el informe constituye una situaci&oacute;n irregular es susceptible de ser denunciada. 

Al solo modo de gu&iacute;a se menciona que si alguna persona fuere afectada en sus leg&iacute;timos derechos a partir de post, comentarios, mensajes u opiniones en el sitio podr&aacute; recurrir a este mecanismo como el medio id&oacute;neo para solicitar la inmediata actuaci&oacute;n de Taringa! en protecci&oacute;n de sus derecho.

Del mismo modo podr&aacute;n proceder quienes vean afectados sus derechos a partir de los links incorporados en los post o comentarios incorporados por los usuarios
Los derechos e intereses leg&iacute;timos cuya afectaci&oacute;n habilita la formulaci&oacute;n de una denuncia, podr&aacute;n responder a cualquier naturaleza,  y entre otros podr&aacute;n referirse a:

1. Derechos Personal&iacute;simos: derecho a la protecci&oacute;n de la identidad, derecho al honor, a la intimidad y a la privacidad, a la no discriminaci&oacute;n, a la integridad ps&iacute;quica, y la imagen.
2. Derechos Patrimoniales: derechos derivados de la propiedad intelectual, entre ellos los relacionados con los derechos de autor y los relativos a la propiedad industrial.
3. Derechos extrapatrimoniales: derechos morales de autor en especial los de paternidad e integridad de la obra.

El usuario ser&aacute; plenamente responsable ante Taringa! y/o terceros por el ejercicio abusivo, injustificado, o indiscriminado de este procedimiento, reput&aacute;ndose tal aquel que fuere realizado sin que existiere una causa atendible o razonable que determinara la necesidad de formular una denuncia.

3. Formulaci&oacute;n de una denuncia
Siempre que se trate de servicios brindados por Taringa! en sitio, la persona presuntamente afectada, o quien hubiera tomado conocimiento de la circunstancia irregular, deber&aacute; remitir un correo electr&oacute;nico a denuncias@taringa.net En dicho correo se deber&aacute; detallar con la mayor precisi&oacute;n posible: 
1. Cual es el contenido objeto del reclamo.
2. Los motivos en que se funda tal reclamo.
3. Los datos identificatorios y de contacto de quien env&iacute;a la denuncia.
4. Recepci&oacute;n de las denuncias

Una vez recibida la denuncia, queja, o sugerencia por parte del interesado, la misma ser&aacute; analizada por el personal de Taringa!, de acuerdo a las circunstancias particulares de cada caso.

Taringa! tomar&aacute; las medidas que correspondan de acuerdo al caso. Podr&aacute; asimismo solicitar del interesado cualquier otra informaci&oacute;n adicional que resulte necesaria para la corroboraci&oacute;n de las circunstancias que la denuncia indique.

Finalmente se tomaran todas aquellas medidas dispuestas por la ley, o las que fueren solicitadas por autoridad judicial o administrativa.
		</textarea>
		<hr />
		<form onsubmit="return validate_data();" name="Fdenuncia" action="/denuncia-publica.php" method="post">
			<b>Su nombre:</b>

			<br />
			<input type="text" size="30" name="nombre" tabindex="1" />
			<br />			
			<br />
			<b>Su e-mail:</b>
			<br />
			<input type="text" size="30" name="email" tabindex="2" />
			<br />			
			<br />

			<b>URL el post:</b>
			<br />
			<input type="text" size="45" name="post" value="http://" tabindex="3" />
			<br />
			<br />
			<b>Raz&oacute;n de la denuncia:</b>
			<br />

			<select name="razon" style="color:black; background-color: #FAFAFA; font-size:12px" tabindex="4">
				<option value="Es Racista o irrespetuoso">Es Racista o irrespetuoso</option>
				<option value="Contiene im&aacute;genes de violencia">Contiene im&aacute;genes de violencia</option>
				<option value="Viola derechos de autor">Viola derechos de autor</option>
				<option value="Contiene im&aacute;genes personales">Contiene im&aacute;genes personales</option>
				<option value="Contiene informaci&oacute;n personal">Contiene informaci&oacute;n personal</option>

				<option value="Contiene Pedofilia">Contiene Pedofilia</option>
				<option value="Otra raz&oacute;n">Otra raz&oacute;n</option>
			</select>
			<br />
			<br />
			<b>Aclaraci&oacute;n y comentarios:</b>

			<br />
			<textarea name="comentarios" cols="40" rows="5" tabindex="5"></textarea>
      <br />
      <br />
			<b>C&oacute;digo de la im&aacute;gen:</b>
			<br />
			<center>

<script type="text/javascript">var RecaptchaOptions={theme:"clean", lang:"es", tabindex:"6", custom_theme_widget:"recaptcha_widget"};</script>
<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=6Le8jQQAAAAAAGt1bzJsaHKCoLMWt6NFHupdtxf9"></script>
<noscript>
<iframe src="http://api.recaptcha.net/noscript?k=6Le8jQQAAAAAAGt1bzJsaHKCoLMWt6NFHupdtxf9" height="300" width="500" frameborder="0"></iframe><br/>
<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
</noscript>			</center>
			<br />
			<br />
			<input type="submit" class="login" style="font-size:11px" value="Enviar denuncia" title="Enviar denuncia" tabindex="7" />
			<br />
		</form>

	</div>
</div>';

pie();
?>