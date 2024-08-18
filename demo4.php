<?php
require_once("header.php");
require_once("includes/class.notificaciones.php");

$seguidores = new seguidores('2','user','','follow');
$seguidores->data();

echo ''.$seguidores->notificar().'';

?>
<li class="{dato1}">
		<div class="avatar-box"><a href="/perfil/agustin_91"><img src="http://a03.t.net.ar/avatares/3/9/2/3/32_3923134.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/agustin_91">agustin_91</a> <span class="time" ts="1277846748" title="29.06.2010 a las 18:25 hs.">Hace 2 d&iacute;as</span></span><span class="action"><span class="icon-noti sprite-follow"></span>te está siguiendo. <a onclick="notifica.follow('user', 3923134, notifica.userInMonitorHandle, this)">Seguir a este usuario</a></span></div>

</li>
<li class="post-comment-own">
		<div class="avatar-box"><a href="/perfil/agustin_91"><img src="http://a03.t.net.ar/avatares/3/9/2/3/32_3923134.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/agustin_91">agustin_91</a> <span class="time" ts="1277898928" title="30.06.2010 a las 8:55 hs.">Ayer</span></span><span class="action"><span class="icon-noti sprite-balloon-left"></span>comentó en tu post <a href="/posts/videos/5663057.ultima/Salto-en-patines-desde-la-torre-Eiffel.html">Salto en patines desde la torre Eiffel</a></span></div>
</li>
<li class="post-comment">
		<div class="avatar-box"><a href="/perfil/mndraq"><img src="http://a04.t.net.ar/avatares/4/3/2/4/32_4324211.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/mndraq">mndraq</a> <span class="time" ts="1277846221" title="29.06.2010 a las 18:17 hs.">Hace 2 d&iacute;as</span></span><span class="action"><span class="icon-noti sprite-balloon-left-blue"></span>comentó en el post <a href="/posts/hazlo-tu-mismo/5615763.ultima/Tutorial---Como-hacer-un-menu-de-usuario.html">Tutorial - Como hacer un menu de usuario</a></span></div>
</li>
<li class="com-thread">
		<div class="avatar-box"><a href="/perfil/luzberedondo"><img src="http://a03.t.net.ar/avatares/3/8/0/0/32_3800415.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/luzberedondo">luzberedondo</a> <span class="time" ts="1277827025" title="29.06.2010 a las 12:57 hs.">Hace 2 d&iacute;as</span></span><span class="action"><span class="icon-noti sprite-block"></span>creó un nuevo tema <a href="/comunidades/solo-para-fans-de-dbz/503760/Ayudenos-a-crecer-^^.html">Ayudenos a crecer ^^</a> en <a href="/comunidades/solo-para-fans-de-dbz/">La Comunidad De DBZ</a></span></div>

</li>
<li class="friend-post">
		<div class="avatar-box"><a href="/perfil/portlandhacker"><img src="http://a02.t.net.ar/avatares/3/8/8/4/32_3884562.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/portlandhacker">portlandhacker</a> <span class="time" ts="1277765610" title="28.06.2010 a las 19:53 hs.">Hace 2 d&iacute;as</span></span><span class="action"><span class="icon-noti sprite-document-text-image"></span>creó un nuevo post <a href="/posts/juegos/5951289/GTA-IV-[MegaPost]-[4-DVD5]-[MegaUpload]-[Full]-[Esp]-+-Guia.html">GTA IV [MegaPost] [4 DVD5] [MegaUpload] [Full] [Esp] + Guia</a></span></div>
</li>

<li class="post-comment">
		<div class="avatar-box"><a href="/perfil/mndraq"><img src="http://a04.t.net.ar/avatares/4/3/2/4/32_4324211.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/mndraq">mndraq</a> <span class="time" ts="1277846221" title="29.06.2010 a las 18:17 hs.">Hace 2 d&iacute;as</span></span><span class="action"><span class="icon-noti sprite-balloon-left-blue"></span>comentó en el post <a href="/posts/hazlo-tu-mismo/5615763.ultima/Tutorial---Como-hacer-un-menu-de-usuario.html">Tutorial - Como hacer un menu de usuario</a></span></div>
</li>
<li class="post-points">
		<div class="avatar-box"><a href="/perfil/agustin_91"><img src="http://a03.t.net.ar/avatares/3/9/2/3/32_3923134.jpg" width="32" height="32" /></a></div>

		<div class="notification-info"><span><a href="/perfil/agustin_91">agustin_91</a> <span class="time" ts="1278019167" title="01.07.2010 a las 18:19 hs.">Hace 1 hora</span></span><span class="action"><span class="icon-noti sprite-point"></span>dejó 1 punto en tu post <a href="/posts/downloads/5537860/Talisman-Desktop-3_2_3200.html">Talisman Desktop 3.2.3200</a></span></div>
</li>
<li class="post-spam">
		<div class="avatar-box"><a href="/perfil/kuruzka"><img src="http://a02.t.net.ar/avatares/2/8/3/0/32_283067.jpg" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/kuruzka">kuruzka</a> <span class="time" ts="1277959318" title="01.07.2010 a las 1:41 hs.">Hace 17 horas</span></span><span class="action"><span class="icon-noti sprite-recomendar-p"></span> te recomienda un post <a href="/posts/deportes/5976179/Selección-Argentina:-Vuelve-la-Mística.html">Selección Argentina: Vuelve la Mística</a></span></div>

</li>
<li class="medal unread">
		<div class="group-10 medalla medalla-bronce-big"></div>
		<div class="notification-info"><span><strong> </strong> <span class="time" ts="1278024957" title="01.07.2010 a las 19:55 hs.">Menos de 1 minuto</span></span><span class="action"><span style="display: none" class="icon-noti icon-medallas medalla-bronce"></span>Recibiste la medalla <a href="/perfil/CamilaFlores/medallas">Perfil Completo</a></span></div>
</li>

<?php
include("header.php");

$section = $_GET['section'];

if($key==null){
	fatal_error('Para ingresar a esta secci&oacute;n es necesario autentificarse.');
}

$dbnotificaciones = mysql_query("SELECT id,type FROM notificaciones WHERE id = '{$key}'");
$char = mysql_fetch_array($dbnotificaciones);
mysql_free_result($dbnotificaciones);

print_r($char);

$mostrar['post-favorite'] = array('icon-noti' => '','mensaje' => '');
$mostrar['post-comment-own'] = array('icon-noti' => 'sprite-balloon-left','mensaje' => '');
$mostrar['post-points'] = array('icon-noti' => '','mensaje' => '');
$mostrar['friend-new'] = array('icon-noti' => 'sprite-follow','mensaje' => '');
$mostrar['friend-post'] = array('icon-noti' => '','mensaje' => '');
$mostrar['friend-thread'] = array('icon-noti' => '','mensaje' => '');
$mostrar['post-comment'] = array('icon-noti' => '','mensaje' => '');
$mostrar['com-thread'] = array('icon-noti' => '','mensaje' => '');
$mostrar['com-reply'] = array('icon-noti' => '','mensaje' => '');
$mostrar['post-spam'] = array('icon-noti' => '','mensaje' => '');
$mostrar['medal'] = array('icon-noti' => '','mensaje' => '');

$bloqueados['ids'] = array('x' => 'friend-new',
                           'nick' => 'agustin_91',
                           'avatar' => 'http://a03.t.net.ar/avatares/3/9/2/3/32_3923134.jpg',
                           'tiempo' => '1277846748',
                           'icon-noti' => 'sprite-follow',
                           'mensaje' => 'te está siguiendo. <a onclick="notifica.follow('user', 3923134, notifica.userInMonitorHandle, this)">Seguir a este usuario</a>',
                           '' => '');

<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>

</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>

<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="avatar-box"><a href="/perfil/{nick}"><img src="{avatar}" width="32" height="32" /></a></div>
		<div class="notification-info"><span><a href="/perfil/{nick}">{nick}</a> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>
<li class="{x}">
		<div class="group-10 medalla medalla-bronce-big"></div>
		<div class="notification-info"><span><strong> </strong> <span class="time" ts="{tiempo}" title="{tiempo}">{tiempo}</span></span><span class="action"><span style="display: none" class="icon-noti {icon-noti}"></span>{mensaje}</span></div>
</li>

$listo = serialize($bloqueados);
echo $listo;

foreach ($notificaciones['notificaciones'] as $key => $value) {
	
}


?>

<?php
##########################################################################################
if ($set == 'normal') {
	$select_columns = "";
	$select_tables = "
	    LEFT JOIN {$db_prefix}log_online AS lo ON (lo.ID_MEMBER = mem.ID_MEMBER)
		LEFT JOIN {$db_prefix}attachments AS a ON (a.ID_MEMBER = mem.ID_MEMBER)
		LEFT JOIN {$db_prefix}membergroups AS pg ON (pg.ID_GROUP = mem.ID_POST_GROUP)
		LEFT JOIN {$db_prefix}membergroups AS mg ON (mg.ID_GROUP = mem.ID_GROUP)";
} elseif ($set == 'profile') {
	$select_columns = "
		IFNULL(lo.logTime, 0) AS isOnline, IFNULL(a.ID_ATTACH, 0) AS ID_ATTACH, a.filename, a.attachmentType,
		mem.signature, mem.personalText, mem.location, mem.gender, mem.avatar, mem.ID_MEMBER, mem.memberName,
		mem.realName, mem.emailAddress, mem.hideEmail, mem.dateRegistered, mem.websiteTitle, mem.websiteUrl,
		mem.birthdate, mem.ICQ, mem.AIM, mem.YIM, mem.MSN, mem.posts, mem.lastLogin, mem.karmaGood,
		mem.karmaBad, mem.memberIP, mem.memberIP2, mem.lngfile, mem.ID_GROUP, mem.ID_THEME, mem.buddy_list, mem.pm_ignore_list,
		mem.pm_email_notify, mem.timeOffset" . (!empty($modSettings['titlesEnable']) ? ', mem.usertitle' : '') . ",
		mem.timeFormat, mem.secretQuestion, mem.is_activated, mem.additionalGroups, mem.smileySet, mem.showOnline,
		mem.totalTimeLoggedIn, mem.ID_POST_GROUP, mem.notifyAnnouncements, mem.notifyOnce, mem.notifySendBody,
		mem.notifyTypes, lo.url, mg.onlineColor AS member_group_color, IFNULL(mg.groupName, '') AS member_group,
		pg.onlineColor AS post_group_color, IFNULL(pg.groupName, '') AS post_group,
		IF(mem.ID_GROUP = 0 OR mg.stars = '', pg.stars, mg.stars) AS stars, mem.passwordSalt";
	$select_tables = "
		LEFT JOIN {$db_prefix}log_online AS lo ON (lo.ID_MEMBER = mem.ID_MEMBER)
		LEFT JOIN {$db_prefix}attachments AS a ON (a.ID_MEMBER = mem.ID_MEMBER)
		LEFT JOIN {$db_prefix}membergroups AS pg ON (pg.ID_GROUP = mem.ID_POST_GROUP)
		LEFT JOIN {$db_prefix}membergroups AS mg ON (mg.ID_GROUP = mem.ID_GROUP)";
} elseif ($set == 'minimal') {
	$select_columns = '
		mem.ID_MEMBER, mem.memberName, mem.realName, mem.emailAddress, mem.hideEmail, mem.dateRegistered,
		mem.posts, mem.lastLogin, mem.memberIP, mem.memberIP2, mem.lngfile, mem.ID_GROUP';
	$select_tables = '';
} else trigger_error('loadMemberData(): Invalid member data set \'' . $set . '\'', E_USER_WARNING);

if (!empty($users)) {

	$request = db_query("
		SELECT$select_columns
		FROM {$db_prefix}members AS mem$select_tables
		WHERE mem." . ($is_name ? 'memberName' : 'ID_MEMBER') . (count($users) == 1 ? " = '" . current($users) . "'" : " IN ('" . implode("', '", $users) . "')"), __FILE__, __LINE__);
	$new_loaded_ids = array();
	
	while ($row = mysql_fetch_assoc($request)) {
		$new_loaded_ids[] = $row['ID_MEMBER'];
		$loaded_ids[] = $row['ID_MEMBER'];
		$row['options'] = array();
		$user_profile[$row['ID_MEMBER']] = $row;
	}
	
	mysql_free_result($request);
}

if (!empty($new_loaded_ids) && $set !== 'minimal') {
	$request = db_query("
		SELECT *
		FROM {$db_prefix}themes
		WHERE ID_MEMBER" . (count($new_loaded_ids) == 1 ? ' = ' . $new_loaded_ids[0] : ' IN (' . implode(', ', $new_loaded_ids) . ')'), __FILE__, __LINE__);
	
	while ($row = mysql_fetch_assoc($request))
			$user_profile[$row['ID_MEMBER']]['options'][$row['variable']] = $row['value'];
	
	mysql_free_result($request);
}

	if (!empty($new_loaded_ids) && !empty($modSettings['cache_enable']) && $modSettings['cache_enable'] == 3)
	{
		for ($i = 0, $n = count($new_loaded_ids); $i < $n; $i++)
			cache_put_data('member_data-' . $set . '-' . $new_loaded_ids[$i], $user_profile[$new_loaded_ids[$i]], 240);
	}

	// Are we loading any moderators?  If so, fix their group data...
	if (!empty($loaded_ids) && !empty($board_info['moderators']) && $set === 'normal' && count($temp_mods = array_intersect($loaded_ids, array_keys($board_info['moderators']))) !== 0)
	{
		if (($row = cache_get_data('moderator_group_info', 480)) == null)
		{
			$request = db_query("
				SELECT groupName AS member_group, onlineColor AS member_group_color, stars
				FROM {$db_prefix}membergroups
				WHERE ID_GROUP = 3
				LIMIT 1", __FILE__, __LINE__);
			$row = mysql_fetch_assoc($request);
			mysql_free_result($request);

			cache_put_data('moderator_group_info', $row, 480);
		}

		foreach ($temp_mods as $id)
		{
			// By popular demand, don't show admins or global moderators as moderators.
			if ($user_profile[$id]['ID_GROUP'] != 1 && $user_profile[$id]['ID_GROUP'] != 2)
				$user_profile[$id]['member_group'] = $row['member_group'];

			// If the Moderator group has no color or stars, but their group does... don't overwrite.
			if (!empty($row['stars']))
				$user_profile[$id]['stars'] = $row['stars'];
			if (!empty($row['member_group_color']))
				$user_profile[$id]['member_group_color'] = $row['member_group_color'];
		}
	}

	return empty($loaded_ids) ? false : $loaded_ids;

?>
<?php
{
			case 'follow':
				//code
				break;
			case 'unfollow':
				//code
				break;
			case 'spam':
				//code
				break;
			case 'count':
				//code
				break;
			case 'value':
				//code
				break;
			default:
				//code
				break;
}
		echo '0-4309758-19'; // se unio bien
		echo '2-4309758-19'; //ya se unio
		echo '0-4309758-18'; //dejar de seguir
		
		echo '0-5961045-1'; //se unio al post
		echo '2-5961045-1'; //ya se unio al post
?>
<?php
require_once("header.php");

$action = $_POST['action'];

/*FOLLOWN*/

$type = $_POST['type'];
$obj = $_POST['obj']; // ID posts

if($type == 'post') {
	if($action == 'follow') {
		die('0-'.$obj.'-2');
	}
	if($action == 'unfollow') {
		die('0-'.$obj.'-1');
	}
}

if($type == 'user') {
	if($action == 'follow') {
		mysql_query("INSERT INTO seguidores (seguidor, type, obj) VALUES ('$key', '$type', '$obj')");
		mysql_insert_id($con);
		
		die('0-'.$obj.'-6');
	}
	
	if($action == 'unfollow') {
		die('0-'.$obj.'-5');
	}
}

if($action == 'count') {
	die('28');
}


if($action == 'last') {
	die('<li onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')"><span class="icon-noti sprite-follow"></span><a href="/perfil/shinji191089" class="obj">shinji191089</a> te esta siguiendo</li>
<li onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')"><span class="icon-noti sprite-star"></span><strong>2 users</strong> agregaron tu <a href="/posts/info/5534324/Clarín-mató-a-Cerati.html" class="obj" title="Clarín mató a Cerati">post</a> a favoritos</li>
<li onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')"><span class="icon-noti sprite-follow"></span><a href="/perfil/marcee" class="obj">marcee</a> te esta siguiendo</li>
<li onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')"><span class="icon-noti sprite-follow"></span><a href="/perfil/MargeMarge" class="obj">MargeMarge</a> te esta siguiendo</li>
<li class="unread" onclick="location.href=$(this).children(\'a.obj\').attr(\'href\')"><span class="icon-noti sprite-balloon-left"></span><a href="/perfil/marcexeneize_nqn10">marcexeneize_nqn10</a> comentó en un <a href="/posts/imagenes/5187362.ultima/Mi-primero-post!-Gatitos!.html" class="obj" title="Mi primero post! Gatitos!">post</a> tuyo</li>');
}

?>
if (!empty($_SESSION['log_time']) && $_SESSION['log_time'] >= time() - $modSettings['lastActive'] * 20) {
			
			if ($do_delete) {
				db_query("DELETE FROM {$db_prefix}log_online
				WHERE logTime < NOW() - INTERVAL " . ($modSettings['lastActive'] * 60) . " SECOND
				AND session != '$session_id'", __FILE__, __LINE__);
				cache_put_data('log_online-update', time(), 10);
			}
			
			db_query("
			UPDATE {$db_prefix}log_online
			SET logTime = NOW(), ip = IFNULL(INET_ATON('$user_info[ip]'), 0), url = '$serialized'
			WHERE session = '$session_id'
			LIMIT 1", __FILE__, __LINE__);
			
			// Guess it got deleted.
			if (db_affected_rows() == 0)
			    $_SESSION['log_time'] = 0;
		}
		else
		    $_SESSION['log_time'] = 0;
		
		if (empty($_SESSION['log_time'])) {
			
			if ($do_delete || !empty($ID_MEMBER))
			    db_query("
			    DELETE FROM {$db_prefix}log_online
				WHERE " . ($do_delete ? "logTime < NOW() - INTERVAL " . ($modSettings['lastActive'] * 60) . ' SECOND' : '') . ($do_delete && !empty($ID_MEMBER) ? ' OR ' : '') . (empty($ID_MEMBER) ? '' : "ID_MEMBER = $ID_MEMBER"), __FILE__, __LINE__);
				
				db_query(" " . ($do_delete ? 'INSERT IGNORE' : 'REPLACE') . " INTO {$db_prefix}log_online
				(session, ID_MEMBER, logTime, ip, url)
				VALUES ('$session_id', $ID_MEMBER, NOW(), IFNULL(INET_ATON('$user_info[ip]'), 0), '$serialized')", __FILE__, __LINE__);
		}
		