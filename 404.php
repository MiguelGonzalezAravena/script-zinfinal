<?php
include("header.php");
cabecera_normal();
echo '<script type="text/javascript">
var buscador = {
	section: \'Posts\',
	change_section: function(section){
		if(section==this.section)
			return;

		var google_aux1 = (section==\'Posts\' && this.posts.tipo==\'google\') ? \'2\' : \'\';
		var google_aux2 = (this.section==\'Posts\' && this.posts.tipo==\'google\') ? \'2\' : \'\';
		$(\'#Select\'+section+\'2 input[name="q\'+google_aux1+\'"]\').val( $(\'#Select\'+this.section+\'2 input[name="q\'+google_aux2+\'"]\').val() );

		$(\'#s\'+this.section).removeClass(\'selected\');
		$(\'#s\'+section).addClass(\'selected\');

		$(\'#Select\'+this.section+\'1\').hide();
		$(\'#Select\'+section+\'1\').show();

		$(\'#Select\'+this.section+\'2\').hide();
		$(\'#Select\'+section+\'2\').show();

		$(\'#Tops\'+section).fadeIn();
		$(\'#Tops\'+this.section).fadeOut();

		$(\'#Select\'+section+\'2 input[name="q\'+((section==\'Posts\' && this.posts.tipo==\'google\') ? \'2\' : \'\')+\'"]\').focus();

		this.section = section;
	},

	/*** Section Posts ***/
	posts: {

	tipo: \'google\',
	onsubmit: function(){
		if(this.tipo==\'google\')
			$(\'#SelectPosts2 input[name="q"]\').val($(\'#SelectPosts2 input[name="q2"]\').val());
	},
	select: function(tipo){
		if(this.tipo==tipo)
			return;

		//Cambio de action form
		$(\'#SelectPosts2 form[name="buscador"]\').attr(\'action\', \'/posts/buscador/\'+tipo+\'/\');

		//Cambio here en <a />
		$(\'#SelectPosts1 a#select_\' + this.tipo).removeClass(\'here\');
		$(\'#SelectPosts1 a#select_\' + tipo).addClass(\'here\');

		//Cambio de logo
		$(\'#SelectPosts1 img#buscador-logo-\'+this.tipo).css(\'display\', \'none\');
		$(\'#SelectPosts1 img#buscador-logo-\'+tipo).css(\'display\', \'inline\');

		//Muestro/oculto los input google
		if(tipo==\'google\'){ //Ahora es google
			$(\'#SelectPosts2 input[name="q"]\').attr(\'name\', \'q2\');
			$(\'#SelectPosts2 form[name="buscador"]\').append(\'<input type="hidden" name="q" value="" /><input type="hidden" name="cx" value="partner-pub-5717128494977839:armknb-nql0" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />\');
		}else if(this.tipo==\'google\'){ //El anterior fue google
			$(\'#SelectPosts2 input[name="q"]\').remove();
			$(\'#SelectPosts2 input[name="cx"]\').remove();
			$(\'#SelectPosts2 input[name="cof"]\').remove();
			$(\'#SelectPosts2 input[name="ie"]\').remove();
			$(\'#SelectPosts2 input[name="q2"]\').attr(\'name\', \'q\');
		}

		this.tipo = tipo;
		//Foco en input query
		if(this.tipo==\'google\')
			$(\'#SelectPosts2 input[name="q2"]\').focus();
		else
			$(\'#SelectPosts2 input[name="q"]\').focus();
	}
	},
	/*** FIN - Section Posts ***/

	/*** Section Comunidades ***/
	comunidades: {

	tipo: \'comunidades\',
	onsubmit: function(){
	},
	select: function(tipo){
		if(this.tipo==tipo)
			return;

		//Cambio de action form
		$(\'#SelectComunidades2 form[name="buscador"]\').attr(\'action\', \'/comunidades/buscador/\'+tipo+\'/\');

		//Cambio here en <a />
		$(\'#SelectComunidades1 a#select_\' + this.tipo).removeClass(\'here\');
		$(\'#SelectComunidades1 a#select_\' + tipo).addClass(\'here\');

		this.tipo = tipo;
		//Foco en input query
		$(\'#SelectComunidades2 input[name="q"]\').focus();
	}
	}
	/*** FIN - Section Comunidades ***/
}
</script>

<div class="post-deleted notFound">
	<div class="content-splash">
	<h3>Oops, lo que estas buscando no esta por aqui!</h3>

	Pero no te escapes, aun podes seguir buscandolo..

	<div class="searchFil">
		<div style="margin-bottom: 5px;">
				<div class="tabs404">
					<ul>
						<li class="selected" id="sPosts"><a href="javascript:buscador.change_section(\'Posts\')">Posts</a></li>
						<li id="sComunidades"><a href="javascript:buscador.change_section(\'Comunidades\')">Comunidades</a></li>
					</ul>

					<div class="clearfix"></div>
				</div>
				<style>
				.tabs404 {
					border-bottom:1px solid #CCC;
					margin-bottom:12px;
				}

				.tabs404 li {
					float:left;
					margin-right: 10px;
					margin-bottom:-1px;
				}

				.tabs404 li a {
					display: block;
					padding: 7px 14px;
					border-right: 1px solid #CCC;
					border-left: 1px solid #CCC;
					border-top: 1px solid #CCC;
					border-bottom: 1px solid #CCC;

					font-size: 14px;
					background: #EEE;
					font-weight: bold;
					color:#004a95;
				}

				.tabs404 li.selected a {
					background: #FFF;
					color:#000;
					border-bottom: 1px solid #FFF;
				}
				
				#TopsPosts, #TopsComunidades {
					position: absolute;
				}
				#TopsComunidades {
					display: none;
				}
				</style>

			<div id="SelectPosts1">
				<div class="logoMotorSearch">
					<img id="buscador-logo-google" src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="google-search-engine" />
					<img id="buscador-logo-taringa" src="http://o2.t26.net/images/taringaFFF.gif" alt="taringa-search-engine" style="display:none" />
					<img id="buscador-logo-tags" src="http://o2.t26.net/images/taringaFFF.gif" alt="tags-search-engine" style="display:none" />

				</div>
				<label class="searchWith">
											<a id="select_google" class="here" href="javascript:buscador.posts.select(\'google\')">Google</a><span class="sep">|</span>
										<a id="select_taringa" href="javascript:buscador.posts.select(\'taringa\')">Taringa!</a><span class="sep">|</span>
					<a id="select_tags" href="javascript:buscador.posts.select(\'tags\')">Tags</a>
				</label>

			</div>
			<div id="SelectComunidades1" style="display:none">
				<div class="logoMotorSearch">
					<img id="buscador-logo-taringa" src="http://o2.t26.net/images/taringaFFF.gif" alt="taringa-search-engine" />
				</div>
				<label class="searchWith">
					<a id="select_comunidades" class="here" href="javascript:buscador.comunidades.select(\'comunidades\')">Comunidades</a><span class="sep">|</span>
					<a id="select_temas" href="javascript:buscador.comunidades.select(\'temas\')">Temas</a>

				</label>
			</div>

			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>

		<div class="boxBox">
			<div class="searchEngine">
				<div id="SelectPosts2">

					<form style="padding:0;margin:0" name="buscador" method="GET" action="/posts/buscador/google/" onsubmit="window.buscador.posts.onsubmit();">
						<input type="text" name="q2" size="25" class="searchBar" value="" />
						<input type="submit" class="mBtn btnOk" value="Buscar" title="Buscar" />
						<input type="hidden" name="q" value="" /><input type="hidden" name="cx" value="partner-pub-5717128494977839:h5hvec-zeyh" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />
					</form>
				</div>
				<div id="SelectComunidades2" style="display:none">
					<form style="padding:0;margin:0" name="buscador" method="GET" action="/comunidades/buscador/comunidades/" onsubmit="window.buscador.comunidades.onsubmit();">
						<input type="text" name="q" size="25" class="searchBar" value="" />

						<input type="submit" class="mBtn btnOk" value="Buscar" title="Buscar" />
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- End Filter -->

			<!-- End SearchFill -->
			<div class="clearfix"></div>

		</div>
		<div class="clearfix"></div>
	</div>

	<h4>..o visitar el mejor contenido de la semana:</h4>
	<ul id="TopsPosts">
			<li class="categoriaPost offtopic">
			<a href="/posts/offtopic/6123797/Te-cuento-algo-cortito.html" title="Te cuento algo cortito">Te cuento algo cortito</a>

		</li>
			<li class="categoriaPost imagenes">
			<a href="/posts/imagenes/6130768/Tenias-la-PlayStation-One-Entra!-[Recuerdos]-[Con-Fotos].html" title="Tenias la PlayStation One? Entra! [Recuerdos] [Con Fotos]">Tenias la PlayStation One? Entra! [Recuerdos] [Con Fotos]</a>
		</li>
			<li class="categoriaPost humor">
			<a href="/posts/humor/6107087/No-sabes-que-hacer-con-la-vuvuzela-Solucion.html" title="No sabes que hacer con la vuvuzela? Solucion">No sabes que hacer con la vuvuzela? Solucion</a>
		</li>
			<li class="categoriaPost humor">

			<a href="/posts/humor/6168924/Pescando-en-Santiago_-Pensando-en-tu-madre_.html" title="Pescando en Santiago. Pensando en tu madre.">Pescando en Santiago. Pensando en tu madre.</a>
		</li>
			<li class="categoriaPost ciencia-educacion">
			<a href="/posts/ciencia-educacion/6107928/•Dile-NO!-A-Circos-con-Animales:-Crueldad-por-diversión.html" title="•Dile NO! A Circos con Animales: Crueldad por diversión">•Dile NO! A Circos con Animales: Crueldad por diversión</a>
		</li>
			<li class="categoriaPost noticias">
			<a href="/posts/noticias/6164419/Matrimonio-gay:-Se-aprobo-la-ley-de-igualdad.html" title="Matrimonio gay: Se aprobo la ley de igualdad">Matrimonio gay: Se aprobo la ley de igualdad</a>

		</li>
			<li class="categoriaPost deportes">
			<a href="/posts/deportes/6118399/Premios-Mundial-2010-dados-por-Taringa!.html" title="Premios Mundial 2010 dados por Taringa!">Premios Mundial 2010 dados por Taringa!</a>
		</li>
			<li class="categoriaPost humor">
			<a href="/posts/humor/6118082/30-Cosas-que-me-dejo-este-mundial.html" title="30 Cosas que me dejo este mundial">30 Cosas que me dejo este mundial</a>
		</li>
			<li class="categoriaPost info">

			<a href="/posts/info/6125890/Oreos-Quebradas-[Lucha-en-la-Industria-de-la-Alimentación].html" title="Oreos Quebradas [Lucha en la Industria de la Alimentación]">Oreos Quebradas [Lucha en la Industria de la Alimentación]</a>
		</li>
			<li class="categoriaPost imagenes">
			<a href="/posts/imagenes/6146653/Pagani-llega-a-las-expresiones-artisticas.html" title="Pagani llega a las expresiones artisticas">Pagani llega a las expresiones artisticas</a>
		</li>
			<li class="categoriaPost deportes">
			<a href="/posts/deportes/6160610/Vamos-Argentina-Carajo-(Video-Conmovedor).html" title="Vamos Argentina Carajo (Video Conmovedor)">Vamos Argentina Carajo (Video Conmovedor)</a>

		</li>
			<li class="categoriaPost offtopic">
			<a href="/posts/offtopic/6155386/18-de-Julio-de-1994---Atentado-a-la-Argentina.html" title="18 de Julio de 1994 - Atentado a la Argentina">18 de Julio de 1994 - Atentado a la Argentina</a>
		</li>
			<li class="categoriaPost imagenes">
			<a href="/posts/imagenes/6125079/el-mundo-en-imagenes-segun-mi-camara.html" title="el mundo en imagenes segun mi camara">el mundo en imagenes segun mi camara</a>
		</li>
			<li class="categoriaPost taringa">

			<a href="/posts/taringa/6143878/Lo-nuevo-en-Taringa!:-Mis-Borradores.html" title="Lo nuevo en Taringa!: Mis Borradores">Lo nuevo en Taringa!: Mis Borradores</a>
		</li>
			<li class="categoriaPost info">
			<a href="/posts/info/6174446/tuneando-la-pc-con-taringa_.html" title="tuneando la pc con taringa.">tuneando la pc con taringa.</a>
		</li>
		</ul>

	<ul id="TopsComunidades">

			<li class="categoriaCom grupos-organizaciones">
			<a class="titletema" href="/comunidades/stickyya/" title="[Solidaridad] Queremos Boton de Sticky!!!">[Solidaridad] Queremos Boton de Sticky!!!</a>
		</li>
			<li class="categoriaCom diversion-esparcimiento">
			<a class="titletema" href="/comunidades/ilol-juego-adictivo-vedolandia/" title="Ilol [El Juego/Acertijo del Año]">Ilol [El Juego/Acertijo del Año]</a>
		</li>
			<li class="categoriaCom interes-general">
			<a class="titletema" href="/comunidades/felixcumple/" title="Cumpleaños Taringueros (oficial)">Cumpleaños Taringueros (oficial)</a>

		</li>
			<li class="categoriaCom diversion-esparcimiento">
			<a class="titletema" href="/comunidades/humoringaa/" title="Humoringa!">Humoringa!</a>
		</li>
			<li class="categoriaCom deportes">
			<a class="titletema" href="/comunidades/messi10/" title="Lionel Andrés Messi">Lionel Andrés Messi</a>
		</li>
			<li class="categoriaCom arte-literatura">

			<a class="titletema" href="/comunidades/photoshoperosunidos/" title="Photoshoperos Unidos">Photoshoperos Unidos</a>
		</li>
			<li class="categoriaCom internet-tecnologia">
			<a class="titletema" href="/comunidades/descargaspremium/" title="DescargasPremium">DescargasPremium</a>
		</li>
			<li class="categoriaCom diversion-esparcimiento">
			<a class="titletema" href="/comunidades/wtf22222222222/" title="Comunidad WTF :RIP:">Comunidad WTF :RIP:</a>

		</li>
			<li class="categoriaCom regiones">
			<a class="titletema" href="/comunidades/mexicoazteca/" title="Union azteca">Union azteca</a>
		</li>
			<li class="categoriaCom internet-tecnologia">
			<a class="titletema" href="/comunidades/painteros-t/" title="PAINTeros T!">PAINTeros T!</a>
		</li>
			<li class="categoriaCom diversion-esparcimiento">

			<a class="titletema" href="/comunidades/tfantasmas/" title="Taringa Paranormal">Taringa Paranormal</a>
		</li>
			<li class="categoriaCom deportes">
			<a class="titletema" href="/comunidades/mdp-arg/" title="Mecado de Pases Argentinos">Mecado de Pases Argentinos</a>
		</li>
			<li class="categoriaCom interes-general">
			<a class="titletema" href="/comunidades/z-o-na/" title="Zona Anime">Zona Anime</a>

		</li>
			<li class="categoriaCom diversion-esparcimiento">
			<a class="titletema" href="/comunidades/mega--trivias/" title="**mEgA--tRiViAs**">**mEgA--tRiViAs**</a>
		</li>
			<li class="categoriaCom grupos-organizaciones">
			<a class="titletema" href="/comunidades/sin-mineria/" title="No a la minería,si a la vida">No a la minería,si a la vida</a>
		</li>
		</ul>

</div>
</div>

<style type="text/css" media="screen">
	.content-splash {
		width: 530px;
		height: 600px;
	}
	.searchFil {
		margin-top: 20px;
	}
	
	.content-splash li.categoriaCom {
		height: 16px;
		border: none;
	}
	
	.content-splash li .titletema{
				font-size:14px;
	}
</style>';
pie();
?>