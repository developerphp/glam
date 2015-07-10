<?php 
class Email_model extends CI_Model {   
    
    function send_email($to="",$title="",$content="") {
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '30';
            $config['smtp_user']    = 'sezgin@busyistanbul.com';
            $config['smtp_pass']    = '13031987';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not  

            $this->load->library('email',$config);
            $this->email->from("sezgin@busyistanbul.com", "Glam");
            $this->email->reply_to("sezgin@busyistanbul.com", "Glam");
            $this->email->to($to);
            $this->email->subject($title);            
            $this->email->message($this->content($content));

            if ( ! $this->email->send()){
                return false;
            }
            else {
                return true;
            }
    }
    
    function content($text) 
    {
        $html='
            <div>
            <div style="background:#ffffff;width:600px;">
                <div style="padding-bottom:10px;"><a href="'.base_url().'"><img src="'.base_url().'assets/images/glam_logo.png" width="150" /></a></div>
                <div style="padding:20px 0;color:#666;font-family:Arial;font-size:12px;">
                '.$text.'
                </div>
            </div>
            </div>
        ';
        
        return $html;
    }
}
?>
