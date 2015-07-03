﻿<?php 
$this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/jquery.Jcrop.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>busycms/static/stylesheets/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">

            jQuery(function($){

                // Create variables (in this scope) to hold the API and image size
                var jcrop_api, boundx, boundy;
      
                $('#target').Jcrop({
                    onChange: updatePreview,
                    onSelect: updatePreview,
                    onSelect: updateCoords
                    //aspectRatio: 4/2
                },function(){
                    // Use the API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];
                    // Store the API in the jcrop_api variable
                    jcrop_api = this;
                });
      
                function updatePreview(c)
                {
                    if (parseInt(c.w) > 0)
                    {
                        var rx = 250 / c.w;
                        var ry = 100 / c.h;

                        $('#preview').css({
                            width: Math.round(rx * boundx) + 'px',
                            height: Math.round(ry * boundy) + 'px',
                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                        });
                        
                        $('#width').html(c.w);
                        $('#height').html(c.h);
                        
                    }
                };

            });
    
            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
                
            };

            function checkCoords()
            {
                if (parseInt($('#w').val())) return true;
                alert('Please select a crop region then press submit.');
                return false;
            };
               
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
            <div class="section" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <?php 
                $sql=$this->db->query("select * from images where id=".$imageid." order by reorder asc");
                foreach($sql->result() as $image) {  ?>
                <div id="cropimageform_back"></div>
                <div class="cropimage">
                    <form id="cropimageform" method="post" onSubmit="return false;">
                        <input type="hidden" name="id" value="<?php echo $image->id ?>" />
                        <input type="hidden" name="pageid" value="<?php echo $image->pageid ?>" />
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" /><br/>
                        <div align="right">
                            <span id="width"></span>px X <span id="height"></span>px
                        <button onClick="submitform('busycms/','cropimageform')">Crop Image</button>
                        </div>
                    </form>
                    <div style="overflow:auto;">
                    <img src="<?php echo base_url() ?>/uploads/<?php echo $image->image ?>" id="target"  />
                    </div>
                    <div style="width:200px;height:100px;overflow:hidden;display:none;">
                        <img src="<?php echo base_url() ?>/uploads/<?php echo $image->image ?>" id="preview" alt="Preview" width="200" />
                    </div>
                </div>
                <?php }?>
                
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