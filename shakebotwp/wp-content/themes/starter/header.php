<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php global $themeum; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<?php if(isset($themeum['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo $themeum['favicon']; ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images/plus.png' ?>" type="image/x-icon"/>
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php if(isset($themeum['before_head'])) echo $themeum['before_head'];?>
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div id="navigation" class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand scroll" href="<?php echo site_url(); ?>">

								<?php
									if (isset($themeum['logo_image']))
									   {
									   		if(!empty($themeum['logo_image'])){
								?>
									   		<img src="<?php echo $themeum['logo_image']; ?>" title="Shakebot" width="160px" height="80px" style="margin-top:-10px;">
								<?php
											}
											else{
												echo '<span>'.get_bloginfo('name').'<span>'; 
											}
									   }
									else
									   {
									    echo '<span>'.get_bloginfo('name').'<span>';
									   }
									?>
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<!--<ul id="menu-main-menu" class="nav navbar-nav">
							<li id="menu-item-0" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="#" class="fl_box-4 cboxElement">Login</a></li>
						</ul>-->	
						<?php if(has_nav_menu('primary')): ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary','container' => false,'menu_class' => 'nav navbar-nav', 'walker' => new Onepage_Walker()) ); ?>
							
						<?php endif; ?>	
						
					</div>
				</div>  
			</div>
		</header><!--/#header-->
		
<!--Log in Popup starts-->		
<!--<div id="cboxOverlay" style="opacity: 1; cursor: auto; visibility: visible; display: none;"></div>
<div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none; visibility: visible; top: 0px; left: 572px; position: absolute; width: 492px; height: 278px; opacity: 1; cursor: auto;"><div id="cboxWrapper" style="height: 278px; width: 392px;"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left; width: 350px;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left; height: 236px;"></div><div id="cboxContent" style="float: left; width: 350px; height: 236px;"><div id="cboxTitle" style="float: left; display: block;"></div><div id="cboxCurrent" style="float: left; display: none;"></div><button type="button" id="cboxPrevious" style="display: none;"></button><button type="button" id="cboxNext" style="display: none;"></button><button id="cboxSlideshow" style="display: none;"></button><div id="cboxLoadingOverlay" style="float: left; display: none;"></div><div id="cboxLoadingGraphic" style="float: left; display: none;"></div><button type="button" id="cboxClose">close</button></div><div id="cboxMiddleRight" style="float: left; height: 236px;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left; width: 350px;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; max-width: none; display: none;"></div></div>-->

<!--Form elements starts-->
<!--<div style="display:none">
	<div id="form-lightbox-4" style="padding: 10px;width:350px">	
			<form role="form" action="http://localhost/wordpress/" name="htmlform">
			  <div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email">
			  </div>
			  <div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd">
			  </div>  
			 <button type="submit" class="btn btn-info">Submit</button>&nbsp;<button type="submit" class="btn btn-info">Continue as Guest</button>
			<div style="padding-top:10px;"><a href="http://localhost/wordpress/index.php/new-user-registration/" style="color:black; text-decoration:underline">Registration</a>&nbsp;|&nbsp;<a href="http://localhost/wordpress/index.php/forgot-password/" style="color:black; text-decoration:underline">Forgot Password</a></div><br />
			 <?php //do_action( 'wordpress_social_login' ); ?>
		</form>
	</div>
</div>-->



<!--Form elements ends-->
<!--<script type="text/javascript">
		var iFrame_4 = jQuery("#form-lightbox-4 iframe").attr("src");
		jQuery(document).ready(function() {
			/*jQuery("#cboxClosea").click(function(){
				jQuery(".fl_box-4").colorbox({function(){ jQuery("#form-lightbox-4 iframe").attr("src", iFrame_4); } });
			});*/
			
			jQuery(".fl_box-4").colorbox({
				inline : true,
				href :"#form-lightbox-4", 
				transition : "1",speed : 350,scrolling : true,opacity : 0.85,returnFocus : true,fastIframe : true,closeBtn : true,escKey : true,
				onClosed : function(){ jQuery("#form-lightbox-4 iframe").attr("src", iFrame_4); } 
			});
	});
</script>-->
<!--Log in Popup ends-->
