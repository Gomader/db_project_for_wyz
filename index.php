<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>WYZ Cinema</title>
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
		<a href="cinema.php"><h1>Let's buy tickets!</h1></a>
        <div id="bts" style="height=100px;width=100px;margin-top:200px;margin-left:100px;">
			<?php
			if(!$_SESSION){
				echo "<button onclick='signin()'>sign in</button>
            <button onclick='signup()'>sign up</button>";
			} else {
				echo "<b>Welcome back ";
				echo $_SESSION["id"];
				echo "</b><br><a href='mypage.php'>Click To my Page</a><form action='php/signout.php' method='get'><input type='submit' value='sign out'></form>";
			}
			?>
        </div>
        <div id="signform" style="width: 31.25rem;height: 18.75rem;margin:250px auto;border:0.0625rem solid #000000;text-align: center;">
            <form action="php/signin.php" id="inform" method="post" style="display:none;">
                <label>ID:       </label><input type="text " name="username"><br>
                <label>Password: </label><input type="password" name="password"><br>
                <input type="submit" value="Sign In"/>
            </form>
              

            <form action="php/signup.php" method="post" id="upform" style="display:none;">
                <label>ID: You don't need ID, if you want to play with us, we will give you an ID and you just need a password, and you can use ID and password sign in.</label><br>
                <label>Password: </label><input type="password" name="pwd"/><br>
                <input type="submit" value="Sign Up"/>
            </form>
        </div>
		<div style="position: absolute;top:500px;left: 70%;">
			<p><b>Search</b> the movie by Movie Name</p><br>
			<form action="php/search.php" method="get">
				<input type="search" name="mykey"/>
				<input type="submit" value="search" />
			</form>
		</div>
		<div style="position: relative;width: 70%;margin: 20px auto;margin-bottom: 3.125rem;">
			<div style="width: 40%;position: absolute;border: 1px solid black;top: 1.25rem;">
				<h2>Top movie</h2>
				<?php
				require_once "php/mysql_entities_fix_string.php";
				require_once "user/users.php";
				$conn = new mysqli($hn,$un,$pw,$db);
				if ($conn->connect_error) die($conn->connect_error);
				$query = "SELECT * FROM movie order by movie_sort desc";
				$userInfo = $conn->query($query);				
				if($userInfo->num_rows > 0){
					while($row = $userInfo->fetch_assoc()){
						echo "<div style='width:100%;height:50px;position:relative;margin-top:5px'><img src='";
						echo $row["movie_cover"];
						echo "' style='height:50px;position:absolute;'/><a href='movie.php?id=";
						echo $row["movie_id"];
						echo "'>";
						echo $row["movie_name"];
						echo " ";
						echo $row["movie_sort"];
						echo "</a></div>";
					}
				}
				?>	
			</div>
			<div style="width: 40%;position: absolute;left: 60%;border: 1px solid black;top:1.25rem">
				<h2>All the drama movies</h2>
				<?php
				require_once "php/mysql_entities_fix_string.php";
				require_once "user/users.php";
				$conn = new mysqli($hn,$un,$pw,$db);
				if ($conn->connect_error) die($conn->connect_error);
				$query = "SELECT * FROM movie where movie_genre like '%Drama%'";
				$userInfo = $conn->query($query);
				if($userInfo->num_rows > 0){
					while($row = $userInfo->fetch_assoc()){
						echo "<div style='width:100%;height:50px;position:relative;margin-top:5px'><img src='";
						echo $row["movie_cover"];
						echo "' style='height:50px;position:absolute;'/><a href='movie.php?id=";
						echo $row["movie_id"];
						echo "'>";
						echo $row["movie_name"];
						echo " ";
						echo $row["movie_sort"];
						echo "</a></div>";
					}
				}
				?>	
			</div>
		</div>
		<script>
			function signin(){
			    document.getElementById("inform").style.display="block";
			    document.getElementById("upform").style.display="none";
			    console.log("A");
			}
			function signup(){
			    document.getElementById("upform").style.display="block";
			    document.getElementById("inform").style.display="none";
			}
		</script>
    </body>
</html>
