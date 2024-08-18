<?php
include("../header.php");
$titulo = $descripcion;
cabecera_normal();
echo '<div id="cuerpocontainer">
<!-- inicio cuerpocontainer -->

<div class="comunidades">






	<style>
	.topBox {
		margin: 5px;
		float: left;
		width: 32%;
	}
</style>
<script type="text/javascript">
	com.global_tops_fecha=\'historico\';
	com.global_tops_categoria=\'-1\';
</script>
<div class="box_cuerpo" align="center">

	<b>TOPs de </b>
	<select name="fecha" onchange="com.global_tops(\'fecha\', this.value)">
		<option value="historico"  selected="true">Todos los tiempos</option>
		<option value="hoy" >Hoy</option>
		<option value="ayer" >Ayer</option>
		<option value="semana" >Ultimos 7 d&iacute;as</option>

		<option value="mes" >Del mes</option>
		<option value="mes-anterior" >Mes Anterior</option>
	</select>
	<b>de la Categoria:</b>
	&nbsp;
	<select name="cat" onchange="com.global_tops(\'categoria\', this.value)">
		<option value="-1">Todas</option>

				<option value="arte-literatura">Arte y Literatura</option>
				<option value="deportes">Deportes</option>
				<option value="diversion-esparcimiento">Diversi&oacute;n y Esparcimiento</option>
				<option value="economia-negocios">Econom&iacute;a y Negocios</option>
				<option value="entretenimiento-medios">Entretenimiento y Medios</option>

				<option value="grupos-organizaciones">Grupos y Organizaciones</option>
				<option value="interes-general">Inter&eacute;s general</option>
				<option value="internet-tecnologia">Internet y Tecnolog&iacute;a</option>
				<option value="musica-bandas">M&uacute;sica y Bandas</option>
				<option value="regiones">Regiones</option>

		</select>
</div>
<br />

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Comunidades m&aacute;s Populares</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/populares/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
	</div>
	<div class="box_cuerpo">

		<ol>
				<li><a href="/comunidades/gamers/" title="Gamers">Gamers</a> (8617)</li>
				<li><a href="/comunidades/taringarespuestas/" title="Taringa Respuestas!">Taringa Respuestas!</a> (7566)</li>
				<li><a href="/comunidades/juegostaringa/" title="Juegos Taringa!">Juegos Taringa!</a> (7066)</li>

				<li><a href="/comunidades/whatthefuck/" title="Comunidad WTF">Comunidad WTF</a> (6409)</li>
				<li><a href="/comunidades/serviciotecnico/" title="Servicio Tecnico para PC">Servicio Tecnico para PC</a> (6087)</li>
				<li><a href="/comunidades/cannabis/" title="Fumatinga">Fumatinga</a> (5819)</li>
				<li><a href="/comunidades/ps2games/" title="PlayStation 2 · Comunidad Oficial">PlayStation 2 · Comunidad Oficia...</a> (4190)</li>

				<li><a href="/comunidades/bbcoder/" title="BBCoder para T! y P! - Sharkale®">BBCoder para T! y P! - Sharkale®</a> (3615)</li>
				<li><a href="/comunidades/tanite/" title="T! At Nite!">T! At Nite!</a> (3501)</li>
				<li><a href="/comunidades/riverplate/" title="Club Atlético River Plate">Club Atlético River Plate</a> (3370)</li>
				<li><a href="/comunidades/sorteosrapid/" title="Los Amigos de Moe!">Los Amigos de Moe!</a> (2922)</li>

				<li><a href="/comunidades/bocajuniors/" title="Club Atlético Boca Juniors">Club Atlético Boca Juniors</a> (2898)</li>
				<li><a href="/comunidades/guitarristas-taringueros/" title="Comunidad de Guitarristas Taringueros">Comunidad de Guitarristas Taring...</a> (2763)</li>
				<li><a href="/comunidades/metaleros/" title="Heavy MeTaleros">Heavy MeTaleros</a> (2749)</li>
				<li><a href="/comunidades/sorteos/" title="Friends league!">Friends league!</a> (2392)</li>

			</ol>
	</div>
</div>

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Comunidades con m&aacute;s Temas</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/temas/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
		<div class="box_rrs"><span class="box_rss"/></div>

	</div>
	<div class="box_cuerpo">
		<ol>
				<li><a href="/comunidades/whatthefuck/" title="Comunidad WTF">Comunidad WTF</a> (25864)</li>
				<li><a href="/comunidades/taringarespuestas/" title="Taringa Respuestas!">Taringa Respuestas!</a> (6592)</li>
				<li><a href="/comunidades/solofansdbz/" title="Solo Para Fans De DBZ">Solo Para Fans De DBZ</a> (5412)</li>

				<li><a href="/comunidades/cannabis/" title="Fumatinga">Fumatinga</a> (5208)</li>
				<li><a href="/comunidades/juegostaringa/" title="Juegos Taringa!">Juegos Taringa!</a> (5190)</li>
				<li><a href="/comunidades/serviciotecnico/" title="Servicio Tecnico para PC">Servicio Tecnico para PC</a> (4872)</li>
				<li><a href="/comunidades/canallamania/" title="Canallamania">Canallamania</a> (4527)</li>

				<li><a href="/comunidades/racingclub/" title="Racing Club de Avellaneda">Racing Club de Avellaneda</a> (4213)</li>
				<li><a href="/comunidades/gamers/" title="Gamers">Gamers</a> (4130)</li>
				<li><a href="/comunidades/tanite/" title="T! At Nite!">T! At Nite!</a> (3416)</li>
				<li><a href="/comunidades/naruto-f/" title="Naruto´s Fans">Naruto´s Fans</a> (3174)</li>

				<li><a href="/comunidades/amigosdetony/" title="Los Amigos de Tony">Los Amigos de Tony</a> (3086)</li>
				<li><a href="/comunidades/albumsudafrica2010/" title="Album Virtual Sudafrica 2010">Album Virtual Sudafrica 2010</a> (2996)</li>
				<li><a href="/comunidades/aloca2/" title="Trivia Aloca2">Trivia Aloca2</a> (2792)</li>
				<li><a href="/comunidades/dbz-fans/" title="Dragon Ball Z · Comunidad Oficial">Dragon Ball Z · Comunidad Oficia...</a> (2558)</li>

			</ol>
	</div>
</div>

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Comunidades con m&aacute;s Respuestas</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/com_respuestas/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
		<div class="box_rrs"><span class="box_rss"/></div>

	</div>
	<div class="box_cuerpo">
		<ol>
				<li><a href="/comunidades/juegostaringa/" title="Juegos Taringa!">Juegos Taringa!</a> (328128)</li>
				<li><a href="/comunidades/whatthefuck/" title="Comunidad WTF">Comunidad WTF</a> (234225)</li>
				<li><a href="/comunidades/tanite/" title="T! At Nite!">T! At Nite!</a> (151212)</li>

				<li><a href="/comunidades/ps2games/" title="PlayStation 2 · Comunidad Oficial">PlayStation 2 · Comunidad Oficia...</a> (134412)</li>
				<li><a href="/comunidades/cannabis/" title="Fumatinga">Fumatinga</a> (98611)</li>
				<li><a href="/comunidades/aloca2/" title="Trivia Aloca2">Trivia Aloca2</a> (87558)</li>
				<li><a href="/comunidades/solofansdbz/" title="Solo Para Fans De DBZ">Solo Para Fans De DBZ</a> (69881)</li>

				<li><a href="/comunidades/amigosdetony/" title="Los Amigos de Tony">Los Amigos de Tony</a> (69306)</li>
				<li><a href="/comunidades/gamers/" title="Gamers">Gamers</a> (67673)</li>
				<li><a href="/comunidades/racingclub/" title="Racing Club de Avellaneda">Racing Club de Avellaneda</a> (67449)</li>
				<li><a href="/comunidades/canallamania/" title="Canallamania">Canallamania</a> (62271)</li>

				<li><a href="/comunidades/naruto-f/" title="Naruto´s Fans">Naruto´s Fans</a> (61945)</li>
				<li><a href="/comunidades/serviciotecnico/" title="Servicio Tecnico para PC">Servicio Tecnico para PC</a> (51182)</li>
				<li><a href="/comunidades/taringarespuestas/" title="Taringa Respuestas!">Taringa Respuestas!</a> (50042)</li>
				<li><a href="/comunidades/dbz-fans/" title="Dragon Ball Z · Comunidad Oficial">Dragon Ball Z · Comunidad Oficia...</a> (48894)</li>

			</ol>
	</div>
</div>

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Temas con m&aacute;s Respuestas</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/temas_respuestas/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
		<div class="box_rrs"><span class="box_rss"/></div>

	</div>
	<div class="box_cuerpo">
		<ol>
				<li><a href="/comunidades/juegostaringa/32139/Conociendo-Juegos-Taringa!.html" title="Conociendo Juegos Taringa!">Conociendo Juegos Taringa!</a> (15583)</li>
				<li><a href="/comunidades/juegostaringa/94782/El-Rincón-De-TigerLand.html" title="El Rincón De TigerLand">El Rincón De TigerLand</a> (15311)</li>
				<li><a href="/comunidades/ps2games/76549/[Bar-I---PS2]-Votalo-Positivo_.html" title="[Bar I - PS2] Votalo Positivo.">[Bar I - PS2] Votalo Positivo.</a> (14793)</li>

				<li><a href="/comunidades/whatthefuck/215781/Votá-positivo-o-muere.html" title="Votá positivo o muere">Votá positivo o muere</a> (14756)</li>
				<li><a href="/comunidades/ps2games/143770/[Bar-II---PS2]-El-otro-está-rompido_.html" title="[Bar II - PS2] El otro está rompido.">[Bar II - PS2] El otro está romp...</a> (14410)</li>
				<li><a href="/comunidades/ps2games/192405/[Bar-III---PS2]-Los-otros-2-están-rompidazos.html" title="[Bar III - PS2] Los otros 2 están rompidazos">[Bar III - PS2] Los otros 2 está...</a> (14070)</li>
				<li><a href="/comunidades/ps2games/231049/[Bar-IV---PS2]-Los-otros-3-están-Rompidazos.html" title="[Bar IV - PS2] Los otros 3 están Rompidazos">[Bar IV - PS2] Los otros 3 están...</a> (13316)</li>

				<li><a href="/comunidades/naruto-f/57522/Jutsu-Multiclones-de-Comentarios-[Naruto\'s-Fans].html" title="Jutsu Multiclones de Comentarios [Naruto\'s Fans]">Jutsu Multiclones de Comentarios...</a> (10699)</li>
				<li><a href="/comunidades/solofansdbz/196844/[DbZ]-|-El-Super-Kame-Hame-Ha-De-Comentarios[Recuerdo].html" title="[DbZ] | El Super Kame Hame Ha De Comentarios[Recuerdo]">[DbZ] | El Super Kame Hame Ha De...</a> (10103)</li>
				<li><a href="/comunidades/canallamania/55526/Canallamania-con-mas-aliento.html" title="Canallamania con mas aliento">Canallamania con mas aliento</a> (8864)</li>
				<li><a href="/comunidades/canallamania/138892/El-Bar-de-Canallamania-[Visitanos].html" title="El Bar de Canallamania [Visitanos]">El Bar de Canallamania [Visitano...</a> (8540)</li>

				<li><a href="/comunidades/tanite/69705/[-Esta-Roto-]-Top!-At-Nite!-+-Chat-at-nite.html" title="[ Esta Roto ] Top! At Nite! + Chat at nite">[ Esta Roto ] Top! At Nite! + Ch...</a> (8185)</li>
				<li><a href="/comunidades/aloca2/103912/?-Juego-de-la-Bomba-[EDITADO].html" title="? Juego de la Bomba [EDITADO]">? Juego de la Bomba [EDITADO]</a> (7285)</li>
				<li><a href="/comunidades/racingclub/185328/La-Taberna-Racinguista.html" title="La Taberna Racinguista">La Taberna Racinguista</a> (6591)</li>
				<li><a href="/comunidades/triviafachera/156950/???Tormenta-de-Comentarios-(Premios-sorpresa)???.html" title="???Tormenta de Comentarios (Premios sorpresa)???">???Tormenta de Comentarios (Prem...</a> (6263)</li>

			</ol>
	</div>
</div>

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Temas m&aacute;s Votados</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/votados/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
		<div class="box_rrs"><span class="box_rss"/></div>

	</div>
	<div class="box_cuerpo">
		<ol>
				<li><a href="/comunidades/fansp4mm3r/169899/Juntemos-votos-para-que-Sp4mm3r-sea-Great-User!.html" title="Juntemos votos para que Sp4mm3r sea Great User!">Juntemos votos para que Sp4mm3r ...</a> (458)</li>
				<li><a href="/comunidades/racingclub/65987/Si-sos-de-Racing,-apretá-acá.html" title="Si sos de Racing, apretá acá">Si sos de Racing, apretá acá</a> (395)</li>
				<li><a href="/comunidades/serviciotecnico/585/Yo-Reparo-pasen-y-lean-+-Encuestas-de-la-comunidad.html" title="Yo Reparo pasen y lean + Encuestas de la comunidad">Yo Reparo pasen y lean + Encuest...</a> (351)</li>

				<li><a href="/comunidades/whatthefuck/215781/Votá-positivo-o-muere.html" title="Votá positivo o muere">Votá positivo o muere</a> (342)</li>
				<li><a href="/comunidades/ciencia-con-paciencia/238179/»¡Votá-+-a-la-Categoría-CIENCIA!«.html" title="»¡Votá + a la Categoría CIENCIA!«">»¡Votá + a la Categoría CIENCIA!...</a> (325)</li>
				<li><a href="/comunidades/bbcoder/208220/•-BBCoder-•-Versión-29_0-[Finalizada].html" title="• BBCoder • Versión 29.0 [Finalizada]">? BBCoder ? Versión 29.0 [Finali...</a> (268)</li>
				<li><a href="/comunidades/cannabis/8823/Como-armar__.html" title="Como armar..">Como armar..</a> (258)</li>

				<li><a href="/comunidades/aloca2/130348/Si-sos-miembro-de-Trivia-Aloca2,-apretá-acá!.html" title="Si sos miembro de Trivia Aloca2, apretá acá!">Si sos miembro de Trivia Aloca2,...</a> (254)</li>
				<li><a href="/comunidades/juegostaringa/94782/El-Rincón-De-TigerLand.html" title="El Rincón De TigerLand">El Rincón De TigerLand</a> (249)</li>
				<li><a href="/comunidades/tanite/69705/[-Esta-Roto-]-Top!-At-Nite!-+-Chat-at-nite.html" title="[ Esta Roto ] Top! At Nite! + Chat at nite">[ Esta Roto ] Top! At Nite! + Ch...</a> (235)</li>
				<li><a href="/comunidades/juegostaringa/139284/[Positivos]-Torneo-7_02_-(16-cupos-x1500).html" title="[Positivos] Torneo 7/02. (16 cupos x1500)">[Positivos] Torneo 7/02. (16 cup...</a> (222)</li>

				<li><a href="/comunidades/juegostaringa/32139/Conociendo-Juegos-Taringa!.html" title="Conociendo Juegos Taringa!">Conociendo Juegos Taringa!</a> (216)</li>
				<li><a href="/comunidades/ps2games/76549/[Bar-I---PS2]-Votalo-Positivo_.html" title="[Bar I - PS2] Votalo Positivo.">[Bar I - PS2] Votalo Positivo.</a> (213)</li>
				<li><a href="/comunidades/sorteos/102025/Sorteo-!-La-Caja-de-Miguelo-3-!.html" title="Sorteo ! La Caja de Miguelo 3 !">Sorteo ! La Caja de Miguelo 3 !</a> (202)</li>
				<li><a href="/comunidades/triviafachera/145363/•-Vota-Positivo-Aca!!!!-Estamos-cerca-del-TOP!•.html" title="• Vota Positivo Aca!!!! Estamos cerca del TOP!•">? Vota Positivo Aca!!!! Estamos ...</a> (198)</li>

			</ol>
	</div>
</div>

<div class="topBox">
	<div class="box_title">
		<div class="box_txt">Temas m&aacute;s Visitados</div>
		<div class="box_rss"><a href="/rss/comunidades/tops/visitados/historico/"><span style="position:relative;"><img border=0 src="http://i.t.net.ar/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="Agregar RSS" title="Agregar RSS" /><img border=0 src="http://i.t.net.ar/images/space.gif" style="width:14px;height:12px" /></span></a></div>
		<div class="box_rrs"><span class="box_rss"/></div>

	</div>
	<div class="box_cuerpo">
		<ol>
				<li><a href="/comunidades/whatthefuck/215781/Votá-positivo-o-muere.html" title="Votá positivo o muere">Votá positivo o muere</a> (115088)</li>
				<li><a href="/comunidades/ps2games/76549/[Bar-I---PS2]-Votalo-Positivo_.html" title="[Bar I - PS2] Votalo Positivo.">[Bar I - PS2] Votalo Positivo.</a> (81993)</li>
				<li><a href="/comunidades/ps2games/143770/[Bar-II---PS2]-El-otro-está-rompido_.html" title="[Bar II - PS2] El otro está rompido.">[Bar II - PS2] El otro está romp...</a> (75523)</li>

				<li><a href="/comunidades/ps2games/192405/[Bar-III---PS2]-Los-otros-2-están-rompidazos.html" title="[Bar III - PS2] Los otros 2 están rompidazos">[Bar III - PS2] Los otros 2 está...</a> (68053)</li>
				<li><a href="/comunidades/juegostaringa/32139/Conociendo-Juegos-Taringa!.html" title="Conociendo Juegos Taringa!">Conociendo Juegos Taringa!</a> (65995)</li>
				<li><a href="/comunidades/ps2games/231049/[Bar-IV---PS2]-Los-otros-3-están-Rompidazos.html" title="[Bar IV - PS2] Los otros 3 están Rompidazos">[Bar IV - PS2] Los otros 3 están...</a> (61520)</li>
				<li><a href="/comunidades/juegostaringa/94782/El-Rincón-De-TigerLand.html" title="El Rincón De TigerLand">El Rincón De TigerLand</a> (61143)</li>

				<li><a href="/comunidades/whatthefuck/310832/Nueva-ruleta-Comunidad-WTF.html" title="Nueva ruleta Comunidad WTF">Nueva ruleta Comunidad WTF</a> (52597)</li>
				<li><a href="/comunidades/ironmaiden/62186/iron-maiden-Equot;a-matter-of-life-and-deathEquot;-megapos.html" title="iron maiden &quot;a matter of life and death&quot; megapos">iron maiden &quot;a matter of li...</a> (49667)</li>
				<li><a href="/comunidades/tanite/69705/[-Esta-Roto-]-Top!-At-Nite!-+-Chat-at-nite.html" title="[ Esta Roto ] Top! At Nite! + Chat at nite">[ Esta Roto ] Top! At Nite! + Ch...</a> (44012)</li>
				<li><a href="/comunidades/solofansdbz/196844/[DbZ]-|-El-Super-Kame-Hame-Ha-De-Comentarios[Recuerdo].html" title="[DbZ] | El Super Kame Hame Ha De Comentarios[Recuerdo]">[DbZ] | El Super Kame Hame Ha De...</a> (42979)</li>

				<li><a href="/comunidades/fansp4mm3r/245091/Assassin\'s-Creed-2---Crack-y-Emulador.html" title="Assassin\'s Creed 2 - Crack y Emulador">Assassin\'s Creed 2 - Crack y Emu...</a> (42735)</li>
				<li><a href="/comunidades/whatthefuck/9498/Reglas-de-la-Comunidad-WTF-[viejas].html" title="Reglas de la Comunidad WTF [viejas]">Reglas de la Comunidad WTF [viej...</a> (35629)</li>
				<li><a href="/comunidades/-pes-/45484/Ayuda-serial-pes-2010-pc.html" title="Ayuda serial pes 2010 pc">Ayuda serial pes 2010 pc</a> (34921)</li>
				<li><a href="/comunidades/belgranocba/142871/¿Quien-va-a-la-Cancha-de-Belgrano.html" title="¿Quien va a la Cancha de Belgrano?">¿Quien va a la Cancha de Belgran...</a> (34638)</li>

			</ol>
	</div>
</div>

</div>';

pie();
?>