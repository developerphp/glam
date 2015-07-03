<?php 
$this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
               
    $(document).ready(function() {
        $.initialize();
        $.demo();
    });
	
	/*jQuery(window).bind(
		"beforeunload", 
		function() { 
			return confirm("Sayfayı kaydettiğinizden lütfen emin olun") 
                }
	)*/
    
    function videoadd(id)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/designervideoadd/"+id,
            padding:    "30px"
            //animation:  "flipInX"
        });
    }
    
    function soundadd(id)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/soundadd/"+id,
            padding:    "30px"
            //animation:  "flipInX"
        });
    }
    
    function editvideo(id)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/designereditvideo/"+id,
            padding:    "30px"
            //animation:  "flipInX"
        });
    }
    
    function editsound(id)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/editsound/"+id,
            padding:    "30px"
            //animation:  "flipInX"
        });
    }
    
    function artists(id) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/eventartists/'+id,
            success: function(data) { $('#artists').html(data); }
        });
    }
    
    function editartist(id,eventid) {
            $('ul.artistlist li b').css('font-weight','normal');
            $('ul.artistlist li#artist'+id+' b').css('font-weight','bold');
            $('.leftmenu ul li a').css('font-weight','normal');
            $('#editartistlink a').css('font-weight','bold');
            $('#editcontent').fadeOut(500,function(){ 
            $('.eventbutton').fadeOut(1); 
            $('.newartistsavebutton').fadeOut(1); 
            $('#addnewartist').fadeOut(1);
            $.ajax({
            url: '<?php echo base_url() ?>busycms/editartist/'+id+'/'+eventid,
            success: function(data) {  $('.artistsavebutton').fadeIn(1); $('#editartist').fadeIn(500);$('#editartist').html(data);
              
        }
            });
        })
    }
    
    function deletevideo(id)
    {
        alert('asd');
        $.ajax({
        url: '<?php echo base_url() ?>busycms/designerdeletevideo/'+id,
        success: function(data) { $('#sezgin').html(data); }
                });
    }
    
    function videos(id) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/designervideos/'+id,
            success: function(data) { $('#artistvideolist').html(data); }
        });
    }
    

    function deletevideobutton(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is video <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletevideo('+id+')">Yes</a> or \n\
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
    
    
    function view(div) {
        $('.inputs').hide(1);
        $('.'+div).show(1);
    }
    
    
    function deleteimage(id) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deleteimagedesigner/'+id,
		  success: function(data) { 
                       $('#sezgin').html(data);
              }
		});
    }

    function edit(id) {
        $('#menu'+id).fadeOut(200,function() {
            $('#edit'+id).fadeIn(200);
        })
    }
    
    function photos(id) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/designerphotos/'+id,
		  success: function(data) { 
                       $('#eventphotos').html(data);
              }
        });
    }
    
    function publish(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/designerpublish/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
</script>
<style>
    .inputs { display:none }
    .whoinputs { display:block; }
    .wheninputs { display:none; }
    .whereinputs { display:none; }
    .detailinput { display:none; }
    .videosinput { display:none; }
</style>
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
            <div id="editdesigner_back"></div>
            <div class="editevent-left">
                <div id="eventimage" style="margin-left:5px;">                    
                    <?php if (strlen($designer->image)==0) { ?>                    
                    <img src="<?php echo base_url() ?>busycms/images/add-photo-big.png" id="poimage" onClick="$('#imagemyfile').click();" style="cursor:pointer;" width="290" />
                    <?php } else { ?>
                    <div class="eventimage" onClick="$('#imagemyfile').click();" style="cursor:pointer;">
                    <img src="<?php echo base_url() ?>uploads/<?php echo $designer->image ?>" id="poimage" width="300" />
                    <div class="menu"></div>
                    </div>
                    <?php } ?>
                    <span style="display:block;text-align: center;padding:10px;color:#67686a;">440px X 440px </span>
                    <div style="width:0px;height:0px;overflow:hidden;">
                    <form id="uploadimagedesigner" name="uploadimagedesigner" action="<?php echo base_url() ?>busycms/designerimageupload/<?php echo $designer->id ?>" method="post" enctype="multipart/form-data" target="imageajax">
                        <input name="resim" type="file" id="imagemyfile" style="height:30px;" onChange="$('#uploadimagedesigner').submit();" />
                    </form>
                    <iframe id="imageajax"></iframe>     
                    </div>
                </div>                
            </div>
            <div class="editevent-right">
                <div id="editcontent">
                    <h1>
                        <?php if ($designer->tip==1) { echo "Designer"; } else {  echo "Brand"; } ?>
                        Information</h1>
                    <form name="editdesigner" id="editdesigner" onSubmit="return false;">
                        <div><b><?php if ($designer->tip==1) { echo "Designer"; } else {  echo "Brand"; } ?> Name</b><br/>
                            <span>Please enter the name </span>
                            <input type="text" name="title" value="<?php echo $designer->title ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Style</b><br/>
                            <span>Please enter the style </span>
                            <input type="text" name="style" value="<?php echo $designer->style ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Website</b><br/>
                            <span>Please enter the website </span>
                            <input type="text" name="website" value="<?php echo $designer->website ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Email</b><br/>
                            <span>Please enter the email </span>
                            <input type="text" name="email" value="<?php echo $designer->email ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Pinterest</b><br/>
                            <span>Please enter the pinterest </span>
                            <input type="text" name="pinterest" value="<?php echo $designer->pinterest ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Facebook</b><br/>
                            <span>Please enter the facebook </span>
                            <input type="text" name="facebook" value="<?php echo $designer->facebook ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Twitter</b><br/>
                            <span>Please enter the twitter </span>
                            <input type="text" name="twitter" value="<?php echo $designer->twitter ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Instagram</b><br/>
                            <span>Please enter the instagram </span>
                            <input type="text" name="instagram" value="<?php echo $designer->instagram ?>" />
                        </div>
                        <div style="margin-top:20px;">
                            <b>Page Content</b><br/>
                        <span>Please enter the page content</span>
                        <textarea id="editor1" name="content"><?php echo $designer->content ?></textarea>
                                <script type="text/javascript">
                                        CKEDITOR.replace( 'editor1',
                                                {
                                                        extraPlugins : 'uicolor',
                                                        enterMode	 : Number(2),
                                                        uiColor: '#dee9e9',
                                                        toolbar :
                                                        [
                                                                [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak', 'RemoveFormat']
                                                        ]
                                                });
                                </script>
                        </div>
                        <div class="clear"></div><br/>                    
                    <input type="hidden" name="savepublish" id="savepublish" value="<?php echo $designer->publish ?>" />
                    <input type="hidden" name="id" value="<?php echo $designer->id ?>" />
                    <input type="hidden" name="saveclose" id="saveclose" value="0" />
                    <div class="clear"></div>                                        
                    </form><br/><br/>
                    <div align="right">
                    <button class="eventbutton" onClick="$('#savepublish').val(0);CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editdesigner'); return false;" style="right:300px;">Update Info</button>
                    <button class="eventbutton" onClick="$('#saveclose').val(1);CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editdesigner'); return false;" style="right:150px;">Update and Close</button>
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