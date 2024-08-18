<?php
include("../header.php");
$catid = no_injection($_POST['catid']);

if(empty($catid)){
	die("Falta el id de la categoria");
}

$sql2 = mysql_query("SELECT * FROM c_subscategorias WHERE id_categoria='{$catid}'");

echo "{";
while($row = mysql_fetch_array($sql2))
{
	$mysql = mysql_num_rows($sql2);
	$subc =	'"'.$row['id_subcategoria'].'":"'.$row['nombre_subcategoria'].'"';
	$conteo++;
	echo $subc;
	if($conteo<$mysql){
		echo ",";
	}
}

echo "}";
?>