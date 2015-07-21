<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drinks extends CI_Controller {

	public function index()
	{            
        $datas["login"]=$this->session->userdata('login');
		$datas["selectnav"]="drinks";
        $this->load->view('drinksView',$datas);
	}

	public function detail($id) {
		$datas["login"]=$this->session->userdata('login');
		$datas["selectnav"]="drinks";
		if (is_numeric($id)) {
			$sql=$this->db->query("
				select 
				products.id, products.title,products.catid,products.ingredients,products.content,products.image,
				product_categories.id as cid,product_categories.title as category_name
				from 
				products,product_categories
				where products.id=".$id." and products.catid=product_categories.id");
			foreach($sql->result() as $product) {
				$datas["product"]=$product;
				$this->load->view('products/drinkDetailView',$datas);

			}
		}        
	}
}