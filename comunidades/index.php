<?php
include("../header.php");

class comunidades {
	
	public $seccion;
	public $key;
	public $comid;
	public $temaid;
	
	public $shortname;
	
	public $rango;
	public $main;
	public $main_n;
	
	function __construct($seccion,$key,$comid,$temaid) {
		$this->seccion = $seccion;
		$this->key = $key;
		$this->comid = $comid;
		$this->temaid = $temaid;
		
		$this->shortname = $_GET['shortname'];
	}
	
	public function seccion() {
		
	}
	
	public function Main() {
		
        /*Ultimos Temas*/
        $categoria = $_GET['categoria'];
        $limit_posts = 20;
        
        if($categoria == '') {
            $cat_condition = "";
        } else {
            $cat_condition = "AND ca.link_categoria = '{$categoria}'";
        }
        
        if($categoria == ''){
            $request = mysql_query("SELECT * FROM c_temas");
            $NroRegistros = mysql_num_rows($request);
        } else {
            $request = mysql_query("SELECT t.*,co.*,ca.* 
            FROM c_temas t 
            LEFT JOIN c_comunidades co ON co.comid = t.comid 
            LEFT JOIN c_categorias ca ON ca.id_categoria = co.categoria 
            WHERE 1=1 {$cat_condition}");
            
            $NroRegistros = mysql_num_rows($request);
        }
        
        if(isset($_GET['pagina'])) {
            $RegistrosAEmpezar=($_GET['pagina']-1)*$limit_posts;
            $PagAct=$_GET['pagina'];
        } else {
            $RegistrosAEmpezar=0;
            $PagAct=1;
        }
        
        $PagAnt = $PagAct-1;
        $PagSig = $PagAct+1;
        $PagUlt = $NroRegistros/$limit_posts;
        $Res = $NroRegistros%$limit_posts;
        
        if ($Res > 0) {
            $PagUlt = floor($PagUlt)+1;
        }
        
        $this->db_temas = mysql_query("
        SELECT t.*,co.*,us.nick,ca.* 
        FROM c_temas t 
        LEFT JOIN c_comunidades co ON co.comid = t.comid 
        LEFT JOIN usuarios us ON us.userid = t.userid 
        LEFT JOIN c_categorias ca ON ca.id_categoria = co.categoria 
        WHERE 1=1 {$cat_condition} ORDER BY t.temaid DESC LIMIT $RegistrosAEmpezar, $limit_posts");
        

	}
	
	public function breadcrump() {
		global $images;
		
		$arbol = array('editar-tema' => '<a href="/comunidades/'.$this->comunidad['shortname'].'/'.$this->tema['temaid'].'/'.corregir($this->tema['titulo']).'.html" title="'.$this->tema['titulo'].'">'.$this->tema['titulo'].'</a></li><li>Editar tema','editar' => 'Editar comunidad','agregar' => 'Agregar tema','miembros' => 'Miembros');
		
		echo '
<div class="comunidades">

<div class="breadcrump">
<ul>
<li class="first"><a href="/comunidades/" title="Comunidades">Comunidades</a></li><li><a href="/comunidades/home/'.$this->comunidad['link_categoria'].'/" title="'.$this->comunidad['nom_categoria'].'">'.$this->comunidad['nom_categoria'].'</a></li><li>'.($_GET['accion'] ? '<a href="/comunidades/'.$this->comunidad['shortname'].'/" title="'.$this->comunidad['nombre'].'">'.$this->comunidad['nombre'].'</a></li><li>'.($_GET['accion'] ? $arbol[$_GET['accion']] : $this->tema['titulo']).'' : $this->comunidad['nombre']).'</li><li class="last"></li>
</ul>
</div>

<div class="denunciar"><a href="javascript:com.denuncia_publica()" title="">Denunciar</a></div>
	<div style="clear:both"></div>


<div id="izquierda">
<div class="comunidadData '.($this->comunidad['oficial'] ? ' oficial' : '').'">
<div class="box_title">
<div class="box_txt post_autor">Comunidad</div>
<div class="box_rss"></div>
</div>
<div class="box_cuerpo">'.($this->comunidad['oficial'] ? '<img src="'.$images.'/images/riboon_top.png" class="riboon" />' : '').'

	  <div class="avaComunidad">
    <a href="/comunidades/'.$this->comunidad['shortname'].'/">
      <img class="avatar" src="'.$this->comunidad['imagen'].'" alt="Logo de la comunidad" title="Logo de la comunidad" onerror="com.error_logo(this)" />
    </a>
  </div>
<h2><a href="/comunidades/'.$this->comunidad['shortname'].'/">'.$this->comunidad['nombre'].'</a></h2>

<hr class="divider" />
<ul>
  <li><a href="/comunidades/'.$this->comunidad['shortname'].'/miembros/"><span id="cont_miembros">120</span> Miembros</a></li>

  <li>178 Temas</li>
  <li class="comunidad_seguidores">19 Seguidores</li>
</ul>

'.($this->miembro ? '<hr class="divider" />Mi rango: <b>'.rangocomunidad($this->comunidad['rangoco']).'</b>' : '').'

<hr class="divider" />
<div class="buttons">
	'.($this->miembro ? '<input id="a_susc" class="mBtn btnCancel" onclick="com.miembro_del()" value="Dejar Comunidad" type="button" />' : '<input id="a_susc" class="mBtn btnGreen" onclick="com.miembro_add()" value="Participar" type="button" />').'
	<a class="btn_g unfollow_comunidad" style="display: none" onclick="notifica.unfollow(\'comunidad\', 18823, notifica.inComunidadHandle, $(this).children(\'span\'))"><span class="icons unfollow">Dejar de seguir</span></a>
	<a class="btn_g follow_comunidad" onclick="notifica.follow(\'comunidad\', 18823, notifica.inComunidadHandle, $(this).children(\'span\'))"><span class="icons follow">Seguir comunidad</span></a>

</div>

</div>
</div>
';

if ($this->comunidad['rangoco'] == '5') {
	echo '
<br class="spacer" />
<div class="adminOpt">
<div class="box_title">
<div class="box_txt" style="width:142px">Administraci&oacute;n</div>
<div class="box_rss"></div>
</div>
<div class="box_cuerpo">
<ul><li><input type="button" value="Editar comunidad" onclick="location.href=\'/comunidades/'.$this->comunidad['shortname'].'/editar/\'" class="mBtn btnYellow" /></li></ul>
</div>
</div>';
}

echo '
<br class="spacer" />
<div class="ads120-240">
<br / >

<center>
'.publicidad('tar_c_120_',$this->comunidad['link_categoria'],'120','240').'
</center>

</div>
</div>';
		
	}
	
	public function derecha() {
		global $images;
		echo '
</div>

</div>
<div id="derecha">
';
		$this->ultimas_respuestas();
		
		echo '
	<br class="spacer" />

<style>

.avatarList  {
	margin-bottom: 10px;
}

.avatarList li {
	margin: 2px 1px 2px 2px;
}

.avatarList li img {
	float: left;
	border: 1px solid #CCC;
	padding: 1px;
	background: #FFF;
	width: 16px;
	height: 16px;
	display: block;
}

.avatarList li div.userInfo {
	float: left;
	padding: 4px 0 0 5px;
}

.avatarList li div.userInfo span {
	display: block;
	color: #666
}

</style>
	<div class="box_title">
		<div class="box_txt">&Uacute;ltimos Miembros</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>

	<div class="box_cuerpo">
		<ul class="avatarList clearbeta">
	';
	
	foreach ($this->miembros['m'] as $key => $m) {
		echo '<li>
		<a href="/perfil/'.$m['nick'].'/">
			<img src="'.$m['avatar'].'" title="'.$m['nick'].'" onerror="error_avatar(this, 3290143, 16)" />
		</a>
		<div class=userInfo>
			<a href="/perfil/'.$m['nick'].'/">'.$m['nick'].'</a>
		</div>
		<div class="clearBoth"></div>
		</li>';
	}
		
	echo '
	
		</ul>
		<p class="verMas"><a href="/comunidades/'.$this->comunidad['shortname'].'/miembros/">Ver m&aacute;s &raquo;</a></p>
		<div class="clearBoth"></div>
	</div>
</div></div>';
    
	}
	
	public function ultimas_respuestas() {
		
		$this->db_respuestas = mysql_query("
		SELECT te.temaid,te.titulo,co.shortname 
		FROM (c_respuestas as r, c_temas as te, c_comunidades as co) 
		WHERE te.temaid = r.idtemare AND AND co.idco = te.idcomunid 
		ORDER BY r.fechare DESC LIMIT 15");
		
		echo '
	<div class="box_title">
		<div class="box_txt">&Uacute;ltimas respuestas</div>
		<div class="box_rss">
		  <a href="javascript:com.actualizar_respuestas()">
		    <span class="systemicons actualizar"></span>
		  </a>

		</div>
	</div>
	<div class="box_cuerpo" id="ult_resp">
		<ul>';
		
		while($res = mysql_fetch_array($this->db_respuestas)) {
			echo '<li><a href="/comunidades/'.$res['shortname'].'/'.$res['temaid'].'.ultima/'.corregir($res['titulo']).'.html#respuestas-abajo">'.$res['titulo'].'</a></li>';
		}
		
		mysql_free_result($this->db_respuestas);
		
		echo '
		</ul>
	</div>';
	
	}
	
	public function Comunidad() {
		/*INFORMACION*/
		
		$shortname = $_GET['shortname'];
		
		$this->db_comunidad = mysql_query("
		SELECT co.*,ca.*,us.id,us.nick,cm.*,sub.* 
		FROM c_comunidades co 
		LEFT JOIN c_categorias ca ON ca.id_categoria=co.categoria 
		LEFT JOIN usuarios us ON co.creadorid = us.id 
		LEFT JOIN c_miembros cm ON cm.idcomunity = co.idco and cm.iduser = '{$this->key}' and cm.estado = '0' 
		LEFT JOIN c_subscategorias sub ON sub.id_categoria=co.categoria AND sub.id_subcategoria = co.subcategoria 
		WHERE co.shortname = '{$this->shortname}'");
		
		$this->existe = mysql_num_rows($this->db_comunidad);
		
		$this->comunidad = mysql_fetch_array($this->db_comunidad);
		mysql_free_result($this->db_comunidad);
		
		$this->miembro = $this->key!=null and $this->key == $this->comunidad['iduser'] ? true : false;
		
		/*TEMAS IMPORTANTES*/
		
		$this->db_comunidad_ti = mysql_query("
		SELECT te.*,co.shortname,us.nick 
		FROM c_temas te 
		LEFT JOIN c_comunidades co ON co.idco = te.idcomunid 
		LEFT JOIN usuarios us ON us.id = te.id_autor 
		WHERE co.shortname = '{$this->shortname}' and te.importante = 'on' 
		ORDER BY te.fechate DESC");
		
		/*TEMAS*/
		
		$this->db_comunidad_t = mysql_query("
		SELECT te.*,co.shortname,us.id,us.nick 
		FROM c_temas te 
		LEFT JOIN c_comunidades co ON co.idco = te.idcomunid 
		LEFT JOIN usuarios us ON us.id = te.id_autor 
		WHERE co.shortname = '{$this->shortname}' ORDER BY te.fechate DESC");
		
		/*MIEMBROS*/
		
		$this->db_comunidad_m = mysql_query("
		SELECT m.*,us.id,us.nick,us.avatar,us.sexo 
		FROM c_miembros m 
		LEFT JOIN c_comunidades co ON co.idco = m.idcomunity 
		LEFT JOIN usuarios us ON us.id = m.iduser 
		WHERE m.estado = '0' and co.shortname = '{$this->shortname}' 
		LIMIT 10");
		
		while($m = mysql_fetch_array($this->db_comunidad_m))
		$this->miembros['m'][] = array('key' => $m['iduser'],'rangoco' => $m['rangoco'],'fechaco' => $m['fechaco'],'estado' => $m['estado'],'nick' => $m['nick'],'avatar' => $m['avatar'],'sexo' => $m['sexo']);
		
		mysql_free_result($this->db_comunidad_m);
		
	}
	
	public function Tema($temaid) {
		$this->temaid = $temaid;
		
		$this->db_tema = mysql_query("
		SELECT te.*,us.id,us.nick,us.avatar,us.sexo,pa.nombre_pais,pa.img_pais 
		FROM c_temas te 
		LEFT JOIN usuarios us ON us.id = te.id_autor 
		LEFT JOIN paises pa ON pa.img_pais = us.pais 
		WHERE te.temaid = '{$this->temaid}'");
		
		$this->existe_t = mysql_num_rows($this->db_tema);
		
		$this->tema = mysql_fetch_array($this->db_tema);
		mysql_free_result($this->db_tema);
		
	}
	
}

$comunidades = new comunidades('',$key,'1','1');

function Main_template() {
	global $key,$comunidades,$comunidad;
	
	echo '<div class="comunidades">





	<div class="home">
<div id="izquierda">

		<div class="crear_comunidad">
		<div class="box_cuerpo" style="background:#FFFFCC;border:#b5b539 1px solid; -moz-border-radius:7px">
			<h3 style="margin:5px 0">Comunidades</h3>
			<p style="color: #333">'.$comunidad.' te permite crear tu comunidad para que puedas compartir gustos e intereses con los dem&aacute;s.</p>

			<div class="buttons">
				<input id="a_susc" class="mBtn btnYellow" onclick="location.href=\'/comunidades/crear/\'" value="&iexcl;Crea la tuya! &raquo;" type="button" />
			</div>
		</div>
	</div>

		<br class="space">
		'.publicidad('tar_ch_160_','general','160','600').'
		</div>

<div id="centro">
	<div class="box_title">
		<div class="box_txt ultimos_posts">
			&Uacute;ltimos temas 
		</div>
		<div class="box_rss">
			<a href="/rss/comunidades/" title="&Uacute;ltimos Temas"><span class="systemicons sRss" style="position: relative; z-index: 87;"></span></a>
		</div>
	</div>
	<div class="box_cuerpo">

		<ul>';
		
	while($temas = mysql_fetch_array($comunidades->db_temas)) {
		
        echo '<li class="categoriaCom '.$temas['link_categoria'].''.($temas['oficial']=='1' ? ' oficial' : '').'">
				<a href="/comunidades/'.$temas['shortname'].'/'.$temas['temaid'].'/'.corregir($temas['titulo']).'.html" class="titletema" title="'.$temas['nom_categoria'].' | '.$temas['titulo'].'">'.$temas['titulo'].'</a>
				En <a'.($temas['privada']=='2' ? ' class="systemicons cerrada"' : '').' href="/comunidades/'.$temas['shortname'].'/">'.$temas['nombre'].'</a> por <a href="/perfil/'.$temas['nick'].'">'.$temas['nick'].'</a>'.($temas['oficial']=='1' ? '<img src="'.$url.'/images/oficial.png" alt="Comunidad Oficial" title="Comunidad Oficial" class="comOfi">' : '').'
							</li>';
    }
    
    mysql_free_result($comunidades->db_temas);
    
    echo '
			</ul>
		<br clear="left">
		<div class="paginator" align="center">
					<div class="floatR"><a href="/comunidades/pagina.2">Siguiente &raquo;</a></div>
				<div class="clearBoth"></div>
		</div>
	</div>

</div>

<div id="derecha">
	<!-- buscador -->
	<div class="buscador">
		<div class="box_title">
			<span class="box_txt home_buscador">Buscador</span><span class="box_rss"></span>
		</div>
		<div class="box_cuerpo">
			<img class="leftIbuscador" src="'.$images.'/images/InputSleft_2.gif" />

			<form style="padding:0;margin:0" name="buscador_home" method="GET" action="/comunidades/buscador-comunidades.php" onsubmit="return com.buscador_home()">
				<input type="text" name="q" class="ibuscador onblur_effect" onfocus="onfocus_input(this)" onblur="onblur_input(this)" value="Buscar" title="Buscar" />
				<input type="submit" title="Buscar" value="" class="bbuscador" alt="Buscar" />
			</form>
			<div style="margin: 5px 5px 0pt 0pt; color: rgb(135, 135, 135); font-weight: bold;">
				<span class="floatL">Buscar en:</span>
				<div class="floatR buscarEn">
					<input type="radio" value="comunidades" onchange="com.buscador_home_radio(this.value)" name="buscar_en" id="buscar_en_comunidades" class="radio" checked="checked" />

					<label for="buscar_en_comunidades">Comunidades</label> 
					<input type="radio" value="temas" onchange="com.buscador_home_radio(this.value)" name="buscar_en" id="buscar_en_temas" class="radio" />
					<label for="buscar_en_temas">Temas</label> 
				</div>
				<div style="clear: both;"/></div>
			</div>
		</div>
	</div>
	<br class="space">

	<div class="ult_respuestas">
		<div class="box_title">
			<div class="box_txt ultimos_comentarios">&Uacute;ltimas respuestas</div>
			<div class="box_rss">
				<a href="javascript:com.actualizar_respuestas()">
					<span class="systemicons actualizar"></span>
				</a>
			</div>

		</div>
		<div class="box_cuerpo" id="ult_resp">
			<ul>
						<li><strong>Strange19_Audion</strong> <a href="/comunidades/ps2games/543115.ultima/[Bar-XXIX]-Cool.html#respuestas-abajo" class="size10">[Bar XXIX] Cool</a></li>
						<li><strong>motorologo2</strong> <a href="/comunidades/sofwarevario/532231.ultima/Alemania-Se-LLevara-la-Copa\'.html#respuestas-abajo" class="size10">Alemania Se LLevara la Copa?????????????????\'</a></li>
						<li><strong>nicoo28</strong> <a href="/comunidades/whatthefuck/543155.ultima/la-verdad-que-no-entiendo-a-las-mujeres.html#respuestas-abajo" class="size10">la verdad que no entiendo a las mujeres</a></li>

						<li><strong>Batalla_Solari</strong> <a href="/comunidades/codibujante/542363.ultima/3-de-mis-dibujos-con-plumas-de-colores.html#respuestas-abajo" class="size10">3 de mis dibujos con plumas de colores</a></li>
						<li><strong>tserro1</strong> <a href="/comunidades/comunidad-la-hoja/526853.ultima/¡Gran-Concurso-Naruto!.html#respuestas-abajo" class="size10">¡Gran Concurso Naruto!</a></li>
						<li><strong>rat79</strong> <a href="/comunidades/whatthefuck/542956.ultima/una-pregunta-referida-a-robos.html#respuestas-abajo" class="size10">una pregunta referida a robos</a></li>
						<li><strong>Luis_man95</strong> <a href="/comunidades/capsim/542612.ultima/help().html#respuestas-abajo" class="size10">help(?)</a></li>

						<li><strong>ItachiAkatsuki</strong> <a href="/comunidades/naruto-f/543057.ultima/Alto-amv.html#respuestas-abajo" class="size10">Alto amv</a></li>
						<li><strong>emajuegos</strong> <a href="/comunidades/cine--tv/531445.ultima/Tema-positivo!!-º-comenten!!-(nuevos-tops!).html#respuestas-abajo" class="size10">Tema positivo!! º comenten!! (nuevos tops!)</a></li>
						<li><strong>_GerMax_</strong> <a href="/comunidades/teamarg/543166.ultima/Ladrones-de-Cuentas-Steam-A-La-Vista!!.html#respuestas-abajo" class="size10">Ladrones de Cuentas Steam A La Vista!!</a></li>
						<li><strong>superrhijitus</strong> <a href="/comunidades/ateismo/402728.ultima/“Dice-el-necio-en-su-corazón:-No-hay-Dios”-(Salmos-14:1.html#respuestas-abajo" class="size10">“Dice el necio en su corazón: No hay Dios” (Salmos 14:1</a></li>

						<li><strong>therama09</strong> <a href="/comunidades/bocajuniors/542649.ultima/[News]-Caruzzo-ya-es-de-boca.html#respuestas-abajo" class="size10">[News] Caruzzo ya es de boca</a></li>
						<li><strong>ACHUMADO</strong> <a href="/comunidades/cannabis/543071.ultima/Tengo-una-duda__.html#respuestas-abajo" class="size10">Tengo una duda..</a></li>
						<li><strong>Caterpai</strong> <a href="/comunidades/el-nuevo-mundo/543162.ultima/Adivinanza-No_-82.html#respuestas-abajo" class="size10">Adivinanza No. 82</a></li>
						<li><strong>demon235</strong> <a href="/comunidades/dlranigam/537828.ultima/(Ayuda)-Los-Saves-no-agarran-el-juego__-miren__.html#respuestas-abajo" class="size10">(Ayuda) Los Saves no agarran el juego.. miren..</a></li>

					</ul>
		</div>
	</div>
	<br class="space">

	<div class="com_populares">
		<div class="box_title">
			<div class="box_txt">Comunidades Populares</div>
			<div class="box_rrs"><span class="box_rss"></span></div>

		</div>
		<div class="box_cuerpo" style="padding:0 0 0 0; height: 250px;">
			<div class="filterBy">
				Filtrar por: <a id="Semana" href="javascript:com.TopsTabs(\'Semana\')" class="here">Semana</a> - <a id="Mes" href="javascript:com.TopsTabs(\'Mes\')">Mes</a> - <a id="Historico" href="javascript:com.TopsTabs(\'Historico\')">Hist&oacute;rico</a>

			</div>
			<ol class="filterBy" id="filterBySemana">
											<li><a href="/comunidades/'.$comunidades->comunidad['shortname'].'/">Cero En Conducta!</a> (119)</li>
							<li><a href="/comunidades/hijosdelpueblo/">HDP`s</a> (88)</li>
							<li><a href="/comunidades/comunidadwii/">COMUNIDAD WII¡¡¡</a> (61)</li>

							<li><a href="/comunidades/subielvolumen/">Subi El Volumen!</a> (61)</li>
							<li><a href="/comunidades/tolodtargentina/">Tolo Gallego - Brasil 2014</a> (59)</li>
							<li><a href="/comunidades/graff/">Taringraff</a> (53)</li>
							<li><a href="/comunidades/ttedesvela/">Taringa te desvela</a> (52)</li>

							<li><a href="/comunidades/irctaringa/">Chat TARINGA!</a> (50)</li>
							<li><a href="/comunidades/taringuerosytaringueras/">Taringueros/as!</a> (48)</li>
							<li><a href="/comunidades/rambermatica/">Todo Sobre Informatica</a> (47)</li>
							<li><a href="/comunidades/vaplbeeb/">Volver a Poner la Bandera en e...</a> (46)</li>

							<li><a href="/comunidades/ayudadaunnovato/">Queres ayuda? entrá (para nova...</a> (41)</li>
							<li><a href="/comunidades/futbolynadamasquefutbol/">Futbol Y Nada Mas Que Futbol</a> (41)</li>
							<li><a href="/comunidades/copaamerica2011/">Copa America 2011</a> (40)</li>
							<li><a href="/comunidades/soporte-para-linux/">Soporte Tecnico de Linux</a> (39)</li>

						</ol>
			<ol class="filterBy" id="filterByMes">
											<li><a href="/comunidades/ylosantimessi/">y los anti messi?</a> (681)</li>
							<li><a href="/comunidades/facundocisterna/">Games 3DX [Comunidad Oficial]</a> (498)</li>
							<li><a href="/comunidades/cienciainformatica/">Informática: la ciencia de la in...</a> (431)</li>

							<li><a href="/comunidades/trsnochinga/">TrAsNochinga!</a> (328)</li>
							<li><a href="/comunidades/prode-del-mundial/">Prode Taringuero! - [Comunidad O...</a> (311)</li>
							<li><a href="/comunidades/japonteamo/">amantes del  japon</a> (262)</li>
							<li><a href="/comunidades/martinpalermoenelmundial/">Palermo es Mundial</a> (260)</li>

							<li><a href="/comunidades/resident-evil-4-y-5/">Resident Evil 4 y 5 [Comunidad O...</a> (256)</li>
							<li><a href="/comunidades/shsite/">SIlent hill site</a> (231)</li>
							<li><a href="/comunidades/gamersveteranos/">GAMERS VETERANOS</a> (202)</li>
							<li><a href="/comunidades/konoha/">konoha</a> (178)</li>

							<li><a href="/comunidades/xdddddddxd/">Comunidad XD</a> (176)</li>
							<li><a href="/comunidades/comunidadk/">Comunidad K [x2]</a> (173)</li>
							<li><a href="/comunidades/xbox-comu/">XBOX - Comunidad Oficial</a> (164)</li>
							<li><a href="/comunidades/c-m-z/">Comunidad Max Zone</a> (140)</li>

						</ol>
			<ol class="filterBy" id="filterByHistorico">
											<li><a href="/comunidades/gamers/">Gamers</a> (10783)</li>
							<li><a href="/comunidades/whatthefuck/">Comunidad WTF</a> (10460)</li>
							<li><a href="/comunidades/taringarespuestas/">Taringa Respuestas!</a> (9417)</li>

							<li><a href="/comunidades/serviciotecnico/">Servicio Tecnico para PC</a> (8396)</li>
							<li><a href="/comunidades/juegostaringa/">Juegos Taringa!</a> (8132)</li>
							<li><a href="/comunidades/cannabis/">Fumatinga</a> (7204)</li>
							<li><a href="/comunidades/ps2games/">PlayStation 2 · Comunidad Oficia...</a> (5393)</li>

							<li><a href="/comunidades/tanite/">T! At Nite!</a> (4271)</li>
							<li><a href="/comunidades/bbcoder/">BBCoder para T! y P! - Sharkale®</a> (4215)</li>
							<li><a href="/comunidades/riverplate/">Club Atlético River Plate</a> (3770)</li>
							<li><a href="/comunidades/bocajuniors/">Club Atlético Boca Juniors</a> (3632)</li>

							<li><a href="/comunidades/guitarristas-taringueros/">Comunidad de Guitarristas Taring...</a> (3576)</li>
							<li><a href="/comunidades/ciencia-con-paciencia/">Ciencia con paciencia</a> (3163)</li>
							<li><a href="/comunidades/metaleros/">Heavy MeTaleros</a> (3102)</li>
							<li><a href="/comunidades/fansp4mm3r/">Sp4mm3r [Comunidad de Ayuda]</a> (3033)</li>

						</ol>
		</div>
	</div>
		<br class="space">

	<div class="ult_comunidades">
		<div class="box_title">
			<div class="box_txt ultimas_comunidades">&Uacute;ltimas Comunidades</div>
			<div class="box_rrs"><span class="box_rss"></span></div>

		</div>
		<div class="box_cuerpo">
			<ul class="listDisc">
							<li><a href="/comunidades/windows-linux/" class="size10">Microsoft</a></li>
							<li><a href="/comunidades/shitbrix/" class="size10">Shitbrix</a></li>
							<li><a href="/comunidades/comuninternacional/" class="size10">Comunidad Internacional</a></li>
							<li><a href="/comunidades/libertad-de-expresion/" class="size10">Deci Lo que no te gusta !!</a></li>

							<li><a href="/comunidades/anime-lovers/" class="size10">*~ Anime Lovers ~*</a></li>
							<li><a href="/comunidades/garrys-mod-comunidad-oficial/" class="size10">Garrys Mod [Comunidad Oficial]</a></li>
							<li><a href="/comunidades/final-fantasy/" class="size10">Final Fantasy</a></li>
							<li><a href="/comunidades/gmodcons/" class="size10">Gmod Constructors</a></li>
							<li><a href="/comunidades/escritorios-pc/" class="size10">Escritorios</a></li>
							<li><a href="/comunidades/garrysmodjuego/" class="size10">Garrys Mod</a></li>

							<li><a href="/comunidades/bardelospibes/" class="size10">El Bar De Los Pibes</a></li>
							<li><a href="/comunidades/d-novato-a-nfu/" class="size10">De novato a NFU</a></li>
							<li><a href="/comunidades/garrysmod1/" class="size10">Comunidad Garrys Mod</a></li>
							<li><a href="/comunidades/juegosringa/" class="size10">Juegoringa</a></li>
							<li><a href="/comunidades/cualesmejor/" class="size10">Cual Es mejor ?</a></li>
						</ul>

			<div style="background:#FFFFCC; border:1px solid #FFCC33; padding:5px;margin:5px 0 0 0;font-weight: bold; text-align:center;-moz-border-radius: 5px">
				<a href="/comunidades/crear/" style="color:#0033CC">&iquest;Qu&eacute; esperas para crear la tuya?</a>
			</div>
		</div>
	</div>

</div>
</div>

</div>';
}

function Comunidad_template() {
	global $key,$comunidades,$comunidad,$images;
	
	$comunidades->breadcrump();
	
	echo '

<div id="centro">

				<div class="bubbleCont">
			<div id="ComInfo" class="Container">
			  <div class="floatL">
				  <h1 style="*padding: 5px">'.$comunidades->comunidad['nombre'].'</h1>
        </div>
        <div class="verMas">

  				<a id="aVerMas" href="javascript:com.masinfo();">Ver m&aacute;s &raquo;</a>
  			</div>
				<div class="clearfix"></div>
				<br class="spacer"/>

				<div class="dataRow ">
					<p class="dataLeft">Descripci&oacute;n</p>
					<p class="dataRight">'.$comunidades->comunidad['descripcion'].'</p>
					<div style="clear:both"></div>
				</div>
				<div id="cMasInfo" style="display:none">
				<div class="dataRow">
					<p class="dataLeft">Categor&iacute;a</p>

					<p class="dataRight">
						<a href="/comunidades/home/'.$comunidades->comunidad['link_categoria'].'/" title="'.$comunidades->comunidad['nom_categoria'].'">'.$comunidades->comunidad['nom_categoria'].'</a> > '.$comunidades->comunidad['nombre_subcategoria'].'</p>
					<div class="clearBoth"></div>
				</div>

				<div class="dataRow">
					<p class="dataLeft">Creado</p>

					<p class="dataRight">
						por <a title="Ver el perfil de '.$comunidades->comunidad['nick'].'" href="/perfil/'.$comunidades->comunidad['id'].'/"><strong>'.$comunidades->comunidad['nick'].'</strong></a> '.hace($comunidades->comunidad['fecha']).'</p>
					<div class="clearBoth"></div>
				</div>	


				<div class="dataRow">
					<p class="dataLeft">Tipo</p>
					<p class="dataRight">
						Todos pueden ver la comunidad					</p>
					<div class="clearBoth"></div>	
				</div>

				<div class="dataRow">
					<p class="dataLeft">Tipo de validaci&oacute;n</p>
					<p class="dataRight">
						Los nuevos miembros son aceptados automaticamente<br />Con el rango <b>'.rangocomunidad($comunidades->comunidad['rango_default']).'</b></p>
					<div class="clearBoth"></div>	
				</div>

				<div class="dataRow">
					<p class="dataLeft">Creada</p>
					<p class="dataRight" title="'.fecha($comunidades->comunidad['fecha']).'">'.hace($comunidades->comunidad['fecha']).'</p>
					<div class="clearBoth"></div>	
				</div>
				</div>
				<div class="clearBoth"></div>
			</div>
		
		</div><!-- COMUNIDAD DATA -->
			<br class="spacer" />';

if (mysql_num_rows($comunidades->db_comunidad_ti)) {
	
	echo '
			<div class="bubbleCont">
				<div class="Container">
					<h1>Importantes</h1>
					<table style="clear:both" cellpadding="0" cellspacing="0">
						<tr>
							<td class="thead"></td>
							<td class="thead titulo">T&iacute;tulo</td>

							<td class="thead" style="text-align:right;width:120px">Creado</td>
							<td class="thead">Respuestas</td>
						</tr>
						';
					
					while($temai = mysql_fetch_array($comunidades->db_comunidad_ti)) {
						echo '
						<tr class="temas color1">
							<td>
								<img src="'.$images.'/images/page.png" />
							</td>
							<td class="temaTitulo">

								<a href="/comunidades/'.$comunidades->comunidad['shortname'].'/541350/Quien-Quiere-Ser-Moderador!.html">Quien Quiere Ser Moderador??!</a><br />
								<span class="small color_gray">Por <a href="/perfil/2353444/">edwin_lapara</a></span>
							</td>
							<td class="datetema" style="text-align:right" title="09.07.2010 a las 15:08 hs.">
								Hace 21 horas							</td>
							<td class="datetema">
							  11							</td>

						</tr>';
					}
					
					mysql_free_result($comunidades->db_comunidad_ti);

echo '
					</table>  
					<div class="clearBoth"></div>
				</div>
		</div>

<br class="spacer" />
';
}

if (!$comunidades->miembro) {
	echo '
<div class="emptyData">
  Para poder participar en esta comunidad necesitas ser parte de la misma.<br />Para eso tienes que <a href="javascript:com.miembro_add()">Unirte</a>
</div>
<br class="spacer" />';
}

echo '
	<div class="bubbleCont">
	<div id="ComInfo" class="Container">
	<a href="/rss/comunidades/'.$comunidades->comunidad['shortname'].'/" style="display:block; float:left; margin-top:4px" title="&Uacute;ltimos Temas"><span class="systemicons sRss" style="position: relative; z-index: 87;"></span></a>
	  <h1 class="floatL">Temas</h1>

            		<div class="clearBoth"></div>
';

if (mysql_num_rows($comunidades->db_comunidad_t)) {
	echo '
								<table cellpadding="0" cellspacing="0">
							<tr>
								<td class="thead"></td>
								<td class="thead titulo">Titulo</td>
								<td class="thead" style="text-align:right;width: 120px">Creado</td>
								<td class="thead" style="text-align:right">Respuestas</span></td>
							</tr>';
$number = 0;
while($tema = mysql_fetch_array($comunidades->db_comunidad_t)) {
	echo '
									<tr class="temas color'.($number%2==0 ? '1' : '2').'">
								<td>
									<img src="'.$images.'/images/page.png" />
								</td>
								<td class="temaTitulo">
									<a href="/comunidades/'.$tema['shortname'].'/'.$tema['temaid'].'/'.corregir($tema['titulo']).'.html">'.$tema['titulo'].'</a><br />
									<span class="small color_gray">Por <a href="/perfil/'.$tema['id'].'/">'.$tema['nick'].'</a></span>
								</td>
								<td class="datetema" style="text-align: right;" title="'.fecha($tema['fechate']).'">'.hace($tema['fechate']).'</td>
								<td class="datetema">'.$tema['numco'].'</td>
							</tr>';
}

echo '</table>';

} else {
	echo '';
}

echo '
		<div class="pages"><!-- Paginado -->
								<a class="btnPagi floatR" href="/comunidades/'.$comunidades->comunidad['shortname'].'.2/">Siguiente &raquo;</a>
						<div class="clearBoth"></div>
		</div>
	</div>
';

$comunidades->derecha();

}

function Editar_template() {
	global $key,$comunidades,$comunidad,$images,$url;
	
	$comunidades->breadcrump();
	
	echo '<div id="centroDerecha">

	<script type="text/javascript">
function validate_form_crear(f, campos){
	if(!validate_form(f, campos))
		return false;

	//Validaciones especiales
	if($(f[\'tipo_val\']).val()==\'2\') //Seleccion automatica de rango
		if(!check_complete(f[\'rango_default\'], \'default\'))
			return false;

	return true;
}
</script>

<div id="centro">
	<div style="background: #f7f7f7">
		<div class="titleHighlight">

			Editar la comunidad		</div>
		<div class="form-container form2">
			<form name="add_comunidad" method="post" action="/comunidades/editando/" onsubmit="return validate_form_crear(this, \'nombre,imagen,categoria,subcategoria,pais,descripcion,tags\')">
									<input type="hidden" name="comid" value="12508" />
								<input type="hidden" name="key" value="'.$key.'" />
				<div class="dataL">
					<label for="uname">Nombre de la comunidad</label>
					<input class="c_input" type="text" value="'.$comunidades->comunidad['nombre'].'" name="nombre" tabindex="1" datatype="text" dataname="Nombre" />

				</div>
				<div class="dataR">
					<span class="gif_cargando floatR" id="shortname" style="top:0px"></span>
					<label for="uname">Nombre corto</label>
					<input class="c_input" type="text" value="'.$comunidades->comunidad['shortname'].'" name="shortname" tabindex="2" onkeyup="com.crear_shortname_key(this.value)" onblur="com.crear_shortname_check(this.value)" datatype="text" dataname="Nombre corto" disabled />
					<div class="desform">URL de la comunidad: <br /><strong>'.$url.'/comunidades/<span id="preview_shortname">'.$comunidades->comunidad['shortname'].'</span></strong></div>
					<span id="msg_crear_shortname"></span>

				</div>
				<div class="clearBoth"></div>

				<div class="dataL">
					<label for="uname">Imagen</label>
					<input class="c_input" type="text" value="'.$comunidades->comunidad['imagen'].'" name="imagen" tabindex="3" datatype="url" dataname="Imagen" />
				</div>
				<div class="dataR">
					<label for="fname">Pa&iacute;s</label>

					<select id="pais" name="pais" tabindex="4" datatype="select" default="-1" dataname="Pais">
						<option value="-1">Seleccionar Pa&iacute;s</option>
							<option value="-2">---</option>
							<option value="999">Internacional</option>
							<option value="-2">---</option>
							<option value="0">Argentina</option>
					</select>
				</div>
				<div class="clearBoth"></div>

				<div class="dataL">
					<label for="fname">Categor&iacute;a</label>
					<select class="agregar_categoria" name="categoria" tabindex="5" datatype="select" default="-1" dataname="Categoria" onchange="com.get_subcategorias(this.value)">

						<option value="-1">Elegir una categor&iacute;a</option>
												<option value="9">Arte y Literatura</option>
												<option value="1">Deportes</option>
												<option value="0">Diversi&oacute;n y Esparcimiento</option>
												<option value="2">Econom&iacute;a y Negocios</option>

												<option value="3">Entretenimiento y Medios</option>
												<option value="7">Grupos y Organizaciones</option>
												<option value="8">Inter&eacute;s general</option>
												<option value="5" selected="true">Internet y Tecnolog&iacute;a</option>
												<option value="6">M&uacute;sica y Bandas</option>

												<option value="4">Regiones</option>
											</select>
				</div>
				<div class="dataR">
					<span class="gif_cargando floatR" id="subcategoria" style="top:0px"></span>
					<label for="fname">Sub-Categor&iacute;a</label>
					<select class="agregar_subcategoria" name="subcategoria" tabindex="6" datatype="select" default="-1" dataname="Subcategoria">

						<option value="-1">Elegir una subcategor&iacute;a</option>
											<option value="12">aparatos-elecronicos</option>
											<option value="1">celulares</option>
											<option value="0">computadoras-hardware</option>
											<option value="10" selected="true">comunidades-2.0-cultura-online</option>
											<option value="2">gadgets</option>
											<option value="14">general-otros</option>
											<option value="7">juegos</option>
											<option value="4">linux</option>
											<option value="6">mac</option>
											<option value="8">multimedia</option>
											<option value="13">noticias-novedades</option>
											<option value="9">programacion-lenguajes</option>
											<option value="11">sitios-web-blogs</option>
											<option value="3">software-aplicaciones</option>
											<option value="5">windows</option>
									</select>
				</div>
				<div class="clearBoth"></div>

				<div class="data">
					<label for="uname">Descripci&oacute;n</label>
					<textarea class="c_input_desc autogrow" style="resize: none;" name="descripcion" tabindex="7" datatype="text" dataname="Descripcion">'.$comunidades->comunidad['descripcion'].'</textarea>
				</div>
				<div class="data">
					<label for="uname">Tags</label>

					<input class="c_input" name="tags" type="text" value="'.$comunidades->comunidad['tags'].'" tabindex="8" datatype="tags" dataname="Tags" />
					<div class="desform">
						Ej: gol, ingleses, Mundial 86, futbol, Maradona, Argentina
					</div>
				</div>

				<hr style="clear:both;margin-bottom:15px;margin-top:20px;" class="divider"/>
				

				<div class="dataL dataRadio">
					<label for="lname">Acceso</label>

					<div class="postLabel">
						<input name="privada" id="privada_1" type="radio" value="1" checked tabindex="9" /><label for="privada_1">Todos</label><br />
						<p class="descRadio">
              Todas las personas que visitan Taringa! podrán acceder a tu comunidad. (Recomendado)
						</p>
						<input name="privada" id="privada_2" type="radio" value="2" /><label for="privada_2">Sólo usuarios registrados</label><br />	
            		<p class="descRadio">
                  El acceso a tu comunidad estará restringida únicamente para los usuarios que se han registrado en Taringa
    						</p>            
            					</div>

				</div>


				<div class="data" style="display:none">
					<label for="lname">Tipo de validaci&oacute;n</label>
					<div class="postLabel">
						<input name="tipo_val" type="radio" value="1" checked onclick="com.create_show_rango_def(true)" /> Autom&aacute;tica<br />

						<input name="tipo_val" type="radio" value="2" tabindex="10" onclick="com.create_show_rango_def(false)" /> Manual
					</div>
				</div>

				<div class="dataR dataRadio" id="rango_default">
					<label for="fname">Permisos</label>			
					<div class="postLabel">
						<input name="rango_default" id="permisos_1" type="radio" value="3" checked tabindex="11" /><label for="permisos_1">Posteador</label><br />
						<p class="descRadio">

              Los usuarios al ingresar en tu comunidad podrán comentar y crear temas.
						</p>
						<input name="rango_default" id="permisos_2" type="radio" value="2" /><label for="permisos_2">Comentador</label><br />
						<p class="descRadio">
						 Los usuarios al participar en tu  comunidad sólo podrán comentar pero no estarán habilitados para crear nuevos temas.
						</p>
						<input name="rango_default" id="permisos_3" type="radio" value="1" /><label for="permisos_3">Visitante</label><br />
						<p class="descRadio">
              Los usuarios al participar en tu comunidad no podrán comentar ni tampoco crear temas.
						</p>

					</div>
					<div style="color:#666;font-weight:normal;margin:5px 0">
					  <strong>Nota:</strong>
					  La opción seleccionada le asignará automáticamente el mismo rango a todos los usuarios que ingresan a tu comunidad, sin embargo, podrás posteriormente modificarlo para cada uno de los participantes.
          </div>
				</div>

				<hr style="clear:both;margin-bottom:15px;margin-top:20px;" class="divider"/>

								<div id="buttons">

					<input class="mBtn btnOk" type="submit" tabindex="14" title="Guardar cambios" value="Guardar cambios" class="button" name="Enviar" />
															<input class="mBtn btnDelete floatR" type="button" tabindex="15" title="Eliminar comunidad" value="Eliminar comunidad" onclick="com.comunidad_eliminar(0)" />
													</div>
			</form>
		</div>
	</div>
</div>

<div id="izquierda" style="float:right; display:none">
	<div class="box_title">

		<div class="box_txt para_un_buen_post">Vista Previa</div>
		<div class="box_rss"></div>
	</div>
	<div class="box_cuerpo">
		<div class="avaComunidad">
		</div>
	<h2><a href="/comunidades/putore/">Nombre</a></h2>
	</div>
</div>

</div>
</div>';
}

function Agregar_template($editar = false) {
	global $key,$comunidades,$comunidad,$images,$url;
	
	$comunidades->breadcrump();
	
	echo '<div id="centroDerecha">
	<div id="post_agregar" class="floatR">
	<div class="box_title">
		<div class="box_txt agregar_post">Agregar tema</div>
		<div class="box_rss"></div>
	</div>

	<div id="mensaje-top">
    <a target="_blank" href="/protocolo/">Importante: antes de crear un post lee el protocolo.</a>
  </div>
	<div class="box_cuerpo">
		<div class="form-container">
			<form name="add_tema" method="post" action="/comunidades/'.($editar ? 'editando-tema' : 'agregando').'/" onsubmit="return validate_form(this, \'titulo,cuerpo,tags\')">
				<input type="hidden" name="key" value="'.$key.'" />
				<input type="hidden" name="comid" value="12508" />

				<div class="data">
					<label for="uname">T&iacute;tulo</label>
					<input class="c_input" type="text" value="'.$comunidades->tema['titulo'].'" name="titulo" tabindex="1" datatype="text" dataname="Titulo" />
				</div>
				<div class="data">
					<label for="uname">Cuerpo</label>
					<textarea class="c_input_desc" id="markItUp" name="cuerpo" tabindex="8" datatype="text" dataname="Cuerpo">'.$comunidades->tema['cuerpo'].'</textarea>
				</div>
				<div class="data">
					<label for="uname">Tags</label>
					<input class="c_input" name="tags" type="text" value="'.$comunidades->tema['tagste'].'" tabindex="9" datatype="tags" dataname="Tags" />
					Una lista de por lo menos cuatro Tags separados por comas, que describa el contenido.<br />
					Ejemplo: <b>gol, ingleses, Mundial 86, futbol, Maradona, Argentina</b><br />
					<b>Nota:</b> Cuanto mejor uses los Tags, otros usuarios podr&aacute;n encontrar tu Temas m&aacute;s f&aacute;cilmente.
				</div>

				<div class="data postLabel">
					<label for="uname">Opciones</label><br /><br />
					<input type="checkbox" name="cerrado" id="check_cerrado" tabindex="11" '.($comunidades->tema['cerrado'] ? 'checked ' : '').'/> <label for="check_cerrado">No se permite responder</label><br />
					<input type="checkbox" name="sticky" id="check_sticky" tabindex="12" '.($comunidades->tema['importante'] ? 'checked ' : '').'/> <label for="check_sticky">Sticky</label><br />
				</div>
				<div style="text-align:center">

					<input type="submit" tabindex="13" title="'.($editar ? 'Guardar cambios' : 'Agregar tema').'" value="'.($editar ? 'Guardar cambios' : 'Agregar tema').'" class="mBtn btnOk" name="Enviar" />
				</div>
			</form>
		</div>
	</div>
</div>

</div>
</div>';

}

function Miembros_template() {
	global $key,$comunidades,$comunidad,$images,$url;
	
	$comunidades->breadcrump();
	echo '<div id="centro">

	<div class="filterBy">
	<div class="floatL">

		<input id="miembros_list_search" class="search-input" type="text" value="" /><input class="mBtn btnOk" value="&raquo;" onclick="javascript:com.miembros_list_search_set()" />
	</div>
  <ul>
    <li id="act" class="here"><a href="javascript:com.miembros_list(\'act\')">Miembros</a></li>
    <li id="susp"><a href="javascript:com.miembros_list(\'susp\')">Suspendidos</a></li>
    <li id="history"><a href="javascript:com.miembros_list(\'history\')">Historial</a></li>
  </ul>

  <span class="gif_cargando floatR"></span>
  <div class="clearBoth"></div>
</div>
<div id="showResult">
';

foreach ($comunidades->miembros['m'] as $key => $m) {
	echo '
	<ul id="userid_'.$m['key'].'">
		<li class="resultBox">
			<h4><a href="/perfil/'.$m['nick'].'/" title="Perfil de '.$m['nick'].'">'.$m['nick'].'</a></h4>
			<div class="floatL avatarBox">
				<a href="/perfil/'.$m['nick'].'/" title="Perfil de '.$m['nick'].'">
					<img width="75px" height="75px" src="'.$m['avatar'].'" onerror="error_avatar(this)" />
				</a>
			</div>
			<div class="floatL infoBox">
				<ul>
					<li>Rango: <strong>'.$m['rangoco'].'</strong></li>
					<li>Sexo: <strong>'.$m['sexo'].'</strong></li>
					<li><a href="/mensajes/a/'.$m['nick'].'" title="Enviar mensaje">Enviar mensaje</a></li>
									<li><a href="javascript:com.admin_users(\''.$m['key'].'\');" title="Administrar al usuario">Administrar</a></li>
								</ul>
			</div>
		</li>
	</ul>';
}
	$comunidades->derecha();
}

function Tema_template() {
	global $key,$comunidades,$comunidad,$images,$url,$global_user;
	
	$comunidades->breadcrump();
	
	echo '<div id="centroDerecha">

<div id="temaComunidad">
  <div class="temaBubble">

    <div class="bubbleCont">
      <div class="Container">
        <div class="TemaCont">
          <div class="postBy">
        	  <a href="/perfil/'.$comunidades->tema['id'].'">
          		<img title="Ver perfil de '.$comunidades->tema['nick'].'" alt="Ver perfil de '.$comunidades->tema['nick'].'" class="avatar" src="'.$comunidades->tema['avatar'].'" onerror="error_avatar(this)" />
          	</a>
          	<strong>
          	<a title="Ver perfil de '.$comunidades->tema['nick'].'" href="/perfil/'.$comunidades->tema['id'].'">'.$comunidades->tema['nick'].'</a>
          	</strong>
        	  <ul class="userIcons clearbeta">
		    	<li>
				<span style="float: left; width: 16px; height: 16px; background: url('.$images.'/images/big2v1.png); background-position: 0 -792px" title="Online"></span>
				</li>
				<li><span title="Hombre" class="systemicons sexoM"></span></li>
				<li><img title="'.$comunidades->tema['nombre_pais'].'" src="'.$images.'/images/flags/'.strtolower($comunidades->tema['img_pais']).'.png" width="16" height="11" align="absmiddle" alt="'.$comunidades->tema['nombre_pais'].'" /></li>	
				<li>
				<a title="Enviar un mensaje privado" href="/mensajes/a/'.$comunidades->tema['nick'].'"><span class="systemicons mensaje"></span></a>
				</li>
        	  </ul>
        	</div><!-- END postBy -->
        	<div class="temaCont" style="width:600px">
        	  <div class="floatL">
        	    <h1 class="titulopost">'.$comunidades->tema['titulo'].'</h1>
        	  </div>
        	  <div class="floatR">
        	  ';
    
	if ($comunidades->comunidad['rangoco'] == '5' or $comunidades->comunidad['rangoco'] == '4') {
		echo '<a class="btnActions" href="javascript:com.del_tema()" title="Borrar tema">
		<img src="'.$images.'/images/borrar.png" alt="Borrar" /> Borrar</a>
		<a class="btnActions" href="/comunidades/'.$comunidades->comunidad['shortname'].'/editar-tema/'.$comunidades->tema['temaid'].'/" title="Editar tema">
		<img src="'.$images.'/images/editar.png" alt="Editar" /> Editar</a>';
	}
	
    echo '
                </div>
        		<div class="clearBoth"></div>
        		<hr />

        		<p>'.$comunidades->tema['cuerpo'].'</p>
      	</div> <!-- END TemaCont -->

		<!-- fede tema2 -->
        <div class="clearBoth"></div>
      	<div class="infoPost floatL">
      		<div class="shareBox" style="width:15%">

      			<strong class="title">Compartir:</strong>
            <a class="delicious socialIcons" title="Delicious" href="http://del.icio.us/post?url='.$url.''.$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"></a>
            <a class="facebook socialIcons" title="Facebook" href="http://www.facebook.com/share.php?u='.$url.''.$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"></a>
            <a class="digg socialIcons" title="Digg" href="http://digg.com/submit?phase=2&url='.$url.''.$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"></a>
            <a class="twitter socialIcons" title="Twitter" href="http://twitter.com/home?status='.$url.''.$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"></a>
                  		</div><!-- END shareBox -->
      		<div class="rateBox" style="width:15%">
      			<strong class="title">Calificar:</strong>

      	  	<span id="actions">
        			<a href="javascript:com.tema_votar(1)" class="thumbs thumbsUp" title="Votar positivo"></a>
        			<a href="javascript:com.tema_votar(-1)" class="thumbs thumbsDown" title="Votar negativo"></a>
        		</span>
      			      			<script>var votos_total=0;</script>
      			<span id="votos_total" class="color_green">0</span>
      		</div><!-- END RateBox -->
      		<div class="ageBox">

      			<strong class="title">Creado</strong>
      			<span style="font-size:11px" title="Menos de 1 minuto">'.hace($comunidades->tema['fechate']).'</span>
      		</div><!-- END Creadobox -->
      		<div class="metaBox" style="width: 15%">
	    			<strong class="title">Visitas:</strong>
      			<span style="font-size:11px">0</span>
     			</div><!-- END Visitas -->

     			
     			<div class="metaBox" style="width: 15%">
     				<strong class="title">Seguidores</strong>
     				<span style="font-size:11px" class="tema_notifica_count">0</span>
     				</div><!-- END Visitas -->
     				
     				<div class="followBox">
     					     				 	<a class="btn_g unfollow_tema floatR" style="display: none" onclick="notifica.unfollow(\'tema\', 546391, notifica.temaInComunidadHandle, $(this).children(\'span\'))"><span class="icons unfollow">Dejar de seguir</span></a>
     					<a class="btn_g follow_tema floatR" onclick="notifica.follow(\'tema\', 546391, notifica.temaInComunidadHandle, $(this).children(\'span\'))"><span class="icons follow">Seguir tema</span></a>

     						     			</div>
      		<div class="clearBoth"></div>
      		<div class="tagsBox">
      			<strong>Tags:</strong>
      			<ul>
      			';
      			
      			foreach (explode(",",$comunidades->tema['tagste']) as $key => $value) {
      			    echo '<li>'.$value.'</li>,';      			
      			}
      			
      			echo '
      			</ul>

      		</div><!-- END tagsBox -->
     	</div><!-- END infoPost -->
		<!-- fin fede tema2 -->

      	<div class="clearBoth"></div>
      	</div>
      </div>
    </div>
  </div>

</div>
<div class="clearBoth"></div>
<div id="respuestas" style="display:none">
	
	<a name="respuestas"></a>
	<a href="/rss/comunidades/tema-respuestas/546391/" title="&Uacute;ltimas Respuestas"><span class="floatL systemicons sRss" style="position: relative; z-index: 87;margin-right: 5px"></span></a>
	<h1 class="titulorespuestas">0 Respuestas</h1>
	<hr />
	<!-- Paginado -->

</div><!-- #respuestas -->
<a name="respuestas-abajo"></a>

<!-- Paginado -->
<div class="clearBoth"></div>
';

if ($comunidades->tema['cerrado']) {
	echo '<div class="emptyData" style="margin-top: 10px">Las respuestas de este tema fueron cerradas</div>';
} else {
	if ($comunidades->miembro) {
		echo '
	<div class="miRespuesta">
	<div id="procesando"><div id="tema"></div></div>
	<div class="answerInfo">
		<img style="position:relative;z-index:1" class="avatar-48 lazy" width="48" height="48" orig="'.$global_user['avatar'].'" alt="Avatar de '.$global_user['nick'].' en '.$comunidad.'" onerror="error_avatar(this, '.$comunidades->tema['id'].', 48)" />
	</div>
	<div class="answerTxt">
	  <div class="Container">

			<div class="add_resp_error"></div>
						<textarea id="body_resp" class="onblur_effect autogrow" tabindex="1" title="Escribir una respuesta..." style="resize:none;" onfocus="onfocus_input(this)" onblur="onblur_input(this)">Escribir una respuesta...</textarea>
			<div class="buttons" style="text-align:left">
				<input type="button" onclick="com.add_resp(\'true\')" id="button_add_resp" class="mBtn btnOk" value="Responder" tabindex="2" />
			</div>
			<script type="text/javascript">$(function(){ com.lastid_resp=\'0\'; $(\'#body_resp\').val($(\'#body_resp\').attr(\'title\')); });</script>
		</div>
	</div>

</div>';
	} else {
		echo '<div class="emptyData" style="margin-top: 10px">Para poder comentar en esta comunidad necesitas ser parte de la misma. Para eso necesitas <a href="javascript:com.miembro_add()">Unirte</a></div>';
	}
}

echo '

</div>
</div>';
	
}

cabecera_normal();

if ($_GET['shortname']) {
	
	$comunidades->Comunidad();
	
	if ($_GET['accion'] == 'editar') {
		Editar_template();
	} elseif ($_GET['accion'] == 'agregar') {
		Agregar_template();
	} elseif ($_GET['accion'] == 'editar-tema') {
		$comunidades->tema($_GET['temaid']);
		Agregar_template(true);
	} elseif ($_GET['accion'] == 'miembros') {
		Miembros_template();
	} elseif ($_GET['temaid'] and !$_GET['accion']) {
		$comunidades->tema($_GET['temaid']);
		Tema_template();
	} else {
		Comunidad_template();
	}
	
} elseif (!$_GET['shortname']) {
	
	$comunidades->Main();
	Main_template();
	
} else {
	$comunidades->Main();
	Main_template();
}

pie();

?>