<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>    
<script>
    
    $(document).ready(function() {
        $.initialize();        
    });
    
    function districtadd()
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/districtadd/",
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
    
    function deletedistrictdo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deletedistrict/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function deletedistrict(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is district <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletedistrictdo('+id+')">Yes</a> or \n\
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
                    <h2><span>Districts</span></h2>                        
                </div>                
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title" style="height:25px;">
<!--                        <input type="text" name="search" class="search_user" />-->
                        &nbsp;
                        <button onclick="districtadd()">Add District</button>
                    </div>
                    <div id="productslist">                        
                        <ul>
                        <?php 
                        $sql=$this->db->query("select * from zones order by semt asc");
                        foreach($sql->result() as $s) {?>                        
                            <li id="district<?php echo $s->id ?>">
                                <table>
                                    <tr>
                                        <td width="150">
                                            <?php echo $s->semt ?></td>                                        
                                        <td width="100" align="right" style="padding-right:20px;">
                                            <a class="icon_tip" href="javascript:void(0);" onclick="deletedistrict(<?php echo $s->id ?>)">X</a>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        <?php }?>
                        </ul>
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