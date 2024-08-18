<?php
include("header.php");
cabecera_normal();

echo '<div class="mapa_del_sitio">
	<div class="box_title" >
		<div class="box_txt">Home</div>
		<div class="box_rrs">

			<div class="box_rss"></div> 
		</div>
	</div>
	<div class="box_cuerpo">
		<ul>
    <li><a href="/anuncie/">Anuncie en '.$comunidad.'</a></li>
    <li><a href="http://ayuda.itaringa.net">Ayuda y FAQs</a></li>
    <li><a href="/buscador/">Buscador</a></li>

		<li><a href="/tags/">Buscador de tags</a></li>
    <li><a href="/chat/">Chat</a></li>			
		<li><a href="/contactenos/">Contacto</a></li>
		<li><a href="/denuncia-publica/">Denuncias</a></li>
		<li><a href="/enlazanos/">Enlazanos</a></li>

		<li><a href="/tag-cloud/">Nube de Tags</a></li>
		<li><a href="/privacidad-de-datos/">Privacidad de datos</a></li>
    <li><a href="/protocolo/">Protocolo</a></li>
		<li><a href="/terminos-y-condiciones/">T&eacute;rminos y condiciones</a></li>
		<li><a href="/top/">Top</a></li>

		</ul>
	</div>
	<br class="space" />
</div>
<div class="mapa_del_sitio">
	<div class="box_title">
		<div class="box_txt">Categor&iacute;as</div>
		<div class="box_rrs">
			<div class="box_rss"></div> 
		</div>

	</div>
	<div class="box_cuerpo">
		<ul>
			<ul>
';

foreach($zinfinal->categorias['post'] as $cat) {
	echo '<li><a href="/posts/'.$cat['link'].'/">'.$cat['nombre'].'</a></li>
	';
}

echo '
			</ul>
		</ul>
	</div>

	<br class="space" />
</div>
<div class="mapa_del_sitio">
	<div class="box_title">
		<div class="box_txt"><img alt="RSS" title="RRS" src="http://o1.t26.net/images/rss.gif" heigth="14" width="14" border="0" align="absmiddle"> RSS</div>
		<div class="box_rrs">
			<div class="box_rss"></div> 
		</div>
	</div>

	<div class="box_cuerpo">
		<ul>
			<ul>
			<li><a href="http://feeds.feedburner.com/Taringa/ultimos-post">&Uacute;ltimos posts</a></li>
			<li><a href="http://feeds.feedburner.com/Taringa/top-post-semana">Top posts de la semana</a></li>
			<li><a href="http://feeds.feedburner.com/Taringa/usuarios-top-mes">Usuarios top del mes</a></li>
			</ul>

		</ul>
	</div>
	<br class="space" />
</div>';

pie();
?>