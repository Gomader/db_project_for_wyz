<?php
session_start();
if(is_array($_GET)&&count($_GET)>0){
	require_once "php/mysql_entities_fix_string.php";
	require_once "user/users.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if ($conn->connect_error) die($conn->connect_error);
	$cinema = $_GET["cinema"];
	echo "<div style='width:100%;text-align:center'><h1>";
	echo $cinema;
	echo "</h1></div>";
	$query = "select * from movie order by movie_id;";
	$userInfo = $conn->query($query);
	$i=0;
	$mv;
	if($userInfo->num_rows > 0){
		while($row = $userInfo->fetch_assoc()){
			$mv[$i][0] = $row["movie_id"];
			$mv[$i][1] = $row["movie_name"];
			$mv[$i][2] = $row["movie_cover"];
			$i++;
		}
	}
	$query = "SELECT distinct * FROM screening_room where cinema='$cinema'";
	$userInfo = $conn->query($query);
	$room;
	$seat;
	$i = 0;
	if($userInfo->num_rows > 0){
		while($row = $userInfo->fetch_assoc()){
			$room[$i] = $row["room_id"];
			$i++;
		}
		for($j=0;$j<$i;$j++){
			$query = "SELECT * FROM movie_list where room_id='$room[$j]'";
			$userInfo = $conn->query($query);
			if($userInfo->num_rows > 0){
				while($row = $userInfo->fetch_assoc()){
					echo "<div style='width: 40%;border: 1px solid black;top: 1.25rem;'><div style='width:100%;height:100px;position:relative;margin-top:5px'><img src='";
					echo $mv[$row["movie_id"]][2];
					echo "' style='height:100px;position:absolute;'/><a style='margin-left:100px' href='movie.php?id=";
					echo $row["movie_id"];
					echo "'>";
					echo $mv[$row["movie_id"]][1];
					echo "</a><p style='margin-left:100px'>";
					echo $row['start_time'];
					echo " - ";
					echo $row['end_time'];
					echo "</p></div><form action='php/buy.php' method='get'><input name='playid' type='hidden' value=";
					echo $row["play_id"];
					echo "><input name='cinema' type='hidden' value=";
					echo $_GET['cinema'];
					echo "><input type='submit' value='See seat'></form></div>";

				}
			} else {
				
			}
			
		}
	}
} else {
	require_once "php/mysql_entities_fix_string.php";
	require_once "user/users.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if ($conn->connect_error) die($conn->connect_error);
	$query = "SELECT distinct room_id FROM movie_list ";
	$userInfo = $conn->query($query);
	$data;
	$i = 0;
	if($userInfo->num_rows > 0){
		while($row = $userInfo->fetch_assoc()){
			$data[$i] = $row["room_id"];
			$i++;
		}
	}
	echo "<div style='width:100$;text-align:center'><h1>Which cinema do you want to go?</h1>";
	for($j=0;$j<$i;$j++){
		$query = "SELECT cinema FROM screening_room where room_id = '$data[$j]' ";
		$userInfo = $conn->query($query);
		if($userInfo->num_rows > 0){
			while($row = $userInfo->fetch_assoc()){
				echo "<form action='cinema.php' method='get'><input name='cinema' type='hidden' value=";
				echo $row['cinema'];
				echo "><input type='submit' value=";
				echo $row['cinema'];
				echo "></form>";
			}
		} else {
			echo '1';
		}
	}
	echo "</div>";
}
?>
<style>
			a{
				text-decoration:none;
				color:black;
			}
			a:hover{
				color: #000000;
			}
</style>