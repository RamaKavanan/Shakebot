
$(document).ready(function(){	
	/*$('.simple-ajax-popup').magnificPopup({
		type: 'ajax'
	});*/	  
    
	//For filters
	showslider();  
        
        $('.reset').on('click',function(){
                                var element_id=$(this).attr('id'); //alert(element_id); range1
				//var remEle = "#"+element_id;	//alert(remEle);	#range1					
					//For other filters			
					var selectedSlider = "#slider-"+[element_id]; //alert();
					var sliderTxt1 = "#slider-"+[element_id]+"rg1";
					var sliderTxt2 = "#slider-"+[element_id]+"rg2";				
					
					var setRange = [];
					setRange[0] = "";
					setRange["#slider-range"] = "1000"; //Removed
					setRange["#slider-range1"] = "100";
					setRange["#slider-range2"] = "100"; //Removed
					setRange["#slider-range3"] = "100";
					setRange["#slider-range4"] = "300";
					setRange["#slider-range5"] = "100";
					setRange["#slider-range6"] = "100";
					setRange["#slider-range7"] = "2000";
					var finalReset = parseInt(setRange[selectedSlider]);
					
					//Reseting the filter
					$( selectedSlider ).slider({
					range: true,
					min: 0,
					max: finalReset,
					values: [ 0, finalReset ],
					slide: function( event, ui ) {		
						$(sliderTxt1).val(ui.values[ 0 ]);
						$(sliderTxt2).val(ui.values[ 1 ]);		
					}
					});
					
					$(sliderTxt1).val($( selectedSlider ).slider( "values", 0 )); 
					$(sliderTxt2).val($( selectedSlider ).slider( "values", 1 ));                        
        });
	
	//On clicking the Apply filter button
	$("#applyFilterId").click(function(){		
		selectedFilterstmp = [];
		selectedFilterstmp = getSelFilters();
		
		//var imgSrc = "http://shakebot.biz/shakebotwp/wp-content/themes/starter/images/icon_close_red.png";
                var imgSrc = main_url+"/wp-content/themes/starter/images/icon_close_red.png";

		
		$("#paginationPage").val(1); // Initializing the page value
		
		if(selectedFilterstmp[0].length > 0){
			var str = '';
			var selFilCnt = 0;
			
			for(var ind=0;ind<selectedFilterstmp[0].length;ind++){								
				var spnId = '';				
				if(selectedFilterstmp[2][selectedFilterstmp[0][ind]] == undefined){ //For brand text box
					spnId = "brandFIlterId";
				}else{ //For other filters
					spnId = selectedFilterstmp[2][selectedFilterstmp[0][ind]];
				}
				selFilCnt++;
				if(spnId == "brandFIlterId"){
					str += '<span class="pbSubmit11" id="'+spnId+'spanAll">"'+selectedFilterstmp[0][ind]+'"&nbsp; <b>: &nbsp; '+selectedFilterstmp[1][ind]+'</b>  &nbsp;&nbsp;<span><img src='+imgSrc+' "  class="pbSubmit11cls" id="'+spnId+'"></span></span>';
				}else{
					str += '<span class="pbSubmit11" id="'+spnId+'spanAll">'+selectedFilterstmp[0][ind]+'&nbsp; <b>: &nbsp; '+selectedFilterstmp[1][ind]+'</b>  &nbsp;&nbsp;<span><img src='+imgSrc+' "  class="pbSubmit11cls" id="'+spnId+'"></span></span>';
				}
			}			
			
			$(".accordion .drawer .accordion-item .accordion-item-active .accordion-header .accordion-header-active").trigger('click');
						
			if(selectedFilterstmp[0].length == 1){
				var myFilterHei = 60;
			}else if(selectedFilterstmp[0].length == 2){
				var myFilterHei = selectedFilterstmp[0].length * 50;
			}else{
				var myFilterHei = selectedFilterstmp[0].length * 45;
			}
			myFilterHei = myFilterHei+"px";
			$("#myFiltersDiv").css("height",myFilterHei);
			$("#myFiltersDiv").html(str);
	
			//For closing the filters	
			$('.pbSubmit11cls').on('click',function(){				
				var element_id=$(this).attr('id');
				var remEle = "#"+element_id+"spanAll";								
				$(remEle).css("display","none"); //Removing the filter
								
				if(element_id == "brandFIlterId"){ //For brand text box
					var txtV1 = "#brandFIlter";
					$(txtV1).val("");
				}else{	//For other filters			
					var resetFiltr = "#"+selectedFilterstmp[3][element_id];
					var resetFiltrTxt1 = "#"+selectedFilterstmp[3][element_id]+"rg1";
					var resetFiltrTxt2 = "#"+selectedFilterstmp[3][element_id]+"rg2";				
					
					var preFilValReset = [];
					preFilValReset[0] = "";
					preFilValReset["#slider-range"] = "1000"; //Removed
					preFilValReset["#slider-range1"] = "100";
					preFilValReset["#slider-range2"] = "100"; //Removed
					preFilValReset["#slider-range3"] = "100";
					preFilValReset["#slider-range4"] = "300";
					preFilValReset["#slider-range5"] = "100";
					preFilValReset["#slider-range6"] = "100";
					preFilValReset["#slider-range7"] = "2000";
					var finalReset = parseInt(preFilValReset[resetFiltr]);
					
					//Reseting the filter
					$( resetFiltr ).slider({
					range: true,
					min: 0,
					max: finalReset,
					values: [ 0, finalReset ],
					slide: function( event, ui ) {		
						$(resetFiltrTxt1).val(ui.values[ 0 ]);
						$(resetFiltrTxt2).val(ui.values[ 1 ]);		
					}
					});
					
					$(resetFiltrTxt1).val($( resetFiltr ).slider( "values", 0 )); 
					$(resetFiltrTxt2).val($( resetFiltr ).slider( "values", 1 ));
					
				}
								
				//For checking the empty filter
				var selFilCntVar = $("#selFilCnthd").val();
				selFilCntVar++;
				$("#selFilCnthd").val(selFilCntVar);
				
				var showdIdsMinus = getSelFilters();
								
				if(showdIdsMinus[0].length == 1){
					var myFilterHei = 60;
				}else if(showdIdsMinus[0].length == 2){
					var myFilterHei = showdIdsMinus[0].length * 50;
				}else{
					var myFilterHei = showdIdsMinus[0].length * 45;
				}
				myFilterHei = myFilterHei+"px";
				$("#myFiltersDiv").css("height",myFilterHei);
				
				if(selFilCntVar == selFilCnt){
					$("#myFiltersDiv").html("No Filter Selected.");
					$("#selFilCnthd").val(0);
				}				
									
			});
			
			//for opening the my filter part
			$("#myFiltersDiv").slideDown(function(){
				$('#myFiltercornerIcon').attr('class','fa fa-caret-up');
			});			
		}else{
			$("#myFiltersDiv").html("No Filter Selected.");
			$("#selFilCnthd").val(0);
		}
		
		//function call for getting the produts with applied filters
		getProductsForFilters(selectedFilterstmp,1);
	});
	
	//function call for getting the produts with applied filters
	function getProductsForFilters(selectedFilterstmp1,pty){
		var passFilterVal = "";
		var passSortVal = "";
				
		//Gathering the filter details		
		passFilterVal = selectedFilterstmp1;
		
		//Gathering the Sort details
		passSortVal = $("#sortFilters").val()+"#@#@#"+$("#sortTyhd").val()+"#@#@#"+$("#resultCatTypehd").val()+"#@#@#"+$("#showdIdshd").val()+"#@#@#"+$("#paginationPage").val();	

		//For showing the loading image
		//var loadImg = "http://shakebot.biz/shakebotwp/wp-content/themes/starter/images/loading_spinner.gif";
                var loadImg = main_url+"/wp-content/themes/starter/images/loading_spinner.gif";
		var loadImgSpan = "<center><img src='"+loadImg+"'></center>";
		$("#showProductListIDFilter").html(loadImgSpan);		
		$("#paginationId").html("");
						
		//Ajax call
		$.get( 
			ajaxurl, // request url
			{ action: 'productWithFilterAjax', 'passFilter':passFilterVal, 'passSort':passSortVal, 'passType':pty}, // request parameters
			function (response){ // callback			
				// handle the response											
				
				var resTmp = response.split("#$#$#");
				$("#showProductListIDFilter").html(resTmp[0]);			
				$("#paginationId").html(resTmp[1]);							
				
				$(".page-numbers").click(function(){
					onloadProducts(2);
				});
                                
                            $('.popup-with-form').magnificPopup({
                                    type: 'inline',
                                    preloader: false,
                                    focus: '#name',
                                    // When elemened is focused, some mobile browsers in some cases zoom in
                                    // It looks not nice, so we disable it:
                                    callbacks: {
                                            beforeOpen: function() {
                                                    if($(window).width() < 700) {
                                                            this.st.focus = false;
                                                    } else {
                                                            this.st.focus = '#name';
                                                    }
                                            }
                                    }
                            });
                                
			}
		);
	}
	
	//For sorting 
	$("#sortltoh").click(function(){ //Low to high
		$("#sortTyhd").val("lth");
		$("#paginationPage").val(1); // Initializing the page value
		$("#sortltoh").css({"background-color":"#00ADE7", "color":"#fff"});
		$("#sorthtol").css({"background-color":"#DBDBDB", "color":"#3F3F3F"});
				
		//function call for getting the produts with applied filters
		selectedFilterstmp11 = [];
		selectedFilterstmp11 = getSelFilters();
		getProductsForFilters(selectedFilterstmp11,1);		
	});
	
	$("#sorthtol").click(function(){ //high to Low
		$("#sortTyhd").val("htl");
		$("#paginationPage").val(1); // Initializing the page value
		$("#sorthtol").css({"background-color":"#00ADE7", "color":"#fff"});
		$("#sortltoh").css({"background-color":"#DBDBDB", "color":"#3F3F3F"});
		
		//function call for getting the produts with applied filters
		selectedFilterstmp22 = [];
		selectedFilterstmp22 = getSelFilters();
		getProductsForFilters(selectedFilterstmp22,1);
	});
	
	//For getting the selected filters and its values
	function getSelFilters(){
		var selFillVal = [];		
		var preFilVal = [];
		var preFilStr = [];
		var selectedFilters = [];
		var selectedFiltersVal = [];
		var preFilStrEq = [];
		var preFilStrSlid = [];
		
		preFilStr[0] = "";
		preFilStr[1] = "PRICE";
		preFilStr[2] = "SHAKEBOT RATING";
		preFilStr[3] = "AMAZON RATING";
		preFilStr[4] = "PROTEIN PER SERVING";
		preFilStr[5] = "CARBS PER SERVING";
		preFilStr[6] = "SUGAR PER SERVING";
		preFilStr[7] = "FAT PER SERVING";
		preFilStr[8] = "CALORIES PER SERVING";
		
		preFilStrEq["Search for a brand"] = "Searchforabrand";
		preFilStrEq["PRICE"] = "PRICE";
		preFilStrEq["SHAKEBOT RATING"] = "SHAKEBOTRATING";
		preFilStrEq["AMAZON RATING"] = "AMAZONRATING";
		preFilStrEq["PROTEIN PER SERVING"] = "PROTEINPERSERVING";
		preFilStrEq["CARBS PER SERVING"] = "CARBSPERSERVING";
		preFilStrEq["SUGAR PER SERVING"] = "SUGARPERSERVING";
		preFilStrEq["FAT PER SERVING"] = "FATPERSERVING";
		preFilStrEq["CALORIES PER SERVING"] = "CALORIESPERSERVING";
		
		preFilStrSlid["Search for a brand"] = "text";
		preFilStrSlid["PRICE"] = "slider-range";
		preFilStrSlid["SHAKEBOTRATING"] = "slider-range1";
		preFilStrSlid["AMAZONRATING"] = "slider-range2";
		preFilStrSlid["PROTEINPERSERVING"] = "slider-range3";
		preFilStrSlid["CARBSPERSERVING"] = "slider-range4";
		preFilStrSlid["SUGARPERSERVING"] = "slider-range5";
		preFilStrSlid["FATPERSERVING"] = "slider-range6";
		preFilStrSlid["CALORIESPERSERVING"] = "slider-range7";
		
		
		preFilVal[0] = "";
		preFilVal[1] = "0 - 1000"; //Removed
		preFilVal[2] = "0 - 100";
		preFilVal[3] = "0 - 100"; //Removed
		preFilVal[4] = "0 - 100";
		preFilVal[5] = "0 - 300";
		preFilVal[6] = "0 - 100";
		preFilVal[7] = "0 - 100";
		preFilVal[8] = "0 - 2000";
		
		selFillVal[0] = $.trim($("#brandFIlter").val());		
		//selFillVal[1] = $( "#slider-range" ).slider( "values", 0 )+" - "+$( "#slider-range" ).slider( "values", 1 );
		selFillVal[1] = "0 - 1000";
		selFillVal[2] = $( "#slider-range1" ).slider( "values", 0 )+" - "+$( "#slider-range1" ).slider( "values", 1 );
		//selFillVal[3] = $( "#slider-range2" ).slider( "values", 0 )+" - "+$( "#slider-range2" ).slider( "values", 1 );
		selFillVal[3] = "0 - 100";
		selFillVal[4] = $( "#slider-range3" ).slider( "values", 0 )+" - "+$( "#slider-range3" ).slider( "values", 1 );
		selFillVal[5] = $( "#slider-range4" ).slider( "values", 0 )+" - "+$( "#slider-range4" ).slider( "values", 1 );
		selFillVal[6] = $( "#slider-range5" ).slider( "values", 0 )+" - "+$( "#slider-range5" ).slider( "values", 1 );
		selFillVal[7] = $( "#slider-range6" ).slider( "values", 0 )+" - "+$( "#slider-range6" ).slider( "values", 1 );
		selFillVal[8] = $( "#slider-range7" ).slider( "values", 0 )+" - "+$( "#slider-range7" ).slider( "values", 1 );
		
		var incInd = 0;
		for(var ind=0;ind<=8;ind++){
			//alert(preFilVal[ind]+" == "+selFillVal[ind]);
			if(preFilVal[ind] != selFillVal[ind]){
				if(ind == 0){
					selectedFilters[incInd] = selFillVal[ind];
					selectedFiltersVal[incInd] = selFillVal[ind];
					incInd++;
				}else{
					selectedFilters[incInd] = preFilStr[ind];
					selectedFiltersVal[incInd] = selFillVal[ind];
					incInd++;
				}
			}
		}
		//alert(selectedFilters.length+" -"+selectedFiltersVal.length);
		
		var returnFil = [];
		returnFil[0] = selectedFilters;
		returnFil[1] = selectedFiltersVal;
		returnFil[2] = preFilStrEq;		
		returnFil[3] = preFilStrSlid;
				
		return returnFil;
	}
	
	//For showing the filters in the slider format
	function showslider(){	

			//Start (Shakebot Rating)
			$( "#slider-range1" ).slider({
			range: true,
			min: 0,
			max: 100,
			values: [ 0, 100 ],
			slide: function( event, ui ) {		
				$("#slider-range1rg1").val(ui.values[ 0 ]);
				$("#slider-range1rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range1rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range1rg2").val());
                                if(value1 <= value2 && value1>0){                                    
                                    $("#slider-range1").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range1" ).slider("option", "max"))){
                                    $("#slider-range1").slider("values", [ ($( "#slider-range1" ).slider("option", "max")), ($( "#slider-range1" ).slider("option", "max")) ]);
                                    $("#slider-range1rg1").val($( "#slider-range1" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range1rg1").val($( "#slider-range1" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range1").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range1rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range1rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range1" ).slider("option", "max")){
                                    $("#slider-range1").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range1").slider("values", [ value1,100 ]);
                                   $("#slider-range1rg2").val($( "#slider-range1" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range1rg1").val($( "#slider-range1" ).slider( "values", 0 )); 
			$("#slider-range1rg2").val($( "#slider-range1" ).slider( "values", 1 )); 
                        
			//Start (Protein per serving)
			$( "#slider-range3" ).slider({
			range: true,
			min: 0,
			max: 100,
			values: [ 0, 100 ],
			slide: function( event, ui ) {		
				$("#slider-range3rg1").val(ui.values[ 0 ]);
				$("#slider-range3rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range3rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range3rg2").val());
                                if(value1 <= value2 && value1>0){                                    
                                    $("#slider-range3").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range3" ).slider("option", "max"))){
                                    $("#slider-range3").slider("values", [ ($( "#slider-range3" ).slider("option", "max")), ($( "#slider-range3" ).slider("option", "max")) ]);
                                    $("#slider-range3rg1").val($( "#slider-range3" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range3rg1").val($( "#slider-range3" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range3").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range3rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range3rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range3" ).slider("option", "max")){
                                    $("#slider-range3").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range3").slider("values", [ value1,100 ]);
                                   $("#slider-range3rg2").val($( "#slider-range3" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range3rg1").val($( "#slider-range3" ).slider( "values", 0 )); 
			$("#slider-range3rg2").val($( "#slider-range3" ).slider( "values", 1 )); 	
			
			
			//Start (Carbs perserving)
			$( "#slider-range4" ).slider({
			range: true,
			min: 0,
			max: 300,
			values: [ 0, 300 ],
			slide: function( event, ui ) {		
				$("#slider-range4rg1").val(ui.values[ 0 ]);
				$("#slider-range4rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range4rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range4rg2").val());
                                if(value1 <= value2 && value1>0){                                    
                                    $("#slider-range4").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range4" ).slider("option", "max"))){
                                    $("#slider-range4").slider("values", [ ($( "#slider-range4" ).slider("option", "max")), ($( "#slider-range4" ).slider("option", "max")) ]);
                                    $("#slider-range4rg1").val($( "#slider-range4" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range4rg1").val($( "#slider-range4" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range4").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range4rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range4rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range4" ).slider("option", "max")){
                                    $("#slider-range4").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range4").slider("values", [ value1,300 ]);
                                   $("#slider-range4rg2").val($( "#slider-range4" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range4rg1").val($( "#slider-range4" ).slider( "values", 0 )); 
			$("#slider-range4rg2").val($( "#slider-range4" ).slider( "values", 1 )); 	
			
			
			//Start (Sugar perserving)
			$( "#slider-range5" ).slider({
			range: true,
			min: 0,
			max: 100,
			values: [ 0, 100 ],
			slide: function( event, ui ) {		
				$("#slider-range5rg1").val(ui.values[ 0 ]);
				$("#slider-range5rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range5rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range5rg2").val());
                                if(value1 <= value2 && value1>0){                                    
                                    $("#slider-range5").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range5" ).slider("option", "max"))){
                                    $("#slider-range5").slider("values", [ ($( "#slider-range5" ).slider("option", "max")), ($( "#slider-range5" ).slider("option", "max")) ]);
                                    $("#slider-range5rg1").val($( "#slider-range5" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range5rg1").val($( "#slider-range5" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range5").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range5rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range5rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range5" ).slider("option", "max")){
                                    $("#slider-range5").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range5").slider("values", [ value1,100 ]);
                                   $("#slider-range5rg2").val($( "#slider-range5" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range5rg1").val($( "#slider-range5" ).slider( "values", 0 )); 
			$("#slider-range5rg2").val($( "#slider-range5" ).slider( "values", 1 )); 	
			
			
			//Start (Fat per serving)
			$( "#slider-range6" ).slider({
			range: true,
			min: 0,
			max: 100,
			values: [ 0, 100 ],
			slide: function( event, ui ) {		
				$("#slider-range6rg1").val(ui.values[ 0 ]);
				$("#slider-range6rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range6rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range6rg2").val());
                                if(value1 <= value2 && value1>0){                                    
                                    $("#slider-range6").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range6" ).slider("option", "max"))){
                                    $("#slider-range6").slider("values", [ ($( "#slider-range6" ).slider("option", "max")), ($( "#slider-range6" ).slider("option", "max")) ]);
                                    $("#slider-range6rg1").val($( "#slider-range6" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range6rg1").val($( "#slider-range6" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range6").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range6rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range6rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range6" ).slider("option", "max")){
                                    $("#slider-range6").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range6").slider("values", [ value1,100 ]);
                                   $("#slider-range6rg2").val($( "#slider-range6" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range6rg1").val($( "#slider-range6" ).slider( "values", 0 )); 
			$("#slider-range6rg2").val($( "#slider-range6" ).slider( "values", 1 )); 	
			
			
			//Start (Calories per serving)
			$( "#slider-range7" ).slider({
			range: true,
			min: 0,
			max: 2000,
			values: [ 0, 2000 ],
			slide: function( event, ui ) {		
				$("#slider-range7rg1").val(ui.values[ 0 ]);
				$("#slider-range7rg2").val(ui.values[ 1 ]);		
			}
			});
                        
                         $("#slider-range7rg1").keyup(function () {
                            var value1 = parseInt(this.value);
                            var value2 = parseInt($("#slider-range7rg2").val());
                                if(value1 <= value2 && value1>0 ){                                    
                                    $("#slider-range7").slider("values", [ value1, value2 ]);
                                }
                                else if(value1>($( "#slider-range7" ).slider("option", "max"))){
                                    $("#slider-range7").slider("values", [ ($( "#slider-range7" ).slider("option", "max")), ($( "#slider-range7" ).slider("option", "max")) ]);
                                    $("#slider-range7rg1").val($( "#slider-range7" ).slider("option", "max"));
                                }
                                else if(value1<0 ){
                                    $("#slider-range7rg1").val($( "#slider-range7" ).slider("option", "min"));
                                }
                                else{
                                   $("#slider-range7").slider("values", [ 0,value2 ]); 
                                }
                            });
                        
                            $("#slider-range7rg2").keyup(function () {
                            var value2 = parseInt(this.value);
                            var value1 = parseInt($("#slider-range7rg1").val());
                                if(value2 >= value1 && value2 <= $( "#slider-range7" ).slider("option", "max")){
                                    $("#slider-range7").slider("values", [ value1, value2 ]);
                                }
                                else{
                                   $("#slider-range7").slider("values", [ value1,2000 ]);
                                   $("#slider-range7rg2").val($( "#slider-range7" ).slider("option", "max"));
                                }
                            });
			
			$("#slider-range7rg1").val($( "#slider-range7" ).slider( "values", 0 )); 
			$("#slider-range7rg2").val($( "#slider-range7" ).slider( "values", 1 )); 	
			
			//For filters part
			$(".accordion").accordion({
				//whether the first section is expanded or not
				firstChildExpand: false,
				//whether expanding mulitple section is allowed or not
				multiExpand: false,
				//slide animation speed
				slideSpeed: 500,
				//drop down icon
				dropDownIcon: "&#9660",
			});
			
			//For my filter part			
			/*$(".accordion1").accordion({
				//whether the first section is expanded or not
				firstChildExpand: false,
				//whether expanding mulitple section is allowed or not
				multiExpand: false,
				//slide animation speed
				slideSpeed: 500,
				//drop down icon
				dropDownIcon: "&#9660",
			});*/

		}
		
		//For showing the products on loading the page
		onloadProducts(1);
		
				
		function onloadProducts(ty){
			selectedFilterstmp = [];
			selectedFilterstmp = getSelFilters();		
			//alert("onloadProducts");	
			//function call for getting the produts with applied filters
			getProductsForFilters(selectedFilterstmp,ty);
                        
                        
		}
		
		//For filters slide
		$("#filterPanelShow").click(function(){
			$("#filterPanel").slideToggle("slow",function(){
				if($('#cornerIcon').attr('class') == 'fa fa-caret-up'){
					$('#cornerIcon').attr('class','fa fa-caret-down');
				}else{
					$('#cornerIcon').attr('class','fa fa-caret-up');
				}
			});									
		});		
		
		$("#myFiltersDiv").slideUp();			
		
		//For myfilter slide
		$("#myFiltersDivShow").click(function(){
			$("#myFiltersDiv").slideToggle("slow",function(){
				if($('#myFiltercornerIcon').attr('class') == 'fa fa-caret-up'){
					$('#myFiltercornerIcon').attr('class','fa fa-caret-down');
				}else{
					$('#myFiltercornerIcon').attr('class','fa fa-caret-up');
				}
			});			
			
			//$("#myFiltercornerIcon").toggleClass("fa fa-caret-down");
		});
		
		
});

function chckjs(jj){	
	document.getElementById('paginationPage').value=jj;
}
