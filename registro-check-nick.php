<?php
include("header.php");
require_once("class/class.registro.php");
$nick = new registro();

if ($nick->check_nick($_POST["nick"]))
    echo'0: El nick ya est&aacute; en uso';
else
    echo'1: El nick esta disponible';
?>