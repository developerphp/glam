<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>    
<script>
    
    $(document).ready(function() {
        $.initialize();        
    });
    
    function blockclockadd()
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/blockclockadd/",
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
    
    function deleteblockclockdo(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/deleteblockclock/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function deleteblockclock(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is block clock <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteblockclockdo('+id+')">Yes</a> or \n\
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
                    <h2><span>Blocked Clocks</span></h2>                        
                </div>                
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title" style="height:25px;">
<!--                        <input type="text" name="search" class="search_user" />-->
                        &nbsp;
                        <button onclick="blockclockadd()">Block Clock</button>
                    </div>
                    <div id="productslist">                        
                        <ul>
                        <?php 
                        $aylar=array("","Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
                        $sql=$this->db->query("select * from block_clocks order by tarih asc");
                        foreach($sql->result() as $s) {?>                        
                            <li id="day<?php echo $s->id ?>">
                                <table>
                                    <tr>
                                        <td width="150">
                                            <?php 
                                            $month=date('m',strtotime($s->tarih));                                            
                                            echo date('d',strtotime($s->tarih))." ".$aylar[intval($month)]." ".date('Y',strtotime($s->tarih)) ?></td>                                        
                                        <td width="100" align="right" style="padding-right:20px;">
                                            <a class="icon_tip" href="javascript:void(0);" onclick="deleteblockclock(<?php echo $s->id ?>)">X</a>
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