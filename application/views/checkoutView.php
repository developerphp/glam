<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>

    <section>
    	<form>
        <div class="container">
        
			<div class="row order_row">
            
                    <div class="col-md-12 order_list">
                    
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">ÜRÜN</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">ÇEŞİT</div>
                        </div>
                        
                        <div class="col-md-1 col-sm-1 col-xs-1">
                            <div class="order_item">GÜN</div>
                        </div>
                        
                        <div class="col-md-1 col-sm-1 col-xs-1">
                            <div class="order_item">ADET</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-1">
                            <div class="order_item">FİYAT</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">TOTAL</div>
                        </div>
                        
                    </div>
                    
                    <div class="order_list_item">
                        <div class="col-md-12 order_list" style="padding: 20px 0 20px 0;">
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item"><img src="assets/images/order_bottles.png" alt="purchase"></div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item">Detox</div>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <div class="order_item"><div class="order_count">7</div></div>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <div class="order_item"><div class="order_count">2</div></div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-1">
                                <div class="order_item order_num">190 TL</div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item order_num"><strong>380 TL</strong></div>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1"><div class="cancel_order"></div></div>
                            
                        </div> 
                        
                        
                    </div>
                
            </div>
            
            <div class="row summary_box">
            	<div class="col-md-2 back"><a>Alışverişe Devam Et</a></div>
                
                <div class="col-md-2 col-md-offset-8 total">
                   <div class="row">
                        <div class="col-md-6">
                            <span>KARGO:</span>
                            <span>PICK-UP:</span>
                            <span>TOPLAM:</span>
                        </div>
                        
                        <div class="col-md-6">
                            <strong><span>0.00TL</span></strong>
                            <strong><span>-5.00TL</span></strong>
                            <strong><span>380.00TL</span></strong>
                        </div>
                  	</div>
           		 </div>
            
        	</div>
            
            <div class="row checkout_box">
            	<div class="col-md-12"> <strong>ÖDEME SEÇENEKLERİ</strong> </div>
                <div class="col-md-2"><input type="radio" name="payment" value="credit">Kredi Kartı</div>
                <div class="col-md-2"><input type="radio" name="payment" value="transfer">Havale</div>
            </div>
            
            <div class="row checkout_note">
            	<div class="col-md-12"> <strong>SİPARİŞ NOTU</strong> </div>
                <div class="col-md-12"><textarea name="note"></textarea></div>
            </div>
            
            <div class="row">
                <div class="col-md-12 order_accept">
                    <span>
                        <input class="check" type="checkbox" name="accept" value="accept"><a href="">Ön bilgilendirme koşulları</a> ve <a href="">Mesafeli Satış Sözleşmesi</a>ni okudum, onaylıyorum.
                    </span>
                    <input class="login_button" type="submit" name="submit" value="DEVAM" />
                 </div>
             </div>
        	</form>
    </section>
</main>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
