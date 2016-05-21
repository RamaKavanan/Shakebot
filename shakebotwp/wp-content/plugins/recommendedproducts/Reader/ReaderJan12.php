<?php
/*
 * PHP Excel - Read a simple 2007 XLSX Excel file
 */
require( ABSPATH . WPINC . '/PHPExcel/PHPExcel.php' );
require( ABSPATH . WPINC . '/PHPExcel/PHPExcel/IOFactory.php' );
class Reader {
    public static $err = array();

    public function read($srcDir,$fileName){
        try{
            try {
                $fileFullPath = $srcDir."/".$fileName;
                $inputFileType = PHPExcel_IOFactory::identify($fileFullPath);            
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($fileFullPath);
                $objReader->setReadDataOnly(true);
            } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($fileFullPath, PATHINFO_BASENAME) 
                // . '": ' . $e->getMessage());
            }
            $rowCounter = 0;
            $maxCount = 71;
            $colCount = 0;
            $rowData = array();

            foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
                $columnCounter = 0;
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) {
                    $value = '';
                    if (!is_null($cell)) {
                        $value = $cell->getCalculatedValue();

                        if (!is_null($value)) {
                            $totCount = $colCount++;
                            //print_r($totCount);
                        }
                        
                    }
                    $rowData[$rowCounter][$columnCounter] = $value;
                    ++$columnCounter;
                    if($columnCounter == $maxCount)
                        break;
                }
                $rowCounter++;
            }
            return $rowData;

        } catch(Exception $exception){
            print_r($exception);die;
        }
    }

    public function readextra($srcDir,$fileName){
        try{
            try {
                $fileFullPath = $srcDir."/".$fileName;
                $inputFileType = PHPExcel_IOFactory::identify($fileFullPath);            
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($fileFullPath);
                $objReader->setReadDataOnly(true);
            } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($fileFullPath, PATHINFO_BASENAME) 
                // . '": ' . $e->getMessage());
            }
            $rowCounter = 0;
            $maxCount = 71;
            $colCount = 0;
            $rowData = array();
            $hasExtraColumn = false;
            foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
                $columnCounter = 0;
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) {
                    $value = '';
                    if (!is_null($cell)) {
                        $value = $cell->getCalculatedValue();                                               
                    }
                    ++$columnCounter;
                    if($columnCounter > $maxCount) {
                        if($value != '') {
                            $hasExtraColumn = true;
                            break;
                        }
                    }                     
                    $rowCounter++;
                    }
            }
            return $hasExtraColumn;

        } catch(Exception $exception){
            print_r($exception);die;
        }
    }


    public static function readsample() {
        //$target="/var/www/html/wordpress/wp-content/plugins/recommendedproducts/Reader/";
        $target = dirname(__FILE__);        
        $file = "Recommended_Product_Template.xlsx";

        $samplerowData = self::read($target ,$file); 
        return $samplerowData;

    }
    public static  $splChar = array();

    public static function readexcel(){

        //$target="/var/www/html/wordpress/wp-content/plugins/recommendedproducts/downloads/";
		$fp = str_replace("/Reader","",dirname(__FILE__));
        $target=$fp."/downloads/";
        $file = $_FILES['excelfile']['name'];
        $rowData = self::read($target ,$file); //print_r($rowData);
        $extra = self::readextra($target,$file); 
        if(!$extra) {
        $rowDataHeader = $rowData[0]; 
        $sampleData = self::readsample(); 
        $sampleHeader = $sampleData[0];
        $result = self::validateheader($rowDataHeader, $sampleHeader);
        if(!$result){
            //self::$err[] = "Uploaded file column order is not matching the sample template. ";
           
        } else {
           if(count($rowData)>1)
            {
                for ($i=1;$i<count($rowData);$i++){
                    $result = self::validate($rowData[$i], $i, $rowDataHeader);
                    if($result == true){
                        $validRows[] =  $rowData[$i];
                          $save = self::save($rowData[$i]);
                          if($save == false){
                             $invalidRows[] = $rowData[$i];
                             $j = $i+1; 
                             self::$err[] = "Row :".($j)." could not be updated ."; 
                          }
                    }
                    else{
                        $invalidRows[] = $rowData[$i];
                        $j = $i+1;            
                        if(self::$splChar != null){
                        self::$err[] = " Uploaded file should not contain special characters. Special characters found  in Row (no.".($j).") column [".implode(", ",self::$splChar)."]"; //$spl = false;
                        } self::$err[] = "Row :".($j)." could not be updated . ";
                    }
                }
            }
            else{
                self::$err[] = "File should not be empty."; 
            } 
        }      
    } else {

        self::$err[] = "Uploaded Excel file has extra column(s).";
    }
    return self::$err;
    }

    public static $duplicates = array();
    public static $check = array();
    public function validate($columnData, $rowNumber, $rowDataHeader){ 

        $validRow = true;
        $empty = count($columnData); 
        $asin = $columnData[2]; //print"----";print_r($asin);
//        $regEx="/^[a-zA-Z0-9.,-\s]*$/";  
$regEx="/[^a-zA-Z0-9 .,\-]/";
            
            if($asin == ''){
                $j =  $rowNumber+1; 
               self::$err[] = "Product ASIN should not be empty in Row (no." .($j).")";
               $validRow = false; 
            }
            else 
            {               
                if(in_array($asin,self::$check)){
                    array_push(self::$duplicates, $asin);
                    $j = $rowNumber+1; 
                    self::$err[] ="ASIN value in Row (no.".($j).") is already existing";
                    //self::$err[] = "Row :$rowNumber could not be updated . ";
                     $validRow = false;
                } 
                else {
                    array_push(self::$check, $asin);
                }
            
                self::$splChar = array();
                for ($i = 0; $i < count($columnData); $i++){  
$columnData[$i] = (string)$columnData[$i];   
                    if( preg_match($regEx, $columnData[$i])){ //print_r($columnData[$i]);
                        array_push(self::$splChar, $rowDataHeader[$i]);
                        $validRow = false;
                        // break;
                    }
                }
            } 
        return $validRow;       
    } 

    public static function validateheader($rowDataHeader, $sampleHeader) { 
       $sampleColCount = count($sampleHeader);
       $excelColCount = count($rowDataHeader); 
       $validHeader = true;
       $existingCount = 0;
       for($i = 0; $i < $excelColCount; $i++){
            if(trim($rowDataHeader[$i]) != ''){ //get values from cell ---- if(trim($value) != ''){ 
                $existingCount++;
            }
        } 
        if($sampleColCount == $existingCount)
        {
            for ($i = 0; $i < 61; $i++) {
//echo "<br>".$sampleHeader[$i]." == ".$rowDataHeader[$i];
                if(strcmp(trim($sampleHeader[$i]), trim($rowDataHeader[$i])) != 0){ 
                    $validHeader = false;
                    self::$err[] = "one Uploaded file column(s) not matching the sample template.";
                    break;
                }
            }

        } else {
            self::$err[] = "two Uploaded file column count is not matching the sample template.";
            $validHeader = false;
        }
        if($validHeader){
            $saveEx = self::savetodb($rowDataHeader);
        }
        
        return $validHeader;
    }

    public static function save($rowData){
        global $wpdb; 
        $results = $wpdb->get_results( "SELECT * FROM wp_recommended_products where asin = '$rowData[2]'");
        $validasin = true;
            $data = Array
                        (
                            'id' => '',
                            'company' => $rowData[0],
                            'productname' => $rowData[1],                      
                            'asin' => $rowData[2],
                            'servingsize' => $rowData[3],
                            'servingsizeg' => $rowData[4],
                            'calories' => $rowData[5],
                            'caloriesfromfat' => $rowData[6],
                            'totalfat' => $rowData[7],
                            'saturatedfat' => $rowData[8],
                            'transfat' => $rowData[9],
                            'polyfat' => $rowData[10],
                            'monofat' => $rowData[11],
                            'cholesterol' => $rowData[12],
                            'sodium' => $rowData[13],
                            'potassium' => $rowData[14],
                            'totcarbohydrate' => $rowData[15],
                            'dietaryfiber' => $rowData[16],
                            'sugars' => $rowData[17],
                            'protein' => $rowData[18],
                            'additionalBCAAg' => $rowData[20],
                            'additionalbcaa' => $rowData[19],
                            'betaAlanine' => $rowData[21],
                            'betaAlaninemg' => $rowData[22],
                            'caffeine' => $rowData[23],
                            'caffeinemg' => $rowData[24],
                            'creatineg' => $rowData[26],
                            'createin' => $rowData[25],
                            'nsf' => $rowData[27],
                            'priprotein' => $rowData[28],
                            'secprotein' => $rowData[29],
                            'terprotein' => $rowData[30],
                            'ratioctop' => $rowData[31],
                            'ratiostoc' => $rowData[32],
                            'caloriesMilkWhole' => $rowData[33],
                            'totcarboMilkWhole' => $rowData[34],
                            'sugarMilkWhole' => $rowData[35],
                            'proMilkWhole' => $rowData[36],
                            'ratioMilkWhole' => $rowData[37],
                            'caloriMilk2' => $rowData[38],
                            'totcarboMilk2' => $rowData[39],
                            'sugarMilk2' => $rowData[40],
                            'proMilk2' => $rowData[41],
                            'ratioMilk2' => $rowData[42],
                            'caloriMilk1' => $rowData[43],
                            'totcarboMilk1' => $rowData[44],
                            'sugarMilk1' => $rowData[45],  
                            'proMilk1' => $rowData[46],
                            'ratioMilk1' => $rowData[47],
                            'caloriSkim' => $rowData[48],
                            'totcarboSkim' => $rowData[49],
                            'sugarSkim' => $rowData[50],
                            'proSkim' => $rowData[51],
                            'ratioSkim' => $rowData[52],
                            'PrimaryScore' => $rowData[53],
                            'SecondaryScore' => $rowData[54],
                            'RhiScore' => $rowData[55],
                            'EndScore' => $rowData[56],
                            'SkillScore' => $rowData[57],
                            'RhiTotalScore' => $rowData[58],
                            'EndTotalScore' => $rowData[59],
                            'SkillTotalScore' => $rowData[60],
                            'extracol1' => $rowData[61],
                            'extracol2' => $rowData[62],
                            'extracol3' => $rowData[63],
                            'extracol4' => $rowData[64],
                            'extracol5' => $rowData[65],
                            'extracol6' => $rowData[66],
                            'extracol7' => $rowData[67],
                            'extracol8' => $rowData[68],
                            'extracol9' => $rowData[69],
                            'extracol10' => $rowData[70],
                            'updatedon' => date("Y-m-d g:i:s")
                        );                    
                        
            $format = array('%d','%s','%s','%s','%s','%s','%s','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%d','%F','%d','%F','%d','%F','%F','%d','%s','%s','%s','%s','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%F','%d','%d','%d','%d','%d','%F','%F','%F','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');         

            if(count($results) == 0){
                 self::$err[] = "Product ASIN ('$rowData[2]') is not matching with existing Product";
                 $validasin = false;
                  //  $wpdb->insert('wp_recommended_products', $data, $format);
            }
            else{
                $result = $results[0];
                    $data['id'] = $result->id;
                    $wpdb->update('wp_recommended_products', $data , array('id' => $result->id));
                    
            }
            return $validasin;
    }

    public static function savetodb($rowDataHeader){
        global $wpdb; 
        $results = $wpdb->get_results( "SELECT * FROM wp_extracolumns ");
        $ex = 61; //var_dump($results);                          
        if(count($results) > 0){ 
            for($i = 0; $i < count($results); $i++){ 

                if($results[$i]->columnName != $rowDataHeader[$i + $ex]){
                    $results[$i]->columnName = $rowDataHeader[$i + $ex];
                    $data = (array)$results[$i]; 
                    $data['updatedon'] = date("Y-m-d g:i:s");
                    $wpdb->update('wp_extracolumns', $data , array('id' => $results[$i]->id));

                }
            }
        }  

    }

}

?>
