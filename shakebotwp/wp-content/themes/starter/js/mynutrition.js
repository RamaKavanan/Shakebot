
	$(document).ready(function(){
            clearSession(); 
		//Category AJAX starts
		callAjax('#loseWeightSpan','dummval');
                
                var loadImg = main_url+"/wp-content/themes/starter/images/loading_spinner.gif";
		var loadImgSpan = "<center><img src='"+loadImg+"'></center>";
		
               
                
		function callAjax(pass,pass1){
				$.get( 
				ajaxurl, // request url
				{ action: 'categoryAjax', 'whatever': 1, 'nutri':pass1}, // request parameters
				function (response){ // callback
					// handle the response 
					$(pass).html(response);	                                        
                                        todayActivities(false);				
					activityAjax();
					$('[data-toggle="tooltip"]').tooltip();  // For tooltip
					
					nutritionCal();
					callAjaxNutri('empty');
					
					$( ".select2" ).select2( { placeholder: "", maximumSelectionSize: 3 } );
//                                        $( ".select2" ).select2("open");
				}
			);    
		}
			
		$("#loseWeightId").click(function(){
                    document.getElementById('nutDuration').value= 0;                        
			var wholeVal = $("#mainCat").val()+"#@#@#"+$("#activitiesdif").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#catValHd").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val();
			$("#mainCat").val("1");                      
			callAjax('#loseWeightSpan',wholeVal);			
			$("#maintainWeightSpan").html('');
			$("#gainWeightSpan").html('');
		});
		
		$("#maintainWeightId").click(function(){
                     document.getElementById('nutDuration').value= 0;
			var wholeVal = $("#mainCat").val()+"#@#@#"+$("#activitiesdif").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#catValHd").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val();
			$("#mainCat").val("2");
			callAjax('#maintainWeightSpan',wholeVal);				
			$("#loseWeightSpan").html('');					
			$("#gainWeightSpan").html('');		
		});
		
		$("#gainWeightId").click(function(){	
                     document.getElementById('nutDuration').value= 0;
			var wholeVal = $("#mainCat").val()+"#@#@#"+$("#activitiesdif").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#catValHd").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val();
			$("#mainCat").val("3");
			callAjax('#gainWeightSpan',wholeVal);
			$("#loseWeightSpan").html('');		
			$("#maintainWeightSpan").html('');			
		});
                
		//Category AJAX ends
		
		//Nutrition calculation starts
		function nutritionCal(){ 
			
			$("#nutCallBtn").click(function(){
                            
				var passValNutri = $("#mainCat").val()+"#@#@#"+$("#activitiesdif").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val();				
				//savetodayActivities(passValNutri);
                                callAjaxNutri(passValNutri);	
                         
			});
			
			$("#submitCal").click(function(){
			
				var passValNutri = $("#mainCat").val()+"#@#@#"+$("#activitiesdif").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val()+"#@#@#submitfrm";				                             
                                callAjaxNutri(passValNutri);
                                
			});
                        
                         $("#addToActivityBtn").click(function(){                                
				var passValNutri = $("#activitiesdif").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#submitfrm";				
				savetodayActivities(passValNutri);
                                
			});
		}

                function buttonCal(){
                        $(".clsz").click(function(){                        
                        var result = confirm("Do you want to delete this activity?");
                        if (result) {
                            toggleEnable();
                            var actId = this.id ;   //alert(this.id);                      
                            deleteTodayActivities(actId);                          
                                                         
                        }                                           
                    });
                   toggleEnable(); 
                }
                
                function toggleEnable(){
                     var rowcount = (document.getElementById("showActivityId").rows.length)-1;
                            if (rowcount > 0 ){//alert("if"+rowcount);
                                $("#nutCallBtn").prop('disabled', false);
                                $('#submitCal').prop('disabled', false);
                                
                            }else{//alert("else"+rowcount);
                                $("#nutCallBtn").prop('disabled', true);
                                $('#submitCal').prop('disabled', true);
                            }                            
                }
                
                function deleteTodayActivities(actId){ //alert("does");
                    $.get( 
                            ajaxurl, // request url
                            { action: 'activityDeleteAjax', 'delVal': actId },
                                    function (response){ // callback 
                                            todayActivities(true);
                                            
                            }
                    );
                }
                function savetodayActivities(pass){
                    var res1 = pass.split("#@#@#");
                    var vl = $("#activitiesdif").val();
                            var selectedActivity = $("#subCategoryHd").val()+"#@#@#"+$("#mainCat").val()+"#@#@#"+vl+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#uidHd").val()+"#@#@#"+$("#generalActivityLevel").val()+"#@#@#"+$("#postExHdCalCat").val();+"";

                            $.get( 
                                ajaxurl, // request url
                                    { action: 'activitySaveAjax', 'nutriSaveVal': selectedActivity }, // request parameters                               
                                            function (response){ // callback 
                                                var res = '';
                                                res = response.split("###");
                                                
                                                $("#sucMsgId1").css("display","none");
                                                if($.trim(res[0]) != '' && pass != 'empty'){
                                                        $("#errMsgId").css('display',"block");
                                                        $("#sucMsgId").css('display',"none");
                                                        $("#errMsgId").html(res[0]);				  
                                                        $('html, body').animate({
                                                                          scrollTop: $("html").offset().top
                                                        }, 500);
                                                        
                                                        todayActivities(false);
                                                        $("#nutCallBtn").prop('disabled', true);
                                                        $("#submitCal").prop('disabled', true);

                                                }else{
                                                        resp = response.split("###");
                                                        $("#errMsgId").css('display',"none");
                                                        $("#sucMsgId1").css("display","");									
                                                        $("#sucMsgId1").html(resp); 
                                                        
                                                     todayActivities(true);
                                                     $("#nutCallBtn").prop('disabled', false);
                                                     $("#submitCal").prop('disabled', false);
                                                }
                                            }
                                            
                            );                         
                }
                function todayActivities(flg){ 
                    $.get( 
				ajaxurl, // request url
				{ action: 'todayActAjax'}, // request parameters
				function (response){ // callback  
                                    
					var res = '';
					res = response.split("###");
                                            if(flg){
							$('html, body').animate({
								  scrollTop: $("#showTable1").offset().top
							}, 10); 
                                                    }
                                        $("#showActivityId").html(response);
                                        buttonCal();                       
                                }
                        ); 
                }		
		function callAjaxNutri(pass){
			var res1 = pass.split("#@#@#");
						
			$.get( 
				ajaxurl, // request url
				{ action: 'nutricallAjax', 'nutriVal': pass }, // request parameters
				function (response){ // callback
					// handle the response                                          
					var res = '';
                                        
					res = response.split("###");
					$("#sucMsgId1").css("display","none");
					if($.trim(res[0]) != '' && pass != 'empty'){
						$("#errMsgId").css('display',"");
						$("#sucMsgId").css('display',"none");
						$("#errMsgId").html(res[0]);				  
						$('html, body').animate({
								  scrollTop: $("html").offset().top
						}, 500);
						
					}else{
						$("#errMsgId").css('display',"none");
												
						$("#nutritionTbId").html(res[1]);                                                
						$("#showProductListID").html(res[2]);
						
						var vl = $("#activitiesdif").val();                                               
						$("#activityhd").val(vl);
					
					
						if($.trim(res1[12]) == 'submitfrm'){                                   
							//var goalTyp = $("#subCategoryHd").val()+"#@#@#"+$("#mainCat").val()+"#@#@#"+$("#activityhd").val()+"#@#@#"+$("#nutWeight").val()+"#@#@#"+$("#nutWeighttyp:checked").val()+"#@#@#"+$("#nutDuration").val()+"#@#@#"+$("#nutDurationtyp:checked").val()+"#@#@#"+$("#postExHdCalories").val()+"#@#@#"+$("#postExHdCarbohydrate").val()+"#@#@#"+$("#postExHdProtein").val()+"#@#@#"+$("#postExHdFat").val()+"#@#@#"+$("#postExHdBCAA").val()+"#@#@#"+$("#postExHdCalCat").val()+"#@#@#"+$("#todayReqHdCalories").val()+"#@#@#"+$("#todayReqHdCarbohydrate").val()+"#@#@#"+$("#todayReqHdProtein").val()+"#@#@#"+$("#todayReqHdFat").val()+"#@#@#"+$("#todayReqHdBCAA").val()+"#@#@#"+$("#uidHd").val()+"#@#@#"+$("#nutAge").val()+"#@#@#"+$("#nutHeight").val()+"#@#@#"+$("#nutHeighttyp:checked").val()+"#@#@#"+$("#nutIntensitytyp:checked").val()+"#@#@#"+$("#genderTyp:checked").val()+"#@#@#"+$("#generalActivityLevel").val();+"";
                                                        var goalType = {
					'goal_type' : $("#mainCat").val(),
					'activity' : vl, 	
					'weight' : $("#nutWeight").val(),
					'weight_type' : $("#nutWeighttyp:checked").val(),
					'duration' : $("#nutDuration").val(),
					'duration_type' : $("#nutDurationtyp:checked").val(),
					'cal_category' : $("#postExHdCalCat").val(),
					'postEx_calories' : $("#postExHdCalories").val(),
					'postEx_carbohydrate' : $("#postExHdCarbohydrate").val(),
					'postEx_protein' : $("#postExHdProtein").val(),
					'postEx_fat' : $("#postExHdFat").val(),
					'postEx_BCAA' : $("#postExHdBCAA").val(),
					'todayReq_calories' : $("#todayReqHdCalories").val(),
					'todayReq_carbohydrate' : $("#todayReqHdCarbohydrate").val(),
					'todayReq_protein' : $("#todayReqHdProtein").val(),
					'todayReq_fat' : $("#todayReqHdFat").val(),
					'todayReq_BCAA' : $("#todayReqHdBCAA").val(),
                                        'age' : $("#nutAge").val(),
                                        'height' : $("#nutHeight").val(),
                                        'height_type' : $("#nutHeighttyp:checked").val(), 
                                        'intensity_type' : $("#nutIntensitytyp:checked").val(), 
                                        'gender' : $("#genderTyp:checked").val(),
                                        'general_activity_level' : $("#generalActivityLevel").val(),
                                        'uid': $("#uidHd").val()
					};
							 $.get( 
								ajaxurl, // request url
								{ action: 'nutricallSaveAjax', 'nutriSaveVal': goalType }, // request parameters
									function (response1){ // callback 	
                                                                            $("#sucMsgId1").css("display","");									
                                                                            $("#sucMsgId1").html(response1);  
                                                                            $('html, body').animate({
                                                                                scrollTop: $("html").offset().top
                                                                            }, 500);
								}
							);
								
						}
						
						if(pass != 'empty'){
							$('html, body').animate({
								  scrollTop: $("#showTable").offset().top
							}, 1000); 
						}
						
					}
                                        
                                        $("#nutCallBtn").prop('disabled', true);
                                       
                                        $('.popup-with-form').magnificPopup({type: 'inline',
                                                preloader: false,
                                                focus: '#name',                                               
                                                callbacks: {
                                                        beforeOpen: function() {
                                                            $(window).scroll(function() { return true; });
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
	
		//Nutrition calculation ends
		
		//Activity AJAX Starts		
		function callAjaxAct(pass){ 
			$("#subCategoryHd").val(pass);
				$.get( 
				ajaxurl, // request url
				{ action: 'categoryAjax', 'whateveract': pass }, // request parameters
				function (response){ // callback
					// handle the response				
					$("#activitiesSpan").html(response);
					$( ".select2" ).select2( { placeholder: "", maximumSelectionSize: 3 } );	
					$( ".select2" ).select2("open");				
				}
			);
		}
		
		function activityAjax(){
			var cnt= $("#catCountHd").val();		
		}		
		//Activity AJAX ends
			
	});
        
         function clearSession(){
                     $.get( 
                            ajaxurl, // request url
                            { action: 'destroySession' },
                           
                                    function (response){
                            }
                    );
                }
        
