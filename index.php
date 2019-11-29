<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>WYZ Cinema</title>
    </head>
    <body>
        <div id="sign" style="height=100px;width=100px;margin-top:200px;margin-left:100px;">
             <button onclick="signin()">sign in</button>
             <button onclick="signup()">sign up</button>
             <button onclick="signout()">sign out</button>
        </div>
        <div id="signform" style="width: 31.25rem;height: 18.75rem;margin:250px auto;border:0.0625rem solid #000000;">
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
        <script>
            function signin(){
                document.getElementById("inform").style.display="block";
            }
            function signup(){
                document.getElementById("upform").style.display="block";
            }
        </script>
    </body>
</html>
