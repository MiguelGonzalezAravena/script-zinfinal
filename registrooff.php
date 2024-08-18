<?php
include("header.php");
$titulo	= 'Registrate en '.$comunidad.'';

cabecera_normal();
echo'<div id="cuerpocontainer">
<style>
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
		<h3>Registrate en '.$comunidad.'</h3>
		Pero no te preocupes, tambi&eacute;n puedes formar parte de nuestra gran familia.
		<div class="reg-login">
			<div class="registro">
				<h4>Registrarme!</h4>
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
				<option value="">D&iacute;a</option>';
				for ($i = 1; $i <= 31; $i++) {
					echo "\n<option value=\"$i\">$i</option>";
				}
				echo'</select>
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
				<option value="">A&ntilde;o</option>';
				for ($i = 1992; $i >= 1900; $i--) {
					echo "\n<option value=\"$i\">$i</option>";
				}
				echo'</select> <div class="help"><span><em></em></span></div>
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
				<option value="">Pa&iacute;s</option>

							<option value="AF">Afganistán</option>
							<option value="AL">Albania</option>
							<option value="DE">Alemania</option>
							<option value="DZ">Argelia</option>
							<option value="AD">Andorra</option>
							<option value="AO">Angola</option>

							<option value="AI">Anguila</option>
							<option value="AG">Antigua y Barbuda</option>
							<option value="AN">Antillas Neerlandesas</option>
							<option value="AQ">Antártida</option>
							<option value="SA">Arabia Saudita</option>
							<option value="AR">Argentina</option>

							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaiyán</option>
							<option value="BS">Bahamas</option>

							<option value="BH">Bahréin</option>
							<option value="BD">Bangladesh</option>
							<option value="BB">Barbados</option>
							<option value="BZ">Belice</option>
							<option value="BJ">Benin</option>
							<option value="BM">Bermudas</option>

							<option value="BY">Bielorrusia</option>
							<option value="BO">Bolivia</option>
							<option value="BA">Bosnia y Herzegovina</option>
							<option value="BW">Botswana</option>
							<option value="BR">Brasil</option>
							<option value="BN">Brunéi</option>

							<option value="BG">Bulgaria</option>
							<option value="BF">Burkina Faso</option>
							<option value="BI">Burundi</option>
							<option value="BT">Bután</option>
							<option value="BE">Bélgica</option>
							<option value="CV">Cabo Verde</option>

							<option value="KH">Camboya</option>
							<option value="CM">Camerún</option>
							<option value="CA">Canadá</option>
							<option value="TD">Chad</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>

							<option value="CY">Chipre</option>
							<option value="VA">Ciudad del Vaticano</option>
							<option value="CO">Colombia</option>
							<option value="KM">Comoras</option>
							<option value="KP">Corea del Norte</option>
							<option value="KR">Corea del Sur</option>

							<option value="CR">Costa Rica</option>
							<option value="CI">Costa de Marfil</option>
							<option value="HR">Croacia</option>
							<option value="CU">Cuba</option>
							<option value="DK">Dinamarca</option>
							<option value="DM">Dominica</option>

							<option value="EC">Ecuador</option>
							<option value="EG">Egipto</option>
							<option value="SV">El Salvador</option>
							<option value="AE">Emiratos Árabes Unidos</option>
							<option value="ER">Eritrea</option>
							<option value="SK">Eslovaquia</option>

							<option value="SI">Eslovenia</option>
							<option value="ES">Espa&ntilde;a</option>
							<option value="US">Estados Unidos</option>
							<option value="EE">Estonia</option>
							<option value="ET">Etiopía</option>
							<option value="PH">Filipinas</option>

							<option value="FI">Finlandia</option>
							<option value="FJ">Fiyi</option>
							<option value="FR">Francia</option>
							<option value="GA">Gabón</option>
							<option value="GM">Gambia</option>
							<option value="GE">Georgia</option>

							<option value="GH">Ghana</option>
							<option value="GI">Gibraltar</option>
							<option value="GD">Granada</option>
							<option value="GR">Grecia</option>
							<option value="GL">Groenlandia</option>
							<option value="GP">Guadalupe</option>

							<option value="GU">Guam</option>
							<option value="GT">Guatemala</option>
							<option value="GF">Guayana Francesa</option>
							<option value="GG">Guernsey</option>
							<option value="GN">Guinea</option>
							<option value="GQ">Guinea Ecuatorial</option>

							<option value="GW">Guinea-Bissau</option>
							<option value="GY">Guyana</option>
							<option value="HT">Haití</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungría</option>

							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IQ">Iraq</option>
							<option value="IE">Irlanda</option>
							<option value="IR">Irán</option>
							<option value="BV">Isla Bouvet</option>

							<option value="IM">Isla de Man</option>
							<option value="CX">Isla de Navidad</option>
							<option value="IS">Islandia</option>
							<option value="KY">Islas Caimán</option>
							<option value="CC">Islas Cocos</option>
							<option value="CK">Islas Cook</option>

							<option value="FO">Islas Feroe</option>
							<option value="GS">Islas Georgias del Sur y Sandwich del Sur</option>
							<option value="HM">Islas Heard y McDonald</option>
							<option value="MP">Islas Marianas del Norte</option>
							<option value="MH">Islas Marshall</option>
							<option value="PN">Islas Pitcairn</option>

							<option value="SB">Islas Salomón</option>
							<option value="TC">Islas Turcas y Caicos</option>
							<option value="VG">Islas Vírgenes Británicas</option>
							<option value="VI">Islas Vírgenes Estadounidenses</option>
							<option value="UM">Islas ultramarinas de Estados Unidos</option>
							<option value="IL">Israel</option>

							<option value="IT">Italia</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japón</option>
							<option value="JE">Jersey</option>
							<option value="JO">Jordania</option>
							<option value="KZ">Kazajistán</option>

							<option value="KE">Kenia</option>
							<option value="KG">Kirguistán</option>
							<option value="KI">Kiribati</option>
							<option value="KW">Kuwait</option>
							<option value="LA">Laos</option>
							<option value="LS">Lesoto</option>

							<option value="LV">Letonia</option>
							<option value="LR">Liberia</option>
							<option value="LY">Libia</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lituania</option>
							<option value="LU">Luxemburgo</option>

							<option value="LB">Líbano</option>
							<option value="MO">Macao</option>
							<option value="MG">Madagascar</option>
							<option value="MY">Malasia</option>
							<option value="MW">Malaui</option>
							<option value="MV">Maldivas</option>

							<option value="MT">Malta</option>
							<option value="ML">Malí</option>
							<option value="MA">Marruecos</option>
							<option value="MQ">Martinica</option>
							<option value="MU">Mauricio</option>
							<option value="MR">Mauritania</option>

							<option value="YT">Mayotte</option>
							<option value="FM">Micronesia</option>
							<option value="MD">Moldavia</option>
							<option value="MN">Mongolia</option>
							<option value="ME">Montenegro</option>
							<option value="MS">Montserrat</option>

							<option value="MZ">Mozambique</option>
							<option value="MM">Myanmar</option>
							<option value="MX">México</option>
							<option value="MC">Mónaco</option>
							<option value="NA">Namibia</option>
							<option value="NR">Nauru</option>

							<option value="NP">Nepal</option>
							<option value="NI">Nicaragua</option>
							<option value="NE">Niger</option>
							<option value="NG">Nigeria</option>
							<option value="NU">Niue</option>
							<option value="NF">Norfolk</option>

							<option value="NO">Noruega</option>
							<option value="NC">Nueva Caledonia</option>
							<option value="NZ">Nueva Zelanda</option>
							<option value="OM">Omán</option>
							<option value="PK">Pakistán</option>
							<option value="PW">Palaos</option>

							<option value="PA">Panamá</option>
							<option value="PG">Papúa Nueva Guinea</option>
							<option value="PY">Paraguay</option>
							<option value="NL">Países Bajos</option>
							<option value="PE" selected="selected">Perú</option>
							<option value="PF">Polinesia Francesa</option>

							<option value="PL">Polonia</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="QA">Qatar</option>
							<option value="GB">Reino Unido</option>
							<option value="CF">República Centroafricana</option>

							<option value="CZ">República Checa</option>
							<option value="CD">República Democrática del Congo</option>
							<option value="DO">República Dominicana</option>
							<option value="MK">República de Macedonia</option>
							<option value="CG">República del Congo</option>
							<option value="EH">República Árabe Saharaui Democrática</option>

							<option value="RE">Reunión</option>
							<option value="RW">Ruanda</option>
							<option value="RO">Rumania</option>
							<option value="RU">Rusia</option>
							<option value="MF">Saint-Martin</option>
							<option value="WS">Samoa</option>

							<option value="AS">Samoa Americana</option>
							<option value="BL">San Bartolomé</option>
							<option value="KN">San Cristóbal y Nieves</option>
							<option value="SM">San Marino</option>
							<option value="PM">San Pedro y Miquelón</option>
							<option value="VC">San Vicente y las Granadinas</option>

							<option value="SH">Santa Helena</option>
							<option value="LC">Santa Lucía</option>
							<option value="ST">Sao Tomé y Principe</option>
							<option value="SN">Senegal</option>
							<option value="RS">Serbia</option>
							<option value="SC">Seychelles</option>

							<option value="SL">Sierra Leona</option>
							<option value="SG">Singapur</option>
							<option value="SY">Siria</option>
							<option value="SO">Somalia</option>
							<option value="LK">Sri Lanka</option>
							<option value="SZ">Suazilandia</option>

							<option value="ZA">Sudáfrica</option>
							<option value="SD">Sudán</option>
							<option value="SE">Suecia</option>
							<option value="CH">Suiza</option>
							<option value="SR">Surinam</option>
							<option value="SJ">Svalbard y Jan Mayen</option>

							<option value="TH">Tailandia</option>
							<option value="TW">Taiwán</option>
							<option value="TZ">Tanzania</option>
							<option value="TJ">Tayikistán</option>
							<option value="IO">Territorio Británico del Océano Índico</option>
							<option value="TF">Territorios Australes Franceses</option>

							<option value="PS">Territorios palestinos</option>
							<option value="TL">Timor Oriental</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad y Tobago</option>

							<option value="TM">Turkmenistán</option>
							<option value="TR">Turquía</option>
							<option value="TV">Tuvalu</option>
							<option value="TN">Túnez</option>
							<option value="UA">Ucrania</option>
							<option value="UG">Uganda</option>

							<option value="UY">Uruguay</option>
							<option value="UZ">Uzbekistán</option>
							<option value="VU">Vanuatu</option>
							<option value="VE">Venezuela</option>
							<option value="VN">Vietnam</option>
							<option value="WF">Wallis y Futuna</option>

							<option value="YE">Yemen</option>
							<option value="DJ">Yibuti</option>
							<option value="ZM">Zambia</option>
							<option value="ZW">Zimbabue</option>
						</select> <div class="help"><span><em></em></span></div>
		</div>

		<div class="form-line">
			<label for="provincia">Regi&oacute;n</label>
			<select id="provincia" name="provincia" tabindex="10" onblur="registro.blur(this)" onchange="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese su provincia">
				<option value="">Regi&oacute;n</option>
							<option value="1">Amazonas</option>
							<option value="2">Ancash</option>

							<option value="3">Apurímac</option>
							<option value="4">Arequipa</option>
							<option value="5">Ayacucho</option>
							<option value="6">Cajamarca</option>
							<option value="8">Cusco</option>
							<option value="9">Huancavelica</option>

							<option value="10">Huánuco</option>
							<option value="11">Ica</option>
							<option value="12">Junín</option>
							<option value="13">La Libertad</option>
							<option value="14">Lambayeque</option>
							<option value="15">Lima</option>

							<option value="16">Loreto</option>
							<option value="17">Madre de Dios</option>
							<option value="18">Moquegua</option>
							<option value="19">Pasco</option>
							<option value="20">Piura</option>
							<option value="7">Provincia Constitucional del Callao</option>

							<option value="15">Provincia de Lima</option>
							<option value="21">Puno</option>
							<option value="22">San Martín</option>
							<option value="23">Tacna</option>
							<option value="24">Tumbes</option>
							<option value="25">Ucayali</option>

						</select> <div class="help"><span><em></em></span></div>
		</div>

		<div class="form-line">
			<label for="ciudad">Ciudad</label>
			<input type="text" id="ciudad" name="ciudad" tabindex="11" onblur="registro.blur(this)" onfocus="registro.focus(this)" title="Escriba el nombre de su ciudad" autocomplete="off" disabled="disabled" class="disabled" /> <div class="help"><span><em></em></span></div>
		</div>

		<div class="footerReg">
			<div class="form-line">
				<input type="checkbox" class="checkbox" id="noticias" name="noticias" tabindex="12" checked="checked" onchange="registro.datos[\'noticias\'] = $(this).is(\':checked\')" title="Enviar noticias por email?" /> <label class="list-label" for="noticias">Enviarme mails con noticias de Taringa!</label>
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
				<input type="checkbox" class="checkbox" id="terminos" name="terminos" tabindex="14" onblur="registro.blur(this)" onfocus="registro.focus(this)" title="¿Acepta los T&eacute;rminos y Condiciones?" /> <label class="list-label" for="terminos">Acepto los <a href="/terminos-y-condiciones/" target="_blank">T&eacute;rminos de uso</a></label> <div class="help"><span><em></em></span></div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
//Load JS
$.getScript("http://i.t.net.ar/images/js/es/registro.js?1.1", function(){
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

			registro.dialog = false;
		registro.change_paso(1, true);
	});

//Load recaptcha
$.getScript("http://api.recaptcha.net/js/recaptcha_ajax.js", function(){
	Recaptcha.create(\'6Le8jQQAAAAAAGt1bzJsaHKCoLMWt6NFHupdtxf9\', \'recaptcha_ajax\', {
		theme:\'custom\', lang:\'es\', tabindex:\'13\', custom_theme_widget: \'recaptcha_ajax\',
		callback: function(){
			$(\'#recaptcha_response_field\').blur(function(){
				registro.blur(this);
			}).focus(function(){
				registro.focus(this);
			}).attr(\'title\', \'Ingrese el código de la imagen\');
		}
	});
});
</script>				<div id="buttons" style="display: inline-block;">
					<input id="sig" type="button" onclick="registro.change_paso(2)" value="Siguiente &raquo;" style="display:inline-block;" class="mBtn btnOk" tabindex="8" />
					<input id="term" type="button" onclick="registro.submit()" value="Terminar" style="display:none;" class="mBtn btnOk btnGreen" tabindex="15" />
				</div>

			</div>
			<div class="login-panel">
				<h4>...O quizas ya tengas usuario</h4>

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
?>