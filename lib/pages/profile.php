<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; ?>

<script>
$(document).ready(function(){

	var subpage = location.hash.split('/');

	$(document).on("click", "#nutrition.tile", function() {
		activetile = "nutrition";
		$('.tile').removeClass("active");
		$("#nutrition.tile").addClass("active");
	});
	$(document).on("click", "#research.tile", function() {
		activetile = "research";
		$('.tile').removeClass("active");
		$("#research.tile").addClass("active");
	});
	$(document).on("click", "#settings.tile", function() {
		activetile = "settings";
		$('.tile').removeClass("active");
		$("#settings.tile").addClass("active");
	});
	$(document).on("click", "#history.tile", function() {
		activetile = "history";
		$('.tile').removeClass("active");
		$("#history.tile").addClass("active");
	});


	$(document).on('click', '#calculate', function(){
		$('.postBtn').addClass('active');

		$('.btnSave').removeClass('disabled');
		var duration = $('input[name=hours]').val();
		
		if($('option:selected').val() == 'Repeated High Intensity'){
			var weight = $('input[name=weight]').val();
			
			var fat = weight * 0.01;
			var pro = weight * 0.3;
			var carb = weight * 0.8;
			var bcaa = weight * 0.05;
			var cal = (pro * 4) + (fat * 9) + (carb * 4);
			var dfat = (weight * 0.3) + ((8.62 * duration * weight * 0.15) / 9);
			var dpro = (weight * 1.6) + ((8.62 * duration * weight * 0.25) / 4);
			var dcarb = (weight * 5) + ((8.62 * duration * weight * 0.6) / 4);
			var dbcaa = weight * 0.1;
			var dcal = (dpro * 4) + (dfat * 9) + (dcarb * 4);

			var fat = Math.round(fat);
			var pro = Math.round(pro);
			var carb = Math.round(carb);
			var bcaa = Math.round(bcaa);
			var cal = Math.round(cal);
			var dfat = Math.round(dfat);
			var dpro = Math.round(dpro); 
			var dcarb = Math.round(dcarb);
			var dbcaa = Math.round(dbcaa);
			var dcal = Math.round(dcal);

			$('.fatReq').html(fat + 'g');
			$('.proReq').html(pro + 'g');
			$('.carbReq').html(carb + 'g');
			$('.bcaaReq').html(bcaa + 'g');
			$('.calReq').html(cal + ' calories');

			$('.dailyfatReq').html(dfat + 'g');
			$('.dailyproReq').html(dpro + 'g');
			$('.dailycarbReq').html(dcarb + 'g');
			$('.dailybcaaReq').html(dbcaa + 'g');
			$('.dailycalReq').html(dcal + ' calories');
		} 
		// else if($('option:selected').val() == 'Endurance'){
			
		// 	var weight = $('input[name=weight]').val();
			
		// 	var fat = weight * 0.01;
		// 	var pro = weight * 0.3;
		// 	var carb = weight * 1.2;
		// 	var bcaa = weight * 0.05;
		// 	var cal = (pro * 4) + (fat * 9) + (carb * 4);

		// 	var dfat = (weight * 0.3) + ((6.9 * duration * weight * 0.1) / 9);
		// 	var dpro = (weight * 1.4) + ((6.9 * duration * weight * 0.2) / 4);
		// 	var dcarb = (weight * 7) + ((6.9 * duration * weight * 0.7) / 4);
		// 	var dbcaa = weight * 0.1;
		// 	var dcal = (dpro * 4) + (dfat * 9) + (dcarb * 4);

		// 	var fat = Math.round(fat);
		// 	var pro = Math.round(pro);
		// 	var carb = Math.round(carb);
		// 	var bcaa = Math.round(bcaa);
		// 	var cal = Math.round(cal);
		// 	var dfat = Math.round(dfat);
		// 	var dpro = Math.round(dpro); 
		// 	var dcarb = Math.round(dcarb);
		// 	var dbcaa = Math.round(dbcaa);
		// 	var dcal = Math.round(dcal);

		// 	$('.fatReq').html(fat + 'g');
		// 	$('.proReq').html(pro + 'g');
		// 	$('.carbReq').html(carb + 'g');
		// 	$('.bcaaReq').html(bcaa + 'g');
		// 	$('.calReq').html(cal + ' calories');


		// 	$('.dailyfatReq').html(dfat + 'g');
		// 	$('.dailyproReq').html(dpro + 'g');
		// 	$('.dailycarbReq').html(dcarb + 'g');
		// 	$('.dailybcaaReq').html(dbcaa + 'g');
		// 	$('.dailycalReq').html(dcal + ' calories');
		// } else if($('option:selected').val() == 'Skill'){

		// 	var weight = $('input[name=weight]').val();
			
		// 	var fat = weight * 0.01;
		// 	var pro = weight * 0.3;
		// 	var carb = weight * 0.3;
		// 	var bcaa = weight * 0.05;
		// 	var cal = (pro * 4) + (fat * 9) + (carb * 4);

		// 	var dfat = (weight * 0.3) + ((5.17 * duration * weight * 0.2) / 9);
		// 	var dpro = (weight * 1.8) + ((5.17 * duration * weight * 0.3) / 4);
		// 	var dcarb = (weight * 5) + ((5.17 * duration * weight * 0.5) / 4);
		// 	var dbcaa = weight * 0.1;
		// 	var dcal = (dpro * 4) + (dfat * 9) + (dcarb * 4);

		// 	var fat = Math.round(fat);
		// 	var pro = Math.round(pro);
		// 	var carb = Math.round(carb);
		// 	var bcaa = Math.round(bcaa);
		// 	var cal = Math.round(cal);
		// 	var dfat = Math.round(dfat);
		// 	var dpro = Math.round(dpro); 
		// 	var dcarb = Math.round(dcarb);
		// 	var dbcaa = Math.round(dbcaa);
		// 	var dcal = Math.round(dcal);

		// 	$('.fatReq').html(fat + 'g');
		// 	$('.proReq').html(pro + 'g');
		// 	$('.carbReq').html(carb + 'g');
		// 	$('.bcaaReq').html(bcaa + 'g');
		// 	$('.calReq').html(cal + ' calories');

			
		// 	$('.dailyfatReq').html(dfat + 'g');
		// 	$('.dailyproReq').html(dpro + 'g');
		// 	$('.dailycarbReq').html(dcarb + 'g');
		// 	$('.dailybcaaReq').html(dbcaa + 'g');
		// 	$('.dailycalReq').html(dcal + ' calories');
		// }
	});

	$(document).on('click', '.btnSave', function(){
		var fatreq = $('.dailyfatReq').html();
		var proreq = $('.dailyproReq').html();
		var carbreq = $('.dailycarbReq').html();
		var bcaareq = $('.dailybcaaReq').html();
		var calreq = $('.dailycalReq').html();
		var weight = $('.curWeight').val();
		var type = $('.activitySelect :selected').val();
		var activity = $('.activitySelect :selected').text();

		$.ajax({
			url: 'lib/functions/saveCalculation.php?fat='+fatreq+'&pro='+proreq+'&carb='+carbreq+'&bcaa='+bcaareq+'&cal='+calreq+'&weight='+weight+'&activity='+activity+'&type='+type,
			type: 'GET',
			success: function(response){
				buildAlert("Your information has been saved and will appear as part of your history.");
			}
		});

	});

	$(document).on('click', '.postBtn', function(e){
		e.preventDefault();
		$('.nutritionView').hide();
		$('.postWorkout').fadeIn('fast');
		$('.subnav ul li a').removeClass('active');
		$('.postBtn').addClass('active');
		$('.small-12 h1').html($(this).html());
	});

	$(document).on('click', '.dailyBtn', function(e){
		e.preventDefault();
		$('.nutritionView').hide();
		$('.dailyNeeds').fadeIn('fast');
		$('.subnav ul li a').removeClass('active');
		$('.dailyBtn').addClass('active');
		$('.small-12 h1').html($(this).html());
	});


	$(document).on('click', '.delete', function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
	});

	$("#fileuploader2").uploadFile({
			url:"/lib/functions/uploadCover.php",
			fileName:"files",
			onSuccess:function(files,data,xhr){
			alert(data);
			$('.cover-photo').css('background-image', 'url(' + data + ')');
			}
		});

	$('.tileContainer').sortable();
});
</script>

<div class="row rowFull">
	<div class="small-10 small-centered columns">
		<div class="header-row">
			<div class="row">
				<div id="profileHeaderDynamic" class="small-5 columns">
					<div class="row">
						<div class="avatar-container">
							<div id="avatar" style="background-image:url('<?php echo $loggedInUser->avatar; ?>');"></div>
						</div>
						<div class="" style="float: left;">
							<h2 class="name"><?php echo $loggedInUser->fullname; ?></h2>
							<p class="headerActivities">
								<?php if($loggedInUser->dispAct == 'Display'){
									?>
									<b>Primary Activity:</b><br><?php echo ''.$loggedInUser->activity; ?>
									<?php } ?><br>

									<?php if($loggedInUser->dispHeight == 'Display'){
									?>
									<div style="display: inline-block; margin-right: 2em;">
										<b>Height:</b><br> <?php echo $loggedInUser->heightfeet; ?>
										<br />
									</div>
									<?php } ?>
									
									<?php if($loggedInUser->dispWeight == 'Display'){
									?>
									<div style="display: inline-block;"><b>Weight:</b><br><?php echo $loggedInUser->weight . ' ' . $loggedInUser->weighttype; ?></div>
								<?php } ?>
							</p>
						</div>
					</div>
				</div>
				<div class="small-7 columns tileBottom">
					<div class="tiles">
						<div class="tileContainer">
							<!-- Tile -->
							<div id="nutrition" class="tile small-3" data-href="nutrition">
								<!-- <i class="fa fa-times delete"></i>
								<i class="fa fa-pencil edit"></i> -->
								<i class="tileIcon fa fa-heartbeat"></i>
								<span class="tileTitle">My Nutrition</span>
							</div>

							<!-- Tile -->
							<div id="history" class="tile small-3" data-href="history">
								<!-- <i class="fa fa-times delete"></i>
								<i class="fa fa-pencil edit"></i> -->
								<i class="tileIcon fa fa-calendar"></i>
								<span class="tileTitle">History</span>
							</div>

							<!-- Tile -->
							<div id="settings" class="tile small-3" data-href="settings">
								<!-- <i class="fa fa-times delete"></i>
								<i class="fa fa-pencil edit"></i> -->
								<i class="tileIcon fa fa-user"></i>
								<span class="tileTitle">Profile</span>
							</div>

							<!-- Tile -->
							<div id="research" class="tile small-3" data-href="research">
								<!-- <i class="fa fa-times delete"></i>
								<i class="fa fa-pencil edit"></i> -->
								<i class="tileIcon fa fa-user"></i>
								<span class="tileTitle">Research</span>
							</div>
						</div>

						<?php if($loggedInUser->accountType == 'coach'){ ?>
							<span class="tile" data-href="settings">
								<span class="delete">&times;</span>
									<span class="edit"><span class="fa fa-pencil"></span></span>
									<i class="tileIcon fa fa-th"></i>
								<span class="tileTitle">Coach View</span>
							</span>
						<?php } ?>
					</div>
				</div>
				<div class="controlButtons">
					<div class="coverFormContainer"><div id="fileuploader2">Change Background</div></div>
					<div class="customizeButtons">
						<button data-tooltip title="Add Tiles" class="addButton"><span class="fa fa-plus"> </span></button>
						<button data-tooltip title="Remove Tiles" class="removeButton"><span class="fa fa-minus"> </span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		<!--
		<div class="small-9 columns">
			<b>Height: </b><?php echo $loggedInUser->height; ?>"<br />
			<b>Weight: </b><?php echo $loggedInUser->weight; ?> lbs<br />
		</div>
		-->

	<!--
	<div class="row profile-menu">
		<ul class="profile-nav">
		<li><a href="" class="active">Dashboard</a></li>
		<li><a href="">Nutrition</a></li>
		<li><a href="">History</a></li>
		<li><a href="">Friends</a></li>
		<li><a href="">Settings</a></li>

		</ul>

	</div>
-->

<div class="row contentRow">
	<div class="small-10 small-centered columns">
		<div class="profilePage">

		</div>
	</div>

<!-- 	<div class="small-3 columns">
		<div class="shakebotProducts">
			<ul class="shakebot-products-footer">
				<li>
					<a ui-sref="products" href="#/products"><img src="img/shopping-placeholder.jpg" class="footer-img">
					<span class="footer-link">Shakebot Product 1<br>$24.99</span></a>
				</li>
				<li>
					<a ui-sref="products" href="#/products"><img src="img/shopping-placeholder.jpg" class="footer-img">
					<span class="footer-link">Shakebot Product 2<br>$24.99</span></a>
				</li>
				<li class="recommended">
					<a ui-sref="products" href="#/products"><img src="img/shopping-placeholder.jpg" class="footer-img">
					<span class="footer-link">Shakebot Product 3<br>$24.99</span></a>
				</li>
			</ul>
		</div>
	</div> -->
</div>
