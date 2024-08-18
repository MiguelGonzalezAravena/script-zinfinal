<?php
include("header.php");

$id = $_SESSION['id'];
if($_SESSION['user']!=null)
{
$nombre = no_injection($_POST["nombre"]);

$nombre_mostrar = no_injection($_POST["nombre_mostrar"]);

$email = no_injection($_POST["email"]);

$email_mostrar = no_injection($_POST["email_mostrar"]);

$ciudad = no_injection($_POST["ciudad"]);
$dia = no_injection($_POST["dia"]);
$mes = no_injection($_POST["mes"]);
$ano = no_injection($_POST["ano"]);

$fecha_nacimiento_mostrar = no_injection($_POST["fecha_nacimiento_mostrar"]);

$sitio = no_injection($_POST["sitio"]);
$im = no_injection($_POST["im"]);

$im_mostrar = no_injection($_POST["im_mostrar"]);

$pais = no_injection($_POST["pais"]);
$sexo = no_injection($_POST["sexo"]);
$key = no_injection($_POST["key"]);

$sqlu=$db->query("Update usuarios Set nombre='$nombre', mail='$email', ciudad='$ciudad', dia='$dia', mes='$mes', ano='$ano', sitio_web='$sitio', mensajero='$im', pais='$pais', sexo='$sexo' Where id='$id'");
$sqlu=$db->query("Update preferencias Set nombre_mostrar='$nombre_mostrar', email_mostrar='$email_mostrar', fecha_nacimiento_mostrar='$fecha_nacimiento_mostrar', im_mostrar='$im_mostrar' Where iduser='$id'");
echo"OK";
}
?>
