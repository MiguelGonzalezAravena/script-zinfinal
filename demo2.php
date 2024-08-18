<?php
$permisos = array(
"acceso_admin"=>1,
"acceso_mod"=>1,
"crear_c"=>1,
"numero_c"=>5,
"editar_c"=>1,
"eliminar_c"=>1,

"editar_t"=>1,
"eliminar_t"=>1,
"elimcomen_t"=>1,
"rest_t"=>1,

"editar_p"=>1,
"eliminar_p"=>1,
"elimcomen_p"=>1,
"coment_p"=>1,
"darpunto_p"=>1,
"rest_p"=>1,

"crear_u"=>1,
"editar_u"=>1,
"eliminar_u"=>1,
"suspender_u"=>1,

"editarnom_r"=>1,
"cambiar_r"=>1);

$bloqueados = serialize($permisos);

echo ''.$bloqueados.'';

?>
<?php

$IPADDRESS = $_SERVER["REMOTE_ADDR"];

$archivo_xml = "http://api.hostip.info/get_xml.php?ip=".$IPADDRESS ."";
$procedencia_xml = file_get_contents ($archivo_xml);

preg_match_all("|<Hostip>(.*)</Hostip>|sU", $procedencia_xml, $items);

$lista_nodos = array();

foreach ($items[1] as $key => $item) {
	preg_match("|<gml:name>(.*)</gml:name>|s", $item, $mi_lugar);
	preg_match("|<countryName>(.*)</countryName>|s", $item, $mi_pais);
	preg_match("|<countryAbbrev>(.*)</countryAbbrev>|s", $item, $mi_sigla);
	$lista_nodos[$key]['mi_lugar'] = $mi_lugar[1];
	$lista_nodos[$key]['mi_pais'] = $mi_pais[1];
	$lista_nodos[$key]['mi_sigla'] = $mi_sigla[1];
}

echo "Pais = ". $lista_nodos[0]['mi_pais']."<br>";
echo "Lugar = ". $lista_nodos[0]['mi_lugar']."<br>";
echo "Sigla = ". $lista_nodos[0]['mi_sigla']."<br>";

?>