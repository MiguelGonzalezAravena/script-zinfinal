<?php
class registro {
	public $key;
		
	public function registrando() {
		global $comunidad, $url, $private_key;
		
		require_once("includes/recaptchalib.php");
		
		$resp = recaptcha_check_answer($private_key,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		$send = array('nick','password','email','sexo','provincia','ciudad');
		
		foreach ($send as $key => $value) {
			if (empty($_POST[$value]))
			    die(''.$value.': El campo es requerido');
		}
		
		if ($this->check_nick($_POST["nick"]))
			die('nick: El nombre de usuario ya se encuentra registrado por otra persona');
		
		if($_POST["nick"] == $_POST["password"])
			die('password: La contrase&ntilde;a tiene que ser distinta que el nick');
		
		if ($this->check_email($_POST["email"]))
			die('email: El email ya est&aacute; en uso');
		
		if(empty($_POST["dia"]) or empty($_POST["mes"]) or empty($_POST["anio"]))
			die('nacimiento: El campo es requerido');
		
		if(empty($_POST["recaptcha_challenge_field"]) or empty($_POST["recaptcha_response_field"]))
			die('recaptcha: El campo es requerido');
		
		if(!$resp->is_valid)
			die('recaptcha: El c&oacute;digo es incorrecto');
		
		$id_session = md5(uniqid(rand(), true));
		
		mysql_query("INSERT INTO usuarios (id_zinfinal,rango,nick,password,email,pais,provincia,ciudad,sexo,dia,mes,ano,fecha) 
		VALUES ('{$id_session}','11','{$_POST["nick"]}',md5('{$_POST["password"]}'),'{$_POST["email"]}','{$_POST["pais"]}','{$_POST["provincia"]}','{$_POST["ciudad"]}','{$_POST["sexo"]}','{$_POST["dia"]}','{$_POST["mes"]}','{$_POST["ano"]}',unix_timestamp())");
		
		$userid = mysql_insert_id();
		
		mysql_query("INSERT INTO usuarios_perfil (id) VALUES ($userid)");
		
		$asunto = "$comunidad: Confirmacion de email";
		$mensajeserver = "Hola {$_POST["nick"]}:<br>Bienvenido a $comunidad<br>Para confirmar tu direcci&oacute;n de correo electr&oacute;nico ingresa al siguiente link:<br><a href='$url/registro-confirmar.php?k={$id_session}'>$url/registro-confirmar.php?k={$id_session}</a>  <br><br> Muchas gracias, y que lo disfrutes!<br>El staff de $comunidad.<br><br>";
		$encabezados = "From: $email_server\nReply-To: $email_server\nContent-Type: text/html; charset=utf-8";
		
		mail($_POST["email"], $asunto, $mensajeserver, $encabezados);
		die('1: Te hemos enviado un correo a <b>'.$_POST["email"].'</b> con los últimos pasos para finalizar con el registro.<br /><br />Si en los próximos minutos no lo encuentras en tu bandeja de entrada, por favor, revisa tu carpeta de correo no deseado, es posible que se haya filtrado.<br /><br />¡Muchas gracias!');
	}
	
	public function check_nick($nick) {
		$db = mysql_query("SELECT nick FROM usuarios WHERE nick = '{$nick}'");
		if (mysql_num_rows($db))
		    return true;
	}
	
	public function check_email($email) {
		$db = mysql_query("SELECT mail FROM usuarios WHERE mail = '{$email}'");
		if(mysql_num_rows($db))
		    return true;
	}
	
	public function formulario() {
	global $public_key,$images;
	
	echo '
	<div id="RegistroForm">
	<!-- Paso Uno -->
	<div class="pasoUno">
		<div class="form-line">
			<label for="nick">Nombre de usuario</label>
			<input type="text" id="nick" name="nick" tabindex="1" onblur="registro.blur(this)" onfocus="registro.focus(this)" onkeyup="registro.set_time(this.name)" onkeydown="registro.clear_time(this.name)" autocomplete="off" title="Ingrese un nombre de usuario &uacute;nico" /> <div class="help"><span><em></em></span></div>
		</div>
		<div class="form-line">
			<label for="password">Contrase&ntilde;a deseada</label>
			<input type="password" id="password" name="password" tabindex="2" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese una contrase&ntilde;a segura" /> <div class="help"><span><em></em></span></div>
		</div>
		<div class="form-line">
			<label for="password2">Confirme contrase&ntilde;a</label>
			<input type="password" id="password2" name="password2" tabindex="3" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Vuelva a introducir la contrase&ntilde;a" /> <div class="help"><span><em></em></span></div>
		</div>
		<div class="form-line">
			<label for="email">E-mail</label>
			<input type="text" id="email" name="email" tabindex="4" onblur="registro.blur(this)" onfocus="registro.focus(this)" onkeyup="registro.set_time(this.name)" onkeydown="registro.clear_time(this.name)" autocomplete="off" title="Ingrese su email" /> <div class="help"><span><em></em></span></div>
		</div>
		<div class="form-line">
			<label>Fecha de Nacimiento</label>
			<select id="dia" name="dia" tabindex="5" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese d&iacute;a de nacimiento">
				<option value="">D&iacute;a</option>
				';
				
				for ($i = 1; $i < 32; $i++) {
					echo '
					<option value="'.$i.'">'.$i.'</option>
					';
				}
				
				echo '
						</select>
			<select id="mes" name="mes" tabindex="6" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese mes de nacimiento">
				<option value="">Mes</option>
				<option value="1">Enero</option>
				<option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
			</select>

			<select id="anio" name="anio" tabindex="7" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese a&ntilde;o de nacimiento">
				<option value="">A&ntilde;o</option>
				            ';
				            
				            for ($i = 1992; $i >= 1900; $i--) {
				                echo '
				                <option value="'.$i.'">'.$i.'</option>
				                ';
				            }
				            
				            echo '
				            
						</select> <div class="help"><span><em></em></span></div>

		</div>
		<div class="clearfix"></div>
	</div>
	<!-- Paso Dos -->
	<div class="pasoDos">
		<div class="form-line">
			<label for="sexo">Sexo</label>
			<input class="radio" type="radio" id="sexo_m" tabindex="8" name="sexo" value="m" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese el sexo" /> <label class="list-label" for="sexo_m">Masculino</label>
			<input class="radio" type="radio" id="sexo_f" tabindex="8" name="sexo" value="f" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese el sexo" /> <label class="list-label" for="sexo_f">Femenino</label>
			<div class="help"><span><em></em></span></div>
		</div>
		<div class="form-line">
			<label for="pais">Pa&iacute;s</label>
			<select id="pais" name="pais" tabindex="9" onblur="registro.blur(this)" onchange="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese su pa&iacute;s">
				<option value="">Pa&iacute;s</option>';
				
				echo '
				<option value="AR">Argentina</option>
				<option value="PE" selected="selected">Perú</option>
				<option value="MX">Mexico</option>
				<option value="UY">Uruguay</option>
				';
				
				echo '
				</select> <div class="help"><span><em></em></span></div>
		</div>

		<div class="form-line">
			<label for="provincia">Regi&oacute;n</label>
			<select id="provincia" name="provincia" tabindex="10" onblur="registro.blur(this)" onchange="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese su provincia">
				<option value="">Regi&oacute;n</option>
				';
				
				echo '<option value="23">Tacna</option>';
				
				echo '
						</select> <div class="help"><span><em></em></span></div>
		</div>

		<div class="form-line">
			<label for="ciudad">Ciudad</label>

			<input type="text" id="ciudad" name="ciudad" tabindex="11" onblur="registro.blur(this)" onfocus="registro.focus(this)" title="Escriba el nombre de su ciudad" autocomplete="off" disabled="disabled" class="disabled" /> <div class="help"><span><em></em></span></div>
		</div>

		<div class="footerReg">
			<div class="form-line">
				<input type="checkbox" class="checkbox" id="noticias" name="noticias" tabindex="12" checked="checked" onchange="registro.datos[\'noticias\'] = $(this).is(\':checked\')" title="Enviar noticias por email?" /> <label class="list-label" for="noticias">Enviarme mails con noticias de '.$comunidad.'</label>
			</div>
		</div>

		<div class="form-line">
			<label for="recaptcha_response_field">C&oacute;digo de Seguridad:</label>
			<div id="recaptcha_ajax">
				<div id="recaptcha_image"></div>
				<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
			</div> <div class="help recaptcha"><span><em></em></span></div>
		</div>

		<div class="footerReg">
			<div class="form-line">
				<input type="checkbox" class="checkbox" id="terminos" name="terminos" tabindex="14" onblur="registro.blur(this)" onfocus="registro.focus(this)" title="�Acepta los T&eacute;rminos y Condiciones?" /> <label class="list-label" for="terminos">Acepto los <a href="/terminos-y-condiciones/" target="_blank">T&eacute;rminos de uso</a></label> <div class="help"><span><em></em></span></div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
//Load JS
$.getScript("http://o2.t26.net/images/js/es/registro.js?1.1", function(){
				//Seteo el pais seleccionado
			registro.datos[\'pais\']=\'PE\';
			registro.datos_status[\'pais\']=\'ok\';
			registro.datos_text[\'pais\']=\'OK\';
	
	//Genero el autocomplete de la ciudad
	$(\'#RegistroForm .pasoDos #ciudad\').autocomplete(\'/registro-geo.php\', {
		minChars: 2,
		width: 298
	}).result(function(event, data, formatted){
		registro.datos[\'ciudad_id\'] = (data) ? data[1] : \'\';
		registro.datos[\'ciudad_text\'] = (data) ? data[0].toLowerCase() : \'\';
		if(data)
			$(\'#RegistroForm .pasoDos #terminos\').focus();
	});

			registro.change_paso(1);
		mydialog.procesando_fin();
	});

//Load recaptcha
$.getScript("http://api.recaptcha.net/js/recaptcha_ajax.js", function(){
	Recaptcha.create(\''.$public_key.'\', \'recaptcha_ajax\', {
		theme:\'custom\', lang:\'es\', tabindex:\'13\', custom_theme_widget: \'recaptcha_ajax\',
		callback: function(){
			$(\'#recaptcha_response_field\').blur(function(){
				registro.blur(this);
			}).focus(function(){
				registro.focus(this);
			}).attr(\'title\', \'Ingrese el c�digo de la imagen\');
		}
	});
});
</script>';
}
	public function formulario_registro_login() {
		global $comunidad, $url;
		echo '<style>
.reg-login {
	margin-top: 15px;
}
	.registro {
		float: left;
		width: 300px;
	}
	.login-panel {
		float: left;
		border-left: #CCC 1px solid;
		padding-left: 25px;
	}
	
	.login-panel label {
		font-weight: bold;
		display: block;
		margin: 5px 0;
	}
	
	.login-panel .mBtn {
		margin-top: 10px;
	}
</style>

<div class="post-deleted post-privado clearbeta">
	<div class="content-splash">
		<h3>Este post es privado, s&oacute;lo los usuarios registrados de '.$comunidad.' pueden acceder.</h3>

		Pero no te preocupes, tambi&eacute;n puedes formar parte de nuestra gran familia.
		<div class="reg-login">
			<div class="registro">
				<h4>Registrarme!</h4>
				';

$this->formulario();

echo '
				<div id="buttons" style="display: inline-block;">
					<input id="sig" type="button" onclick="registro.change_paso(2)" value="Siguiente &raquo;" style="display:inline-block;" class="mBtn btnOk" tabindex="8" />
					<input id="term" type="button" onclick="registro.submit()" value="Terminar" style="display:none;" class="mBtn btnOk btnGreen" tabindex="15" />
				</div>

			</div>
			<div class="login-panel">
				<h4>...O quizas ya tengas usuario</h4>
				<div style="width:210px;font-size:13px;border: 5px solid rgb(195, 0, 20); background: none repeat scroll 0% 0% rgb(247, 228, 221); color: rgb(195, 0, 20); padding: 8px; margin: 10px 0;">
					<strong>&iexcl;Atenci&oacute;n!</strong>
					<br/>Antes de ingresar tus datos asegurate que la URL de esta p&aacute;gina pertenece a <strong>'.$url.'</strong>
				</div>

				<div class="login_cuerpo">
				  <span id="login_cargando" class="gif_cargando floatR"></span>
				  <div id="login_error"></div>
				    <form method="POST" id="login-registro-logueo" action="javascript:login_ajax(\'registro-logueo\')">
				      <label>Usuario</label>
				      <input maxlength="64" name="nick" id="nickname" class="ilogin" type="text" tabindex="20" />
				
				      <label>Contrase&ntilde;a</label>

				      <input maxlength="64" name="pass" id="password" class="ilogin" type="password" tabindex="21" />
				
				      <input class="mBtn btnOk" value="Entrar" title="Entrar" type="submit" tabindex="22" />
				      <div class="floatR" style="color: #666; padding:5px;font-weight: normal; display:none">
				        <input type="checkbox" /> Recordarme?
				      </div>
				    </form>
				    <div class="login_footer">
				      <a href="/password/" tabindex="23">&iquest;Olvidaste tu contrase&ntilde;a?</a>

				    </div>
				  </div>

			</div>
		</div>
	</div>
</div>';
    pie();
	exit;
	}
}
?>