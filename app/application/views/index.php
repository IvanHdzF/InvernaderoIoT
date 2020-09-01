<?php
//This line will make the page auto-refresh each 15 seconds
$page = $_SERVER['PHP_SELF'];
$sec = "15";
?>


<html>
<head>
<!--//I've used bootstrap for the tables, so I inport the CSS files for taht as well...-->
<meta >
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>





<body>



<?php
include("database_connect.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM `ESPtable2` WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");//table select

echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Boolean Indicators</th>
		</tr>
	</thead>

    <tbody>
      <tr class='active'>
        <td>Ultima Medición</td>
        <td>Indicator 1</td>
        <td>Indicator 2 </td>
		<td>Indicator 3 </td>
      </tr>
		";



while($row = mysqli_fetch_array($result)) {

 	$cur_sent_bool_1 = $row['SENT_BOOL_1'];
	$cur_sent_bool_2 = $row['SENT_BOOL_2'];
	$cur_sent_bool_3 = $row['SENT_BOOL_3'];


	if($cur_sent_bool_1 == 1){
    $label_sent_bool_1 = "label-success";
	$text_sent_bool_1 = "Active";
	}
	else{
    $label_sent_bool_1 = "label-danger";
	$text_sent_bool_1 = "Inactive";
	}


	if($cur_sent_bool_2 == 1){
    $label_sent_bool_2 = "label-success";
	$text_sent_bool_2 = "Active";
	}
	else{
    $label_sent_bool_2 = "label-danger";
	$text_sent_bool_2 = "Inactive";
	}


	if($cur_sent_bool_3 == 1){
    $label_sent_bool_3 = "label-success";
	$text_sent_bool_3 = "Active";
	}
	else{
    $label_sent_bool_3 = "label-danger";
	$text_sent_bool_3 = "Inactive";
	}


	  echo "<tr class='info'>";
	  $unit_id = $row['id'];
        echo "<td id=ultimaMed>" . $row['id'] . "</td>";
		echo "<td id=b1>
		<span class='label $label_sent_bool_1'>"
			. $text_sent_bool_1 . "</td>
	    </span>";

		echo "<td id=b2>
		<span class='label $label_sent_bool_2'>"
			. $text_sent_bool_2 . "</td>
	    </span>";

		echo "<td id=b3>
		<span class='label $label_sent_bool_3'>"
			. $text_sent_bool_3 . "</td>
	    </span>";
	  echo "</tr>
	  </tbody>";



}
echo "</table>";
?>










<?php
//Tabla de valores de los sensores
include("database_connect.php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM `ESPtable2` WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");//table select


echo "<table id='Tabla' class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th colspan=\"4\"> Mediciones de los sensores</th>
		</tr>
	</thead>


    <tbody>
      <tr  class='active'>
        <td style=\"width:230px\">Sensor 1</td>
        <td style=\"width:230px\">Sensor 2</td>
        <td style=\"width:230px\">Sensor 3</td>
		<td style=\"width:230px\">Sensor 4</td>
      </tr>
		";


while($row = mysqli_fetch_array($result)) {

 	echo "<tr id='sensorVal' class='info'>";

	echo "<td id=\"n1\" >" . $row['SENT_NUMBER_1'] . "</td>";
	echo "<td id=\"n2\" >" . $row['SENT_NUMBER_2'] . "</td>";
	echo "<td id=\"n3\" >" . $row['SENT_NUMBER_3'] . "</td>";
	echo "<td id=\"n4\" >" . 0 . "</td>";

	echo "</tr>
	</tbody>";

}
echo "</table>
<br>
";
?>
<button>Cierre de prueba</button>
<ul>
</ul>



<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>



<h2>Gráficas</h2>
<p>Seleccione el sensor:</p>

<div class="tab">
  <button class="tablinks" onclick="VerGrafica(event, 'S1')" id="defaultOpen">Sensor 1</button>
  <button class="tablinks" onclick="VerGrafica(event, 'S2')">Sensor 2</button>
  <button class="tablinks" onclick="VerGrafica(event, 'S3')">Sensor 3</button>
</div>

<div id="S1" class="tabcontent">
  <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Ultimos valores leídos por el sensor 1 en los ultimos 20 segundos.
    </p>
</figure>
</div>

<div id="S2" class="tabcontent">
<figure class="highcharts-figure">
    <div id="container2"></div>
    <p class="highcharts-description">
        Ultimos valores leídos por el sensor 2 en los ultimos 20 segundos.
    </p>
</figure>
</div>

<div id="S3" class="tabcontent">
<figure class="highcharts-figure">
    <div id="container3"></div>
    <p class="highcharts-description">
        Ultimos valores leídos por el sensor 3 en los ultimos 20 segundos.
    </p>
</figure>
</div>










<script>
  var button = document.querySelector('button');
  var n;
  var n1;
  var nStr1;
  var MaxS1=25;
  var MinS1=20;
  var n2;
  var nStr2;
  var MaxS2=50;
  var MinS2=30;
  var n3;
  var nStr3;
  var MaxS3=1000;
  var MinS3=200;


  function VerGrafica(evt, sensorSeleccionado) {
  	var i, tabcontent, tablinks;
  	tabcontent = document.getElementsByClassName("tabcontent");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}
  	tablinks = document.getElementsByClassName("tablinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}
  	document.getElementById(sensorSeleccionado).style.display = "block";
  	evt.currentTarget.className += " active";
}
    document.getElementById("defaultOpen").click();

  var evtSource = new EventSource('sse.php');
  console.log(evtSource.withCredentials);
  console.log(evtSource.readyState);
  console.log(evtSource.url);
  //var eventList = document.querySelector('ul');

  evtSource.onopen = function() {
    console.log("Connection to server opened.");
  };

  evtSource.onmessage = function(e) {
	n = e.data;
	nArr=n.split(' ');
	n1Str=nArr[0];
	n1=parseFloat(n1Str);
	console.log(n1);
	n2Str=nArr[1];
	n2=parseFloat(n2Str);
	console.log(n2);
	n3Str=nArr[2];
	n3=parseFloat(n3Str);
	console.log(n3);
	document.getElementById("n1").innerHTML = n1;
	document.getElementById("n2").innerHTML = n2;
	document.getElementById("n3").innerHTML = n3;

    //eventList.appendChild(newElement);
  };

  evtSource.onerror = function() {
    console.log("EventSource failed.");
  };

  button.onclick = function() {
    console.log('Connection closed');
    evtSource.close();
  };

  // evtSource.addEventListener("ping", function(e) {
  //   var newElement = document.createElement("li");
  //
  //   var obj = JSON.parse(e.data);
  //   newElement.innerHTML = "ping at " + obj.time;
  //   eventList.appendChild(newElement);
  // }, false);


//Crear un tema oscuro para las gráficas

Highcharts.theme = {
    colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
        '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, '#2a2a2b'],
                [1, '#3e3e40']
            ]
        },
        style: {
            fontFamily: '\'Unica One\', sans-serif'
        },
        plotBorderColor: '#606063'
    },
    title: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase',
            fontSize: '20px'
        }
    },
    subtitle: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase'
        }
    },
    xAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        title: {
            style: {
                color: '#A0A0A3'
            }
        }
    },
    yAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        tickWidth: 1,
        title: {
            style: {
                color: '#A0A0A3'
            }
        }
    },
    tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
        style: {
            color: '#F0F0F0'
        }
    },
    plotOptions: {
        series: {
            dataLabels: {
                color: '#F0F0F3',
                style: {
                    fontSize: '13px'
                }
            },
            marker: {
                lineColor: '#333'
            }
        },
        boxplot: {
            fillColor: '#505053'
        },
        candlestick: {
            lineColor: 'white'
        },
        errorbar: {
            color: 'white'
        }
    },
    legend: {
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        itemStyle: {
            color: '#E0E0E3'
        },
        itemHoverStyle: {
            color: '#FFF'
        },
        itemHiddenStyle: {
            color: '#606063'
        },
        title: {
            style: {
                color: '#C0C0C0'
            }
        }
    },
    credits: {
        style: {
            color: '#666'
        }
    },
    labels: {
        style: {
            color: '#707073'
        }
    },
    drilldown: {
        activeAxisLabelStyle: {
            color: '#F0F0F3'
        },
        activeDataLabelStyle: {
            color: '#F0F0F3'
        }
    },
    navigation: {
        buttonOptions: {
            symbolStroke: '#DDDDDD',
            theme: {
                fill: '#505053'
            }
        }
    },
    // scroll charts
    rangeSelector: {
        buttonTheme: {
            fill: '#505053',
            stroke: '#000000',
            style: {
                color: '#CCC'
            },
            states: {
                hover: {
                    fill: '#707073',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                },
                select: {
                    fill: '#000003',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                }
            }
        },
        inputBoxBorderColor: '#505053',
        inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
        },
        labelStyle: {
            color: 'silver'
        }
    },
    navigator: {
        handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
        },
        outlineColor: '#CCC',
        maskFill: 'rgba(255,255,255,0.1)',
        series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
        },
        xAxis: {
            gridLineColor: '#505053'
        }
    },
    scrollbar: {
        barBackgroundColor: '#808083',
        barBorderColor: '#808083',
        buttonArrowColor: '#CCC',
        buttonBackgroundColor: '#606063',
        buttonBorderColor: '#606063',
        rifleColor: '#FFF',
        trackBackgroundColor: '#404043',
        trackBorderColor: '#404043'
    }
};
// Aplicar el tema: activado
Highcharts.setOptions(Highcharts.theme);

//Gráfica 1
Highcharts.chart('container', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
						y = n1
						//console.log(y);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },

    time: {
        useUTC: false
    },

    title: {
        text: 'Valor de sensor 1'
    },

    accessibility: {
        announceNewData: {
            enabled: true,
            minAnnounceInterval: 15000,
            announcementFormatter: function (allSeries, newSeries, newPoint) {
                if (newPoint) {
                    return 'New point added. Value: ' + newPoint.y;
                }
                return false;
            }
        }
    },

    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },

    yAxis: {
        title: {
            text: 'Temperatura °C'
        },
        plotLines: [{
            value: MaxS1,
            width: 2,
            color: 'red'
        },{
            value: MinS1,
            width: 2,
            color: 'blue'
        }],
		softMax: 45,
		softMin: 0
    },

    tooltip: {
        headerFormat: '<b>{series.name}</b><br/>',
        pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
    },

    legend: {
        enabled: false
    },

    exporting: {
        enabled: false
    },
	credits: {
        enabled: false
    },

    series: [{
        name: 'Sensor 1',
        data: (function () {
            // generate an array of data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: n1
                });
            }
            return data;
        }())
    }]
});

//Gráfica 2
Highcharts.chart('container2', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
						y = n2
						//console.log(y);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },

    time: {
        useUTC: false
    },

    title: {
        text: 'Valor de sensor 2'
    },

    accessibility: {
        announceNewData: {
            enabled: true,
            minAnnounceInterval: 15000,
            announcementFormatter: function (allSeries, newSeries, newPoint) {
                if (newPoint) {
                    return 'New point added. Value: ' + newPoint.y;
                }
                return false;
            }
        }
    },

    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },

    yAxis: {
        title: {
            text: 'Humedad (%)'
        },
        plotLines: [{
            value: MaxS2,
            width: 2,
            color: 'red'
        },{
            value: MinS2,
            width: 2,
            color: 'blue'
        }],
		softMax: 45,
		softMin: 0
    },

    tooltip: {
        headerFormat: '<b>{series.name}</b><br/>',
        pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
    },

    legend: {
        enabled: false
    },

    exporting: {
        enabled: false
    },
	credits: {
        enabled: false
    },

    series: [{
        name: 'Sensor 2',
        data: (function () {
            // generate an array of data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: n2
                });
            }
            return data;
        }())
    }]
});

//Gráfica 3
Highcharts.chart('container3', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
						y = n3
						//console.log(y);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },

    time: {
        useUTC: false
    },

    title: {
        text: 'Valor de sensor 3'
    },

    accessibility: {
        announceNewData: {
            enabled: true,
            minAnnounceInterval: 15000,
            announcementFormatter: function (allSeries, newSeries, newPoint) {
                if (newPoint) {
                    return 'New point added. Value: ' + newPoint.y;
                }
                return false;
            }
        }
    },

    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },

    yAxis: {
        title: {
            text: 'Luminosidad (Lumens)'
        },
        plotLines: [{
            value: MaxS3,
            width: 2,
            color: 'red'
        },{
            value: MinS3,
            width: 2,
            color: 'blue'
        }],
		softMax: 1500,
		softMin: 0
    },

    tooltip: {
        headerFormat: '<b>{series.name}</b><br/>',
        pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
    },

    legend: {
        enabled: false
    },

    exporting: {
        enabled: false
    },
	credits: {
        enabled: false
    },

    series: [{
        name: 'Sensor 3',
        data: (function () {
            // generate an array of data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: n3
                });
            }
            return data;
        }())
    }]
});

</script>
