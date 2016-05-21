<style>
	.form-table th{width: 300px !important;}
</style>

<?php
if ( !is_admin() ) 
{
    echo 'Direct access not allowed.';
    exit;

mysql_connect('192.168.1.5', 'root', 'root') or die (mysql_error());
mysql_select_database('wp_recommended_products') or die (mysql_error());
}

global $wpdb;
$getProductId = trim($_GET['prodid']);

if(isset($_POST['createproductsub'])){	
	$er = array();
	
	$qry = "SELECT * FROM wp_recommended_products where asin ='".trim($_POST['pasin'])."'";
	
	if($getProductId != ''){
		$qry .= " and id!='".$getProductId."'";
	}
	//echo $qry;
	
	$resultsTmp = $wpdb->get_results($qry);
	
	if(count($resultsTmp)>0){
		$er[] = "This ASIN already assigned for another product.";
	}
	
	/*if(trim($_POST['company']) == ''){
		$er[] = "Company is Empty.";
	}
	
	if(trim($_POST['pname']) == ''){
		$er[] = "Product Name is Empty.";
	}*/
	
	if((trim($_FILES["pimage"]["name"]) == '') && ($_POST['prevpimage'] == '')){
		$er[] = "Product Image is Empty.";
	}
	
	$mime = array("image/gif","image/jpeg","image/png","image/bmp","image/vnd.microsoft.icon","saran");
    
    if($_FILES["pimage"]["name"] != ''){		
		$avName = "";
		$avName = $_FILES["pimage"]["type"];				
		if(in_array($avName,$mime)){			
		}else{			
			$er[] = 'Uploaded product Image not in the allowed format. Allowed formats are .gif, .jpeg, .jpg, .png, .bmp, .ico';
		}
	}
	
	if(trim($_POST['pasin']) == ''){
		$er[] = "Product ASIN is Empty.";
	}
	
	/*if(trim($_POST['ratioctop']) == ''){
		$er[] = "Ratio for Carbohydrates to Protein is Empty.";
	}*/
	
	
	if(count($er) == 0){
		$producttable = 'wp_recommended_products';
		$addedTime = date('Y-m-d g:i:s');
		
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		if($_FILES["pimage"]["name"] != ''){
			$uploadedfile = $_FILES['pimage'];
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			
			$f = explode("wp-content/uploads",$movefile['file']);
			$f1 = explode("wp-content/uploads",trim($_POST['prevpimage']));
			$unlinkFile = $f[0]."wp-content/uploads".$f1[1];			
			unlink($unlinkFile);
			
		}else{
			$movefile['url'] = trim($_POST['prevpimage']);
		}
		
		$productdata = Array
						(
							'company' => $_POST['company'],
							'productname' => $_POST['pname'],
							'productimage' =>$movefile['url'],						
							'asin' => $_POST['pasin'],
							'servingsize' => $_POST['servingsize'],
							'servingsizeg' => $_POST['servingsizeg'],
							'calories' => $_POST['calories'],
							'caloriesfromfat' => $_POST['caloriesfromfat'],
							'totalfat' => $_POST['totalfat'],
							'saturatedfat' => $_POST['saturatedfat'],
							'transfat' => $_POST['transfat'],
							'polyfat' => $_POST['polyfat'],
							'monofat' => $_POST['monofat'],
							'cholesterol' => $_POST['cholesterol'],
							'sodium' => $_POST['sodium'],
							'potassium' => $_POST['potassium'],
							'totcarbohydrate' => $_POST['totcarbohydrate'],
							'dietaryfiber' => $_POST['dietaryfiber'],
							'sugars' => $_POST['sugars'],
							'protein' => $_POST['protein'],
							'additionalBCAAg' => $_POST['additionalBCAAg'],
							'additionalbcaa' => $_POST['addbcaa'],
							'betaAlanine' => $_POST['betaalanine'],
							'betaAlaninemg' => $_POST['betaalaninemg'],
							'caffeine' => $_POST['caffine'],
							'caffeinemg' => $_POST['caffinemg'],
							'creatineg' => $_POST['creatine'],
							'createin' => $_POST['creatinee'],
							'nsf' => $_POST['nsf'],
							'priprotein' => $_POST['priprotein'],
							'secprotein' => $_POST['secprotein'],
							'terprotein' => $_POST['terprotein'],
							'ratioctop' => $_POST['ratioctop'],
							'ratiostoc' => $_POST['ratiostoc'],
							'caloriesMilkWhole' => $_POST['calorimilkwhole'],
							'totcarboMilkWhole' => $_POST['carbomilkwhole'],
							'sugarMilkWhole' => $_POST['sugarmilkwhole'],
							'proMilkWhole' => $_POST['promilkwhole'],
							'ratioMilkWhole' => $_POST['ratioctopmw'],
							'caloriMilk2' => $_POST['calorim'],
							'totcarboMilk2' => $_POST['carbom'],
							'sugarMilk2' => $_POST['sugarm'],
							'proMilk2' => $_POST['prom'],
							'ratioMilk2' => $_POST['ratioctopm'],
							'caloriMilk1' => $_POST['calorimp'],
							'totcarboMilk1' => $_POST['carbomp'],
							'sugarMilk1' => $_POST['sugarmp'],	
							'proMilk1' => $_POST['promp'],
							'ratioMilk1' => $_POST['ratioctopmp'],
							'caloriSkim' => $_POST['calskim'],
							'totcarboSkim' => $_POST['carboskim'],
							'sugarSkim' => $_POST['sugarskim'],
							'proSkim' => $_POST['proskim'],
							'ratioSkim' => $_POST['ratioskim'],
							'PrimaryScore' => $_POST['priscore'],
							'SecondaryScore' => $_POST['secscore'],
							'RhiScore' => $_POST['rhiscore'],
							'EndScore' => $_POST['endscore'],
							'SkillScore' => $_POST['skillscore'],
							'RhiTotalScore' => $_POST['rhitotscore'],
							'EndTotalScore' => $_POST['endtotscore'],
							'SkillTotalScore' => $_POST['skilltotscore'],
							'extraCol1' => $_POST['extracol1'],
							'extraCol2' => $_POST['extracol2'],
							'extraCol3' => $_POST['extracol3'],
							'extraCol4' => $_POST['extracol4'],
							'extraCol5' => $_POST['extracol5'],
							'extraCol6' => $_POST['extracol6'],
							'extraCol7' => $_POST['extracol7'],
							'extraCol8' => $_POST['extracol8'],
							'extraCol9' => $_POST['extracol9'],
							'extraCol10' => $_POST['extracol10'],
							'addedon' => $addedTime,
							'updatedon' => '0000-00-00 00:00:00'
						);
						
						
		$productformat = array('%s','%s','%s','%s','%s','%s','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%d','%F','%d','%F','%d','%F','%F','%d','%s','%s','%s','%s','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%d','%d','%d','%d','%d','%F','%F','%F','%s','%s');
		
		if($getProductId == ''){
			$wpdb->insert( $producttable, $productdata, $productformat ); 	
			//print_r($wpdb);
			$sucmsg = 2;
		}else{
			$wpdb->update($producttable, $productdata,  array( 'id' => $getProductId ), $productformat, array( '%d' ) );
//print_r ($wpdb);
			$sucmsg = 1;
		}
	}
}


$headlabel = '';
if($getProductId == ''){
	$headlabel = "Add";
	$headlabel1 = "Add";
	$image = "No file chosen";
}else{
	$headlabel = "Edit";	
	$headlabel1 = "Update";
	$image = "Change file";
	$prodResult = $wpdb->get_results( 'SELECT * FROM wp_recommended_products where id='.$getProductId.'');
}
?>



<div class='wrap'>
	<div class='icon32' id='icon-options-general'><br/></div>
	
	<h2><?php echo $headlabel;?> Product <a class="page-title-action" href="admin.php?page=rp-plugin">View Products</a></h2>
	
	<?php if(count($er) > 0){?>
		<div class="error">			
			<?php for($k=0;$k<count($er);$k++){?>
				<p><?php echo $er[$k];?></p>
			<?php }?>	
		</div>
	<?php }elseif($sucmsg == 2){?>
		<div class="updated notice"><p>Product added.</p></div>
	<?php }elseif($sucmsg == 1){?>
		<div class="updated notice"><p>Product updated.</p></div>
	<?php } ?>

	
	<form method="post" name="addproduct" id="addproduct" class="validate" enctype="multipart/form-data">
	<input name="action" type="hidden" value="adduser" />
	
	<table class="form-table" style="width:55%">
		<tr class="form-field form-required">
			<th scope="row"><label>Company </label></th>
			<td><input name="company" type="text" id="company" value="<?php if($_POST['company'] != ''){echo $_POST['company'];}else{echo $prodResult[0]->company;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Product Name </label></th>
			<td><input name="pname" type="text" id="pname" value="<?php if($_POST['pname'] != ''){echo $_POST['pname'];}else{echo $prodResult[0]->productname;};?>" maxlength="50" /></td>
		</tr>
		
		<!--<tr class="form-field form-required">
			<th scope="row"><label>Product Image <span class="description">(required)</span></label></th>
			<input type="hidden" name="prevpimage" id="prevpimage" value="<?php echo $prodResult[0]->productimage;?>">
			<td><input name="pimage" type="file" id="pimage" value=""/></td>
		</tr>-->

		<tr class="form-field form-required">
		<th scope="row"><label>Product Image <span class="description">(required)</span></label></th>
		<input type="hidden" name="prevpimage" id="prevpimage" value="<?php echo $prodResult[0]->productimage;?>" >
		<?php if($headlabel == "Edit"){?>
		<td><input name="pimage" type="file" id="pimage" value="" style="width:90px;" /><label><?php echo $image;?></label></td> <!--style="width:95px;"-->
		<?php }?>
		<?php if($headlabel == "Add"){?>
		<td><input name="pimage" type="file" id="pimage" value="" /></td> <!--style="width:95px;"-->
		<?php }?>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Product ASIN <span class="description">(required)</span></label></th>
			<td><input name="pasin" type="text" id="pasin" value="<?php if($_POST['pasin'] != ''){echo $_POST['pasin'];}else{echo $prodResult[0]->asin;};?>" maxlength="50" required="required"/></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Serving Size (Scoops)</label></th>
			<td><input name="servingsize" type="text" id="servingsize" value="<?php if($_POST['servingsize'] != ''){echo $_POST['servingsize'];}else{echo $prodResult[0]->servingsize;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>Serving Size (Grams)</label></th>
			<td><input name="servingsizeg" type="text" id="servingsizeg" value="<?php if($_POST['servingsizeg'] != ''){echo $_POST['servingsizeg'];}else{echo $prodResult[0]->servingsizeg;};?>" maxlength="50" /></td>
		</tr> <!--added-->
		
		<tr class="form-field form-required">
			<th scope="row"><label>Calories</label></th>
			<td><input name="calories" type="text" id="calories" value="<?php if($_POST['calories'] != ''){echo $_POST['calories'];}else{echo $prodResult[0]->calories;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Calories from Fat</label></th>
			<td><input name="caloriesfromfat" type="text" id="caloriesfromfat" value="<?php if($_POST['caloriesfromfat'] != ''){echo $_POST['caloriesfromfat'];}else{echo $prodResult[0]->caloriesfromfat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Total Fat (g)</label></th>
			<td><input name="totalfat" type="text" id="totalfat" value="<?php if($_POST['totalfat'] != ''){echo $_POST['totalfat'];}else{echo $prodResult[0]->totalfat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Saturated Fat (g)</label></th>
			<td><input name="saturatedfat" type="text" id="saturatedfat" value="<?php if($_POST['saturatedfat'] != ''){echo $_POST['saturatedfat'];}else{echo $prodResult[0]->saturatedfat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Trans Fat (g)</label></th>
			<td><input name="transfat" type="text" id="transfat" value="<?php if($_POST['transfat'] != ''){echo $_POST['transfat'];}else{echo $prodResult[0]->transfat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Polyunsaturated Fat (g)</label></th>
			<td><input name="polyfat" type="text" id="polyfat" value="<?php if($_POST['polyfat'] != ''){echo $_POST['polyfat'];}else{echo $prodResult[0]->polyfat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Monounsaturated Fat (g)</label></th>
			<td><input name="monofat" type="text" id="monofat" value="<?php if($_POST['monofat'] != ''){echo $_POST['monofat'];}else{echo $prodResult[0]->monofat;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Cholesterol (mg)</label></th>
			<td><input name="cholesterol" type="text" id="cholesterol" value="<?php if($_POST['cholesterol'] != ''){echo $_POST['cholesterol'];}else{echo $prodResult[0]->cholesterol;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Sodium (mg)</label></th>
			<td><input name="sodium" type="text" id="sodium" value="<?php if($_POST['sodium'] != ''){echo $_POST['sodium'];}else{echo $prodResult[0]->sodium;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Potassium (mg)</label></th>
			<td><input name="potassium" type="text" id="potassium" value="<?php if($_POST['potassium'] != ''){echo $_POST['potassium'];}else{echo $prodResult[0]->potassium;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Total Carbohydrate (g)</label></th>
			<td><input name="totcarbohydrate" type="text" id="totcarbohydrate" value="<?php if($_POST['totcarbohydrate'] != ''){echo $_POST['totcarbohydrate'];}else{echo $prodResult[0]->totcarbohydrate;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Dietary Fiber (g)</label></th>
			<td><input name="dietaryfiber" type="text" id="dietaryfiber" value="<?php if($_POST['dietaryfiber'] != ''){echo $_POST['dietaryfiber'];}else{echo $prodResult[0]->dietaryfiber;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Sugars (g)</label></th>
			<td><input name="sugars" type="text" id="sugars" value="<?php if($_POST['sugars'] != ''){echo $_POST['sugars'];}else{echo $prodResult[0]->sugars;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Protein (g)</label></th>
			<td><input name="protein" type="text" id="protein" value="<?php if($_POST['protein'] != ''){echo $_POST['protein'];}else{echo $prodResult[0]->protein;};?>" maxlength="50" /></td>
		</tr>

		 <tr class="form-field form-required">
			<th scope="row"><label>Additional BCAAs (1 = Yes, 0 = No)</label></th>
			<td><input name="additionalBCAAg" type="text" id="additionalBCAAg" value="<?php if($_POST['additionalBCAAg'] != ''){echo $_POST['additionalBCAAg'];}else{echo $prodResult[0]->additionalBCAAg;};?>" maxlength="50" /></td> <!--added-->
		</tr> 
		
		<tr class="form-field form-required">
			<th scope="row"><label>Additional BCAAs (g)</label></th>
			<td><input name="addbcaa" type="text" id="addbcaa" value="<?php if($_POST['addbcaa'] != ''){echo $_POST['addbcaa'];}else{echo $prodResult[0]->additionalbcaa;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>Beta-Alanine (1 = Yes, 0 = No)</label></th>
			<td><input name="betaalanine" type="text" id="betaalanine" value="<?php if($_POST['betaalanine'] != ''){echo $_POST['betaalanine'];}else{echo $prodResult[0]->betaAlanine;};?>" maxlength="50" /></td>
		</tr> <!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Beta-Analine (mg)</label></th>
			<td><input name="betaalaninemg" type="text" id="betaalaninemg" value="<?php if($_POST['betaalaninemg'] != ''){echo $_POST['betaalaninemg'];}else{echo $prodResult[0]->betaAlaninemg;};?>" maxlength="50" /></td>
		</tr> <!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Caffeine (1 = Yes, 0 = No)</label></th>
			<td><input name="caffine" type="text" id="caffine" value="<?php if($_POST['caffine'] != ''){echo $_POST['caffine'];}else{echo $prodResult[0]->caffeine;};?>" maxlength="50" /></td>
		</tr> <!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Caffeine (mg)</label></th>
			<td><input name="caffinemg" type="text" id="caffinemg" value="<?php if($_POST['caffinemg'] != ''){echo $_POST['caffinemg'];}else{echo $prodResult[0]->caffeinemg;};?>" maxlength="50" /></td>
		</tr> <!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Creatine (1 = Yes, 0 = No)</label></th>
			<td><input name="creatinee" type="text" id="creatinee" value="<?php if($_POST['creatinee'] != ''){echo $_POST['creatinee'];}else{echo $prodResult[0]->createin;};?>" maxlength="50" /></td>
		</tr><!--added-->
		
		<tr class="form-field form-required">
			<th scope="row"><label>Creatine (g)</label></th>
			<td><input name="creatine" type="text" id="creatine" value="<?php if($_POST['creatine'] != ''){echo $_POST['creatine'];}else{echo $prodResult[0]->creatineg;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>NSF (1 = Yes, 0 = No)</label></th>
			<td><input name="nsf" type="text" id="nsf" value="<?php if($_POST['nsf'] != ''){echo $_POST['nsf'];}else{echo $prodResult[0]->nsf;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Primary Protein Source</label></th>
			<td><input name="priprotein" type="text" id="priprotein" value="<?php if($_POST['priprotein'] != ''){echo $_POST['priprotein'];}else{echo $prodResult[0]->priprotein;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>Secondary Protein Source</label></th>
			<td><input name="secprotein" type="text" id="secprotein" value="<?php if($_POST['secprotein'] != ''){echo $_POST['secprotein'];}else{echo $prodResult[0]->secprotein;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Tertiary Protein Source</label></th>
			<td><input name="terprotein" type="text" id="terprotein" value="<?php if($_POST['terprotein'] != ''){echo $_POST['terprotein'];}else{echo $prodResult[0]->terprotein;};?>" maxlength="50" /></td>
		</tr><!--added-->
		
		<tr class="form-field form-required">
			<th scope="row"><label>Ratio for Carbohydrates to Protein (g)</label></th>
			<td><input name="ratioctop" type="text" id="ratioctop" value="<?php if($_POST['ratioctop'] != ''){echo $_POST['ratioctop'];}else{echo $prodResult[0]->ratioctop;};?>" maxlength="50" /></td>
		</tr>
		
		<tr class="form-field form-required">
			<th scope="row"><label>Ratio of Sugar to Carbohydrates</label></th>
			<td><input name="ratiostoc" type="text" id="ratiostoc" value="<?php if($_POST['ratiostoc'] != ''){echo $_POST['ratiostoc'];}else{echo $prodResult[0]->ratiostoc;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>CALORIES with MILK-WHOLE</label></th>
			<td><input name="calorimilkwhole" type="text" id="calorimilkwhole" value="<?php if($_POST['calorimilkwhole'] != ''){echo $_POST['calorimilkwhole'];}else{echo $prodResult[0]->caloriesMilkWhole;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Total Carbohydrates with MILK-WHOLE</label></th>
			<td><input name="carbomilkwhole" type="text" id="carbomilkwhole" value="<?php if($_POST['carbomilkwhole'] != ''){echo $_POST['carbomilkwhole'];}else{echo $prodResult[0]->totcarboMilkWhole;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Sugar with MILK-WHOLE</label></th>
			<td><input name="sugarmilkwhole" type="text" id="sugarmilkwhole" value="<?php if($_POST['sugarmilkwhole'] != ''){echo $_POST['sugarmilkwhole'];}else{echo $prodResult[0]->sugarMilkWhole;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Pro with MILK-WHOLE</label></th>
			<td><input name="promilkwhole" type="text" id="promilkwhole" value="<?php if($_POST['promilkwhole'] != ''){echo $_POST['promilkwhole'];}else{echo $prodResult[0]->proMilkWhole;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Ratio of Carbohydrate to Protein with MILK-WHOLE</label></th>
			<td><input name="ratioctopmw" type="text" id="ratioctopmw" value="<?php if($_POST['ratioctopmw'] != ''){echo $_POST['ratioctopmw'];}else{echo $prodResult[0]->ratioMilkWhole;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>CALORIES with MILK-2%</label></th>
			<td><input name="calorim" type="text" id="calorim" value="<?php if($_POST['calorim'] != ''){echo $_POST['calorim'];}else{echo $prodResult[0]->caloriMilk2;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Total Carbohydrates with MILK-2%</label></th>
			<td><input name="carbom" type="text" id="carbom" value="<?php if($_POST['carbom'] != ''){echo $_POST['carbom'];}else{echo $prodResult[0]->totcarboMilk2;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Sugar with MILK-2%</label></th>
			<td><input name="sugarm" type="text" id="sugarm" value="<?php if($_POST['sugarm'] != ''){echo $_POST['sugarm'];}else{echo $prodResult[0]->sugarMilk2;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>PRO with MILK - 2%</label></th>
			<td><input name="prom" type="text" id="prom" value="<?php if($_POST['prom'] != ''){echo $_POST['prom'];}else{echo $prodResult[0]->proMilk2;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Ratio of Carbohydrate to Protein with MILK - 2%</label></th>
			<td><input name="ratioctopm" type="text" id="ratioctopm" value="<?php if($_POST['ratioctopm'] != ''){echo $_POST['ratioctopm'];}else{echo $prodResult[0]->ratioMilk2;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>CALORIES with MILK - 1%</label></th>
			<td><input name="calorimp" type="text" id="calorimp" value="<?php if($_POST['calorimp'] != ''){echo $_POST['calorimp'];}else{echo $prodResult[0]->caloriMilk1;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Total Carbohydrates with MILK - 1%</label></th>
			<td><input name="carbomp" type="text" id="carbomp" value="<?php if($_POST['carbomp'] != ''){echo $_POST['carbomp'];}else{echo $prodResult[0]->totcarboMilk1;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Sugar with MILK - 1%</label></th>
			<td><input name="sugarmp" type="text" id="sugarmp" value="<?php if($_POST['sugarmp'] != ''){echo $_POST['sugarmp'];}else{echo $prodResult[0]->sugarMilk1;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>PRO with MILK - 1%</label></th>
			<td><input name="promp" type="text" id="promp" value="<?php if($_POST['promp'] != ''){echo $_POST['promp'];}else{echo $prodResult[0]->proMilk1;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Ratio of Carbohydrate to Protein with MILK - 1%</label></th>
			<td><input name="ratioctopmp" type="text" id="ratioctopmp" value="<?php if($_POST['ratioctopmp'] != ''){echo $_POST['ratioctopmp'];}else{echo $prodResult[0]->ratioMilk1;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>CALORIES with MILK - SKIM</label></th>
			<td><input name="calskim" type="text" id="calskim" value="<?php if($_POST['calskim'] != ''){echo $_POST['calskim'];}else{echo $prodResult[0]->caloriSkim;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Total Carbohydrates with MILK - SKIM</label></th>
			<td><input name="carboskim" type="text" id="carboskim" value="<?php if($_POST['carboskim'] != ''){echo $_POST['carboskim'];}else{echo $prodResult[0]->totcarboSkim;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Sugar with MILK - SKIM</label></th>
			<td><input name="sugarskim" type="text" id="sugarskim" value="<?php if($_POST['sugarskim'] != ''){echo $_POST['sugarskim'];}else{echo $prodResult[0]->sugarSkim;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>PRO with MILK - SKIM</label></th>
			<td><input name="proskim" type="text" id="proskim" value="<?php if($_POST['proskim'] != ''){echo $_POST['proskim'];}else{echo $prodResult[0]->proSkim;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>Ratio of Carbohydrate to Protein with MILK - SKIM</label></th>
			<td><input name="ratioskim" type="text" id="ratioskim" value="<?php if($_POST['ratioskim'] != ''){echo $_POST['ratioskim'];}else{echo $prodResult[0]->ratioSkim;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>PRIMARY PROTEINDIGESTIBILITY SCORE</label></th>
			<td><input name="priscore" type="text" id="priscore" value="<?php if($_POST['priscore'] != ''){echo $_POST['priscore'];}else{echo $prodResult[0]->PrimaryScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>SECONDARY PROTEIN DIGESTIBILITY SCORE</label></th>
			<td><input name="secscore" type="text" id="secscore" value="<?php if($_POST['secscore'] != ''){echo $_POST['secscore'];}else{echo $prodResult[0]->SecondaryScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>RHI CHO - PRO RATIO SCORE</label></th>
			<td><input name="rhiscore" type="text" id="rhiscore" value="<?php if($_POST['rhiscore'] != ''){echo $_POST['rhiscore'];}else{echo $prodResult[0]->RhiScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>END CHO - PRO RATIO SCORE</label></th>
			<td><input name="endscore" type="text" id="endscore" value="<?php if($_POST['endscore'] != ''){echo $_POST['endscore'];}else{echo $prodResult[0]->EndScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>SKILL CHO - PRO RATIO SCORE</label></th>
			<td><input name="skillscore" type="text" id="skillscore" value="<?php if($_POST['skillscore'] != ''){echo $_POST['skillscore'];}else{echo $prodResult[0]->SkillScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>RHI TOTAL SCORE</label></th>
			<td><input name="rhitotscore" type="text" id="rhitotscore" value="<?php if($_POST['rhitotscore'] != ''){echo $_POST['rhitotscore'];}else{echo $prodResult[0]->RhiTotalScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>END TOTAL SCORE</label></th>
			<td><input name="endtotscore" type="text" id="endtotscore" value="<?php if($_POST['endtotscore'] != ''){echo $_POST['endtotscore'];}else{echo $prodResult[0]->EndTotalScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

		<tr class="form-field form-required">
			<th scope="row"><label>SKILL TOTAL SCORE</label></th>
			<td><input name="skilltotscore" type="text" id="skilltotscore" value="<?php if($_POST['skilltotscore'] != ''){echo $_POST['skilltotscore'];}else{echo $prodResult[0]->SkillTotalScore;};?>" maxlength="50" /></td>
		</tr><!--added-->

	<?php $results = $wpdb->get_results( "SELECT * FROM wp_extracolumns "); 
	for($i=1; $i<=count($results); $i++){ 
		$extr = "extracol".$i;
		?> 
		<tr class="form-field form-required">
			<th scope="row"><label><?php echo $results[$i-1]->columnName?></label></th>
			<td><input name="extracol<?php echo $i;?>" type="text" id="extracol<?php echo $i;?>" value="<?php if($_POST['extracol<?php echo $i;?>'] != ''){echo $_POST['extracol<?php echo $i;?>'];}else{echo $prodResult[0]->$extr;};?>" maxlength="50" /></td>

		</tr><!--added-->
	 <?php }
	?>

	


		<!-- <tr class="form-field form-required">
			<th scope="row"><label value="<?php echo $results[$i]->columnName?>"></th>
			<td><input name="extracol1" type="text" id="extracol1" value="<?php if($_POST['extracol1'] != ''){echo $_POST['extracol1'];}else{echo $prodResult[0]->extraCol1;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>2</label></th>
			<td><input name="extracol2" type="text" id="extracol2" value="<?php if($_POST['extracol2'] != ''){echo $_POST['extracol2'];}else{echo $prodResult[0]->extraCol2;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>3</label></th>
			<td><input name="extracol3" type="text" id="extracol3" value="<?php if($_POST['extracol3'] != ''){echo $_POST['extracol3'];}else{echo $prodResult[0]->extraCol3;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>4</label></th>
			<td><input name="extracol4" type="text" id="extracol4" value="<?php if($_POST['extracol4'] != ''){echo $_POST['extracol4'];}else{echo $prodResult[0]->extraCol4;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>5</label></th>
			<td><input name="extracol5" type="text" id="extracol5" value="<?php if($_POST['extracol5'] != ''){echo $_POST['extracol5'];}else{echo $prodResult[0]->extraCol5;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>6</label></th>
			<td><input name="extracol6" type="text" id="extracol6" value="<?php if($_POST['extracol6'] != ''){echo $_POST['extracol6'];}else{echo $prodResult[0]->extraCol6;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>7</label></th>
			<td><input name="extracol7" type="text" id="extracol7" value="<?php if($_POST['extracol7'] != ''){echo $_POST['extracol7'];}else{echo $prodResult[0]->extraCol7;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>8</label></th>
			<td><input name="extracol8" type="text" id="extracol8" value="<?php if($_POST['extracol8'] != ''){echo $_POST['extracol8'];}else{echo $prodResult[0]->extraCol8;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>9</label></th>
			<td><input name="extracol9" type="text" id="extracol9" value="<?php if($_POST['extracol9'] != ''){echo $_POST['extracol9'];}else{echo $prodResult[0]->extraCol9;};?>" maxlength="50" /></td>
		</tr>

		<tr class="form-field form-required">
			<th scope="row"><label>10</label></th>
			<td><input name="extracol10" type="text" id="extracol10" value="<?php if($_POST['extracol10'] != ''){echo $_POST['extracol10'];}else{echo $prodResult[0]->extraCol10;};?>" maxlength="50" /></td>
		</tr> -->
		
		<tr class="form-field form-required">
			<th scope="row"><input type="submit" value="<?php echo $headlabel1;?> Product" class="button button-primary" id="createproductsub" name="createproductsub" ></th>
		</tr>
		
	</table>
	</form>	
</div>
