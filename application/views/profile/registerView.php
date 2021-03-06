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
                    <div class="l_cover_title">ÜYE OL</div>
                    <div class="l_cover_line"></div>
                    <div class="l_cover_txt">HESABIM</div>
                    <div class="l_cover_img"></div>
                </div>
            </div>
          </div> 
	</div>
    
      <div class="container">
        
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
                            
                            <div class="col-md-6 col-sm-6">   
                                <input class="input_box" type="tel" name="phone" placeholder="Telefon" />
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
