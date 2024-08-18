<?php
require_once("header.php");

$key = $_POST['key'];
$action = $_POST['action'];

/*FOLLOWN*/

$type = $_POST['type'];
$obj = $_POST['obj']; // ID posts o ID key

$seguidores->db_seguidores($type,$obj);

if($type == 'user') {
	if($action == 'follow') {
		
		die(''.$seguidores->follow().'');
	}
	if($action == 'unfollow') {
		die(''.$seguidores->unfollow().'');
	}
}

if($type == 'post') {
	if($action == 'follow') {
		die(''.$seguidores->follow().'');
	}
	if($action == 'unfollow') {
		die(''.$seguidores->unfollow().'');
	}
}

if($action == 'count') {
	die(''.$seguidores->notificaciones.'');
}

/*Notificaciones*/

if($action == 'last') {
	
	$seguidores->x_mini();
	
	if (count($seguidores->array_n['mini']) < 0) {
		die('No tiene Notificaciones Nuevas');
	} else {
		foreach ($seguidores->array_n['mini'] as $key => $value) {
			echo '<li onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')">'.$seguidores->x_mini[$value['x']][$value['idno']]['mini'].'</li>';
		}
	}
}

?>