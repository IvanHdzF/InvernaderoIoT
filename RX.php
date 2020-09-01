
<?php
$n1;
$n2;
$n3;
$DT;
$alarma;
$alarma=$_POST["rep"];


include("database_connect.php"); 	//We include the database_connect.php which has the data for the connection to the database

// Check  the connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Seleccionamos la ultima fila de la tabla
//$result = mysqli_query($con,"SELECT * FROM `ESPtable2` WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");//table select







//Get all the values form the table on the database
$result = mysqli_query($con,"SELECT * FROM `ESPtable2` WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");//table select

//Loop through the table and filter out data for this unit id equal to the one taht we've received.
while($row = mysqli_fetch_array($result)) {
$n1=$row['SENT_NUMBER_1'];
$n2=$row['SENT_NUMBER_2'];
$n3=$row['SENT_NUMBER_3'];
$DT=$row['fecha'];

}// End of the while loop
echo "#$n1#$n2#$n3#$DT#";
mysqli_query($con,"UPDATE ESPtable2 SET SENT_BOOL_1 = 1 WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");	

function send_message($titulo,$mensaje){
					$message = $mensaje;
					$headings=array(
	            "en" => "$titulo");
	        $user_id = "1";
	        $content = array(
	            "en" => "$message"
	        );

	        $fields = array(
	            'app_id' => "bdc5c0a8-4e12-4ed8-ba32-ca4263a610e3",
							'filters' => array(array("field" => "tag", "key" => "user_email", "relation" => "=", "value" => "ivan083198@hotmail.com")),
							'headings' => $headings,
	            'contents' => $content,
							'url' => 'https://arduinointerfaz.000webhostapp.com/app/main'
	        );

	        $fields = json_encode($fields);
	        print("\nJSON sent:\n");
	        print($fields);

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
	            'Authorization: Basic ZGNmZTBlOGQtNWNjMi00NTA2LWJmZWQtM2Y0M2NlNzU2MmQ3'));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        curl_setopt($ch, CURLOPT_HEADER, FALSE);
	        curl_setopt($ch, CURLOPT_POST, TRUE);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	        $response = curl_exec($ch);
	        curl_close($ch);
}

//Filtra los ultimos 10 valores y le aplica los valores minimos y maximos permitidos dentro de cada variable;	//Selecciona los ultimos valores de la tabla

if ($alarma>=5){
	//echo $alarma;
	//send_message('Nueva notificación','Sensores desconectados');
}


?>
