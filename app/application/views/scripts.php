<!-- inject:js -->
<script src="<?php echo base_url('js/d3.min.js')?>"></script>
<script src="<?php echo base_url('js/getmdl-select.min.js')?>"></script>
<script src="<?php echo base_url('js/material.min.js')?>"></script>
<script src="<?php echo base_url('js/nv.d3.min.js')?>"></script>
<script src="<?php echo base_url('js/layout/layout.min.js')?>"></script>
<script src="<?php echo base_url('js/scroll/scroll.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/charts/discreteBarChart.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/charts/linePlusBarChart.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/charts/stackedBarChart.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/employer-form/employer-form.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/line-chart/line-charts-nvd3.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/map/maps.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/pie-chart/pie-charts-nvd3.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/table/table.min.js')?>"></script>
<script src="<?php echo base_url('js/widgets/todo/todo.min.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/../media/css/bootstrap.css">
  <link rel="stylesheet" href="/../media/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/../media/font-awesome/css/font-awesome.css">
  <script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('js/dataTables.bootstrap.min.js')?>"></script>

  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url('js/lenguajeusuario.js')?>"></script>
  <script src="<?php echo base_url('js/sse.js')?>"></script>

<!-- SCRIPT Para iniciar el servicio OneSignal -->
  <script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
    OneSignal.init({
      appId: "bdc5c0a8-4e12-4ed8-ba32-ca4263a610e3",
    });
    });

</script>


  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145830444-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-145830444-2');
</script>


<script type="text/javascript">

window.onload = function() {
  <?php if($_SESSION['msg_body']!=""){ ?>
  Swal.fire({
    type: '<?php echo  $_SESSION['msg_type'];?>',
    title: '<?php echo  $_SESSION['msg_title'];?>',
    text: '<?php echo  $_SESSION['msg_body'];?>',
    footer: '<?php echo  $_SESSION['msg_footer'];?>'
  });

    <?php  $_SESSION['msg_title'] = "";?>
    <?php  $_SESSION['msg_type'] = "";?>
    <?php  $_SESSION['msg_body'] = "";?>
    <?php  $_SESSION['msg_footer'] = "";?>
    <?php } ?>

};

</script>

<script type="text/javascript">
const options = {
  connectTimeout: 1000,
  // Authentication
  clientId: 'client_id_'+ Math.floor((Math.random() * 1000000) + 1),
  username: '<?php echo MQTT_USER; ?>',
  password: '<?php echo MQTT_PASSWORD; ?>',
  keepalive: 60,
  clean: true,
}

// WebSocket connect url
const WebSocket_URL = 'wss://ioticos.org:8094/mqtt';
const client = mqtt.connect(WebSocket_URL, options)

var device_topic = '<?php echo ROOT_TOPIC ."/". $_SESSION['selected_topic']."/" ?>';
client.on('connect', () => {
  console.log('Connect success');

  client.subscribe(device_topic + "data", { qos: 0 }, (error) => {
    if(error){
      console.log("Error at subscribe");
      $("#log").html("Error");
    }else{
      console.log("Subscribe ok");
      $("#log").html("Conectado");
      $("#estadoConexion").toggleClass('btn-danger',false);
      $("#estadoConexion").toggleClass('btn-primary',true);
      $("#iconConexion").toggleClass('fa fa-times',false);
      $("#iconConexion").toggleClass('fa fa-check',true);
    }

  })
})


client.on('message', (topic, message) => {
  console.log('Msg from topic: ', topic, ' ----> ', message.toString());

  if (topic == device_topic+"data"){
    var splitted = message.toString().split(",");

    var temp = splitted[0];
    var hum = splitted[1];
    var lux = splitted[2];
    var co2 = splitted[3];
    var switch1 = splitted[4];
    var switch2 = splitted[5];
    //client.publish(device_topic + 'EnConexión');

    $("#display_hum").html(hum);
    $("#display_temp").html(temp);
    $("#display_lux").html(lux);
    $("#display_co2").html(co2);

    if(switch1 == "1"){
      $("#display_sw1").prop('checked', true);
    }else{
      $("#display_sw1").prop('checked',"");
    }

    if(switch2 == "1"){
      $("#display_sw2").prop('checked', true);
    }else{
      $("#display_sw2").prop('checked',"" );
    }


  }


})

client.on('reconnect', (error) => {
  console.log('reconnecting:', error);
  $("#log").html("Reconectando...");
  $("#estadoConexion").toggleClass('btn-primary',false);
  $("#estadoConexion").toggleClass('btn-danger',false);
  $("#estadoConexion").toggleClass('btn-danger',true);
  $("#iconConexion").toggleClass('fa fa-times',false);
  $("#iconConexion").toggleClass('fa fa-check',false);
  $("#iconConexion").toggleClass('fa fa-times',true);
})

client.on('error', (error) => {
  console.log('Connect Error:', error);
})

//Script que agrega tag del usuario al subscribirse



function sw1_change(){

  if ($('#display_sw1').is(":checked"))
  {
    client.publish(device_topic + 'actions/sw1',"1");
  }else{
    client.publish(device_topic + 'actions/sw1',"0");
  }
}

function sw2_change(){
  if ($('#display_sw2').is(":checked"))
  {
    client.publish(device_topic + 'actions/sw2',"1");
  }else{
    client.publish(device_topic + 'actions/sw2',"0");
  }
}

function slider_change(){
  value = $('#display_slider').val();
  //$("#tempDeseada").html(value+" °C");
  client.publish(device_topic + 'actions/slider',value);
}

</script>
<!-- endinject -->

<style media="screen">
/* The switch - the box around the slider */
.switch {
position: relative;
display: inline-block;
width: 42px;
height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
opacity: 0;
width: 0;
height: 0;
}

/* The slider */
.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 16px;
width: 16px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(16px);
-ms-transform: translateX(16px);
transform: translateX(16px);
}

/* Rounded sliders */
.slider.round {
border-radius: 18px;
}

.slider.round:before {
border-radius: 50%;
}
</style>
