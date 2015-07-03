<?php 
class Email_model extends CI_Model {   
    
    function content($text) 
    {
        $html='
            <div style="padding:50px;background:#e5e5e5;">
            <div style="background:#ffffff;width:600px;border:solid 1px #ededed;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;padding:20px;">
                <div style="padding-bottom:10px;"><a href="'.base_url().'"><img src="'.base_url().'assets/images/logo.png" width="150" /></a></div>
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
