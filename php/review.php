<?php
require_once "mysql_entities_fix_string.php";
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);

$r = mysql_entities_fix_string($conn,$_POST["review"]);
$m = mysql_entities_fix_string($conn,$_GET["movie"]);

session_start();
$id = $_SESSION["id"];

$query = "insert into comment(comment_id,movie_id,user_id,review) values(comment_id,'$m','$id','$r')";

if($conn->query($query) === true){
	echo "<h1>Add Your Review Scuccess!</h1>";
	echo "<button onclick='history.back();'>Back<button>";
} else {
	echo "<h1>Failed! Please retry</h1>";
	echo "<button onclick='history.back();'>Back</button>";
}
?>