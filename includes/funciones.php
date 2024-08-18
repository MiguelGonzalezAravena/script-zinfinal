<?php

function actualizarango($usuarion, $rango, $puntos) {
	if ($rango=="11") {
		if($puntos>"49"){
		 mysql_query("UPDATE usuarios SET rango = 12 WHERE id = '{$usuarion}'");
	    }
	} else if ($rango=="12") {
		if($puntos>"499"){
		 mysql_query("UPDATE usuarios SET rango = 13 WHERE id = '{$usuarion}'");
	    }
	} else if($rango=="13") {
		if($puntos>"999"){
		 mysql_query("UPDATE usuarios SET rango = 14 WHERE id = '{$usuarion}'");
	    }
	}
}

function contarVisita($post, $ip) {
	if ($_SESSION['user']!="") {
		mysql_query("UPDATE posts SET visitas=visitas+1 WHERE postid = '{$post}' ");
	}
}

function arreglarpost($texto) {
	$texto = str_replace("'", "&#39;",$texto);
	return $texto;
}

function corregir($arreglo) {
	$arreglo = str_replace("<","&lt;",$arreglo);
	$arreglo = str_replace(">","&gt;",$arreglo);
	$arreglo = str_replace("\'","'",$arreglo);
	$arreglo = str_replace('\"',"&quot;",$arreglo);
	$arreglo = str_replace("\\\\","\\",$arreglo);
	$arreglo = str_replace(" ","-",$arreglo);
	$arreglo = str_replace("?","",$arreglo);
	return $arreglo;
}

function historial($valor) {
	$valor = str_replace("1", "<span class=\"color_red\">Eliminado</span>", $valor);
	$valor = str_replace("2", "<span class=\"color_green\">Editado</span>", $valor);
	return $valor;
}

function guardartags($valor) {
	$valor = str_replace(", ", ",", $valor);
	return $valor;
}

function mostrartags($valor) {
	$valor	=	str_replace(",", ", ", $valor);
	return $valor;
}

function hace($fecha){
    $ahora = time();
    $tiempo = $ahora-$fecha; 
     if(round($tiempo / 31536000) <= 0){
        if(round($tiempo / 2678400) <= 0){
             if(round($tiempo / 86400) <= 0){ 
                 if(round($tiempo / 3600) <= 0){ 
                    if(round($tiempo / 60) <= 0){ 
                if($tiempo <= 60){ $hace = "Menos de 1 minuto"; } 
                } else  
                { 
                    $can = round($tiempo / 60); 
                    if($can <= 1) {    $word = "minuto"; } else { $word = "minutos"; } 
                    $hace = "Hace " .$can. " ".$word; 
                } 
                } else  
                { 
                    $can = round($tiempo / 3600); 
                    if($can <= 1) {    $word = "hora"; } else {    $word = "horas"; } 
                    $hace = "Hace " .$can. " ".$word; 
                } 
                } else  
                { 
                    $can = round($tiempo / 86400); 
                    if($can <= 1) {    $word = "d&iacute;a"; } else {    $word = "d&iacute;as"; } 
                    $hace = "Hace " .$can. " ".$word;
                } 
                } else  
                { 
                    $can = round($tiempo / 2678400);  
                    if($can <= 1) {    $word = "mes"; } else { $word = "meses"; } 
                    $hace = "Hace " .$can. " ".$word; 
                } 
                } else  
                { 
                    $can = round($tiempo / 31536000); 
                    if($can <= 1) {    $word = "a&ntilde;o";} else { $word = "a&ntilde;os"; } 
                    $hace = "Hace " .$can. " ".$word; 
                }
                
    return $hace; 
}

function cortar($texto,$hasta = 45){
    $cantidad = strlen($texto);
    if ($cantidad > $hasta) {
        return substr($texto, 0, $hasta).'...';
    } else {
        return "$texto";
    }
}

function fecha($valor) {
	return date('d.m.Y',$valor).' a las '.date('H.m',$valor).' hs.';
}

function publicidad($tar,$categoria,$x,$y) {
	global $global_config;
	
	$retorno = '
	<script type="text/javascript">
	GA_googleFillSlotWithSize("'.$global_config['ca-pub'].'", "'.$tar.''.$categoria.'", '.$x.', '.$y.');
	</script>';
	
	return $retorno;
}

/* Funciones de Comunidades */

function visitascomunidad($idtemax, $creadoxc) {
	if ($_SESSION['id']!=null and $_SESSION['user']!=$creadoxc){
		mysql_query("UPDATE c_temas SET visitaste=visitaste+1 WHERE idte='{$idtemax}'");
	}
}

function rangocomunidad($valor) {
	$rango = array('1' => 'Visitante','2' => 'Comentador','3' => 'Posteador','4' => 'Moderador','5' => 'Administrador');
	return $rango[$valor];
}

?>