<?php
if (!defined('ZinFinal'))
	die('Intentado de Hack');

function DenunciasMain() {
	
	$subSeccion = array(
	    'comunidad' => 'comunidad',
		'notema' => 'notema',
	);
	
	if (!empty($subSeccion[@$_GET['ss']])) {
		$subSeccion[$_GET['ss']]();
	} else {
		Main();
	}
}

function Main() {
	global $images,$url;
	protocolo();
	
	$dbdenuncias = mysql_query("SELECT DISTINCT p.postid,p.titulo, COUNT(denunciante) as denuncias 
	FROM (denuncias AS d, posts as p)
	WHERE d.postid = p.postid GROUP BY d.denunciante");
	
	$nun_denuncias = mysql_num_rows($dbdenuncias);
	
	echo '<center><strong>LISTA DE DENUNCIAS ('.$nun_denuncias.')</strong></center><br>';
	
	while($denuncia = mysql_fetch_array($dbdenuncias)) {
		
		echo '<ul><li style="font-size:13px">
		<a href="/info"><img src="'.$images.'/images/admin/normal.png"/></a> <a href="'.$url.'/?postid='.$denuncia['postid'].'">'.$denuncia['titulo'].'</a> - ('.$denuncia['denuncias'].' denuncias ) | 
		<a href="/aceptar"><img src="'.$images.'/images/admin/aceptar.png"/></a> | 
		<a href="'.$url.'/edicion.form.php?id='.$denuncia['postid'].'"><img src="'.$images.'/images/editar.png"/></a> | 
		<a href="/borrar"><img src="'.$images.'/images/borrar.png"/></a><li></ul><br>';
		
		echo '<div style="color:black; background-color: #dfdfdf;">';
		mostrar_denuncias($denuncia['postid']);
		echo '</div>';
	}
	
	mysql_free_result($dbdenuncias);
	
	echo '<br><br><b>Acciones:</b> <img src="'.$images.'/images/admin/normal.png" title="Mas Informacion" /> &#8226; Mas Informacion | 
	<img src="'.$images.'/images/admin/aceptar.png" title="Aceptar el Post" /> &#8226; Aceptar el Post | 
	<img src="'.$images.'/images/editar.png" title="Editar el Post" /> &#8226; Editar el Post | 
	<img src="'.$images.'/images/borrar.png" title="Eliminar el Post" /> &#8226; Eliminar el Post 
	<br><br>';
}

function mostrar_denuncias($postid) {
	global $images,$url;
	
	$dbdenuncias2 = mysql_query("SELECT d.*,u.nick FROM (denuncias AS d, usuarios as u)
	WHERE d.denunciante = u.id and d.postid = '{$postid}' ");
	
	while($denunciantes = mysql_fetch_array($dbdenuncias2)) {
		echo '<b>- Denunciante:</b> <a href="'.$url.'/perfil/'.$denunciantes['nick'].'">'.$denunciantes['nick'].'</a> <b>Causa:</b> '.$denunciantes['razon'].' <b>Comentario:</b> '.$denunciantes['cuerpo'].'<br>';
	}
	
	mysql_free_result($dbdenuncias2);
}

?>