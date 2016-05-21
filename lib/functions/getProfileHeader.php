<?php
session_start();
include '../../config.php';
include 'functions.php';
include '../classes/classes.php';

// Init the database, and leave the connection open.
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname");
if(!$con){
	echo mysqli_error($con);
}

	 ?>
	<div id="avatar" style="background-image:url('<?php echo $loggedInUser->avatar; ?>');">

			</div>
			<h2><?php echo $loggedInUser->fullname; ?></h2>
			<p class="headerActivities">
			<?php if($loggedInUser->dispAct == 'Display'){
				?>
				<b>Primary Activity:</b> <?php echo ''.$loggedInUser->activity; ?>
				<?php } ?>

				<?php if($loggedInUser->dispHeight == 'Display'){
				?>
				<b>Height:</b> <?php echo $loggedInUser->heightfeet; ?>
				<br />
				<?php } ?>

				<?php if($loggedInUser->dispWeight == 'Display'){
				?>
				<b>Weight:</b> <?php echo $loggedInUser->weight . ' ' . $loggedInUser->weighttype; ?>
<?php } ?>
		</p>

	<?php		
	
?>