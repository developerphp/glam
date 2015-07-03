<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<div class="container">
    <?php 
    $sql=$this->db->query("select * from product_categories where catid=4 order by reorder asc"); 
    foreach($sql->result() as $category) {
    ?>
    <div class="row">
    	<div class="h1"><?php echo $category->title ?></div>
    </div>
    
    <div class="row">
    
    	<div class="col-md-10 col-md-offset-1">
    		<?php echo $category->content ?>
        </div>
        
    </div>
    
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
        
            <div class="bottle_box">
                    <?php $sql=$this->db->query("select * from products where catid=".$category->id."");
                    foreach($sql->result() as $product) { ?>
                    <a href="<?php echo base_url('drinks/detail/'.$product->id) ?>">
                    <div class="bottle_dead">
                        <div id="b_add01" class="add_button"></div>
                        <img src="<?php echo base_url('uploads/thumb_'.$product->image) ?>" />
                        <div class="bottle_desc">
                            <strong><?php echo $product->title ?></strong>
                            <span><?php echo $category->title ?></span>
                        </div>
                    </div>
                    </a>
                    <?php } ?>
                    
            </div>
             
		</div>
	</div>    
    <?php }?> 
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
