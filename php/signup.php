<?php
require_once "mysql_entities_fix_string.php";
require_once "../user/users.php";
$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);

$pwd = mysql_entities_fix_string($conn,$_POST["pwd"]);

if(empty($pwd)) die("Sign up failed! You must use password");

$query = "INSERT INTO usr VALUES(user_id,'$pwd')";
if($conn->query($query) === true){
    echo "<h1>Welcome to My Threat~</h1><a style='yellow'>Let's watch movie together!</a>";
}else {
    echo "Sign up Failed! Something wrong! Please try again!<br>";
}
$id = mysqli_insert_id($conn);
echo "YOUR id is: <h1>'$id'</h1><br>Please never forget!";
$conn->close();
?>