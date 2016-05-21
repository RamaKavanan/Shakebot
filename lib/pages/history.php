<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; ?>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>


<script>


AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  // load it
  // the last "false" parameter ensures that our code will wait before the
  // data is loaded
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};


var chartData = AmCharts.loadJSON('lib/functions/chartData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');
var chartWeightData = AmCharts.loadJSON('lib/functions/chartWeightData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');
var chartCalData = AmCharts.loadJSON('lib/functions/chartCalData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');


/*var chart = AmCharts.makeChart("chartdiv", {
	
        "type": "serial",
        "theme": "none",
        "pathToImages": "http://www.amcharts.com/lib/3/images/",
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id":"v1",
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
			"id": "g1",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "value"
        }, {
"id": "g2",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "value1"

    	}],
        "chartScrollbar": {
			"graph": "g1",
			"scrollbarHeight": 30
		},
        "chartCursor": {
            "cursorPosition": "mouse",
            "pan": true,
             "valueLineEnabled":true,
             "valueLineBalloonEnabled":true
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true,
            "position": "top"
        },
        exportConfig:{
          menuRight: '20px',
          menuBottom: '50px',
          menuItems: [{
          icon: 'http://www.amcharts.com/lib/3/images/export.png',
          format: 'png'	  
          }]  
        },
        "dataProvider": chartData
    }
);

chart.addListener("rendered", zoomChart);

zoomChart();
function zoomChart(){
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}
*/
var chart;
var chart2;
var chart3;

// create chart


  // load the data
  var chartData = AmCharts.loadJSON('lib/functions/chartData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');
  console.debug(chartData);
/*
  // SERIAL CHART    
  chart = new AmCharts.AmSerialChart();
  chart.pathToImages = "http://www.amcharts.com/lib/images/";
  chart.dataProvider = chartData;
  chart.categoryField = "category";
  chart.dataDateFormat = "YYYY-MM-DD";
  chart.Scrollbar = {
		"updateOnReleaseOnly": true
	};



  // GRAPHS

  var graph1 = new AmCharts.AmGraph();
  graph1.valueField = "value1";
  graph1.title = "Protein (grams)";
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderThickness = 2;
  graph1.lineThickness = 2;
  graph1.lineAlpha = 0.5;
  chart.addGraph(graph1);

  var graph2 = new AmCharts.AmGraph();
  graph2.valueField = "value2";
  graph2.title = "Fat (grams)";
  graph2.bullet = "round";
  graph2.bulletBorderColor = "#FFFFFF";
  graph2.bulletBorderThickness = 2;
  graph2.lineThickness = 2;
  graph2.lineAlpha = 0.5;
  chart.addGraph(graph2);

  var graph3 = new AmCharts.AmGraph();
  graph3.valueField = "value3";
  graph3.title = "Carbs (grams)";
  graph3.bullet = "round";
  graph3.bulletBorderColor = "#FFFFFF";
  graph3.bulletBorderThickness = 2;
  graph3.lineThickness = 2;
  graph3.lineAlpha = 0.5;
  chart.addGraph(graph3);

  var graph4 = new AmCharts.AmGraph();
  graph4.valueField = "value4";
  graph4.title = "Weight (pounds)";
  graph4.bullet = "round";
  graph4.bulletBorderColor = "#FFFFFF";
  graph4.bulletBorderThickness = 2;
  graph4.lineThickness = 2;
  graph4.lineAlpha = 0.5;
  chart.addGraph(graph4);

    chart.legend = {
  	
		"useGraphSettings": true,
		"valueText": "[[value]]",
		"labelText": "[[title]]"
	}

  // CATEGORY AXIS 
  chart.categoryAxis.parseDates = true;

  // WRITE
   chart.write("chartdiv");
     chart.addListener("dataUpdated", zoomChart);
function zoomChart(){
  if(chart.zoomToIndexes){
    chart.zoomToIndexes(130, chartData.length - 1);
  }
}

*/



var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "http://www.amcharts.com/lib/3/images/",
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id":"v1",
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
      "id": "g1",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "Protein",
            "useLineColorForBulletBorder": true,
            "valueField": "value1"
        }, {
          "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "Fat",
            "useLineColorForBulletBorder": true,
            "valueField": "value2"
        }, {
          "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "Carbohydrates",
            "useLineColorForBulletBorder": true,
            "valueField": "value3"
          }, {
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "Weight",
            "useLineColorForBulletBorder": true,
            "valueField": "value4"
          }],
        "chartScrollbar": {
      "graph": "g1",
      "scrollbarHeight": 30
    },
      "legend": {
    
    "useGraphSettings": true,
    "valueText": "[[value]]",
    "labelText": "[[title]]"
  },
        "chartCursor": {
            "cursorPosition": "mouse",
            "pan": true,
             "valueLineEnabled":true,
             "valueLineBalloonEnabled":true
        },
        "categoryField": "category",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true,
            "position": "top"
        },
        exportConfig:{
          menuRight: '20px',
          menuBottom: '50px',
          menuItems: [{
          icon: 'http://www.amcharts.com/lib/3/images/export.png',
          format: 'png'   
          }]  
        },
        "dataProvider": chartData
    }
);

chart.addListener("rendered", zoomChart);

zoomChart();
function zoomChart(){
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}


////////////////////////////////////////////////////////////////////////

// create chart


////////////////////////////////////////////////
// create chart


  // load the data
  var chartData2 = AmCharts.loadJSON('lib/functions/chartCalData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');
  console.debug(chartData2);

  // SERIAL CHART    
  chart3 = new AmCharts.AmSerialChart();
  chart3.pathToImages = "http://www.amcharts.com/lib/images/";
  chart3.dataProvider = chartData2;
  chart3.categoryField = "category";
  chart3.dataDateFormat = "YYYY-MM-DD";
  chart3.Scrollbar = {
    "updateOnReleaseOnly": true
  };



  // GRAPHS

  var graph1 = new AmCharts.AmGraph();
  graph1.valueField = "value1";
  graph1.title = "Calories";
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderThickness = 2;
  graph1.lineThickness = 2;
  graph1.lineAlpha = 0.5;
  chart3.addGraph(graph1);


    chart3.legend = {
    
    "useGraphSettings": true,
    "valueText": "[[value]]",
    "labelText": "[[title]]"
  }

  // CATEGORY AXIS 
  chart3.categoryAxis.parseDates = true;

  // WRITE
 
  chart3.write("chart3div");



//zoomChart();




chart3.addListener("dataUpdated", zoomchart3);
//zoomChart();

function zoomchart3(){
  if(chart3.zoomToIndexes){
    chart3.zoomToIndexes(130, chartData.length - 1);
  }
}






  // load the data
  var chartWeightData = AmCharts.loadJSON('lib/functions/chartWeightData.php?user=<?php echo $_SESSION["loggedinuser"]; ?>');
  console.debug(chartWeightData);

  // SERIAL CHART    
  chart2 = new AmCharts.AmSerialChart();
  chart2.pathToImages = "http://www.amcharts.com/lib/images/";
  chart2.dataProvider = chartWeightData;
  chart2.categoryField = "category";
  chart2.dataDateFormat = "YYYY-MM-DD";
  chart2.Scrollbar = {
    "updateOnReleaseOnly": true
  };



  // GRAPHS

  var graph9 = new AmCharts.AmGraph();
  graph9.valueField = "value1";
  graph9.title = "Weight";
  graph9.bullet = "round";
  graph9.bulletBorderColor = "#FFFFFF";
  graph9.bulletBorderThickness = 2;
  graph9.lineThickness = 2;
  graph9.lineAlpha = 0.5;
  chart2.addGraph(graph9);


    chart2.legend = {
    
    "useGraphSettings": true,
    "valueText": "[[value]]",
    "labelText": "[[title]]"
  }

  // CATEGORY AXIS 
  chart2.categoryAxis.parseDates = true;

  // WRITE
 
  chart2.write("weightHistory");



//zoomChart();




chart2.addListener("dataUpdated", zoomChart2);
//zoomChart();

function zoomChart2(){
  if(chart2.zoomToIndexes){
    chart2.zoomToIndexes(130, chartData.length - 1);
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////

var chart3 = AmCharts.makeChart("chart3div", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "http://www.amcharts.com/lib/3/images/",
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id":"v1",
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
      "id": "g1",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "Daily Recommended Calorie Intake",
            "useLineColorForBulletBorder": true,
            "valueField": "value1"
        }],
        "chartScrollbar": {
      "graph": "g1",
      "scrollbarHeight": 30
    },
      "legend": {
    
    "useGraphSettings": true,
    "valueText": "[[value]]",
    "labelText": "[[title]]"
  },
        "chartCursor": {
            "cursorPosition": "mouse",
            "pan": true,
             "valueLineEnabled":true,
             "valueLineBalloonEnabled":true
        },
        "categoryField": "category",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true,
            "position": "top"
        },
        exportConfig:{
          menuRight: '20px',
          menuBottom: '50px',
          menuItems: [{
          icon: 'http://www.amcharts.com/lib/3/images/export.png',
          format: 'png'   
          }]  
        },
        "dataProvider": chartData2
    }
);

chart3.addListener("rendered", zoomChart3);

zoomChart3();
function zoomChart3(){
    chart3.zoomToIndexes(chart3.dataProvider.length - 40, chart3.dataProvider.length - 1);
}

$(document).ready(function(){
  
  $('.historyView').hide();
  $('.subnav ul li a').removeClass('active');
    $('.nutritionBtn').addClass('active');
   
   $('#nutritionView').fadeIn('fast');
   
  $(document).on('click', '.weightBtn', function(e){
    e.preventDefault();
    $('.subnav ul li a').removeClass('active');
    $(this).addClass('active');
    $('.historyView').hide();
    $('#weightHistory').fadeIn('fast');
  });

  $(document).on('click', '.workoutBtn', function(e){
     e.preventDefault();
    $('.subnav ul li a').removeClass('active');
    $(this).addClass('active');
    $('.historyView').hide();
    $('#activityHistory').fadeIn('fast');
  });

    $(document).on('click', '.nutritionBtn', function(e){
       e.preventDefault();
    $('.subnav ul li a').removeClass('active');
    $(this).addClass('active');
    $('.historyView').hide();
    $('#nutritionView').fadeIn('fast');
    
  });

});

	$(document).ready(function(){
    if ($(activetile == "nutrition")) {
      $(tiles).removeClass("active");
      $(tile_nut).addClass("active");
    } else if ($(activetile == "history")) {
      $(tiles).removeClass("active");
      $(tile_his).addClass("active");
    } else if ($(activetile == "settings")) {
      $(tiles).removeClass("active");
      $(tile_set).addClass("active");
    } else if ($(activetile == "research")) {
      $(tiles).removeClass("active");
      $(tile_set).addClass("active");
    };	
	});
</script>
<div class="row subnav">
  <ul>
  <li><a href="" class="nutritionBtn">Nutritional Needs History</a></li>
    <li><a href="" class="workoutBtn">Workout History</a></li>
    <li><a href="" class="weightBtn">Weight History</a></li>
    


  </ul>
</div>
<div class="recentHistory" id="recentNutrition">
<div class="row">
<div class="small-6 columns">
Latest Content:
<?php getLatestStats($_SESSION['loggedinuser']); ?>
</div>
<div class="small-6 columns">
Last 7 days Average:
<?php getAverageStats($_SESSION['loggedinuser']); ?>
</div>
</div>
</div>


<div class="row marginRow noMarginTop">
	<h1 class="noMargin">My History</h1>

  <div class="historyView" id="nutritionView">
  <h4>Nutrition History (Protein, Fat, Carbohydrates, Weight)</h4>
	<div class="" id="chartdiv"></div>		
  <h4>Recommended Calorie Intake History</h4>
  <div class="" id="chart3div"></div>
</div>

  <div class="historyView" id="weightHistory"></div> 

	<table id="activityHistory" class="table table-bordered historyView">
		<thead>
			<tr>
				<th>Date</th>
				
			
				<th>Activity</th>
        <th>Activity Type</th>
			</tr>
		</thead>
		<tbody>
			<?php getActivityHistory($loggedInUser->username); ?>
		</tbody>
	</table>
	</div>
