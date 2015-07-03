<?php 
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
                    onSelect: updateCoords,
                    bgFade:     true,
                    bgOpacity: .2,
                    aspectRatio: 4/2,
                    setSelect: [0,0,310,170]
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
                        var rx = 310 / c.w;
                        var ry = 170 / c.h;

                        $('#preview').css({
                            width: Math.round(rx * boundx) + 'px',
                            height: Math.round(ry * boundy) + 'px',
                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                            marginTop: '-' + Math.round(ry * c.y) + 'px'
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
                <div class="top-title" style="height:30px;overflow:hidden;">    
                <div class="detail-title gun<?php echo $gun ?>">
                <?php
                $tr_ay = array('OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKİ', 'KAS', 'ARA');
            $gunler = array('PZR', 'PZT', 'SAL', 'ÇRŞ', 'PRŞ', 'CUM', 'CMT');
                echo "<b>".strftime("%d", strtotime($event->eventdate))."</b> ".$tr_ay[intval(strftime("%m", strtotime($event->eventdate))-1)]. " " . $gunler[$gun] . "<label>[" . $event->eventclock . ":".$event->eventminute."]</label><strong>".$event->title."</strong> resize event image";
                ?>
                <form id="cropformeventmainimage" method="post" onSubmit="return false;">
                        <input type="hidden" name="id" value="<?php echo $event->id ?>" />
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" /><br/>
                        <div align="right">
                        <button onclick="submitform('busycms/','cropformeventmainimage')">Crop and set as event image</button>
                        </div>
                    </form>
                </div>
            </div>
                <div id="cropformeventmainimage_back"></div>
                    <center>
                    <img src="<?php echo base_url() ?>/uploads/<?php echo $event->image ?>" id="target"  />
                    </center>
                    <div class="clear"></div>
                
                <div class="clear"></div><br/>
        <iframe id="ajax" style="border:none;width:200px;"></iframe>            
            <div id="sezgin">

            </div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>

<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>