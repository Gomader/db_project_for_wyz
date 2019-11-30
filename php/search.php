<?php
require_once "mysql_entities_fix_string.php";
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);
$key = mysql_entities_fix_string($conn,$_GET["mykey"]);

$query = "SELECT * FROM movie WHERE movie_name like '%$key%'";

$userInfo = $conn->query($query);

echo "<div style='margin:100px auto;'>
			<p><b>Search</b> the movie by Movie Name</p><br>
			<form action='search.php' method='get'>
				<input type='search' name='mykey'/>
				<input type='submit' value='search' />
			</form>
		</div>";

if($userInfo->num_rows > 0){
	while($row = $userInfo->fetch_assoc()){
		echo "<div style='height: 6.25rem;width: 100%;padding-left:12.5rem;padding-right: 6.25rem;position: relative;margin-top:20px;' title='";
		echo $row["movie_name"];
		echo "'>
			<div style='position: absolute;'>
				<img src='";
		echo $row["movie_cover"];
		echo "' style='height: 6.25rem;'/>
			</div>
			<div style='margin-left: 5rem;'>
				<p><a href='../movie.php?id=";
		echo $row["movie_id"];
		echo "'>" ;
		echo $row["movie_name"];
		echo "</a></p>
				<p><a>";
		echo $row["movie_sort"];
		echo "</a></p>
				<p><a href='../movie.php?id=";
		echo $row["movie_id"];
		echo "' style=''>";
		echo $row["movie_info"];
		echo "</a></p>
			</div>
		</div>";
	}
} else {
	echo "<p>We have no movie name like '$key'<p>";
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