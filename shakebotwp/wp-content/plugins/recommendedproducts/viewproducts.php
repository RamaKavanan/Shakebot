<?php
if ( !is_admin() ) 
{
    echo 'Direct access not allowed.';
    exit;
}
global $wpdb;

$ser = trim($_GET['serbypname']);
$serqry = '';
$serqry = 'SELECT * FROM wp_recommended_products';

if($ser != ''){
	$serqry .= " where productname like '$ser%'";
}

$resultsTmp = $wpdb->get_results($serqry);
$resultPerPage = 10;
$totalNoofrecord = count($resultsTmp);
$totalNoofPages = ceil($totalNoofrecord/$resultPerPage);

if($totalNoofPages == 0){
	$totalNoofPages = 1;
}

$pgd = trim($_GET['paged']);
$nxpgd = $pgd + 1;
$pvpgd = $pgd - 1;

$pgTy = '';
$cnt = 0;
if($pgd == '' || $pgd == 0){
	$pgTy = 'F';
	$cnt++;
}
if($nxpgd == $totalNoofPages){
	$pgTy = 'L';
	$cnt++;
}

$startLimit = 0;
if( $pgd != '' ){
	$startLimit = $pgd * $resultPerPage;
}

if($ser != ''){
	$serqry1 = "productname like '$ser%'";
}else{
	$serqry1 = '1';
}

$results = $wpdb->get_results( 'SELECT * FROM wp_recommended_products where '.$serqry1.'  order by id desc limit '.$startLimit.','.$resultPerPage.'');

?>
<style>
	.bluecls{
		color:#0073aa;
	}
</style>

<script language="javascript">
	function serprod(){
		window.location="admin.php?page=rp-plugin&serbypname="+document.getElementById('serbypname').value;
	}
</script>

<div class='wrap'>
	<form name="viewfrm" id="viewfrm" method="get" action="#" >
	<div class='icon32' id='icon-options-general'><br/></div>
	<h2>Recommended Products <a class="page-title-action" href="admin.php?page=rp-plugin&cal=newproduct">Add Product</a>
		<a class="page-title-action" href="admin.php?page=rp-plugin&cal=importproduct">Import Recommended Products</a>
</h2>
	
	<?php if($_GET['mes'] == 1){?>
		<div class="updated notice"><p>Product Deleted.</p></div>
	<?php } ?>
	
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<p class="search-box">				
				<input type="search" value="<?php echo $_GET['serbypname'];?>" name="serbypname" id="serbypname">
				<input type="button" value="Search with Product Name" onclick="serprod();" class="button" id="search-submit">
			</p>
		</div>
		<div class="alignleft actions"></div>
		<div class="tablenav-pages"><span class="displaying-num"><?php echo $totalNoofrecord;?> items</span>
			<span class="pagination-links">
				
				<?php if($pgTy == 'F' ){?>
					<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
					<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
				<?php }else{?>
					<?php if($cnt<2){?>
						<a href="admin.php?page=rp-plugin&paged=0&serbypname=<?php echo $ser;?>" class="first-page"><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>
						<a href="admin.php?page=rp-plugin&paged=<?php echo $pvpgd;?>&serbypname=<?php echo $ser;?>" class="prev-page"><span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span></a>
					<?php }else{ ?>
						<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
						<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
					<?php }?>
				<?php }?>
				
				<span class="paging-input">
					<label class="screen-reader-text" for="current-page-selector">Current Page</label>
					<?php echo $nxpgd;?> of <span class="total-pages"><?php echo $totalNoofPages;?></span>
				</span>
				
				<?php if($pgTy == 'L' && $cnt<2){?>
					<span aria-hidden="true" class="tablenav-pages-navspan">›</span>				
					<span aria-hidden="true" class="tablenav-pages-navspan">››</span>
				<?php }else{?>
					<?php if($cnt<2){?>
						<a href="admin.php?page=rp-plugin&paged=<?php echo $nxpgd;?>&serbypname=<?php echo $ser;?>" class="next-page"><span class="screen-reader-text">Next page</span>
						<span aria-hidden="true">›</span></a>								
						<a href="admin.php?page=rp-plugin&paged=<?php echo $totalNoofPages-1;?>&serbypname=<?php echo $ser;?>" class="last-page"><span class="screen-reader-text">Last page</span>
						<span aria-hidden="true">»</span></a>
					<?php }else{ ?>
						<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
						<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
					<?php }?>
				<?php }?>
				
			</span>
		</div>
		<br class="clear">
	</div>	

	<table class="wp-list-table widefat fixed striped users">
		
		<thead>
			<tr>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product Name</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Company</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product ASIN</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Calories</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Protein (g)</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Ratio for Carbohydrates to Protein</span></th>
				<!--<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Ratio of Sugar to Carbohydrates</span></th>-->
			</tr>
		</thead>
		
		<tbody>
			<?php if(count($results)>0){
					for($j=0;$j<count($results);$j++){
			?>	
				<tr>
					<th class="manage-column column-role" id="role" scope="col"><img src="<?php echo $results[$j]->productimage;?>" width="60" height="60"></th>
					<th class="manage-column column-role" id="role" scope="col">
					
					<strong>
						<span class="bluecls"><?php echo $results[$j]->productname;?></span>
					</strong><br>
					<div class="row-actions">
						<span class="edit">
							<a href="admin.php?page=rp-plugin&cal=newproduct&prodid=<?php echo $results[$j]->id;?>">Edit</a> | 
						</span>
						<span class="delete">
							<a href="admin.php?page=rp-plugin&cal=delproduct&delid=<?php echo $results[$j]->id;?>" class="submitdelete">Delete</a>
						</span>
					</div>
					
					</th>
					<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->company;?></th>
					<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->asin;?></th>
					<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->calories;?></th>
					<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->protein;?></th>
					<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->ratioctop;?></th>
					<!--<th class="manage-column column-role" id="role" scope="col"><?php echo $results[$j]->ratiostoc;?></th>-->			
				</tr>
			<?php }}else{?>		
				<tr>
					<th class="manage-column column-role" id="role" scope="col" colspan=8>No Records Found.</th>
				</tr>
			<?php }?>
		</tbody>
		
		<tfoot>
			<tr>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product Name</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Company</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Product ASIN</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Calories</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Protein (g)</span></th>
				<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Ratio for Carbohydrates to Protein</span></th>
				<!--<th class="manage-column column-role" id="role" scope="col"><span class="bluecls">Ratio of Sugar to Carbohydrates</span></th>-->
			</tr>
		</tfoot>
		
	</table>
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<!--<p class="search-box">				
				<input type="search" value="<?php //echo $_GET['serbypname'];?>" name="serbypname" id="serbypname">
				<input type="button" value="Search with Product Name" onclick="serprod();" class="button" id="search-submit">
			</p>-->
		</div>
		<div class="alignleft actions"></div>
		<div class="tablenav-pages"><span class="displaying-num"><?php echo $totalNoofrecord;?> items</span>
			<span class="pagination-links">
				
				<?php if($pgTy == 'F' ){?>
					<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
					<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
				<?php }else{?>
					<?php if($cnt<2){?>
						<a href="admin.php?page=rp-plugin&paged=0&serbypname=<?php echo $ser;?>" class="first-page"><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>
						<a href="admin.php?page=rp-plugin&paged=<?php echo $pvpgd;?>&serbypname=<?php echo $ser;?>" class="prev-page"><span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span></a>
					<?php }else{ ?>
						<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
						<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
					<?php } ?>
				<?php } ?>
				
				<span class="paging-input">
					<label class="screen-reader-text" for="current-page-selector">Current Page</label>
					<?php echo $nxpgd;?> of <span class="total-pages"><?php echo $totalNoofPages;?></span>
				</span>
				
				<?php if($pgTy == 'L' && $cnt<2){?>
					<span aria-hidden="true" class="tablenav-pages-navspan">›</span>				
					<span aria-hidden="true" class="tablenav-pages-navspan">››</span>
				<?php }else{ ?>
					<?php if($cnt<2){?>
						<a href="admin.php?page=rp-plugin&paged=<?php echo $nxpgd;?>&serbypname=<?php echo $ser;?>" class="next-page"><span class="screen-reader-text">Next page</span>
						<span aria-hidden="true">›</span></a>								
						<a href="admin.php?page=rp-plugin&paged=<?php echo $totalNoofPages-1;?>&serbypname=<?php echo $ser;?>" class="last-page"><span class="screen-reader-text">Last page</span>
						<span aria-hidden="true">»</span></a>
					<?php }else{ ?>
						<span aria-hidden="true" class="tablenav-pages-navspan">«</span>				
						<span aria-hidden="true" class="tablenav-pages-navspan">‹</span>
					<?php }?>
				<?php }?>
				
			</span>
		</div>
		<br class="clear">
	</div>	
	
	
	</form>
</div>
