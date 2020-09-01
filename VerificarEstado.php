
<?php
include("database_connect.php"); 	//We include the database_connect.php which has the data for the connection to the database

// Check  the connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


//mysqli_query($con,"UPDATE ESPtable2 SET SENT_BOOL_1 = 1 WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");

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
$filtrado = mysqli_query($con,"SELECT * FROM (
   SELECT * FROM data ORDER BY data_id DESC LIMIT 10
)Var1 WHERE `data_temp` BETWEEN 15 AND 25");	//Selecciona los ultimos valores de la tabla

if ($filtrado->num_rows===0){
  send_message('Nueva notificación','Temperatura fuera de rango');
}



?>
