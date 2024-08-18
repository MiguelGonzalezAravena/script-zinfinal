<?php

class seguidores {
	public $key;
	public $type;
	public $obj;
	
	public $count;
	public $seguidores = array();
	
	public $x_full = array();
	public $x_mini = array();
	public $db_consulta;
	public $notificaciones;
	public $array_n = array();
	
	function __construct($key) {
		$this->key = $key;
	}
	
	public function db_seguidores($type,$obj) {
		
		$this->type = $type;
		$this->obj = $obj;
		
		$dbseguidores = mysql_query("SELECT * FROM seguidores WHERE userid = '{$this->key}' AND type = '{$this->type}' ".($this->obj == null ? "" : "AND obj = '{$this->obj}'")." ");
		$this->count = mysql_num_rows($dbseguidores);
		
		while($seg = mysql_fetch_array($dbseguidores))
		    $this->seguidores['seguidores'][] = array('segid' => $seg['segid'],'userid' => $seg['userid'],'type' => $seg['type'],'obj' => $seg['obj']);
        
        mysql_free_result($dbseguidores);
        
	}
	
	public function follow() {
		$followid = array('user' => '19','post' => '1','' => '');
		$followid = $followid[$this->type];
		
		if ($this->count) {
			return '2-'.$this->obj.'-'.$followid.'';
		}
		
		mysql_query("INSERT INTO seguidores (userid,type,obj,time) VALUES ('{$this->key}','{$this->type}','{$this->obj}',unix_timestamp())");
		mysql_insert_id();
		
		$this->db_seguidores($this->type);
		$this->notificar("friend-new");
		
		return '0-'.$this->obj.'-'.$followid.'';
	}
	
	public function unfollow() {
		$unfollowid = array('user' => '18','post' => '0','' => '');
		$unfollowid = $unfollowid[$this->type];
		
		if (!$this->count) {
			return '0';
		}
		
		mysql_query("DELETE FROM seguidores WHERE obj = '{$this->obj}' AND userid = '{$this->key}' AND type = '{$this->type}'");
		return '0-'.$this->obj.'-'.$unfollowid.'';
	}
	
	public function notificar($x) {
		
		foreach ($this->seguidores['seguidores'] as $key => $value) {
			mysql_query("INSERT INTO notificaciones (userid,x,".$value['type'].",cantidad,leido,enviado,type) VALUES ('{$value['obj']}','{$x}','{$value['obj']}','1','1',unix_timestamp(),'ff')");
			mysql_insert_id();
		}
		
	}
	
	/* Notificaciones Personales */
	
	public function db_notificaciones() {
		$this->db_consulta = mysql_query("
		SELECT *, p.titulo 
		FROM notificaciones as n 
		LEFT JOIN usuarios as u ON u.userid = n.user 
		LEFT JOIN posts as p ON p.postid = n.post 
		LEFT JOIN c_temas as t ON t.temaid = n.tema 
		LEFT JOIN categorias as ca ON ca.id_categoria = p.categoria 
		WHERE n.userid = '{$this->key}' ");
		
		$this->notificaciones = mysql_num_rows($this->db_consulta);
	}
	
	public function x_full() {
		while($noti = mysql_fetch_array($this->db_consulta)) {
			$this->array_n['full'][] = array('idno' => $noti['idno'],'x' => $noti['x'],'user' => $noti['user'],'post' => $noti['post'],'tema' => $noti['tema'],'cantidad' => $noti['cantidad'],'leido' => $noti['leido'],'enviado' => $noti['enviado'],'nick' => $noti['nick'],'avatar' => $noti['avatar']);
			
			$this->x_full['post-favorite'][$noti['idno']] = array('full' => '');
			$this->x_full['post-comment-own'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-balloon-left"></span>coment&oacute; en tu post <a href="/posts/'.$noti['link_categoria'].'/'.$noti['post'].'/'.corregir($noti['titulo']).'.html">'.$noti['titulo'].'</a></span>');
			$this->x_full['post-points'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-point"></span>dej&oacute; 1 punto en tu post <a href="/posts/'.$noti['link_categoria'].'/'.$noti['post'].'/'.corregir($noti['titulo']).'.html">'.$noti['titulo'].'</a></span>');
			$this->x_full['friend-new'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-follow"></span>te est&aacute; siguiendo. <a onclick="notifica.follow(\'user\', '.$noti['user'].', notifica.userInMonitorHandle, this)">Seguir a este usuario</a></span>');
			$this->x_full['friend-post'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-document-tex_fullt-image"></span>cre&oacute; un nuevo post <a href="/posts/'.$noti['link_categoria'].'/'.$noti['post'].'/'.corregir($noti['titulo']).'.html">'.$noti['titulo'].'</a></span>');
			$this->x_full['friend-thread'][$noti['idno']] = array('full' => '');
			$this->x_full['post-comment'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-balloon-left-blue"></span>coment&oacute; en el post <a href="/posts/'.$noti['link_categoria'].'/'.$noti['post'].'/'.corregir($noti['titulo']).'.html">'.$noti['titulo'].'</a></span>');
			$this->x_full['com-thread'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-block"></span>cre&oacute; un nuevo tema <a href="/comunidades/solo-para-fans-de-dbz/503760/Ayudenos-a-crecer-^^.html">Ayudenos a crecer ^^</a> en <a href="/comunidades/solo-para-fans-de-dbz/">La Comunidad De DBZ</a></span>');
			$this->x_full['com-reply'][$noti['idno']] = array('full' => '');
			$this->x_full['post-spam'][$noti['idno']] = array('full' => '<span class="icon-noti sprite-recomendar-p"></span> te recomienda un post <a href="/posts/'.$noti['link_categoria'].'/'.$noti['post'].'/'.corregir($noti['titulo']).'.html">'.$noti['titulo'].'</a></span>');
			$this->x_full['medal'][$noti['idno']] = array('full' => '');
		}
		
		mysql_free_result($this->db_consulta);
	}
	
	public function x_mini() {
		while($noti = mysql_fetch_array($this->db_consulta)) {
			$this->array_n['mini'][] = array('idno' => $noti['idno'],'x' => $noti['x'],'user' => $noti['user'],'post' => $noti['post'],'tema' => $noti['tema'],'cantidad' => $noti['cantidad'],'leido' => $noti['leido'],'enviado' => $noti['enviado'],'nick' => $noti['nick']);
			
			$this->x_mini['post-favorite'][$noti['idno']] = array('mini' => '');
			$this->x_mini['post-comment-own'][$noti['idno']] = array('mini' => '');
			$this->x_mini['post-points'][$noti['idno']] = array('mini' => '');
			$this->x_mini['friend-new'][$noti['idno']] = array('mini' => '<span class="icon-noti sprite-follow"></span><a href="/perfil/'.$noti['nick'].'" class="obj">'.$noti['nick'].'</a> te esta siguiendo');
			$this->x_mini['friend-post'][$noti['idno']] = array('mini' => '');
			$this->x_mini['friend-thread'][$noti['idno']] = array('mini' => '');
			$this->x_mini['post-comment'][$noti['idno']] = array('mini' => '');
			$this->x_mini['com-thread'][$noti['idno']] = array('mini' => '');
			$this->x_mini['com-reply'][$noti['idno']] = array('mini' => '');
			$this->x_mini['post-spam'][$noti['idno']] = array('mini' => '');
			$this->x_mini['medal'][$noti['idno']] = array('mini' => '');
		}
		
		mysql_free_result($this->db_consulta);
	}
}

?>