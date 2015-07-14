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
                        <div class="l_cover_txt">SİPARİŞLERİM</div>
                        <img src="<?php echo base_url('assets/images/l_cover.png') ?>" alt="cover">
                    </div>
                </div> 
            </div> 
            
            <?php $this->load->view('profile/nav') ?>
            
            <div class="row login_row">
               
             <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ÖNCEKİ SİPARİŞLERİM
                            <span>Daha önce tamamlamış olduğunuz siparişleriniz ile ilgili tüm bilgileri burada bulabilirsiniz.</span>
                        </div>
                    </div>
                    
             </div>
             
            </div>
          
            <div class="row order_row">
            
                <div class="login_box">
            
                    <div class="col-md-9 col-sm-10 col-xs-11 col-md-offset-1 order_list">
                    
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">ÜRÜN</div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="order_item">ÇEŞİT</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-1">
                            <div class="order_item">ADET</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">FİYAT</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">TOTAL</div>
                        </div>
                        
                    </div>
                    
                    <div class="order_list_item">
                        <div class="col-md-9 col-sm-10 col-xs-11 col-md-offset-1 order_list">
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item"><img src="<?php echo base_url('assets/images/order_bottles.png') ?>" alt="purchase"></div>
                            </div>
                            
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="order_item">Detox / Smoothies / Breakfast / 7 Day</div>
                            </div>
                            
                            <div class="col-md-2 col-md-offset-1 col-sm-2 col-xs-2">
                                <div class="order_item"><div class="order_count">2</div></div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item order_num">190 TL</div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item order_num"><strong>380 TL</strong></div>
                            </div>
                            
                        </div> 
                        
                        <div class="col-md-1 col-sm-1 col-xs-1"><div class="re_order"></div></div>
                    </div>
                      
                
                </div>
                
            </div>
            
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
