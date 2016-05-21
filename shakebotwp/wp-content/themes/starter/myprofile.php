<?php /* Template Name: MyProfile */?>
<?php
 
/* Get user info. */
global $current_user, $wp_roles;
$error = array(); 
$sucMsg = 1;   

/* If profile was saved, update profile. */
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

	$_POST['nickname'] = trim($_POST['nickname']);
	$_POST['email'] = trim($_POST['email']);
	
	 if ( empty($_POST['nickname']) ){
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

    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] ))){
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');       
        }elseif((email_exists(esc_attr( $_POST['email'] )) != '') && (email_exists(esc_attr( $_POST['email'] )) != $current_user->id)){
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        }else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    $mime = array("image/gif","image/jpeg","image/png","image/bmp","image/vnd.microsoft.icon");
    
    if($_FILES["avtar"]["name"] != ''){		
		$avName = "";
		$avName = $_FILES["avtar"]["type"];				
		if(!in_array($avName,$mime)){			
			$error[] = __('Uploaded avatar Image not in the allowed format. Allowed formats are .gif, .jpeg, .jpg, .png, .bmp, .icon', 'profile');
		}
	}
	
	if($_FILES["bannerfl"]["name"] != ''){		
		$avName = "";
		$avName = $_FILES["bannerfl"]["type"];				
		if(!in_array($avName,$mime)){			
			$error[] = __('Uploaded banner Image not in the allowed format. Allowed formats are .gif, .jpeg, .jpg, .png, .bmp, .icon', 'profile');
		}
				
		$image_info = $image_width = $image_height = '';
		$image_info = getimagesize($_FILES["bannerfl"]["tmp_name"]);		
		$image_width = $image_info[0];
		$image_height = $image_info[1];
		$bannerMsg = '';
		if($image_width != 1920 || $image_height != 700){
			$bannerMsg = "Uploaded banner size is not in the recommended size (1920 * 700).";
		}		
	}
    
    $_POST['weight'] = trim($_POST['weight']);
	$_POST['age'] = trim($_POST['age']);
    
    if ( !empty( $_POST['age'] ) && !is_numeric($_POST['age'])){
		$error[] = __('Age must be a numeric value.');
	}
	
	if ( !empty( $_POST['weight'] ) && !is_numeric($_POST['weight'])){
		$error[] = __('Weight must be a numeric value.');
	}
        if ( !empty( $_POST['height'] ) && !is_numeric($_POST['height'])){
		$error[] = __('Height must be a numeric value.');
	}
	
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

<script type="text/javascript" src="<?php  echo site_url(); ?>/wp-content/themes/starter/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/woco.accordion.min.js"></script>
<link href="<?php echo site_url(); ?>/wp-content/themes/starter/css/woco-accordion.min.css" rel="stylesheet">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="http://markusslima.github.io/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/myprofile.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/bootstrap.vertical-tabs.css">


<!--table sorter starts -->
<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/dist/jsgrid.min.css"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/dist/jsgrid.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/dist/jsgrid-theme.min.css"></script>
 
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/demos/demos.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,400' rel='stylesheet' type='text/css'>
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/demos/db.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/css/jsgrid.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/css/theme.css" />

    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/jsgrid.core.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/jsgrid.load-indicator.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/jsgrid.load-strategies.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/jsgrid.sort-strategies.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/jsgrid.field.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/fields/jsgrid.field.text.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/fields/jsgrid.field.number.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/fields/jsgrid.field.select.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/fields/jsgrid.field.checkbox.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/starter/jsgrid-master/src/fields/jsgrid.field.control.js"></script>
<!--table sorter ends -->

<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/myprofile.js"></script>
<script>
    $(document).ready(function(){
        var pageURL = $(location).attr("hash");

        if(pageURL == '#stats') {
          //  $('body').scrollTo(500);
           // $("div#tab_a").focus();
            $("div#tab_a").addClass('active in');
            $("div#tab_b").removeClass('active in');
          $("div#tab_c").removeClass('active in');
            $("#stats").addClass('active');
            $("#historyId").removeClass('active');
            $("#settings").removeClass('active');
        }
        if(pageURL == '#tab_b') {
          //  $('body').scrollTo(500);
          //  $("div#tab_b").focus();
            $("div#tab_b").addClass('active in');
            $("div#tab_a").removeClass('active in');
            $("div#tab_c").removeClass('active in');
            callHistoryAjax("#historyIdspan");
            $("#stats").removeClass('active');
            $("#historyId").addClass('active');
            $("#settings").removeClass('active');
        }
        if(pageURL == '#tab_c') {
           // $('body').scrollTo(700);
           // $("div#tab_c").focus();
            $("div#tab_c").addClass('active in');
            $("div#tab_a").removeClass('active in');
            $("div#tab_b").removeClass('active in');
            $("#stats").removeClass('active');
            $("#historyId").removeClass('active');
            $("#settings").addClass('active');
        }

        $('a').click(function(event){
            var currentAnchor = $(this).text();
            if(currentAnchor == 'My Stats') {
                event.preventDefault();
               // $('body').scrollTo(500);
               // $("div#tab_a").focus();
                $("div#tab_a").addClass('active in');
                $("div#tab_b").removeClass('active in');
                $("div#tab_c").removeClass('active in');
                $("#stats").addClass('active');
                $("#historyId").removeClass('active');
                $("#settings").removeClass('active');
            }
            if(currentAnchor == 'History') {
                event.preventDefault();
               //  $('body').scrollTo(500);
                //$("div#tab_b").focus();
                $("div#tab_b").addClass('active in');
                $("div#tab_a").removeClass('active in');
                $("div#tab_c").removeClass('active in');
                callHistoryAjax("#historyIdspan");
                $("#stats").removeClass('active');
                $("#historyId").addClass('active');
                $("#settings").removeClass('active');
            }
            if(currentAnchor == 'Settings') { 
                event.preventDefault();
                //$('body').scrollTo(700);
                //$("div#tab_c").focus();
                $("div#tab_c").addClass('active in');
             $("div#tab_a").removeClass('active in');
                $("div#tab_b").removeClass('active in');
                $("#stats").removeClass('active');
                $("#historyId").removeClass('active');
                $("#settings").addClass('active');
            }
        });

        function callHistoryAjax(pass){
            $.get( 
                ajaxurl, // request url
                { 
                    action: 'historyAjax', 'whatever': 1}, // request parameters
                    function (response){ // callback			
                    // handle the response							
                        $(pass).html(response);						
                    }
                );
        }

    });
</script>

<form method="post" id="adduser" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
<section id="main">
	
	<div class="row no-margin">
            <div class="col-md-1" style="border:0px solid red; padding-right:0px;">
                <img src="<?php echo site_url();?>/wp-content/uploads/2015/10/shake-img1.png" width="120px">
            </div>
								
            <div class="col-md-10" style="border:0px solid green;">	
	
            <div class="container-fluid">
		
            <?php if ( !is_user_logged_in() ) { ?>
                    <p class="errMsg">
                            <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
                    <br /><br /><br />
            <?php } else { ?>


        <table class="table table-bordered" cellpadding=0 cellspacing=0>    
            <tbody>               
                  <tr>
                        <td class="col-md-9">
                            
                        <?php if ( count($error) > 0 ) echo '<p class="errMsg">' . implode("<br />", $error) . '</p>'; 
                        if($bannerMsg != ''){$bannerMsg = "<br />".$bannerMsg;}
                        ?>
                        <?php if ( $sucMsg == 2 ) echo '<p class="sucMsg">Details updated successfully.'.$bannerMsg.'</p>'; ?>									
                <!---->
                            <div class="fortabtoggle" style="margin:20px 0px 0px 5px; ">                                
                                <ul class="nav nav-pills nav-stacked col-md-3">
                                    <li>
                                        <div class="profile">
                                            <span style="font-size:15px; font-weight:bold;">
                                                <?php if(get_the_author_meta( 'AvatarImg', $current_user->ID) !='' ){?>
                                                        <img src="<?php echo get_the_author_meta( 'AvatarImg', $current_user->ID);?>" width="80px" height="80px" style="border:1px solid black">											
                                                <?php }else{ ?>
                                                         <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/images.jpeg" width="80px" height="80px" style="border:1px solid black">
                                                <?php }?>
                                                &nbsp;&nbsp;<?php echo get_the_author_meta( 'nickname', $current_user->ID); ?>
                                            </span>
                                        </div>
                                    </li><br /><br />
                                    <?php if((count($error) > 0) || $sucMsg == 2){ ?>
                                            <li id="stats" >
                                    <?php }else{?>
                                            <li id="stats" class="active" >
                                    <?php }?>											
                                            <a href="#tab_a" data-toggle="pill">My Stats</a>
                                    </li><br />
                                    <li id="historyId">
                                            <a href="#tab_b" data-toggle="pill">History</a>
                                    </li><br />
                                    <?php if((count($error) > 0) || $sucMsg == 2){ ?>
                                            <li class="active" id="settings">
                                    <?php }else{?>
                                            <li id="settings">
                                    <?php }?>
                                            <a href="#tab_c" data-toggle="pill">Settings</a>
                                    </li>						
                                </ul>
                            </div>

                                <div class="tab-content col-md-9 ">

                                    <?php if((count($error) > 0) || $sucMsg == 2){ ?>
                                            <div class="tab-pane fade" id="tab_a" >
                                    <?php }else { ?>
                                            <div class="tab-pane fade in active" id="tab_a" >
                                    <?php }?>

                                    <h4>My Stats</h4><br>			

                                    <div id="no-more-tables" >

                                    <table class="table" style="text-align:center; margin-left:10px; ">
                                        <tbody>
                                          <tr style="background-color:#00ADE7; color:#fff; font-weight:bold; height:60px;">
                                                <td style="border:5px solid #fff; padding-top:20px;">Age</td>
                                                <td style="border:5px solid #fff; padding-top:20px;">Weight</td>
                                                <td style="border:5px solid #fff; padding-top:20px;">Height</td>
                                                <td style="border:5px solid #fff; padding-top:20px;">Sport</td>
                                          </tr>

                                          <tr style="background-color:#eee; height:60px;">
                                              <td style="border:5px solid #fff; padding-top:20px;" data-title="Age">
                                                      <?php

                                                              if(get_the_author_meta( 'dob', $current_user->ID)!=''){
                                                              $dob = get_the_author_meta( 'dob', $current_user->ID);

                                                              $arr = explode('/',$dob);
                                                              $var1 = $arr[2]."/".$arr[1]."/".$arr[0]." 00:00:00";
                                                              $var2 = date('Y/m/d 00:00:00');																	

                                                              //echo $var2." -- ".$var1;
                                                              $datetime1 = new DateTime($var1);
                                                              $datetime2 = new DateTime($var2);																		
                                                              //echo "<br />".$datetime2." -- ".$datetime1;

                                                              $res = $datetime2->diff($datetime1);																		
                                                              //print_r($res);

                                                              echo $res->y;
                                                              }else{echo "Nill";}
                                                      ?>

                                                    <?php //if(get_the_author_meta( 'Age', $current_user->ID)!=''){echo get_the_author_meta( 'Age', $current_user->ID);}else{echo "Nill";}?>
                                            </td>
                                            <td style="border:5px solid #fff; padding-top:20px;" data-title="Weight">
                                                    <?php 
                                                    $ty = '';
                                                    if(get_the_author_meta( 'weighttyp', $current_user->ID) == 'K'){
                                                            $ty = " kgs";
                                                    }elseif(get_the_author_meta( 'weighttyp', $current_user->ID) == 'P'){
                                                            $ty = " lbs";
                                                    }

                                                    if(get_the_author_meta('Weight', $current_user->ID)!=''){echo get_the_author_meta( 'Weight', $current_user->ID).$ty;}else{echo "Nill";}?>
                                            </td>
                                            <td style="border:5px solid #fff; padding-top:20px;" data-title="Height">
                                                    <?php if(get_the_author_meta( 'Height', $current_user->ID)!=''){echo get_the_author_meta( 'Height', $current_user->ID); /*echo ' <span style="font-size:10px">CM</span>';*/}else{echo "Nill";}?>
                                            </td>
                                            <td style="border:5px solid #fff; padding-top:20px;" data-title="Sport"><?php if(get_the_author_meta( 'sports', $current_user->ID)!=''){echo get_the_author_meta( 'sports', $current_user->ID);}else{echo "Nill";}?>-<?php if(get_the_author_meta( 'position', $current_user->ID)!=''){echo get_the_author_meta( 'position', $current_user->ID);}else{echo "Nill";}?></td>
                                         </tr>														  
                                        </tbody>
                                    </table>
                                    </div>												
                                    </div>                                                 
                                    <div class="tab-pane fade" id="tab_b">												
                                            <h4>History</h4><br>
                                            <div class="container-fluid">
                                                    <div class="row-fluid">
                                                    <span id="historyIdspan"></span>                                                    
<!-- mypart -->
<?php  
        global $wpdb;
        global $current_user, $wp_roles;
        $currentUserId = $current_user->id;
        $selqry = "select * from wp_nutri_calculation WHERE DATE( addedon ) = CURDATE() AND user_id = $currentUserId ORDER BY id DESC LIMIT 1";
        $resultstemp = $wpdb->get_results($selqry);
//        $d = new DateTime();
//        $firsDayOfCurrentMonth->format('m/d/Y');
        
//        $qryforterm = "select * from wp_terms WHERE term_id = $termId";
//        $terms = $wpdb->get_results($qryforterm);
    ?>
<div id="accordion" style="margin-bottom: 20px;">
  <h3>Daily Feedback Display</h3>
  <div class="" style="min-height:250px; ">
    <!-- date picker -->
            <div>
                <!--<input id="datepickerForDailyFeedback" name="datepicker"  class="regular-text code"  type="text" value="<?php echo date('m/d/Y');?>" placeholder="Choose a date">-->
                <input id="datepickerForDailyFeedback" name="datepicker"  class="regular-text code"  type="text" value="" placeholder="Choose a date" style="font-size:15px;">
            </div>
          <!-- date picker -->
          <!-- activity information -->
        <?php             
//            foreach($resultstemp as $info => $currentDay ){  
//                $termId = getTerms($currentDay->activity);
        ?> 
<!--          <div id="showDailyActivities">
              <div class="dailyfeeds"><?php //echo $currentDay->weight;?><?php echo $currentDay->weight_type;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/03/weight.png" height=45 width=45></div>
              <div class="dailyfeeds"><?php //echo $currentDay->activity_name;?><br/><img src="<?php echo $termId[0]->activityicon;?>"height=45 width=45></div>
              <div class="dailyfeeds"><?php //echo $currentDay->duration;?><?php echo $currentDay->duration_type;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/03/clk.png" height=45 width=45></div>
              <div class="dailyfeeds"><?php //echo $currentDay->todayReq_calories;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/03/caloriburn.png" height=45 width=45></div>
          </div>         -->
        <div id="showDailyActivities">
            <div ></div>
            <div ></div>
            <div ></div>
            <div ></div>            
        </div>  
        <?php// }?>
    <!-- activity information -->
  </div>    
  <h3>Calendar view / List view </h3>
  <div class="sizereduce tobottom" style="">
    <div class="container">  
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#calview">Calendar view</a></li>
          <li><a data-toggle="tab" href="#listview">List view</a></li>
        </ul>
        <div class="tab-content">
            <div id="calview" class="tab-pane fade in active">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div id="listview" class="tab-pane fade">
                
                 <div class="datepad">
                    <label for="from">From : </label><input id="rangeStart" class="datepadStart" name="datepicker"  class="regular-text code"  type="text" value="<?php echo $firsDayOfCurrentMonth;?>"  placeholder="Choose a Start date">
                    <label for="to">To : </label>&nbsp;<input id="rangeEnd" name="datepicker"  class="regular-text code"  type="text" value="<?php echo date('m/d/Y');?>"  placeholder="Choose an End date">
                </div>                
                              
                <table id="" class="" style="text-align:center;width:40%;float:left;">                                   
            <div id="jsGrid" class="datepad" style="width:100%;"> </div>
            <?php             
                foreach($resultstemp as $info => $currentDay ){               
            ?>        
<!--                    <tbody id="showActivitiesOfSelectedDates">
                         <tr class="tbodycolor">
                            <td class="listViewTableDesign"><?php //echo $currentDay->addedon;?></td>
                            <td class="listViewTableDesign"><?php //echo $currentDay->weight;?></td>
                            <td class="listViewTableDesign"><?php //echo $currentDay->activity_name;?></td>
                            <td class="listViewTableDesign"><?php //echo $currentDay->duration;?></td>
                            <td class="listViewTableDesign"><?php //echo $currentDay->todayReq_calories;?></td>
                         </tr>
                    </tbody>-->
            <?php }?>  
            </table>
                
                <table style="text-align:center;width:40%;"><!--class="table" -->
<!--                    <div class="listViewTable1RowDesign listViewTableDesign" style="width:40%;text-align:center;padding: 8px;">
                         Totals
                    </div>-->
                    <tbody id="summup">
                        <tr class="">
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                        </tr>
                    </tbody>
                </table>
                
                <table style="text-align:center;width:40%;">
<!--                     <div class="listViewTable1RowDesign listViewTableDesign" style="width:40%;text-align:center;padding: 8px;">
                         Averages
                     </div>-->
                     <tbody id="averages">
                         <tr class="">
                             <td ></td>
                             <td ></td>
                             <td ></td>
                             <td ></td>
                             <td ></td>                             
                         </tr>
                     </tbody>
                 </table>    
                
                 <table style="text-align:center;width:40%;">
<!--                    <div class="listViewTable1RowDesign listViewTableDesign" style="width:40%;text-align:center;padding: 8px;">
                         Activity Breakdown
                    </div>-->
                    <tbody id="activbreak">
                        <tr class="">
                            <td ></td>
                            <td ></td>
                            <td ></td>                          
                        </tr>
                    </tbody>
                </table>                               
            </div>
        </div>
        </div>
</div>

  
  <h3> Graphs </h3>
  <div style="min-height:250px;">
    <p>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
    Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
    ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
    lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
    </p>
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
  </div>
</div>
 
<!-- mypart -->
                                                    
                                                    </div>
                                            </div>

                                    </div>

                                        <?php if((count($error) > 0) || $sucMsg == 2){ ?>
                                                <div class="tab-pane fade in active" id="tab_c" style="margin-left:0px">
                                        <?php }else { ?>
                                                <div class="tab-pane fade" id="tab_c" style="margin-left:0px">
                                        <?php }?>

                                                <h4>Settings</h4><br>
                                                        <p>

                                                        <?php do_action('edit_user_profile',$current_user); ?>													

                                                        <div class="row" >														
                                                                <div class="dfield1 col-md-6" >
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
						
			
		
	</div><!--Container-->
	
	</div>
    			
    <div class="col-md-1 " style="border:0px solid blue;padding-left: 0px;">				
        <img src="<?php echo site_url();?>/wp-content/uploads/2015/10/shake-img1.png" width="120px" style="float:right;">
    </div>
	
</section>
</div><!--Row-->
</form>
<style>
img { max-width: 100%; }        
.img-responsive {
    display: block;
    height: auto;
    max-width: 100%;
}

select {
        appearance:none;
            -moz-appearance:none;
            -webkit-appearance:none;
            background-color: red;
}
.listbox {
            width: 1000px;
            height: 560px;
            overflow: visible;
}
        
</style>        
<?php get_footer();?>