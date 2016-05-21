<?php
if ( !is_admin() ) 
{
    echo 'Direct access not allowed.';
    exit;
}
global $wpdb;

if(isset($_POST['deleproductsub'])){
	$wpdb->delete( 'wp_recommended_products', array( 'id' => $_GET['delid'] ), array( '%d' ) );
	
	$f1 = explode("wp-content/uploads",trim($_POST['prevpimage']));
	$unlinkFile = "/var/www/wordpress/wp-content/uploads".$f1[1];			
	unlink($unlinkFile);
	
	echo "<script language='javascript'>document.location='admin.php?page=rp-plugin&mes=1	';";
	echo "</script>";
	exit;
}

$delresult = $wpdb->get_results( 'SELECT * FROM wp_recommended_products where id='.$_GET['delid'].'');

//print_r($delresult);
?>
<style>
	.bluecls{
		color:#0073aa;
	}
</style>
<div class='wrap'>
	<div class='icon32' id='icon-options-general'><br/></div>
	<h2>Delete Product <a class="page-title-action" href="admin.php?page=rp-plugin">View Products</a></h2>
	<br />
	
	<form method="post" name="delproduct" id="delproduct">		
		<table class="form-table" style="width:45%">
			<tr style="font-size:20px;">
				<td style="padding-top:15px;" rowspan="5">
					<img src="<?php echo $delresult[0]->productimage;?>" width="120px">
				</td>
				<td style="padding-top:20px;" ><?php echo $delresult[0]->productname;?></td>
			</tr>
			<input type="hidden" name="prevpimage" id="prevpimage" value="<?php echo $delresult[0]->productimage;?>">
			<tr style="font-size:19px;">
				<td>Protein: <?php echo $delresult[0]->protein;?></td>								
			</tr>
			<tr style="font-size:19px;">
				<td>Calorine: <?php echo $delresult[0]->calories;?></td>								
			</tr>
			<tr style="font-size:19px;">
				<td>Ratio for Carbohydrates to Protein: <?php echo $delresult[0]->ratioctop;?></td>								
			</tr>
			<tr style="font-size:19px;">
				<td>Product ASIN: <?php echo $delresult[0]->asin;?></td>								
			</tr>
			
			<tr style="font-size:19px;">
				<td><input type="submit" value="Delete Product" class="button button-primary" id="deleproductsub" name="deleproductsub" ></td>								
			</tr>
		</table>	
	</form>
</div>

