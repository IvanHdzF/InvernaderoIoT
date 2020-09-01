<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sse_model extends CI_Model
{
  //recuperamos los históricos del dispo seleccionado
  public function get_data($device_id)
  {
    $this->db->SELECT();
    $this->db->FROM('devices_full');
    $this->db->WHERE('device_id',$device_id);
    $result =	$this->db->get()->result_array();
    return $result;
  }
}
