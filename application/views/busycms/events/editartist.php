<h1>Artist/Band Information</h1>
<form name="editartistform" id="editartistform" onSubmit="return false;">
    <b>The Artist</b><br/>
    <span>Please enter the Artis/Band Name </span>
    <input type="text" name="name" value="<?php echo $artist->name ?>" />
    <input type="hidden" name="id" value="<?php echo $artist->id ?>" />
    <br/>
    <b>Origin of Artist/Band</b><br/>
    <span>Please select the country of origin for the artist/band</span>
    <input type="text" name="artistfrom" value="<?php echo $artist->artistfrom ?>" placeholder="e.g. Paris, Fransa" />
    <br/>
    <b>Description of Artist</b><br/>
    <span>Please enter some information about the artist </span>
    <textarea id="editor2" style="padding-left:10px;" name="description"><?php echo $artist->description ?></textarea>
    <script type="text/javascript">
                            CKEDITOR.replace( 'editor2',
                                    {
                                            extraPlugins : 'uicolor',
                                            uiColor: '#dee9e9',
                                            toolbar :
                                            [
                                                    [ 'Format', 'Bold', 'Italic', '-', 'NumberedList' , 'BulletedList', '-', 'Link', 'Unlink' ,'-', 'PageBreak']
                                            ]
                                    });
                    </script>
    <br/>
    <b>Related Artists</b><br/>
    <span>Please type related artist/band ( you can add more than one artist/band - please use (,) to seperate ) </span>
    <input type="text" name="relatedartists" value="<?php echo $artist->relatedartists ?>" />
    <br/>
    <?php 
    $linki="";
    if (strlen($artist->website)==0) { $linki="http://"; }
    ?>
    <b>Artist/Band Website </b><br/>
    <span>Please enter the artist/band website link </span>
    <input type="text" name="website" value="<?php echo $linki.$artist->website ?>" /><br/>
    <h1 style="margin:20px 0;">Social Media</h1>
    <b>Facebook</b><br/>
    <span>Please enter artist/band facebook page</span>
    <input type="text" name="facebook" value="<?php echo $artist->facebook ?>" />
    <br/>
    <b>Twitter</b><br/>
    <span>Please enter artist/band twitter page</span>
    <input type="text" name="twitter" value="<?php echo $artist->twitter ?>" />
    <br/>
    <b>Myspace</b><br/>
    <span>Please enter artist/band myspace page</span>
    <input type="text" name="myspace" value="<?php echo $artist->myspace ?>" />
    <br/>
    <b>Sound Cloud</b><br/>
    <span>Please enter artist/band soundcloud page</span>
    <input type="text" name="soundcloud" value="<?php echo $artist->soundcloud ?>" />
    <br/>
    <div id="editartistform_back">
    </div>
</form><br/>
<script>
eventphotos(<?php echo $artist->id ?>,<?php echo $eventid ?>);
videos(<?php echo $artist->id ?>);
sounds(<?php echo $artist->id ?>);
</script>
<div id="eventphotos"></div>
<div class="clear"></div>
<br/><br/>
<h1 style="margin-bottom:10px;">Videos</h1>
<div id="artistvideolist">
</div>
<div class="clear"></div>
<br/><br/>
<h1 style="margin-bottom:10px;">Sounds</h1>
<div id="artistsoundslist">
</div>
<br />
    <div align="right">
    <button class="artistsavebutton" onClick="CKEDITOR.instances['editor2'].updateElement();submitform('busycms/','editartistform'); return false;">Artist Save Changes</button>                    
    </div>