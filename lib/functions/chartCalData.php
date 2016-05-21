<?php
session_start();
include '../../config.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

	 $sql = "SELECT * FROM history WHERE owner = '".$_GET['user']."' GROUP BY dateadded";
	 $result = mysqli_query($con,$sql);
	 
	 $prefix = '';
echo "[\n";
while ( $row = mysqli_fetch_array( $result ) ) {
  echo $prefix . " {\n";
  echo '  "category": "' . $row['dateadded'] . '",' . "\n";
  echo '  "value1": ' . $row['calories'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";
?>