<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basket extends CI_Controller {

	public function index() {
		$login=$this->session->userdata('login');
		$datas['selectnav']="basket";
		$datas['login']=$login;
        if ($login==1) {
        	$this->load->view('basket/checkoutView',$datas);
        }
        else {
        	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        	?><script>location.href='<?php echo base_url("register/login/?url=".$actual_link) ?>'</script><?php
        }
	}

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
        else {
        	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        	?><script>location.href='<?php echo base_url("register/login/?url=".$actual_link) ?>'</script><?php
        }
	}

	public function delete($id) {
		$login=$this->session->userdata('login');
		$datas['selectnav']="basket";
		$datas['login']=$login;
        if ($login==1) {
        	if (is_numeric($id)) {
        		$sql=$this->db->query("select * from baskets where member_id=".$this->db->escape($this->session->userdata('userid'))." and id=".$this->db->escape($id)."");
        		foreach($sql->result() as $basket) {
        			$this->db->where('id',$id);
        			if ($this->db->delete('baskets')) {
        				echo "<script>parent.history.go(0)</script>";
        			}
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

	public function orderplanForm_do() {
		$login=$this->session->userdata('login');		
		$datas['login']=$login;
        if ($login==1) {

        	$id=$this->input->post('basket_id');
        	$ben_alicam = $this->input->post('ben_alicam');
        	$cleanse_date = $this->input->post('cleanse_date');
        	$cleanse_date_view = $this->input->post('cleanse_date_view');
        	$count_person = $this->input->post('count_person');
        	$count_day = $this->input->post('count_day');
        	$teslimat_saati = $this->input->post('teslimat_saati');
        	$address1 = $this->input->post('address1');
        	$address2 = $this->input->post('address2');

        	if (is_numeric($id)) {
        		$sql=$this->db->query("select * from baskets where member_id=".$this->db->escape($this->session->userdata('userid'))." and id=".$this->db->escape($id)."");
        		foreach($sql->result() as $basket) {

        			if ($ben_alicam=='on') { $ben_alicam=1; } else { $ben_alicam=0; }
        			
        			if (strlen($cleanse_date)>0) {
        				$d=explode('-',$cleanse_date);
        				if (strlen($d[2])==1) {
        					$cleanse_date=$d[0].'-'.$d[1].'-0'.$d[2];
        				}
        			}
        			else {
    					echo '<div class="alert_error">Lütfen seçtiğiniz tarihi kontrol ediniz.</div>'; exit();
        			}

        			if (!$this->is_date($cleanse_date)) {
        				echo '<div class="alert_error">Lütfen seçtiğiniz tarihi kontrol ediniz.</div>'; exit();
        			}

        			if ($cleanse_date<=date('Y-m-d')) {
        				echo '<div class="alert_error">Bugüne vaya geçmiş tarih seçimi yapamazsınız.</div>'; exit();	
        			}

        			if (!is_numeric($count_person)) {
        				echo '<div class="alert_error">Lütfen kişi sayısını seçiniz.</div>'; exit();	
        			}

        			if (!is_numeric($count_day)) {
        				echo '<div class="alert_error">Lütfen gün sayısını seçiniz.</div>'; exit();	
        			}

        			if ($ben_alicam==0) {
        				if (strlen($teslimat_saati)==0) { 
        					echo '<div class="alert_error">Lütfen teslimat zamanını seçiniz.</div>'; exit();	
        				}
        			}        			

        			if (!is_numeric($address1)) {
        				echo '<div class="alert_error">Lütfen teslimat adresinizi seçiniz.</div>'; exit();	
        			}

        			if (!is_numeric($address2)) {
        				echo '<div class="alert_error">Lütfen fatura adresinizi seçiniz.</div>'; exit();	
        			}

        			$datas=array(
        				'ben_alicam'=>$ben_alicam,
        				'delivery_date' => $cleanse_date,
        				'delivery_date_view' => $cleanse_date_view,
        				'delivery_date_time' => $teslimat_saati,
        				'count_person' => $count_person,
        				'count_day' => $count_day,
        				'delivery_address_id' => $address1,
        				'billing_address_id' => $address2,
        				'section' => 1
    				);

        			$this->db->where('id',$basket->id);
    				if ($this->db->update('baskets',$datas)) {
    					?>
    					<script>
    						parent.location.href='<?php echo base_url("basket") ?>';
    					</script>
    					<?php
    				}
        		}
        	}
        } else {
        	echo '<div class="alert_error">Lütfen üye girişi yapınız</div>';
        }
	}

	public function is_date($str, $formats=NULL)
	{
		if (!$formats)
		{
			$formats = array(
				'Y-m-d',
				'd-m-Y'
			);
		}
		$formats = (array)$formats;

		$is_date = FALSE;
		try
		{
			foreach ($formats as $key => $format)
			{
				$date = DateTime::createFromFormat($format, $str);

				if ($date!==FALSE && $date->format($format)===$str)
				{
					$is_date = TRUE;
					break;
				}
			}
		}
		catch (Exception $exc)
		{

		}

		return $is_date;
	}
}