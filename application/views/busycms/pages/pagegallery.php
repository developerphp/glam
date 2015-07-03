<?php 
$this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.mouse.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.sortable.js"></script>
<script>
               
      $(function() {
    $(".images").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var katid=document.getElementById("orderkatid").value;																				
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings&katid='+katid; 
            $.post("<?php echo base_url() ?>busycms/categoryorderupdate", order, function(theResponse){
                    $("#sezgin").html(theResponse);
            }); 		
    }								  
    });
    });
               
    $(document).ready(function() {
        $.initialize();
        $.demo();
    });

    function deleteimage(id) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deleteimage/'+id,
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
</script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con">
            <div class="section" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <div class="uploadform">
                            <form method="post" action="<?php echo base_url() ?>busycms/uploadimage/<?php echo $p->id ?>" enctype="multipart/form-data" target="ajax">
                                <input name="images[]" type="file" min="1" max="30" multiple="multiple" /><br/><br/>
                                <input type="submit" value="Upload">
                            </form>
                </div>
                <div class="imageslist">
                    <div id="imagelist">
                        <ul class="images">
                            <?php 
                            $sql=$this->db->query("select * from images where pageid=".$p->id." order by reorder asc");
                            foreach($sql->result() as $image) {  ?>
                            <li id="recordsArray_<?php echo $image->id ?>">
                                <div class="image">
                                <img src="<?php echo base_url() ?>uploads/thumb_<?php echo $image->image ?>" />
                                </div>
                                <div class="menus">
                                    <table width="100%" height="100%">
                                        <tr>
                                            <td style="vertical-align:middle;">
                                                <div id="menu<?php echo $image->id ?>">
                                    <a href="<?php echo base_url() ?>busycms/mainimage/<?php echo $p->id ?>/<?php echo $image->id ?>">Main Image</a><br/>
                                    <a href="<?php echo base_url() ?>busycms/cropimage/<?php echo $p->id ?>/<?php echo $image->id ?>">Crop Image</a><br/>
                                    <a href="javascript:void(0)" onclick="edit(<?php echo $image->id ?>)">Edit Image</a><br/>
                                    <a href="javascript:void(0)" onclick="$('#menu<?php echo $image->id ?>').fadeOut(100,function(){ $('#delete<?php echo $image->id ?>').fadeIn(100)});">Delete Image</a>
                                    
                                                </div>
                                    <div id="edit<?php echo $image->id ?>" class="imageedit">
                                        <form id="imageeditform<?php echo $image->id ?>" onsubmit="return false;">
                                            <div id="imageeditform<?php echo $image->id ?>_back">
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $image->id ?>" />
                                            <textarea name="description"><?php echo $image->description ?></textarea>
                                            <div align="right">
                                                <button onclick="submitform('busycms/imageeditform/','imageeditform<?php echo $image->id ?>')">Kaydet</button>
                                            </div>
                                        </form>
                                    </div>                                                
                                    <div id="delete<?php echo $image->id ?>" style="display:none;" class="delete">
                                        Delete image<br/>
                                        <span onclick="deleteimage(<?php echo $image->id ?>)">yes</span> or <span onclick="$('#delete<?php echo $image->id ?>').fadeOut(100,function(){ $('#menu<?php echo $image->id ?>').fadeIn(100)});">no</span>
                                    </div>
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                            </li>
                            <?php } ?>
                            <li id="lastimage">
                                
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div><br/>
        <iframe id="ajax" style="border:none;width:250px;"></iframe>            </div>
            <div id="sezgin">

            </div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>

<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>