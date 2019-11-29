<?php
require_once "mysql_entities_fix_string.php";
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);
$key = mysql_entities_fix_string($conn,$_GET["mykey"]);

$query = "SELECT * FROM movie WHERE movie_name like '%$key%'";

$userInfo = $conn->query($query);
$userInfo = $userInfo->num_rows;

$i = 0;

echo "<div style='margin:100px auto;'>
			<p><b>Search</b> the movie by Movie Name</p><br>
			<form action='search.php' method='get'>
				<input type='search' name='mykey'/>
				<input type='submit' value='search' />
			</form>
		</div>";



if($userInfo){
	while($row = $userInfo->fetch_assoc()){
		echo "<div style='height: 6.25rem;width: 100%;padding-left:12.5rem;padding-right: 6.25rem;position: relative;margin-top:20px;' title='$row[$i]['movie_name']'>
			<div style='position: absolute;'>
				<img src='$row[$i]['movie_cover']' style='height: 6.25rem;'/>
			</div>
			<div style='margin-left: 5rem;'>
				<p><a href='../movie.php?id='$row[$i]['movie_id']''>'$row[$i]['movie_name']'</a></p>
				<p><a>'$row[$i]['movie_sort']'</a></p>
				<p><a href='../movie.php?id='$row[$i]['movie_id']''>'$row[$i]['movie_info']'</a></p>
			</div>
		</div>";
		$i++;
	}
} else {
	echo "<p>We have no movie name like '$key'<p>";
}

?>