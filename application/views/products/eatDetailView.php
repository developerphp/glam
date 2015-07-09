<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>
            
  <section>
    
      <div class="container">
        
          <div class="row page_margin">
            
              <div class="col-md-6 col-sm-6">
                  <img src="<?php echo base_url('uploads/'.$product->image) ?>" class="img-responsive" alt="detail">
                </div>
            
                <div class="col-md-4 col-sm-6 details_desc">
                  <div class="details_title">
                      <?php echo $product->title ?>
                      <span><?php echo $product->price ?>TL</span>
                    </div>
                    
          <div class="details_title_desc">
                      <?php echo nl2br($product->detail_description) ?>
                    </div>
                        <ul>
                            <?php 
                            $ingredients=explode(",",$product->benefits);
                            foreach($ingredients as $p) {
                              $ingredientssql=$this->db->query("select 
                                products.id , products.title,products.image,products.catid,
                                product_categories.id as cid , product_categories.title as cattitle
                               from products,product_categories where products.id=".$p." and products.catid=product_categories.id");
                              foreach($ingredientssql->result() as $bottle) { ?>
                                <li>- <?php echo $bottle->title ?></li>  
                              <?php 
                              } 
                            }?>
                        </ul>
                        
                    <!-- <a class="a_none"><div class="addtocart_button">ÜYE OL</div></a> -->
                    
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
                <div class="col-md-8 col-md-offset-2 detox_desc_long">
                  <?php echo $product->content ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 detox_desc_long">
                  <img src="<?php echo base_url('uploads/'.$product->banner) ?>" class="img-responsive">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2 detox_desc_long">
                  <?php echo $product->content2 ?>
                </div>
            </div>
            
            
        </div>
        
    </section>
</main>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
