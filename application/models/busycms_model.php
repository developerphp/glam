<?php 
class Busycms_model extends CI_Model {   
    
    function seo_url($text) 
    {
        $text = trim($text);
        $search = array(' ','\"','\'','Ç','ç','G','ğ','i','I','Ö','ö','S','s','Ü','ü','I','<','>','Ş','ş','İ','?','\\','ı','&','!',',','-','#39;',',','+','*');
        $replace = array('','','','c','c','g','g','i','i','o','o','s','s','u','u','i','&#60','&#62','s','s','i','','','i','','','-','','','','','');
        $new_text = str_replace($search,$replace,$text);
        $new_text2 = str_replace("__","_",$new_text);
        return strtolower($new_text2);
    }
}
?>