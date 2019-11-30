<?php
require_once "mysql_entities_fix_string.php";
$play = $_GET["playid"];
$c = $_GET["cinema"];
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);
$query = "select * from movie_list where play_id='$play'";
$userInfo = $conn->query($query);
if($userInfo->num_rows > 0){
	while($row = $userInfo->fetch_assoc()){
		echo "<h1>Choose your seat.</h1><br><h2>In ";
		echo $c;
		echo "</h2><br><p>Time:";
		echo $row["start_time"];
		echo " - ";
		echo $row["end_time"];
		echo "</p>";
	}
}
$query = "select * from seat where play_list='$play'";
$userInfo = $conn->query($query);
echo "<div style='width:100px'>";
if($userInfo->num_rows > 0){
	while($row = $userInfo->fetch_assoc()){
		if($row["seat_state"]==1){
			echo "<lable style='color:black'>";
			echo $row["seat_number"];
			echo "</lable><form action='bought.php' method='get'><input name='seatid' type='hidden' value=";
			echo $row["seat_id"];
			echo "><input type='submit' value='book' ></form>";
		} else {
			echo "<lable style='color:red'>";
			echo $row["seat_number"];
			echo "</lable><br><br>";
		}
	}
}
echo "</div>";
?>