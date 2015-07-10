<header>
    <div class="container-fluid">
        <div class="container">
        
            <div class="row">
            	<div id="m_menu"></div>
            
                <div class="header_social">
                    <ul>
                        <li>FACEBOOK</li>
                        <li>PINTEREST</li>
                        <li>INSTAGRAM</li>
                    </ul>
                </div> 
                
                <div class="header_shop"></div>
                
                <div class="header_profile">
                <?php if ($login==1) { ?>
                <span><?php echo $this->session->userdata('name').' '.$this->session->userdata('surname') ?></span>
                
                    <div class="h_profile_menu">
                        <ul>
                            <li><a href="<?php echo base_url('profile/edit') ?>">Üyelik Bilgileri</a></li>
                            <li>Adres Defteri</li>
                            <li>Sipraişlerim</li>
                            <li><a href="<?php echo base_url('register/logout') ?>">Çıkış Yap</a></li>
                        </ul>
                    </div>
                <?php } else {?>
                <a href="<?php echo base_url('register/login') ?>"><span>Giriş Yap</span></a>
                <?php }?>
                </div>
            </div>
            
        </div>  
    </div>   

<div class="logo"></div>

<div class="menu_container">

	<div id="m_close"></div>
    
    <div class="main_menu">
    
        <ul>
            <li><a>GLAM</a></li>
            <li><a href="<?php echo base_url('detox') ?>">DETOX</a></li>
            <li><a href="<?php echo base_url('eats') ?>">EAT</a></li>
            <li><a href="<?php echo base_url('drinks') ?>">DRINKS</a></li>
            <li><a>SHOP</a></li>
            <li><a>MEET</a></li>
        </ul>
        
    </div>

</div>

</header> 