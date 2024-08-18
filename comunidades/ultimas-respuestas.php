<?php
require_once("../header.php");
$comid=(int)$_GET['comid'];
$cat=(int)$_GET['cat'];

function mensajes($ajax= false,$idco='',$idca=''){
	global $db, $comentarioz;
	
	if($ajax){
		$ajaxsql="AND (te.idcomunid='$idco' or co.categoria='$idca')";
	}
	
	$sqlcoments = mysql_query("SELECT te.idte,te.titulo,us.nick,co.shortname 
	FROM (c_respuestas as r, c_temas as te, usuarios as us, c_comunidades as co) 
	WHERE te.idte=r.idtemare AND us.id=r.idautorre AND co.idco=te.idcomunid {$ajaxsql} 
	ORDER BY r.fechare desc LIMIT 15");
	
	while($coments = mysql_fetch_array($sqlcoments))
	{
		echo'<li><strong>'.$coments['nick'].'</strong> <a href="/comunidades/'.$coments['shortname'].'/'.$coments['idte'].'.ultima/'.corregir($coments['titulo']).'.html#respuestas-abajo" class="size10">'.$coments['titulo'].'</a></li>';
	}
    mysql_free_result($sqlcoments);
}

if($direccion['1']=='comunidades'){
echo'1: ';
if($comid!=null xor $cat!=null){
	mensajes(true,$comid,$cat);
}else{
	mensajes(false);
}
}
?>