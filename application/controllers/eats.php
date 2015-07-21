<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eats extends CI_Controller {

	public function index()
	{            
        $datas["login"]=$this->session->userdata('login');
		$datas["selectnav"]="eats";
        $this->load->view('eatsView',$datas);
	}

	public function detail($id) {
		$datas["login"]=$this->session->userdata('login');
		$datas["selectnav"]="eats";
		if (is_numeric($id)) {
			$sql=$this->db->query("
				select 
				products.id, products.title,products.catid,products.ingredients,products.content,products.image,products.price,products.detail_description,products.banner,
				products.content2,products.benefits,
				product_categories.id as cid,product_categories.title as category_name, product_categories.description
				from 
				products,product_categories
				where products.id=".$id." and products.catid=product_categories.id");
			foreach($sql->result() as $product) {
				$datas["product"]=$product;
				$this->load->view('products/eatDetailView',$datas);

			}
		}        
	}
}