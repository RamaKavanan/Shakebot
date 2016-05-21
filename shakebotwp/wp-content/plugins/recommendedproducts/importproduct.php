<?php 

error_reporting(-1);
include( dirname(__FILE__) . '/Reader/Reader.php');
$url = plugins_url(); 
?>
<div class='wrap'>
  <div class='icon32' id='icon-options-general'><br/></div>
    <h2>Import Recommended Products 
       <a class="page-title-action" href="admin.php?page=rp-plugin">View Products</a>
       <a class="page-title-action" href="<?php echo $url?>/recommendedproducts/Reader/Recommended_Product_Template.xlsx" download="Recommended_Product_Template.xlsx">Sample Excel File</a>
      </h2>
</div>

  <?php 
    if(isset($_POST['fileSelected'])){
        //$target="/var/www/html/wordpress/wp-content/plugins/recommendedproducts/downloads/";
        $target=dirname(__FILE__)."/downloads/";
        $allowedExts = array("xlsx");
        $upload = uploadSingleFile($target, $_FILES['excelfile'], $allowedExts);
        if($upload == true){        
        $err = Reader::readexcel();		
		
          if(count($err) > 0){  ?>  

            <div class="error">
              <?php for($k=0;$k<count($err);$k++){?>
              <p><?php echo $err[$k];?></p>
              <?php }?>
            </div>

            <?php  } else { ?>
            <div class="updated notice"><p>Successfully saved.</p></div>
            <?php 
                }
        }
    }

    function uploadSingleFile($desDir,$file, $allowedExts) { 

      $upload = true;
	  $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file["name"]);
      $err = array();

      if(isset($_POST['fileSelected'])){ 
        //if (!($file["name"] == "Recommended_Product_Template.xlsx")) {
		if (!($withoutExt == "Recommended_Product_Template")) {
           $err[] = "Uploaded file name is not matching the sample template.";
           $upload = false; 
        } 
        if (!($file["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")  && !($file["type"] == "application/xlsx")) {
           $err[] = "Uploaded file format is not matching the sample template."; 
           $upload = false;
        }
        if (!($file["size"] < 2097152)) {
           $err[] = "Uploaded file size should not be greater than 2MB.";
           $upload = false;
        }
        if(count($err) > 0){  ?>  

          <div class="error">
            <?php for($k=0;$k<count($err);$k++){?>
            <p><?php echo $err[$k];?></p>
            <?php }?>
          </div>

  <?php  }

        if(count($err) == 0){
          if (file_exists($desDir . $file["name"])){
              unlink($desDir . $file["name"]);
          }
			//echo $file["tmp_name"].", ".$desDir.", ".$file["name"];
            move_uploaded_file($file["tmp_name"], $desDir . $file["name"]); 
            //echo "hi";
        }
      } 
      return $upload; 
    }
  ?>
  
  <div id="div1" class="error" style="display:none;"><p>Please upload a valid file.</p></div>

  <script type="text/javascript">
  jQuery(document).ready(function($){	  
    $('#submitForm').click(
    function(){
    var file = document.getElementById('excelfile');
    if(file.value != ""){
      var form = document.getElementById('importfrm');
      form.submit();
    }
    else{
		$("#div1").show();
          /*var para = document.createElement("p");
          var node = document.createTextNode("Please upload a valid file!");
          para.appendChild(node);
          var element = document.getElementById("div1");
          element.appendChild(para);*/
    }
  });
  });

</script>
<form name="importfrm" id="importfrm" method="post" action="" enctype="multipart/form-data">
    <h4><label>Choose the file to be Uploaded </label></h4>
        <input type="hidden" name="fileSelected" id="fileSelected" value="true">
        <input type="file" name="excelfile"  id="excelfile" value=""/>
        <input type="button" id="submitForm" name="btn-upload" value="Submit" class="button button-primary">    
</form>
