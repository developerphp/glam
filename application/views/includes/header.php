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
                <a href="<?php echo base_url('basket') ?>">
                <div class="header_shop"></div>
                </a>
                
                <div class="header_profile">
                <?php if ($login==1) { ?>
                <span><?php echo $this->session->userdata('name').' '.$this->session->userdata('surname') ?></span>
                
                    <nav class="h_profile_menu">
                    	<ul>
                           <li><a href="<?php echo base_url('profile/edit') ?>">Üyelik Bilgileri</a></li>
                           <li><a href="<?php echo base_url('profile/address') ?>">Adres Defteri</a></li>
                           <li><a href="<?php echo base_url('profile/orders') ?>">Sipraişlerim</a></li>
                           <li><a href="<?php echo base_url('register/logout') ?>">Çıkış Yap</a></li>
                       </ul>
                    </nav>
                    
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
    
    <nav class="main_menu">
    
      <a>GLAM</a>
      <a <?php if( $selectnav == "detox" ) {echo 'class="menu_active"';} ?> href="<?php echo base_url('detox') ?>">DETOX</a>
      <a <?php if( $selectnav == "eats" ) {echo 'class="menu_active"';} ?> href="<?php echo base_url('eats') ?>">EAT</a>
      <a <?php if( $selectnav == "drinks" ) {echo 'class="menu_active"';} ?> href="<?php echo base_url('drinks') ?>">DRINKS</a>
      <a>SHOP</a>
      <a>MEET</a>
        
    </nav>

</div>

</header> 