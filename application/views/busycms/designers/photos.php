<h1 style="margin-bottom:10px;">Photos</h1>
<div id="artistimagelist">
    <ul class="images">
        <?php 
            $sql=$this->db->query("select * from hofimages where pageid=".$artist->id." and nedir=2 order by reorder asc");
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
                                    <!--<a href="<?php echo base_url() ?>busycms/mainimageevent/<?php echo $artist->id ?>/<?php echo $image->id ?>"><span>3</span>Main Image</a><br/>
                    <a href="<?php echo base_url() ?>busycms/cropimageevent/<?php echo $image->pageid ?>/<?php echo $image->id ?>/<?php echo $eventid ?>"><span>a</span>Crop Image</a><br/>-->
                    <a href="javascript:void(0)" onclick="edit(<?php echo $image->id ?>)" style="display:none;"><span>8</span>Edit Image<br/></a>
                    <a href="javascript:void(0)" onclick="deleteimageapproval(<?php echo $image->id ?>)"><span>X</span>Delete Image</a>

                                </div>
                    <div id="edit<?php echo $image->id ?>" class="imageedit" style="display:none;">
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
                            </td>
                        </tr>
                    </table>
                    </div>
            </li>
            <?php } ?>
        <li id="addartistimage">
            <img src="<?php echo base_url() ?>busycms/images/add-photo.png" onclick="$('#uploadhofimageinput').click();" />
        </li>
    </ul>
    <div style="width:1px;height:1px;overflow:hidden;">
    <form method="post" id="uploadhofimage" name="uploadhofimage" action="<?php echo base_url() ?>busycms/uploadimagehof/<?php echo $artist->id ?>" enctype="multipart/form-data" target="ajax3">
        <input id="uploadhofimageinput" name="images[]" type="file" min="1" max="30" multiple="multiple"  onchange="$('#uploadhofimage').submit();" /><br/><br/>
        <input type="submit" value="Upload" />
    </form>
        <div style="height:0px;width:0px;overflow:hidden;">
        <iframe id="ajax3" name="ajax3"></iframe>
        </div>
    </div>
</div>