<?php
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream");
include("database_connect.php");
$n1=0;
$n2=0;
$n3=0;
while (1) {
// 1 is always true, so repeat the while loop forever (aka event-loop)

  $curDate = date(DATE_ISO8601);
  $result = mysqli_query($con,"SELECT * FROM `devices_full` WHERE id=(SELECT MAX(id) FROM `devices_full`)");//table select
  $last_id = mysqli_insert_id($con);
  echo "event: ping\n",
       'data: {"time": "' . $curDate . '"}', "\n\n";


  // Send a simple message at random intervals.
 // $counter--;
  $row = mysqli_fetch_array($result);
    //$numeroDatos = mysqli_num_rows($result);//row count
    $result = mysqli_query($con,"SELECT * FROM `devices_full` WHERE id=(SELECT MAX(id) FROM `devices_full`)");//table select
    $N1=$row['data_temp'];
    $N2=$row['data_hum'];
    $N3=$row['data_lux'];
    //echo 'Ex:' . $N1." ".$N2." ".$N3, "\n\n";
    //echo 'ex:' . $n1." ".$n2." ".$N3, "\n\n";
    if ($N1!=$n1||$N2!=$n2||$N3!=$n3) {
      echo 'data:' . $N1." ".$N2." ".$N3, "\n\n";
      echo 'Ex:' . $N1." ".$N2." ".$N3, "\n\n";
      $n1=$N1;
      $n2=$N2;
      $n3=$N3;
    }


  // flush the output buffer and send echoed messages to the browser

  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  flush();

  // break the loop if the client aborted the connection (closed the page)

  if ( connection_aborted() ) break;

  // sleep for 1 second before running the loop again

  sleep(1);

}
