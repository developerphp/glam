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
                <div class="wrapper">
                    <div class="l_cover_title">GİRİŞ YAP</div>
                    <div class="l_cover_line"></div>
                    <div class="l_cover_txt">HESABIM</div>
                    <div class="l_cover_img"></div>
                </div>
            </div>
          </div> 
	</div>
    
      <div class="container">
            
            <div class="row login_row">
              <div class="col-md-5 col-md-offset-1 col-sm-6 login_left">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            GİRİŞ YAP
                            <span>Eğer daha önce üye olduysanız, e-posta adresi ve parola ile giriş yapabilirsiniz.</span>
                        </div>
                        <form name="loginForm" id="loginForm" onsubmit="submitform('register','loginForm'); return false;">
                            <input class="input_box" type="email" name="email" placeholder="Email" />
                            
                            <input class="input_box" type="password" name="password" placeholder="Şifre" />
                            <input type="hidden" name="url" value="<?php echo $url ?>" />
                            <input class="login_button" type="submit" name="submit" value="GİRİŞ YAP">
                            <div id="loginForm_back" class="alerts_box"></div>
                        </form>
                        <div class="lost_pass"><a>Şifremi unuttum</a></div>
                    </div>
                        
                </div>
                
                <div class="col-md-5 col-sm-6">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            YENİ ÜYELİK
                            <span>Üyeliğiniz yoksa bu bölümden hemen üye olabilir ve avantajlardan yararlanabilirsiniz.</span>
                        </div>
                             <a class="a_none" href="<?php echo base_url('register') ?>"><div class="login_button">ÜYE OL</div></a>
                    </div>
                    
                </div>
            </div> 
              
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
