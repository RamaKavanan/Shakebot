 
$(document).ready(function(){
	
	$("#datepicker").datepicker();
        $("#datepickerForDailyFeedback").datepicker();
        $("#rangeStart").datepicker();
        $("#rangeEnd").datepicker();  
        $("#accordion").accordion({ header: "h3", collapsible: true, active: false });
        $("#accordion").accordion();
        	  
	$('#sports').change(function(){
		var chngvalue = $(this).val();
		if (chngvalue == "Softball") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
		} else if (chngvalue == "Baseball") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
		} else if (chngvalue == "American Football") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Wide Receiver">Wide Receiver</option><option value="Running Back">Running Back</option><option value="Special Teams">Special Teams</option><option value="Quarterback">Quarterback</option><option value="Tight End">Tight End</option><option value="Linebacker">Linebacker</option><option value="Lineman">Lineman</option><option value="Defensive Back">Defensive Back</option></select>')
		} else if (chngvalue == "Basketball") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Guard">Guard</option><option value="Center">Center</option>[&quot;Forward&quot;, &quot;Guard&quot;, &quot;Center&quot;]</select>')
		} else if (chngvalue == "Cardio Training") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity Bouts">High Intensity Bouts</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Intervals">Intervals</option><option value="Tabatas">Tabatas</option><option value="Moderate Pace and Intensity">Moderate Pace and Intensity</option><option value="Fat Loss">Fat Loss</option></select>')
		} else if (chngvalue == "Swimming") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Short Distance (&lt; 200m)">Short Distance (&lt; 200m)</option><option value="Middle Distance (200m - 500m)">Middle Distance (200m - 500m)</option><option value="Long Distance (&gt;500m)">Long Distance (&gt;500m)</option></select>')
		} else if (chngvalue == "Running") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Long Distance (&gt; 800m)">Long Distance (&gt; 800m)</option><option value="Middle Distance (150m - 800m)">Middle Distance (150m - 800m)</option><option value="Sprints (30m - 100m)">Sprints (30m - 100m)</option></select>')
		} else if (chngvalue == "Field Hockey") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defense">Defense</option><option value="Midfielder">Midfielder</option><option value="Striker">Striker</option></select>')
		} else if (chngvalue == "Gymnastics") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Floor Exercise">Floor Exercise</option><option value="Balance Beam">Balance Beam</option><option value="Uneven Bars">Uneven Bars</option><option value="Vault">Vault</option></select>')
		} else if (chngvalue == "Ice Hockey") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defenseman">Defenseman</option><option value="Forward">Forward</option></select>')
		} else if (chngvalue == "Lacrosse") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
		} else if (chngvalue == "Snow Sports") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Skiing - Cross Country">Skiing - Cross Country</option><option value="Skiing - Alpine">Skiing - Alpine</option><option value="Skiing - Ski Jumping">Skiing - Ski Jumping</option></select>')
		} else if (chngvalue == "Soccer") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
		} else if (chngvalue == "Track and Field") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Sprints (&lt; 400m)">Sprints (&lt; 400m)</option><option value="Middle Distance (400m - 30000m)">Middle Distance (400m - 30000m)</option><option value="Long Distance (&gt; 3000m)">Long Distance (&gt; 3000m)</option><option value="Jumping - High Jump">Jumping - High Jump</option><option value="Jumping - Triple Jump">Jumping - Triple Jump</option><option value="Jumping - Long Jump">Jumping - Long Jump</option><option value="Jumping - Pole Vault">Jumping - Pole Vault</option><option value="Throwing - Shotput">Throwing - Shotput</option><option value="Throwing - Javelin">Throwing - Javelin</option><option value="Throwing - Hammer">Throwing - Hammer</option><option value="Throwing - Discus">Throwing - Discus</option></select>')
		} else if (chngvalue == "Long Distance Event") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Triathalon">Triathalon</option><option value="Marathon">Marathon</option><option value="Ultramarathon">Ultramarathon</option><option value="Iron Man">Iron Man</option></select>')
		} else if (chngvalue == "Volleyball") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Outside Hitter">Outside Hitter</option><option value="Middle Blocker">Middle Blocker</option><option value="Setter">Setter</option><option value="Libero/Defensive Specialist">Libero/Defensive Specialist</option></select>')
		} else if (chngvalue == "Resistance Training") {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity">High Intensity</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Fat Loss">Fat Loss</option><option value="Circuit Training">Circuit Training</option></select>')
		} else {
			$('#position').replaceWith('<select id="position" class="small" name="position"><option value=""><p><em>No Position</em></p></option></select>')
		}
	}); 
       
        function today(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            } 

            if(mm<10) {
                mm='0'+mm
            } 

            today = mm+'/'+dd+'/'+yyyy;
            return(today);
        }
        
        $("#datepickerForDailyFeedback").change(function(){
            var todayDate = today();
            var date = $("#datepickerForDailyFeedback").val();    
            //alert(date);
            if(date == "" ){
                date = todayDate;
            }
            dailyFeedback(date);            
        });
        
        $("#rangeStart").change(function(){
            var todayDate = today();
            var startDate = $("#rangeStart").val();   
            var endDate = $("#rangeEnd").val();   
            if(endDate == ""){
                endDate = todayDate;
            }
            feedbackForSelectedRange(startDate,endDate);
        });
         $("#rangeEnd").change(function(){
            var todayDate = today();
            var startDate = $("#rangeStart").val();   
            var endDate = $("#rangeEnd").val();   
            if(startDate == ""){
                startDate = todayDate;
            }
            feedbackForSelectedRange(startDate,endDate);
        });
        
	$("#historyId").click(function(){		
		callHistoryAjax("#historyIdspan");
	});
        
        function dailyFeedback(obtainedDate){ 
            $.get( 
                ajaxurl, // request url
                { action: 'getDailyActivitiesByDate','date':obtainedDate}, // request parameters
                function (response){ // callback
                    //console.log(response);
                    $("#showDailyActivities").html(response);
                }
            );
        }
        function feedbackForSelectedRange(startDate,endDate){
             yourActs(startDate,endDate);
//             var loadActivities = getAct();console.log(loadActivities);
              $.get( 
                ajaxurl, // request url
                { action: 'categoryAjax'}, // request parameters                  
                function (response){ // callback                     
                  // return response; 
                   $("#activitiesSpan").html(response);
                }
            );
                $.get( 
                    ajaxurl, // request url
                    { action: 'constructDataGrid','startDate':startDate,'endDate':endDate}, // request parameters
                    function (response){ // callback
                        var obj = JSON.parse(response);
                      //console.log(response);
                      //var a = [{"id" : obj[0].id}];
                          $("#jsGrid").jsGrid({                              
                               // filtering: true,
                                editing: true,
                                sorting: true,
                                paging: true,
                                inserting: true,
                                autoload: true,
                                pageSize: 15, 
                                //autowidth: true,
                                data:obj,
                                rowClick: function(args) {
                                    console.log(args);
          //  showDetailsDialog("Edit", args.item);
        },
        insertTemplate: function(value) {
        return this._insertPicker = $("<input>").datepicker({ defaultDate: new Date() });
        },
                                fields: [
//            { name: "date(addedon)",title:"Date", type: "text" ,width: 150 , editing:false},
            { name: "date(addedon)",title:"Date", type: "myDateField", width: 150 ,align: "center" },
            
            { name: "activity_name",title:"Activity Name", type: "select", items:[
                    { Name: "", Id: 0 },
                    { Name: "American Football", Id: 37 },
                    { Name: "Badminton", Id: 1 },
                    { Name: "Baseball", Id: 2 },
                    { Name: "Basketball", Id: 3 },
                    { Name: "Biking", Id: 4 },
                    { Name: "Bodybuilding", Id: 5 },
                    { Name: "Bowling", Id: 6 },
                    { Name: "Boxing", Id: 7 },
                    { Name: "Calisthetics", Id: 8 },
                    { Name: "Circuits", Id: 9 },
                    { Name: "CrossFit", Id: 10 },
                    { Name: "Figure Skating", Id: 11 },
                    { Name: "Frisbee", Id: 12 },
                    { Name: "Golf", Id: 13 },
                    { Name: "Gymnastics", Id: 14 },
                    { Name: "Ice Hockey", Id: 15 },
                    { Name: "Ice Skating", Id: 16 },
                    { Name: "Jogging", Id: 17 },
                    { Name: "Lacrosse", Id: 18 },
                    { Name: "Mixed Martial Arts", Id: 19 },
                    { Name: "Racquetball", Id: 20 },
                    { Name: "Rowing", Id: 21 },
                    { Name: "Rugby", Id: 22 },
                    { Name: "Running", Id: 23 },
                    { Name: "Skateboarding", Id: 24 },
                    { Name: "Skiing – Cross Country", Id: 25 },
                    { Name: "Skiing – Downhill", Id: 26 },
                    { Name: "Soccer", Id: 27 },
                    { Name: "Sprinting", Id: 28 },
                    { Name: "Swimming", Id: 29 },
                    { Name: "Tennis", Id: 30 },
                    { Name: "Track and Field - Jumping Events", Id: 31 },
                    { Name: "Track and Field - Throwing Events", Id: 32 },
                    { Name: "Volleyball", Id: 33 },
                    { Name: "Weight Training", Id: 34 },
                    { Name: "Wrestling", Id: 35 },
                    { Name: "Yoga", Id: 36 }
            ], valueField: "Name", textField: "Name", width: 150 },
//            { name: "activity_name",title:"Activity Name",type: "text", width: 150, align: "center" },      
            { name: "weight",title:"Weight (in kg)", type: "text" ,width: 150, align: "center" },
            { name: "duration",title:"Duration (in mins)", type: "text" ,width: 150, align: "center"},
            { name: "todayReq_calories",title:"Total Calories", type: "text" ,width: 150 ,editing:false, align: "center"},
            {
                type: "control",
                modeSwitchButton: false,
                editButton: true,
                deleteConfirm: function(obj) {
            return "The activity \"" + obj.activity_name + "\" will be removed. Are you sure?";
        },        
            }
                            ],
            onItemUpdating: function(args) {console.log(args.item);
                    $.get( 
                        ajaxurl, // request url
                        { action: 'updateDataGrid','selectedDate':args.item.addedon,'actName':args.item.activity_name,'weight':args.item.weight,'duration':args.item.duration,'tcal':args.item.todayReq_calories,'id':args.item.id}, // request parameters
                        function (response){  alert(response);}
                    );
            },  

             onItemInserting: function(args) {console.log(args.item);
                    $.get( 
                        ajaxurl, // request url
                        { action: 'insertDataGrid','selectedDate':args.item.date(addedon),'actName':args.item.activity_name,'weight':args.item.weight,'duration':args.item.duration,'tcal':args.item.todayReq_calories,'id':args.item.id}, // request parameters
                        function (response){  alert(response);}
                    );
             },  
             onItemDeleting: function(args) {
                     $.get( 
                        ajaxurl, // request url
                        { action: 'deleteDataGrid','id':args.item.id}, // request parameters
                        function (response){  alert(response);}
                    );
             },
                          }); 
                    }
                );
                    // yourActs(startDate,endDate);
                }
                 var MyDateField = function(config) {
        jsGrid.Field.call(this, config);
    };
 
    MyDateField.prototype = new jsGrid.Field({
        sorter: function(date1, date2) {
            return new Date(date1) - new Date(date2);
        },
 
        itemTemplate: function(value) {
            return new Date(value).toDateString();
        },
 
        insertTemplate: function(value) {
            return this._insertPicker = $("<input>").datepicker({ defaultDate: new Date() });
        },
 
        editTemplate: function(value) {
            return this._editPicker = $("<input>").datepicker().datepicker("setDate", new Date(value));
        },
 
        insertValue: function() {
//            this._insertPicker.datepicker("getDate").toISOString();
            var a = this._insertPicker.datepicker("getDate").toISOString();
              var date = new Date(a),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
    return([ date.getFullYear(), mnth, day ].join("-"));
//               alert(this._insertPicker.datepicker("getDate")); 
//            return date("Y-m-d H:i:s", strtotime(this._insertPicker.datepicker("getDate")));
        },
 
        editValue: function() {
//            return this._editPicker.datepicker("getDate").toISOString();
            return this._editPicker.datepicker("getDate");
//            return date("Y-m-d", strtotime(this._editPicker.datepicker("getDate")));
        }
    });
 
    jsGrid.fields.myDateField = MyDateField;
    
                function getAct(){ 
               
                }
                function yourActs(startDate ,endDate){
                $.get( 
                ajaxurl, // request url
                { action: 'getFilteredActivitiesByDate','startDate':startDate,'endDate':endDate}, // request parameters
                  
                function (response){ // callback
                    
                    var res ='';
                    res = response.split("###");
                    //console.log(res);
                        $("#summup").html(res[2]);
                        $("#averages").html(res[3]);
                        $("#activbreak").html(res[1]);
                }
            );
                    
                }
           
    $("a[data-tab]").on('click', function() {
        var tab = $(this).attr('data-tab'),
            target = $(this).attr('href');
        $('ul.nav a[href="' + tab + '"]').tab('show');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 10);    
    });

        function callHistoryAjax(pass){		
		$.get( 
			ajaxurl, // request url
			{ action: 'historyAjax', 'whatever': 1}, // request parameters
			function (response){ // callback			
				// handle the response							
				$(pass).html(response);						
			}
		);
	}
	
	
});
