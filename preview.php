<?php
include("header.php");
include("includes/bbcode.php");
$bbcode = new bbcode_zinfinal();

$cuerpo = no_injection($_POST["cuerpo"]);
$titulo = no_injection($_POST["titulo"]);

if(empty($cuerpo) or empty($titulo) or $key==null){
	die("<script>alert('Esto no deberia estar pasando. Si ves esto, por favor, contacta a un Administrador para reportar el problema. Gracias!');</script>");
}

$idrango = $global_user['rango'];

$sqlpre = mysql_query("SELECT * FROM rangos WHERE id_rango = '$idrango' ");

$rang = mysql_fetch_array($sqlpre);
mysql_free_result($sqlpre);

echo '				<div id="post-izquierda">
					<div class="box_title">
						<div class="box_txt post_autor">Posteado por:</div>
            <div class="box_rrs"><div class="box_rss"><a target="_blank" href="/rss/posts-usuario/'.$key.'"><span style="position:relative;"><img border=0 src="'.$images.'/images/big1v12.png" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" alt="RSS con posts de '.$global_user['nick'].'" title="RSS con posts de '.$global_user['nick'].'" /><img border=0 src="'.$images.'/images/space.gif" style="width:14px;height:12px" /></span></a></div></div>
					</div>
					<div class="box_perfil">
						<a target="_blank" href="/perfil/'.$key.'"><img src="'.$global_user['avatar'].'" width="120" weight="120" style="display:block; margin: auto;" border="0" alt="Ver perfil de '.$global_user['nick'].'" title="Ver perfil de '.$global_user['nick'].'" /></a>
						<b class="txt"><a target="_blank" href="/perfil/'.$key.'" title="Ver perfil de '.$global_user['nick'].'">'.$global_user['nick'].'</a></b>

            <br clear="left" />'.$rang['nom_rango'].'<br clear="left" />
						<span style="position:relative;"><img border=0 src="'.$images.'/images/big2v1.png" style="position: absolute; top: '.$rang['img_rango'].'px, 0px);" alt="'.$rang['nom_rango'].'" title="'.$rang['nom_rango'].'" /><img border=0 src="'.$images.'/images/space.gif" style="width:16px;height:16px" /></span>&nbsp;<span style="position:relative;">
						<img border=0 src="'.$images.'/images/big2v1.png" style="position:absolute; top:'.($global_user['sexo'] == 'f' ? '-154px; clip:rect(154px 16px 170px' : '-132px; clip:rect(132px 16px 148px').' 0px);" alt="'.($global_user['sexo'] == 'f' ? 'Mujer' : 'Hombre').'" title="'.($global_user['sexo'] == 'f' ? 'Mujer' : 'Hombre').'" /><img border=0 src="'.$images.'/images/space.gif" style="width:16px;height:16px" /></span>  					<br clear="left" />
						<hr />
						<b class="txt_post">'.$global_user['numposts'].' Posts</b><br clear="left" />
						<b class="txt_post"><a target="_blank" href="/comentarios/'.$global_user['nick'].'">'.$global_user['numcomentarios'].' Comentarios</a></b><br clear="left" />
            <b class="txt_post">'.$global_user['puntos'].' Puntos</b><br clear="left" />

						<hr />
            <img src="'.$images.'/images/msg.gif" widht="16" height="16" alt="Mandale un mensaje!" title="Mandale un mensaje!" align="absmiddle" border="0" /> <a target="_blank" href="/"mensajes/a/'.$global_user['nick'].'" title="Mandale un mensaje!">Enviar mensaje</a>
            <br clear="left" />
						<hr />
					</div>
				</div>
				<div id="post-centro">
					<div class="box_title">

						<div class="box_txt post_titulo">'.$titulo.'</div>
						<div class="box_rrs">
							<div class="box_rss"></div>
						</div>
					</div>
					<div class="box_cuerpo" style="font-size:13px;line-height: 1.4em;">
					'.$bbcode->procesarbbcode($cuerpo).'
					</div>
				</div>

			<div style="clear: both;"/>
			<div align="right"><input type="button" class="button" value="Cerrar previsualizaci&oacute;n" title="Cerrar previsualizaci&oacute;n" onclick="kill_preview()" /> <input type="button"  class="button" onclick="confirm = false; document.forms.newpost.submit()" value="OK, est&aacute; perfecto!" title="OK, est&aacute; perfecto!" />&nbsp;&nbsp;</div><br />';

?>