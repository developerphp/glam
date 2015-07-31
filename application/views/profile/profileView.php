<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>

<div id="profileForm_back" class="alerts_box"></div>

 <main>
  <section>
  
    <div class="container-fluid">
    	<div class="row">
            <div class="login_cover">
                <div class="tint"></div>
                <div class="l_cover_txt">ÜYELİK BİLGİLERİ</div>
            </div>
          </div> 
	</div>
    
      <div class="container">
            
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
                      <div class="col-md-6 col-sm-6">
                          <input class="input_box" type="text" name="name" placeholder="Ad" value="<?php echo $profile->name ?>" />
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <input class="input_box" type="text" name="surname" placeholder="Soyad" value="<?php echo $profile->surname ?>" />
                      </div>   
                    </div>
                    <div class="row"> 
                      <div class="col-md-6 col-sm-6">    
                            <input class="input_box" type="email" name="email" placeholder="E Posta" value="<?php echo $profile->email ?>" />
                      </div>
                        
                      <div class="col-md-6 col-sm-6">   
                          <input class="input_box" type="tel" name="phone" placeholder="Telefon" value="<?php echo $profile->phone ?>" />
                      </div>
                    </div>
                    <div class="input_title change_pass"><a href="<?php echo base_url('profile/changePassword') ?>">Şifreni Değiştir</a></div>
                    <input class="login_button" type="submit" name="submit" value="KAYDET" />
                    
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
