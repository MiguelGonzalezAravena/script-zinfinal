<?php
include("../header.php");
cabecera_normal();
$key = $_SESSION['id'];

if($key==null){
fatal_error('Para crear comunidades necesitas autentificarte');
}

if(!$grupo_perm['crear_c']){
	fatal_error('Tu rango no te permite crear comunidades');
}

echo <<<EOF
<div id="cuerpocontainer"><div class="comunidades">
<script type="text/javascript">
function validate_form_crear(f, campos){
if(!validate_form(f, campos))
return false;

//Validaciones especiales
if($(f['tipo_val']).val()=='2') //Seleccion automatica de rango
if(!check_complete(f['rango_default'], 'default'))
return false;

return true;
}

</script>

<div id="derecha" style="float:left;width:375px">
<div class="box_title"><div class="box_txt">Reglas para tu comunidad</div></div>
<div class="box_cuerpo">
Para que tu comunidad sea exitosa te recomendamos tener en cuenta los siguientes puntos:

<p><b>Una comunidad SI puede:</b><br /></p>
<ul>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-good.png" /> Compartir ideas y pensamientos.</li>

<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-good.png" /> Ser interesante para otras personas.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-good.png" /> Preguntar y Consultar.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-good.png" /> Compartir ideas y pensamientos.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-good.png" /> Compartir gustos y experiencias personales.</li>
<ul>

<p><b>Una comunidad NO puede:</b><br /></p>
<ul>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Compartir enlaces de descarga.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Generar odio. </li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Generar violencia.</li>

<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Compartir fotos de personas menores de edad.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Mostrar muertos, sangre, v&oacute;mitos, etc.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Tener contenido racista y/o peyorativo.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Que sus miembros insulten a otros.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Hacer apolog&#237;a al delito.</li>

<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Contener software spyware, malware, virus o troyanos.</li>
<li><img vspace="2" align="absmiddle" src="{$url}/images/icon-bad.png" /> Hacer Spam.</li>

</ul>
<br /><br />

<strong>Por favor lea el protocolo para evitar sanciones o que tu comunidad sea eliminada haciendo <a href="/protocolo/" target="_blank">click aqu&#237;</a></strong>

</div>

</div>



<div id="centro">
<div style="background: #f7f7f7">
<div class="titleHighlight">
Crear nueva comunidad</div>
<div class="form-container form2">
<form name="add_comunidad" method="post" action="/comunidades/creando/" onsubmit="return validate_form_crear(this, 'shortname, nombre,imagen,categoria,subcategoria,pais,descripcion,tags')">
<input type="hidden" name="key" value="947264" />

<div class="dataL">
<label for="uname">Nombre de la comunidad</label>
<input class="c_input" type="text" value="" name="nombre" tabindex="1" datatype="text" dataname="Nombre" />
</div>
<div class="dataR">
<span class="gif_cargando floatR" id="shortname" style="top:0px"></span>
<label for="uname">Nombre corto</label>
<input class="c_input" type="text" value="" name="shortname" tabindex="2" onkeyup="com.crear_shortname_key(this.value)" onblur="com.crear_shortname_check(this.value)" datatype="text" dataname="Nombre corto" />

<div class="desform">URL de la comunidad: <br /><strong>http://zinfinal.net/comunidades/<span id="preview_shortname"></span></strong></div>
<span id="msg_crear_shortname"></span>
</div>
<div class="clearBoth"></div>

<div class="dataL">
<label for="uname">Imagen</label>
<input class="c_input" type="text" value="http://" name="imagen" tabindex="3" datatype="url" dataname="Imagen" />

</div>
<div class="dataR">
<label for="fname">Pa&iacute;s</label>
<select id="pais" name="pais" tabindex="4" datatype="select" default="-1" dataname="Pais">
<option value="-1" selected>Seleccionar Pa&iacute;s</option>
<option value="-2">---</option>

<option value="999">Internacional</option>
<option value="-2">---</option>
<option value="0">Argentina</option>
<option value="1">Bolivia</option>
<option value="2">Brasil</option>
<option value="3">Chile</option>

<option value="4">Colombia</option>
<option value="5">Costa Rica</option>
<option value="6">Cuba</option>
<option value="7">Rep&uacute;blica Checa</option>
<option value="8">Ecuador</option>
<option value="9">El Salvador</option>

<option value="10">Espa&ntilde;a</option>
<option value="11">Guatemala</option>
<option value="12">Guinea Ecuatorial</option>
<option value="13">Honduras</option>
<option value="14">Israel</option>
<option value="15">Italia</option>

<option value="16">Jap&oacute;n</option>
<option value="17">M&eacute;xico</option>
<option value="18">Nicaragua</option>
<option value="19">Panam&aacute;</option>
<option value="20">Paraguay</option>

<option value="21">Per&uacute;</option>
<option value="22">Portugal</option>
<option value="23">Puerto Rico</option>
<option value="24">Rep&uacute;blica Dominicana</option>
<option value="25">Estados Unidos</option>
<option value="26">Uruguay</option>

<option value="27">Venezuela</option>
<option value="28">----</option>
<option value="29">Afghanist&aacute;n</option>
<option value="30">Albania</option>
<option value="31">Argelia</option>
<option value="32">Samoa Americana</option>

<option value="33">Andorra</option>
<option value="34">Angola</option>
<option value="35">Anguila</option>
<option value="36">Ant&aacute;rtida</option>
<option value="37">Antigua y Barbuda</option>
<option value="38">Armenia</option>

<option value="39">Aruba</option>
<option value="40">Islas Ashmore y Cartier</option>
<option value="41">Australia</option>
<option value="42">Austria</option>
<option value="43">Azerbaiy&aacute;n</option>
<option value="44">Las Bahamas</option>

<option value="45">Bahr&eacute;in</option>
<option value="46">Isla Baker</option>
<option value="47">Bangladesh</option>
<option value="48">Barbados</option>
<option value="49">Bassas da India</option>
<option value="50">Bielorrusia</option>

<option value="51">B&eacute;lgica</option>
<option value="52">Belice</option>
<option value="53">Ben&iacute;n</option>
<option value="54">Bermuda</option>
<option value="55">But&aacute;n</option>

<option value="56">Bosnia y Herzegovina</option>
<option value="57">Botsuana</option>
<option value="58">Isla Bouvet</option>
<option value="59">Territorio Brit&aacute;nico del Oc&eacute;ano &iacute;ndico</option>
<option value="60">Islas V&iacute;rgenes Brit&aacute;nicas</option>

<option value="61">Brun&eacute;i</option>
<option value="62">Bulgaria</option>
<option value="63">Burkina Faso</option>
<option value="64">Birmania</option>
<option value="65">Burundi</option>
<option value="66">Camboya</option>

<option value="67">Camer&uacute;n</option>
<option value="68">Canad&aacute;</option>
<option value="69">Cabo Verde</option>
<option value="70">Islas Caim&aacute;n</option>
<option value="71">Rep&uacute;blica Centroafricana</option>

<option value="72">Chad</option>
<option value="73">China</option>
<option value="74">Isla de Navidad</option>
<option value="75">Isla de la Pasi&oacute;n</option>
<option value="76">Islas Cocos</option>
<option value="77">Comoros</option>

<option value="78">Rep&uacute;blica Democr&aacute;tica del Congo</option>
<option value="79">Rep&uacute;blica del Congo</option>
<option value="80"> Islas Cook</option>
<option value="81">Coral Sea Islands</option>
<option value="82">Costa de Marfil</option>

<option value="83">Croacia</option>
<option value="84">Chipre</option>
<option value="85">Dinamarca</option>
<option value="86">Yibuti</option>
<option value="87">Dominica</option>
<option value="88">Timor Oriental</option>

<option value="89">Egipto</option>
<option value="90">Eritrea</option>
<option value="91">Estonia</option>
<option value="92">Etiop&iacute;a</option>
<option value="93">Isla Europa</option>
<option value="94">Islas Malvinas</option>

<option value="95">Islas Feroe</option>
<option value="96">Fiyi</option>
<option value="97">Finlandia</option>
<option value="98">Francia</option>
<option value="99">Guayana Francesa</option>
<option value="100">Polinesia Francesa</option>

<option value="101">Tierras australes y ant&aacute;rticas francesas</option>
<option value="102">Gab&oacute;n</option>
<option value="103">Gambia</option>
<option value="104">Georgia</option>
<option value="105">Alemania</option>

<option value="106">Ghana</option>
<option value="107">Gibraltar</option>
<option value="108">Islas Gloriosas</option>
<option value="109">Grecia</option>
<option value="110">Groenlandia</option>
<option value="111">Granada</option>

<option value="112">Guadalupe</option>
<option value="113">Guam</option>
<option value="114">Guernsey</option>
<option value="115">Guinea</option>
<option value="116">Guinea-Bissau</option>
<option value="117">Guyana</option>

<option value="118">Hait&iacute;</option>
<option value="119">Islas Heard y McDonald Islas</option>
<option value="120">Ciudad del Vaticano</option>
<option value="121">Hong Kong</option>
<option value="122">Howland Island</option>
<option value="123">Hungr&iacute;a</option>

<option value="124">Islandia</option>
<option value="125">India</option>
<option value="126">Indonesia</option>
<option value="127">Iran</option>
<option value="128">Iraq</option>
<option value="129">Irlanda</option>

<option value="130">Jamaica</option>
<option value="131">Isla Jan Mayen</option>
<option value="132">Isla Jarvis</option>
<option value="133">Bailiazgo de Jersey</option>
<option value="134">Atol&oacute;n Johnston</option>
<option value="135">Jordan</option>

<option value="136">Isla Juan de Nova</option>
<option value="137">Kazajist&aacute;n</option>
<option value="138">Kenia</option>
<option value="139">Arrecife Kingman</option>
<option value="140">Kiribati</option>
<option value="141">Corea del Norte</option>

<option value="142">Corea del Sur</option>
<option value="143">Kuwait</option>
<option value="144">Kirguist&aacute;n</option>
<option value="145">Laos</option>
<option value="146">Letonia</option>
<option value="147">L&iacute;bano</option>

<option value="148">Lesoto</option>
<option value="149">Liberia</option>
<option value="150">Libia</option>
<option value="151">Liechtenstein</option>
<option value="152">Lituania</option>
<option value="153">Luxemburgo</option>

<option value="154">Macao</option>
<option value="155">Macedonia</option>
<option value="156">Madagascar</option>
<option value="157">Malaui</option>
<option value="158">Malasia</option>
<option value="159">Maldivas</option>

<option value="160">Mali</option>
<option value="161">Malta</option>
<option value="162">Isla de Man</option>
<option value="163">Islas Marshall</option>
<option value="164">Martinica</option>
<option value="165">Mauritania</option>

<option value="166">Mauricio</option>
<option value="167">Mayotte</option>
<option value="168">Estados Federados de Micronesia</option>
<option value="169">Islas Midway</option>
<option value="170">Rep&uacute;blica de Moldavia</option>
<option value="171">M&oacute;naco</option>

<option value="172">Mongolia</option>
<option value="173">Montenegro</option>
<option value="174">Montserrat</option>
<option value="175">Marruecos</option>
<option value="176">Mozambique</option>
<option value="177">Namibia</option>

<option value="178">Naur&uacute;</option>
<option value="179">Navassa Island</option>
<option value="180">Nepal</option>
<option value="181">Holanda</option>
<option value="182">Antillas Neerlandesas</option>
<option value="183">Neutral Zone</option>

<option value="184">Nueva Caledonia</option>
<option value="185">Nueva Zelanda</option>
<option value="186">N&iacute;ger</option>
<option value="187">Nigeria</option>
<option value="188">Niue</option>
<option value="189">Isla Norfolk</option>

<option value="190">Islas Marianas del Norte</option>
<option value="191">Noruega</option>
<option value="192">Om&aacute;n</option>
<option value="193">Pakist&aacute;n</option>
<option value="194">Palau</option>

<option value="195">Atol&oacute;n Palmyra</option>
<option value="196">Pap&uacute;a Nueva Guinea</option>
<option value="197">Islas Paracel</option>
<option value="198">Filipinas</option>
<option value="199">Islas Pitcairn</option>

<option value="200">Polonia</option>
<option value="201">Qatar</option>
<option value="202">Reuni&oacute;n</option>
<option value="203">Rumania</option>
<option value="204">Rusia</option>
<option value="205">Ruanda</option>

<option value="206">Santa Helena</option>
<option value="207">San Crist&oacute;bal y Nieves</option>
<option value="208">Santa Luc&iacute;a</option>
<option value="209">San Pedro y Miguel&oacute;n</option>
<option value="210">San Vicente y las Granadinas</option>

<option value="211">Samoa</option>
<option value="212">San Marino</option>
<option value="213">Santo Tom&eacute; y Pr&iacute;ncipe</option>
<option value="214">Arabia Saudita</option>
<option value="215">Senegal</option>

<option value="216">Serbia</option>
<option value="217">Seychelles</option>
<option value="218">Sierra Leone</option>
<option value="219">Singapur</option>
<option value="220">Eslovaquia</option>
<option value="221">Eslovenia</option>

<option value="222">Islas Salom&oacute;n</option>
<option value="223">Somalia</option>
<option value="224">Sud&aacute;frica</option>
<option value="225">Georgia del Sur e Islas Sandwich del Sur</option>
<option value="226">Islas Spratly</option>

<option value="227">Sri Lanka</option>
<option value="228">Sud&aacute;n</option>
<option value="229">Surinam</option>
<option value="230">Svalbard</option>
<option value="231">Swazilandia</option>
<option value="232">Suecia</option>

<option value="233">Suiza</option>
<option value="234">Rep&uacute;blica &aacute;rabe Siria</option>
<option value="235">Taiw&aacute;n</option>
<option value="236">Tayikist&aacute;n</option>
<option value="237">Rep&uacute;blica Unida de Tanzania</option>

<option value="238">Tailandia</option>
<option value="239">Togo</option>
<option value="240">Tokelau</option>
<option value="241">Tonga</option>
<option value="242">Trinidad y Tobago</option>
<option value="243">Isla Tromelin</option>

<option value="244">T&uacute;nez</option>
<option value="245">Turqu&iacute;a</option>
<option value="246">Turkmenist&aacute;n</option>
<option value="247">Islas Turcas y Caicos</option>
<option value="248">Tuvalu</option>

<option value="249">Uganda</option>
<option value="250">Ucrania</option>
<option value="251">Emigratos &aacute;rabes Unidos</option>
<option value="252">Reino Unido</option>
<option value="253">Uzbekist&aacute;n</option>

<option value="254">Vanuatu</option>
<option value="255">Vietnam</option>
<option value="256">Islas V&iacute;rgenes</option>
<option value="257">Wake Island</option>
<option value="258">Wallis y Futuna</option>
<option value="259">S&aacute;hara Occidental</option>

<option value="260">Yemen</option>
<option value="261">Zambia</option>
<option value="262">Zimbabwe</option>
</select>
</div>
<div class="clearBoth"></div>

<div class="dataL">

<label for="fname">Categoria</label>
<select class="agregar_categoria" name="categoria" tabindex="5" datatype="select" default="-1" dataname="Categoria" onchange="com.get_subcategorias(this.value)">
<option value="-1" selected="true">Elegir una categor&iacute;a</option>
<option value="9">Arte y Literatura</option>
<option value="1">Deportes</option>
<option value="0">Diversi&oacute;n y Esparcimiento</option>

<option value="2">Econom&iacute;a y Negocios</option>
<option value="3">Entretenimiento y Medios</option>
<option value="7">Grupos y Organizaciones</option>
<option value="8">Inter&eacute;s general</option>
<option value="5">Internet y Tecnolog&iacute;a</option>

<option value="6">M&uacute;sica y Bandas</option>
<option value="4">Regiones</option>
</select>
</div>
<div class="dataR">
<span class="gif_cargando floatR" id="subcategoria" style="top:0px"></span>
<label for="fname">Sub-Categoria</label>

<select class="agregar_subcategoria" name="subcategoria" tabindex="6" datatype="select" default="-1" dataname="Subcategoria" disabled="true">
<option value="-1" selected="true">Elegir una subcategor&iacute;a</option>
</select>
</div>
<div class="clearBoth"></div>

<div class="data">
<label for="uname">Descripcion</label>

<textarea class="c_input_desc autogrow" style="resize: none;" name="descripcion" tabindex="7" datatype="text" dataname="Descripcion"></textarea>
</div>
<div class="data">
<label for="uname">Tags</label>
<input class="c_input" name="tags" type="text" value="" tabindex="8" datatype="tags" dataname="Tags" />
<div class="desform">
Ej: gol, ingleses, Mundial 86, futbol, Maradona, Argentina
</div>

</div>

<hr style="clear:both;margin-bottom:15px;margin-top:20px;" class="divider"/>


<div class="dataL dataRadio">
<label for="lname">Acceso</label>
<div class="postLabel">
<input name="privada" id="privada_1" type="radio" value="1" checked tabindex="9" /><label for="privada_1">Todos</label><br />
<p class="descRadio">

              Todas las personas que visitan ZinFinal podr&aacute;n acceder a tu comunidad. (Recomendado)
</p>
<input name="privada" id="privada_2" type="radio" value="2" /><label for="privada_2">S&oacute;lo usuarios registrados</label><br />
            <p class="descRadio">
                  El acceso a tu comunidad estar&aacute; restringida &uacute;nicamente para los usuarios que se han registrado en ZinFinal
    </p>            
            </div>
</div>


<div class="data" style="display:none">

<label for="lname">Tipo de validaci&oacute;n</label>
<div class="postLabel">
<input name="tipo_val" type="radio" value="1" checked onclick="com.create_show_rango_def(true)" /> Autom&aacute;tica<br />
<input name="tipo_val" type="radio" value="2" tabindex="10" onclick="com.create_show_rango_def(false)" /> Manual
</div>
</div>

<div class="dataR dataRadio" id="rango_default">
<label for="fname">Permisos</label>
<div class="postLabel">
<input name="rango_default" id="permisos_1" type="radio" value="3" checked tabindex="11" /><label for="permisos_1">Posteador</label><br />
<p class="descRadio">
              Los usuarios al ingresar en tu comunidad podr&aacute;n comentar y crear temas.
</p>
<input name="rango_default" id="permisos_2" type="radio" value="2" /><label for="permisos_2">Comentador</label><br />

<p class="descRadio">
 Los usuarios al participar en tu  comunidad s&oacute;lo podr&aacute;n comentar pero no estar&aacute;n habilitados para crear nuevos temas.
</p>
<input name="rango_default" id="permisos_3" type="radio" value="1" /><label for="permisos_3">Visitante</label><br />
<p class="descRadio">
              Los usuarios al participar en tu comunidad no podr&aacute;n comentar ni tampoco crear temas.
</p>
</div>
<div style="color:#666;font-weight:normal;margin:5px 0">

  <strong>Nota:</strong>
  La opci&oacute;n seleccionada le asignar&aacute; autom&aacute;ticamente el mismo rango a todos los usuarios que ingresan a tu comunidad, sin embargo, podr&aacute;s posteriormente modificarlo para cada uno de los participantes.
          </div>
</div>

<hr style="clear:both;margin-bottom:15px;margin-top:20px;" class="divider"/>

<div id="buttons">
<input class="mBtn btnOk" type="submit" tabindex="14" title="Crear comunidad" value="Crear comunidad" class="button" name="Enviar" />
</div>

</form>
</div>
</div>
</div>
<div id="izquierda" style="float:right; display:none">
<div class="box_title">
<div class="box_txt para_un_buen_post">Vista Previa</div>
<div class="box_rss"></div>
</div>
<div class="box_cuerpo">
<div class="avaComunidad">
<a href="/comunidades/putore/">
<img onerror="com.error_logo(this)" title="Logo de la comunidad" alt="Logo de la comunidad" src="{$url}/images/avatar.gif" class="avatar"/>
</a>
</div>
<h2><a href="/comunidades/putore/">Nombre</a></h2>
</div>
</div>
</div>
EOF;
pie();
?>