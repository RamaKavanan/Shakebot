<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; 

?>



<script type="text/javascript">
	function getProfileHeader(){
		$.ajax({
			url: 'lib/functions/getProfileHeader.php',
			type: 'get',
			success: function(response){
				$('#profileHeaderDynamic').html(response);

				
			}
		});

	};


	$(document).ready(function(){
		
		$('select[name=height]').val('<?php echo $loggedInUser->height; ?>').change();
		
		$('select[name=activity]').find('option:contains(<?php echo $loggedInUser->activity; ?>)').attr('selected', true);

		<?php if($loggedInUser->dispDob == 'Display'){
			?>

		$('#dispDob').attr('checked', true);

		<?php }

		?>

		<?php if($loggedInUser->dispHeight == 'Display'){
			?>

		$('#dispHeight').attr('checked', true);

		<?php }

		?>

		<?php if($loggedInUser->dispAct == 'Display'){
			?>

		$('#dispAct').attr('checked', true);

		<?php }

		?>

		<?php if($loggedInUser->dispWeight == 'Display'){
			?>

		$('#dispWeight').attr('checked', true);

		<?php }

		?>

		$(document).on('click', '#saveProfile', function(){
			var form = $('#settings-form');			
			$.ajax({
				url: 'lib/functions/saveProfile.php',
				type: 'post',
				data: form.serialize(),
				success: function(response){					
					buildAlert("Your profile has been saved.  Your profile will now reload.");
					getProfileHeader();
					setTimeout(function(){
					location.reload();
				},5000);
				
				}
			});
		});
		$("#fileuploader").uploadFile({			
			url:"/lib/functions/upload-avatar.php",
			method: "POST",
			fileName:"files",
			onSuccess:function(files,data,xhr){						
			$('#avatar').css('background-image', 'url(' + data + ')');
			},
			onError: function(files,status,errMsg)
			{      
				alert(files+','+status+','+errMsg);
			}
		});
	});
</script>

<!--<div class="row">
	<div class="small-12 small-centered columns">	
		<h1>My Profile</h1>-->
	<div class="row">	

	<div class="small-10 columns">
		<h2>My Profile</h2>
		<form id="settings-form">
		<!--Settingsaa
		<br />-->

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Name: 
			</div>
			<div class="small-3 columns">
				<input type="text" name="firstname" placeholder="First Name" value="<?php echo $loggedInUser->firstname; ?>" />
			</div>
			<div class="small-3 columns">
				<input type="text" name="lastname" placeholder="Last Name" value="<?php echo $loggedInUser->lastname; ?>" />
			</div>
			<div class="small-6 columns"></div>
		</div>

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Date of Birth:
			</div>
			<div class="small-5 columns">
				<!--<input type="date" name="dob" placeholder="Date of Birth" value="<?php //echo $loggedInUser->birthdate; ?>" />-->
				 <input type="text" id="datepicker" placeholder="Date of Birth" >				 
			</div>
			<div class="small-3 columns switchPaddingTop">
				<div class="switch small">
					<input id="dispDob" type="checkbox" name="dispDob" value="Display">
					<label for="dispDob">Display</label>
				</div><span class="radio-title">Display</span>
			</div>
			<div class="small-6 columns"></div>
		</div>

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Primary Activity:
			</div>
			<div class="small-5 columns">
				<select name="activity" id="activity" class="empty">
					<?php getProfileActivities(); ?>
				</select>
			</div>
			<div class="small-2 columns switchPaddingTop">
				<div class="switch small">
					<input id="dispAct" type="checkbox" name="dispAct" value="Display">
					<label for="dispAct">Display</label>
				</div><span class="radio-title">Display</span>
			</div>
			<div class="small-6 columns"></div>
		</div>

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Weight:
			</div>
			<div class="small-5 columns">
				<input type="number" name="weight" placeholder="Weight" value="<?php echo $loggedInUser->weight; ?>" />
			</div>
			<div class="small-5 columns switchPaddingTop">
				<div class="switch small">
					<input id="dispWeight" type="checkbox" name="dispWeight" value="Display">
					<label for="dispWeight">Display</label>
				</div><span class="radio-title">Display</span>
			</div>
			<div class="small-6 columns"></div>
		</div>

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Weight Units:
			</div>
			<div class="small-2 columns switchPaddingTop">
				<div class="switch small">
					<input id="exampleRadioSwitch1" type="radio" checked name="weighttype" value="pounds">
					<label for="exampleRadioSwitch1">Pounds (lbs)</label>
				</div><span class="radio-title">Pounds</span>
			</div>
			<div class="small-5 columns switchPaddingTop">
				<div class="switch small">
					<input id="exampleRadioSwitch2" type="radio" name="weighttype" value="kilograms">
					<label for="exampleRadioSwitch2">Kilograms (Kg)</label>
				</div><span class="radio-title">Kilograms</span>
			</div>
			<div class="small-6 columns"></div>
		</div>

		<div class="row">
			<div class="small-2 columns labelPaddingTop">
				Height: 
			</div>
			<div class="small-5 columns">				
				<select name="height" id="height" class="empty">
					<option value="0" selected="selected">Height</option>					
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
			</div>

			<div class="small-3 columns switchPaddingTop">
				<div class="switch small">
					<input id="dispHeight" type="checkbox" name="dispHeight" value="Display">
					<label for="dispHeight">Display</label>
				</div> <span class="radio-title">Display</span>
			</div>
			<div class="small-6 columns"></div>
		</div>

		</form>

		<div class="row">
			<div class="small-8 columns">
				<button id="saveProfile" class="button buttonSuccess right">Save Profile</button>
			</div>
			<div class="small-6 columns"></div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="small-4 columns" style="margin-left:-14px;">
		Avatar
		<div class="avatar-container">
			<div id="avatar" style="background-image:url('<?php echo $loggedInUser->avatar; ?>');"></div>
		</div>
		<!--<div id="fileuploader">Upload</div>-->
		
		<div style="vertical-align: top; width: 520px;" class="ajax-upload-dragdrop"><div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">Upload<form enctype="multipart/form-data" action="/lib/functions/upload-avatar.php" method="POST" style="margin: 0px; padding: 0px;"><input type="file" multiple="" accept="*" name="files[]" id="ajax-upload-id-1441789311234" style="position: absolute; cursor: pointer; top: 0px; width: 100%; height: 100%; left: 0px; z-index: 100; opacity: 0;"></form></div><span><b>Drag &amp; Drop Files</b></span></div>
		<!--<div id="fileuploader" style="display: none;">Upload</div>-->
		<div></div>
		
	</div>
</div>	

	<!--</div>
</div>-->
