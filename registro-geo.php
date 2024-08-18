<?php
$type = htmlspecialchars($_GET['type'], ENT_QUOTES);
$pais_code = htmlspecialchars($_GET['pais_code'], ENT_QUOTES); //Ejemplo de Pais: PE
$provincia = htmlspecialchars($_GET['provincia'], ENT_QUOTES);//Ejemplo de Provincia: Tacna
$q = htmlspecialchars($_GET['q'], ENT_QUOTES);

/* JAJA ESTO SOLO ES POR EL MOMENTO HASTA QUE TERMINE CON LAS TABLAS DE LOS PAISES Y CIUDADES :P */
$prov = array('PE' => '<option value="1">Amazonas</option>
					<option value="8">Cusco</option>
					<option value="10">HuÃ¡nuco</option>
					<option value="11">Ica</option>
					<option value="13">La Libertad</option>
					<option value="15">Lima</option>
					<option value="18">Moquegua</option>
					<option value="23">Tacna</option>
					<option value="25">Ucayali</option>',
			  'AR' => '<option value="1">Buenos Aires</option>
					<option value="5">CÃ³rdoba</option>>
					<option value="7">Ciudad AutonÃ³ma de Buenos Aires</option>
					<option value="13">Mendoza</option>
					<option value="24">TucumÃ¡n</option>',
			  'MX' => '<option value="1">Aguascalientes</option>
					<option value="6">Chihuahua</option>
					<option value="9">Distrito Federal</option>
					<option value="11">Guanajuato</option>
					<option value="14">Jalisco</option>
					<option value="15">MÃ©xico</option>',
			  'UY' => '<option value="1">Artigas</option>
					<option value="2">Canelones</option>
					<option value="10">Montevideo</option>');

$ciu = array('PE' => 'Tacna|3928128
Lima Lima|3961301',
             'AR' => 'Buenos Aires|3435910
Buenos Aires Chico|3863774',
             'MX' => 'Estado de MÃ©xico|3527704
Nuevo MÃ©xico|3815640',
             'UY' => 'Uruguay|3439706');

if($type == 'provincias' and !empty($pais_code)){
	die('1: '.$prov[$pais_code].'');
}

if($type == 'ciudades' and !empty($pais_code)){
	
	die($ciu[$pais_code]);
}

if($type == 'check'){
	die('1: OK');
}

if($type =='hay_ciudades'){
	die('1: OK');
}
?>