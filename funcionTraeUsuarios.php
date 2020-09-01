<?php

	include("database_connect.php");

	$consulta = "SELECT * FROM devices_full";
	$registro = mysqli_query($con,$consulta);

	$tabla = "";

	while($row = mysqli_fetch_array($registro)){
		//$cur_sent_bool_1 = $row['SENT_BOOL_1'];
		//$cur_sent_bool_2 = $row['SENT_BOOL_2'];
		//$cur_sent_bool_3 = $row['SENT_BOOL_3'];


		$editar = '<a \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Activado\" class=\"btn btn-primary\"><i class=\"fa fa-toggle-on \" aria-hidden=\"true\"></i></a>';
		$eliminar = '<a \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Desactivado\" class=\"btn btn-danger\"><i class=\"fa fa-toggle-off \" aria-hidden=\"true\"></i></a>';
		//$bool1= ($cur_sent_bool_1 == 1)?  $editar:$eliminar;
		//$bool2= ($cur_sent_bool_2 == 1)?  $editar:$eliminar;
		//$bool3= ($cur_sent_bool_3 == 1)?  $editar:$eliminar;
		$fecha=new DateTime($row['data_date'],new DateTimeZone('UTC'));
		$fecha->setTimezone(new DateTimeZone('America/Hermosillo'));
		$fechaStr = $fecha->format('Y-m-d H:i:s');



		$tabla.='{
				  "id":"'.$row['data_id'].'",
				  "s1":"'.$row['data_temp'].'",
				  "s2":"'.$row['data_hum'].'",
				  "s3":"'.$row['data_lux'].'",
				  "b1":"'.$row['data_CO2'].'",
					"b2":"'.$row['data_CO2'].'",
					"b3":"'.$row['data_device_sn'].'",
				  "acciones":"'.$fechaStr.'"
				},';
	}

	//eliminamos la coma que sobra
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';

?>
