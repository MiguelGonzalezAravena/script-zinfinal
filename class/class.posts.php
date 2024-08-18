<?php

class post {
	public $postid;
	public $post;
	
	function __construct($postid) {
		$this->postid = $postid;
		
		$dbpost = mysql_query("
		SELECT p.*,u.id,u.rango,u.nick,u.puntos,u.avatar,u.pais,u.sexo,u.numposts,u.numcomentarios,u.bloqueados,u.seguidores_u,r.*,ca.*,pa.nombre_pais,pa.img_pais 
		FROM posts p 
		LEFT JOIN usuarios u ON u.id=p.id_autor 
		LEFT JOIN rangos r ON r.id_rango=u.rango 
		LEFT JOIN categorias ca ON ca.id_categoria=p.categoria 
		LEFT JOIN paises pa ON pa.img_pais = u.pais 
		WHERE p.postid = '{$this->postid}' LIMIT 1");
		
		$this->existe = mysql_num_rows($dbpost);
		$this->post = mysql_fetch_array($dbpost);
		mysql_free_result($dbpost);
	}
	
	public function relacionados($rand = false) {
		
		$dbrelacionados = mysql_query("SELECT DISTINCT p.postid,p.titulo,c.link_categoria 
		FROM posts p 
		LEFT JOIN categorias c ON p.categoria = c.id_categoria 
		".($rand ? '' : "WHERE MATCH p.tags	AGAINST ('{$this->post['tags']}')")." 
		ORDER BY p.tags DESC LIMIT 10");
		
		while($r = mysql_fetch_array($dbrelacionados))
		    $this->post['relacionados'][] = array('postid' => $r['postid'],'titulo' => $r['titulo'],'link' => $r['link_categoria']);
		
		mysql_free_result($dbrelacionados);
	}
}

?>