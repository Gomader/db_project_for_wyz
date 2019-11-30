<?php
session_start();
if($_SESSION){
	require_once "php/mysql_entities_fix_string.php";
	require_once "user/users.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if ($conn->connect_error) die($conn->connect_error);
	$m = mysql_entities_fix_string($conn,$_GET["id"]);
	$u = $_SESSION["id"];
	$query = "insert into history(history_id,user_id,movie_id) values(history_id,'$u','$m')";
	$conn->query($query);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Movie</title>
		<script src="js/jquery-1.12.4.min.js"></script>
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
		<div style="margin: 1.25rem auto;text-align: center;">
			<p><b>Search</b> the movie by Movie Name</p><br>
			<form action="php/search.php" method="get">
				<input type="search" name="mykey"/>
				<input type="submit" value="search" />
			</form>
		</div>
		<div style="width: 70%;margin:3.125rem auto;min-height: 20rem;">
			<?php
			require_once "php/mysql_entities_fix_string.php";
			require_once "user/users.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if ($conn->connect_error) die($conn->connect_error);
			$id = mysql_entities_fix_string($conn,$_GET["id"]);
			$query = "SELECT * FROM movie WHERE movie_id = '$id'";
			$userInfo = $conn->query($query);
			if($userInfo->num_rows > 0){
				while($row = $userInfo->fetch_assoc()){
					echo "<img src=";
					echo $row["movie_cover"];
					echo " style='position: absolute;height: 18.75rem;'/><div style='margin-left: 18.75rem;'><p>Name: ";
					echo $row["movie_name"];
					echo "</p><br><p>Genre: ";
					echo $row["movie_genre"];
					echo "</p><br><p>";
					echo $row["movie_info"];
					echo "</p></div>";
					echo "<script>document.title = \"".$row["movie_name"]."\" </script>";
				}
			} else {
				echo '<meta http-equiv = "refresh"; content = "1;url = index.php">';
			}
			?>
		</div>
		
		<div style="width: 1.25rem;height: 0.625rem;margin: 0.625rem auto;margin-bottom: 0.625rem;">
		<?php
		if($_SESSION){
			require_once "php/mysql_entities_fix_string.php";
			require_once "user/users.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if ($conn->connect_error) die($conn->connect_error);
			$id = mysql_entities_fix_string($conn,$_GET["id"]);
			$user = $_SESSION["id"];
			$query = "SELECT like_id FROM like_list WHERE user_id = '$user' and movie_id = '$id'";
			$userInfo = $conn->query($query);
			if($userInfo->num_rows > 0){
				echo "<form action='php/unlike.php' method='get'><input name='movie' type='hidden' value='";
				echo $id;
				echo "'/><input type='submit' value='Unlike'/>";
			} else {
				echo "<form action='php/like.php' method='get'><input name='movie' type='hidden' value='";
				echo $id;
				echo "'/><input type='submit' value='Like'/>";
			}
			echo "</form>";
		} else {
			echo "><a href='index.php'>Like</a>";
		}
		?>
		</div>
		<div style="width: 100%;text-align: center;margin-top: 2rem;">
			<?php
			require_once "php/mysql_entities_fix_string.php";
			require_once "user/users.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if ($conn->connect_error) die($conn->connect_error);
			$id = mysql_entities_fix_string($conn,$_GET["id"]);
			$query = "SELECT * FROM movie WHERE movie_id = '$id'";
			$userInfo = $conn->query($query);
			if($userInfo->num_rows > 0){
				while($row = $userInfo->fetch_assoc()){
					echo "<a href='";
					echo $row["movie_trailer"];
					echo "'>To see the trailer<br>";
					echo "<img src='";
					echo $row["movie_trailer_image"];
					echo "' style='height:300px;'/></a>";
				}
			} else {
				echo "#";
			}
			?>
			
		</div>
		<div style="width: 100%;margin: 20px auto;text-align: center;">
			<?php
			if($_SESSION){
				echo "<p>Write review after watching Movie!</p><form action='php/review.php?movie=";
				echo $_GET["id"];
				echo "' method='post'><textarea cols='80' rows='4' style='OVERFLOW: hidden' id='reviewinner' maxlength='200' name='review'></textarea><br><input type='submit' value='Add Review'/></form>";
			} else {
				echo "<p>Please <a href='index.php'>sign in</a> first</p>";
			}
			?>
		</div>
		<div style="width: 70%;text-align: center;margin: 0.625rem auto;">
			<p>Reviews:</p>
			<?php
			require_once "php/mysql_entities_fix_string.php";
			require_once "user/users.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if ($conn->connect_error) die($conn->connect_error);
			$m = mysql_entities_fix_string($conn,$_GET["id"]);
			
			$query = "SELECT * FROM comment where movie_id = '$m'";
			
			$userInfo = $conn->query($query);
			
			if($userInfo->num_rows > 0){
				while($row = $userInfo->fetch_assoc()){
					echo "<div style='width: 100%;min-height: 6.25rem;border: 1px solid lightgrey;text-align: left;margin-top:20px;padding-left:20px;padding-right:20px'><p>";
					echo $row["user_id"];
					echo "</p><p>";
					echo $row["review"];
					echo "</p>";
					echo "<p style='text-align:right'>";
					echo $row["upload_time"];
					echo "</p></div>";
				}
			} else {
				echo "<h3>There are no review has been add!</h3><br>Come on add your review!<h2></h2>";
			}
			?>
		</div>
	</body>
</html>