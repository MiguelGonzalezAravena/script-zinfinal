if(!lang)
	var lang = Array();
lang['mp realmente eliminar definitivo'] = "Realmente desea eliminar definitivamente los mensajes seleccionados?\nEsta accion no podra ser revertida";
lang['mp realmente eliminar definitivo2'] = "Realmente desea borrar todos los mensajes de la carpeta Mensajes Eliminados?\nEsta acci\xF3n no podra ser revertida";
lang['mp falta destinatario'] = "Por favor, especific\xe1 el destinatario";
lang['mp falta asunto'] = "El campo Asunto no fue completado.\n\nPara enviar este mensaje apret\u00E1 Aceptar.\nPara editar el campo asunto presion\u00E1 Cancelar";
lang['mp falta cuerpo'] = "El mensaje est\u00E1 vac\u00EDo.\n\nPara enviar este mensaje apret\u00E1 Aceptar.\nPara editar el mensaje presion\u00E1 Cancelar";
lang['mp user no existe'] = "Lo siento, ese usuario no existe. Por favor, verific\u00E1 el nombre e intent\u00E1 nuevamente";
lang['mp a mi'] = "No es posible enviarse mensajes a s\u00ED mismo.\nNadie te envia mensajes? Visit\u00E1 nuestro CHAT y encontr\u00E1 nuevos amigos!";
lang['Cambiar nombre'] = "Cambiar nombre";
lang['Cambiar'] = "Cambiar";
lang['Cambiar nombre de carpeta'] = "Cambiar nombre de carpeta";
lang['Eliminar carpeta'] = "Eliminar carpeta";
lang['mp realmente eliminar carpeta'] = "Realmente deseas eliminar la carpeta?\nSi borras la carpeta todos los mensajes que esta contenga ser\u00E1n enviados a la carpeta de Mensajes Eliminados";

function mensajes_marcados(estado){
	var checked=Array();
  var inputs=document.getElementsByTagName('input');
  prefix='m_';
  if(estado=='NL')//Leidos - Osea marcar los posts como no leidos
    prefix+='o_';
  else if(estado=='L')//No Leidos - Osea marcar los posts como leidos
    prefix+='c_';

  for(var i=0;i<inputs.length; i++)
    if(inputs.item(i).type=='checkbox' && inputs.item(i).name.substring(0,prefix.length)==prefix && inputs.item(i).checked==true)
      checked[checked.length] = inputs.item(i).name.substring(4);

	return checked;
}

function mensajes_acciones(key,id){
	if(id){
		var o='NL';
		var checked = id;
	}else
		var f=document.forms.mensajes, fm=f.elements.marcar, o=fm.options[fm.options.selectedIndex].value;
	if(o=='L' || o=='NL'){
		if(!id)
			var checked = mensajes_marcados(o);
		if(checked.length>0)
			location.href='/mensajes-marcar-leido.php?leido='+(o=='NL'?0:1)+'&ids=' + checked.toString() + '&key='+key;
	}
}

function mensajes_eliminar(key,id){
	if(id)
		var checked = id;
	else
		var checked = mensajes_marcados();
	if(checked.length>0)
		location.href='/mensajes-marcar-eliminado.php?ids=' + checked.toString() + '&key='+key;
}

function mensajes_eliminar_2(key){
	if(!confirm(lang['mp realmente eliminar definitivo']))
		return;
	var checked = mensajes_marcados();
	if(checked.length>0)
		location.href='/mensajes-marcar-eliminado-2.php?ids=' + checked.toString() + '&key='+key;
}

function mensajes_vaciar_eliminados(key){
	if(confirm(lang['mp realmente eliminar definitivo2']))
		location.href='/mensajes-marcar-eliminado-2.php?all=1&key='+key;
}

function mensajes_responder_actual(id){
	location.href='/mensajes-responder.php?id=' + id;
}

function mensajes_mover_actual(key,id,carpeta){
	location.href='/mensajes-mover.php?carpeta=' + carpeta + '&ids=' + id + '&key=' + key;
}

function mensajes_mover(key){
	var f=document.forms.mensajes;
	var fm=f.elements.mover_a_carpeta;
	var carpeta=fm.options[fm.options.selectedIndex].value;
	var checked = mensajes_marcados();
	if(fm.options.selectedIndex!=-1 && checked.length>0)
		location.href='/mensajes-mover.php?carpeta=' + carpeta + '&ids=' + checked.toString() + '&key='+key;
	else
		fm.options.selectedIndex=0;
}

function mensajes_crear_carpeta_form(visible){
	$('#crear_carpeta_link').css('display',(visible)?'none':'inline');
	$('#crear_carpeta_div').css('display',(visible)?'inline':'none');
}

function mensajes_validar(all){
	var f=document.forms.compose;
	if(!all && f.msg_to.value==''){
		alert(lang['mp falta destinatario']);
		f.msg_to.focus();
		return false;
	}

	if(f.msg_subject.value=='' && !confirm(lang['mp falta asunto'])){
		f.msg_subject.focus();
		return false;
	}

	if(f.msg_body.value=='' && !confirm(lang['mp falta cuerpo'])){
		f.msg_body.focus();
		return false;
	}

	if(!all){
		$.ajax({
			type: 'GET',
			url: '/mensajes-validar-destino.php',
			data: 'nick=' + encodeURIComponent(document.forms.compose.msg_to.value),
			success: function(h){
				if(h=='OK')
					document.forms.compose.submit();
				else if(h=='ERROR1')
		alert(lang['mp user no existe']);
				else if(h=='ERROR2')
		alert(lang['mp a mi']);
			}
		});
	}else
		document.forms.compose.submit();
}

function mensajes_check(accion){
	var inputs=document.getElementsByTagName('input');
	prefix='m_';
	if(accion==3)//Leidos
		prefix+='o_';
	else if(accion==4)//No Leidos
		prefix+='c_';
	if(accion==2)//No selecciona
		estado=false;
	else
		estado=true;
	for(var i=0;i<inputs.length; i++)
		if(inputs.item(i).type=='checkbox' && inputs.item(i).name.substring(0,2)=='m_')
			if(accion==5)
				inputs.item(i).checked=!inputs.item(i).checked;
			else if(inputs.item(i).name.substring(0,prefix.length)==prefix)
				inputs.item(i).checked=estado;
			else
				inputs.item(i).checked=!estado;
}

function mensajes_show_opciones_carpeta(id,key){
	if($('#opciones_carpeta_' + id).css('display') == 'none'){
		$('#opciones_carpeta_' + id).css('display','inline');
		$('#opciones_carpeta_' + id).html('<br /><input type="text" size="17" id="nombre_' + id + '" value="' + lang['Cambiar nombre'] + '" onfocus="mensajes_sifoco(this);" onBlur="mensajes_nofoco(this);" /> <input class="button" type="submit" value="' + lang['Cambiar'] + '" title="' + lang['Cambiar nombre de carpeta'] + '" onclick="mensajes_cambiar_nombre_carpeta(\'' + id + '\',\'' + key + '\',el(\'nombre_' + id + '\').value);return false;" /><input style="margin-top:5px;" class="button" type="submit" value="' + lang['Eliminar carpeta'] + '" title="' + lang['Eliminar carpeta'] + '" onclick="mensajes_eliminar_carpeta(\'' + id + '\',\'' + key + '\');return false;" />');
	}else
		$('#opciones_carpeta_' + id).css('display','none');
}

function mensajes_sifoco(o){
	if(o.value==lang['Cambiar nombre'])
		o.value='';
}

function mensajes_nofoco(o){
	if(o.value=='')
	o.value=lang['Cambiar nombre'];
}

function mensajes_cambiar_nombre_carpeta(id,key,nombre){
  location.href='/mensajes-cambiar-nombre-carpetar.php?id=' + id + '&key=' + key + '&carpeta=' + nombre;
  return;
}

function mensajes_eliminar_carpeta(id,key){
	if(confirm(lang['mp realmente eliminar carpeta']))
		location.href='/mensajes-carpeta-eliminar.php?id=' + id + '&key=' + key;
	return;
}