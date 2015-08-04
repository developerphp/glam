<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->library('cart');
        $this->load->model('cart_model');
        $login=$this->session->userdata("login");
	}

	public function index() {
	    $login=$this->session->userdata('login');            
        $datas["selectnav"]="";
	    if ($login<>1) {
	        $datas["login"]=$login;
	        $this->load->view('profile/registerView',$datas);
	    }
	    else {
	        $this->load->view('home_view');
	    }
	}

    public function login() {
        $login=$this->session->userdata('login');            
        $datas["login"]=$login;
        $datas["selectnav"]="";
        $datas["url"]=$this->input->get('url');
        if ($login<>1) {                
            $this->load->view('profile/loginView',$datas);
        }
        else {
            $this->load->view('home_view',$datas);
        }
    }

    public function loginForm_do()
        {

            $login=$this->session->userdata('login');            
            if ($login<>1) {
                $this->load->helper('form'); 
                $this->load->library('form_validation');
                $this->load->library('email');
                
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $url=$this->input->post('url');
                                
                
                $this->load->helper('email');
                
                
                
                if (!valid_email($email)) { echo '<div class="alert_error">Lütfen email adresinizi giriniz</div>';
                    ?>
                    <script>
                    $('input[name=email]').addClass('error_input');
                    </script>
                    <?php
                exit(); }
                if (strlen($password)<6) { echo '<div class="alert_error">Lütfen şifrenizi giriniz</div>';
                    ?>
                    <script>
                    $('input[name=password]').addClass('error_input');
                    </script>
                    <?php
                exit(); }
                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                $this->form_validation->set_rules('password', 'Şifre', 'required|trim|min_length[6]|max_length[50]|xss_clean|md5');
                $this->form_validation->set_message('required', '- %s '.' alanları zorunludur.');  
                    $this->form_validation->set_error_delimiters('<div class="alert_error">', '</div>');
                if ($this->form_validation->run()) 
                {                    
                    $sql=$this->db->query("select * from users where email='".$email."' limit 0,1");
                    if ($sql->num_rows()==0) {
                        echo 'Bu bilgilerle kayıtlı bir üyemiz bulunmamaktadır';
                        ?>
                        <script>
                        $('input[name=email] , input[name=password]').addClass('error_input');
                        </script>
                        <?php                        
                    }
                    else {                        
                        foreach($sql->result() as $uye) {
                            if (md5($password)==$uye->password) {
                                if ($uye->approval==0) {
                                    echo '<div class="alert_error">Üyelik henüz aktif edilmemiş</div>';
                                    ?>
                                    <script>
                                    $('input[name=email] , input[name=password]').addClass('error_input');
                                    </script>
                                    <?php
                                    exit();
                                }
                                $data = array(
                                            'name'=>$uye->name,
                                            'surname'=>$uye->surname,
                                            'login'=>1,
                                            'userid'=>$uye->id
                                );
                                
                                $this->session->set_userdata($data);
                                
                                $date = date('Y-m-d');
                                $sordate=date('Y-m-d', strtotime($date. ' + 2 days'));
                                     
                                ?>
                                <script>
                                <?php if (strlen($url)>0) { ?>
                                    parent.location.href='<?php echo $url ?>';
                                <?php } else {?> 
                                    parent.location.href='<?php echo base_url("profile/edit") ?>';
                                <?php }?>
                                </script>
                                <?php
                            }
                            else {
                                echo '<div class="alert_error">Lütfen bilgilerinizi kontrol ediniz</div>';
                            }
                        }
                    }
                }
                else {
                    echo $this->form_validation->error_string();
                }
                
            }
            else {
                echo '<div class="alert_error">Zaten giriş yapmışsınız.</div>';
            }
        }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

	public function registerForm_do()
	    {
            $login=$this->session->userdata('login');
            if ($login<>1) {
                    $this->load->helper('form'); 
                    $this->load->library('form_validation');

                    $name=$this->input->post('name');
                    $surname=$this->input->post('surname');
                    $email=$this->input->post('email');
                    $password=$this->input->post('password');
                    $rpassword=$this->input->post('passwordRepeat');
                    $phone=$this->input->post('phone');

                    $error=0;
                    $this->load->helper('email');
                    



                    $this->form_validation->set_rules('name','Ad','required|min_length[2]|max_length[50]|xss_clean');
                    $this->form_validation->set_rules('surname','Soyad','required|min_length[2]|max_length[50]|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
                    //$this->form_validation->set_rules('registerusername', '', 'trim|required|min_length[6]|max_length[50]|xss_clean|callback_valid_username');  
                    $this->form_validation->set_rules('password', "Şifre", 'required|trim|min_length[6]|max_length[50]|xss_clean|matches[password_repeat]|md5');
                    $this->form_validation->set_rules('rpassword', "Şifre Tekrar", 'trim');
                    $this->form_validation->set_rules('phone','Telefon','required|min_length[7]|max_length[7]|xss_clean|numeric');
                    $this->form_validation->set_message('required', '- %s '.' alanlarının doldurulması zorunludur');  
                    $this->form_validation->set_error_delimiters('<div class="alert_error">', '</div>');


                    if ($this->form_validation->run()) 
                    {
                        if ($error<>1) {
                            $sql=$this->db->query("select * from users where email='".$email."' limit 0,1");
                                if ($sql->num_rows()<>0) 
                                {
                                    echo 'Bu email adresi kullanılıyor.';
                                }
                                else { 
                                    $onaykodu = uniqid();
                                    $eklenecek=Array(
                                        'email'=>$email,
                                        'name'=>$this->db->escape_like_str($name),
                                        'surname'=>$this->db->escape_like_str($surname),
                                        'phone'=>$this->db->escape_like_str($phone),
                                        'password'=>$this->db->escape_like_str(md5($password)),
                                        'approval_code'=>$this->db->escape_like_str($onaykodu),
                                        'register_type'=>'normal',
                                        'approval'=>0
                                    );
                                    
                                    if ($this->db->insert('users',$eklenecek))
                                    {                                        
                                        $insertid=$this->db->insert_id();
                                        $this->load->model('email_model','emailmodel');
                                        $title="Glam Üyelik Aktivasyonu";
                                        $content="
                                            Hoşgeldin ".$name." ".$surname."<br/><br/>
                                            Üyeliğini aktifleştirmek için lütfen linke <a href=\"".base_url()."register/activate/".$insertid."/".$onaykodu."\">tıkla.
                                        "; 

                                        if ( ! $this->emailmodel->send_email($email,$title,$content)){
                                            echo '<div class="alert_error">Aktivasyon maili gonderiminde problem yasandi lutfen mail adresinizi kontrol ediniz.</div>';
                                        }
                                        else {
                                            echo '<div class="alert_pass"><br/>Üyelik aktivasyonu gönderildi</div>';                                            
                                        }
                                    }
                                }
                        } else {
                            
                        }
                    }
                    else
                    {
                       echo $this->form_validation->error_string();
                       ?>
                        <script>
                            $('#registerForm_back').fadeIn(500);
                        </script>
                <?php
                    } 
            }
            else {
                echo "Zaten üye girişi yapmışsınız.";
            }
	}

	public function activate($id="",$code="") {
        if (is_numeric($id)) {
            if (strlen($code)>0) {
                $sql=$this->db->query("select * from users where id=".$this->db->escape($id)."");
                foreach($sql->result() as $user) {
                    if ($user->approval_code==$code) {
                        $this->db->where('id',$user->id);
                        if ($this->db->update('users',array('approval'=>1))) 
                        {
                            $data = array(
                                        'name'=>$user->name,
                                        'surname'=>$user->surname,
                                        'login'=>1,
                                        'userid'=>$user->id
                            );
                            $this->session->set_userdata($data);
                            ?>
                            <script>
                                parent.location.href='<?php echo base_url() ?>profile/edit';
                            </script>
                            <?php
                        }
                    } else {
                        echo "Kod yanlis";
                    }
                }
            }
        }
    }
        
}