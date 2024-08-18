<?php
include("../header.php");
$titulo	= $descripcion;
cabecera_normal();

if($key==null){
fatal_error('Para ver tus comunidades necesitas autentificarte');
}

switch($_GET['sort_by']) {
case "nombre":
$sort_by = 'co.nombre';
break;
case "rango":
$sort_by = 'm.rangoco';
break;
case "miembros":
$sort_by = 'co.numm';
break;
case "temas":
$sort_by = 'co.numte';
break;
default:
$sort_by = 'm.rangoco';
}

$limit_comus=10;

$request = mysql_query("SELECT idm FROM c_miembros where iduser = '$key' ");
$NroRegistros = mysql_num_rows($request);

if(isset($_GET['pagina'])){
$RegistrosAEmpezar=($_GET['pagina']-1)*$limit_comus;
$PagAct=$_GET['pagina'];
}else{
$RegistrosAEmpezar=0;
$PagAct=1;
}
$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$limit_comus;
$Res=$NroRegistros%$limit_comus;

if($Res>0){
$PagUlt = floor($PagUlt)+1;
}

$sqlcom = mysql_query("SELECT m.idm,m.rangoco,co.nombre,co.shortname,co.imagen,co.descripcion,co.oficial,co.numte,co.numm,ca.nom_categoria 
FROM c_miembros as m
LEFT JOIN c_comunidades as co ON co.idco = m.idcomunity
LEFT JOIN c_categorias as ca ON ca.id_categoria = co.categoria
WHERE m.iduser='{$key}' ORDER BY $sort_by DESC LIMIT $RegistrosAEmpezar, $limit_comus");

$NroMostrando = mysql_num_rows($sqlcom);
echo '<div id="cuerpocontainer">

<div class="comunidades">

<div class="breadcrump">
<ul>
<li class="first"><a href="/comunidades/" title="Comunidades">Comunidades</a></li><li>Mis comunidades</li><li class="last"></li>
</ul>
</div>

	<div style="clear:both"></div>



	<div id="resultados" class="resultadosFull">

<div class="filterBy filterFull">
	<div class="floatL xResults">
		Mostrando <strong>1 - '.$NroMostrando.'</strong> resultados de <strong>'.$NroRegistros.'</strong>
	</div>

	<ul class="floatR">
		<li class="orderTxt">Ordenar por:</li>
		<li'.($sort_by == 'co.nombre' ? ' class="here"' : '').'><a href="/comunidades/mis-comunidades/nombre/">Nombre</a></li>
		<li'.($sort_by == 'm.rangoco' ? ' class="here"' : '').'><a href="/comunidades/mis-comunidades/rango/">Rango</a></li>
		<li'.($sort_by == 'co.numm' ? ' class="here"' : '').'><a href="/comunidades/mis-comunidades/miembros/">Miembros</a></li>
		<li'.($sort_by == 'co.numte' ? ' class="here"' : '').'><a href="/comunidades/mis-comunidades/temas/">Temas</a></li>

	</ul>
	<div class="clearBoth"></div>
</div> <!-- FILTER BY -->

<div id="showResult" class="resultFull">
	<ul>';

while($row = mysql_fetch_array($sqlcom)) {
	echo '<li class="resultBox'.($row['oficial']=='1' ? ' oficial' : '').'">
			<h4><a href="/comunidades/'.$row['shortname'].'/">'.$row['nombre'].'</a></h4>
			<div class="floatL avatarBox">

				<a href="/comunidades/'.$row['shortname'].'/"><img src="'.$row['imagen'].'" alt="'.$row['shortname'].'" width="75" height="75" onerror="com.error_logo(this)" />'.($row['oficial']=='1' ? '<img src="'.$images.'/images/riboon.png" class="riboon" />' : '').'</a>
			</div>
			<div class="floatL infoBox">
				<ul>
					<li>Categor&iacute;a: <strong>'.$row['nom_categoria'].'</strong></li>
					<li title="'.$row['descripcion'].'">'.cortar($row['descripcion'],70).'</li>
					<li>Miembros: <strong>'.$row['numm'].'</strong> - Temas: <strong>'.$row['numte'].'</strong></li>
					<li>Mi rango: <strong>'.rangocomunidad($row['rangoco']).'</strong></li>
				</ul>
			</div>
		</li>';	
}

mysql_free_result($sqlcom);

echo '
		</ul>
	<div class="clearBoth"></div>
</div>
<div class="floatL" style="margin-left: 5px; width: 200px; margin-top: 25px;">
	'.$publicidadz['160-600'].'
</div>

<!-- Paginado -->';
if($limit_comus<$NroRegistros) {
	echo'<div class="paginadorCom" style="float:left;width:685px">
<div class="before floatL" style="display:block;margin: 5px 0;width: 270px; width: 110px">';
    if($PagAct>1) {
        echo '<a href="/comunidades/mis-comunidades/rango.'.$PagAnt.'/"><b>&laquo; Anterior</b></a>';
    }
echo '
</div>
<div style="float:left;width: 370px;margin-top: 4px">
<ul style="margin:0 auto;width:200px">';
       for ($numbers = 1; $numbers<=$PagUlt; $numbers++){
           if($numbers==$PagAct){
           echo'<li class="numbers"><a class="here" href="">'.$numbers.'</a></li>';
           }else{
           echo'<li class="numbers"><a href="/comunidades/mis-comunidades/rango.'.$numbers.'/">'.$numbers.'</a></li>';
           }
       }
echo '
	<div class="clearBoth"></div>
</ul>
</div>
<div class="floatR next" style="display:block;margin: 5px 0; width: 110px;text-align:right">';
    if($PagAct<$PagUlt) {
        echo '<a href="/comunidades/mis-comunidades/rango.'.$PagSig.'/"><b>Siguiente &raquo;</b></a>';
    }
echo '
</div>
</div>';
}

echo '
<!-- FIN - Paginado -->

</div>

</div>';

pie();
?>