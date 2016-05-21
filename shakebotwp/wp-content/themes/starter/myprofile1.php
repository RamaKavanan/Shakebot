<?php /* Template Name: MyProfile */?>
<?php

/* Get user info. */
global $current_user, $wp_roles;
$error = array(); 
$sucMsg = 1;   

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

	$_POST['first_name'] = trim($_POST['first_name']);
	$_POST['email'] = trim($_POST['email']);
	
	 if ( empty($_POST['first_name']) ){
		$error[] = __('The Name is Empty.', 'profile');
	 }

	 if ( empty( $_POST['email'] ) ){
		 $error[] = __('The Email is Empty.', 'profile');
	 }

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    /*if ( !empty( $_POST['url'] ) )
        wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );*/
   // echo  "test == ".$_POST['email'];   
   //exit;
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] ))){
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        //elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
        }elseif((email_exists(esc_attr( $_POST['email'] )) != '') && (email_exists(esc_attr( $_POST['email'] )) != $current_user->id)){
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        }else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }
    
    $mime = array("image/gif","image/jpeg","image/png","image/bmp","image/vnd.microsoft.icon","saran");
    
    if($_FILES["avtar"]["name"] != ''){		
		$avName = "";
		$avName = $_FILES["avtar"]["type"];				
		if(in_array($avName,$mime)){			
		}else{			
			$error[] = __('Uploaded avatar Image not in the allowed format. Allowed formats are .gif, .jpeg, .jpg, .png, .bmp, .icon', 'profile');
		}
	}
	
	if($_FILES["bannerfl"]["name"] != ''){		
		$avName = "";
		$avName = $_FILES["bannerfl"]["type"];				
		if(in_array($avName,$mime)){			
		}else{			
			$error[] = __('Uploaded banner Image not in the allowed format. Allowed formats are .gif, .jpeg, .jpg, .png, .bmp, .icon', 'profile');
		}
	}
    
    $_POST['weight'] = trim($_POST['weight']);
	$_POST['age'] = trim($_POST['age']);
    
    if ( !empty( $_POST['age'] ) && !is_numeric($_POST['age'])){
		$error[] = __('Age must a numeric value.');
	}
	
	 if ( !empty( $_POST['weight'] ) && !is_numeric($_POST['weight'])){
		$error[] = __('Weight must a numeric value.');
	}
	
    
    
//exit;
    /*if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );*/

    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
  
	
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        //wp_redirect( get_permalink() );
        //exit;
        $sucMsg = 2;
    }
}
?>
<?php get_header(); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="http://markusslima.github.io/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>

<!-- Profile Banner starts -->
<?php if ( is_user_logged_in() ) { ?>
<div id="slider">
	<div id="carousel-main" class="carousel slide">
		<div class="carousel-inner">
			<div class="item active">		
				
				<?php if(get_the_author_meta( 'BannerImg', $current_user->ID) !='' ){?>					
					<img src="<?php echo get_the_author_meta( 'BannerImg', $current_user->ID);?>" class="img-responsive wp-post-image" alt="banner">
				<?php }else{ ?>
					<!--<img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/banner123.jpg" class="img-responsive wp-post-image" alt="banner">-->
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/banner123.jpg" class="img-responsive wp-post-image" alt="banner">
				<?php }?>
					
				
			</div>
		</div>
	</div>
</div>
<?php }?>
<!-- Profile Banner ends -->

<style>
	.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus{background-color:#CC9900; color:#fff; height:60px; /*width:180px;*/; margin-right:-10px}
	.nav-pills>li{background-color:#eee; color:black; height:60px;}
	.nav-pills>li>a{color:black; padding:20px 0px 10px 20px; border-radius: 0px;}
		
	
	
	.fields label {width: 50%;color: #111111;font-weight: normal;}
	.medium {
    width: 100% !important;
    border: 2px solid #EEE;
    float: left;
    margin-bottom: 12px;
    padding: 7px 12px;
    background-color: #F9F9F9;}
    
    .small {
    width: 100% !important;
    border: 2px solid #EEE;    
    margin-bottom: 12px;
    padding: 7px 12px;
    background-color: #F9F9F9;}
    
    .pbSubmit {
    background: none repeat scroll 0 0 #00ADE7;
    border: medium none;
    border-radius: 3px;
    color: #fff;
    float: left;
    font-family: "Raleway",sans-serif;
    font-weight: bold;
    margin-top: 18px;
    padding: 10px 23px;
    text-transform: uppercase;
    transition: all 0.3s ease 0s;}
    
    .dfield{position:relative}
	
	.row{width: 100%;; margin-right:0px}
	/*label{font-weight:normal;}
    .dfield1{float: left; width:48%}
    .dfield2{float: right; width:48%} */
    .dfield3{float: left; width:31%; }
    .dfield4{float: left; margin-top:30px; margin-left:3px;}
    
     label{font-weight:normal;}
    
    .input-group-btn>.btn{width:90px; border-radius: 0;}
    .input-group-btn>.btn:hover, .btn-primary{background-color:#0F3154; border-color:black; border-radius: 0;}
    
    .buttonText{color:#fff; font-size:11px; font-weight:bold;}
    
    small, .small{font-size:100%;}
    .form-control[disabled]{background-color:#F9F9F9}
    .form-control::-moz-placeholder{color:#111}
    
    .errMsg{
    background-color: #ffebe8;
    border: 1px solid #c00;
    margin-bottom: 8px;
    padding: 6px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;}
    
    .sucMsg{
    background-color: #D4EAF7;        
    border: 1px solid #00ADE7;
    margin-bottom: 8px;
    padding: 6px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;}    
    
</style>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  
  $(document).ready(function(){
	  
 $('#sports').change(function(){
    var chngvalue = $(this).val();

if (chngvalue == "Softball") {
    $('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
} else if (chngvalue == "Baseball") {
	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
} else if (chngvalue == "American Football") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Wide Receiver">Wide Receiver</option><option value="Running Back">Running Back</option><option value="Special Teams">Special Teams</option><option value="Quarterback">Quarterback</option><option value="Tight End">Tight End</option><option value="Linebacker">Linebacker</option><option value="Lineman">Lineman</option><option value="Defensive Back">Defensive Back</option></select>')
} else if (chngvalue == "Basketball") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Guard">Guard</option><option value="Center">Center</option>[&quot;Forward&quot;, &quot;Guard&quot;, &quot;Center&quot;]</select>')
} else if (chngvalue == "Cardio Training") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity Bouts">High Intensity Bouts</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Intervals">Intervals</option><option value="Tabatas">Tabatas</option><option value="Moderate Pace and Intensity">Moderate Pace and Intensity</option><option value="Fat Loss">Fat Loss</option></select>')
} else if (chngvalue == "Swimming") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Short Distance (&lt; 200m)">Short Distance (&lt; 200m)</option><option value="Middle Distance (200m - 500m)">Middle Distance (200m - 500m)</option><option value="Long Distance (&gt;500m)">Long Distance (&gt;500m)</option></select>')
} else if (chngvalue == "Running") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Long Distance (&gt; 800m)">Long Distance (&gt; 800m)</option><option value="Middle Distance (150m - 800m)">Middle Distance (150m - 800m)</option><option value="Sprints (30m - 100m)">Sprints (30m - 100m)</option></select>')
} else if (chngvalue == "Field Hockey") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defense">Defense</option><option value="Midfielder">Midfielder</option><option value="Striker">Striker</option></select>')
} else if (chngvalue == "Gymnastics") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Floor Exercise">Floor Exercise</option><option value="Balance Beam">Balance Beam</option><option value="Uneven Bars">Uneven Bars</option><option value="Vault">Vault</option></select>')
} else if (chngvalue == "Ice Hockey") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defenseman">Defenseman</option><option value="Forward">Forward</option></select>')
} else if (chngvalue == "Lacrosse") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
} else if (chngvalue == "Snow Sports") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Skiing - Cross Country">Skiing - Cross Country</option><option value="Skiing - Alpine">Skiing - Alpine</option><option value="Skiing - Ski Jumping">Skiing - Ski Jumping</option></select>')
} else if (chngvalue == "Soccer") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
} else if (chngvalue == "Track and Field") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Sprints (&lt; 400m)">Sprints (&lt; 400m)</option><option value="Middle Distance (400m - 30000m)">Middle Distance (400m - 30000m)</option><option value="Long Distance (&gt; 3000m)">Long Distance (&gt; 3000m)</option><option value="Jumping - High Jump">Jumping - High Jump</option><option value="Jumping - Triple Jump">Jumping - Triple Jump</option><option value="Jumping - Long Jump">Jumping - Long Jump</option><option value="Jumping - Pole Vault">Jumping - Pole Vault</option><option value="Throwing - Shotput">Throwing - Shotput</option><option value="Throwing - Javelin">Throwing - Javelin</option><option value="Throwing - Hammer">Throwing - Hammer</option><option value="Throwing - Discus">Throwing - Discus</option></select>')
} else if (chngvalue == "Long Distance Event") {
  	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Triathalon">Triathalon</option><option value="Marathon">Marathon</option><option value="Ultramarathon">Ultramarathon</option><option value="Iron Man">Iron Man</option></select>')
} else if (chngvalue == "Volleyball") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Outside Hitter">Outside Hitter</option><option value="Middle Blocker">Middle Blocker</option><option value="Setter">Setter</option><option value="Libero/Defensive Specialist">Libero/Defensive Specialist</option></select>')
} else if (chngvalue == "Resistance Training") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity">High Intensity</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Fat Loss">Fat Loss</option><option value="Circuit Training">Circuit Training</option></select>')
} else {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value=""><p><em>No Position</em></p></option></select>')
}


});
});

  
  
</script>
<form method="post" id="adduser" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
<section id="main">
	
	<div class="col-md-1" style="border:0px solid red"> 				
				<!--<img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/shake-img1.png" width="120px">-->
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/shake-img1.png" width="120px">
			</div>
								
	<div class="col-md-10" style="border:0px solid green; margin-left:20px; margin-right:-20px;">	
	
	<div class="container-fluid">
		<div class="row">
					<?php if ( !is_user_logged_in() ) { ?>
						<p class="errMsg">
							<?php _e('You must be logged in to edit your profile.', 'profile'); ?>
						</p><!-- .warning -->
						<br /><br /><br />
					<?php } else { ?>
					
									
						<table class="table table-bordered" cellpadding=0 cellspacing=0>    
							<thead>
							  <tr>
								<td style="background-color:#eee;">
									<span style="font:size:15px; font-weight:bold;">
										<?php if(get_the_author_meta( 'AvatarImg', $current_user->ID) !='' ){?>
											<img src="<?php echo get_the_author_meta( 'AvatarImg', $current_user->ID);?>" width="80px" style="border:1px solid black">											
										<?php }else{ ?>
											<!--<img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/images.jpeg" width="80px" style="border:1px solid black">-->
                                                                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/images.jpeg" width="80px" style="border:1px solid black">
										<?php }?>
										&nbsp;&nbsp;<?php echo get_the_author_meta( 'first_name', $current_user->ID); ?></span>
								</td>
							  </tr>
							  </thead>
							  <tbody>
							  <tr>
								<td class="col-md-9 col-sm-18 col-xs-36">
									
									
									
									<?php if ( count($error) > 0 ) echo '<p class="errMsg">' . implode("<br />", $error) . '</p>'; ?>
									<?php if ( $sucMsg == 2 ) echo '<p class="sucMsg">Details updated successfully.</p>'; ?>									
								<!---->			
									<div style="margin:20px 0px 0px 5px;">
										<ul class="nav nav-pills nav-stacked col-md-2">
											<?if((count($error) > 0) || $sucMsg == 2){?>
												<li >
											<?php }else{?>
												<li class="active" >
											<?php }?>											
												<a href="#tab_a" data-toggle="pill">My Stats</a>
											</li><br />
											<li >
												<a href="#tab_b" data-toggle="pill">History</a>
											</li><br />
											<?if((count($error) > 0) || $sucMsg == 2){?>
												<li class="active">
											<?php }else{?>
												<li>
											<?php }?>
												<a href="#tab_c" data-toggle="pill">Settings</a>
											</li>						
										</ul>
										
										<div class="tab-content col-md-10" style="border:2px solid #CC9900; height:auto; margin-left:-7px;">
											
											<?if((count($error) > 0) || $sucMsg == 2){?>
												<div class="tab-pane fade" id="tab_a">
											<?php }else{?>
												<div class="tab-pane fade in active" id="tab_a">
											<?php }?>
												
												<h4>My Stats</h4><br>																								
													<div class="row">
														<table class="table table-bordered" style="text-align:center; margin-left:10px;">
															<tbody>
															  <tr style="background-color:#00ADE7; color:#fff; font-weight:bold; height:60px;">
																<td style="border:5px solid #fff; padding-top:20px;">Age</td>
																<td style="border:5px solid #fff; padding-top:20px;">Weight</td>
																<td style="border:5px solid #fff; padding-top:20px;">Height</td>
																<td style="border:5px solid #fff; padding-top:20px;">Sport</td>
															  </tr>
															
															  <tr style="background-color:#eee; height:60px;">
																<td style="border:5px solid #fff; padding-top:20px;">
																	<?php if(get_the_author_meta( 'Age', $current_user->ID)!=''){echo get_the_author_meta( 'Age', $current_user->ID);}else{echo "Nill";}?>
																</td>
																<td style="border:5px solid #fff; padding-top:20px;">
																	<?php 
																	$ty = '';
																	if(get_the_author_meta( 'weighttyp', $current_user->ID) == 'K'){
																		$ty = " Kg";
																	}elseif(get_the_author_meta( 'weighttyp', $current_user->ID) == 'P'){
																		$ty = " Lbs";
																	}
																	
																	if(get_the_author_meta( 'Weight', $current_user->ID)!=''){echo get_the_author_meta( 'Weight', $current_user->ID).$ty;}else{echo "Nill";}?>
																</td>
																<td style="border:5px solid #fff; padding-top:20px;">
																	<?php if(get_the_author_meta( 'Height', $current_user->ID)!=''){echo get_the_author_meta( 'Height', $current_user->ID); /*echo ' <span style="font-size:10px">CM</span>';*/}else{echo "Nill";}?>
																</td>
																<td style="border:5px solid #fff; padding-top:20px;"><?php if(get_the_author_meta( 'sports', $current_user->ID)!=''){echo get_the_author_meta( 'sports', $current_user->ID);}else{echo "Nill";}?>-<?php if(get_the_author_meta( 'position', $current_user->ID)!=''){echo get_the_author_meta( 'position', $current_user->ID);}else{echo "Nill";}?></td>
															  </tr>														  
															</tbody>
														  </table>
													</div>												
											</div>
											<div class="tab-pane fade" id="tab_b">												
												<h4>History</h4><br>	
																																		
												<div class="container-fluid">
													<div class="row-fluid">
														
												
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br />
												
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br />
												
														
													</div>
												</div>
												
											</div>
											
											<?if((count($error) > 0) || $sucMsg == 2){?>
												<div class="tab-pane fade in active" id="tab_c" style="margin-left:0px">
											<?php }else{?>
												<div class="tab-pane fade" id="tab_c" style="margin-left:0px">
											<?php }?>
											
												<h4>Settings</h4><br>
												<p>
													
													<?php do_action('edit_user_profile',$current_user); ?>
													
													<!--<div class="row">														
														<div class="dfield col-md-12 col-sm-18 col-xs-36">
															<label>Name<span style="color:red;">*</span></label>
															<input id="email_1" name="email_1" class="medium" type="text" value="" maxlength="50">
														</div>														
													</div>
													
													<div class="row">
														<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
															<div><label>Email<span style="color:red;">*</span></label></div>
															<div>
																<input id="email_1" name="email_1" class="small" type="text" value="" maxlength="150" >
															</div>
														</div>
															
														<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
															<div><label>Date of Birth</label></div>														
															<div>
																<input id="datepicker" name="datepicker" class="small" type="text" value="" >
															</div>
														</div>														
													</div>
													
													<div class="row">
														<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
															<div><label>Password</label></div>														
															<div><input id="email_1" name="email_1" class="small" type="password" value="" maxlength="10"></div>
														</div>
															
														<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
															<div><label>Repeat Password</label></div>														
															<div><input id="email_1" name="email_1" class="small" type="password" value="" maxlength="10"></div>
														</div>														
													</div>
													
													<div class="row">
														<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
															<div><label>Height</label></div>														
															<div><input id="email_1" name="email_1" class="small" type="text" value="" maxlength="5"></div>
														</div>
															
														<div class="dfield3 col-md-6 col-sm-9 col-xs-18">
															<div><label>Weight</label></div>														
															<div><input id="email_1" name="email_1" class="small" type="text" value="" maxlength="5"></div>
														</div>
														
														<div class="dfield4">
															<div><input type="radio" checked="checked" name="weight" id="weight">&nbsp;Pounds
															<input type="radio" name="weight" id="weight">&nbsp;Kilogram</div>
														</div>														
													</div>
													
													<div class="row">
														<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
															<div><label>Sports</label></div>														
															<div><select id="email_1" name="email_1" class="small">
																<option value="">-Select-</option>
																<option value="American Football">American Football</option>
																<option value="Softball">Softball</option>
																<option value="Baseball">Baseball</option>
																<option value="Basketball">Basketball</option>
																<option value="Bodybuilding">Bodybuilding</option>
																<option value="Bowling">Bowling</option>
																<option value="Combat Sports">Combat Sports</option>
																<option value="Cricket">Cricket</option>
																<option value="Cross Country">Cross Country</option>
																<option value="Cardio Training">Cardio Training</option>
																<option value="CrossFit">CrossFit</option>
																<option value="Swimming">Swimming</option>
																<option value="Running">Running</option>
																<option value="Field Hockey">Field Hockey</option>
																<option value="Golf">Golf</option>
																<option value="Gymnastics">Gymnastics</option>
																<option value="Ice Hockey">Ice Hockey</option>
																<option value="Lacrosse">Lacrosse</option>
																<option value="Rowing">Rowing</option>
																<option value="Rugby">Rugby</option>
																<option value="Snow Sports">Snow Sports</option>
																<option value="Soccer">Soccer</option>
																<option value="Tennis">Tennis</option>
																<option value="Track and Field">Track and Field</option>
																<option value="Long Distance Event">Long Distance Event</option>
																<option value="Volleyball">Volleyball</option>
																<option value="Resistance Training">Resistance Training</option>
															</select></div>
														</div>
															
														<div class="dfield2 col-md-6 col-sm-9 col-xs-18">		
															<label>&nbsp;</label>													
															<div><input type="file" class="filestyle" data-buttonName="btn-primary" data-icon="false" data-buttonText="Browse" data-placeholder="Upload Avatar..."><br></div>
														</div>														
													</div>
													
													<div class="row">
														<div class="dfield1 col-md-6">
															<div><label>Position</label></div>														
															<div><select id="email_1" name="email_1" class="small">
																<option value="">-Select-</option>
																<option value="Forward">Forward</option>
																<option value="Defenseman">Defenseman</option>
																<option value="Midfielder">Midfielder</option>
																<option value="Goalie">Goalie</option>
															</select></div>															
														</div>
															
														<div class="dfield2 col-md-6 col-sm-9 col-xs-18">		
															<label>&nbsp;</label>															
															<div><input type="file" class="filestyle" data-buttonName="btn-primary" data-icon="false" data-buttonText="Browse" data-placeholder="Upload Banner..."><br></div>
														</div>														
													</div>-->
													
													<div class="row" >														
														<div class="dfield1 col-md-6 col-sm-9 col-xs-18" >
															<input name="updateuser" type="submit" id="updateuser" value="SUBMIT" class="pbSubmit">
															<a href="<?php echo site_url(); ?>"><input id="cancelProf" name="cancelProf" type="button" value="CANCEL" class="pbSubmit" style="background: none repeat scroll 0 0 #B0B0B0; color:#fff; margin-left:10px"></a>
															
															<?php wp_nonce_field( 'update-user' ) ?>
															<input name="action" type="hidden" id="action" value="update-user" />
											
														</div>		
														<div class="dfield2 col-md-6">		
															<label>&nbsp;</label>
															<p>&nbsp;</p>
															<p>&nbsp;</p>
														</div>																												
													</div>	
													
																									
												</p>
											</div>						
										</div>
											
									</div>				
									
									
								<!---->
								</td>								
							  </tr>
							</tbody>
					  </table>					
				
			<?php } ?>
						
			
		</div>
	</div><!--Container-->
	
	</div>
			
			<div class="col-md-1" style="border:0px solid blue; float:right;">
				<!--<img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/shake-img1.png" width="120px" style="float:right;">-->
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/shake-img1.png" width="120px" style="float:right;">
			</div>
	
</section>
</form>

<?php get_footer();?>
