<?php
session_start();

// The loggedInUser object. 
$loggedInUser = (object) array(
	'fullname' => getUserName($_SESSION['loggedinuser']),
	'username' => $_SESSION['loggedinuser'],
	'weight' => getUserWeight($_SESSION['loggedinuser']),
	'avatar' => getUserAvatar($_SESSION['loggedinuser']),
	'firstname' => getUserFirstName($_SESSION['loggedinuser']),
	'lastname' => getUserLastName($_SESSION['loggedinuser']),
	'weighttype' => getUserWeightType($_SESSION['loggedinuser']),
	'height' => getUserHeight($_SESSION['loggedinuser']),
	'heighttype' => getUserHeightType($_SESSION['loggedinuser']),
	'heightfeet' => getUserHeightInFeet($_SESSION['loggedinuser']),
	'avatar' => getUserAvatar($_SESSION['loggedinuser']),
	'coverPhoto' => getUserCover($_SESSION['loggedinuser']),
	'accountType' => getAccountType($_SESSION['loggedinuser']),
	'birthdate' => getUserBirthdate($_SESSION['loggedinuser']),
	'dispWeight' => getDisplayWeight($_SESSION['loggedinuser']),
	'dispHeight' => getDisplayHeight($_SESSION['loggedinuser']),
	'dispAct' => getDisplayAct($_SESSION['loggedinuser']),
	'dispDob' => getDisplayDob($_SESSION['loggedinuser']),
	'activity' => getPrimaryActivity($_SESSION['loggedinuser'])
);
?>