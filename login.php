<?php
include("header.php");

$user = $_POST['nick'];
$pass = $_POST['pass'];

if (empty($user) or empty($pass))
    die('0: Faltan Datos');

$pass = md5($pass);
$query = mysql_query("SELECT userid, estado FROM usuarios WHERE nick = '{$user}' and password = '{$pass}'");

if (!mysql_num_rows($query))
    die('0: Datos no validos');

$data = mysql_fetch_array($query);
mysql_free_result($query);

if ($data["estado"] == '0')
	die('0: Activa tu Usuario');
if ($data["estado"] == '2')
	die('2: Tu cuenta se encuentra suspendida');

$id_zinfinal = md5(uniqid(rand(), true));
$_SESSION['user'] = $user;
$_SESSION['id'] = $data['userid'];
$_SESSION['id_zinfinal'] = $id_zinfinal;
$id_zinfinal2 = $data['userid']."%".$id_zinfinal."%".$ip;
setcookie('id_zinfinal', $id_zinfinal2, time()+7776000,'/');
$query = mysql_query("UPDATE usuarios SET id_zinfinal = '{$id_zinfinal}' WHERE nick = '{$user}'");

if ($query)
    die("1:");
else
    die("0: Hubo un Error Interno");
?>