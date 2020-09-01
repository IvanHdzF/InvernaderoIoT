<?php

	include("database_connect.php");

	$consulta = "SELECT * FROM ESPtable2";
	$registro = mysqli_query($con,$consulta);

	$tabla = "";

	while($row = mysqli_fetch_array($registro)){
		$cur_sent_bool_1 = $row['SENT_BOOL_1'];
		$cur_sent_bool_2 = $row['SENT_BOOL_2'];
		$cur_sent_bool_3 = $row['SENT_BOOL_3'];


		$editar = '<a \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Activado\" class=\"btn btn-primary\"><i class=\"fa fa-toggle-on \" aria-hidden=\"true\"></i></a>';
		$eliminar = '<a \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Desactivado\" class=\"btn btn-danger\"><i class=\"fa fa-toggle-off \" aria-hidden=\"true\"></i></a>';
		$bool1= ($cur_sent_bool_1 == 1)?  $editar:$eliminar;
		$bool2= ($cur_sent_bool_2 == 1)?  $editar:$eliminar;
		$bool3= ($cur_sent_bool_3 == 1)?  $editar:$eliminar;
		$tabla.='{
				  "id":"'.$row['id'].'",
				  "s1":"'.$row['SENT_NUMBER_1'].'",
				  "s2":"'.$row['SENT_NUMBER_2'].'",
				  "s3":"'.$row['SENT_NUMBER_3'].'",
				  "b1":"'.$row['fecha'].'",
					"b2":"'.$bool1.'",
					"b3":"'.$bool2.'",
				  "acciones":"'.$bool3.'"
				},';
	}

	//eliminamos la coma que sobra
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';

?>
