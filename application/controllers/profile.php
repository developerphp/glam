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
                    $this->load->view('profile/profileView',$datas);
                }                    
            }                
        }
        else {
            $this->load->view('homeView',$datas);
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
                    $this->form_validation->set_error_delimiters('<blockquote><p class="error">', '</p></blockquote>');

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
                                        echo "Değişiklikler Kaydedildi.";                                        
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
           echo validation_errors('<div class="form_error">', '</div>');
        }
        else
        {
            $member_id=$this->session->userdata('userid');
            $sql=$this->db->query("select * from users where id=".$this->db->escape($member_id)."");
            foreach($sql->result() as $profile) {
                if ($profile->password<>md5($old_password)) {
                    echo '<div class="form_error">Eski şifrenizi kontrol ediniz.</div>';
                }
                else {
                    $datas=array(
                        'password'=>md5($password),
                        'password_view'=>$password
                    );
                    $this->db->where('id',$profile->id);
                    if ($this->db->update('users',$datas)) {
                        echo "Şifre değişikliğiniz kaydedildi";
                    }
                }
            }
        }
    }
}
?>