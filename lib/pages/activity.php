<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; ?>
<script>
	$(document).ready(function(){
		$('#historyTable').DataTable({
					paging: true,
					searching: true,
    				ordering:  true
				});
	});
</script>

<div class="">
	<h1>Activity Feed</h1>
	<div class="updateContainer">
	<div class="updateHeader">
	<div class="updateAvatar" style="background:url('<?php echo $loggedInUser->avatar; ?>');"> </div>
	<h3><?php echo $loggedInUser->fullname; ?></h3>
	<div class="updateMeta">Posted at 4:10PM on November 16, 2014</div>
	</div>
	
	<div class="updateBody">
	<p>So excited.  Just lost 5 pounds.</p>
	</div>
	</div>



	<div class="updateContainer">
	<div class="updateHeader">
	<div class="updateAvatar" style="background:url('<?php echo $loggedInUser->avatar; ?>');"> </div>
	<h3><?php echo $loggedInUser->fullname; ?></h3>
	<div class="updateMeta">Posted at 3:58PM on November 1, 2014</div>
	</div>
	
	<div class="updateBody">
	<p>Another post of activity.</p>
	</div>
	</div>



	<div class="updateContainer">
	<div class="updateHeader">
	<div class="updateAvatar" style="background:url('<?php echo $loggedInUser->avatar; ?>');"> </div>
	<h3><?php echo $loggedInUser->fullname; ?></h3>
	<div class="updateMeta">Posted at 4:10PM on November 16, 2014</div>
	</div>
	
	<div class="updateBody">
	<p><?php echo $loggedInUser->fullname; ?> earned the achievement "Title".</p>
	</div>
	</div>
	</div>