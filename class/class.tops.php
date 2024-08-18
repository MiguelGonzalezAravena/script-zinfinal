<?php

class tops {
	
	public $categoria;
	public $periodo;
	
	public function __construct($periodo,$categoria) {
		$this->fecha = array('-1' => '','1' => '','2' => '','3' => '','4' => '','5' => '');
		$this->periodo = $this->fecha[$periodo];
		$this->categoria = $categoria;
	}
	
	public function posts($campo) {
		
		unset($this->top);
		
		$db_top = mysql_query("SELECT p.postid, p.titulo, p.{$campo}, p.creado, c.link_categoria 
		FROM (posts AS p, categorias AS c) 
		WHERE p.categoria = c.id_categoria AND p.estado = 0 
		".($this->categoria ? "AND p.categoria = '{$this->categoria}' " : '')."
		ORDER BY p.{$campo} DESC LIMIT 15");
		
		$this->hay = mysql_num_rows($db_top);
		
		while($top = mysql_fetch_array($db_top))
		    $this->top['posts'][] = array('li' => '<li class="categoriaPost clearfix '.$top['link_categoria'].'">
<a href="/posts/'.$top['link_categoria'].'/'.$top['postid'].'/'.corregir($top['titulo']).'.html">'.$top['titulo'].'</a>
<span>'.$top[$campo].'</span>
</li>');
		
		mysql_free_result($db_top);
		
	}
	
	public function comunidades($campo) {
		
		unset($this->top);
		
		$db_top = mysql_query("SELECT co.nombre, co.shortname, co.{$campo}, ca.link_categoria 
		FROM (c_comunidades AS co, c_categorias AS ca) 
		WHERE co.categoria = ca.id_categoria AND co.estado = 0 
		".($this->categoria ? "AND co.categoria = '{$this->categoria}' " : '')."
		ORDER BY co.{$campo} DESC LIMIT 15");
		
		$this->hay = mysql_num_rows($db_top);
		
		while($top = mysql_fetch_array($db_top))
		    $this->top['comunidades'][] = array('li' => '<li class="categoriaCom clearfix '.$top['link_categoria'].'">
<a class="titletema" title="'.$top['nombre'].'" href="/comunidades/'.$top['shortname'].'/">'.$top['nombre'].'</a>
<span>'.$top[$campo].'</span>
</li>');
		
		mysql_free_result($db_top);
		
	}
	
	public function temas($campo) {
		
		unset($this->top);
		
		$db_top = mysql_query("SELECT t.temaid, t.titulo, t.{$campo} , co.shortname, ca.link_categoria 
		FROM (c_temas as t, c_comunidades as co, c_categorias as ca) 
		WHERE t.comid = co.comid and co.categoria = ca.id_categoria AND co.estado = 0 AND t.estado = 0 
		".($this->categoria ? "AND co.categoria = '{$this->categoria}' " : '')."
		ORDER BY t.{$campo} DESC LIMIT 15");
		
		$this->hay = mysql_num_rows($db_top);
		
		while($top = mysql_fetch_array($db_top))
		    $this->top['temas'][] = array('li' => '<li class="categoriaCom clearfix '.$top['link_categoria'].'">
<a class="titletema" title="'.$top['titulo'].'" href="/comunidades/'.$top['shortname'].'/'.$top['temaid'].'/'.corregir($top['titulo']).'.html">'.$top['titulo'].'</a>
<span>'.$top[$campo].'</span>
</li>');
		
		mysql_free_result($db_top);
		
	}
	
	public function usuarios($campo) {
		
		unset($this->top);
		
		$db_top = mysql_query("SELECT nick, avatar, {$campo} FROM usuarios WHERE estado = 1 ORDER BY {$campo} DESC LIMIT 15");
		
		$this->hay = mysql_num_rows($db_top);
		
		while($top = mysql_fetch_array($db_top))
		    $this->top['usuarios'][] = array('li' => '<li class="categoriaUsuario clearfix">
		    <img src="'.$top['avatar'].'" width="16" height="16" />
		    <a href="/perfil/'.$top['nick'].'">'.$top['nick'].'</a>
		    <span>'.$top[$campo].'</span>
		    </li>');
		
		mysql_free_result($db_top);
		
	}
	
	public function nada() {
		echo '<div class="emptyData">Nada por aqui</div>';
	}
	
}

?>