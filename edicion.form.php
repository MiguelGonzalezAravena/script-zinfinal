<?php
include("header.php");
$titulo	= $descripcion;
cabecera_normal();
$id = (int) $_GET["id"];

if($key==null){
	fatal_error('Para Editar tus posts necesitas autentificarte.');
}

$dbpost = mysql_query("SELECT * FROM posts where postid = '{$id}' ");

if(!mysql_num_rows($dbpost)){
	fatal_error('No Existe este Posts');
}

$postz = mysql_fetch_array($dbpost);
mysql_free_result($dbpost);

if($grupo_perm['editar_p']==0){
	fatal_error('Este post no te pertenece y no puedes editarlo!');
}

echo '
<div id="cuerpocontainer">
<div id="preview" style="display:none"></div>
	<script type="text/javascript">
		function show_preview(titulo,cuerpo,tags,f){
			if(cuerpo.length>63206){
				alert(\'El post es demasiado largo. No debe exceder los 65000 caracteres.\');
				return false;
			}

			if(f.categoria.options.selectedIndex==-1 || f.categoria.options[f.categoria.options.selectedIndex].value==-1){
				alert(\'Falta la categoria\');
				return false;
			}

			if(cuerpo.indexOf(\'imageshack.us\')>0){
				alert(\'No se permiten imagenes de IMAGESHACK.\');
				return false;
			}

			if(cuerpo == \'\'){
				alert(\'El post esta VACIO.\');
				return false;
			}

			if(titulo == \'\'){
				alert(\'El post NO TIENE TITULO.\');
				return false;
			}

			if(tags == \'\'){
				alert(\'Ingresar TAGS!\');
				return false;
			}

      var separar_tags = tags.split(",");

			if(separar_tags.length < 4){
        alert(\'Tenes que ingresar por lo menos 4 tags separados por coma.\nLos tags son una lista de palabras separada por comas, que describen el contenido.\nEjemplo: gol, ingleses, Mundial 86, futbol, Maradona, Argentina\');
        return;
      }

			var params = \'titulo=\' + encodeURIComponent(titulo) + \'&cuerpo=\' + encodeURIComponent(cuerpo);

      $.ajax({
        type: "POST",
        url: \'/preview.php\',
        data: params,
        success: function(h){
    			scrollUp();
          $(\'#preview\').html(h);
          $(\'#preview\').css(\'display\',\'inline\');
        }
      });
		}

		function scrollUp(){
			var cs = (document.documentElement && document.documentElement.scrollTop)? document.documentElement : document.body;
			var step = Math.ceil(cs.scrollTop / 10);
			scrollBy(0, (step-(step*2)));
			if(cs.scrollTop>0)
        setTimeout(\'scrollUp()\', 40);
		}

		function kill_preview(){
			$(\'#preview\').html(\'\');
			$(\'#preview\').css(\'display\',\'none\');
		}

        var confirm = true;
        window.onbeforeunload = confirmleave;
        function confirmleave() {
            if (confirm && ($(\'input[name=titulo]\').val() || $(\'textarea[name=cuerpo]\').val())) return "Este post no fue publicado y se perdera.";
        }

        function _capsprot(s) {
            var len = s.length, strip = s.replace(/([A-Z])+/g, \'\').length, strip2 = s.replace(/([a-zA-Z])+/g, \'\').length,
            percent = (len  - strip) / (len - strip2) * 100;
            return percent;
        }
        $(document).ready(function(){
            $(\'input[name=titulo]\').keyup(function(){
                if ($(this).val().length >= 5 && _capsprot($(this).val()) > 90) $(\'.capsprot\').show();
                else $(\'.capsprot\').hide();
            });
        });

				</script>

				<div id="form_div">
				<div class="container250 floatL">
				
				
					<div class="box_title">
						<div class="box_txt para_un_buen_post"> Para hacer un buen post</div>
						<div class="box_rrs"><div class="box_rss"></div></div>
					</div>
					<div class="box_cuerpo">
						Para hacer un buen post es importante que tengas en cuenta los siguientes puntos. Esto ayuda a mantener una mejor calidad de contenido y evitar que sea eliminado por los moderadores.						<p>

							<b>El t&iacute;tulo:</b>
							<br />
							<ul>
								<li><img src="'.$images.'/images/icon-good.png" align="absmiddle" vspace="2"> Que sea descriptivo</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2"> TODO EN MAYUSCULA</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2"> !!!!!!!Exagerados!!!!!!</a></li>

								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2"> PARCIALMENTE en mayusculas!</li>
							</ul>
						</p>
						<p>
							<b>Contenido:</b>
							<br />
							<ul>

								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Informaci&oacute;n personal o de un tercero</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Fotos de personas menores de edad</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Muertos, sangre, v&oacute;mitos, etc.</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Con contenido racista y/o peyorativo</li>

								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Poca calidad (una imagen, texto pobre)</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Chistes escritos, adivinanzas, trivias</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Haciendo preguntas o criticas.</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Insultos o malos modos.</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Con intenci&oacute;n de armar pol&eacute;mica.</li>

								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Apolog&iacute;a de delito.</li>
								<li><img src="'.$images.'/images/icon-bad.png" align="absmiddle" vspace="2" /> Software spyware, malware, virus o troyanos.</li>
							</ul>
						</p>
						<p>
							<b>Atenci&oacute;n:</b>

							<br />
							<ul>
								<li>Taringa NO acepta contenido sexual o er&oacute;tico. Para postear ese tipo de contenido existe <a href=\'http://www.poringa.net/\'>Poringa</a></li>
								<li>Si se comparte un video o un swf publicar la URL</li>
								<li>Indicar la fuente si no es material propio.</li>
							</ul>

						</p>
					</div>
				</div>
				<div id="post_agregar" class="floatR">
					<div class="box_title">
						<div class="box_txt agregar_post">Agregar nuevo post</div>
						<div class="box_rrs"><div class="box_rss"></div></div>
					</div>

						<div id="mensaje-top">
							<a href="/protocolo/" target="_blank">Importante: antes de crear un post lee el protocolo.</a>
						</div>
							<div class="box_cuerpo">
								<form name="newpost" method="post" action="/edicion.php?id='.$id.'">
								<input type="hidden" name="id" value="'.$id.'">
															<b>T&iacute;tulo:</b><br /><input class="agregar titulo" type="text" size="60" maxlength="60" name="titulo" value="'.$postz['titulo'].'" tabindex="1" /><span class="capsprot">El titulo no debe estar en may&uacute;sculas</span><br /><br />

								<b>Mensaje del post:</b><br />
								<textarea id="markItUp" class="agregar cuerpo" name="cuerpo" tabindex="2">'.$postz['contenido'].'</textarea>
								<div id="emoticons" style="float:left">
																		<a href="#" smile=":)"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-286px; clip:rect(286px 16px 302px 0px);" alt="sonrisa" title="sonrisa" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=";)"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-308px; clip:rect(308px 16px 324px 0px);" alt="gui&ntilde;o" title="gui&ntilde;o" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":roll:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-330px; clip:rect(330px 16px 346px 0px);" alt="duda" title="duda" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":P"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-352px; clip:rect(352px 16px 368px 0px);" alt="lengua" title="lengua" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":D"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-374px; clip:rect(374px 16px 390px 0px);" alt="alegre" title="alegre" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>

									<a href="#" smile=":("><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-396px; clip:rect(396px 16px 412px 0px);" alt="triste" title="triste" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile="X("><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-418px; clip:rect(418px 16px 434px 0px);" alt="odio" title="odio" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":cry:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-440px; clip:rect(440px 16px 456px 0px);" alt="llorando" title="llorando" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":twisted:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-462px; clip:rect(462px 16px 478px 0px);" alt="endiablado" title="endiablado" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":|"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-484px; clip:rect(484px 16px 500px 0px);" alt="serio" title="serio" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":?"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-506px; clip:rect(506px 16px 522px 0px);" alt="duda" title="duda" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":cool:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-528px; clip:rect(528px 16px 544px 0px);" alt="picaro" title="picaro" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":oops:"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-550px; clip:rect(550px 16px 566px 0px);" alt="timido" title="timido" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile="^^"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-572px; clip:rect(572px 16px 588px 0px);" alt="sonrizota" title="sonrizota" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>

									<a href="#" smile="8|"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-594px; clip:rect(594px 16px 610px 0px);" alt="increible!" title="increible!" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
									<a href="#" smile=":F"><span style="position:relative;"><img border=0 src="'.$images.'/images/big2.gif" style="position:absolute; top:-616px; clip:rect(616px 16px 632px 0px);" alt="babaaa" title="babaaa" /><img border=0 src="'.$images.'/images/space.gif" style="width:20px;height:16px" align="absmiddle" /></span></a>
								</div>
								<script type="text/javascript">function openpopup(){var winpops=window.open("/emoticones.php","","width=180px,height=500px,scrollbars,resizable");}</script>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'javascript:openpopup()\'>M&aacute;s Emoticones</a>
								<br />
								<br />

								<input class="agregar fuente" type="hidden" name="fuente" value="" />
								<b>Tags:</b><br /><input class="agregar tags" type="text" size="60" maxlength="128" name="tags" value="'.$postz['tags'].'" tabindex="4" /><br />
								<font class="size9">Una lista separada por comas, que describa el contenido. Ejemplo: <b>gol, ingleses, Mundial 86, futbol, Maradona, Argentina</b></font><br /><br />
								<b>Nota:</b> Cuanto mejor uses los tags, otros usuarios podr&aacute;n encontrar tu post m&aacute;s f&aacute;cilmente y por ende, conseguir&aacute;s m&aacute;s visitas.								<br /><br />

								<b>Categor&iacute;a:</b>
								<br />
								<select class="agregar" name="categoria" size="34" style="width:230px;" tabindex="5">
<option value="-1" selected="selected">Elegir una categor&iacute;a</option> ';

$sqlc = mysql_query("SELECT id_categoria, nom_categoria FROM categorias ORDER BY nom_categoria asc");

while($categorias = mysql_fetch_array($sqlc)) {
	echo "<option value=\"{$categorias['id_categoria']}\"".($postz['categoria'] == $categorias['id_categoria'] ? ' selected="true"' : '').">{$categorias['nom_categoria']}</option>\n";
}

mysql_free_result($sqlc);

echo '								</select>
								<br />

								<br />';
								
if($global_user['rango']!='11') {
	echo '<b>Opciones:</b><br />
	<input class="agregar check" type="checkbox" name="privado" '.($postz['privado'] == '1' ? 'checked="checked"' : '').'/> Solo usuarios registrados<br /><br />	';
}

if($global_user['rango']=='255' xor $global_user['rango']=='100'){
	echo '<b>Opciones Avanzadas:</b><br /><input class="agregar check" type="checkbox" name="sticky" '.($postz['sticky'] == '1' ? 'checked="checked"' : '').'/> Establecer como Sticky<br />
	<input class="agregar check" type="checkbox" name="patrocinado" '.($postz['patrocinado'] == '1' ? 'checked="checked"' : '').'/> Establecer como Patrocinado y Sticky<br />
	<input class="agregar check" type="checkbox" name="coments" '.($postz['coments'] == '1' ? 'checked="checked"' : '').'/> No permitir comentarios<br />';
}

if($global_user['rango']=='50'){
	echo '<input class="agregar check" type="checkbox" name="patrocinado" '.($postz['patrocinado'] == '1' ? 'checked="checked"' : '').'/> Establecer como Patrocinado y Sticky<br />';
}

if($global_user['rango']=='255' xor $global_user['rango']=='100'){
	echo '<br /><b>Causa de la Edicion:</b><br /><input class="agregar tags" type="text" size="80" maxlength="80" name="causa"/><br /><br />';
}
								
echo '
								<div class="clearBoth"></div>
								<center>
									<input class="button" type="button" onclick="show_preview(this.form.titulo.value, this.form.cuerpo.value, this.form.tags.value, this.form)" class="button" style="font-size:15px" value="Previsualizar" title="Previsualizar" tabindex="8">
								</center>
										</form>
							</div>
					</div>

				</div>';

pie();
?>