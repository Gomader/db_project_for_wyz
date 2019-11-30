<?php
$id = $_GET["seatid"];
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);
$query = "update seat set seat_state = false where seat_id = '$id'";
$userInfo = $conn->query($query);
echo "Ticketed!!";
echo '<meta http-equiv = "refresh"; content = "5;url = ../index.php">';

?>