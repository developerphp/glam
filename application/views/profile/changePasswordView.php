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
                    <div class="l_cover_title">ŞİFRE DEFTERİ</div>
                    <div class="l_cover_line"></div>
                    <div class="l_cover_txt">HESABIM</div>
                    <div class="l_cover_img"></div>
                </div>
            </div>
          </div> 
	</div>
    
      <div class="container">
       
            <?php $this->load->view('profile/nav') ?>

            <div class="row login_row">
               
             <div class="col-md-10 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ŞİFRE DEĞİŞTİR
                            <span>Şifrenizi değiştirmek için lütfen öncelikle eski şifrenizi onaylayınız. Ardından yeni şifrenizi oluşturabilirsiniz.</span>
                        </div>
                    </div>
                    
             </div>
             
      </div>            
            <div class="row">            
            <form id="changePasswordForm" name="changePasswordForm" onsubmit="submitform('profile','changePasswordForm'); return false;">            
              <div class="col-md-10 col-md-offset-1 col-sm-12">
                  <div class="login_box">
                    
                    <div class="row">
                            <div class="col-md-6">
                                <input class="input_box" type="text" name="old_password" placeholder="Eski Şifre" />
                            </div>
                              
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                            <input class="input_box" type="password" name="password" placeholder="Yeni Şifre" />
                        </div>
                        
                        <div class="col-md-6">      
                            <input class="input_box" type="password" name="password_repeat" placeholder="Yeni Şifre Tekrar" />
                        </div>
                        
                       </div>
                        
                          <input class="login_button" type="submit" name="submit" value="KAYDET" />
                          <div id="changePasswordForm_back" class="alerts_box"></div>
                        
                    </div>     
                
              </form>
                
      </div>
            
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
