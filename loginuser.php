<?php
// Debug
/*
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
*/
// End Debug

include 'config.php';


// Connect to server and select databse.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(mysqli_connect_errno($con)){
		echo "Failed to connect to the database: ". mysqli_connect_error();	
	}

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
/*$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($myusername);
$mypassword = mysqli_real_escape_string($mypassword);*/
$sql = "SELECT * FROM users WHERE username='".$myusername."' and password = md5('".$mypassword."')";
$result = mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_start();
$_SESSION["loggedinuser"] = $_POST['myusername'];
$_SESSION['myusername'] = $_POST['myusername'];


header("location:/#/profile");
echo $_SESSION['loggedinuser'];
}
else {
header("location:signin.php?login=failed");
}
?>
