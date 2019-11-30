<?php
	session_start();
	require_once "mysql_entities_fix_string.php";
	require_once "../user/users.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if ($conn->connect_error) die($conn->connect_error);
	$m = mysql_entities_fix_string($conn,$_GET["movie"]);
	$u = $_SESSION["id"];
	$query = "insert into like_list(like_id,user_id,movie_id) values(like_id,'$u','$m');";
	$conn->query($query);
	echo "<h1>Added to your LIKE LIST.</h1>";
	echo "<meta http-equiv='refresh' content='5,url=../movie.php?id=";
	echo $m;
	echo "'/>";
?>