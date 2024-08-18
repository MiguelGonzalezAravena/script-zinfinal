<?php
include("header.php");
$seccion = 'tops';
cabecera_normal();

switch($_GET['fecha']) {
case "-1":
$fecha = 'Todos los Tiempos';
break;
case "1":
$fecha = 'Hoy';
break;
case "2":
$fecha = 'Ayer';
break;
case "3":
$fecha = 'Ultimos 7 Dias';
break;
case "4":
$fecha = 'Del Mes';
break;
case "5":
$fecha = 'Mes Anterior';
break;
default:
$fecha = 'hoy';
}

$top_pn=1;
$top_cn=1;
$top_fn=1;
$top_vn=1;
$top_upn=1;

echo '<div id="cuerpocontainer">

							<div class="box_cuerpo"  align="center">
							<form name="buscador" action="/top/">
							<b>TOPs de </b>
										<select name="fecha">
											<option value="-1" >Todos los tiempos</option>
											<option value="1"  selected="1">Hoy</option>
											<option value="2" >Ayer</option>
											<option value="3" >Ultimos 7 d&iacute;as</option>
											<option value="4" >Del mes</option>
											<option value="5" >Mes Anterior</option>
										</select>
							<b>de la Categoria:</b>

							&nbsp;
							<select name="cat">
								<option value="-1">Todas</option>';
								
$categorias = mysql_query("SELECT * FROM categorias ORDER BY nom_categoria ASC");

while($cate = mysql_fetch_array($categorias)){
	echo '<option value="'.$cate['id_categoria'].'">'.$cate['nom_categoria'].'</option>';
}

mysql_free_result($categorias);

echo '</select>

 
							<input type="submit" class="login" style="font-size:12px;width:100px;" value="Filtrar" title="Filtrar">
							</form>
							</div>
							<br />

				<div class="tops" id="izquierda">
					<div class="box_title">
						<div class="box_txt tops_box">Top post con m&aacute;s puntos</div>

						<div class="box_rss"></div>
					</div>
					<div class="box_cuerpo" style="height: 215px">';
					
$top_p = mysql_query("SELECT p.postid, p.titulo, p.puntos, p.creado, c.link_categoria 
FROM (posts AS p, categorias AS c) 
WHERE p.categoria=c.id_categoria AND p.estado=0 
ORDER BY p.puntos DESC LIMIT 15");

if(mysql_num_rows($top_p)==0) {
	echo 'Nada por aqu&iacute;...';
	
} else {
	while($row = mysql_fetch_array($top_p)) {
		echo "<b>".$top_pn++."</b> - <a href='/posts/".$row['link_categoria']."/".$row['postid']."/".corregir($row['titulo']).".html' alt = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' title = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' >".cortar($row['titulo'],32)."</a> (".$row['puntos']." pnt)<br />";
	}
	mysql_free_result($top_p);
}

echo '	</div>

						<br>
					<div class="box_title">
						<div class="box_txt tops_box">Top post m&aacute;s comentado</div>
						<div class="box_rss"></div>
					</div>
					<div class="box_cuerpo" style="height: 215px">';
					
$top_c = mysql_query("SELECT p.postid, p.titulo, p.puntos, p.comentarios, p.creado, c.link_categoria 
FROM (posts AS p, categorias AS c) 
WHERE p.categoria=c.id_categoria AND p.estado=0 
ORDER BY p.comentarios DESC LIMIT 15");

if(mysql_num_rows($top_c)==0) {
	echo 'Nada por aqu&iacute;...';
	
} else {
	while($row = mysql_fetch_array($top_c)) {
		echo "<b>".$top_cn++."</b> - <a href='/posts/".$row['link_categoria']."/".$row['postid']."/".corregir($row['titulo']).".html' alt = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' title = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' >".cortar($row['titulo'],32)."</a> (".$row['comentarios']." com)<br />";
    }
    mysql_free_result($top_c);
}
					
					echo '</div>

				</div>
				
				
				<div class="tops" id="centro">
					<div class="box_title">
						<div class="box_txt tops_box">Top post m&aacute;s favorito</div>
						<div class="box_rss"></div>
					</div>
					<div class="box_cuerpo" style="height: 215px">';
					
$top_f = mysql_query("SELECT p.postid, p.titulo, p.puntos, p.favoritos, p.creado, c.link_categoria 
FROM (posts AS p, categorias AS c) 
WHERE p.categoria=c.id_categoria AND p.estado=0 
ORDER BY p.favoritos DESC LIMIT 15");

if(mysql_num_rows($top_f)==0) {
	echo 'Nada por aqu&iacute;...';
	
} else {
	while($row = mysql_fetch_array($top_f)) {
		echo "<b>".$top_fn++."</b> - <a href='/posts/".$row['link_categoria']."/".$row['postid']."/".corregir($row['titulo']).".html' alt = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' title = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' >".cortar($row['titulo'],32)."</a> (".$row['favoritos']." fav)<br />";
	}
	mysql_free_result($top_f);
}

echo '</div>

					<br />
					<div class="box_title">
						<div class="box_txt tops_box">Top post m&aacute;s visitado</div>
						<div class="box_rss"></div>
					</div>
					<div class="box_cuerpo" style="height: 215px">';
					
$top_v = mysql_query("SELECT p.postid, p.titulo, p.puntos, p.visitas, p.creado, c.link_categoria 
FROM (posts AS p, categorias AS c) 
WHERE p.categoria=c.id_categoria AND p.estado=0 
ORDER BY p.visitas DESC LIMIT 15");

if(mysql_num_rows($top_v)==0) {
	echo 'Nada por aqu&iacute;...';
	
} else {
	while($row = mysql_fetch_array($top_v)) {
		echo "<b>".$top_vn++."</b> - <a href='/posts/".$row['link_categoria']."/".$row['postid']."/".corregir($row['titulo']).".html' alt = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' title = '".$row['titulo']." - ".$row['link_categoria']." - 03/05/2010 12:05' >".cortar($row['titulo'],32)."</a> (".$row['visitas']." vis)<br />\n";
	}
	mysql_free_result($top_v);
}

echo '</div>

				</div>
				
				<div class="tops" id="derecha">
					<div class="box_title">
						<div class="box_txt tops_box">Top usuario con m&aacute;s puntos</div>
						<div class="box_rss"></div>
					</div>
					<div class="box_cuerpo" style="height: 215px">';
					
$top_up = mysql_query("SELECT id, nick, puntos 
FROM usuarios 
WHERE ban = 0 
ORDER BY puntos DESC LIMIT 15");

if(mysql_num_rows($top_up)==0) {
	echo 'Nada por aqu&iacute;...';
	
} else {
	while($row = mysql_fetch_array($top_up)){
		echo "\n<b>".$top_upn++."</b> - <a href='/perfil/".$row['id']."' >".$row['nick']."</a> (".$row['puntos']." puntos)<br />";
	}
	mysql_free_result($top_up);
}

echo "\n</div></div>";

pie();
?>
<?php
include("header.php");
cabecera_normal();

class tops {
	
	private $seccion;
	public $periodos;
	public $bloque_post = array('puntos' => 'puntos-n',
	'favoritos' => 'favoritos-n',
	'comentarios' => 'comentarios-n',
	'seguidores' => 'follow-n');
	
	public $bloque_comunidades = array('puntos' => '','comentarios' => '','favoritos' => '','seguidores' => '');
	public $bloque_temas = array('puntos' => '','comentarios' => '','favoritos' => '','seguidores' => '');
	public $bloque_usuarios = array('puntos' => '','comentarios' => '','favoritos' => '','seguidores' => '');
	public $db;
	
	public function  ($periodo,$categoria) {
		
		$this->periodos = $periodo;
		switch ($this->seccion) {
			case 'posts':
				foreach($this->bloque_post as $name => $style)
				    $aaa = 
				break;
			default:
				//code
				break;
		}

		
		
		
		$this->db = mysql_query("SELECT p.postid, p.titulo, p.puntos, p.creado, c.link_categoria 
		FROM (posts AS p, categorias AS c) 
		WHERE p.categoria=c.id_categoria AND p.estado=0 
		ORDER BY p.puntos DESC LIMIT 15");

	}
	
	public function seccion () {
		
	}
	
	public function template () {
		
		while ($datos = mysql_fetch_array($this->db)) {
			
			echo '<li class="categoriaPost clearfix offtopic">
					<a href="/posts/offtopic/'.$datos['postid'].'/'.corregir($datos['titulo']).'.html">'.$datos['titulo'].'</a>
					<span>'.$datos['puntos'].'</span>
				</li>';
			
		}
		
		mysql_free_result($this->db);
	
		echo '';
	}
	
}

$top_puntos = new tops ();

echo $top_puntos->puntos('puntos','Top post m&aacute;s favorito');

echo '<div id="cuerpocontainer">
	<div class="left" style="float:left;width:150px">
		<div class="boxy">
			<div class="boxy-title">
				<h3>Filtrar</h3>

				<span class="icon-noti"></span>
			</div>
			<div class="boxy-content">
				<h4>Categor&iacute;a</h4>
				<select onchange="location.href=\'/top/posts/?fecha=4&cat=\'+$(this).val()">
					<option value="-1">Todas</option>
										<option value="7">Animaciones</option>

										<option value="18">Apuntes y Monograf&iacute;as</option>
										<option value="4">Arte</option>
										<option value="25">Autos y Motos</option>
										<option value="17">Celulares</option>
										<option value="33">Ciencia y Educaci&oacute;n</option>

										<option value="19">Comics e Historietas</option>
										<option value="16">Deportes</option>
										<option value="9">Downloads</option>
										<option value="23">E-books y Tutoriales</option>
										<option value="34">Ecolog&iacute;a</option>
										<option value="29">Econom&iacute;a y Negocios</option>

										<option value="24">Femme</option>
										<option value="35">Hazlo tu mismo</option>
										<option value="26">Humor</option>
										<option value="1">Im&aacute;genes</option>
										<option value="12">Info</option>
										<option value="0">Juegos</option>

										<option value="2">Links</option>
										<option value="15">Linux y GNU</option>
										<option value="22">Mac</option>
										<option value="32">Manga y Anime</option>
										<option value="30">Mascotas</option>
										<option value="8">M&uacute;sica</option>

										<option value="10">Noticias</option>
										<option value="5">Off-topic</option>
										<option value="21">Recetas y Cocina</option>
										<option value="27">Salud y Bienestar</option>
										<option value="20">Solidaridad</option>
										<option value="28">Taringa!</option>

										<option value="31">Turismo</option>
										<option value="13">TV, Peliculas y series</option>
										<option value="3">Videos On-line</option>
									</select>
				<hr />
				<h4>Per&iacute;odo</h4>

				<ul>
					<li><a href="/top/posts/?fecha=-1&cat=-1">Todos los tiempos</a></li>
					<li><a href="/top/posts/?fecha=1&cat=-1">Hoy</a></li>
					<li><a href="/top/posts/?fecha=2&cat=-1">Ayer</a></li>
					<li><a href="/top/posts/?fecha=3&cat=-1">&Uacute;ltimos 7 d&iacute;as</a></li>
					<li><a href="/top/posts/?fecha=4&cat=-1" class="selected">Del mes</a></li>

					<li><a href="/top/posts/?fecha=5&cat=-1">Mes anterior</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="right" style="float:left;margin-left:10px;width:775px">

		<div class="boxy xtralarge">
			<div class="boxy-title">

				<h3>Top post con m&aacute;s puntos</h3>
				<span class="icon-noti puntos-n"></span>
			</div>
			<div class="boxy-content">
						<ol>';

echo $top_puntos->template();

echo '
							</ol>
						</div>
		</div>

		<div class="boxy xtralarge">
			<div class="boxy-title">
				<h3>Top post m&aacute;s favorito</h3>

				<span class="icon-noti favoritos-n"></span>
			</div>
			<div class="boxy-content">
						<ol>
								<li class="categoriaPost clearfix ebooks-tutoriales">
					<a href="/posts/ebooks-tutoriales/5656317/Eliminar-virus-sin-antivirus.html">Eliminar virus sin antivirus</a>
					<span>2540</span>
				</li>

								<li class="categoriaPost clearfix ebooks-tutoriales">
					<a href="/posts/ebooks-tutoriales/5885479/El-Post-Mas-Largo-Del-Mundo-Entero.html">El Post Mas Largo Del Mundo Entero</a>
					<span>1418</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5834877/Lo-prometido!,-parece-que-me-excedi,-ilustraciones-bizarras.html">Lo prometido!, parece que me excedi, ilustraciones bizarras</a>
					<span>964</span>

				</li>
								<li class="categoriaPost clearfix ciencia-educacion">
					<a href="/posts/ciencia-educacion/5700185/La-Argentina-que-no-nos-muestran___.html">La Argentina que no nos muestran...</a>
					<span>865</span>
				</li>
								<li class="categoriaPost clearfix info">
					<a href="/posts/info/5661667/Hace-4-años-desaparecía-Magic-Kids.html">Hace 4 años desaparecía Magic Kids</a>

					<span>821</span>
				</li>
								<li class="categoriaPost clearfix tv-peliculas-series">
					<a href="/posts/tv-peliculas-series/5723912/--1-Link-MegaUpload---Peliculas-DvdRip---latino---Avi--.html">- 1 Link MegaUpload - Peliculas DvdRip - latino - Avi -</a>
					<span>743</span>
				</li>
								<li class="categoriaPost clearfix linux">

					<a href="/posts/linux/5704951/Lo-Mejor-de-Linux-y-mucho-mas!-[Entrá,-Imperdible!].html">Lo Mejor de Linux y mucho mas! [Entrá, Imperdible!]</a>
					<span>741</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5659329/Transformación-de-dos-bicicletas-a-un-Porsche!.html">Transformación de dos bicicletas a un Porsche!</a>
					<span>707</span>
				</li>

								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5825457/Asi-son-las-escuelas-japonesas.html">Asi son las escuelas japonesas</a>
					<span>698</span>
				</li>
								<li class="categoriaPost clearfix noticias">
					<a href="/posts/noticias/5854916/Ex-soldado-EEUU-en-Irak:-Equot;He-sido-un-asesino-psicópata.html">Ex soldado EEUU en Irak: &quot;He sido un asesino psicópata</a>
					<span>651</span>

				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5738198/Mi-viaje-a-South-Africa.html">Mi viaje a South Africa</a>
					<span>534</span>
				</li>
								<li class="categoriaPost clearfix animaciones">
					<a href="/posts/animaciones/5748390/Adivinas-La-Música-de-Dibujitos---Mi-Juego-(Look-Trivia).html">Adivinas La Música de Dibujitos? - Mi Juego (Look Trivia)</a>

					<span>516</span>
				</li>
								<li class="categoriaPost clearfix musica">
					<a href="/posts/musica/5666995/Reggaeton-Actualizado-Dia-a-Dia-2010[Act_24_06_10][New].html">Reggaeton Actualizado Dia a Dia 2010[Act.24.06.10][New]</a>
					<span>512</span>
				</li>
								<li class="categoriaPost clearfix offtopic">

					<a href="/posts/offtopic/5661053/Letra-Chica-Del-Post-Anti-K.html">Letra Chica Del Post Anti K</a>
					<span>490</span>
				</li>
								<li class="categoriaPost clearfix musica">
					<a href="/posts/musica/5660931/Taringa-merecía-tanta-música-(De-todo).html">Taringa merecía tanta música (De todo)</a>
					<span>486</span>
				</li>

							</ol>
						</div>
		</div>

		<div class="boxy xtralarge">
			<div class="boxy-title">
				<h3>Top post m&aacute;s comentado</h3>
				<span class="icon-noti comentarios-n"></span>

			</div>
			<div class="boxy-content">
						<ol>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5825457/Asi-son-las-escuelas-japonesas.html">Asi son las escuelas japonesas</a>
					<span>860</span>
				</li>
								<li class="categoriaPost clearfix taringa">

					<a href="/posts/taringa/5737246/Por-un-Mundial-con-respeto-y-Paz_.html">Por un Mundial con respeto y Paz.</a>
					<span>658</span>
				</li>
								<li class="categoriaPost clearfix info">
					<a href="/posts/info/5661667/Hace-4-años-desaparecía-Magic-Kids.html">Hace 4 años desaparecía Magic Kids</a>
					<span>630</span>
				</li>

								<li class="categoriaPost clearfix videos">
					<a href="/posts/videos/5724264/Es-Taringa!-[Video-propio].html">Es Taringa! [Video propio]</a>
					<span>627</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5659323/Te-Muestro-mi-Casa___Rosada.html">Te Muestro mi Casa...Rosada</a>
					<span>606</span>

				</li>
								<li class="categoriaPost clearfix ciencia-educacion">
					<a href="/posts/ciencia-educacion/5700185/La-Argentina-que-no-nos-muestran___.html">La Argentina que no nos muestran...</a>
					<span>533</span>
				</li>
								<li class="categoriaPost clearfix taringa">
					<a href="/posts/taringa/5814144/Nueva-aplicación-en-Taringa:-Medallas!.html">Nueva aplicación en Taringa: Medallas!</a>

					<span>529</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5857592/Fui-al-Big-Four-y-te-lo-traigo-a-T!.html">Fui al Big Four y te lo traigo a T!</a>
					<span>501</span>
				</li>
								<li class="categoriaPost clearfix noticias">

					<a href="/posts/noticias/5716470/Salva-a-su-hermana-con-técnicas-del-World-of-Warcraft.html">Salva a su hermana con técnicas del World of Warcraft</a>
					<span>438</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5815020/Menues-de-Usuarios-para-Todos-[Busca-el-Tuyo-o-Pedilo].html">Menues de Usuarios para Todos [Busca el Tuyo o Pedilo]</a>
					<span>419</span>
				</li>

								<li class="categoriaPost clearfix humor">
					<a href="/posts/humor/5840083/--Actualizado---El-mundial-hace-milagros---¡como-cambiamos!.html">- Actualizado - El mundial hace milagros - ¡como cambiamos!</a>
					<span>408</span>
				</li>
								<li class="categoriaPost clearfix humor">
					<a href="/posts/humor/5684180/¿Córdoba-es-Springfield-[Comparaciones].html">¿Córdoba es Springfield? [Comparaciones]</a>
					<span>390</span>

				</li>
								<li class="categoriaPost clearfix taringa">
					<a href="/posts/taringa/5685904/250-barras-T!-encuentra-la-tuya.html">250 barras T! encuentra la tuya</a>
					<span>387</span>
				</li>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5738198/Mi-viaje-a-South-Africa.html">Mi viaje a South Africa</a>

					<span>377</span>
				</li>
								<li class="categoriaPost clearfix deportes">
					<a href="/posts/deportes/5728247/fixture-mundial-para-completar-en-T!.html">fixture mundial para completar en T!</a>
					<span>374</span>
				</li>
							</ol>

						</div>
		</div>

		<div class="boxy xtralarge">
			<div class="boxy-title">
				<h3>Top post con más seguidores</h3>
				<span class="icon-noti follow-n"></span>
			</div>
			<div class="boxy-content">

						<ol>
								<li class="categoriaPost clearfix imagenes">
					<a href="/posts/imagenes/5738198/Mi-viaje-a-South-Africa.html">Mi viaje a South Africa</a>
					<span>246</span>
				</li>
								<li class="categoriaPost clearfix offtopic">
					<a href="/posts/offtopic/5661053/Letra-Chica-Del-Post-Anti-K.html">Letra Chica Del Post Anti K</a>

					<span>183</span>
				</li>
								<li class="categoriaPost clearfix apuntes-y-monografias">
					<a href="/posts/apuntes-y-monografias/5646040/La-verdad-que-los-K-no-quieren-que-sepas.html">La verdad que los K no quieren que sepas</a>
					<span>133</span>
				</li>
								<li class="categoriaPost clearfix ebooks-tutoriales">

					<a href="/posts/ebooks-tutoriales/5656317/Eliminar-virus-sin-antivirus.html">Eliminar virus sin antivirus</a>
					<span>130</span>
				</li>
								<li class="categoriaPost clearfix musica">
					<a href="/posts/musica/5666995/Reggaeton-Actualizado-Dia-a-Dia-2010[Act_24_06_10][New].html">Reggaeton Actualizado Dia a Dia 2010[Act.24.06.10][New]</a>
					<span>122</span>
				</li>

								<li class="categoriaPost clearfix ebooks-tutoriales">
					<a href="/posts/ebooks-tutoriales/5885479/El-Post-Mas-Largo-Del-Mundo-Entero.html">El Post Mas Largo Del Mundo Entero</a>
					<span>95</span>
				</li>
								<li class="categoriaPost clearfix deportes">
					<a href="/posts/deportes/5728247/fixture-mundial-para-completar-en-T!.html">fixture mundial para completar en T!</a>
					<span>94</span>

				</li>
								<li class="categoriaPost clearfix tv-peliculas-series">
					<a href="/posts/tv-peliculas-series/5723912/--1-Link-MegaUpload---Peliculas-DvdRip---latino---Avi--.html">- 1 Link MegaUpload - Peliculas DvdRip - latino - Avi -</a>
					<span>92</span>
				</li>
								<li class="categoriaPost clearfix animaciones">
					<a href="/posts/animaciones/5748390/Adivinas-La-Música-de-Dibujitos---Mi-Juego-(Look-Trivia).html">Adivinas La Música de Dibujitos? - Mi Juego (Look Trivia)</a>

					<span>73</span>
				</li>
								<li class="categoriaPost clearfix info">
					<a href="/posts/info/5661667/Hace-4-años-desaparecía-Magic-Kids.html">Hace 4 años desaparecía Magic Kids</a>
					<span>64</span>
				</li>
								<li class="categoriaPost clearfix tv-peliculas-series">

					<a href="/posts/tv-peliculas-series/5646694/40-series-de-tv-completas-[mas-de-200-gb].html">40 series de tv completas [mas de 200 gb]</a>
					<span>62</span>
				</li>
								<li class="categoriaPost clearfix info">
					<a href="/posts/info/3719948/Te-querías-comprar-una-PC-Primero-Informate.html">Te querías comprar una PC? Primero Informate</a>
					<span>60</span>
				</li>

								<li class="categoriaPost clearfix ciencia-educacion">
					<a href="/posts/ciencia-educacion/5700185/La-Argentina-que-no-nos-muestran___.html">La Argentina que no nos muestran...</a>
					<span>59</span>
				</li>
								<li class="categoriaPost clearfix deportes">
					<a href="/posts/deportes/5763186/Los-Partidos-del-Mundial-Bajalos-Aca!-(Toda-la-1ra-ronda).html">Los Partidos del Mundial Bajalos Aca! (Toda la 1ra ronda)</a>
					<span>57</span>

				</li>
								<li class="categoriaPost clearfix taringa">
					<a href="/posts/taringa/5525892/Tutorial-de-notificaciones.html">Tutorial de notificaciones</a>
					<span>53</span>
				</li>
							</ol>
						</div>
		</div>

	</div>
<style>
.boxy {
	background: #FFF;
	border: 1px solid #CCC;
	-moz-box-shadow: 0 0 5px #CCC;
	-webkit-box-shadow: 0 0 5px #CCC
}
.boxy a {
	color: #0f0fb4;
	font-weight: bold;
}
.boxy a.selected {
	background-color:#0F0FB4;
	color:#FFFFFF;
	display:block;

	margin:3px 0;
	padding:3px;
}
.boxy-title {
	background: #d9d9d9 url(\'http://i.t.net.ar/images/bg-title-boxy.gif\') repeat-x top left;
	padding: 10px;
	border-bottom: #bdbdbd 1px solid;
	position: relative;
}
.boxy-title h3 {
	margin: 0;
	text-shadow: #f4f4f4  0 1px 0;
	font-size:13px;
}

.boxy-title span.icon-noti {
	background-image:url(\'http://i.t.net.ar/images/sprite-notification.png\');
	display:block;
	float:right;
	height:16px;
	position:absolute;
	right:9px;
	top:8px;
	width:16px;
}

.boxy-content {
	padding: 12px;
}
.boxy select {
	width: 125px;
}
.boxy h4 {
	color: #FF6600;
	margin: 0 0 5px 0;
	font-size: 14px;
}
.boxy hr {
	border-top: dashed 1px #CCC;
	background: #FFF;
	margin: 10px 0;
}
.xtralarge {
	width: 380px;
	margin: 0 5px 10px 0px;
	float: left;
}
.xtralarge ol {
	padding-left:30px;
	margin:0;
	list-style-image:none;
	list-style-position:outside!important;
	list-style-type:decimal;
	position:relative;
}

.xtralarge .categoriaPost, .xtralarge .categoriaUsuario, .xtralarge .categoriaCom {
	font-size: 12px;
	list-style-image:none;
	list-style-position:outside!important;
	list-style-type:decimal;	
	font-weight: bold;
	margin-bottom: 3px;
	display:list-item;
	position:relative;
	border:none;
	height:16px
}

.xtralarge .categoriaCom {
	padding: 3px;
}

.xtralarge .categoriaPost {
	margin-bottom: 0;
	_list-style:none
}

.xtralarge .categoriaPost:hover {
	background-color:none!important;
}



.xtralarge .categoriaPost a, .xtralarge .categoriaUsuario a, .xtralarge .categoriaCom a {
	font-size: 12px;
	font-weight: bold;
	width:250px;
	height:16px;
	overflow:hidden;
	margin:0;
	display:block;
	padding:0
	height:auto!important;
	position:absolute;
	float:none;
}

.xtralarge .categoriaPost span, .xtralarge .categoriaUsuario span, .xtralarge .categoriaCom span {
	font-weight: normal;
	color: #999;
	position:absolute;
	right:0;
	top:0
}

.xtralarge .categoriaUsuario  {
	padding:3px;
}

 .xtralarge .categoriaUsuario a {
 	left: 25px;
 	top:3px;
 	height:16px;
 }

.xtralarge .categoriaCom {
	height:13px;
}

.xtralarge .categoriaCom .titletema {
	margin:0
}
.xtralarge .categoriaUsuario img {
	vertica-align:middle;
	padding:1px;
	border:1px solid #EEE;
	display:block;
	margin-right:5px;
	position:absolute;	
}

.boxy-title .popular-n { background-position:0 -240px; }
.boxy-title .votada-n { background-position:0 -261px; }


</style>';

pie();

?>