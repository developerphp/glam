<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function edit()
	{   
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            
            $userid=$this->session->userdata('userid');
            
            if (is_numeric($userid)) {
                $sql=$this->db->query("select * from users where id=".$this->db->escape($userid)."");
                foreach($sql->result() as $profile) {
                    $datas['profile_menu']='dashboard';
                    $datas['ptitle']="üyelik bilgilerim";
                    $datas['profile']=$profile;
					$datas["selectnav"]="edit";
                    $this->load->view('profile/profileView',$datas);
                }                    
            }                
        }
        else {
            $this->load->view('homeView',$datas);
        }
	}

    public function orders()
    {   
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            
            $userid=$this->session->userdata('userid');
            
            if (is_numeric($userid)) {      
                $datas['userid']=$userid;
				$datas["selectnav"]="orders";
                $this->load->view('profile/ordersView',$datas);   
            }                
        }
        else {
            $this->load->view('home_view',$datas);
        }
    }

    public function address()
    {   
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            
            $userid=$this->session->userdata('userid');
            
            if (is_numeric($userid)) {      
                $datas['userid']=$userid;
				$datas["selectnav"]="address";
                $this->load->view('profile/addressView',$datas);   
            }                
        }
        else {
            $this->load->view('home_view',$datas);
        }
    }

    public function addressEdit($id="")
    {   
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            
            $userid=$this->session->userdata('userid');
            
            if (is_numeric($userid)) {      
                $datas['userid']=$userid;
                if (is_numeric($id)) {
                    $sql=$this->db->query("select * from address where user_id=".$userid." and id=".$id."");
                    foreach($sql->result() as $address) {
                        $datas['address']=$address;
						$datas["selectnav"]="address";
                        $this->load->view('profile/editAddressView',$datas);   
                    }
                }                
            }                
        }
        else {
            $this->load->view('home_view',$datas);
        }
    }

    public function addAddressForm_do() {
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            $title=$this->input->post('title');
            $address_type=$this->input->post('address_type');
            $tck=$this->input->post('title');
            $addressName=$this->input->post('addressName');
            $namesurname=$this->input->post('namesurname');
            $address=$this->input->post('address');
            $zipcode=$this->input->post('zipcode');
            $phone=$this->input->post('phone');
            $county=$this->input->post('county');

            $companyName=$this->input->post('companyName');
            $tax_name=$this->input->post('tax_name');
            $tax_number=$this->input->post('tax_number');
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title', 'Adres Adı', 'required|min_length[1]|max_length[100]|xss_clean');

            if ($address_type==1) {
                $this->form_validation->set_rules('companyName', 'Şirket Adı', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('tax_name', 'Vergi Dairesi', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('tax_number', 'Vergi Numarası', 'required|min_length[1]|max_length[100]|xss_clean');
            }
            else {
                $this->form_validation->set_rules('namesurname', 'Alıcı Adı Soyadı', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('addressName', 'Adres İsmi', 'required|min_length[1]|max_length[100]|xss_clean');
            }            

            $this->form_validation->set_rules('address', 'Adres', 'required|min_length[5]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('county', 'İlçe', 'required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('phone', 'Telefon', 'required|min_length[11]|max_length[20]|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {                        
                echo validation_errors('<div class="alert_error">', '</div>');
            }
            else {
                $member_id=$this->session->userdata('userid');
                $sql=$this->db->query("select * from users where id=".$this->db->escape($member_id)."");
                foreach($sql->result() as $member) {
                    $datas=array(
                        'user_id'=>$member->id,
                        'company'=>$address_type,
                        'company_name'=>$companyName,
                        'address_title'=>$title,
                        'address_name'=>$addressName,
                        'name_surname'=>$namesurname,
                        'address'=>$address,
                        'county'=>$county,
                        'zip_code'=>$zipcode,
                        'phone'=>$phone,
                        'tax_name'=>$tax_name,
                        'tax_number'=>$tax_number
                    );
                    if ($this->db->insert('address',$datas)) {
                        ?><script>location.href='<?php echo base_url("profile/address") ?>'</script><?php
                    }
                }
            }
        }
    }

    public function editAddressForm_do() {
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {

            $id=$this->input->post('id');

            $title=$this->input->post('title');
            $address_type=$this->input->post('address_type');
            $tck=$this->input->post('title');
            $addressName=$this->input->post('addressName');
            $namesurname=$this->input->post('namesurname');
            $address=$this->input->post('address');
            $zipcode=$this->input->post('zipcode');
            $phone=$this->input->post('phone');
            $county=$this->input->post('county');

            $companyName=$this->input->post('companyName');
            $tax_name=$this->input->post('tax_name');
            $tax_number=$this->input->post('tax_number');
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title', 'Adres Adı', 'required|min_length[1]|max_length[100]|xss_clean');

            if ($address_type==1) {
                $this->form_validation->set_rules('companyName', 'Şirket Adı', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('tax_name', 'Vergi Dairesi', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('tax_number', 'Vergi Numarası', 'required|min_length[1]|max_length[100]|xss_clean');
            }
            else {
                $this->form_validation->set_rules('namesurname', 'Alıcı Adı Soyadı', 'required|min_length[1]|max_length[100]|xss_clean');
                $this->form_validation->set_rules('addressName', 'Adres İsmi', 'required|min_length[1]|max_length[100]|xss_clean');
            }            

            $this->form_validation->set_rules('address', 'Adres', 'required|min_length[5]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('county', 'İlçe', 'required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('phone', 'Telefon', 'required|min_length[11]|max_length[20]|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {                        
                echo validation_errors('<div class="alert_error">', '</div>');
            }
            else {
                $member_id=$this->session->userdata('userid');
                $sql=$this->db->query("select * from users where id=".$this->db->escape($member_id)."");
                foreach($sql->result() as $member) {

                    $sql=$this->db->query("select * from address where user_id=".$member->id." and id=".$this->db->escape($id)."");
                    if ($sql->num_rows()>0) {
                        $datas=array(
                        'user_id'=>$member->id,
                        'company'=>$address_type,
                        'company_name'=>$companyName,
                        'address_title'=>$title,
                        'address_name'=>$addressName,
                        'name_surname'=>$namesurname,
                        'address'=>$address,
                        'county'=>$county,
                        'zip_code'=>$zipcode,
                        'phone'=>$phone,
                        'tax_name'=>$tax_name,
                        'tax_number'=>$tax_number
                        );
                        $this->db->where('id',$id);
                        if ($this->db->update('address',$datas)) {
                            ?><script>location.href='<?php echo base_url("profile/address") ?>'</script><?php
                        }
                    }                    
                }
            }
        }
    }

    function deleteAddress($id="") {
        $member_id=$this->session->userdata('userid');
        $sql=$this->db->query("select * from users where id=".$this->db->escape($member_id)."");
        foreach($sql->result() as $member) {
            $sql=$this->db->query("select * from address where id=".$id." and user_id=".$member_id."");
            foreach($sql->result() as $a) {
                $this->db->where('id',$a->id);
                if ($this->db->delete('address')) { ?>
                        <script>
                            parent.$('#address<?php echo $id ?>').slideUp(250);
                        </script>
                <?php 
                }
            }
        }
    }

    public function addAddress() {
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            
            $userid=$this->session->userdata('userid');
            
            if (is_numeric($userid)) { 
				$datas["selectnav"]="address";                  
                $this->load->view('profile/addAddressView',$datas);   
            }                
        }
        else {
            $this->load->view('home_view',$datas);
        }
    }

    public function profileForm_do()
    {
            $login=$this->session->userdata('login');
            if ($login==1) {
                    $this->load->helper('form'); 
                    $this->load->library('form_validation');
                    $this->load->library('email');

                    $name=$this->input->post('name');
                    $surname=$this->input->post('surname');
                    $phoneAreaCode=$this->input->post('phoneAreaCode');
                    $phone=$this->input->post('phone');
                    $email=$this->input->post('email');

                    $error=0;


                    $this->load->helper('email');

                    $this->form_validation->set_rules('name','Ad','required|min_length[2]|max_length[50]|xss_clean');
                    $this->form_validation->set_rules('surname','Soyad','required|min_length[2]|max_length[50]|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');                    
                    $this->form_validation->set_rules('phoneAreaCode','Alan Kodu','required|min_length[3]|max_length[3]|xss_clean|numeric');
                    $this->form_validation->set_rules('phone','Telefon','required|min_length[7]|max_length[7]|xss_clean|numeric');
                    $this->form_validation->set_message('required', '- %s '.' alanlarının doldurulması zorunludur');  
                    $this->form_validation->set_error_delimiters('<div class="alert_error">', '</div>');

                    if ($this->form_validation->run()) 
                    {
                            $sql=$this->db->query("select * from users where id='".$this->db->escape_like_str($this->session->userdata('userid'))."' limit 0,1");
                                if ($sql->num_rows()==0) { exit(); }  
                                else { 
                                    
                                    $eklenecek=Array(
                                        'email'=>$email,
                                        'name'=>$this->db->escape_like_str($name),
                                        'surname'=>$this->db->escape_like_str($surname),
                                        'phone_area'=>$this->db->escape_like_str($phoneAreaCode),
                                        'phone'=>$this->db->escape_like_str($phone)
                                    );
                                    
                                    $this->db->where('id',$this->session->userdata('userid'));
                                    if ($this->db->update('users',$eklenecek))
                                    {
                                        echo '<div class="alert_pass">Değişiklikler Kaydedildi.</div>';                                        
                                    }
                                }                        
                    }
                    else
                    {
                       echo $this->form_validation->error_string();
                       ?>
                        <script>
                            $('#profileForm_back').fadeIn(500);
                        </script>
                <?php
                    } 
            }
            else {
                echo "Lütfen üye girişi yapınız.";
            }
    }

    public function changePassword() {
        $login=$this->session->userdata('login');
        $datas["login"]=$login;
        if ($login==1) {
            $datas['profile_menu']='change_password';
			$datas["selectnav"]="changepass";
            $this->load->view('profile/changePasswordView',$datas);
        }
        else {
            $this->load->view('home_view',$datas);
        }   
    }

    public function changePasswordForm_do() {
        $old_password=$this->input->post('old_password');
        $password=$this->input->post('password');
        $password_repeat=$this->input->post('password_repeat');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('old_password', 'Eski şifrenizi', 'required|trim|xss_clean|min_length[6]');
        $this->form_validation->set_rules('password', 'Yeni şifrenizi', 'required|matches[password_repeat]|trim|xss_clean|min_length[6]');
        $this->form_validation->set_rules('password_repeat', 'Yeni şifre tekrar', 'required');

        if ($this->form_validation->run() == FALSE)
        {
           echo validation_errors('<div class="alert_error">', '</div>');
        }
        else
        {
            $member_id=$this->session->userdata('userid');
            $sql=$this->db->query("select * from users where id=".$this->db->escape($member_id)."");
            foreach($sql->result() as $profile) {
                if ($profile->password<>md5($old_password)) {
                    echo '<div class="alert_error">Eski şifrenizi kontrol ediniz.</div>';
                }
                else {
                    $datas=array(
                        'password'=>md5($password),
                        'password_view'=>$password
                    );
                    $this->db->where('id',$profile->id);
                    if ($this->db->update('users',$datas)) {
                        echo '<div class="alert_pass">Şifre değişikliğiniz kaydedildi</div>';
                    }
                }
            }
        }
    }
}
?>