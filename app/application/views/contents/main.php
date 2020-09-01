<main class="mdl-layout__content">

  <div class="mdl-grid mdl-grid--no-spacing dashboard">

    <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">



<script>
   OneSignal.push(function() {
       OneSignal.on('subscriptionChange', function(isSubscribed) {
           if (isSubscribed === true) {
               console.log('The user subscription state is now:', isSubscribed);
               OneSignal.sendTags({
                   "user_email": "<?php echo $user_email?>",
               }).then(function(tagsSent) {
                   // Callback called when tags have finished sending
                   console.log(tagsSent);
               });
           }
       });
   });
   function Subscribirse(){
     // OneSignal.push(["registerForPushNotifications"]);
                //OneSignal.registerForPushNotifications();
                OneSignal.setSubscription(true);
                event.preventDefault();
                console.log('Subscrito')
   }
   function Desubscribirse(){
     OneSignal.setSubscription(false);
     event.preventDefault();
     console.log('Desubscrito')

   }

   window.onload = function() {

         const sliderInput = document.getElementById('display_slider');//CHECAR ESTO
         sliderInput.addEventListener('input', function() {
           value = $('#display_slider').val();
           $("#tempDeseada").html(value+" °C");
         });
       }

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
     margin:0px;
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


 </style>
 <div class="mdl-card__supporting-text">
     <div class="mdl-grid">


       <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
         <h3 class="text-color--smooth-gray">Notificaciones</h3>

         <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal pull-left" data-upgraded=",MaterialButton,MaterialRipple" onclick="Subscribirse();">
           <i class="material-icons">add</i>
           Subscribirse
           <span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 262.161px; height: 262.161px; transform: translate(-50%, -50%) translate(67px, 18px);"></span></span></button>
           <button formaction="<?php echo base_url('devices/Desubscribirse') ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal pull-right" data-upgraded=",MaterialButton,MaterialRipple" onclick="Desubscribirse()">
             <i class="material-icons">remove</i>
             Desubscribirse
             <span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 262.161px; height: 262.161px; transform: translate(-50%, -50%) translate(67px, 18px);"></span></span></button>

         </div>


       </div>
   </div>



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
            <p id="display_temp" class="weather-temperature">--<sup>&deg;</sup></p>


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
            <p id="display_hum" class="weather-humidity">--</p>
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
            <p id="display_lux" class="weather-luminosidad">--</p>

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

                <span class="mdl-list__item-primary-content list__item-text">Paro de emergencia</span>
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

                  <input onchange="slider_change()" id="display_slider" class="mdl-slider mdl-js-slider slider--colored-light-blue" type="range" min="20" max="35" value="25" tabindex="0" step="1">

                </span>
              </li>


            </ul>
          </div>
        </div>
      </div>
      <!-- Cotoneaster card-->

      <!-- Line chart-->
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp line-chart">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Temperatura</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <canvas id="my_chart" width="300" height="300"  ></canvas>
          </div>
        </div>
      </div>
      <!-- Table-->


      <!-- Line chart2-->
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp line-chart">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Humedad relativa</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <canvas id="my_chart2" width="300" height="300"  ></canvas>
          </div>
        </div>
      </div>
      <!-- Table-->

      <!-- Line chart2-->
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp line-chart">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Luminosidad</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <canvas id="my_chart3" width="300" height="300"  ></canvas>
          </div>
        </div>
      </div>
      <!-- Table-->

    </div>

    </div>

</main>

<script>
var ctx = document.getElementById('my_chart').getContext('2d');
var ctx2 = document.getElementById('my_chart2').getContext('2d');
var ctx3 = document.getElementById('my_chart3').getContext('2d');


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $dates ?>],
        datasets: [{
            label: '° C',
            data: [<?php echo $temps ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: [<?php echo $dates ?>],
        datasets: [{
            label: '%',
            data: [<?php echo $hums ?>],
            backgroundColor: [
                'rgba(30, 170, 132, 0.2)',
            ],
            borderColor: [
                'rgba(30, 170, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: [<?php echo $dates ?>],
        datasets: [{
            label: 'lx',
            data: [<?php echo $luxs ?>],
            backgroundColor: [
                'rgba(0, 0, 255, 0.2)',
            ],
            borderColor: [
                'rgba(0, 0, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
