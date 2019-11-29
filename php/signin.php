<?php
require_once "mysql_entities_fix_string.php";
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);

$id = mysql_entities_fix_string($conn,$_POST["username"]);
$pwd = mysql_entities_fix_string($conn,$_POST["password"]);

$query = "SELECT user_id FROM usr WHERE password = '$pwd' AND user_id = '$id'";
$userInfo = $conn->query($query);
$userInfo = $userInfo->num_rows;

if($userInfo == 1){
    session_start();
    setcookie(session_name(), session_id(), 0, '/');
    $_SESSION["id"] = $id;
    header("location:http://127.0.0.1/DB/db_project_for_wyz/");
} else {
    die("ID or password does not match.");
}
$conn->close();

?>