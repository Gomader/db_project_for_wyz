<?php
	session_start();
	require_once "mysql_entities_fix_string.php";
	require_once "../user/users.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if ($conn->connect_error) die($conn->connect_error);
	$m = mysql_entities_fix_string($conn,$_GET["movie"]);
	$u = $_SESSION["id"];
	$query = "delete from like_list where user_id='$u' and movie_id='$m'";
	$conn->query($query);
	echo "<h1>Delete from your LIKE LIST.</h1>";
	echo "<meta http-equiv='refresh' content='5,url=../movie.php?id=";
	echo $m;
	echo "'/>";
?>