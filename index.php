<?php 
session_start();
error_reporting(0);

// We require the files necessary to make this application possible.
require 'config.php'; 
require 'lib/functions/functions.php';
require 'lib/classes/classes.php';

error_reporting(0);
?>

<html>
	<head>
		<link href="http://hayageek.github.io/jQuery-Upload-File/uploadfile.min.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="/css/foundation.min.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="/css/animate.css" />
		<link rel="stylesheet" type="text/css" href="/css/swag.css" />
		<link rel="stylesheet" type="text/css" href="/css/dataTables.foundation.css" />-->
		<link rel="stylesheet" type="text/css" href="css/foundation.min.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/animate.css" />
		<link rel="stylesheet" type="text/css" href="css/swag.css" />
		<link rel="stylesheet" type="text/css" href="css/dataTables.foundation.css" />
		
		<script type="text/javascript" src="js/charts/amcharts.js"></script>
		<script type="text/javascript" src="js/charts/serial.js"></script>
		<script type="text/javascript" src="js/charts/themes/light.js"></script>

		<meta name="viewport" content="width=device-width, user-scalable=no">
		<style>
			#height option { color: red; }
			.empty { color: gray; }
		</style>								
	</head>
	<body>
	<div id="alertBox">
	<div class="fa fa-remove"> </div>
	<p>This is the primary alert box.</p>
	</div>
	<div id="rightclick">Hey there.</div>
	<div ng-app="shakebot">
	<div id="startModal" class="reveal-modal" data-reveal>
		<div class="row">
			<div class="small-6 columns">
			<h3>Sign In</h3>
				<form id="sign-in-form" method="post" action="/loginuser.php">
				<input type="text" name="myusername" placeholder="Username" /><br />
				<input type="password" name="mypassword" placeholder="Password" /><br />
				<button class="button right">Continue as Guest</button>
				<button class="button success">Sign in</button>
			</form>
			</div>
			<div class="small-6 columns border-left">
			<h3>Register</h3>
				<form id="sign-in-form" method="post" action="/loginuser.php">
				<input type="text" name="myusername" placeholder="Username" /><br />
				<input type="password" name="mypassword" placeholder="Password" /><br />
				<button class="button success">Register</button>
			</form>
			</div>
			
		</div>
	</div>
	
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap full-height">
				<nav class="tab-bar white">
					<section class="left-small">
						<a class="left-off-canvas-toggle" href=""><span class="fa fa-bars"></span> <?php echo $loggedInUser->fullname; ?></a>
					</section>

					<section class="middle tab-bar-section">
						<h1 class="title"><a ui-sref="profile"><img src="img/logo-title.png" class="main-logo" /></a></h1>
					</section>
					
					<section class="top-bar-section">
						<ul class="right no-bullet">
							<li class="sky"><a href="#/about" data-href="about" id="about">About Shakebot</a></li>
							<li class="sky"><a href="#/how-shakebot-works" data-href="how-shakebot-works" id="how-shakebot-works">How Shakebot Works</a></li>
							<li class="sky"><a href="#/what-makes-shakebot-unique" data-href="what-makes-shakebot-unique" id="what-makes-shakebot-unique">What Makes Shakebot Unique?</a></li>
							<li class="sky"><a href="#/contact" data-href="contact" id="contact">Contact Us</a></li>
							<!--<li class="success"><a href="#/achievements" data-href="achievements">Achievements</a></li>-->
							<li class="dark"><a data-href="checkout" id="checkout">Cart</a></li>					
						</ul>
					</section>
				</nav>

				<aside class="left-off-canvas-menu">
					<ul class="off-canvas-list">
						<li ui-sref-active-eq="active"><a ui-sref="home">Start</a></li>
						<li ui-sref-active-eq="active"><a ui-sref="profile">My Profile</a></li>
						<li ui-sref-active-eq="active"><a href="#">My Nutrition</a></li>
						<li ui-sref-active-eq="active"><a href="logout.php">Sign Out</a></li>
					</ul>
				</aside>

				<aside class="right-off-canvas-menu">
					<ul class="off-canvas-list">
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
					</ul>
				</aside>

				<section class="main-section">
					<div ui-view class=""></div>
				</section>

				<div class="footer hide">
					<ul class="shakebot-products-footer">
					<li><a ui-sref="products"><img src="img/shopping-placeholder.jpg" class="footer-img" />
					<span class="footer-link">Shakebot Product 1<br />
					$24.99</span></a>
					</li>
					<li><a ui-sref="products"><img src="img/shopping-placeholder.jpg" class="footer-img" />
					<span class="footer-link">Shakebot Product 2<br />
					$24.99</span></a>
					</li>
					<li class="recommended"><a ui-sref="products"><img src="img/shopping-placeholder.jpg" class="footer-img" />
					<span class="footer-link">Shakebot Product 4<br />
					$24.99</span></a>
					</li>
					</ul>
				</div>
				
				<a class="exit-off-canvas"></a>
			</div>
		</div>
</div>
		<!-- 
		
		And we load all the scripts that can be loaded after pageload at the bottom.
		
		-->
		
		<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="js/jquery.slimscroll.js" type="text/javascript"></script> 
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/foundation.min.js" type="text/javascript"></script>
		<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://js.balancedpayments.com/1.1/balanced.js"></script>
		<script src="http://hayageek.github.io/jQuery-Upload-File/jquery.uploadfile.min.js"></script>
		<script src="js/doorknob.js" type="text/javascript"></script>
		<script src="js/dataTables.foundation.js" type="text/javascript"></script>
		<script src="js/angular.js" type="text/javascript"></script>
		<script data-require="angular.js@1.2.x" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js" data-semver="1.2.16"></script>
		<script src="js/angular-ui-router.min.js" type="text/javascript"></script>
		<script src="js/rothfuss.js" type="text/javascript"></script> 
		
		<!--Code for date picker starts-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<!--Code for date picker ends-->
		
		<script type="text/javascript">

			var activetile = '';

			function closeAlert(){
				$('#alertBox').fadeOut('fast');
			}

			function buildAlert(content){
				$('#alertBox p').html(content);
				$('#alertBox').fadeIn('fast');

				setTimeout(function(){
					$('#alertBox').fadeOut('fast');
				}, 5000);

				$('#alertBox .fa').on('click', function(){
					closeAlert();
				});
			}
			
				
			$(document).ready(function(){	
											
				function buildPageContent(content){					
					$('.profilePage').html(content);
				}

				function loadTileContents(tile){
					
					$.ajax({
						url: 'lib/pages/'+tile+'.php',
						type: 'GET',
						success: function(response){														
							buildPageContent(response);
							$( "#datepicker" ).datepicker();	
							
							$("#height,#activity").change(function () {								
								if($(this).val() == "0") $(this).addClass("empty");
								else $(this).removeClass("empty")
							});						
						}
					})
				}

				var subpage = location.hash.split('/');
				if(location.hash = '/profile'){
					$(".top-bar-section ul.right li a").css("color","#888");
					loadTileContents('settings');
				}

				$(document).on('click', '.main-logo', function(){
					$(".top-bar-section ul.right li a").css("color","#888");
					loadTileContents('home');
				});

				$(document).on('click', '.tile', function(){					
					var tile = $(this).attr('data-href');
					$(".top-bar-section ul.right li a").css("color","#888");					
					location.hash = '/profile/' + tile;
					loadTileContents(tile);
					
				});

				$(document).on('click', '.top-bar-section ul.right li a', function(e){					
					e.preventDefault();
					var tile = $(this).attr('data-href');				
					$(".top-bar-section ul.right li a").css("color","#888");
					$(this).css("color","black");
					loadTileContents(tile);
				});

				var currentMousePos = { x: -1, y: -1 };
				$(document).mousemove(function(event) {
					currentMousePos.x = event.pageX;
					currentMousePos.y = event.pageY;
				});
	
				$('').bind('contextmenu', function(e) {
					var thingclicked = $(this).attr('class');
					var thingclickedelem = $(this);
					if(thingclicked == 'a'){
					//alert('a');
					}
					$('#rightclick').css({
						left: currentMousePos.x,
						top: currentMousePos.y
					});
					$('#rightclick').html(thingclicked);
					
					$('#rightclick').show();
					
					$('*').click(function(){
						$('#rightclick').hide();
					});
					
					return false;
				
				}); 

				
				//$(document).foundation();
				//alert(Foundation.random_str(6));

/*
				$('.main-section').slimScroll({
					height: '100%'
				});
*/
				<?php //echo $_SESSION["loggedinuser"]=''; ?>
				if('<?php echo $_SESSION["loggedinuser"]; ?>' == ''){
					$('#startModal').foundation('reveal', 'open');
				}

				$('.tile-cover').slideDown('fast');
				$(document).on('mouseenter', '.tiles li a', function(){

					$(this).find('.tile-cover').slideUp('fast');
				});

				$(document).on('mouseleave', '.tiles li a', function(){

					$(this).find('.tile-cover').slideDown('fast');
				});

				
				/*
				//For Validation				
				$('#signform').submit(function(event){
					$('#usrSign').attr('value', '1');					
					
					$.ajax({
						url:'lib/functions/userauthen.php',						
						dataType: 'text',
						type:'POST',
						data: $(this).serialize(),						
						success: function(responseTxt){																
							//alert(responseTxt);
							//$(document).trigger('ready');
							if(responseTxt == 'Invalid'){
								buildAlert("Invalid login details.");								
							}else{
								$('#startModal').foundation('reveal', 'close');
								//checkuser('settings');
								location.reload();
							}
						}
					});
					
				});
				
				//For Guest user		
				$('#contGuest').click(function(){										
					$('#usrSign').attr('value', '2');					
					
					$.ajax({
						url:'lib/functions/userauthen.php',						
						dataType: 'text',
						type:'POST',
						data: $(this).serialize(),						
						success: function(responseTxt){			
							//$(document).trigger('ready');													
							$('#startModal').foundation('reveal', 'close');
							checkuser('nutrition');
						}
					});						
				});
				
				//For Registration				
				$('#regForm').submit(function(event){
					$('#usrGust').attr('value', '2');					
					//alert($('#usrGust').val());
					$.ajax({
						url:'lib/functions/userauthen.php',						
						dataType: 'text',
						type:'POST',
						data: $(this).serialize(),						
						success: function(responseTxt){	
							//alert(responseTxt);
							//$(document).trigger('ready');											
							if(responseTxt == 1){
								$('#startModal').foundation('reveal', 'close');
								buildAlert("Registered successfully, Update your profile details.");
							}else{
								buildAlert("User Name not Available.");
							}							
						}
					});						
				});
				
				function checkuser(tile){					
					$.ajax({
						url: 'lib/pages/'+tile+'.php',
						type: 'GET',
						success: function(response){							
							buildPageContent(response);
						}
					})
				}*/				
				
				
			});
		</script>
		
		
	</body>
</html>
