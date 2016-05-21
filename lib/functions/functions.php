<?php
session_start();
include '../../config.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

function getUserName($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['firstname'] . ' ' . $row['lastname'];
	}

}

function getUserFirstName($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['firstname'];
	}

}

function getUserCover($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['cover'];
	}
}

function getUserLastName($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['lastname'];
	}

}

function getUserWeightType($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['weighttype'];
	}

}

function getUserHeightType($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['heighttype'];
	}

}

function getUserHeight($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['height'];
	}

}

function getUserWeight($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['weight'];
	}

}

function getPrimaryActivity($user){
	global $con;
	$sql = "SELECT * FROM userActivities WHERE owner = '$user' ORDER BY id Desc LIMIT 1";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['activity'].' - '.$row['position'];
	}


}

function getWeightHistory($user){
	global $con;
	$sql = "SELECT * FROM history WHERE owner = '$user' GROUP BY dateadded ORDER BY id Desc";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo '<tr>';
		
		echo '<td>'.$row['dateadded'].'</td><td>'.$row['weight'].'</td>';

		echo '</tr>';
	}
}

function getUserHeightInFeet($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		
		if($row['heighttype'] == 'inches'){
			$height = $row['height'] / 12;
			$newheight = explode('.', $height);
			$leftover = round($newheight[1] / 100 * 12) * 10;
			$unrounded = str_split($newheight[1], 2);
			if($unrounded[0] >= 83){
			$newleftover = str_split($leftover, 2);
			}else{
			$newleftover = str_split($leftover, 1);
			}
			return $newheight[0] . '\'' . $newleftover[0] . '"';
		}
		}
	}


function getUserAvatar($user){
	global $con,$siteurl;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	$default = $siteurl.'/img/defaultAvatar.jpeg';
	
	while($row = mysqli_fetch_array($result)){
		if($row['avatar']!=''){
			return $row['avatar'];
		}else{
			return $default;			
		}
	}

}

function getAccountType($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		return $row['type'];
	}
}

function getUserActivities(){
	global $con;
	$sql = "SELECT * FROM userActivities WHERE owner = '".$_SESSION['loggedinuser']."'";
	$result = mysqli_query($con,$sql);
	$activities = array();
	while($row = mysqli_fetch_array($result)){
		$activities[] = $row['activity'];
		
	}
	

	foreach($activities as $activity){
		echo $activity . '<br />';
	}
}

function getActivities(){
	global $con;
	$sql = "SELECT * FROM activities";
	$result = mysqli_query($con,$sql);
	
	echo '<option value="0">Primary Activity</option>';
	while($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['type'].'">'.$row['activity'].' - '.$row['position'].'</option>';
	}
}

function getActivityHistory($user){
		global $con;
	$sql = "SELECT * FROM history WHERE owner = '$user' GROUP BY dateadded ORDER BY id desc";
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){
	echo '<tr><td>'.$row['dateadded'].'</td><td>'.$row['activity'].'</td><td>'.$row['type'].'</td></tr>';
	}
}

function getProfileActivities(){
	global $con;
	$sql = "SELECT * FROM activities";
	$result = mysqli_query($con,$sql);
	echo '<option value="0" selected="selected">Primary Activity</option>';
	while($row = mysqli_fetch_array($result)){		
		echo '<option value="'.$row['id'].'">'.$row['activity'].' - '.$row['position'].'</option>';
	}
	
}

function getUserBirthdate($user){
		global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
	return $row['birthdate'];
	}
}

function getAverageStats($user){		
	global $con;
	$today = date("Y-m-d");
	$week = date("Y-m-d", time() - 60 * 60 * 24 * 7);
	$sql2 = "SELECT * FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result2 = mysqli_query($con,$sql2);
	$count = mysqli_num_rows($result2);

	$sql = "SELECT Sum(weight) as 'newWeight' FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result = mysqli_query($con,$sql);
	$weight = mysqli_fetch_array($result);
	$newWeight = $weight['newWeight'] / $count;

	$sql = "SELECT Sum(calories) as 'newCal' FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result = mysqli_query($con,$sql);
	$cal = mysqli_fetch_array($result);
	$newCal = $cal['newCal'] / $count;

	$sql = "SELECT Sum(protein) as 'newPro' FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result = mysqli_query($con,$sql);
	$pro = mysqli_fetch_array($result);
	$newPro = $pro['newPro'] / $count;

	$sql = "SELECT Sum(fat) as 'newFat' FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result = mysqli_query($con,$sql);
	$fat = mysqli_fetch_array($result);
	$newFat = $fat['newFat'] / $count;
	
	$sql = "SELECT Sum(carb) as 'newCarb' FROM history WHERE owner = '$user' AND dateadded > '$week'";
	$result = mysqli_query($con,$sql);
	$carb = mysqli_fetch_array($result);
	$newCarb = $carb['newCarb'] / $count;


	

	echo '<div class="recentContainer">';
	echo '<div class="recentTile">Calories<br />';
	echo $newCal;
	echo '</div>';

	echo '<div class="recentTile">Weight<br />';
	echo $newWeight;
	echo '</div>';

	echo '<div class="recentTile">Protein<br />';
	echo $newPro;
	echo '</div>';

	echo '<div class="recentTile">Fat<br />';
	echo $newFat;
	echo '</div>';

	echo '<div class="recentTile">Carbohydrates<br />';
	echo $newCarb;
	echo '</div>';
	
	echo '</div>';
}



function getLatestStats($user){		
	global $con;
	$today = date("Y-m-d");
	$week = date("Y-m-d", time() - 60 * 60 * 24 * 7);
	$sql = "SELECT * FROM history WHERE owner = '$user' ORDER BY id DESC LIMIT 1'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){

	echo '<div class="recentContainer">';
	echo '<div class="recentTile">Calories<br />';
	echo $row['calories'];
	echo '</div>';

	echo '<div class="recentTile">Weight<br />';
	echo $row['weight'];
	echo '</div>';

	echo '<div class="recentTile">Protein<br />';
	echo $row['protein'];
	echo '</div>';

	echo '<div class="recentTile">Fat<br />';
	echo $row['fat'];
	echo '</div>';

	echo '<div class="recentTile">Carbohydrates<br />';
	echo $row['carb'];
	echo '</div>';
	
	echo '</div>';

}
}

function getDisplayWeight($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
	return $row['dispWeight'];
	}
}


function getDisplayHeight($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
	return $row['dispHeight'];
	}
}


function getDisplayAct($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
	return $row['dispAct'];
	}
}


function getDisplayDob($user){
	global $con;
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
	return $row['dispDob'];
	}
}

function getResearchArticles(){
		global $con;
	$sql = "SELECT * FROM research";
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)){
	echo '<a href="'.$row['url'].'" target="_blank"><div class="researchContainer"><h3 class="articleTitle">'.$row['title'].'</h3>';
	echo '<div class="researchSummary">'.$row['summary'].'<br /><br /><b>Click to see full article</b></div>';
	echo '</div></a>';
	}
}

function getPrimaryActivities(){

}



if($_POST['action'] == 'upload-avatar'){
global $con;
$fdata=$_FILES['files'];

$name = $fdata['name'];  
$temp_name = $fdata['tmp_name']; 
$location = '/var/www/html/shakebot';  

	if(!file_exists($location.'/img/'.$_SESSION['loggedinuser'])) {
		mkdir($location.'/img/'.$_SESSION['loggedinuser'], 0777, true);
	}    
	
	if(move_uploaded_file($temp_name, $location.'/tmp/'.$_SESSION['loggedinuser'].'/'.$name)){
		$filename = '/img/'.$_SESSION['loggedinuser'].'/'.$name;
		$filename = mysqli_real_escape_string($con,$filename);

		$sql = "UPDATE users SET avatar = '$filename'";
		$result = mysqli_query($con,$sql);

		if($result){
			echo 'success';
		}


	}
}
?>
