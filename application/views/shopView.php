<?php $this->load->view('includes/head') ?>

<script src="<?php echo base_url('assets/js/bottle_add.js') ?>"></script>

</head>
<body>
<?php $this->load->view('includes/header') ?>
  
  <div class="alerts_box">
  	<div class="alert_error">En fazla 6 adet ekleyebilirsiniz.</div>
  </div>

  <div class="bottles_fixed">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            
                  <div id="bottles">
                      <form name="createCleanseForm" id="createCleanseForm" onsubmit="return false">    
                          <div class="be1 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <div class="be2 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <div class="be3 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <div class="be4 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <div class="be5 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <div class="be6 bottle_empty"><img src="assets/images/bottle_empty.png" /></div>
                          <input type="submit" class="bottle_purchase" value="SATIN AL" onclick="submitform('basket','createCleanseForm')"> 
                      </form>             
                  </div>
                  <div id="createCleanseForm_back"></div>
            </div>
        </div>
    </div>
        
<div class="container">

<div class="fixed_fix"></div>   
    <?php 
    $sql=$this->db->query("select * from product_categories where catid=4 order by reorder asc"); 
    foreach($sql->result() as $category) {
    ?>
    <div class="row">
      <div class="h1"><?php echo $category->title ?></div>
    </div>
    
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
            <div class="bottle_box">
                    <?php $sql=$this->db->query("select * from products where catid=".$category->id."");
                    foreach($sql->result() as $product) { ?>
                    <div class="bottle">
                      <input type="hidden" name="bottle[]" class="bottle_input" value="<?php echo $product->id ?>">
                        <div class="add_button"></div>
                        <div class="remove_button"></div>
                        <img src="<?php echo base_url('uploads/'.$product->image) ?>" />
                        <div class="bottle_desc">
                            <strong><?php echo $product->title ?></strong>
                            <span><?php echo $category->title ?></span>
                        </div>
                    </div>
                    <?php }?>
            </div>
        </div>
      </div> 
      <?php }?>
  </div>

<?php $this->load->view('includes/footer') ?>
</body>
</html>
