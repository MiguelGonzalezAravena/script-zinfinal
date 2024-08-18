<?php
if (!defined('ZinFinal'))
	die('Intentado de Hack');

function UsuariosMain() {
	
	$subSeccion = array(
	    'info' => 'info',
	    'suspender' => 'suspender',
	    'desuspender' => 'desuspender'
	);
	
	if (!empty($subSeccion[@$_GET['ss']])) {
		$subSeccion[$_GET['ss']]();
	} else {
		Main();
	}
}

function Main() {
	echo '<form action="" method="post" style="text-align:center;">
	<label for="iduser">Id del usuario:</label>
	<input type="text" name="iduser" id="iduser" tabindex="1" />
	<br />
	<label for="id">Nick del usuario:</label>
	<input type="text" name="nick" id="nick" tabindex="2"/>
	<br /><br />
	<input type="submit" class="login" value="Buscar" name="buscar" tabindex="3"/>
	</form>';
	
	if($_POST['buscar']) {
		$iduser = (int) $_POST["iduser"];
		$nick = no_injection($_POST["nick"]);
		
		$dbusers = mysql_query("SELECT id,activacion,ban,nick,mail,ultimaaccion FROM usuarios WHERE id = '{$iduser}' or nick = '{$nick}' ");
		$nun_users = mysql_num_rows($dbusers);
		$userz = mysql_fetch_array($dbusers);
		mysql_free_result($dbusers);
		
		if($nun_users) {
			echo '<hr>
		<form action="/" method="post" style="text-align:center;">
		<span><a href="/panel/mod/usuarios/info/'.$userz['id'].'/" style="color:blue;">Ver Informaci&oacute;n Detallada</a> (New!)</span>
		<br />
		<p>id: '.$userz['id'].'</p>
		<p>nick: '.$userz['nick'].'</p>
		<p>email: '.$userz['mail'].'</p>
		<p>status:';
		
			if ($userz['activacion']=='0') {
				echo ' Sin Activacion';
			} elseif ($userz['ban']) {
				echo ' Suspendido';
			} else {
				echo ' Activo';
			}
			echo '</p>
			<p>score: </p>
			<p>&uacute;ltimo acceso: '.$userz['ultimaaccion'].'</p>
			<input type="hidden" name="iduser" value="'.$userz['id'].'">
			</form>';
			
		    if($userz['ban']) {
		        echo '<center><input type="button" onclick="location.href=\'/panel/mod/usuarios/desuspender/'.$iduser.'/\'" value="Desuspender" class="login">';
		    } else {
		        echo '<center><input type="button" onclick="location.href=\'/panel/mod/usuarios/suspender/'.$iduser.'/\'" value="Suspender" class="login">';
		    }
		
		} else {
			echo 'No Existe el usuario';
		}
	}
	
}

function info() {
	global $images;
	$iduser = (int) $_GET["dato"];
	
	$dbusers = mysql_query("SELECT u.*,r.nom_rango 
	FROM usuarios as u 
	LEFT JOIN rangos as r ON r.id_rango = u.rango 
	WHERE id = '{$iduser}'");
	
	$nun_users = mysql_num_rows($dbusers);
	$userz = mysql_fetch_array($dbusers);
	mysql_free_result($dbusers);
	
	if($nun_users) {
		echo '<center>
	<table align="center" valign="top" width="250" cellpadding="2">
	<caption>Informacion sobre <strong>'.$userz['nick'].'</strong> (ver perfil)</caption>
	<tr>
	<td>id:</td>
	<td>'.$userz['id'].'</td>
	</tr>
	
	<tr>
	<td>Rango:</td>
	<td>'.$userz['nom_rango'].'</td>
	</tr>
	
	<tr>
	<td>Nombre:</td>
	<td>'.$userz['nombre'].'</td>
	</tr>
	
	<tr>
	<td>Sexo:</td>
	<td>'.$userz['sexo'].'</td>
	</tr>
	
	<tr>
	<td>Email:</td>
	<td>'.$userz['mail'].'</td>
	</tr>
		
	<tr>
	<td>Nacionalidad:</td>
	<td>'.$userz['pais'].'</td>
	</tr>
	
	<tr>
	<td>Ciudad:</td>
	<td>'.$userz['ciudad'].'</td>
	</tr>
	
	<tr>
	<td>Fecha Creado:</td>
	<td>'.$userz['fecha'].'</td>
	</tr>
	
	<tr>
	<td>Sitio:</td>
	<td>'.$userz[''].'</td>
	</tr>
	
	<tr>
	<td>Avatar:</td>
	<td>'.$userz['avatar'].'</td>
	</tr>
	
	<tr>
	<td>Puntos Recibidos:</td>
	<td>'.$userz['puntos'].'</td>
	</tr>
	
	<tr>
	<td>Estado:</td>
	<td>';
	
	if ($userz['activacion']=='0') {
		echo 'Sin Activacion';
	} elseif ($userz['ban']) {
		echo 'Suspendido';
	} else {
		echo 'Activo';
	}
		echo '
	</td>
	</tr>
	
	</table>';
	
	$dbpuntos = mysql_query("SELECT pu.*,u.nick 
	FROM puntos as pu 
	LEFT JOIN usuarios as u ON u.id = pu.id_receptor 
	WHERE pu.id_emisor = '{$iduser}' ");
	
	$nun_votantes = mysql_num_rows($dbpuntos);
	    echo'	
	<br />
	
	<table cellpadding="2">
	<caption>Usuarios Votados</caption>
	
	<tr>
	<th>Nick</th>
	<th>Cantidad de Votos</th>
	</tr>';
	
	if($nun_votantes) {
		while($puntoz = mysql_fetch_array($dbpuntos)) {
	        echo '<tr>
	        <td>'.$puntoz['nick'].'</td>
	        <td>'.$puntoz['puntos'].'</td>
	        </tr>';
	    }
	    
	    mysql_free_result($dbpuntos);
	} else {
		echo '<tr><td>No tiene</td></tr>';
	}

	    echo'

	</table>';
	
	} else {
		echo 'No Existe el Usuario';
	}
	
	if($userz['ban']) {
		echo '<center><input type="button" onclick="location.href=\'/panel/mod/usuarios/desuspender/'.$iduser.'/\'" value="Desuspender" class="login">';
	} else {
		echo '<center><input type="button" onclick="location.href=\'/panel/mod/usuarios/suspender/'.$iduser.'/\'" value="Suspender" class="login">';
	}
}

function suspender() {
	global $images,$user;
	
	$iduser = (int) $_GET["dato"];
	$iduserp = (int) $_POST["iduser"];
	$causa = no_injection($_POST["causa"]);
	$tiempo = no_injection($_POST["tiempo"]);
	
	if($_POST['suspender']) {
		
		if(empty($iduserp) or empty($causa)) {
			fatal_error('Error al Suspender','Faltan Datos');
		}
		
		$id_zinfinal = md5(uniqid(rand(), true));
		$dbban = mysql_query("SELECT nick,ban FROM usuarios WHERE id = '{$iduserp}'");
		$data = mysql_fetch_array($dbban);
		mysql_free_result($dbban);
		
		if ($data["nick"]==null) {
			fatal_error('Error al Suspender','El ID del Usuario no Existe');
		}

		if($data["ban"]=='1') {
			fatal_error('Error al Suspender','Este Usuario ya se Encuentra Suspendido');
		}
		
		mysql_query("UPDATE usuarios SET ban = '1',id_zinfinal = '$id_zinfinal' WHERE id='{$iduserp}'");
		mysql_query("INSERT INTO suspendidos (idsu,nicksu,nickmod,causa,fecha,duracion,accion) VALUES ('$iduserp','{$data["nick"]}','$user','$causa',NOW(),'$tiempo','0')");
		mysql_insert_id();
		fatal_error('Suspencion Completada','El Usuario ha sido Suspendido Exit&oacute;samente');
	}
	
	echo '<form action="/panel/mod/usuarios/suspender/" method="POST">
	<b>ID:</b><br />
	<input type="text" name="iduser" value="'.$iduser.'" id="iduser"><br />
	<b>Causa:</b><br />
	<textarea name="causa" id="causa" rows="2" cols="17"></textarea><br />
	<b>Tiempo:</b><br />(En Dias, 0 = Indefinido)<br />
	<input type="text" name="tiempo" id="tiempo">
	<br />
	<br />
	<input type="submit" value="Suspender" name="suspender" class="login">
	</form>
';
}

function desuspender() {
	global $images,$user;
	
	$iduser = (int) $_GET["dato"];
	
	$iduserp = (int) $_POST["iduser"];
	$causa = no_injection($_POST["causa"]);
	
	if($_POST['desuspender']) {
		
		if(empty($iduserp) or empty($causa)) {
			fatal_error('Error al Desuspender','Faltan Datos');
		}
		
		$dbban = mysql_query("SELECT nick,ban FROM usuarios WHERE id = '{$iduserp}'");
		$data = mysql_fetch_array($dbban);
		mysql_free_result($dbban);
		
		if ($data["nick"]==null) {
			fatal_error('Error al Desuspender','El ID del Usuario no Existe');
		}

		if($data["ban"]=='0') {
			fatal_error('Error al Desuspender','Este Usuario no se Encuentra Suspendido');
		}
		
		mysql_query("UPDATE usuarios SET ban = '0' WHERE id='{$iduserp}'");
		mysql_query("INSERT INTO suspendidos (idsu,nicksu,nickmod,causa,fecha,accion) VALUES ('$iduserp','{$data["nick"]}','$user','$causa',NOW(),'1')");
		mysql_insert_id();
		fatal_error('Desuspencion Completada','El Usuario ha sido Desuspendido Exit&oacute;samente');
	}
	
	echo '<form action="/panel/mod/usuarios/desuspender/" method="POST">
	<b>ID:</b><br />
	<input type="text" name="iduser" value="'.$iduser.'" id="iduser"><br />
	<b>Causa:</b><br />
	<textarea name="causa" id="causa" rows="2" cols="17"></textarea>
	<br />
	<br />
	<input type="submit" value="Desuspender" name="desuspender" class="login">
	</form>
';
}
?>