<?php 
class Juico_Model extends CI_Model {   
    function list_view($product,$i) {
        if ($product["catid"]==3) { $class="big_box"; }
        else { $class=""; }
        
        $nomargin="";
        if ($product["catid"]==3) { 
            if ($i%2==0) { $nomargin=" nomargin"; }
        }
        else {
            if ($i%3==0) { $nomargin=" nomargin"; }
        }
        ?>
                    <article class="<?php echo $class.$nomargin ?>">
                        <div class="image">
                            <a href="<?php echo base_url().$this->lang->line('lang') ?>product/detail/<?php echo $product["id"] ?>">                            
                                <img height="257" src="<?php echo base_url() ?>uploads/<?php echo $product['image'] ?>" />
                            </a>
                        </div>
                        <div align="center">
                            <div class="title">
                                <?php echo $product["title".$this->lang->line('dil')] ?>
                                <?php 
                                if ($product['catid']==3) {
                                    if ($product["id"]==10) { echo "<label>".$this->lang->line('gunluk_8_adet')."</label>"; }
                                    else { echo "<label>".$this->lang->line('gunluk_6_adet')."</label>"; }
                                }
                                ?>
                                <span><?php
                                $ingredients=$product["ingredients".$this->lang->line('dil')];
                                $ingredients=str_replace('Turuncu','<a href="'.base_url().$this->lang->line('lang').'product/detail/7">Turuncu</a>',$ingredients);
                                $ingredients=str_replace('Beyaz','<a href="'.base_url().$this->lang->line('lang').'product/detail/6">Beyaz</a>',$ingredients);
                                $ingredients=str_replace('Kırmızı','<a href="'.base_url().$this->lang->line('lang').'product/detail/5">Kırmızı</a>',$ingredients);
                                $ingredients=str_replace('Yeşil','<a href="'.base_url().$this->lang->line('lang').'product/detail/3">Yeşil</a>',$ingredients);
                                $ingredients=str_replace('Tatlı Sarı,','<a href="'.base_url().$this->lang->line('lang').'product/detail/4">Tatlı&nbsp;Sarı&nbsp;</a>,',$ingredients);
                                $ingredients=str_replace('Sarı,','<a href="'.base_url().$this->lang->line('lang').'product/detail/2">Sarı</a>,',$ingredients);
                                $ingredients=str_replace('Pembe,','<a href="'.base_url().$this->lang->line('lang').'product/detail/7">Pembe</a>,',$ingredients);
                                $ingredients=str_replace('Nar Çiçeği,','<a href="'.base_url().$this->lang->line('lang').'product/detail/14">Nar Çiçeği</a>,',$ingredients);
                                echo $ingredients; ?><br/><br/><?php if (strlen($product["calorie"])>0) { echo 'yaklaşık '.$product["calorie"].' kcal'; } ?></span>
                                <br/>
                                <?php echo $this->fiyat_hesapla($product) ?> TL                                
                            </div>                            
                        </div>
                        <a href="<?php echo base_url().$this->lang->line('lang') ?>product/detail/<?php echo $product["id"] ?>" class="add_basket"><?php echo $this->lang->line('list_detayli_bilgi') ?></a>
                        <?php if ($product["catid"]==3) { ?>
                        <a href="<?php echo base_url().$this->lang->line('lang') ?>basket/add/<?php echo $product["id"] ?>" class="add_basket"><?php echo $this->lang->line('list_siparis_ver') ?></a>
                        <?php } else {?>
                        <a href="<?php echo base_url().$this->lang->line('lang') ?>basket/juico" class="add_basket"><?php echo $this->lang->line('list_siparis_ver') ?></a>                        
                        <?php }?>
                    </article>
        <?php
    }
    
    function fiyat_hesapla($product) {
        return $this->fiyat_bicim($product["price"]-(($product["price"]*$product["percentage"])/100));
    }
    
    function fiyat_bicim($fiyat) {
        return money_format('%.2n', $fiyat);
    }
    
    function add_basket($product,$qty) {       
        $userid=$this->session->userdata('userid');
        $sql=$this->db->query("select * from basket where user_id=".$this->db->escape($userid)." and product_id=".$product["id"]."");        
        if ($sql->num_rows()==0) {
            $datas=array(
                'user_id'=>$userid,
                'product_id'=>$product["id"],
                'qty'=>$qty,
                'product_catid'=>$product["catid"]
            );
            if ($this->db->insert('basket',$datas)) {
                return true;
            }
        }
        else {
            foreach($sql->result() as $basket) {
                $datas=array('qty'=>$basket->qty+$qty);
                $this->db->where('id',$basket->id);
                if ($this->db->update('basket',$datas)) {
                    return true;
                }
            }
        }
    }
    
    public function total() {
         $sql=$this->db->query("
                select basket.id as id , basket.user_id , basket.product_id , basket.qty , basket.product_catid , 
                basket.cleanse_date , basket.cleanse_date_view , basket.day , basket.address , basket.person ,
                products.id as pid , products.title , products.price , products.image , products.percentage
                from 
                basket , products
                where products.id=basket.product_id and basket.user_id=".$this->session->userdata('userid')." order by product_catid desc
                ");
         $toplam="";
         foreach($sql->result_array() as $sepet) {
             if ($sepet["product_catid"]==2) {
                $toplam=$toplam+($sepet["qty"]*$this->fiyat_hesapla($sepet));             
             }
             else {
                $toplam=$toplam+(($sepet["day"]*$this->fiyat_hesapla($sepet))*$sepet["person"]); 
             }
         }
         return $this->fiyat_bicim($toplam);
    }
}
?>
