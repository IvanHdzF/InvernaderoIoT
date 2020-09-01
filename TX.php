
<?php
/*This file should receive a link somethong like this: http://noobix.000webhostapp.com/TX.php?unit=1&b1=1
If you paste that link to your browser, it should update b1 value with this TX.php file. Read more details below.
The ESP will send a link like the one above but with more than just b1. It will have b1, b2, etc...

http://localhost/TX.php?id=99999&pw=12345&un=1&n1=54
*/

//We loop through and grab variables from the received the URL
foreach($_REQUEST as $key => $value)  //Save the received value to the hey variable. Save each cahracter after the "&"
{
	//Now we detect if we recheive the id, the password, unit, or a value to update
if($key =="id"){
$unit = $value;
$update_number = $value;

}
if($key =="pw"){
$pass = $value;
}

if($key =="n1"){
$sent_nr_1 = $value;
echo " ENTRO $sent_nr_1 ";
}

if($key =="n2"){
$sent_nr_2 = $value;
echo " ENTRO $sent_nr_2 ";
}

if($key =="n3"){
$sent_nr_3 = $value;
echo " ENTRO $sent_nr_3 ";
}




else if($update_number == 2)
{

}
else if($update_number == 3)
{

}
else if($update_number == 4)
{
	if($key =="n4"){
	$sent_nr_4 = $value;
	}
}

else if($update_number == 5)
	{
	if($key =="b6"){
	$sent_bool_1 = $value;
	}
	if($key =="b7"){
	$sent_bool_2 = $value;
	}
	if($key =="b8"){
	$sent_bool_3 = $value;
	}
}
}//End of foreach


include("database_connect.php"); 	//We include the database_connect.php which has the data for the connection to the database

// Check  the connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Seleccionamos la ultima fila de la tabla
//$result = mysqli_query($con,"SELECT * FROM `ESPtable2` WHERE id=(SELECT MAX(id) FROM `ESPtable2`)");//table select

//Agregamos los valores a la base

		mysqli_query($con,"INSERT INTO `ESPtable2` (`id`, `PASSWORD`, `SENT_NUMBER_1`, `SENT_NUMBER_2`, `SENT_NUMBER_3`) VALUES (NULL,12345, $sent_nr_1, $sent_nr_2, $sent_nr_3)");
		echo " ENTRARON";




//In case that you need the time from the internet, use this line
date_default_timezone_set('UTC');
$t1 = date("gi"); 	//This will return 1:23 as 123

//Get all the values form the table on the database
$result = mysqli_query($con,"SELECT * FROM ESPtable2");	//table select is ESPtable2, must be the same on yor database





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

//Filtra los ultimos 10 valores y le aplica los valores minimos y maximos permitidos dentro de cada variable
$filtrado = mysqli_query($con,"SELECT * FROM (
   SELECT * FROM ESPtable2 ORDER BY id DESC LIMIT 10
)Var1 WHERE `SENT_NUMBER_1` BETWEEN 15 AND 25");	//Selecciona los ultimos valores de la tabla

if ($filtrado->num_rows===0){
	send_message('Nueva notificación','Temperatura fuera de rango');
}


?>
