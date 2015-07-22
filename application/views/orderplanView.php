<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>
    <section>
    
        <div class="container">

             <div class="order_title">
                 SİPARİŞ PLANLAMA   
             </div>
             
             <form id="orderplanForm" name="orderplanForm" onsubmit="submitform('orderplan','orderplanForm'); return false;">
             
             <div class="order_pickup">
             	<span class="title">Pick-Up</span>
                
                <span>
                    <input class="check" type="checkbox" name="myself" value="myself">Ürünü ben gelip alacağım.(Pick-up zamanımız 18.00 - 18.30 arasıdır.)
                </span>
             </div>
             
             <div class="order_pickup">
             	<span class="title">Teslimat Günü</span>
             </div>
             
             <div class="order_pickup">
             	<span class="today">Bugün</span>
             </div>
            
            <div class="row">
            
              <div class="col-md-10 col-md-offset-1 col-sm-12">
                  <div class="login_box">
                    
                    <div class="row">
                            <div class="col-md-6 col-sm-6"> 
                            
                            <span class="title">Kaç Kişilik</span> 
                              
                                <div class="select_box">
                                    <select name="person">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">  
                            <span class="title">Kaç Günlük</span> 
                              
                                <div class="select_box">
                                    <select name="person">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-6"> 
                        <span class="title">Teslimat Tarihi</span>
                           
                                <div class="select_box">
                                    <select name="date">
                                        <option>Teslimat Tarihi</option>
                                    </select>
                                </div>
                            </div>
                        
                        <div class="col-md-6 col-sm-6">  
                        <span class="title">Teslimat Zamanı</span>
                          
                                <div class="select_box">
                                    <select name="time">
                                        <option>Teslimat Zamanı</option>
                                    </select>
                                </div>
                            </div>
                        
                       </div>
                       
                        <div class="row"> 
                        
                          <div class="col-md-6 col-sm-6">
                          	<span class="title">Teslimat Adresi</span> 
                                
                                <div class="select_box">
                                    <select name="address1">
                                        <option>EV</option>
                                    </select>
                                </div>
                            </div>
                            
                         <div class="col-md-6 col-sm-6">  
                         	<span class="title">Fatura Adresi</span> 
                               
                                <div class="select_box">
                                    <select name="address2">
                                        <option>EV</option>
                                    </select>
                                </div>
                            </div>
                         
                        </div>
                        
                          <input class="login_button" type="submit" name="submit" value="DEVAM" />
                          <div id="orderplanForm_back" class="alerts_box"></div>
                        
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
