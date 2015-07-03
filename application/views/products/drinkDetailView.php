<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>
            
    <section>
    
        <div class="container">
        
            <div class="row page_margin">
            
                <div class="col-md-6 col-sm-6 details_img">
                    <img src="<?php echo base_url('uploads/'.$product->image) ?>" class="img-responsive" alt="bottle">
                </div>
            
                <div class="col-md-4 col-sm-6 details_desc">
                    <div class="details_title">
                        <?php echo $product->title ?>
                        <span><?php echo $product->category_name ?></span>
                    </div>
                        <ul>
                            <li class="details_list_title">İçindekiler:</li>
                            <li>
                            <?php echo nl2br($product->ingredients) ?>
                            </li>
                        </ul>
                        
                    
                        <ul>
                            <li class="details_list_title">Yararları:</li>
                            <li><?php echo $product->content ?></li>
                        </ul>
                    
                    <div class="details_share">
                        <span>Paylaş</span>
                        <div>
                            <ul>
                                <li><img src="<?php echo base_url('assets/images/social_ins_dark.png') ?>"></li>
                                <li><img src="<?php echo base_url('assets/images/social_face_dark.png') ?>"></li>
                                <li><img src="<?php echo base_url('assets/images/social_pin_dark.png') ?>"></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        <div class="row">
            <div class="h1">İlgili Ürünler</div>
        </div>
        
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
        
            <div class="bottle_box">
                <?php 
                $sql=$this->db->query("select * from products where catid=".$product->catid." and id<>".$product->id."");
                foreach($sql->result() as $others) {
                ?>
                    <div class="bottle_dead">
                        <div id="b_add01" class="add_button"></div>
                        <img src="<?php echo base_url('uploads/thumb_'.$others->image) ?>" />
                        <div class="bottle_desc">
                            <strong><?php echo $others->title ?></strong>
                            <span><?php echo $product->category_name ?></span>
                        </div>
                    </div>
                <?php }?>
            </div>
             
        </div>
    </div> 
            
        </div>
        
    </section>
</main>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
