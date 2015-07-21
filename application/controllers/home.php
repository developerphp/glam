<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{            
        $datas["login"]=$this->session->userdata('login');
        $datas["selectnav"]="home";
        $this->load->view('drinksView',$datas);
	}
}