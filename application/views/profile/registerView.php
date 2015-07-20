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
                        <img src="assets/images/l_cover.png" alt="cover">
                    </div>
                </div> 
            </div> 
            
            <div class="row login_row">
               
             <div class="col-md-10 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ÜYE OL
                            <span>Üyeliğiniz yoksa bu bölümden hemen üye olabilir ve avantajlardan yararlanabilirsiniz.</span>
                        </div>
                    </div>
                    
             </div>
             
      </div>
            
            <div class="row">
            
            <form id="registerForm" name="registerForm" onsubmit="submitform('register','registerForm'); return false;">
            
              <div class="col-md-10 col-md-offset-1 col-sm-12">
                  <div class="login_box">
                    
                    <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <input class="input_box" type="text" name="name" placeholder="Ad" />
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                              <input class="input_box" type="text" name="surname" placeholder="Soyad" />
                            </div>   
                              
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <input class="input_box" type="password" name="password" placeholder="Şifre" />
                        </div>
                        
                        <div class="col-md-6 col-sm-6">      
                            <input class="input_box" type="password" name="password_repeat" placeholder="Şifre Tekrarı" />
                        </div>
                        
                       </div>
                       
                        <div class="row"> 
                        
                          <div class="col-md-6 col-sm-6">    
                                <input class="input_box" type="email" name="email" placeholder="E Posta" />
                         </div>
                            
                            <div class="col-md-2 col-sm-2">   
                              <input class="input_box" type="tel" name="phoneAreaCode" placeholder="Alan Kodu" maxlength="3" />
                            </div>
                            
                            <div class="col-md-4 col-sm-4">   
                                <input class="input_box" type="tel" name="phone" placeholder="Telefon" maxlength="7" />
                            </div>
                        </div>
                        
                          <input class="login_button" type="submit" name="submit" value="KAYDET" />
                          <div id="registerForm_back" class="alerts_box"></div>
                        
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
