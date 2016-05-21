<?php
session_start();
include '../../config.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

$fdata=$_FILES['files'];
$name = $fdata['name'];  
$temp_name = $fdata['tmp_name']; 
$location = '/var/www/html/shakebot';  
            
if (!file_exists($location.'/tmp/'.$_SESSION['loggedinuser'])) {
        mkdir($location.'/tmp/'.$_SESSION['loggedinuser'], 0777, true);
    }    
            
if(move_uploaded_file($temp_name, $location.'/tmp/'.$_SESSION['loggedinuser'].'/'.$name)){
    $filename = '/tmp/'.$_SESSION['loggedinuser'].'/'.$name;
	
	 global $con, $location;
	 
	 $sql = "UPDATE users SET avatar = '".$filename."' WHERE username = '".$_SESSION['loggedinuser']."'";
	 $result = mysqli_query($con,$sql);
	 
	 if($result){
		echo $siteurl.$filename;
	 }else{
		echo 'We\'re sorry.  Your upload has failed.  Please ensure the file is not corrupted and try refreshing this page, and have another go at it.';
	 }
	
	}
?>