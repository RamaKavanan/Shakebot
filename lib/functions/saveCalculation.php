<?php
session_start();
include '../../config.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

$pro = $_GET['pro'];
$fat = $_GET['fat'];
$carb = $_GET['carb'];
$bcaa = $_GET['bcaa'];
$cal = $_GET['cal'];
$activity = $_GET['activity'];
$type = $_GET['type'];
$weight = $_GET['weight']; 
            
	 global $con, $location;
	 
	 $sql = "UPDATE users SET weight = '$weight' WHERE username = '".$_SESSION['loggedinuser']."'";
	 $result = mysqli_query($con,$sql);
	 
	 if($result){
		
	 }else{
	 }

	 $sql = "INSERT INTO history (owner, calories, protein, fat, carbs, weight, dateadded, activity, type)
	 VALUES ('".$_SESSION['loggedinuser']."', '$cal', '$pro', '$fat', '$carb', '$weight', NOW(), '$activity', '$type')";
	 $result = mysqli_query($con,$sql);
	 
	 if($result){
		
	 }else{
	 }
	
	
?>