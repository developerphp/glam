<?php 
$this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
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
        <div class="scroll con">
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <ul class="tabs pagecol0" onMouseMove="$('#orderkatid').val(0)">                   
                        <?php if (strlen($p->image) == 0) { ?>
                        <img id="bigimage" src="<?php echo base_url() ?>busycms/images/add-photo-big.png" width="275" onClick="$('#myfile').click();" style="cursor:pointer;" />
                    <?php } else { ?>
                        <div class="eventmainimage" onClick="$('#myfile').click();" style="cursor:pointer;">
                            <img id="bigimage" src="<?php echo base_url() ?>uploads/<?php echo $p->image ?>" width="275" />
                        </div>
                    <?php } ?>
                        <div style="width:0px;height:0px;overflow:hidden;">
                        <form id="uploadimage" action="<?php echo base_url() ?>busycms/pagemainimageupload/<?php echo $p->id ?>" method="post" enctype="multipart/form-data" target="ajax">
                            <input name="resim" type="file" id="myfile" style="height:30px;" onChange="$('#uploadimage').submit();" />
                        </form>
                        <iframe id="ajax" name="ajax"></iframe>     
                    </div>
                </ul>
                <div class="editcontent">
                    <form name="editpageform" id="editpageform" onSubmit="return false;">
                        <b>Page Title English</b><br/>
                        <span>Please enter the page title</span>
                        <input type="text" name="title" value="<?php echo $p->title ?>" /><br/>
                        <br/>
                        <b>Page Title English</b><br/>
                        <span>Please enter the page title</span>
                        <input type="text" name="title2" value="<?php echo $p->title2 ?>" /><br/>
                        <input type="hidden" name="saveclose" id="saveclose" value="0" />
                        <input type="hidden" name="id" value="<?php echo $p->id ?>" />
                        <?php if ($p->catid==80) { ?>
                        <b>News Date</b><br/>
                        <span>Please enter the news date</span>
                        <input type="text" name="news_date" value="<?php echo $p->news_date ?>" /><br/>
                        <b>News Link</b><br/>
                        <span>Please enter the news link</span>
                        <input type="text" name="link" value="<?php echo $p->link ?>" /><br/>                        
                        <?php } ?>
                        <!--<b>Page Description</b><br/>
                        <span>Please enter the page description</span>
                        <textarea name="description" style="padding-left:10px;"><?php echo $p->description ?></textarea><br/>
                        <b>Page Tags</b><br/>
                        <span>Please enter the page tags</span>
                        <input type="text" name="tags" value="<?php echo $p->tags ?>" /><br/>-->
                        <div <?php if ($p->catid==80) { ?> style="display:none;" <?php } ?>>
                        <b>Page Content</b><br/>
                        <span>Please enter the page content</span>
                        <textarea id="editor1" name="content"><?php echo $p->content ?></textarea>
                        <script type="text/javascript">
                                CKEDITOR.replace( 'editor1',
                                        {
                                                extraPlugins : 'uicolor',
                                                enterMode	 : Number(2),
                                                uiColor: '#dee9e9',
                                                toolbar :
                                                [
                                                        [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                                ]
                                        });
                        </script>
                        </div>
                        <br/><br/>
                        <div>
                            <b>Page Content English</b><br/>
                        <span>Please enter the page content</span>
                        <textarea id="editor2" name="content2"><?php echo $p->content2 ?></textarea>
                                <script type="text/javascript">
                                        CKEDITOR.replace( 'editor2',
                                                {
                                                        extraPlugins : 'uicolor',
                                                        enterMode	 : Number(2),
                                                        uiColor: '#dee9e9',
                                                        toolbar :
                                                        [
                                                                [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat','Source']
                                                        ]
                                                });
                                </script>
                        </div>
                                <div class="buttons">
                                    <button onClick="$('#saveclose').val(0);CKEDITOR.instances['editor1'].updateElement();CKEDITOR.instances['editor2'].updateElement();submitform('busycms/','editpageform'); return false;">Save</button>
                                    <button onClick="$('#saveclose').val(1);CKEDITOR.instances['editor1'].updateElement();CKEDITOR.instances['editor2'].updateElement();submitform('busycms/','editpageform'); return false;">Save & Close</button>
<!--                                    <button class="pagegallery" onClick="location.href='<?php echo base_url() ?>busycms/pagegallery/<?php echo $p->id ?>'">Page Gallery</button>-->
                                </div>
                                <div class="clear"></div>
                                <div id="editpageform_back">
                                    
                                </div>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
            <div id="sezgin">

            </div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>

<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>