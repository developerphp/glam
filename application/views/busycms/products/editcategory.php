<?php 
$this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
    $(document).ready(function() {
        $.initialize();
        $.demo();        
    });
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
                echo "<span>".$category->title."</span>";
                ?>
                </div>
            </div>
            <div id="editproductcategory_back"></div>
            <div class="editevent-left">
                <div id="eventimage">
                    <?php if (strlen($category->image)==0) { ?>
                    <img src="<?php echo base_url() ?>busycms/images/add-product-picture.jpg" width="300" onclick="$('#myfile').click();" style="cursor:pointer;" />
                    <?php } else { ?>
                    <div class="eventmainimage" onclick="$('#myfile').click();" style="cursor:pointer;">
                    <img src="<?php echo base_url() ?>uploads/<?php echo $category->image ?>" width="300" />
                    
                    </div>
                    <?php } ?>
                    <div style="width:0px;height:0px;overflow:hidden;">
                    <form id="uploadimage" action="<?php echo base_url() ?>busycms/productcategoryimage/<?php echo $category->id ?>" method="post" enctype="multipart/form-data" target="ajax">
                        <input name="resim" type="file" id="myfile" style="height:30px;" onchange="$('#uploadimage').submit();" />
                    </form>
                    <iframe id="ajax"></iframe>     
                    </div>
                </div>
            </div>
            <div class="editevent-right">
                <div id="editcontent">
                    <form name="editproductcategory" id="editproductcategory" onSubmit="return false;">
                        <b>Name of Category</b><br/>
                    <span>Please enter the name of the Category </span>
                    <input type="text" name="title" value="<?php echo $category->title ?>" />
                    <input type="hidden" name="id" value="<?php echo $category->id ?>" />
                    <br/>
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <b>Description of Category</b><br/>
                    <span>Please enter the category description</span>
                    <textarea id="editor1" name="content"><?php echo $category->description ?></textarea>
                    <script type="text/javascript">
                            CKEDITOR.replace( 'editor1',
                                    {
                                            extraPlugins : 'uicolor',
                                            uiColor: '#dee9e9',
                                            toolbar :
                                            [
                                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak']
                                            ]
                                    });
                    </script><br />
                    <div class="clear"></div>
                    </form><br/><br/>
                    <div align="right">
                    <button class="eventbutton" onClick="CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editproductcategory'); return false;" style="right:150px;">Update and Close</button>
                    </div>
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