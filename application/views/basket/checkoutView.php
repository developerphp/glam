<?php $this->load->view('includes/head') ?>
<script>
$(document).ready(function(){
    var simdi = new Date();
    var yil = new String(simdi.getFullYear());
    yil = yil.slice(2, 4);
    var ay = new String(simdi.getMonth()+1);
    if (ay.length == 1) ay = "0"+ay;
    var gun = new String(simdi.getDate());
    if (gun.length == 1) gun = "0"+gun;
    var sa = new String(simdi.getHours());
    if (sa.length == 1) sa = "0"+sa;
    var dk = new String(simdi.getMinutes());
    if (dk.length == 1) dk = "0"+dk;
    var sn = new String(simdi.getSeconds());
    if (sn.length == 1) sn = "0"+sn;
    $("#xid").val("GLAM_"+yil+ay+gun+sa+dk+sn);
});
</script>
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
        <form name="checkoutForm" id="checkoutForm" onsubmit="return false">
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
                    <?php 
                    $total=0;
                    $ben_alicam=0;
                    ?>
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
                            <?php 
                            $productprice=($basket->price*$basket->count_day)*$basket->count_person; 
                            $total=$total+$productprice;
                            $ben_alicam=$ben_alicam+$basket->ben_alicam;
                            ?>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="order_item order_num"><strong><?php echo $productprice ?> TL</strong></div>
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
                            <?php if ($ben_alicam>0) { ?>
                            <span>PICK-UP:</span>
                            <?php }?>
                            <span>TOPLAM:</span>
                        </div>
                        
                        <div class="col-md-6">
                            <strong><span>0.00 TL</span></strong>
                            <?php if ($ben_alicam>0) { ?>
                            <strong><span>-<?php echo $ben_alicam*5 ?> TL</span></strong>
                            <?php }?>
                            <strong><span><?php echo $total-($ben_alicam*5) ?> TL</span></strong>
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
            <input type="hidden" name="xid" id="xid" value="" />
            <div class="row">
                <div class="col-md-12 order_accept">
                    <div id="checkoutForm_back"></div>
                    <span>
                        <input class="check" type="checkbox" name="accept" value="accept"><a href="">Ön bilgilendirme koşulları</a> ve <a href="">Mesafeli Satış Sözleşmesi</a>ni okudum, onaylıyorum.
                    </span>
                    <input class="login_button" type="submit" name="submit" value="DEVAM" onclick="submitform('basket','checkoutForm')" />
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
