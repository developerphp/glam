<?php $this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
    $(document).ready(function() {
        photos(<?php echo $product->id ?>);
        $.initialize();
        $.demo();        
    });
    
    function newcolorshow() {
        $('.colorsavebutton').fadeOut(1);
        $('#editcolor').fadeOut(500);        
        $('#editcontent').fadeOut(500,function(){ $('.eventbutton').fadeOut(1); $('.newcolorsavebutton').fadeIn(1); $('#addnewcolor').fadeIn(500); })
    }
    
    function eventinfo() {
        $('.colorsavebutton').fadeOut(1);
        $('ul.colorlist li b').css('font-weight','normal');
        $('.newcolorsavebutton').fadeOut(1);
        $('.eventbutton').fadeIn(1); 
        $('#addnewcolor').fadeOut(500);
        $('#editcolor').fadeOut(500);
        $('#editcontent').fadeIn(500);
        $('.leftmenu ul li a').css('font-weight','normal');
        $('#eventinfolink a').css('font-weight','bold');
    }
    
    function deleteimageapproval(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is image <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteimage('+id+')">Yes</a> or \n\
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
    
    function deleteimage(id) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deleteimage/'+id,
		  success: function(data) { 
                       $('#sezgin').html(data);
              }
		});
    }
    
    function photos(id) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/productphotos/'+id,
		  success: function(data) {
                       $('#gallery').html(data);
              }
        });
    }
</script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">
            <table style="display:none;">
                <tr>
                    <td>

                    </td>
                </tr>
            </table>
            <div class="top-title">    
                <div class="detail-title">
                    <?php
                    echo "<span>" . $product->title . "</span>";
                    ?>
                </div>
            </div>
            <div id="editproductform_back"></div>
            <div class="editevent-left" style="height:1500px;">
                <div id="eventimage" align="center">                    
                    <div style="font-style: italic;padding:10px 0;">
                    List Image <?php if ($product->maincat==4) { echo "( 193x327 )"; } elseif (($product->maincat==6 or $product->maincat==7)) { echo "( 800x800 )"; } ?></div>
                    <?php if (strlen($product->image) == 0) { ?>
                        <img id="bigimage" src="<?php echo base_url() ?>busycms/images/add-product-picture.jpg" width="300" onclick="$('#myfile').click();" style="cursor:pointer;" />
                    <?php } else { ?>
                        <div class="eventmainimage" onclick="$('#myfile').click();" style="cursor:pointer;">
                            <img id="bigimage" src="<?php echo base_url() ?>uploads/<?php echo $product->image ?>" width="300" />
                        </div>
                    <?php } ?>

                    <?php if (($product->maincat==6 or $product->maincat==7)) { ?>
                        <br/><br/>
                        <div style="font-style:italic;padding:10px 0;">Detail Image (800x800)</div>
                        <?php if (strlen($product->detail_image) == 0) { ?>
                        <img id="detailimage" src="<?php echo base_url() ?>busycms/images/add-product-picture.jpg" width="300" onclick="$('#detailmyfile').click();" style="cursor:pointer;" />
                        <?php } else {?>
                        <div onclick="$('#detailmyfile').click();" style="cursor:pointer;">
                            <img id="detailimage" src="<?php echo base_url() ?>uploads/<?php echo $product->detail_image ?>" width="300" />
                        </div>
                        <?php }?>
                    <?php } ?>

                    <div<?php if ($product->maincat==4) { echo ' style="display:none"'; } ?>>
                    <div style="font-style: italic;padding:10px 0;margin-top:20px;">Sperator Gorsel ( 1440x880 )</div>
                    <?php if (strlen($product->banner) == 0) { ?>
                        <img id="bigimage2" src="<?php echo base_url() ?>busycms/images/add-product-picture.jpg" width="300" onclick="$('#myfile2').click();" style="cursor:pointer;" />
                    <?php } else { ?>
                        <div class="eventmainimage" onclick="$('#myfile2').click();" style="cursor:pointer;">
                            <img id="bigimage2" src="<?php echo base_url() ?>uploads/<?php echo $product->banner ?>" width="300" />
                        </div>
                    <?php } ?>
                    </div>
                    <div style="width:0px;height:0px;overflow:hidden;">
                        <form id="uploadimage" name="uploadimage" action="<?php echo base_url() ?>busycms/productmainimageupload/<?php echo $product->id ?>" method="post" enctype="multipart/form-data" target="ajax">
                            <input name="resim" type="file" id="myfile" style="height:30px;" onchange="$('#uploadimage').submit();" />
                        </form>
                        <iframe id="ajax" name="ajax"></iframe>     
                    </div>
                    <div style="width:0px;height:0px;overflow:hidden;">
                        <form id="uploadimagedetail" name="uploadimagedetail" action="<?php echo base_url() ?>busycms/productdetailimageupload/<?php echo $product->id ?>" method="post" enctype="multipart/form-data" target="ajaxxxxx">
                            <input name="resim" type="file" id="detailmyfile" style="height:30px;" onchange="$('#uploadimagedetail').submit();" />
                        </form>
                        <iframe id="ajaxxxxx" name="ajaxxxxx"></iframe>     
                    </div>
                    <div style="width:0px;height:0px;overflow:hidden;">
                        <form id="uploadimage2" name="uploadimage2" action="<?php echo base_url() ?>busycms/productmainimageupload2/<?php echo $product->id ?>" method="post" enctype="multipart/form-data" target="ajaxxx">
                            <input name="resim" type="file" id="myfile2" style="height:30px;" onchange="$('#uploadimage2').submit();" />
                        </form>
                        <iframe id="ajaxxx" name="ajaxxx"></iframe>     
                    </div>
                </div>
                <!--                <div class="leftmenu">
                                    <ul>
                                        <li id="eventinfolink">
                                            <a href="javascript:void(0);" onclick="eventinfo();" style="font-weight:bold;">Product Info</a>
                                        </li>
                                        <li id="editcolorlink">
                                            <a href="javascript:void(0);">Colors</a>
                                            <span onclick="newcolorshow()">+ Add color</span>
                                        </li>
                                    </ul>
                                </div>
                                <div id="colors">                    
                                </div>-->
            </div>
            <div class="editevent-right">
                <div id="editcontent">
                    <form name="editproductform" id="editproductform" onSubmit="return false;">
                        <h1>General</h1>                        
                        <b>Name of Product</b><br/>
                        <span>Please enter the name of the product </span>
                        <input type="text" name="title" value="<?php echo $product->title ?>" />
                        <input type="hidden" name="id" value="<?php echo $product->id ?>" />
                        <input type="hidden" name="saveclose" id="saveclose" value="0">
                        <input type="hidden" name="catid" value="<?php echo $product->catid ?>" />                        
                        <?php if (($product->maincat==6 or $product->maincat==7)) { ?>
                        <div><br/>
                        <b>Benefits</b><br/>
                        <span>Select the Benefits</span>
                        <select name="benefits[]" multiple="multiple">
                            <option selected value="0">Select Benefit</option>
                            <?php
                            $benefits=explode(',',$product->benefits);
                            $sql2 = $this->db->query("select * from products where maincat=4 order by title asc");
                            if ($sql2->num_rows() > 0) {
                                echo "<ul>";
                            }
                            foreach ($sql2->result() as $subcategory) { ?>
                                <option value="<?php echo $subcategory->id ?>" <?php if (in_array($subcategory->id,$benefits)) { echo "selected=\"selected\""; } ?>><?php echo $subcategory->title ?></option>
                            <?php }  ?>
                        </select>
                        <br/>
                        </div>
                        <?php }?>

                        <?php if ($product->maincat==4) { ?>
                        <br/>                        
                        <b>Ingredients of Product</b><br/>
                        <span>Please enter the ingredients of the product </span>
                        <textarea name="ingredients" style="padding:10px;" rows="10"><?php echo $product->ingredients ?></textarea>
                        <?php }?>

                        <?php if (($product->maincat==6 or $product->maincat==7)) { ?>
                        <br/>                        
                        <b>List Description</b><br/>
                        <span>Please enter the list description of the product </span>
                        <textarea name="description" style="padding:10px;" rows="10"><?php echo $product->description ?></textarea>
                        <br/>                        
                        <b>Detail Description</b><br/>
                        <span>Please enter the detail description of the product </span>
                        <textarea name="detail_description" style="padding:10px;" rows="10"><?php echo $product->detail_description ?></textarea>
                        <?php }?>
                        <?php if ($product->maincat==4) { ?>
                        <br/>
                        <b>Content of Product</b><br/>
                        <span>Please enter the product content</span>
                        <textarea id="editor2" name="content"><?php echo $product->content ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'editor2',
                            {
                                extraPlugins : 'uicolor',
                                uiColor: '#dee9e9',
                                toolbar :
                                    [
                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                ]
                            });
                        </script>

                        <div style="display:none;">
                        <textarea id="editor3" name="content2"><?php echo $product->content2 ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'editor3',
                            {
                                extraPlugins : 'uicolor',
                                uiColor: '#dee9e9',
                                toolbar :
                                    [
                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                ]
                            });
                        </script>
                        </div>
                        <?php } elseif (($product->maincat==6 or $product->maincat==7)) { ?>
                        <br/>
                        <div>
                        <br/>                        
                        <b>Long Description Title</b><br/>
                        <span>Please enter the long description title of the product </span>
                        <input type="text" name="long_title" value="<?php echo $product->long_title ?>">
                        <br/>
                        <b>Long Description of Product</b><br/>
                        <span>Please enter the long description</span>
                        <textarea id="editor2" name="content"><?php echo $product->content ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'editor2',
                            {
                                extraPlugins : 'uicolor',
                                uiColor: '#dee9e9',
                                toolbar :
                                    [
                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                ]
                            });
                        </script>
                        <br/>
                        <b>Long Description 2 Title</b><br/>
                        <span>Please enter the long description title of the product </span>
                        <input type="text" name="long_title2" value="<?php echo $product->long_title2 ?>">
                        <br/>
                        <br/>
                        <b>Long Description 2 of Product</b><br/>
                        <span>Please enter the product content</span>
                        <textarea id="editor3" name="content2"><?php echo $product->content2 ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'editor3',
                            {
                                extraPlugins : 'uicolor',
                                uiColor: '#dee9e9',
                                toolbar :
                                    [
                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                ]
                            });
                        </script>
                        </div>
                        <?php }?>
                         <div class="clear"></div><br/>
                        <h1>Sale Information</h1>
                        <div style="width:150px;float:left;"> <b>Price</b><br/>
                            <span>Price of Product </span>
                            <input type="text" name="price" value="<?php echo $product->price ?>" style="width:100px;" placeholder="TL" />
                        </div>
                        <div class="clear"></div>
                        <div class="clear"></div>
                    </form><br/><br/>
                    <div align="right">
                        <button style="margin-right:20px;" onclick="location.href='<?php echo base_url() ?>busycms/products/?catid=<?php echo $product->catid ?>'">Close</button>
                        <button class="eventbutton" onClick="CKEDITOR.instances['editor2'].updateElement();CKEDITOR.instances['editor3'].updateElement();submitform('busycms/','editproductform'); return false;" style="right:150px;">Update</button>
                        <button class="eventbutton" onClick="CKEDITOR.instances['editor2'].updateElement();CKEDITOR.instances['editor3'].updateElement();$('#saveclose').val(1);submitform('busycms/','editproductform'); return false;" style="right:150px;">Update and Close</button>
                    </div>
                </div>
                <div id="gallery">
                </div>
                
            </div>
            <div class="clear"></div>
            <div id="sezgin"></div>
        </div>     
    </div>
    <div id="sezgin"></div>
<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>