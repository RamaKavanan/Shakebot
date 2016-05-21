<?php /* Template Name: myrecommended */?>
<?php
get_header(); 

$nutitable = 'wp_nutri_calculation';
$usrDet = wp_get_current_user();
$uid = $usrDet->ID;

$myrows = $wpdb->get_row("SELECT goal_type FROM $nutitable where user_id=$uid order by addedon desc" );
$glactive = 2;
if($myrows->goal_type){$glactive = $myrows->goal_type;}

?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/mynutrition.css">
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/jquery-1.8.3.min.js"></script>

<!-- For slider -->
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/starter/css/ui.css">
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/ui.js"></script>

<!-- For accordian -->
<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/woco.accordion.min.js"></script>
<link href="<?php echo site_url(); ?>/wp-content/themes/starter/css/woco-accordion.min.css" rel="stylesheet">

<script src="<?php echo site_url(); ?>/wp-content/themes/starter/js/filter.js"></script>

<style>
	.accordion
	{
		max-width: 300px;
		margin: 5px auto;
	}
	.accordion1
	{
		max-width: 300px;
		margin: 5px auto;
	}	
	
	.accordion1 .accordion-header{
		background-color:#3F3F3F !important;
		color:#fff !important;
	}
	.accordion1 h1{
		color:#fff !important;
	}

.pbSubmit11{
	 background: none repeat scroll 0 0 #DBDBDB;
    border: medium none;
    border-radius: 5px;
    color: #3F3F3F;
    float: left;
    font-family: "Raleway",sans-serif;    
    padding: 3px 5px;    
    transition: all 0.3s ease 0s;  
    font-size:11px;
    margin:3px;
}

.pbSubmit11cls{
	cursor: pointer;
	margin-top:-1px;
}

.current{
background: #34495e !important;
border-color: #34495e !important;
color:#fff !important;
}
</style>

<form name="frm" id="frm" action="" method="POST">
<input type="hidden" name="subCategoryHd" id="subCategoryHd" value="">
<input type="hidden" name="uidHd" id="uidHd" value="<?php echo $uid;?>">

<input type="hidden" name="selFilCnthd" id="selFilCnthd" value=0>
<input type="hidden" name="sortTyhd" id="sortTyhd" value="lth">
<input type="hidden" name="showdIdshd" id="showdIdshd" value="<?php echo $_GET['showdIdshd'];?>">	
<input type="hidden" name="resultCatTypehd" id="resultCatTypehd" value="<?php echo $_GET['resultCatTypehd']?>">	
<input type="hidden" name="paginationPage" id="paginationPage" value="1">

<section id="main" >
	<div class="container" style="border:0px solid red; padding:0px;">
		
		<div class="row"  style="border:0px solid green; padding:0px;">						
								
			<div class="col-md-12"  style="border:0px solid red; padding:0px;">	
			
				<div class="col-md-9" style="border:0px solid black; overflow:hidden;" >
					<div class="row" style="margin-bottom:5px; ">
						<!--<div style="background-color:#eee; padding:20px 0px 20px 20px; border:0px solid green" class="col-md-8">-->
						<div style="background-color:#eee; padding:7px 10px; border-bottom:1px solid #eee" class="col-md-8">
							<h4>Products</h4>
						</div>
						
						<!--<div style="background-color:#eee; padding:18px 5px 18px 0px; border:0px solid red; min-height:40px" class="col-md-4">-->							
						<div style="background-color:#eee; padding:7px; border:0px solid red; min-height:40px" class="col-md-4">
							<a href="<?php echo site_url(); ?>/index.php/my-nutrition/"><input type="button" class="pbSubmit" value="Back to Nutrition Calculation"  style="margin-left:0px; float:right; padding:8px;"></a>
						</div>
					</div>
				
					<div id="showProductListIDFilter"></div> <!-- For showing the products -->
					<br /><div style='float:left;' id="paginationId"></div><br /><br />
				
				
				</div>	
					
				<div class="col-md-3" style="border:0px solid green; padding:0px 5px 0px 5px">
				<input type="hidden" name="selFilCnthd" id="selFilCnthd" value=0>
				<input type="hidden" name="showdIdsMinushd" id="showdIdsMinushd" value="1">
				<input type="hidden" name="sortTyhd" id="sortTyhd" value="lth">
					
					<!-- Sorting part -->
					<div style="border:1px solid #E0E0E0; back-ground:#ddd; background:#ADADAD; height:130px; padding:5px; margin: 0px auto 5px auto; max-width: 300px;">
						<span style="font-size:13px">&nbsp;<b>SORT BY</b></span>					
						<div>							
							<select class="medium" id="sortFilters" name="sortFilters">
								<!--<option value="">Select</option>-->
								<option value="PRICE">PRICE</option>
								<option value="SHAKEBOT RATING" selected="selected">SHAKEBOT RATING</option>
								<!--<option value="AMAZON RATING">AMAZON RATING</option>-->
								<option value="PROTEIN PER SERVING">PROTEIN PER SERVING</option>
								<option value="CARBS PER SERVING">CARBS PER SERVING</option>
								<option value="SUGAR PER SERVING">SUGAR PER SERVING</option>
								<option value="FAT PER SERVING">FAT PER SERVING</option>
								<option value="CALORIES PER SERVING">CALORIES PER SERVING</option>
							</select>
							
							<div style="float:left">
								<input type="button" class="pbSubmit" value="Low to High" style="padding:8px 15px;" id="sortltoh">
							</div> 
							<div style="float:right">
								<input type="button" class="pbSubmit" value="High to Low" style="padding:8px 15px; background-color:#DBDBDB; color:#3F3F3F;" id="sorthtol">
							</div>
						</div>
					</div>
					
					<!-- My Filters part starts-->
					<div style="cursor: pointer;border:1px solid #E0E0E0; background-color:#3F3F3F; color:#fff; font-size: 13px; font-weight:bold; padding:5px;  max-width: 300px;" id="myFiltersDivShow">&nbsp;&nbsp;MY FILTERS
						<i id="myFiltercornerIcon" class="fa fa-caret-down" style="float:right; padding: 3px 8px;color: #888;font-size: 20px;"></i>					
					</div>
					<div id="myFiltersDiv" style="background-color:#eee; margin-bottom:5px; min-height:50px; height:auto; padding:15px; max-width:300px;">
						No Filter Selected.
					</div>
					<!-- My Filters part ends-->
					
					<!-- Filters part starts -->
					<div style="cursor: pointer;border:1px solid #E0E0E0; background-color:#3F3F3F; color:#fff; font-size: 13px; font-weight:bold; padding:5px;  max-width: 300px; margin-top:4px" id="filterPanelShow">&nbsp;&nbsp;FILTER BY
						<i id="cornerIcon" class="fa fa-caret-up" style="float:right; padding: 3px 8px;color: #888;font-size: 20px;"></i>						
					</div>
					<div id="filterPanel" style="margin-top:-5px; min-width:270px; max-width:300px;">
					<div class="accordionMain">
						<div class="accordion">
							<div style="border:1px solid #E0E0E0; back-ground:#ddd; background:#f2f2f2; height:50px;">
								<p style="margin:5px">
									<input type="text" class="medium" id="brandFIlter" value="" placeholder="Search for a brand" maxlength="20">
									<!--<input type="text" class="medium" id="brandFIlter1" value="aa" placeholder="Search for a brand">-->
								</p>
							</div>

							<h1>Refine by <b>PRICE</b>&nbsp;($)</h1>					
							<div >
								<div id="slider-range"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-rangerg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-rangerg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<h1>Refine by <b>SHAKEBOT RATING</b></h1>
							<div>
								<div id="slider-range1"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range1rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range1rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<!--<h1>Refine by <b>AMAZON RATING</b></h1>
							<div>
								<div id="slider-range2"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range2rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range2rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>-->

							<h1>Refine by <b>PROTEIN PER SERVING</b>&nbsp;(g)</h1>
							<div>
								<div id="slider-range3"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range3rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range3rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<h1>Refine by <b>CARBS PER SERVING</b>&nbsp;(g)</h1>
							<div>
								<div id="slider-range4"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range4rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range4rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<h1>Refine by <b>SUGAR PER SERVING</b>&nbsp;(g)</h1>
							<div>
								<div id="slider-range5"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range5rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range5rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<h1>Refine by <b>FAT PER SERVING</b>&nbsp;(g)</h1>
							<div>
								<div id="slider-range6"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range6rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range6rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<h1>Refine by <b>CALORIES PER SERVING</b></h1>
							<div>
								<div id="slider-range7"></div>
								<p style="padding-top:13px;">&nbsp;
									<span style="float:left;"><input type="text" id="slider-range7rg1" readonly style="border:1; width: 40px; line-height: normal;"></span>
									<span style="float:right;"><input type="text" id="slider-range7rg2" readonly style="border:1; width: 40px; line-height: normal;"></span>
								</p>
							</div>

							<div style="border:1px solid #E0E0E0; back-ground:#ddd; background:#f2f2f2; height:55px; padding:5px; ">
									<input type="button" class="pbSubmit" value="APPLY FILTERS" style="margin-left:70px; padding:8px;" id="applyFilterId">
							</div>
						</div>
					</div>
					</div>
					<!-- Filters part ends -->
				
				<span  class="pbSubmit11cls"></span>
										
				</div>	
			</div>
						
		</div>
	</div>
</section>

</form>
<?php get_footer();
