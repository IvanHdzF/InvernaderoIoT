<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//si no estas logueado... FUERA!!!
		if(!isset($_SESSION['user_id'])){
			redirect(base_url('login'), 'refresh');
		}
	}

  public function index()
  {
    $DC = $this->session->sess_destroy();
		redirect(base_url('/login') , 'refresh');
  }


}
