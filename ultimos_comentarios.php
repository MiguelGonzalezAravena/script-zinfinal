<?php
require_once("header.php");
$categoria = htmlspecialchars($_GET['categoria'], ENT_QUOTES);

$zinfinal->ultimos_comentarios('-1');

foreach ($zinfinal->ultimos['comentarios'] as $key => $value) {
	echo '<div style="white-space:nowrap;overflow:hidden;width:100%"><strong>'.$value['nick'].'</strong> <a href="/posts/'.$value['link'].'/'.$value['postid'].'/'.corregir($value['titulo']).'.html#cmnt_35061935" class="size10">'.$value['titulo'].'</a></div>
	';
}

?>