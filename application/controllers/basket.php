<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basket extends CI_Controller {

	public function add($id)
	{            
        $login=$this->session->userdata('login');
        if ($login==1) {
        	if (is_numeric($id)) {
        		$sql=$this->db->query("select 
    			products.id, products.title, products.price , products.ingredients, 
    			product_categories.id as cid , product_categories.title as category_name
        		from products,product_categories where products.id=".$this->db->escape($id)." and products.maincat=product_categories.id");
        		foreach($sql->result() as $product) {
        			$datas=array(
    					'member_id'=>$this->session->userdata('userid'),
    					'category_id'=>$product->cid,
    					'product_id'=>$product->id,
    					'category_name'=>$product->category_name,
    					'product_name'=>$product->title,
    					'ingredients'=>$product->ingredients,
    					'price'=>$product->price,
    					'created_at'=>date('Y-m-d H:i:s')
    				);
        			if ($this->db->insert('baskets',$datas)) {
        				echo "<script>parent.location.href='".base_url('basket/calendar/'.$this->db->insert_id())."'</script>";
        			}        			
        		}
        	}
        }
        else {
        	echo '<script>alert("Lütfen üye girişi yapınız")</script>';
        }
	}

	public function calendar($id="") {
		$login=$this->session->userdata('login');
		$datas['selectnav']="basket";
		$datas['login']=$login;
        if ($login==1) {
        	if (is_numeric($id)) {
        		$sql=$this->db->query("select * from baskets where member_id=".$this->db->escape($this->session->userdata('userid'))." and id=".$this->db->escape($id)."");
        		foreach($sql->result() as $basket) {
        			$datas["basket"]=$basket;
        			$this->load->view('basket/calendarView',$datas);
        		}
        	}
        }
	}

	public function createcalendar($id="",$month="",$year="",$day="",$adres="",$ben_alicam="") {
		$login=$this->session->userdata('login');
		$datas['selectnav']="basket";
		$datas['login']=$login;
        if ($login==1) {
        	if (is_numeric($id)) {
        		$sql=$this->db->query("select * from baskets where member_id=".$this->db->escape($this->session->userdata('userid'))." and id=".$this->db->escape($id)."");
        		foreach($sql->result() as $basket) {

        			if (strlen($month)==1) { $month="0".$month; }
		            $yasaklar=array();            
		            $sql=$this->db->query("select * from yasak_gunler where tarih like '%".$year."-".$month."-%'");
		            foreach($sql->result() as $yasak) {
		                array_push($yasaklar, $yasak->tarih);
		            }

		            $prefs = array(
		               'start_day'    => 'monday',
		               'yasaklar'     => array(0),
		               'yasak_gunler' => $yasaklar,
		               'month_type'   => 'long',
		               'day_type'     => 'short',
		               'show_next_prev'  => TRUE,
		               'show_other_days' => TRUE,
		               'product_id' =>$id,
		               'language' => $this->lang->line('dil')
		             );

		            
		            $this->load->library('calendar',$prefs);

		            echo $this->calendar->generate($year, $month);

        		}
        	}
        }
	}
}