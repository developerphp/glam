<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function index()
	{            
        $datas["login"]=$this->session->userdata('login');
        $datas["selectnav"]="shop";
        $this->load->view('shopView',$datas);
	}
}