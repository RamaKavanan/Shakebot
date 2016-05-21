<?php
session_start();

$loggedInUser = (object) array(
	'name' => getUserName($_SESSION['loggedinuser']),
	'username' => $_SESSION['loggedinuser'],
	'weight' => getUserWeight($_SESSION['loggedinuser']),
	'avatar' => getUserAvatar($_SESSION['loggedinuser'])
);

$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if($con){
	echo 'success';
}else{
	echo mysqli_error($con);
}

function getUserName($user){
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo $row['firstname'] . ' ' . $row['lastname'];
	}

}

function getUserWeight($user){
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo $row['weight'];
	}

}

function getUserAvatar($user){
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo $row['avatar'];
	}

}

?>