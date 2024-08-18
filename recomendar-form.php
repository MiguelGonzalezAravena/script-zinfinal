<?php
include("header.php");
$id = no_injection($_GET['id']);
$user = $_SESSION['user'];
$sql = "SELECT p.id, p.titulo, p.id_autor, p.categoria, c.id_categoria, c.link_categoria, c.nom_categoria, u.nick, u.id FROM (posts as p, categorias as c, usuarios as u) WHERE p.id='$id' AND p.categoria=c.id_categoria AND u.id=p.id_autor";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);
$titulo	=	$descripcion;
$etitulo	=	$row['titulo'];
$nick	=	$row['nick'];
$link_categoria	=	$row['link_categoria'];
$contar++;
cabecera_normal();
?><div id="cuerpocontainer">
<!-- inicio cuerpocontainer -->
<div class="container600" style="width:600px;margin: 10px auto 0 auto;">

	<div class="box_title">
		<div class="box_txt post_recomendar" style="width:592px;height:22px;text-align:center;font-size:12px">Recomendar a tus amigos</div>
		<div class="box_rrs"><div class="box_rss"></div></div>
	</div>
	<div class="box_cuerpo"  align="center">
		<form action="/recomendar.php" method="post">
			<input name="action" type="hidden" value="send">
			<b>Recomendarle este post hasta a seis amigos:</b>

			<br>
			<br>
			<input type="text" size=20 name="email1"> <input type="text" size=20 name="email2">
			<br><br>
			<input type="text" size=20 name="email3"> <input type="text" size=20 name="email4">
			<br><br>
			<input type="text" size=20 name="email5"> <input type="text" size=20 name="email6">

			<br>
			<br>
			<b>Asunto del mesaje:</b>
			<br>
			<br>
			<input type="text" size="40" name="titulo" value="<?php echo $etitulo; ?>">
			<br>			
			<br>
			<b>Mensaje:</b>

			<br>
			<br>
			<textarea name="cuerpo" cols="70" rows="8" wrap="hard" tabindex="6">Hola! Te recomiendo que veas este post! 
			
<?php echo $url; ?>/posts/<?php echo $id; ?>/<?php echo $link_categoria; ?>/<?php echo corregir(correcciones($etitulo)); ?>.html

Saludos! 

<?php echo $_SESSION['user']; ?></textarea>
			<br>
			<br>
			<br>
			<input type="submit" class="login" style="font-size:11px" value="Enviar mensaje" title="Enviar mensaje">
			<br>

			<br>
		</form>
	</div>
</div>

<?php
pie();
?>