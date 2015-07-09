<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="login_cover">
                <img src="assets/images/detox_cover.png" alt="cover">
            </div>
        </div>
    </div>
            
    <section>
    
        <div class="container">
        
        <div class="row">
            <div class="h1">ENJOY YOUR LIFE  <strong>EAT LIKE A QUEEN</strong></div>
        </div>
        <?php 
        $i=1;
        $sql=$this->db->query("select * from products where catid=9 order by id asc");
        foreach($sql->result() as $eat) {
        ?>
            <div class="row page_margin">            
                <?php if ($i%2>0) { ?>
                <div class="col-md-6 col-sm-6">
                    <img src="<?php echo base_url('uploads/'.$eat->image) ?>" class="img-responsive" alt="bottle">
                </div>
                <?php }?>
                <div class="col-md-6 col-sm-6 details_desc">
                    <div class="detox_pad">
                      <div class="details_title">
                          <?php echo $eat->title ?>
                          <span><?php echo $eat->price ?>TL</span>
                      </div>
                      
                        <div class="detox_desc">
                          <?php echo nl2br($eat->description) ?>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-12">
                            <a href="<?php echo base_url('eats/detail/'.$eat->id) ?>" class="detox_button">İNCELE</a>
                            <div class="detox_button pull-right-xs">SATIN AL</div>
                          </div>
                      </div>
                      
                    </div>
                </div>
                <?php if ($i%2==0) { ?>
                <div class="col-md-6 col-sm-6 swap">
                    <img src="<?php echo base_url('uploads/'.$eat->image) ?>" class="img-responsive" alt="bottle">
                </div>
                <?php }?>
            </div>            
        <?php $i++; }?>
        </div>
        
    </section>
</main>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
