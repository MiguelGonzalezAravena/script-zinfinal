<?php
include('header.php');
$cadena = no_injection($_GET["id"]);

$cad = explode("?", $cadena);
$id = $cad[0];
$id_extreme = $cad[1];

$sql = "Update usuarios Set activacion='1' Where id='".$id."' and id_extreme = '".$id_extreme."'";
if(mysql_query($sql))
{
?>	
	<SCRIPT LANGUAGE="javascript">
	location.href = "notificaciones/registroexi.php";
	</SCRIPT>
<?php
}
else
{
?>				
	<SCRIPT LANGUAGE="javascript">
	location.href = "notificaciones/registrofa.php";
	</SCRIPT>
<?php
}
?>