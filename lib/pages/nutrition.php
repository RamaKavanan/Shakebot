<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; ?>
<script>
	$(document).ready(function(){

		$('input[name=hours]').on('change', function(){
			if($(this).val() < 0){
				$(this).val('0');			
			}
		});

		if ($(activetile == "nutrition")) {
	      $(tiles).removeClass("active");
	      $(tile_nut).addClass("active");
	    } else if ($(activetile == "history")) {
	      $(tiles).removeClass("active");
	      $(tile_his).addClass("active");
	    } else if ($(activetile == "settings")) {
	      $(tiles).removeClass("active");
	      $(tile_set).addClass("active");
	    } else if ($(activetile == "research")) {
	      $(tiles).removeClass("active");
	      $(tile_set).addClass("active");
	    };	

	});
</script>
<div class="row">

	<div class="small-4 columns">
		<h3 class="title">Your Activities</h3>
		<form class="stats-input">
			
			<div class="row">
				<div class="large-12 columns">
				  <label>&nbsp;Weight (kg)
					<input type="number" class="curWeight" name="weight" value="<?php echo $loggedInUser->weight; ?>" placeholder="Weight" style="margin:0px;" />				  
				  </label>
				</div>
			</div>
			
			<div class="row">
				<div class="large-12 columns">
					<label>&nbsp;Height
						<!--<p><?php //echo $loggedInUser->heightfeet; ?></p>-->
						<select name="height" id="height" class="activitySelect">
							<option value="0">Height</option>
							<option value="60">5'0"</option>
							<option value="61">5'1"</option>
							<option value="62">5'2"</option>
							<option value="63">5'3"</option>
							<option value="64">5'4"</option>
							<option value="65">5'5"</option>
							<option value="66">5'6"</option>
							<option value="67">5'7"</option>
							<option value="68">5'8"</option>
							<option value="69">5'9"</option>
							<option value="70">5'10"</option>
							<option value="71">5'11"</option>
							<option value="72">5'12"</option>
							<option value="73">6'0"</option>
							<option value="74">6'1"</option>
							<option value="75">6'2"</option>
							<option value="76">6'3"</option>
							<option value="77">6'4"</option>
							<option value="78">6'5"</option>
							<option value="79">6'6"</option>
							<option value="80">6'7"</option>
							<option value="81">6'8"</option>
							<option value="82">6'9"</option>
							<option value="83">6'10"</option>
							<option value="84">6'11"</option>
							<option value="85">6'12"</option>					
						</select>
					</label>
				</div>
			</div>
			
			<div class="row" style="margin-top:5px;">
				<div class="large-12 columns">
				  <label>&nbsp;Primary Activity
				    <select name="activity" class="activitySelect"><?php getActivities(); ?></select>
				  </label>
				</div>
			</div>
			
			<div class="row" style="margin-top:5px;">
				<div class="large-12 columns">
					<label>&nbsp;Duration in hours
						<input type="number" name="hours" placeholder="Duration" />
					</label>
				</div>
			</div>
			
			<div class="row" style="margin-top:5px;">
				<div class="large-12 columns">
					<button class="button Success" id="calculate" style="width:48%;">Calculate</button><button class="button right" style="width:48%;">Save</button>
				</div>
			</div>
			
		</form>
	</div>
	
	<div class="small-4 columns postWorkout nutritionView">
		<h3 class="title">Nutritional Needs</h3>
		<table class="requirements-table">
			<thead>
				<tr>
				  <th></th>
				  <th>Post Workout</th>
				  <th>Daily Requirement</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td>Calories: </td>
				  <td><span class="calReq"> </span></td>
				  <td><span class="dailycalReq"> </span></td>
				</tr>
				<tr>
				  <td>Fat: </td>
				  <td><span class="fatReq"> </span></td>
				  <td><span class="dailyfatReq"> </span></td>
				</tr>
				<tr>
				  <td>Protein: </td>
				  <td><span class="proReq"> </span></td>
				  <td><span class="dailyproReq"> </span></td>
				</tr>
				<tr>
				  <td>Carbohydrates: </td>
				  <td><span class="carbReq"> </span></td>
				  <td><span class="dailycarbReq"> </span></td>
				</tr>
				<tr>
				  <td>BCAA: </td>
				  <td><span class="bcaaReq"> </span></td>
				  <td><span class="dailybcaaReq"> </span></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="small-4 columns recommendedProducts">
		<h3 class="title">Recommended Product</h3>
		<div class="row">
			<div class="large-12 columns">
				<div class="row product">
					<div class="large-4 columns">
						<img src="img/shakebot_recommendedproduct.png" />
					</div>
					<div class="large-8 columns">
						<h4>Recommended Product 1</h4>
						<p>Protein: 18g</p>
						<p>BCAA: 20g</p>
						<p>Fast Acting</p>
						<button class="purchase" id="recommended2">Buy Now</button>
					</div>
				</div>
				<div class="row product">
					<div class="large-4 columns">
						<img src="img/shakebot_recommendedproduct.png" />
					</div>
					<div class="large-8 columns">
						<h4>Recommended Product 2</h4>
						<p>Protein: 12g</p>
						<p>BCAA: 16g</p>
						<p>Fast Acting</p>
						<button class="purchase" id="recommended2">Buy Now</button>
					</div>
				</div>
				<div class="row product">
					<div class="large-4 columns">
						<img src="img/shakebot_recommendedproduct.png" />
					</div>
					<div class="large-8 columns">
						<h4>Recommended Product 3</h4>
						<p>Protein: 14g</p>
						<p>BCAA: 26g</p>
						<p>Fast Acting</p>
						<button class="purchase" id="recommended3">Buy Now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
