<?php /* Template Name: MyNutrition */?>
<?php
get_header(); 

$nutitable = 'wp_nutri_calculation';
$usrDet = wp_get_current_user();
$uid = $usrDet->ID;
$goal = $usrDet->goal;
if($goal == 'Lose Weight'){
    $glactive = 1 ;
}else if($goal == 'Maintain Weight'){
    $glactive = 2 ;
}else if($goal == 'Gain Weight'){
    $glactive = 3 ;
}else{
    $glactive = 2 ;
}
//$myrows = $wpdb->get_row("SELECT goal_type FROM $nutitable where user_id=$uid order by addedon desc" );
//print_r($myrows);
//$glactive = 2;
//if($myrows->goal_type){$glactive = $myrows->goal_type;}

?>
<script type="text/javascript">
    var main_url="<?php echo site_url(); ?>";
</script>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/magnific-popup.css">
<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->

<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/jquery-1.8.3.min.js"></script>

<!-- Magnific Popup core JS file -->
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/jquery.magnific-popup.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/mynutrition.css">


<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/mynutrition.js"></script>

<link rel="stylesheet" href="//select2.github.io/select2/select2-3.5.2/select2.css">
<!--<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/select2.css">-->
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/gh-pages.css">
<script src="//select2.github.io/select2/select2-3.4.2/select2.js"></script>

<style>
	.select2-results {
		max-height: 70px;
	}
</style>

<form name="frm" id="frm" action="" method="POST">
<input type="hidden" name="subCategoryHd" id="subCategoryHd" value="">
<input type="hidden" name="uidHd" id="uidHd" value="<?php echo $uid;?>">

<section id="main" >
	<div class="container" style="border:0px solid red; padding:0px;">
		
		<div class="row"  style="border:0px solid green; padding:0px;">						
								
			<div class="col-md-12"  style="border:0px solid red; padding:0px;">	
				<div class="col-md-9" style="border:0px solid red">
					
					<p class="errMsg" id="errMsgId" style="display:none"></p>
					<!--<?php //if ( $sucMsg == 2 ) echo '<p class="sucMsg" id="sucMsgId">Details saved successfully.</p>'; ?>-->					
					<p class="sucMsg" id="sucMsgId1" style="display:none"></p>
					
					<table class="table table-bordered" cellpadding=0 cellspacing=0 style="margin-left:-10px">
						<thead>
							  <tr style="height:70px;">
								<td style="background-color:#eee; border-right:2px solid #fff; padding:15px 0px 0px 40px" class="col-md-3"><h4>My Goal</h4></td>
								<td style="background-color:#eee; border-left:3px solid #fff; padding:15px 0px 0px 40px" class="col-md-9"><h4>Custom Nutrition Calculator</h4></td>
							  </tr>
						</thead>
                                                
						<tbody>
							<tr>
								<td colspan="2">
								
								<!-- Panel Starts Here -->
								<div style="margin:20px 0px 0px 5px;">
									<input type="hidden" name="mainCat" id="mainCat" value="2">
									<ul class="nav nav-pills nav-stacked col-md-3" style="padding-left:25px;">
                                                                            
                                                                                <li <?php if($glactive == 1){?> class="active" <?php } ?>>
                                                                                        <a href="#tab_a" data-toggle="pill" id="loseWeightId" onmouseup="javascript:$('#loseWeightId').trigger('click');">Lose Weight</a></li><br />
                                                                                <li <?php if($glactive == 2){?> class="active" <?php } ?>>
                                                                                        <a href="#tab_b" data-toggle="pill" id="maintainWeightId" onmouseup="javascript:$('#maintainWeightId').trigger('click');">Maintain Weight</a></li><br />
                                                                                <li <?php if($glactive == 3){?> class="active" <?php } ?>>
                                                                                        <a href="#tab_c" data-toggle="pill" id="gainWeightId" onmouseup="javascript:$('#gainWeightId').trigger('click');">Gain Muscle</a></li>    
									</ul>
										
									<div class="tab-content col-md-9" style="border:2px solid #CC9900; height:auto; margin-left:-5px">
										
										<!-- Lose Weight Starts Here--> 
										<div class="tab-pane fade in active" id="tab_a">
											<span id="loseWeightSpan"></span>
										</div>
										<!-- Lose Weight Ends Here -->
										
										<!-- Maintain Weight Starts Here -->
										<div class="tab-pane fade" id="tab_b">
											<span id="maintainWeightSpan"></span>
										</div>
										<!-- Maintain Weight Ends Here -->
										
										<!-- Gain Weight Starts Here -->
										<div class="tab-pane fade" id="tab_c">
											<span id="gainWeightSpan"></span>
										</div>
										<!-- Maintain Weight Ends Here -->
										
									</div>
								<!-- Panel Ends Here -->
								
								</td>
							</tr>
						</tbody>
					</table>
					
                                        <div class="row" style="border:0px solid green; margin-left:-10px">
							
                                            <div class="table-responsive" Id="showTable1">
                                            <br>													
                                            <table  id="tableId" class="table" style="text-align:center; font-size:18px; border:2px solid #eee">
                                                    <thead>
                                                              <tr style="height:70px;">
                                                                    <td style="background-color:#eee; border-right:0px solid #fff; padding:15px 0px 0px 40px; text-align:left;" colspan=4><h4>My Activities Today</h4></td>
                                                             </tr>
                                                    </thead>
                                                    
                                                    <tbody id="showActivityId">
                                                        <tr style="background-color:#eee; height:55px;">		
                                                            <td style="border:5px solid #fff; padding-top:15px;"><h4>Activity</h4></td>
                                                            <td style="border:5px solid #fff; padding-top:15px;"><h4>Exercise Intensity</h4></td>
                                                            <td style="border:5px solid #fff; padding-top:15px;"><h4>Duration</h4></td>
                                                        </tr>
                                                        <tr style="background-color:#eee; height:55px;">		
                                                            <td style="border:5px solid #fff; padding-top:15px;">-</td>
                                                            <td style="border:5px solid #fff; padding-top:15px;">-</td>
                                                            <td style="border:5px solid #fff; padding-top:15px;">-</td>                                                       
                                                            <td ><input id="btndel" type="button" value="x" /></td>
                                                        </tr>
                                                    </tbody>
                                            </table>
                                            </div>    
                                        </div>
                                        
					<!--Custom Nutrition Calculator Table Starts-->									
						<!--<div class="rows" style="margin-left:-10px">-->
						<div class="row" style="border:0px solid green; margin-left:-10px">
							
								<div class="table-responsive" Id="showTable">
    
								<br>													
								<table class="table" style="text-align:center; font-size:18px; border:2px solid #eee">
									<thead>
										  <tr style="height:70px;">
											<td style="background-color:#eee; border-right:0px solid #fff; padding:15px 0px 0px 40px; text-align:left;" colspan=3><h4>My Nutritional Needs</h4></td>
										 </tr>
									</thead>
									<tbody id="nutritionTbId">
										<tr style="color:#fff; font-weight:bold; height:50px; font-size:18px;">
											<td style="border:5px solid #fff;  padding-top:15px; width:25%">&nbsp;</td>
											<td style="border:5px solid #fff; background-color:#00ADE7; padding-top:15px; width:37%">Post Exercise</td>
											<td style="border:5px solid #fff; background-color:#00ADE7; padding-top:15px; width:37%">Today Requirement</td>
										 </tr>
															
										 <tr style="background-color:#eee; height:55px;">											
											<td style="background-color: #CC9900; color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Calories</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
										  </tr>	
										  
										  <tr style="background-color:#eee; height:55px;">											
											<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Carbohydrate&nbsp;</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
										  </tr>
										  
										  <tr style="background-color:#eee; height:55px;">											
											<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Protein</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
										  </tr>
										  
										  <tr style="background-color:#eee; height:60px;">											
											<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Fat</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
											<td style="border:5px solid #fff; padding-top:15px;">-</td>
										  </tr>
										  													  
										</tbody>
								</table>
									</div>
									</div>
						
						
						<!--Custom Nutrition Calculator Table Ends-->
					
				</div>	
					
				<div class="col-md-3" style="border:0px solid green; padding:0px 5px 0px 5px">	
				<h4 style="margin-top:0px;">My Recommended Products</h4>								
					<span id="showProductListID"></span> <!-- For showing the products -->
				</div>	
			</div>
						
		</div>
	</div>
</section>

</form>
<?php get_footer();