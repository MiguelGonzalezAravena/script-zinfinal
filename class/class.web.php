<?php

class web_zinfinal {
	public $key;
	public $global_config;
	public $global_user;
	public $ip;
	
	function __construct() {
		
		$dbconfig = mysql_query("SELECT * FROM configuracion");
		while ($row = mysql_fetch_row($dbconfig))
		    $this->global_config[$row[0]] = $row[1];
		
		mysql_free_result($dbconfig);
		$this->ip = ($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		
		if (get_magic_quotes_gpc()) {
			foreach ($_POST as $a => $b)
			    $_POST[$a] = stripslashes($b);
			
			foreach ($_GET as $a => $b)
			    $_GET[$a] = stripslashes($b);
		}
		
		$this->REQUEST_URI = explode("/",$_SERVER['REQUEST_URI']);
		
		if ($this->REQUEST_URI[1] == 'comunidades')
		    $this->menu = array('comunidades' => 'Comunidades');
		elseif ($this->REQUEST_URI[1] == 'top')
		    $this->menu = array('top' => 'Tops');
		else
		    $this->menu = array('' => 'Posts');
		
	}
	
	public function cargar_usuario($key) {
		$this->key = $key;
		
		if (!empty($this->key)) {
			
			$dbuser = mysql_query("SELECT u.* , r.permisos, COUNT(leido_receptor) as sms 
			FROM usuarios as u 
			LEFT JOIN mensajes as m ON m.id_receptor = u.userid and m.leido_receptor = '0'
			LEFT JOIN rangos as r ON r.rango = u.rango 
			WHERE u.userid = '1' GROUP BY u.userid");
			
			$this->global_user = mysql_fetch_array($dbuser);
			mysql_free_result($dbuser);
			
			$this->usuario_opciones = explode(',',$this->global_user['opciones']);
			$this->usuario_bloqueados = unserialize($this->global_user['bloqueados']);
			$this->usuario_grupo_perm = unserialize($this->global_user['permisos']);
			
			if ($this->global_user['estado'] != '1' or $this->global_user['id_zinfinal'] != $_SESSION['id_zinfinal'])
				$this->logout();
			
		}
		
	}
	
	public function cabecera() {
		$dbcategorias = mysql_query("SELECT * FROM categorias ORDER BY nom_categoria ASC");
		while($cate = mysql_fetch_array($dbcategorias))
		    $this->categorias['posts'][] = array('id' => $cate['id_categoria'],'nombre' => $cate['nom_categoria'],'link' => $cate['link_categoria'],'restringido' => $cate['restringido'],'rango' => $cate['rango']);
		
		mysql_free_result($dbcategorias);
		
		$dbcategorias_c = mysql_query("SELECT * FROM c_categorias ORDER BY nom_categoria ASC");
		while($cate = mysql_fetch_array($dbcategorias_c))
		    $this->categorias['comunidades'][] = array('id' => $cate['id_categoria'],'nombre' => $cate['nom_categoria'],'link' => $cate['link_categoria'],'restringido' => $cate['restringido'],'rango' => $cate['rango']);
		
		mysql_free_result($dbcategorias_c);
	}
	
	public function session() {
		/*Cada 8 Segundos*/
		if (!empty($_SESSION['log_time']) && $_SESSION['log_time'] >= (time() - 8))
		    return;
		
		$session_id = $this->key != null ? 'ip' . $this->global_user['ultimaip'] : session_id();
		
		if(isset($_COOKIE['id_zinfinal'])) {
			$cookie = mysql_real_escape_string($_COOKIE['id_zinfinal']);
			$cookie = explode("%",$cookie);
			$cookie_user = $cookie[0];
			$cookie_id = $cookie[1];
			$cookie_ip = $cookie[2];
			
			if ($this->ip == $cookie_ip && $this->global_user['nick'] == $cookie_user) {
				$_SESSION['user'] = $this->global_user['nick'];
				$_SESSION['id'] = $this->global_user['userid'];
				$_SESSION['id_zinfinal'] = $this->global_user['id_zinfinal'];
			}
		}
		
		$_SESSION['log_time'] = time();
		
	}
	
	public function logout() {
		setcookie("id_zinfinal","x",time()-3600,"/");
		$_SESSION['user'] = null;
		$_SESSION['id'] = null;
		$_SESSION['id_zinfinal'] = null;
		unset($_SESSION);
		session_destroy();
		
	}
		
	public function ultimos_post($categoria) {
		$db = "SELECT p.postid,p.titulo,c.id_categoria,c.link_categoria FROM (posts as p, categorias AS c) WHERE p.categoria = c.id_categoria";
		
		$this->paginacion($db,'20');
		
		while($p = mysql_fetch_array($this->db_paginacion))
		    $this->ultimos['post'][] = array('postid' => $p['postid'],'titulo' => $p['titulo'],'catid' => $p['id_categoria'],'link' => $p['link_categoria']);
		
		mysql_free_result($this->db_paginacion);
		
	}
	
	public function top_post($tipo,$hist = true) {
		
		unset($this->top['post']);
		
		$dbtop = mysql_query("SELECT p.postid,p.titulo,p.puntos,ca.link_categoria 
		FROM posts p 
		LEFT JOIN categorias ca ON ca.id_categoria = p.categoria 
		".($hist ? '' : "WHERE p.creado BETWEEN '$tipo' AND unix_timestamp() ")."
		ORDER BY p.puntos DESC LIMIT 15");
		
		while($top = mysql_fetch_array($dbtop))
		    $this->top['post'][] = array('postid' => $top['postid'],'titulo' => $top['titulo'],'puntos' => $top['puntos'],'link' => $top['link_categoria']);
		
		mysql_free_result($dbtop);
	}
	
	public function top_usuarios($tipo,$hist = true) {
		
		unset($this->top['user']);
		
		$dbtop = mysql_query("SELECT userid,nick,puntos 
		FROM usuarios 
		".($hist ? '' : "WHERE ultimaaccion BETWEEN '$tipo' AND unix_timestamp() ")."
		ORDER BY puntos DESC LIMIT 15");
		
		while($top = mysql_fetch_array($dbtop))
		    $this->top['user'][] = array('id' => $top['userid'],'nick' => $top['nick'],'puntos' => $top['puntos']);
		
		mysql_free_result($dbtop);
		
	}
	
	public function paginacion($sentencia,$limite) {
		
		if (empty($sentencia))
		    die("Erro: Falta la sentencia MySQL");
		
		$this->sentencia = $sentencia;
		$this->limite = $limite;
		
		if (isset($_GET['pagina']))
		    $this->pagina = (int)$_GET['pagina'];
		else
		    $this->pagina = 1;
		
		$this->db_pag = mysql_query($this->sentencia);
		$this->numero = mysql_num_rows($this->db_pag);
		$this->ultima_pagina = ceil($this->numero  / $this->limite);
		
		if ($this->pagina  > $this->ultima_pagina)
		    $this->pagina  = $this->ultima_pagina;
		
		if ($this->pagina < 1)
		    $this->pagina  = 1;
		
		$this->hasta = ' LIMIT '. ($this->pagina -1) *  $this->limite . ',' .$this->limite;
		$this->sentencia .= $this->hasta;
		
		$this->db_paginacion = mysql_query($this->sentencia);
		
		$this->siguiente = $this->pagina + 1;
		$this->atras = $this->pagina - 1;
		
	}
		
	public function ultimos_comentarios($cat) {
		if ($cat = '-1')
		    $entonces = "";
		if ($cat = '11')
		    $entonces = "";
		else
		    $entonces = "";
		
		$dbcoment = mysql_query("SELECT u.nick,p.postid,p.titulo,cat.link_categoria 
		FROM comentarios c 
		LEFT JOIN usuarios as u ON u.userid = c.userid
		LEFT JOIN posts as p ON p.postid = c.postid 
		LEFT JOIN categorias as cat on cat.id_categoria = p.categoria 
		WHERE p.estado = '0' and u.estado = '1' ORDER BY c.guardado DESC LIMIT 15");
		
		while($c = mysql_fetch_array($dbcoment))
		    $this->ultimos['comentarios'][] = array('postid' => $c['postid'],'nick' => $c['nick'],'titulo' => $c['titulo'],'link' => $c['link_categoria']);
		
		mysql_free_result($dbcoment);
		
	}
	
	public function fatal_error($mensaje,$value='Ir a p&aacute;gina principal',$onclick='location.href=\'/\'',$titulo='CHAN!!') {
		echo '<div class="container400" style="margin: 10px auto 0 auto;">
<div class="box_title">
<div class="box_txt show_error">'.$titulo.'</div>
<div class="box_rrs"><div class="box_rss"></div></div>
</div>
<div class="box_cuerpo"  align="center">
<br />'.$mensaje.'<br />
<br />
<br />
<input type="button" class="mBtn btnOk" style="font-size:13px" value="'.$value.'" title="'.$value.'" onclick="'.$onclick.'">
<br /></div></div><br /><br /><br /><br />';
		pie();
		exit;
	}
}
?>