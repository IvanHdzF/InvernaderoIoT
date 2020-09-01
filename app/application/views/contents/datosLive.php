<main class="mdl-layout__content">

  <div class="mdl-grid mdl-grid--no-spacing dashboard">

    <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">


 </script>
 <style>
 body {
   color: white;
 }
 select{
     margin:40px;
     background: rgba(0,0,0,0.3);
     color:#fff;
     text-shadow:0 1px 0 rgba(0,0,0,0.4);
 }
 button{
     margin:40px;
     background: rgba(0,0,0,0.3);
     color:#fff;
 }
 div.dt-button-info{position:fixed;top:50%;left:50%;width:400px;margin-top:-100px;margin-left:-200px;background-color:black;border:2px solid #111;box-shadow:3px 3px 8px rgba(0,0,0,0.3);border-radius:3px;text-align:center;z-index:21}div.dt-button-info h2{padding:0.5em;margin:0;font-weight:normal;border-bottom:1px solid #ddd;background-color:black}div.dt-button-info>div{padding:1em}

 .humidity .mdl-card__supporting-text .weather-humidity{font-family:Roboto,Helvetica,Arial,sans-serif;font-size:100px;line-height:1;color:rgba(255,255,255,.9)}.humidity .mdl-card__supporting-text .weather-humidity sup{position:relative;top:13px}.humidity .mdl-card__supporting-text .weather-description{font-size:18px;position:relative;color:#fff}.humidity .mdl-card__supporting-text .humidity-description:before{width:35px;
   position:absolute;right:150px;content:url(../images/cloudy_and_snow.svg)}.humidity .mdl-card__title .mdl-card__subtitle-text{font-size:16px}.humidity .mdl-card__title .mdl-card__subtitle-text .material-icons{font-size:16px;top:2px;position:relative}.employer-form{padding:0;width:670px;background-color:#444;margin:16px auto;height:auto}
 .humidity .mdl-card__supporting-text{color:rgba(255,255,255,1);background:url(images/humedad.jpg) center center no-repeat;background-size:cover;text-align:right;padding-top:38px;text-shadow:4px 4px 4px rgba(0,0,0,.4)}

 .luminosidad .mdl-card__supporting-text .weather-luminosidad{font-family:Roboto,Helvetica,Arial,sans-serif;font-size:100px;line-height:1;color:rgba(255,255,255,.9)}.luminosidad .mdl-card__supporting-text .weather-luminosidad sup{position:relative;top:13px}.luminosidad .mdl-card__supporting-text .weather-description{font-size:18px;position:relative;color:#fff}.luminosidad .mdl-card__supporting-text .luminosidad-description:before{width:35px;
   position:absolute;right:150px;content:url(../images/cloudy_and_snow.svg)}.luminosidad .mdl-card__title .mdl-card__subtitle-text{font-size:16px}.luminosidad .mdl-card__title .mdl-card__subtitle-text .material-icons{font-size:16px;top:2px;position:relative}.employer-form{padding:0;width:670px;background-color:#444;margin:16px auto;height:auto}
 .luminosidad .mdl-card__supporting-text{color:rgba(255,255,255,1);background:url(images/luminosidad.jpg) center center no-repeat;background-size:cover;text-align:right;padding-top:38px;text-shadow:4px 4px 4px rgba(0,0,0,.4)}

 .co2 .mdl-card__supporting-text .weather-co2{font-family:Roboto,Helvetica,Arial,sans-serif;font-size:100px;line-height:1;color:rgba(255,255,255,.9)}.co2 .mdl-card__supporting-text .weather-co2 sup{position:relative;top:13px}.co2 .mdl-card__supporting-text .weather-description{font-size:18px;position:relative;color:#fff}.co2 .mdl-card__supporting-text .co2-description:before{width:35px;
   position:absolute;right:150px;content:url(../images/cloudy_and_snow.svg)}.co2 .mdl-card__title .mdl-card__subtitle-text{font-size:16px}.co2 .mdl-card__title .mdl-card__subtitle-text .material-icons{font-size:16px;top:2px;position:relative}.employer-form{padding:0;width:670px;background-color:#444;margin:16px auto;height:auto}
 .co2 .mdl-card__supporting-text{color:rgba(255,255,255,1);background:url(images/co2.jpg) center center no-repeat;background-size:cover;text-align:right;padding-top:38px;text-shadow:4px 4px 4px rgba(0,0,0,.4)}

.weather-description:before{width:35px;position:absolute;right:150px;content:url(images/info.svg)}
 </style>
 <div class="mdl-card__supporting-text">
     <div class="mdl-grid">

       </div>
   </div>

<script>
window.onload = function() {

      const sliderInput = document.getElementById('display_slider');//CHECAR ESTO
      sliderInput.addEventListener('input', function() {
        value = $('#display_slider').val();
        $("#tempDeseada").html(value+" °C");
        MaxS1=parseInt(value)+5;
        MinS1=parseInt(value)-5;
      }
      );
}


</script>

      <!-- TEMPERATURE -->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp weather">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Temperatura (°C)</h2>

            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <i class="material-icons">room</i>
              Empalme, Sonora
            </div>
          </div>
          <div class="mdl-card__supporting-text mdl-card--expand">
            <p id="display_temp2" class="weather-temperature">--<sup>&deg;</sup></p>

            <p id= "TempEnRango" class="weather-description">
              Invernadero
            </p>
          </div>
        </div>
      </div>
      <!-- HUM -->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp humidity">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Humedad Relativa (%)</h2>

            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <i class="material-icons">room</i>
              Empalme, Sonora
            </div>
          </div>
          <div class="mdl-card__supporting-text mdl-card--expand">
            <p id="display_hum2" class="weather-humidity">--</p>

            <p id="HumEnRango" class="weather-description">
              Invernadero
            </p>
          </div>
        </div>
      </div>

      <!-- LUX -->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp luminosidad">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Luminosidad (lx)</h2>

            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <i class="material-icons">room</i>
              Empalme, Sonora
            </div>
          </div>
          <div class="mdl-card__supporting-text mdl-card--expand">
            <p id="display_lux2" class="weather-luminosidad">--</p>

            <p id="LuxEnRango" class="weather-description">
              Invernadero
            </p>
          </div>
        </div>
      </div>

      <!-- CO2 -->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp co2">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Concentración de CO2 (ppm)</h2>

            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <i class="material-icons">room</i>
              Empalme, Sonora
            </div>
          </div>
          <div class="mdl-card__supporting-text mdl-card--expand">
            <p id="display_co2" class="weather-co2">--</p>
            <p id="co2EnRango" class="weather-description">
              Invernadero
            </p>

          </div>
        </div>
      </div>

      <!-- Conexión a MQTT-->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp trending">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Estado de conexión a MQTT</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <ul class="mdl-list">

              <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content list__item-text" id="log" >Espere...</span>
                    <span class="mdl-list__item-secondary-content list__item-text" >
                      <button id= "estadoConexion" data-toggle="tooltip"  title="Conexión" class="btn btn-danger"><i id="iconConexion" class="fa fa-cross" aria-hidden="true"></i></button>
                    </span>
                </li>
                <li class="mdl-list__item list__item--border-top">
                    <span class="mdl-list__item-primary-content list__item-text">Use actuadores hasta que conecte</span>
                  </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Trending widget-->
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp trending">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Actuadores</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <ul class="mdl-list">

              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content list__item-text">Regar</span>
                <span class="mdl-list__item-secondary-content">


                  <!-- SWITCH-->
                  <label class="switch">
                    <input onchange="sw1_change()" type="checkbox" id="display_sw1">
                    <span class="slider round"></span>
                  </label>

                </span>
              </li>

              <li class="mdl-list__item list__item--border-top">

                <span class="mdl-list__item-primary-content list__item-text"> Paro de Emergencia</span>
                <span class="mdl-list__item-secondary-content">

                  <!-- SWITCH-->
                  <label class="switch">
                    <input onchange="sw2_change()" type="checkbox" id="display_sw2">
                    <span class="slider round"></span>
                  </label>

                </span>
              </li>

              <li class="mdl-list__item list__item--border-top">

                <span class="mdl-list__item-primary-content list__item-text">Temperatura</span>
                <span id="tempDeseada">25 °C</span>
                <span class="mdl-list__item-secondary-content">

                  <input onchange="slider_change()" id="display_slider" class="mdl-slider mdl-js-slider slider--colored-light-blue" type="range" min="20" max="35" value="25" tabindex="0">

                </span>
              </li>


            </ul>
          </div>
        </div>
      </div>
      <!-- Cotoneaster card-->
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
      <ul class="nav nav-tabs ">
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tab" href="#S1">Temperatura</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#S2">Humedad</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#S3">Luz</a>
          </li>
      </ul>

<div class="tab-content flex-column flex-sm-row">
      <div id="S1" class="tab-pane container active">
        <figure class="highcharts-figure">
          <div id="container"></div>
          <p class="highcharts-description">
              Ultimos valores leídos por el sensor de temperatura en los ultimos 20 segundos.
          </p>
      </figure>
      </div>

      <div id="S2" class="tab-pane container fade">
      <figure class="highcharts-figure">
          <div id="container2"></div>
          <p class="highcharts-description">
              Ultimos valores leídos por el sensor de humedad en los ultimos 20 segundos.
          </p>
      </figure>
      </div>

      <div id="S3" class="tab-pane container fade">
      <figure class="highcharts-figure">
          <div id="container3"></div>
          <p class="highcharts-description">
              Ultimos valores leídos por el sensor de luz en los ultimos 20 segundos.
          </p>
      </figure>
      </div>
    </div>
  </div>


    <script>

    var n;
    var n1;//temperatura
    var nStr1;
    var MaxS1=25;
    var MinS1=20;
    var rango1;
    var n2;//humedad
    var nStr2;
    var MaxS2=70;
    var MinS2=55;
    var rango2;
    var n3;//luz
    var nStr3;
    var MaxS3=1000;
    var MinS3=200;
    var rango3;
    var n4;//co2
    var nStr4;
    var MaxS4=600;
    var MinS4=400;
    var rango4;
    var n5;//pH
    var nStr5;
    var MaxS5=6.5;
    var MinS5=5;
    var rango5;

    var source = new SSE('/../sse.php',{headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                           payload: 'user=<?php echo $user_device ?>',
                           method: 'POST'});

    //var evtSource = new EventSource('/../sse.php');
    //console.log(evtSource.withCredentials);
    //console.log(evtSource.readyState);
    //console.log(evtSource.url);
    /*
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
    document.getElementById("display_temp").innerHTML = n1+"°C";
    document.getElementById("display_hum").innerHTML = n2;
    rango1= (MaxS1>=n1 && n1>=MinS1) ? "En rango" : "Fuera de rango";
    rango2= (MaxS2>=n2 && n2>=MinS2) ? "En rango" : "Fuera de rango";
    document.getElementById("TempEnRango").innerHTML = ;
    document.getElementById("HumEnRango").innerHTML = rango2;

      //eventList.appendChild(newElement);
    };

    evtSource.onerror = function() {
      console.log("EventSource failed.");
    };
*/
source.addEventListener('message', function(e) {
  // Assuming we receive JSON-encoded data payloads:
  n = e.data;
  console.log(n);
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
  document.getElementById("display_temp2").innerHTML = n1Str;
  document.getElementById("display_hum2").innerHTML = n2Str;
  document.getElementById("display_lux2").innerHTML = n3Str;
  rango1= (MaxS1>=n1 && n1>=MinS1) ? "En rango" : "Fuera de rango";
  rango2= (MaxS2>=n2 && n2>=MinS2) ? "En rango" : "Fuera de rango";
  rango3= (MaxS3>=n3 && n3>=MinS3) ? "En rango" : "Fuera de rango";
  document.getElementById("TempEnRango").innerHTML = rango1;
  document.getElementById("HumEnRango").innerHTML = rango2;
  document.getElementById("LuxEnRango").innerHTML = rango3;
});
source.stream();

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
            text: 'Valor de temperatura (°C)'
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
            name: 'Sensor de temperatura',
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
        }],

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
            text: 'Valor de H.R. (%)'
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
            name: 'Sensor de humedad',
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
            text: 'Valor de luminosidad (lx)'
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
            name: 'Sensor de luz',
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

       <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
       	<h2> Tabla de registros </h2>
       		<table id="datos" class="table table-bordered" cellspacing="0" width="100%">
       				<thead>
       				<tr>
       						<th>N°Medición</th>
       						<th>Temperatura</th>
       						<th>Humedad</th>
       						<th>Luz</th>
       						<th>pH</th>
       						<th>CO2</th>
       						<th>Dispositivo</th>
       						<th>Fecha</th>
       				</tr>
       				</thead>
       				<tbody>
       				</tbody>
       				<tfoot>
       				<tr>
                <th>N°Medición</th>
                <th>Temperatura</th>
                <th>Humedad</th>
                <th>Luz</th>
                <th>pH</th>
                <th>CO2</th>
                <th>Dispositivo</th>
                <th>Fecha</th>
       				</tr>
       				</tfoot>
       		</table>
       </div>
