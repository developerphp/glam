<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<main>
    <div class="container-fluid">
        <div class="row">
                <img src="assets/images/detox_cover.png" alt="cover" width="100%">
        </div>
    </div>
            
    <section>
    
        <div class="container">
        
        <div class="row">
            <div class="h1">ENJOY YOUR LIFE  <strong>EAT LIKE A QUEEN</strong></div>
        </div>
        <?php 
        $i=1;
        $sql=$this->db->query("select * from products where catid=8 order by id asc");
        foreach($sql->result() as $detox) {
        ?>
            <div class="row page_margin">            
                <?php if ($i%2>0) { ?>
                <div class="col-md-6 col-sm-6">
                    <img src="<?php echo base_url('uploads/'.$detox->image) ?>" class="img-responsive" alt="bottle">
                </div>
                <?php }?>
                <div class="col-md-6 col-sm-6 details_desc">
                    <div class="detox_pad">
                      <div class="details_title">
                          <?php echo $detox->title ?>
                          <span><?php echo $detox->price ?>TL</span>
                      </div>
                      
                        <div class="detox_desc">
                          <?php echo nl2br($detox->description) ?>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-12">
                            <a href="<?php echo base_url('detox/detail/'.$detox->id) ?>" class="detox_button">İNCELE</a>
                            <!-- <div class="detox_button pull-right-xs">SATIN AL</div> -->
                          </div>
                      </div>
                      
                    </div>
                </div>
                <?php if ($i%2==0) { ?>
                <div class="col-md-6 col-sm-6 swap">
                    <img src="<?php echo base_url('uploads/'.$detox->image) ?>" class="img-responsive" alt="bottle">
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
