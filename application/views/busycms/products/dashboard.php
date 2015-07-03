<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
        
    $(document).ready(function() {
        products(<?php echo $catid ?>,"<?php echo $sort ?>");
        $.initialize();
        $.demo();           
    });


    function deletecategorydo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deleteproductcategory/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function deletesubcategorydo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deleteproductsubcategory/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function deleteproductdo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deleteproduct/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function publish(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/productpublish/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }

    function deletecategory(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is product category <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletecategorydo('+id+')">Yes</a> or \n\
            <a style="color:#000;" href="javascript:void(0)" onclick="$(\'.notification .hide\').click();">No</a>';
        $.notification ( 
        {
            title:      'Confirm',
            content:    txt,
            icon:       '!',
            color:      '#000'
        }
    )
    }
    
    function deletesubcategory(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is product category <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletesubcategorydo('+id+')">Yes</a> or \n\
            <a style="color:#000;" href="javascript:void(0)" onclick="$(\'.notification .hide\').click();">No</a>';
        $.notification ( 
        {
            title:      'Confirm',
            content:    txt,
            icon:       '!',
            color:      '#000'
        }
    )
    }
    
    function deleteproduct(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is product <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteproductdo('+id+')">Yes</a> or \n\
            <a style="color:#000;" href="javascript:void(0)" onclick="$(\'.notification .hide\').click();">No</a>';
        $.notification ( 
        {
            title:      'Confirm',
            content:    txt,
            icon:       '!',
            color:      '#000'
        }
    )
    }
    
    function addcategory() {
        $('.product-section').fadeOut(0,function(){ $('#addnewcategory').fadeIn(0); })
    }
    
    function addcategorycancel() {
        $('.product-section').fadeOut(0,function(){ $('#list').fadeIn(1); });
    }
    
    function addproduct(){
        $('.product-section').fadeOut(0,function(){ $('#addnewproduct').fadeIn(0); })
    }
    
    function addproductcancel() {
        $('.product-section').fadeOut(0,function(){ $('#list').fadeIn(1); });
    }
    
    function products(catid,sort) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/productslist/'+catid+'/'+sort,
            success: function(data) { $('#productslist').html(data); }
        });
    }
    
    function listedit(durum) {
        if (durum==true) {
            $('.product-menus').fadeOut(0);
            $('.product-edits').fadeIn(0);
            $('#pricebuttons').fadeIn(0);
        }
        else {
            $('.product-menus').fadeIn(0);
            $('.product-edits').fadeOut(0);
            $('#pricebuttons').fadeOut(0);
        }
    }
</script>

</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">
            <div class="editevent-left">
                <div class="top-title">
                    <h2><span>Categories</span></h2>                        
                    <div class="add-product-category-button" onclick="addcategory();">
                        Add New
                    </div>
                </div>
                <div class="product-category-list">
                    <?php 
                    $sql=$this->db->query("select * from product_categories where catid=0 order by reorder asc");
                    foreach($sql->result() as $category) {  ?>
                    <div id="productcategory<?php echo $category->id ?>">
                        <div class="title"><?php echo $category->title ?>
                            <div class="menu">
                                <a href="<?php echo base_url() ?>busycms/editproductcategory/<?php echo $category->id ?>" onclick="location.href='<?php echo base_url() ?>busycms/editproductcategory/<?php echo $category->id ?>'">8</a>
                                <a href="javascript:void(0)" onclick="deletecategory(<?php echo $category->id ?>)">X</a>
                            </div>
                        </div>
                            <?php 
                            $sql2=$this->db->query("select * from product_categories where catid=".$this->db->escape($category->id)."");
                            if ($sql2->num_rows()>0) { echo "<ul>"; }
                            $i=1;
                            foreach($sql2->result() as $subcategory) { ?>
                                <li id="subcategory<?php echo $subcategory->id ?>" <?php if ($i==$sql2->num_rows()) { echo "class=\"last\""; } ?>>
                                    <a href="javascript:void(0);" onclick="location.href='<?php echo base_url() ?>busycms/products/?catid=<?php echo $subcategory->id ?>&sort=<?php echo $sort ?>'" <?php if ($catid==$subcategory->id) { echo "class=\"selected\""; } ?>><?php echo $subcategory->title ?></a>
                                    <div class="menu">
                                        <a href="#" onclick="location.href='<?php echo base_url() ?>busycms/editproductcategory/<?php echo $subcategory->id ?>'">8</a>
                                        <a href="javascript:void(0)" onclick="deletesubcategory(<?php echo $subcategory->id ?>)">X</a>
                                    </div>
                                </li>
                            <?php $i++; } 
                            if ($sql2->num_rows()>0) { echo "</ul>"; }
                            ?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title">
                        <h2><span>Products</span></h2>                        
                    </div>
                    <div onclick="addproduct()" id="product-add-button" onclick>
                        Add Product
                    </div>
                    <div class="fiyatlari-duzenle">
                        Edit Prices
                    </div>
                    <div id="fiyat-duzenle-check">
                        <input type="checkbox" onclick="listedit(this.checked)" />
                    </div>
                    <div class="product-sorts">
                        Order: 
                        <a <?php if ($sort=="a") { echo "class=\"selected\""; } ?> href="javascript:void(0)" onclick="location.href='<?php echo base_url() ?>busycms/products/?catid=<?php echo $catid ?>&sort=a'">ALPHABETIC</a>
                        <a <?php if ($sort=="p") { echo "class=\"selected\""; } ?> href="javascript:void(0)" onclick="location.href='<?php echo base_url() ?>busycms/products/?catid=<?php echo $catid ?>&sort=p'">PRICE</a>
                        <!-- <a <?php if ($sort=="s") { echo "class=\"selected\""; } ?> href="javascript:void(0)" onclick="location.href='<?php echo base_url() ?>busycms/products/?catid=<?php echo $catid ?>&sort=s'">STOCK</a> -->
                    </div>
                    <div id="productslist">
                        
                    </div>
                </div>
                <div class="product-section" id="addnewcategory">
                    <div class="top-title">
                        <h2><span>Create New Category</span></h2>                        
                    </div>
                    <div style="padding:20px;">
                        <form name="addnewproductcategoryform" id="addnewproductcategoryform" onSubmit="return false;">
                            <b>Main Category</b><br/>
                            <span>Select the Main Category</span>
                            <select name="catid">
                                <option value="0">Main Category</option>
                                <?php $sql=$this->db->query("select * from product_categories where catid=0");
                                foreach($sql->result() as $category) { ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <b>Category Title</b><br/>
                            <span>Please enter the Product Category name</span>
                            <input type="text" name="title" /><br/><br/>
                            <div align="right">
                                <button style="margin-right:10px;" onclick="addcategorycancel()">Cancel</button>
                                <button onClick="submitform('busycms/','addnewproductcategoryform'); return false;">Add Category</button>                    
                        </div>
                        </form>
                        <div id="addnewproductcategoryform_back"></div>
                    </div>
                </div>
                <div class="product-section" id="addnewproduct">
                    <div class="top-title">
                        <h2><span>Create New Product</span></h2>                        
                    </div>
                    <div style="padding:20px;">
                        <form name="addnewproductform" id="addnewproductform" onSubmit="return false;">
                            <b>Product Category</b><br/>
                            <span>Select the Product Category</span>
                            <select name="catid">
                                <option value="0">Select Product Category</option>
                                <?php 
                                $sql=$this->db->query("select * from product_categories where catid=0");
                                foreach($sql->result() as $category) 
                                { ?>
                                    
                                    <optgroup label="<?php echo $category->title ?>">
                                        <?php 
                                        $sql2=$this->db->query("select * from product_categories where catid=".$this->db->escape($category->id)."");
                                        if ($sql2->num_rows()>0) { echo "<ul>"; }
                                        foreach($sql2->result() as $subcategory) { ?>
                                            <option value="<?php echo $subcategory->id ?>"><?php echo $subcategory->title ?></option>
                                        <?php } 
                                        
                                }?>
                            </select>
                            <br/><br/>
                            <b>Product Title</b><br/>
                            <span>Please enter the Product Category name</span>
                            <input type="text" name="title" /><br/><br/>
                            <div align="right">
                            <button style="margin-right:10px;" onclick="addproductcancel()">Cancel</button>
                            <button onClick="submitform('busycms/','addnewproductform'); return false;">Add Product</button>                    
                        </div>
                        </form>
                        <div id="addnewproductform_back"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="sezgin"></div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>
    <?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>