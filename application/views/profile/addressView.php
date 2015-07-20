<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
<main>
    <section>
    
    <div class="container-fluid">
    	<div class="row">
            <div class="login_cover">
                <div class="tint"></div>
                <div class="l_cover_txt">ADRES DEFTERİ</div>
            </div>
          </div> 
	</div>
    
        <div class="container">
            
            <?php $this->load->view('profile/nav') ?>
            
            <div class="row login_row">
               
             <div class="col-md-10 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ADRES DEFTERİ
                            <span>Doğru sipariş gönderimi için adres bilgileriniz bizim için çok önemli. Adres bilgilerinize ait detaylı bilgileri kontrol edebilir ve düzenleyebilirsiniz.</span>
                        </div>
                    </div>
                    
             </div>
             
            </div>
            
            <div class="row">
            
            <form action="" method="">
            
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="login_box">
                    
                    <div class="row">
                            <?php 
                            $sql=$this->db->query("select * from address where user_id=".$this->db->escape($userid)." order by id asc");
                            foreach($sql->result() as $address) { ?>
                            <div class="col-md-5" id="address<?php echo $address->id ?>">
                                <div class="adress_box">
                                    <a href="<?php echo base_url('profile/addressEdit/'.$address->id) ?>">
                                        <?php echo $address->address_title ?>
                                    </a>
                                </div>
                                <a class="adress_remove" href="<?php echo base_url('profile/deleteAddress/'.$address->id) ?>"></a>
                            </div>
                            <?php }?>
                            <div class="col-md-1 col-md-offset-1">
                                <a class="login_button" href="<?php echo base_url('profile/addAddress') ?>">ADRES EKLE</a>
                            </div>                             
                      </div>
                        
                    </div>     
                </div>
                    
            </form>
                
            </div>
            
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
