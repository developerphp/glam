<?php 
class Sez_email extends CI_Model {   
    
    function send($whois,$title,$content) 
    {
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user']    = 'info@juico.com.tr';
        $config['smtp_pass']    = 'yesiljuico';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not  

        $this->load->library('email',$config);
        $this->email->from("hey@juico.com.tr", "Juico");
//        $this->email->reply_to($reply_to, "Dogruokul");
        $this->email->to($whois);
        $this->email->subject('Juico - '.$title);
        $this->email->message($this->content($content));

        
        if ( ! $this->email->send()){
            return false;
        }
        else {
            return true;
        }
    }
    
    function content($content) {
        $text='
        <div style="font-family:Helvetica Neue, Helvetica, Arial, lucida grande,tahoma,verdana,arial,sans-serif;;text-align:left;width:500px;">
                <div style="padding:20px;"><a hraf="'.base_url().'"><img height="50" src="'.base_url().'assets/images/logo.png" style="border:none;" /></a></div>
                <div style="padding:20px;">
                    <div>'.$content.'</div>
                </div>
                <div align="right">
                    <a style="color:#000;font-weight:bold;" href="'.base_url().'">www.juico.com.tr</a>
                </div>
        </div>
        ';
        return $text;
    }
}
?>
