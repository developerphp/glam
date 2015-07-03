<?php 
$this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
               
    $(document).ready(function() {

        videos();
        sounds();
        artists(<?php echo $event->id ?>);
        
        $.initialize();
        $.demo();
        
        
        
        
        
    });
    
    
    function videoadd(id)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/videoadd/"+id,
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
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deletevideo/'+id,
        success: function(data) { $('#sezgin').html(data); }
                });
    }
    
    function deletesound(id)
    {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deletesound/'+id,
        success: function(data) { $('#sezgin').html(data); }
                });
    }
    
    function deleteartistdo(id)
    {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/deleteartist/'+id+'/<?php echo $event->id ?>',
        success: function(data) { $('#sezgin').html(data); }
                });
    }
    
    function videos(id) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/videos/'+id,
            success: function(data) { $('#artistvideolist').html(data); }
        });
    }
    
    function sounds(id) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/sounds/'+id,
            success: function(data) { $('#artistsoundslist').html(data); }
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
    
    function deletesoundbutton(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is sound <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletesound('+id+')">Yes</a> or \n\
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
    
    function deleteartist(id) {
        $('.notification .hide').click();
        txt='<br/>Delete Artist/Band <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteartistdo('+id+')">Yes</a> or \n\
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
    
    function newartistshow() {
        $('.artistsavebutton').fadeOut(1);
        $('#editartist').fadeOut(500);        
        $('#editcontent').fadeOut(500,function(){ $('.eventbutton').fadeOut(1); $('.newartistsavebutton').fadeIn(1); $('#addnewartist').fadeIn(500); })
    }
    
    function eventinfo() {
        $('.artistsavebutton').fadeOut(1);
        $('ul.artistlist li b').css('font-weight','normal');
        $('.newartistsavebutton').fadeOut(1);
        $('.eventbutton').fadeIn(1); 
        $('#addnewartist').fadeOut(500);
        $('#editartist').fadeOut(500);
        $('#editcontent').fadeIn(500);
        $('.leftmenu ul li a').css('font-weight','normal');
        $('#eventinfolink a').css('font-weight','bold');
    }
    
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
    
    function eventphotos(id,eventid) {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/eventphotos/'+id+'/'+eventid,
		  success: function(data) { 
                       $('#eventphotos').html(data);
              }
        });
    }
    
    function publish(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/eventpublish/'+id,
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
            <?php 
            $tr_ay = array('OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKİ', 'KAS', 'ARA');
            $gunler = array('PZR', 'PZT', 'SAL', 'ÇRŞ', 'PRŞ', 'CUM', 'CMT');
            $gun=strftime('%w',strtotime($event->eventdate));   
            ?>
            <div class="top-title">    
                <div class="detail-title gun<?php echo $gun ?>">
                <?php
                echo "<b>".strftime("%d", strtotime($event->eventdate))."</b> ".$tr_ay[intval(strftime("%m", strtotime($event->eventdate))-1)]. " " . $gunler[$gun] . "<label>[" . $event->eventclock . ":".$event->eventminute."]</label><strong>".$event->title."</strong>";
                ?>
                    <div style="position:absolute;right:0;width:150px;top:0;font-size:14px;">
                        <table>
                            <tr>
                                <td>
                                    Publish
                                </td>
                                <td>
                                    <input type="checkbox" class="eventbutton" <?php if ($event->publish==1) { echo "checked=\"checkde\""; } ?> onclick="publish(<?php echo $event->id ?>)" />
                                </td>
                            </tr>
                        </table>
                    </div>
                <button style="display:none;" class="artistsavebutton" onClick="CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editartistform'); return false;">Artist Save Changes</button>                    
                </div>
            </div>
            <div id="editevent_back"></div>
            <div class="editevent-left">
                <div id="eventimage">
                    <?php if (strlen($event->image)==0) { ?>
                    <img src="<?php echo base_url() ?>busycms/images/add-picture.jpg" onmouseover="$(this).attr('src','<?php echo base_url() ?>busycms/images/add-picture-h.jpg')" onmouseout="$(this).attr('src','<?php echo base_url() ?>busycms/images/add-picture.jpg')" width="300" height="150" onclick="$('#myfile').click();" style="cursor:pointer;" />
                    <?php } else { ?>
                    <div class="eventmainimage" onclick="$('#myfile').click();" style="cursor:pointer;">
                    <img src="<?php echo base_url() ?>uploads/<?php echo $event->image ?>" width="300" height="150" />
                    <div class="menu"></div>
                    </div>
                    <?php } ?>
                    <div style="width:0px;height:0px;overflow:hidden;">
                    <form id="uploadimage" action="<?php echo base_url() ?>busycms/eventmainimageupload/<?php echo $event->id ?>" method="post" enctype="multipart/form-data" target="ajax">
                        <input name="resim" type="file" id="myfile" style="height:30px;" onchange="$('#uploadimage').submit();" />
                    </form>
                    <iframe id="ajax"></iframe>     
                    </div>
                </div>
                <div class="leftmenu gun<?php echo $gun ?>">
                    <ul>
                        <li id="eventinfolink">
                            <a href="javascript:void(0);" onclick="eventinfo();" style="font-weight:bold;">Event Info</a>
                        </li>
                        <li id="editartistlink">
                            <a href="javascript:void(0);">Artists</a>
                            <span onclick="newartistshow()">+ Add artist</span>
                        </li>
                    </ul>
                </div>
                <div id="artists">
                    
                </div>
            </div>
            <div class="editevent-right">
                <div id="editcontent">
                    <h1>Event Information</h1>
                    <form name="editevent" id="editevent" onSubmit="return false;">
                        <b>Name of Event</b><br/>
                    <span>Please enter the name of the Event </span>
                    <input type="text" name="title" value="<?php echo $event->title ?>" />
                    <br/>
                    <input type="hidden" name="savepublish" id="savepublish" value="<?php echo $event->publish ?>" />
                    <input type="hidden" name="id" value="<?php echo $event->id ?>" />
                    <input type="hidden" name="saveclose" id="saveclose" value="0" />
                    <div class="clear"></div>
                    <div style="width:200px;float:left;position:relative;"> <b>Date of Event</b><br/>
                        <span>Please select the date of the Event</span>
                        <input type="text" id="date" name="date" value="<?php echo $event->eventdate ?>" />
                        <br/>
                    </div>
                    <div style="width:200px;float:left;margin-left:20px;"> <b>Event Time</b><br/>
                        <span>Please enter the time of Event </span>
                        <table>
                            <tr>
                                <td width="60"><input type="text" name="clock" value="<?php echo $event->eventclock ?>" placeHolder="00" style="width:50px;" /></td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="minute" value="<?php echo $event->eventminute ?>" placeHolder="00" style="width:50px;" />
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                        <div style="float:left;width:200px;margin-left:20px;">
                            <b>Event Venue</b><br/>
                            <span>Please enter venue of Event </span>
                            <select name="venue">
                                <option value="1" <?php if ($event->venue==1) { echo "selected=\"select\""; } ?>>Ghetto</option>
                                <option value="2" <?php if ($event->venue==2) { echo "selected=\"select\""; } ?>>Session</option>
                                <option value="3" <?php if ($event->venue==3) { echo "selected=\"select\""; } ?>>Teras</option>
                            </select>
                        </div>
                    <div class="clear"></div>
                    <b>Description of Event</b><br/>
                    <span>Please enter some information about the event </span>
                    <textarea style="padding-left:10px;" name="description"><?php echo $event->description ?></textarea>
                    <br/>
                    <b>Content of Event</b><br/>
                    <span>Please enter the event content</span>
                    <textarea id="editor1" name="content"><?php echo $event->content ?></textarea>
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
                    </script><br/>
                    <h1 style="margin:20px 0;">Ticket Information</h1>
          <div class="clear"></div>
                    <div style="width:200px;float:left;"> <b>Price</b><br/>
                        <span>Please enter price of Event </span>
                        <input type="text" name="price" value="<?php echo $event->price ?>" style="width:100px;" />
                    </div>
                        <div style="width:200px;float:left;margin-left:20px;"> <b>Student Price</b><br/>
                        <span>Please enter student price of Event </span>
                        <input type="text" name="studentprice" value="<?php echo $event->studentprice ?>" style="width:100px;" />
                    </div>
                    <div style="width:200px;float:left;margin-left:20px;"> <b>Pre Sale</b><br/>
                        <span>Please enter Pre Sale of Event </span>
                        <input type="text" name="presale" value="<?php echo $event->presale ?>" style="width:100px;" />
                    </div>
                    <div class="clear"></div><br/>
                              <b>Biletix Link</b><br/>
          <span>Please enter the biletix link for the event </span>
          <input type="text" name="link" value="<?php echo $event->link ?>" /><br/>
          <h1 style="margin:20px 0;">Extra Information</h1>
          <b>Event Sponsor</b><br/>
          <span>Please select the event sponsor</span>
          <select name="sponsor">
            <option value="">Select sponsor</option>
            <option <?php if ($event->sponsor=="Air France") { echo "selected=\"selected\""; } ?>>Air France</option>
            <option <?php if ($event->sponsor=="Burn") { echo "selected=\"selected\""; } ?>>Burn</option>
            <option <?php if ($event->sponsor=="Radyo Eksen") { echo "selected=\"selected\""; } ?>>Radyo Eksen</option>
            <option <?php if ($event->sponsor=="Red Bull Music Academy") { echo "selected=\"selected\""; } ?>>Red Bull Music Academy</option>
            <option <?php if ($event->sponsor=="Dream") { echo "selected=\"selected\""; } ?>>Dream</option>
            <option <?php if ($event->sponsor=="MySpace") { echo "selected=\"selected\""; } ?>>MySpace</option>
            <option <?php if ($event->sponsor=="Blast") { echo "selected=\"selected\""; } ?>>Blast</option>
            <option <?php if ($event->sponsor=="Biletix") { echo "selected=\"selected\""; } ?>>Biletix</option>
            <option <?php if ($event->sponsor=="Euro.message") { echo "selected=\"selected\""; } ?>>Euro.message</option>
            <option <?php if ($event->sponsor=="Abrakadabra") { echo "selected=\"selected\""; } ?>>Abrakadabra</option>
          </select>
          <br/>
          <br/>
          <b>Website Link</b><br/>
          <span>Please enter the website link for the event </span>
          <?php 
          $linki="";
          if (strlen($event->website)==0) { $linki="http://"; }
          ?>
          <input type="text" name="website" value="<?php echo $linki.$event->website ?>" />
          <br/>
                    </form><br/><br/>
                    <div align="right">
                    <button class="eventbutton" onClick="$('#savepublish').val(0);CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editevent'); return false;" style="right:300px;">Update Event Info</button>
                    <button class="eventbutton" onClick="$('#saveclose').val(1);CKEDITOR.instances['editor1'].updateElement();submitform('busycms/','editevent'); return false;" style="right:150px;">Update and Close</button>
                    </div>
                </div>
                <div id="addnewartist" style="display:none;">
                    <h1>New Artist/Band</h1>
                    <form name="addnewartistform" id="addnewartistform" onSubmit="return false;">
                    <b>The Artist</b><br/>
                    <span>Please enter the Artist/Band name</span>
                    <input type="text" name="title" />
                    <input type="hidden" name="id" value="<?php echo $event->id ?>" />
                        </form><br/>
                        <div align="right">
                    <button style="display:none;" class="newartistsavebutton" onClick="submitform('busycms/','addnewartistform'); return false;">Add Artist</button>                    
                        </div>
                    <div id="addnewartistform_back"></div>
                </div>
                <div id="editartist" style="display:none;">
                    
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