<?php
session_start();
include '../../config.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$dispDob = $_POST['dispDob'];
$activity = $_POST['activity'];
$dispAct = $_POST['dispAct'];
$weight = $_POST['weight'];
$dispWeight = $_POST['dispWeight'];
$weightType = $_POST['weighttype'];
$height = $_POST['height'];
$dispHeight = $_POST['dispHeight'];

            
	 global $con, $location;
	 
	 $sql = "UPDATE users SET weight = '$weight', birthdate = '$birthdate', dispDob = '$dispDob', dispWeight = '$dispWeight', dispAct = '$dispAct', dispHeight = '$dispHeight', height = '$height', firstname = '$firstname', lastname = '$lastname' WHERE username = '".$_SESSION['loggedinuser']."'";
	 $result = mysqli_query($con,$sql);
	 
	 if($result){
		echo 'Successfully updated profile.';	
	 }else{
	 	echo 'There was an error updating your profile.';
	
	 }

	 $sql = "SELECT * FROM activities WHERE id = '$activity'";
	 $result = mysqli_query($con,$sql);
	 
	 while($row = mysqli_fetch_array($result)){
	 	$sql = "INSERT INTO userActivities (activity, owner, position, type) 
	 	VALUES ('".$row['activity']."', '".$_SESSION['loggedinuser']."', '".$row['position']."', '".$row['type']."')";
	 	$result = mysqli_query($con,$sql);
	 	if($result){
	 		
	 	}
	 }
	
	
?>