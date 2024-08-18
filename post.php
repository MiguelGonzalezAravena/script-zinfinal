<?php
require_once("header.php");
require_once("class/class.posts.php");

function post_template() {
	global $zinfinal, $post;
	echo '';
}

function post_errores_template($mensaje,$denunciado = false) {
	global $post;
	
	$post->relacionados($post->existe ? false : true);
	
	echo '<div class="post-'.($denunciado ? 'denunciado' : 'deleted').'">
	<h3>'.$mensaje.'</h3>
	Pero no pierdas las esperanzas, no todo esta perdido, la soluci&oacute;n est&aacute; en:
	<h4>Post Relacionados</h4>
	<ul>
	';
	
	foreach ($post->post['relacionados'] as $key => $r) {
		echo '<li class="categoriaPost '.$r['link'].'">
			<a title="'.$r['titulo'].'" href="/posts/'.$r['link'].'/'.$r['postid'].'/'.corregir($r['titulo']).'.html">'.$r['titulo'].'</a>
		</li>
		';
	}

	echo '
	</ul>
</div>';

    pie();
    exit;
}

function post_denunciado_template() {
	global $zinfinal, $post;
	echo '';
}

$postid = (int) $_GET["id"];

cabecera_normal();

$post = new post($postid);

if (empty($postid))
    $zinfinal->fatal_error("El campo <b>ID del Post</b> es requerido para esta operacion");

if (!$post->existe)
    post_errores_template('Oops! Este post no existe o fue eliminado!');

if ($post->post['estado'] == '1')
    post_errores_template('Oops! El post fue eliminado!');

if ($post->post['estado'] == '2')
    post_errores_template('Oops! El Post se encuentra en revisi&oacute;n por acumulaci&oacute;n de denuncias', true);

if ($post->post['privado'] == '1' and empty($key)) {
	require_once("class/class.registro.php");
	$privado = new registro();
	$privado->formulario_registro_login();
}

post_template();

pie();
?>