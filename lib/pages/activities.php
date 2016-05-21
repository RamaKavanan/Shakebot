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
	<h1>Activities</h1>
	<?php getUserActivities(); ?>
	</div>