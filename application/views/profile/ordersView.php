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
                    <div class="l_cover_title">SİPARİŞLERİM</div>
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
                    
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="order_item">ÜRÜN</div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">ADET</div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="order_item">FİYAT</div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="order_item">TOTAL</div>
                        </div>
                        
                    </div>
                    
                    <div class="order_list_item">
                        <div class="col-md-9 col-sm-10 col-xs-11 col-md-offset-1 order_list">
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="order_item txt">DETOX</div>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item"><div class="order_count">2</div></div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="order_item txt">190 TL</div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="order_item txt"><strong>380 TL</strong></div>
                            </div>
                            
                        </div> 
                        
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 re_order_abs"><div class="re_order"></div></div>
                    </div>
                      
                
                </div>
                
            </div>
            
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
