<?php
$comunidad = 'ZinFinal';
$descripcion = 'Una Gran Comunidad Online';
$url = 'http://localhost';
$codigo_google = '007506727807847916017:ifbhtkfqxz4';
$images = 'http://localhost';
$email_server = 'webmaster@zinfinal.com';
$public_key = '6LfYDboSAAAAAB2U4VXSZEWCFh6Iopjo75DJfCwH';
$private_key = '6LfYDboSAAAAAGYqfH_DWHpGklauFNOEV7lwrAow';
$bd_host = 'localhost';
$bd_usuario = 'root';
$bd_password = '1234';
$bd_base = 'zinfinal';
$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
       mysql_select_db($bd_base, $con);
?>