<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insertdata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//cargamos el modelo
		$this->load->model('Insertdata_model');
	}

  public function insert(){

		//nos llega la pass que nos pasa el dispositivo,
    $password = strip_tags($this->input->post('idp'));

		//si la pass coincide entonces si le permitimos al dispositivo insertar una fila en la tabla data
		if ($password == INSERT_DATA_PASSWORD){

			//recibimos los datos que nos envía el dispositivo, mediante post...
			$device_sn = strip_tags($this->input->post('sn'));
			$temp = strip_tags($this->input->post('temp'));
			$hum = strip_tags($this->input->post('hum'));
			$lux = strip_tags($this->input->post('lux'));

			$flag = ($temp>25)? 1:0;

			$result = $this->Insertdata_model->insert($device_sn, $temp, $hum,$lux,$flag);

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
			/*
			$filtrado = mysqli_query($con,"SELECT * FROM (
			   SELECT * FROM ESPtable2 ORDER BY id DESC LIMIT 10
			)Var1 WHERE `SENT_NUMBER_1` BETWEEN 15 AND 25");	//Selecciona los ultimos valores de la tabla

			if ($filtrado->num_rows===0){
				send_message('Nueva notificación','Temperatura fuera de rango');
			}
			*/




		}else{
			//si la clave no coincide...
			echo "access denied";
		}

  }

}
