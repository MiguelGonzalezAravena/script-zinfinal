<?php
include("header.php");
require_once("class/class.registro.php");

$registro = new registro();
echo '1 ';
$registro->formulario();
?>