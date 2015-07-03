<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
    $(document).ready(function() {
        $.initialize();
        $.demo();        
    });


    function deleteevent(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/designerdelete/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function publish(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/designerpublish/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }

    function deletebutton(id) {
        $('.notification .hide').click();
        txt='<br/>Delete this <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteevent('+id+')">Yes</a> or \n\
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
</script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">            
            <table style="display:none;">
                <tr>
                    <td></td>
                </tr>
            </table>
            <div class="top-title">
                <div style="width:150px;">
                    <select onchange="location.href='<?php echo base_url() ?>busycms/designers/?tip='+$(this).val()">
                        <option value="1" <?php if ($tip==1) { echo 'selected="selected"'; } ?>>Designers</option>
                        <option value="2" <?php if ($tip==2) { echo 'selected="selected"'; } ?>>Brands</option>
                    </select>
                </div>
                <button onclick="location.href='<?php echo base_url() ?>busycms/addnewdesigner/<?php echo $tip ?>'">Add New <?php if ($tip==1) { echo "Designer"; } else { echo "Brand"; } ?></button>
            </div>            
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <div class="events">
                    <ul class="userstabs" onmousemove="$('#orderkatid').val(0)">
                            <?php
                            $sql = $this->db->query("select * from designers_brands where tip=".$this->db->escape($tip)." order by title asc");
                            foreach ($sql->result() as $designer) { 
                            ?>
                            <li id="recordsArray_<?php echo $designer->id ?>">
                                <a href="javascript:void(0);" onclick="edituser(<?php echo $designer->id ?>)">
                                    <table width="100%">
                                        <tr>                                            
                                            <td class="eventtitle" width="650">
                                                <a href="<?php echo base_url() ?>busycms/editdesigner/<?php echo $designer->id ?>">
                                                    <label id="namesurnamelabel<?php echo $designer->id ?>"><?php echo $designer->title ?></label>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="eventmenus">
                                                    <a href="<?php echo base_url() ?>busycms/editdesigner/<?php echo $designer->id ?>" onclick="location.href='<?php echo base_url() ?>busycms/editdesigner/<?php echo $designer->id ?>'">8</a>
                                                    <a href="javascript:void(0)" onclick="deletebutton(<?php echo $designer->id ?>)">X</a>
                                                </div>
                                            </td>
                                            <td align="right">
                                                <div class="icons">                                                                                                    
                                                    &nbsp;&nbsp;&nbsp;<span style="cursor:pointer;" id="publish<?php echo $designer->id ?>" <?php if ($designer->publish==1) { echo "class=\"blackpublish\""; } else { echo "class=\"graypublish\""; } ?> onclick="publish(<?php echo $designer->id ?>)">=</span>&nbsp;&nbsp;
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </a>
                            </li>
<?php } ?>
                    </ul>
                    &nbsp;
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