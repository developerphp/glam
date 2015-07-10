<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
 <main>
  <section>
    
      <div class="container">
        
          <div class="row">
              <div class="col-md-12">
                  <div class="login_cover">
                        <div class="tint"></div>
                        <div id="cover_txt" class="l_cover_txt">ÜYE OL</div>
                        <img src="<?php echo base_url('assets/images/l_cover.png') ?>" alt="cover">
                    </div>
                </div> 
            </div> 
            
            <?php $this->load->view('profile/nav') ?>
            
            <div class="row login_row">
               
             <div class="col-md-10 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ÜYELİK BİLGİLERİ
                            <span>Üyeliğinize ait detaylı bilgileri kontrol edebilir ve düzenleyebilirsiniz.</span>
                        </div>
                    </div>
                    
             </div>
             
      </div>            
            <div class="row">            
            <form id="profileForm" name="profileForm" onsubmit="submitform('profile','profileForm'); return false;">            
              <div class="col-md-10 col-md-offset-1 col-sm-12">
                  <div class="login_box">                    
                    <div class="row">
                      <div class="col-md-6">
                          <input class="input_box" type="text" name="name" placeholder="Ad" value="<?php echo $profile->name ?>" />
                      </div>
                      <div class="col-md-6">
                        <input class="input_box" type="text" name="surname" placeholder="Soyad" value="<?php echo $profile->surname ?>" />
                      </div>   
                    </div>
                    <div class="row"> 
                      <div class="col-md-6">    
                            <input class="input_box" type="email" name="email" placeholder="E Posta" value="<?php echo $profile->email ?>" />
                      </div>
                        
                      <div class="col-md-2">   
                        <input class="input_box" type="tel" name="phoneAreaCode" placeholder="Alan Kodu" maxlength="3" value="<?php echo $profile->phone_area ?>" />
                      </div>
                        
                      <div class="col-md-4">   
                          <input class="input_box" type="tel" name="phone" placeholder="Telefon" maxlength="7" value="<?php echo $profile->phone ?>" />
                      </div>
                    </div>
                    <div class="input_title change_pass"><a href="<?php echo base_url('profile/changePassword') ?>">Şifreni Değiştir</a></div>
                    <input class="login_button" type="submit" name="submit" value="KAYDET" />
                    <div id="profileForm_back"></div>
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