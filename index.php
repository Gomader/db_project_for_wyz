<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>WYZ Cinema</title>

    </head>
    <body>
        <div id="bts" style="height=100px;width=100px;margin-top:200px;margin-left:100px;">
			<?php
			if(!$_SESSION){
				echo "<button onclick='signin()'>sign in</button>
            <button onclick='signup()'>sign up</button>";
			} else {
				echo "<b>Welcome back<b><br><form action='php/signout.php' method='get'><input type='submit' value='sign out'></form>";
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
