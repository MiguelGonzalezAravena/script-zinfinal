<?php
require_once("header.php");

$id_user = $_SESSION['id'];
$postid = $_POST['postid'];

$sql = "DELETE FROM favoritos WHERE id_post='$postid' AND id_usuario='$id_user'";
mysql_query($sql);
echo "1";
?>

