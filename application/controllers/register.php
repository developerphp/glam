<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{            
        $datas["login"]=$this->session->userdata('login');
        $this->load->view('eatsView',$datas);
	}
	
	echo "cem";
}