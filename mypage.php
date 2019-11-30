<?php
session_start();
if(!$_SESSION){
	echo '<meta http-equiv = "refresh"; content = "1;url = index.php">';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My page</title>
		<style>
			a{
				text-decoration:none;
				color:black;
			}
			a:hover{
				color: #000000;
			}
		</style>
	</head>
	<body>
		<div style="width: 100%;text-align: center;">
			<p>Welcome back <?php
			echo $_SESSION["id"];
			?></p>
		</div>
		<div style="position: relative;width: 70%;margin: 20px auto;margin-bottom: 3.125rem;">
			<div style="width: 40%;border: 1px solid black;top: 1.25rem;">
				<h2>Like List</h2>
				<?php
				require_once "php/mysql_entities_fix_string.php";
				require_once "user/users.php";
				$conn = new mysqli($hn,$un,$pw,$db);
				if ($conn->connect_error) die($conn->connect_error);
				$d = $_SESSION["id"];
				$query = "SELECT * FROM like_list where user_id = '$d' order by like_id desc";
				$userInfo = $conn->query($query);
				$data;
				$j = 0;
				if($userInfo->num_rows > 0){
					while($row = $userInfo->fetch_assoc()){
						$data[$j] = $row["movie_id"];
						$j++;
					}
					for($i=0;$i<$j;$i++){
						$mv = $data[$i];
						$query = "SELECT * FROM movie where movie_id = '$mv'";
						$userInfo = $conn->query($query);
						if($userInfo->num_rows > 0){
							while($row = $userInfo->fetch_assoc()){
								echo "<div style='width:100%;height:50px;position:relative;margin-top:5px'><img src='";
								echo $row["movie_cover"];
								echo "' style='height:50px;position:absolute;'/><a style='margin-left:60px' href='movie.php?id=";
								echo $row["movie_id"];
								echo "'>";
								echo $row["movie_name"];
								echo " ";
								echo $row["movie_sort"];
								echo "</a></div>";
								
								$i++;
							}
						}
					}
				} else {
					echo "<p>null<p>";
				}
				?>	
			</div>
			<div style="width: 40%;border: 1px solid black;top: 1.25rem; margin-top: 1.25rem;">
				<h2>My Review</h2>
				<?php
				require_once "php/mysql_entities_fix_string.php";
				require_once "user/users.php";
				$conn = new mysqli($hn,$un,$pw,$db);
				if ($conn->connect_error) die($conn->connect_error);
				$d = $_SESSION["id"];
				$query = "SELECT * FROM comment where user_id = '$d' order by comment_id desc";
				$userInfo = $conn->query($query);
				$data;
				$time;
				$view;
				$j = 0;
				if($userInfo->num_rows > 0){
					while($row = $userInfo->fetch_assoc()){
						$data[$j] = $row["movie_id"];
						$time[$j] = $row["upload_time"];
						$view[$j] = $row["review"];
						$j++;
					}
					for($i=0;$i<$j;$i++){
						$mv = $data[$i];
						$query = "SELECT * FROM movie where movie_id = '$mv'";
						$userInfo = $conn->query($query);
						if($userInfo->num_rows > 0){
							while($row = $userInfo->fetch_assoc()){
								echo "<div style='width:100%;height:50px;position:relative;margin-top:5px'><img src='";
								echo $row["movie_cover"];
								echo "' style='height:50px;position:absolute;'/><a style='margin-left:60px' href='movie.php?id=";
								echo $row["movie_id"];
								echo "'>";
								echo $row["movie_name"];
								echo " ";
								echo $view[$i];
								echo "</a><br><a style='margin-left:60px'>";
								echo $time[$i];
								echo "</a></div>";
								$i++;
							}
						}
					}
				} else {
					echo "<p>null<p>";
				}
				?>	
			</div>
			<div style="width: 40%;position: absolute;left: 60%;border: 1px solid black;top:1.25rem">
				<h2>History</h2>
				<?php
				require_once "php/mysql_entities_fix_string.php";
				require_once "user/users.php";
				$conn = new mysqli($hn,$un,$pw,$db);
				if ($conn->connect_error) die($conn->connect_error);
				$d = $_SESSION["id"];
				$query = "SELECT * FROM history where user_id = '$d' order by history_time desc";
				$userInfo = $conn->query($query);
				$data;
				$time;
				$j = 0;
				if($userInfo->num_rows > 0){
					while($row = $userInfo->fetch_assoc()){
						$data[$j] = $row["movie_id"];
						$time[$j] = $row["history_time"];
						$j++;
					}
					for($i=0;$i<$j;$i++){
						$mv = $data[$i];
						$query = "SELECT * FROM movie where movie_id = '$mv'";
						$userInfo = $conn->query($query);
						if($userInfo->num_rows > 0){
							while($row = $userInfo->fetch_assoc()){
								echo "<div style='width:100%;height:50px;position:relative;margin-top:5px'><img src='";
								echo $row["movie_cover"];
								echo "' style='height:50px;position:absolute;'/><a style='margin-left:60px' href='movie.php?id=";
								echo $row["movie_id"];
								echo "'>";
								echo $row["movie_name"];
								echo " ";
								echo $row["movie_sort"];
								echo "</a><br><a style='margin-left:60px'>";
								echo $time[$i];
								echo "</a></div>";
								$i++;
							}
						}
					}
				} else {
					echo "<p>null<p>";
				}
				
				?>
			</div>
		</div>
	</body>
</html>