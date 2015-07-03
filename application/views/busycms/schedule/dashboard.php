<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>    
<script>
    
    $(document).ready(function() {
        $.initialize();        
    });
    
    function scheduleadd()
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/scheduleadd/",
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
    
    function deletescheduledo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deleteschedule/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function deleteschedule(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is schedule <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletescheduledo('+id+')">Yes</a> or \n\
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
            <div class="editevent-left">
                <div class="top-title">
                    <h2><span>Schedule</span></h2>                        
                </div>                
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title" style="height:25px;">
<!--                        <input type="text" name="search" class="search_user" />-->
                        &nbsp;
                        <button style="margin-right:130px;" onclick="scheduleadd()">Add Schedule</button>
                        <span id="scheduleform_back"></span>
                        <button onClick="submitform('busycms/','scheduleform');">Save Changes</button>
                    </div>
                    <div id="productslist">                        
                        <form id="scheduleform" name="scheduleform" onsubmit="return false;">
                        <ul>
                        <?php 
                        $days=array("Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
                        $sql=$this->db->query("select * from teslimat_saatler order by teslim_zone asc,teslim_day asc");
                        foreach($sql->result() as $s) {?>                        
                            <li id="schedule<?php echo $s->id ?>">
                                <table>
                                    <tr>
                                        <td width="150">Zone <?php echo $s->teslim_zone ?></td>
                                        <td><?php echo $days[$s->teslim_day] ?></td>
                                        <td width="200">
                                            <input type="text" name="day<?php echo $s->id ?>" value="<?php echo $s->teslim_clock ?>" />
                                        </td>
                                        <td width="100" align="right" style="padding-right:20px;">
                                            <a class="icon_tip" href="javascript:void(0);" onclick="deleteschedule(<?php echo $s->id ?>)">X</a>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        <?php }?>
                        </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="sezgin"></div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>
    <?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>