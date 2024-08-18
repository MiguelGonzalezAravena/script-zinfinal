<?php
echo'<div class="box_title">
		<div class="box_txt">&Uacute;ltimas respuestas</div>
		<div class="box_rss">
		  <a href="javascript:com.actualizar_respuestas()">

		    <span class="systemicons actualizar"></span>
		  </a>
		</div>
	</div>
	<div class="box_cuerpo" id="ult_resp">
		<ul>';
require_once('../comunidades/ultimas-respuestas.php');
mensajes(true,$co['idco']);
		echo'</ul>
	</div>
	<br class="spacer" />

	<div class="box_title">
		<div class="box_txt">&Uacute;ltimos Miembros</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo">
		<ul class="listDisc">';
		foreach($miembros['miembros'] as $usermic2)
		{
			echo'<li><a href="/perfil/'.$usermic2['nick'].'">'.$usermic2['nick'].'</a></li>';
		}
		echo'
		</ul>
		<p class="verMas"><a href="/comunidades/'.$co['shortname'].'/miembros/">Ver m&aacute;s &raquo;</a></p>
		<div class="clearBoth"></div>
	</div>';
?>