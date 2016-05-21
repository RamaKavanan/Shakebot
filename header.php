<?php
session_start();
?>
<html>
<head>
	<title>Shakebot</title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="css/swag.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,400,300,700' rel='stylesheet' type='text/css'>
	<!-- Javascripts -->
	<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>

	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			/*$('#login-form').submit(function(e){
				e.preventDefault();
				var currentpage = window.location.href;
				
				$.ajax({
					url: 'loginuser.php',
					type: "POST",
					data: $('#login-form').serialize(),
					success: function(response){
						alert(response);
					}
				});
			});*/
		});
	</script>
</head>
<body>
<div class="modal fade" id="signinmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
      </div>
      <div class="modal-body">
	  <form id="login-form" action="loginuser.php" method="post">
        <input class="input input-full" type="text" name="myusername" placeholder="Username" /><br />
		<input class="input input-full" type="password" name="mypassword" placeholder="Password" /><br />
		<input class="signincheck" type="checkbox" name="remember" value="1" /> Remember Me
		<input type="hidden" name="referrer" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="login-submit" type="button" class="btn btn-primary">Sign In</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="nav navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-brand">
			Shakebot
		</div>
		<div class="pull-right login-buttons">
		<?php echo $_SESSION['loggedinuser']; 
			if(!isset($_SESSION['loggedinuser'])){
			echo'<a class="btn btn-primary" data-toggle="modal" data-target="#signinmodal"><span class="glyphicon glyphicon-log-in"> </span> Sign in</a>
			<a class="btn btn-danger"><span class="glyphicon glyphicon-tasks"> </span> Register</a>';
			
				}else{
				echo 'Hello User <a class="btn btn-primary" href="logout.php"><span class="glyphicon glyphicon-log-in"> </span> Sign Out</a>';
			
				
				
				}
				?>
			
		</div>
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="index.php">About</a></li>
			<li><a href="index.php">Get Started</a></li>
			<li><a href="index.php">Contact</a></li>

		</ul>
	</div>
</div>