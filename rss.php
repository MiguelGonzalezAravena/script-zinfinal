<?php
include_once("header.php");
include("includes/bbcode.php");
$bbcode = new bbcode_zinfinal();

$data = $_GET['data'];
$id = $_GET['data2'];
$data3 = $_GET['data3'];
$data4 = $_GET['data4'];

function db_posts() {
	global $comunidad,$images,$url,$data,$id,$channel;
	
	if ($data == 'posts-usuario') {
		$dbposts = mysql_query("SELECT id,nick FROM usuarios WHERE id = '{$id}' LIMIT 1");
	} else {
		$dbposts = mysql_query("SELECT postid,titulo FROM posts WHERE postid = '{$id}' LIMIT 1");
	}
	
	$posts = mysql_fetch_array($dbposts);
	mysql_free_result($dbposts);
	
	$channel = array('ultimos-post' => array('title' => 'Ultimos posts','description' => 'Ultimos posts de '.$comunidad.'','link' => ''.$url.'/'),
	                 'comentarios' => array('title' => 'Comentarios para el post: '.$posts['titulo'].'','description' => 'Comentarios para el post '.$posts['titulo'].' de '.$comunidad.'','link' => ''.$url.'/?postid='.$posts['postid'].''),
	                 'posts-usuario' => array('title' => 'Post creados por el usuario: '.$posts['nick'].'','description' => 'Ultimos 15 post creados por el usuario '.$posts['nick'].' en '.$comunidad.'','link' => ''.$url.'/perfil/'.$posts['id'].''),
	                 'top-post-semana' => array('title' => 'Post TOP de la semana','description' => 'Los post con mas puntos de la semana de '.$comunidad.'','link' => ''.$url.'/top/'));
	
	echo '
	<title>'.$comunidad.' - '.$channel[$data]['title'].'</title>
	<description>'.$channel[$data]['description'].'</description>
	<image><title>'.$comunidad.'</title><link>'.$url.'/</link><url>'.$images.'/images/logo-rss.gif</url></image>
	<generator>'.$url.'/</generator>
	<language>es</language>
	<link>'.$channel[$data]['link'].'/</link>
	';
	
	if ($data == 'ultimos-post') {
		ultimos_post();
	} elseif ($data == 'comentarios') {
		comentarios();
	} elseif ($data == 'posts-usuario') {
		posts_usuario();
	} elseif ($data == 'top-post-semana') {
		top_post_semana();
	} else {
		ultimos_post();
	}
}

function db_comunidades() {
	global $comunidad,$images,$url,$data,$id,$channel,$data2,$data3;
	global $bbcode;
	
	if ($data == 'perfil') {
		$donde = "t.id_autor = '{$data3}'";
	} else if ($id == 'tema-respuestas') {
		$donde = "t.temaid = '{$data3}'";
	} else if ($id != 'tema-respuestas' and $id) {
		$donde = "co.shortname = '{$id}'";
	} else {
		$donde = "1 = 1";
	}
	
	$dbcomunidades = mysql_query("SELECT t.temaid,t.titulo,t.cuerpo,t.fechate,co.nombre,co.shortname,u.nick 
	FROM c_temas t 
	LEFT JOIN c_comunidades co ON co.idco = t.idcomunid 
	LEFT JOIN usuarios u ON u.id = t.id_autor 
	WHERE $donde LIMIT 1");
	
	$c = mysql_fetch_array($dbcomunidades);
	mysql_free_result($dbcomunidades);
	
	if ($data == 'perfil') {
		$channel = array('title' => 'Ultimos Temas de '.$c['nick'].'','description' => 'Ultimos Temas creados','link' => ''.$url.'/');
	} elseif ($id == 'tema-respuestas') {
		$channel = array('title' => $c['titulo'],'description' => 'Ultimas respuestas de '.$c['titulo'].'','link' => ''.$url.'/comunidades/'.$c['shortname'].'/'.$c['temaid'].'/'.corregir($c['titulo']).'.html');
	} elseif ($id != 'tema-respuestas' and $id) {
		$channel = array('title' => $c['nombre'],'description' => 'Ultimos Temas en '.$c['nombre'].'','link' => ''.$url.'/');
	} else {
		$channel = array('title' => 'Ultimos Temas de Comunidades','description' => 'Ultimos Temas creados','link' => ''.$url.'/');
	}
	
	echo '
	<title>'.$comunidad.' - '.$channel['title'].'</title>
	<description><![CDATA[ '.$channel['description'].' ]]></description>
	<image><title>'.$comunidad.'</title><link>'.$url.'/</link><url>'.$images.'/images/logo-rss.gif</url></image>
	<generator>'.$url.'/</generator>
	<language>es</language>
	<link>'.$channel['link'].'</link>
	';
		
	$db_temas = mysql_query("SELECT t.temaid,t.titulo,t.cuerpo,t.fechate,co.shortname,u.nick 
	FROM c_temas t 
	LEFT JOIN c_comunidades co ON co.idco = t.idcomunid 
	LEFT JOIN usuarios u ON u.id = t.id_autor 
	WHERE $donde 
	ORDER BY t.temaid DESC LIMIT 15");
	
	while ($t = mysql_fetch_array($db_temas)) {
		echo '
		<item>
		<title><![CDATA[ '.$t['titulo'].' ]]></title>
		<link>'.$url.'/comunidades/'.$t['shortname'].'/'.$t['temaid'].'/'.corregir($t['titulo']).'.html</link>
		<pubDate>'.date('D',$t['fechate']).','.date('d M Y H:m:s',$t['fechate']).' -0300</pubDate>
		<comments>'.$url.'/comunidades/'.$t['shortname'].'/'.$t['temaid'].'/'.corregir($t['titulo']).'.html#respuestas</comments>
		<description><![CDATA[ '.cortar($bbcode->procesarbbcode($t['cuerpo']),300).' <p>
		<strong><a href="'.$url.'/comunidades/'.$t['shortname'].'/'.$t['temaid'].'/'.corregir($t['titulo']).'.html">Seguir leyendo...</a></strong></p> ]]></description>
		</item>
		';
	}
	
	mysql_free_result($db_temas);
	
}

function ultimos_post() {
	global $comunidad,$url,$id,$bbcode;
	
	$dbposts2 = mysql_query("SELECT p.postid,p.titulo,p.contenido,p.creado,p.puntos,c.link_categoria 
	FROM posts p 
	LEFT JOIN categorias c ON c.id_categoria = p.categoria 
	LEFT JOIN usuarios u ON u.id = p.id_autor 
	WHERE p.estado='0' AND u.rango!='11' ORDER BY p.postid DESC LIMIT 15");
	
	while($row = mysql_fetch_array($dbposts2)) {
		echo '<item>
			<title>'.$row['titulo'].' ('.$row['puntos'].' puntos)</title>
			<link>'.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html</link>
			<pubDate>'.date('D',$row['creado']).','.date('d M Y H:m:s',$row['creado']).' -0300</pubDate>
			<category><![CDATA['.$row['link_categoria'].']]></category>
			<comments>'.$url.'/'.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html#comentarios</comments>
			<description><![CDATA['.cortar($bbcode->procesarbbcode($row['contenido']),300).'<p><strong><a href=\''.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html\'>Seguir leyendo... >></a></strong></p>]]></description>
		</item>';
	}
	
	mysql_free_result($dbposts);
}

function comentarios() {
	global $bbcode,$comunidad,$url,$id;
	
	$dbcoment = mysql_query("SELECT t.temaid,t.titulo,t.cuerpo,t.fechate,co.shortname,u.nick 
	    FROM c_temas t 
	    LEFT JOIN c_comunidades co ON co.idco = t.idcomunid 
	    LEFT JOIN usuarios u ON u.id = t.id_autor 
	    WHERE ".($data == 'perfil' ? 't.id_autor' : 't.temaid')." = '{$data3}' 
	    ORDER BY t.temaid DESC LIMIT 15");
	
	while($rssc = mysql_fetch_array($dbcoment)) {
		echo '<item>
					<title>Comentario de '.$rssc['autor'].'</title>
					<link>'.$url.'/?postid='.$id.'#'.$rssc['id'].'</link>
					<dc:creator>'.$rssc['autor'].'</dc:creator>
					<pubDate>'.date('D',$rssc['fecha']).','.date('d M Y H:m:s',$rssc['fecha']).' -0300</pubDate>
					<description><![CDATA['.$bbcode->procesarbbcode($rssc['comentario']).']]></description>
				</item>';
	}
	mysql_free_result($dbcoment);
}

function posts_usuario() {
	global $comunidad,$url,$id,$bbcode;
	
	$sqlposts = mysql_query("SELECT p.postid,p.titulo,p.contenido,p.creado,p.puntos,c.link_categoria 
	FROM posts p 
	LEFT JOIN categorias c ON c.id_categoria = p.categoria 
	WHERE p.id_autor = '{$id}' and p.estado='0' ORDER BY p.creado DESC LIMIT 15");
	
	while($row = mysql_fetch_assoc($sqlposts)) {
		echo'
		<item>
		<title>'.$row['titulo'].' ('.$row['puntos'].' puntos)</title>
		<link>'.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html</link>
		<pubDate>'.date('D',$row['creado']).','.date('d M Y H:m:s',$row['creado']).' -0300</pubDate>
		<category><![CDATA['.$row['link_categoria'].']]></category>
		<comments>'.$url.'/'.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html#comentarios</comments>
		<description><![CDATA[ '.cortar($bbcode->procesarbbcode($row['contenido']),300).'<p>
		<strong><a href=\''.$url.'/posts/'.$row['link_categoria'].'/'.$row['postid'].'/'.corregir($row['titulo']).'.html\'>Seguir leyendo... >></a></strong></p>]]></description>
		</item>
		';
	}
	
	mysql_free_result($sqlposts);
}

################## MOSTRAMOS ##################

echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>';

if ($data == 'comunidades' or $data == 'perfil')
    db_comunidades();
else
    db_posts();

echo '

</channel>
</rss>';

mysql_close($con);
?>