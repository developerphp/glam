<?php 
class Register_model extends CI_Model {   
    function facebook($user) 
    {
        $fuid=$user["id"];
        $fname=$user["name"];
        $flink=$user["link"];
        $funame=$user["username"];
        $fgender=$user["gender"];
        $femail=$user["email"];
        $sql=$this->db->query("select * from users where facebook_id=".$this->db->escape($fuid)."");
        if ($sql->num_rows($sql)==0) {
            
            $sql=$this->db->query("select * from users where username='".$funame."'");
            if ($sql->num_rows()==0) { $username=$funame; }
            else { $username=$funame.$sql->num_rows(); }
            
            $datas=array("facebook_id"=>$fuid,
                'name_surname'=>$fname,
                'username'=>$username,
                'gender'=>$fgender,
                'register_type'=>'facebook',
                'register_date'=>date('Y-m-d H:i:s'),
                'email'=>$femail,
                'approval'=>1);
                if ($this->db->insert('users',$datas)) {
                    $insid=$this->db->insert_id();
                    $data = array(
                    'username' => $username,
                    'name_surname'=>$fname,
                    'userid' => $insid,
                    'login' => 1
                    );
                    $this->session->set_userdata($data);
                    
                    $addroom=$this->session->userdata('addroom');
                    if ($addroom==1) {
                        $this->addroom($insid);
                    }
                    //exit;
                    ?>
                            <script>
                                parent.location.href='<?php echo base_url().$this->lang->line('lang')?>profile/edit';
                            </script>
                    <?php
                }
        }
        else {
            foreach($sql->result() as $dbuser) {
                $datas=array("facebook_id"=>$fuid,
                'name_surname'=>$fname,
                'gender'=>$fgender,
                'register_type'=>'facebook',
                'email'=>$femail,
                'approval'=>1);
                $this->db->where("id",$dbuser->id);
                if ($this->db->update('users',$datas)) { 
                    $datas = array(
                    'username' => $dbuser->username,
                    'name_surname'=>$fname,
                    'userid' => $dbuser->id,
                    'login' => 1
                    );
                    $this->session->set_userdata($datas);
                    
                    $addroom=$this->session->userdata('addroom');
                    if ($addroom==1) {
                        $this->addroom($dbuser->id);
                    }
                    else { 
                        ?>
                            <script>
                                parent.location.href='<?php echo $this->session->userdata('back_url')?>';
                            </script>
                        <?php
                    }
                }
            }
        }
    }
    
    function twitter_login($user,$token) 
    {
        //print_r($user);
        $tuid=$user->id;
        $tname=$user->name;
        $tuname=$user->screen_name;
        $sql=$this->db->query("select * from users where twitter_id=".$this->db->escape($tuid)."");
        if ($sql->num_rows($sql)==0) {
            $sql=$this->db->query("select * from users where username='".$tuname."'");
            if ($sql->num_rows()==0) { $username=$tuname; }
            else { $username=$tuname.$sql->num_rows(); }
            $datas=array("twitter_id"=>$tuid,
                'name_surname'=>$tname,
                'username'=>$username,
                'register_type'=>'twitter',
                'register_date'=>date('Y-m-d H:i:s'),
                'twitter_token'=>$token,
                'twitter_followers'=>$user->followers_count,
                'twitter_friends'=>$user->friends_count,
                'approval'=>1);
            if ($this->db->insert('users',$datas)){
                $insid=$this->db->insert_id();
                    $datas = array(
                    'username' => $username,
                    'name_surname'=>$tname,
                    'userid' => $insid,
                    'login' => 1
                    );
                    $this->session->set_userdata($datas);
                    
                    //exit;
                    ?>
                        <script>
                            parent.location.href='<?php echo base_url().$this->lang->line('lang')?>profile/edit';
                        </script>
                    <?php
            }
        }
        else {
            foreach($sql->result() as $dbuser) {
                $datas=array("twitter_id"=>$tuid,
                'name_surname'=>$tname,
                'register_date'=>date('Y-m-d H:i:s'),
                'twitter_token'=>$token,
                'twitter_followers'=>$user->followers_count,
                'twitter_friends'=>$user->friends_count,
                'approval'=>1);
                $this->db->where("id",$dbuser->id);
                if ($this->db->update('users',$datas)) { 
                    $datas = array(
                    'username' => $tuname,
                    'name_surname'=>$tname,
                    'userid' => $dbuser->id,
                    'login' => 1
                    );
                    $this->session->set_userdata($datas);                    
                    ?>
                        <script>
                            parent.location.href='<?php echo $this->session->userdata('back_url')?>';
                        </script>
                    <?php
                }
            }
        }
        return true;
    }
    
    function addroom($uid) {
        $semt=$this->session->userdata('add_semt');
        $title=$this->session->userdata('add_title');
        $price=$this->session->userdata('add_price');
        $data = array(
        'addroom' => 0,
        'add_semt'=>"",
        'add_title' => "",
        'add_price' => ""
        );
        $this->session->set_userdata($data);
        $sql=$this->db->query("select 
        il.id as ilid,il.il_adi,
        ilce.id as ilceid , ilce.ilce_adi,
        semt.id , semt.semt_adi , semt.il_id , semt.ilce_id
        from 
        semt,ilce,il
        where semt.il_id=il.id and semt.ilce_id=ilce.id and semt.id=".$this->db->escape($semt)." limit 0,1");
        foreach($sql->result() as $semti) {
            $datas=array(
                "user_id"=>$uid,
                "title"=>$title,
                "il_id"=>$semti->il_id,
                "il_adi"=>$semti->il_adi,
                "ilce_id"=>$semti->ilce_id,
                "ilce_adi"=>$semti->ilce_adi,
                "semt_id"=>$semti->id,
                "semt_adi"=>$semti->semt_adi,
                "price"=>$price
            );
            if ($this->db->insert('rooms',$datas)) {
                ?>
                <script>
                    parent.location.href='<?php echo base_url().$this->lang->line('lang')."room/edit/".$this->db->insert_id()?>';
                </script>
                <?php
                exit();
            }
        }
    }
}
?>
