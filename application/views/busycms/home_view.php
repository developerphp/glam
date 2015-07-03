<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Busy Cms</title>
        <meta name="description" content="Busy Cms" />
        <script src="<?php echo base_url() ?>js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/jquery.Jcrop.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>styles/jquery.Jcrop.css" type="text/css" />
        <script type="text/javascript">

            jQuery(function($){

                // Create variables (in this scope) to hold the API and image size
                var jcrop_api, boundx, boundy;
      
                $('#target').Jcrop({
                    onChange: updatePreview,
                    onSelect: updatePreview,
                    onSelect: updateCoords,
                    aspectRatio: 4/2
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
                            marginTop: '-' + Math.round(ry * c.y) + 'px',
                        });
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

            function submitform(linki,form){
                $.ajax({  
                    type: 'POST',
                    url: '<?php echo base_url() ?>'+linki+form+'_do',
                    data: $('#'+form).serialize(),
                    error:function(){ $('#'+form+'_back').html("Hata Var."); }, 
                    success: function(veri) { 
                        $('#'+form+'_back').html(veri);
                    }
                });
                return false;
            }

        </script>
    </head>
    <body>
        <form method="post" action="<?php echo base_url() ?>busycms/uploadimage" enctype="multipart/form-data" target="ajax">
            <input name="images[]" type="file" min="1" max="3" multiple="multiple" />
            <input type="submit" value="Send">
        </form>
        <iframe id="ajax"></iframe>


        <div id="cropform_back"></div>
        <table>
            <tr>
                <td>
                    <img src="<?php echo base_url() ?>/uploads/_deniztaksitelefon4444498.jpg" id="target" alt="Flowers" />
                </td>
                <td>
                    <div style="width:200px;height:100px;overflow:hidden;">
                        <img src="<?php echo base_url() ?>/uploads/_deniztaksitelefon4444498.jpg" id="preview" alt="Preview" width="200" />
                    </div>
                    <form id="cropform" method="post" onSubmit="return false;">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <button onclick="submitform('busycms/','cropform')">Crop</button>
                    </form>
                </td>
            </tr>
        </table>


    </body>
</html>