<?php
require_once('header.php');

$save = $_POST['save'];
$id = $_POST['id'];
$s = $_POST['s'];
$crc = $_POST['crc'];
$coords = $_POST['coords'];
$callback = $_POST['callback'];

$maximo_mb = '50000000000000000000';
$avatares = 'avatares';

$destino = "$avatares/$key";

if(!file_exists(dirname(__FILE__) . "/$destino")) {
	mkdir($destino);
}

$tamano = $_FILES [ 'file-avatar' ][ 'size' ];

move_uploaded_file ( $_FILES [ 'file-avatar' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file-avatar' ][ 'name' ]);

die('{"error":"success"}');



?>