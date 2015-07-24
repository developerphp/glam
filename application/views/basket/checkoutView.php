<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>

    <section>    	
        <div class="container">
        <?php 
        $sql=$this->db->query("select * from baskets where member_id=".$this->session->userdata('userid')." and section=1");
        if ($sql->num_rows()==0) {
            echo '<br/><br/><br/><h1 align="center">Sepetiniz Boş</h1>';
        }
        else {
        ?>
        <form>
			<div class="row order_row">
            
                    <div class="col-md-12 order_list">
                    
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="order_item">ÜRÜN</div>
                        </div>
                        
                        <div class="col-md-1 col-sm-1 col-xs-1">
                            <div class="order_item">GÜN</div>
                        </div>
                        
                        <div class="col-md-1 col-sm-1 col-xs-1">
                            <div class="order_item">KİŞİ</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-1">
                            <div class="order_item">FİYAT</div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="order_item">TOTAL</div>
                        </div>
                        
                    </div>
                    
                    <div class="order_list_item">
                        <?php foreach($sql->result() as $basket) { ?>
                        <div class="col-md-12 order_list" style="padding: 20px 0 20px 0;">                            
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="order_item"><?php echo $basket->category_name.' - '.$basket->product_name ?></div>
                                <em><?php echo $basket->delivery_date_view ?></em>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <div class="order_item"><div class="order_count"><?php echo $basket->count_day ?></div></div>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <div class="order_item"><div class="order_count"><?php echo $basket->count_person ?></div></div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-1">
                                <div class="order_item order_num"><?php echo $basket->price*1 ?> TL</div>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item order_num"><strong><?php echo ($basket->price*$basket->count_day)*$basket->count_person ?> TL</strong></div>
                            </div>
                            
                            <div class="col-md-1 col-sm-1 col-xs-1"><a class="cancel_order adress_remove" href="<?php echo base_url('basket/delete/'.$basket->id) ?>"></a></div>
                            
                        </div>
                        <?php }?> 
                        
                        
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
         <?php }?>
         </div>    	
    </section>
</main>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
