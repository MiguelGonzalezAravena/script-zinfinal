<?php
include("header.php");
$titulo	= $descripcion;

$ajax = $_POST['ajax'];
$save = $_POST['save'];

if($ajax != '1') {
	cabecera_normal();
}

if($key==null) {
fatal_error('Para editar tus datos necesit&aacute;s autentificarte');
}

/*Ajax ZinFinal - Cuenta*/

if($ajax == '1') {
	
	if($save == '1') {
		if(empty($_POST['nombre'])) {
			die('{"field":"nombre","error":"Por favor, completa el campo Nombre y Apellido"}');
		}
		
		if(empty($_POST['email'])) {
			die('{"field":"email","error":"Por favor, completa el campo Email"}');
		}
		
		if(empty($_POST['pais'])) {
			die('{"field":"pais","error":"Por favor, especifica el pa\u00eds"}');
		}
		
		if(empty($_POST['provincia'])) {
			die('{"field":"provincia","error":"La provincia esta vacia"}');
		}
				
		mysql_query("UPDATE usuarios SET nombre='{$_POST['nombre']}',mail='{$_POST['email']}',pais='{$_POST['pais']}',provincia='{$_POST['provincia']}',ciudad='{$_POST['ciudad']}' WHERE id='$key'");
		die('{"field":"","0":"Los cambios fueron aceptados y ser&aacute;n aplicados en los pr&oacute;ximos minutos."}');
	}
	
	if($save == '2') {

		mysql_query("UPDATE usuarios_perfil SET mensaje='{$_POST['mensaje']}',sitio='{$_POST['sitio']}',
		im_tipo='{$_POST['im_tipo']}',im='{$_POST['im']}',
		me_gustaria_amigos=" . (!empty($_POST['me_gustaria_amigos']) ? '1' : '0') . ",
		me_gustaria_conocer_gente=" . (!empty($_POST['me_gustaria_conocer_gente']) ? '1' : '0') . ",
		me_gustaria_conocer_gente_negocios=" . (!empty($_POST['me_gustaria_conocer_gente_negocios']) ? '1' : '0') . ",
		me_gustaria_encontrar_pareja=" . (!empty($_POST['me_gustaria_encontrar_pareja']) ? '1' : '0') . ",
		me_gustaria_de_todo=" . (!empty($_POST['me_gustaria_de_todo']) ? '1' : '0') . ",
		estado='{$_POST['estado']}',hijos='{$_POST['hijos']}',vivo='{$_POST['vivo']}' WHERE id = '$key'");
		
		die('{"field":"","error":""}');
	}
	if($save == '3') {

		mysql_query("UPDATE usuarios_perfil SET altura='{$_POST['altura']}',peso='{$_POST['peso']}',
		pelo_color='{$_POST['pelo_color']}',ojos_color='{$_POST['ojos_color']}',
		fisico='{$_POST['fisico']}',dieta='{$_POST['dieta']}',
		tengo_tatuajes=" . (!empty($_POST['tengo_tatuajes']) ? '1' : '0') . ",
		tengo_piercings=" . (!empty($_POST['tengo_piercings']) ? '1' : '0') . ",
		fumo='{$_POST['fumo']}',tomo_alcohol='{$_POST['tomo_alcohol']}' WHERE id = '$key'");
		
		die('{"field":"","error":""}');
	}
	if($save == '4') {

		mysql_query("UPDATE usuarios_perfil SET estudios='{$_POST['estudios']}',idioma_castellano='{$_POST['idioma_castellano']}',
		idioma_ingles='{$_POST['idioma_ingles']}',idioma_portugues='{$_POST['idioma_portugues']}',
		idioma_frances='{$_POST['idioma_frances']}',idioma_italiano='{$_POST['idioma_italiano']}',
		idioma_aleman='{$_POST['idioma_aleman']}',idioma_otro='{$_POST['idioma_otro']}',
		profesion='{$_POST['profesion']}',empresa='{$_POST['empresa']}',sector='{$_POST['sector']}',ingresos='{$_POST['ingresos']}',
		intereses_profesionales='{$_POST['intereses_profesionales']}',habilidades_profesionales='{$_POST['habilidades_profesionales']}' WHERE id = '$key'");
		
		die('{"field":"","error":""}');
	}
	if($save == '5') {

		mysql_query("UPDATE usuarios_perfil SET mis_intereses='{$_POST['mis_intereses']}',hobbies='{$_POST['hobbies']}',
		series_tv_favoritas='{$_POST['series_tv_favoritas']}',musica_favorita='{$_POST['musica_favorita']}',
		deportes_y_equipos_favoritos='{$_POST['deportes_y_equipos_favoritos']}',libros_favoritos='{$_POST['libros_favoritos']}',
		peliculas_favoritas='{$_POST['peliculas_favoritas']}',comida_favorita='{$_POST['comida_favorita']}',
		mis_heroes_son='{$_POST['mis_heroes_son']}' WHERE id = '$key'");
		
		die('{"field":"","error":""}');
	}
	if($save == '6') {
		$opciones = "{$_POST['mostrar_estado_checkbox']},{$_POST['participar_busquedas']},{$_POST['recibir_boletin_semanal']},{$_POST['recibir_promociones']}";
		
		mysql_query("UPDATE usuarios SET opciones ='$opciones' WHERE id = '$key'");
		
		die('{"field":"","error":""}');
	}
	if($save == '7') {
		
		if($_POST['action'] == 'add') {
			if(empty($_POST['url'])) {
				die('{"field":"url","error":"La URL ingresada es inv&aacute;lida"}');
			}
			if(empty($_POST['caption'])) {
				die('{"field":"caption","error":"Falta caption"}');
			}
			mysql_query("INSERT INTO usuarios_fotos (iduser, imagen, descripcion) VALUES ('$key', '{$_POST['url']}', '{$_POST['caption']}')");
			$idf = mysql_insert_id();
			die('{"id":'.$idf.',"field":"","error":""}');
		}
		if($_POST['action'] == 'del') {
			if(empty($_POST['id'])) {
				die('{"field":"url","error":"La URL ingresada es inv&aacute;lida"}');
			}
			mysql_query("DELETE FROM usuarios_fotos WHERE fotoid='{$_POST['id']}' AND iduser='$key'");
			die('{"field":"","error":""}');
		}
		
	}
	if($save == '9') {
		if(empty($_POST['passwd']) or empty($_POST['new_passwd']) or empty($_POST['confirm_passwd'])) {
			die('{"field":"passwd","error":"Faltan datos"}');
		}
		
		if($_POST['new_passwd'] != $_POST['confirm_passwd']) {
			die('{"field":"confirm_passwd","error":"Las claves son diferentes"}');
		}
		
		$_POST['passwd'] = md5($_POST['passwd']);
		
		$comprobar9 = mysql_query("SELECT password FROM usuarios WHERE id = '{$key}' and password = '{$_POST['passwd']}'");
		if(!mysql_num_rows($comprobar9)) {
			die('{"field":"passwd","error":"La clave actual ingresada no es correcta"}');
		}
		
		$_POST['new_passwd'] = md5($_POST['new_passwd']);
		
		$id_zinfinal = md5(uniqid(rand(), true));
		mysql_query("UPDATE usuarios SET id_zinfinal='$id_zinfinal', password='{$_POST['new_passwd']}' where id='$key'");
		die('{"field":"","0":"La contraseña fue cambiada"}');
		
	}
	
	if($save == '10') {
		mysql_query("UPDATE usuarios SET avatar ='$save' WHERE id = '$key'");
				
		die('http://a04.t.net.ar/avatares/4/0/1/3/120_4013504.jpg');
	}
	
}

if($ajax != '1') {
	
	$datosperfil = mysql_query("SELECT * FROM usuarios_perfil WHERE id = '$key'");
	$perfil = mysql_fetch_array($datosperfil);
	mysql_free_result($datosperfil);
	
	function select($array,$dato) {
		foreach ($array as $titulo => $value) {
			echo "<option value=\"{$value}\"".($value == $dato ? ' selected="selected"' : '').">{$titulo}</option>\n";
		}
	}
	
	echo '<div id="cuerpocontainer">

<script src="'.$images.'/images/js/es/cuenta.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	document.domain = \'localhost\';

	avatar.uid = 4013504;
	avatar.server = 4;
	avatar.crc =	\'30c3fa19c40330073287e5d2f8dfac87fb86493e\';
	avatar.current = \'http://a04.t.net.ar/avatares/4/0/1/3/120_4013504.jpg\';

	cuenta.ciudad_id = \'3928128\';
	cuenta.ciudad_text = "Tacna";

	});
</script>
<div class="tabbed-d">
	<ul class="menu-tab">
		<li class="active"><a onclick="cuenta.chgtab(this)">Cuenta</a></li>
		<li><a onclick="cuenta.chgtab(this)">Perfil</a></li>
		<li><a onclick="cuenta.chgtab(this)">Opciones</a></li>

		<li><a onclick="cuenta.chgtab(this)">Mis Fotos</a></li>
		<li><a onclick="cuenta.chgtab(this)">Bloqueados</a></li>
		<li><a onclick="cuenta.chgtab(this)">Cambiar Clave</a></li>
		<li class="privacy"><a onclick="cuenta.chgtab(this)">Privacidad</a></li>
	</ul>
	<a name="alert-cuenta"></a>
	<form name="editarcuenta" class="horizontal" action="" method="post">

		<div class="content-tabs cuenta">
			<div class="alert-cuenta cuenta-1">
			</div>
			<fieldset>
				<div class="field">
					<label for="nombre">Nombre:</label>
					<input type="text" class="text cuenta-save-1" id="nombre" name="nombre" maxlength="32" value="'.$global_user['nombre'].'" />
				</div>

				<div class="field">
					<label for="email">E-Mail:</label>
					<div class="input-fake input-hide-email">
						'.$global_user['mail'].' (<a onclick="input_fake(\'email\')">Cambiar</a>)
					</div>
					<input type="text" class="text cuenta-save-1 input-hidden-email" id="email" name="email" maxlength="35" value="'.$global_user['mail'].'" style="display: none" />
				</div>
				<div class="field">

					<label for="pais">Pa&iacute;s:</label>
					<select id="pais" name="pais" class="cuenta-save-1" onchange="cuenta.chgpais()">
						<option value="">Pa&iacute;s</option>';
						
$datospais = mysql_query("SELECT nombre_pais, img_pais FROM paises");

while($paizez = mysql_fetch_array($datospais)) {
	echo "<option value=\"{$paizez['img_pais']}\" ".($paizez['img_pais'] == $global_user['pais'] ? ' selected="selected"' : '').">{$paizez['nombre_pais']}</option>\n";
}

mysql_free_result($datospais);

echo '
										</select>
				</div>

				<div class="field">
					<label for="provincia">Regi&oacute;n:</label>
					<select id="provincia" name="provincia" class="cuenta-save-1" onchange="cuenta.chgprovincia()">
						<option value="">Regi&oacute;n</option>

											<option value="1">Amazonas</option>
											<option value="2">Ancash</option>
											<option value="3">Apur&iacute;mac</option>
											<option value="4">Arequipa</option>
											<option value="5">Ayacucho</option>
											<option value="6">Cajamarca</option>
											<option value="8">Cusco</option>
											<option value="9">Huancavelica</option>
											<option value="10">Hu&aacute;nuco</option>
											<option value="11">Ica</option>
											<option value="12">Jun&iacute;n</option>
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
											<option value="22">San Mart&iacute;n</option>
											<option value="23" selected="selected">Tacna</option>
											<option value="24">Tumbes</option>
											<option value="25">Ucayali</option>
										</select>
				</div>
				<div class="field">
					<label for="ciudad">Ciudad:</label>
					<input type="text" id="ciudad" name="ciudad" value="'.$global_user['ciudad'].'" />

				</div>
				<div class="field">
					<label>Sexo</label>
					<ul class="fields">
						<li>
							<label><input type="radio" class="radio cuenta-save-1" name="sexo" value="m" '.($global_user['sexo'] == 'm' ? 'checked="checked"' : '').'/>Masculino</label>
						</li>
						<li>

							<label><input type="radio" class="radio cuenta-save-1" name="sexo" value="f" '.($global_user['sexo'] == 'f' ? 'checked="checked"' : '').'/>Femenino</label>
						</li>
					</ul>
				</div>
				<div class="field">
										<label>Nacimiento:</label>
					<select name="dia" class="cuenta-save-1">
					';
					
					for ($i = 1; $i < 32; $i++) {
						echo '<option value="'.$i.'"'.($i == $global_user['dia'] ? ' selected="selected"' : '').'>'.$i.'</option>';
					}
					
					echo '

										</select>
					<select name="mes" class="cuenta-save-1">';
					
select(array("Enero" => "1","Febrero" => "2","Marzo" => "3","Abril" => "4","Mayo" => "5","Junio" => "6","Julio" => "7","Agosto" => "8","Septiembre" => "9","Octubre" => "10","Noviembre" => "11","Diciembre" => "12"),$global_user['mes']);

echo ' </select>
					<select name="ano" class="cuenta-save-1">';
					
					for ($i = 1910; $i < 2011; $i++) {
						echo '<option value="'.$i.'"'.($i == $global_user['ano'] ? ' selected="selected"' : '').'>'.$i.'</option>';
					}
					
					echo '

											</select>
				</div>
			</fieldset>
			<div class="buttons">
				<input type="button" class="mBtn btnOk" onclick="cuenta.save(1)" value="Guardar" />
				<input type="button" class="mBtn btnOk" onclick="cuenta.save(1, true)" value="Siguiente" />
			</div>

			<div class="clearfix"></div>
		</div>
		<div class="content-tabs perfil" style="display: none">
			<h3 onclick="cuenta.chgsec(this)" class="active">1. M&aacute;s sobre mi</h3>
			<fieldset>
				<div class="alert-cuenta cuenta-2">
				</div>
				<div class="field">

					<label for="sitio">Mensaje Personal</label>
					<textarea class="cuenta-save-2" id="mensaje" name="mensaje" maxlength="60" value="">'.$perfil['mensaje'].'</textarea>
				</div>
				
				<div class="field">
					<label for="sitio">Sitio Web</label>
					<input style="width:230px" type="text" class="text cuenta-save-2" id="sitio" name="sitio" maxlength="60" value="'.$perfil['sitio'].'" />
				</div>

				<div class="field">
										<label for="im">Mensajero</label>
					<select name="im_tipo" class="cuenta-save-2">
						<option value="msn"'.($perfil['im_tipo'] == 'msn' ? ' selected="selected"' : '').'>MSN</option>
						<option value="gtalk"'.($perfil['im_tipo'] == 'gtalk' ? ' selected="selected"' : '').'>GTalk</option>
						<option value="icq"'.($perfil['im_tipo'] == 'icq' ? ' selected="selected"' : '').'>ICQ</option>
						<option value="aim"'.($perfil['im_tipo'] == 'aim' ? ' selected="selected"' : '').'>AIM</option>

					</select>
					<input type="text" class="text cuenta-save-2" id="im" name="im" maxlength="64" value="'.$perfil['im'].'" />
				</div>
				<div class="field">
					<label>Me gustaria</label>
					<div class="input-fake">
						<ul>
							<li><input type="checkbox"'.(empty($perfil['me_gustaria_amigos']) ? '' : ' checked="checked"').' class="cuenta-save-2" name="me_gustaria_amigos" />Hacer amigos</li>
							<li><input type="checkbox"'.(empty($perfil['me_gustaria_conocer_gente']) ? '' : ' checked="checked"').' class="cuenta-save-2" name="me_gustaria_conocer_gente" />Conocer gente con mis intereses</li>
							<li><input type="checkbox"'.(empty($perfil['me_gustaria_conocer_gente_negocios']) ? '' : ' checked="checked"').' class="cuenta-save-2" name="me_gustaria_conocer_gente_negocios" />Conocer gente para negocios</li>
							<li><input type="checkbox"'.(empty($perfil['me_gustaria_encontrar_pareja']) ? '' : ' checked="checked"').' class="cuenta-save-2" name="me_gustaria_encontrar_pareja" />Encontrar pareja</li>
							<li><input type="checkbox"'.(empty($perfil['me_gustaria_de_todo']) ? '' : ' checked="checked"').' class="cuenta-save-2" name="me_gustaria_de_todo" />De todo</li>
						</ul>
					</div>
				</div>

				<div class="field">
					<label for="estado">Estado Civil</label>
					<div class="input-fake">
						<select id="estado" name="estado" class="cuenta-save-2">';

select(array("Sin Respuesta" => "","Soltero" => "soltero","De novio" => "novio","Casado" => "casado","Divorciado" => "divorciado","Viudo" => "viudo","En algo..." => "algo"),$perfil['estado']);

echo '
						</select>
					</div>
				</div>

				<div class="field">
					<label for="hijos">Hijos</label>
					<div class="input-fake">
						<select id="hijos" name="hijos" class="cuenta-save-2">';
						
select(array("Sin Respuesta" => "",
"No tengo" => "no",
"Alg&uacute;n d&iacute;a" => "algun_dia",
"No son lo m&iacute;o" => "no_quiero",
"Tengo, vivo con ellos" => "viven_conmigo",
"Tengo, no vivo con ellos" => "no_viven_conmigo"),$perfil['hijos']);

echo '
						</select>
					</div>
				</div>
				<div class="field">

					<label for="vivo">Vivo con</label>
					<div class="input-fake">
						<select id="vivo" name="vivo" class="cuenta-save-2">';
						
select(array("Sin Respuesta" => "",
"S&oacute;lo" => "solo",
"Con mis padres" => "padres",
"Con mi pareja" => "pareja",
"Con amigos" => "amigos",
"Otro" => "otro"),$perfil['vivo']);

echo '

						</select>
					</div>
				</div>
				<div class="buttons">
					<input type="button" class="mBtn btnOk" onclick="cuenta.save(2, true)" value="Guardar y seguir" />
				</div>

			</fieldset>
			<h3 onclick="cuenta.chgsec(this)">2. Como soy</h3>
			<fieldset style="display: none">
				<div class="alert-cuenta cuenta-3">
				</div>
				<div class="field">
					<label for="altura">Mi altura</label>
					<div class="input-fake">
						<input type="text" class="text cuenta-save-3" id="altura" name="altura" maxlength="3" value="'.$perfil['altura'].'" /> cent&iacute;metros
					</div>
				</div>
				<div class="field">
					<label for="peso">Mi peso</label>
					<div class="input-fake">
						<input type="text" class="text cuenta-save-3" id="peso" name="peso" maxlength="3" value="'.$perfil['peso'].'" /> kilogramos
					</div>

				</div>
				<div class="field">
					<label for="pelo_color">Color de pelo</label>
					<div class="input-fake">
						<select id="pelo_color" name="pelo_color" class="cuenta-save-3">';

select(array("Sin Respuesta" => "",
"Negro" => "negro",
"Casta&ntilde;o oscuro" => "castano_oscuro",
"Casta&ntilde;o claro" => "castano_claro",
"Rubio" => "rubio",
"Pelirrojo" => "pelirrojo",
"Gris" => "gris",
"Canoso" => "canoso",
"Te&ntilde;ido" => "tenido",
"Rapado" => "rapado",
"Calvo" => "calvo"),$perfil['pelo_color']);

echo '
						</select>
					</div>
				</div>
				<div class="field">

					<label for="ojos_color">Color de ojos</label>
					<div class="input-fake">
						<select id="ojos_color" name="ojos_color" class="cuenta-save-3">';
						
select(array("Sin Respuesta" => "",
"Negros" => "negros",
"Marrones" => "marrones",
"Celestes" => "celestes",
"Verdes" => "verdes",
"Grises" => "grises"),$perfil['ojos_color']);

echo '
						</select>
					</div>
				</div>
				<div class="field">
					<label for="fisico">Complexi&oacute;n</label>

					<div class="input-fake">
						<select id="fisico" name="fisico" class="cuenta-save-3">';
						
select(array("Sin Respuesta" => "",
"Delgado" => "delgado",
"Atl&eacute;tico" => "atletico",
"Normal" => "normal",
"Algunos kilos de m&aacute;s" => "kilos_de_mas",
"Corpulento" => "corpulento"),$perfil['fisico']);

echo '
						</select>
					</div>
				</div>
				<div class="field">
					<label for="dieta">Mi dieta es</label>
					<div class="input-fake">
						<select id="dieta" name="dieta" class="cuenta-save-3">';
						
select(array("Sin Respuesta" => "",
"Vegetariana" => "vegetariana",
"Lacto Vegetariana" => "lacto_vegetariana",
"Org&aacute;nica" => "organica",
"De todo" => "de_todo",
"Comida basura" => "comida_basura"),$perfil['dieta']);

echo '

						</select>
					</div>
				</div>
				<div class="field">
					<label>Tengo</label>
					<div class="input-fake">
						<ul>
							<li><input type="checkbox"'.(empty($perfil['tengo_tatuajes']) ? '' : ' checked="checked"').' class="cuenta-save-3" name="tengo_tatuajes"/>Tatuajes</li>
							<li><input type="checkbox"'.(empty($perfil['tengo_piercings']) ? '' : ' checked="checked"').' class="cuenta-save-3" name="tengo_piercings"/>Piercings</li>
						</ul>
					</div>
				</div>
				<div class="field">
					<label for="fumo">Fumo</label>
					<div class="input-fake">
						<select id="fumo" name="fumo" class="cuenta-save-3">';
						
select(array("Sin Respuesta" => "",
"No" => "no",
"Casualmente" => "casualmente",
"Socialmente" => "socialmente",
"Regularmente" => "regularmente",
"Mucho" => "mucho"),$perfil['fumo']);

echo '
						</select>
					</div>
				</div>
				<div class="field">
					<label for="tomo_alcohol">Tomo alcohol</label>
					<div class="input-fake">
						<select id="tomo_alcohol" name="tomo_alcohol" class="cuenta-save-3">';
						
select(array("Sin Respuesta" => "",
"No" => "no",
"Casualmente" => "casualmente",
"Socialmente" => "socialmente",
"Regularmente" => "regularmente",
"Mucho" => "mucho"),$perfil['tomo_alcohol']);

echo '
						</select>

					</div>
				</div>
				<div class="buttons">
					<input type="button" class="mBtn btnOk" onclick="cuenta.save(3, true)" value="Guardar y seguir" />
				</div>
			</fieldset>
			<h3 onclick="cuenta.chgsec(this)">3. Formaci&oacute;n y trabajo</h3>
			<fieldset style="display: none">

				<div class="alert-cuenta cuenta-4">
				</div>
				<div class="field">
					<label for="estudios">Estudios</label>
					<div class="input-fake">
						<select id="estudios" name="estudios" class="cuenta-save-4">';
						
select(array("Sin Respuesta" => "",
"Sin Estudios" => "sin",
"Primario completo" => "pri",
"Secundario en curso" => "sec_curso",
"Secundario completo" => "sec_completo",
"Terciario en curso" => "ter_curso",
"Terciario completo" => "ter_completo",
"Universitario en curso" => "univ_curso",
"Universitario completo" => "univ_completo",
"Post-grado en curso" => "post_curso",
"Post-grado completo" => "post_completo"),$perfil['estudios']);

echo '
						</select>
					</div>
				</div>
				<div class="field">

					<label>Idiomas</label>
					<div class="input-fake">
						<ul>
							<li>
								<span class="label-id">Castellano</span>
								<select name="idioma_castellano" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_castellano']);

echo '
								</select>

							</li>
							<li>
								<span class="label-id">Ingl&eacute;s</span>
								<select name="idioma_ingles" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_ingles']);

echo '</select>
							</li>
							<li>
								<span class="label-id">Portugu&eacute;s</span>

								<select name="idioma_portugues" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_portugues']);

echo '</select>
							</li>
							<li>
								<span class="label-id">Franc&eacute;s</span>
								<select name="idioma_frances" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_frances']);

echo '</select>

							</li>
							<li>
								<span class="label-id">Italiano</span>
								<select name="idioma_italiano" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_italiano']);

echo '</select>
							</li>
							<li>
								<span class="label-id">Alem&aacute;n</span>

								<select name="idioma_aleman" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_aleman']);

echo '</select>
							</li>
							<li>
								<span class="label-id">Otro</span>
								<select name="idioma_otro" class="cuenta-save-4">';
								
select(array("Sin Respuesta" => "",
"Sin conocimiento" => "nada",
"B&aacute;sico" => "basico",
"Intermedio" => "intermedio",
"Fluido" => "fluido",
"Nativo" => "nativo"),$perfil['idioma_otro']);

echo '</select>

							</li>
						</ul>
					</div>
				</div> 
				<div class="field">
					<label for="profesion">Profesi&oacute;n</label>
					<input value="'.$perfil['profesion'].'" id="profesion" name="profesion" maxlength="32" class="text cuenta-save-4"/>
				</div>
				<div class="field">

					<label for="empresa">Empresa</label>
					<input value="'.$perfil['empresa'].'" id="empresa" name="empresa" maxlength="32" class="text cuenta-save-4"/>
				</div>
				<div class="field">
					<label for="sector">Sector</label>
					<div class="input-fake">
						<select id="sector" name="sector" class="cuenta-save-4">';
						
select(array("Sin Respuesta" => "",
"Abastecimiento" => "1",
"Administraci&oacute;n" => "2",
"Apoderado Aduanal" => "3",
"Asesor&iacute;a en Comercio Exterior" => "4",
"Asesor&iacute;a Legal Internacional" => "5",
"Asistente de Tr&aacute;fico" => "6",
"Auditor&iacute;a" => "7",
"Calidad" => "8",
"Call Center" => "9",
"Capacitaci&oacute;n Comercio Exterior" => "10",
"Comercial" => "11",
"Comercio Exterior" => "12",
"Compras" => "13",
"Compras Internacionales/Importaci&oacute;n" => "14",
"Comunicaci&oacute;n Social" => "15",
"Comunicaciones Externas" => "16",
"Comunicaciones Internas" => "17",
"Consultor&iacute;a" => "18",
"Consultor&iacute;as Comercio Exterior" => "19",
"Contabilidad" => "20",
"Control de Gesti&oacute;n" => "21",
"Creatividad" => "22",
"Dise&ntilde;o" => "23",
"Distribuci&oacute;n" => "24",
"E-commerce" => "25",
"Educaci&oacute;n" => "26",
"Finanzas" => "27",
"Finanzas Internacionales" => "28",
"Gerencia / Direcci&oacute;n General" => "29",
"Impuestos" => "30",
"Ingenier&iacute;a" => "31",
"Internet" => "32",
"Investigaci&oacute;n y Desarrollo" => "33",
"J&oacute;venes Profesionales" => "34",
"Legal" => "35",
"Log&iacute;stica" => "36",
"Mantenimiento" => "37",
"Marketing" => "38",
"Medio Ambiente" => "39",
"Mercadotecnia Internacional" => "40",
"Multimedia" => "41",
"Otra" => "42",
"Pasant&iacute;as" => "43",
"Periodismo" => "44",
"Planeamiento" => "45",
"Producci&oacute;n" => "46",
"Producci&oacute;n e Ingenier&iacute;a" => "47",
"Recursos Humanos" => "48",
"Relaciones Institucionales / P&uacute;blicas" => "49",
"Salud" => "50",
"Seguridad Industrial" => "51",
"Servicios" => "52",
"Soporte T&eacute;cnico" => "53",
"Tecnolog&iacute;a" => "54",
"Tecnolog&iacute;as de la Informaci&oacute;n" => "55",
"Telecomunicaciones" => "56",
"Telemarketing" => "57",
"Traducci&oacute;n" => "58",
"Transporte" => "59",
"Ventas" => "60",
"Ventas Internacionales/Exportaci&oacute;n" => "61"),$perfil['sector']);

echo '
		</select>
					</div>
				</div>
				<div class="field">
					<label for="ingresos">Nivel de ingresos</label>
					<div class="input-fake">
						<select id="ingresos" name="ingresos" class="cuenta-save-4">';
						
select(array("Sin Respuesta" => "",
"Sin ingresos" => "sin",
"Bajos" => "bajos",
"Intermedios" => "intermedios",
"Altos" => "altos"),$perfil['vivo']);

echo '
						</select>
					</div>
				</div>

				<div class="field">
					<label for="intereses_profesionales">Intereses Profesionales</label>
					<div class="input-fake">
						<textarea id="intereses_profesionales" name="intereses_profesionales" class="cuenta-save-4">'.$perfil['intereses_profesionales'].'</textarea>
					</div>
				</div>
				<div class="field">
					<label for="habilidades_profesionales">Habilidades Profesionales</label>

					<div class="input-fake">
						<textarea id="habilidades_profesionales" name="habilidades_profesionales" class="cuenta-save-4">'.$perfil['habilidades_profesionales'].'</textarea>
					</div>
				</div>
				<div class="buttons">
					<input type="button" class="mBtn btnOk" onclick="cuenta.save(4, true)" value="Guardar y seguir" />
				</div>
			</fieldset>

			<h3 onclick="cuenta.chgsec(this)">4. Intereses y preferencias</h3>
			<fieldset style="display: none">
				<div class="alert-cuenta cuenta-5">
				</div>
				<div class="field">
					<label for="mis_intereses">Mis intereses</label>
					<div class="input-fake">
						<textarea id="mis_intereses" name="mis_intereses" class="cuenta-save-5">'.$perfil['mis_intereses'].'</textarea>

					</div>
				</div>
				<div class="field">
					<label for="hobbies">Hobbies</label>
					<div class="input-fake">
						<textarea id="hobbies" name="hobbies" class="cuenta-save-5">'.$perfil['hobbies'].'</textarea>
					</div>
				</div>

				<div class="field">
					<label for="series_tv_favoritas">Series de TV favoritas:</label>
					<div class="input-fake">
						<textarea id="series_tv_favoritas" name="series_tv_favoritas" class="cuenta-save-5">'.$perfil['series_tv_favoritas'].'</textarea>
					</div>
				</div>
				<div class="field">
					<label for="musica_favorita">M&uacute;sica favorita</label>

					<div class="input-fake">
						<textarea id="musica_favorita" name="musica_favorita" class="cuenta-save-5">'.$perfil['musica_favorita'].'</textarea>
					</div>
				</div>
				<div class="field">
					<label for="deportes_y_equipos_favoritos">Deportes y equipos favoritos</label>
					<div class="input-fake">
						<textarea id="deportes_y_equipos_favoritos" name="deportes_y_equipos_favoritos" class="cuenta-save-5">'.$perfil['deportes_y_equipos_favoritos'].'</textarea>

					</div>
				</div>
				<div class="field">
					<label for="libros_favoritos">Libros favoritos</label>
					<div class="input-fake">
						<textarea id="libros_favoritos" name="libros_favoritos" class="cuenta-save-5">'.$perfil['libros_favoritos'].'</textarea>
					</div>
				</div>

				<div class="field">
					<label for="peliculas_favoritas">Peliculas favoritas</label>
					<div class="input-fake">
						<textarea id="peliculas_favoritas" name="peliculas_favoritas" class="cuenta-save-5">'.$perfil['peliculas_favoritas'].'</textarea>
					</div>
				</div>
				<div class="field">
					<label for="comida_favorita">Comida favorita</label>

					<div class="input-fake">
						<textarea id="comida_favorita" name="comida_favorita" class="cuenta-save-5">'.$perfil['comida_favorita'].'</textarea>
					</div>
				</div> 
				 <div class="field">
					 <label for="mis_heroes_son">Mis h&eacute;roes son</label>
					 <div class="input-fake">
						 <textarea id="mis_heroes_son" name="mis_heroes_son" class="cuenta-save-5">'.$perfil['mis_heroes_son'].'</textarea>

					 </div>
				 </div>
				<div class="buttons">
					<input type="button" class="mBtn btnOk" onclick="cuenta.save(5)" value="Guardar" />
				</div>
			</fieldset>
			<div class="clearfix"></div>
		</div>
';

echo '
		<div class="content-tabs opciones" style="display: none">
			<fieldset>
				<div class="alert-cuenta cuenta-6">
				</div>
				<div class="field">
					<div class="input-fake">
						<input type="hidden" class="cuenta-save-6" name="nombre_mostrar" value="todos" />
						<ul>
							<li><input type="checkbox" name="mostrar_estado_checkbox" class="cuenta-save-6" '.(empty($options['0']) ? '' : 'checked="checked"').' />Mostrar mi estado cuando navego el sitio</li>
							<li><input type="checkbox" name="participar_busquedas" class="cuenta-save-6" '.(empty($options['1']) ? '' : 'checked="checked"').' />Permitir que los usuarios encuentren mi perfil en las busquedas de usuarios</li>
							<li><input type="checkbox" name="recibir_boletin_semanal" class="cuenta-save-6" '.(empty($options['2']) ? '' : 'checked="checked"').' />Recibir el bolet&iacute;n semanal de novedades de '.$comunidad.' por e-mail</li>
							<li><input type="checkbox" name="recibir_promociones" class="cuenta-save-6" '.(empty($options['3']) ? '' : 'checked="checked"').' />Recibir promociones y descuentos por e-mail</li>
						</ul>
					</div>
				</div>
			</fieldset>

			<div class="buttons">
				<input type="button" class="mBtn btnOk" onclick="cuenta.save(6)" value="Guardar" />
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="content-tabs mis-fotos" style="display: none">
			<fieldset>
				<div class="alert-cuenta cuenta-7"></div>';
				
$dbfotos = mysql_query("SELECT * FROM usuarios_fotos WHERE iduser = '$key'");

while($fotoz = mysql_fetch_array($dbfotos)) {
	echo '<div class="field">
					<label>Imagen</label>
					<div class="input-fake">
						<div class="floatL">
							<img src="'.$fotoz['imagen'].'" class="imagen-preview" />
						</div>
						<div class="floatL">
							<input style="width:300px" value="'.$fotoz['imagen'].'" type="text" class="text" />
							<textarea class="imagen-desc" style="margin-top:10px;width:300px">'.$fotoz['descripcion'].'</textarea>

							<a onclick="cuenta.imagen.del(this, '.$fotoz['fotoid'].')" class="misfotos-del">Eliminar</a>
							
						</div>
						<div class="clearfix clearBoth"></div>
					</div>
				</div>';
}

mysql_free_result($dbfotos);
				
echo '
				<div class="field">

					<label>Imagen</label>
					<div class="input-fake">
						<input style="width: 300px;margin-bottom:5px" type="text" class="text" value="http://" />
						<textarea style="width: 300px"  class="imagen-desc" style="margin-top:10px">Descripcion de la foto</textarea>
						<a onclick="cuenta.imagen.add(this)" class="misfotos-add">Agregar</a>
					</div>
				</div>				
			</fieldset>

			<div class="clearfix"></div>
		</div>

		<div class="content-tabs bloqueados" style="display: none">
			<fieldset>
				<div class="field">
						<ul class="bloqueadosList">';
	$number=0;
	foreach ($bloqueados as $id => $info) {
		echo '<li><a href="/perfil/'.$info[nick].'">'.$info[nick].'</a><span><a class="desbloqueadosU bloquear_usuario_'.$info[id].'" href="javascript:bloquear(\''.$info[id].'\', false, \'mis_bloqueados\')" title="Desbloquear Usuario">Desbloquear</a></span></li>';
		$number=1;
		
	}
	
	if ($number==0) {
		echo '<div class="emptyData">No hay usuarios bloqueados</div>';
	}

	echo '
							</ul>
							</div>
			</fieldset>
			<div class="clearfix"></div>
		</div>
		<div class="content-tabs cambiar-clave" style="display: none">		
			<fieldset>
				<div class="alert-cuenta cuenta-9">
				</div>

				<div class="field">
					<label for="new_passwd">Contrase&ntilde;a actual:</label>
					<input type="password" class="text cuenta-save-9" id="passwd" name="passwd" maxlength="32" value="" />
				</div>
				<div class="field">
					<label for="passwd">Contrase&ntilde;a nueva:</label>
					<input type="password" class="text cuenta-save-9" id="new_passwd" name="new_passwd" maxlength="32" value="" />
				</div>

				<div class="field">
					<label for="confirm_passwd">Repetir Contrase&ntilde;a:</label>
					<input type="password" class="text cuenta-save-9" id="confirm_passwd" name="confirm_passwd" maxlength="32" value="" />
				</div>
			</fieldset>
			<div class="buttons">
				<input type="button" class="mBtn btnOk" onclick="cuenta.save(9)" value="Guardar" />
			</div>

			<div class="clearfix"></div>
		</div>
		<div class="content-tabs privacidad" style="display: none">
			<fieldset>
				<div class="alert-cuenta cuenta-8"></div>
				<div class="field">
					<label>Nombre</label>
					<div class="input-fake">

						<select class="cuenta-save-8" name="nombre_mostrar">
							<option value="nadie" selected="selected">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos">Todos</option>
						</select>
					</div>

				</div>
				<div class="field">
					<label>E-Mail</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="email_mostrar">
							<option value="nadie" selected="selected">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Nacimiento</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="fecha_nacimiento_mostrar">
							<option value="nadie" selected="selected">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Mensajero</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="im_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Mensaje Personal</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="im_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Estado mientras Navego</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="navego_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Me gustaria</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="me_gustaria_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Estado Civil</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="estado_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Hijos</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="hijos_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Vivo con</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="vivo_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Mi altura</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="altura_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Mi peso</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="peso_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Color de pelo</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="pelo_color_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Color de ojos</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="ojos_color_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Complexi&oacute;n</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="fisico_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Mi dieta</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="dieta_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Tatuajes/piercings</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="tengo_tatuajes_piercings_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Fumo</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="fumo_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Tomo alcohol</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="tomo_alcohol_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Estudios</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="estudios_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Idiomas</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="idiomas_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Profesi&oacute;n</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="profesion_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Empresa</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="empresa_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Sector</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="sector_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Nivel de ingresos</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="ingresos_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Intereses Profesionales</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="intereses_profesionales_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Habilidades Profesionales</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="habilidades_profesionales_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Mis intereses</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="mis_intereses_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Hobbies</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="hobbies_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Series de TV favoritas</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="series_tv_favoritas_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>						</select>
					</div>
				</div>
				<div class="field">
					<label>M&uacute;sica favorita</label>
					<div class="input-fake">

						<select class="cuenta-save-8" name="musica_favorita_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>

				</div>
				<div class="field">
					<label>Deportes y equipos favoritos</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="deportes_y_equipos_favoritos_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Libros favoritos</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="libros_favoritos_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Peliculas favoritas</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="peliculas_favoritas_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Comida favorita</label>

					<div class="input-fake">
						<select class="cuenta-save-8" name="comida_favorita_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>
							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>

					</div>
				</div>
				<div class="field">
					<label>Mis h&eacute;roes</label>
					<div class="input-fake">
						<select class="cuenta-save-8" name="mis_heroes_son_mostrar">
							<option value="nadie">Nadie</option>
							<option value="amigos">Mis amigos</option>

							<option value="registrados">Usuarios registrados</option>
							<option value="todos" selected="selected">Todos</option>
						</select>
					</div>
				</div>
			</fieldset>
			<div class="buttons">
				<input type="button" class="mBtn btnOk" onclick="cuenta.save(8)" value="Guardar" />

			</div>
			<div class="clearfix"></div>
		</div>

	</form>

	<div class="sidebar-tabs">
		<h3>Mi Avatar</h3>
		<div class="avatar-big-cont">

			<div class="avatar-loading" style="display: none"></div>
			<img class="avatar-big" src="http://a04.t.net.ar/avatares/3/4/7/9/120_3479239.jpg" alt="" width="120" height="120" />
		</div>
		<div class="webcam-capture" style="display: none; margin: 0 0 0 10px">
			<div class="avatar-loading"></div>
			<!--[if !IE]> -->
			<object type="application/x-shockwave-flash" data="/capture.swf" width="225" height="140" wmode="transparent">
			<!-- <![endif]-->
			<!--[if IE]>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="225" height="140">
			<param name="movie" value="/capture.swf" />
			<!-->

			<param name="loop" value="true" />
			<param name="menu" value="false" />
			<param name="wmode" value="transparent" />
			<param name="flashvars" value="id=3479239&s=4&crc=30c3fa19c40330073287e5d2f8dfac87fb86493e&texto=Tomar+foto&host=/upload.php" />
			<p>Tu navegador no soporta flash</p>
			</object>
			<!-- <![endif]-->
		</div>

		<div class="clearfix"></div>
		<ul class="change-avatar" style="display: none">
			<li class="local-file">
				<span><a onclick="avatar.chgtab(this)">Local</a></span>
				<div class="mini-modal">
					<div class="dialog-m"></div>
					<span>Subir Archivo</span>
					<input class="browse" size="15" type="file" id="file-avatar" name="file-avatar" /><br /><button class="avatar-next local" onclick="avatar.upload(this)">Subir</button>

				</div>
			</li>
			<li class="webcam-file">
				<span><a onclick="avatar.chgtab(this)">Webcam</a></span>
			</li>
		</ul>
		<div class="clearfix"></div>
		<a class="edit" onclick="avatar.edit(this)">Editar</a>

	</div>
	<div class="clearfix"></div>

</div>';
}

if($ajax != '1') {
	pie();
}
?>