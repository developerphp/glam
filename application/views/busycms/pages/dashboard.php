<?php $this->load->view('busycms/includes/head') ?>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.mouse.js"></script>
<script src="<?php echo base_url() ?>busycms/ui/jquery.ui.sortable.js"></script>

<script>
    
    function pageadd(durum,cat)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/pageadd/"+durum+"/"+cat,
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
    
    function editcategory(catid)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/editcategory/"+catid,
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
        
    function pageedit(catid,catid2,catid3,id) {
        $('.pagecol'+catid2).animate({
            width: '0px',
            easing: 'easeOutBounce'
        }, 500,function(){
            $('.pagecol'+catid).animate({
                width: '0px',
                easing: 'easeOutBounce'
            }, 500,function(){
                $('.pagecol0').animate({
                    width: '0px',
                    easing: 'easeOutBounce'
                }, 500,function(){
                    $('.pagecol'+catid3+' li').removeClass('current');
                    $(this).addClass('current');
                });
            });
                        
        });
    }
    

    $(function() {
        
        $(".tabs").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                var katid=document.getElementById("orderkatid").value;																				
                var order = $(this).sortable("serialize") + '&action=updateRecordsListings&katid='+katid; 
                $.post("<?php echo base_url() ?>busycms/categoryorderupdate", order, function(theResponse){
                        $("#sezgin").html(theResponse);
                }); 		
        }								  
        });
        
    });

    $(document).ready(function() {
            $.initialize();
            $.demo();
    });

    function deletemenu(id)
    {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/pagedelete/'+id,
        success: function(data) { $('#sezgin').html(data); }
                });
    }

</script>

<script>
    function deletebutton(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is post <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deletemenu('+id+')">Yes</a> or \n\
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
        <div class="scroll con">
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <div id="content">
                </div>
                <ul class="tabs pagecol0" onmousemove="$('#orderkatid').val(0)">
                    <?php
                    $sql = $this->db->query("select * from pages where catid=0 order by reorder asc");
                    foreach ($sql->result() as $menu) {
                        ?>
                        <li class="<?php if ($menu->tip == 0) {
                        echo 'category';
                    } else {
                        echo 'page';
                    }
                    if ($catid == $menu->id) {
                        echo " current";
                    } ?>" id="recordsArray_<?php echo $menu->id ?>">
                            <a href="
    <?php if ($menu->tip == 0) {
        echo base_url() . "busycms/pages/" . $menu->id;
    } else { echo base_url()."busycms/editpage/".$menu->id; } ?>
                               " <?php if ($menu->tip == 0) { /* echo " data-count=\"9\""; */
    } ?>>
                                <span><?php if ($menu->tip == 0) {
        echo "g";
    } else {
        echo "C";
    } ?></span> <label><?php echo $menu->title ?></label>
                            </a>
                            <div class="pagemenus">
                                <?php if ($menu->tip==0) { ?>
                                <a href="javascript:void(0)" onclick="editcategory(<?php echo $menu->id ?>)">8</a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() ?>busycms/editpage/<?php echo $menu->id ?>">8</a>
                                <?php }?>
                                <a href="javascript:void(0);" onclick="deletebutton(<?php echo $menu->id ?>)">X</a>
                                </div>
                        </li>
<?php } ?>
                    <li class="new">
                        <a hreF="javascript:void(0);" onclick="$('.addbutton0').slideToggle(250)">
                            &nbsp;
                            <span>+</span>
                        </a>
                        <div class="addmore">
                            <ul id="more" class="icons addbutton0">
                                <li>
                                    <ul>
                                        <li class="chart">
                                            <a href="javascript:void(0);" onclick="pageadd(0,0)">category</a>
                                        </li>
                                        <li class="down"><a href="javascript:void(0);" onclick="pageadd(1,0)">page</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                    <?php if (is_numeric($catid)) { ?>
                    <ul class="tabs pagecol<?php echo $catid ?>" onmousemove="$('#orderkatid').val(<?php echo $catid ?>)">
    <?php
    $sql = $this->db->query("select * from pages where catid=" . $catid . " order by reorder asc");
    foreach ($sql->result() as $menu) {
        ?>
                        <li class="<?php if ($menu->tip == 0) { echo 'category'; } else { echo 'page'; }
                    if ($catid2 == $menu->id) { echo " current"; } ?>" id="recordsArray_<?php echo $menu->id ?>">
                            <a href="
    <?php if ($menu->tip == 0) { echo base_url() . "busycms/pages/" . $catid . "/" . $menu->id; } 
    else { echo base_url()."busycms/editpage/".$menu->id; } ?>
                               " <?php if ($menu->tip == 0) { /* echo " data-count=\"9\""; */
    } ?>>
                                <span><?php if ($menu->tip == 0) {
        echo "g";
    } else {
        echo "C";
    } ?></span> <label><?php echo $menu->title ?></label>
                            </a>
                            <div class="pagemenus">
                                <?php if ($menu->tip==0) { ?>
                                <a href="javascript:void(0)" onclick="editcategory(<?php echo $menu->id ?>)">8</a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() ?>busycms/editpage/<?php echo $menu->id ?>">8</a>
                                <?php }?>
                                <a href="javascript:void(0);" onclick="deletebutton(<?php echo $menu->id ?>)">X</a></div>
                        </li>
                            <?php } ?>
                        <li class="new">
                            <a hreF="javascript:void(0);" onclick="$('.addbutton<?php echo $catid ?>').slideToggle(250)">
                                &nbsp;
                                <span>+</span>
                            </a>
                            <div class="addmore">
                                <ul id="more" class="icons addbutton<?php echo $catid ?>">
                                    <li>
                                        <ul>
                                            <li class="chart">
                                                <a href="javascript:void(0);" onclick="pageadd(0,<?php echo $catid ?>)">category</a>
                                            </li>
                                            <li class="down"><a href="javascript:void(0);" onclick="pageadd(1,<?php echo $catid ?>)">page</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
<?php }
if (is_numeric($catid2)) { ?>
                    <ul class="tabs pagecol<?php echo $catid2 ?>" onmousemove="$('#orderkatid').val(<?php echo $catid2 ?>)">
    <?php
    $sql = $this->db->query("select * from pages where catid=" . $catid2 . " order by reorder asc");
    foreach ($sql->result() as $menu) {
        ?>
                        <li class="<?php if ($menu->tip == 0) { echo 'category'; } else { echo 'page'; }
                    if ($catid3 == $menu->id) { echo " current"; } ?>" id="recordsArray_<?php echo $menu->id ?>">
                            <a href="
    <?php if ($menu->tip == 0) { echo base_url() . "busycms/pages/" . $catid . "/" . $catid2 . "/" . $menu->id; } 
    else { echo base_url()."busycms/editpage/".$menu->id; } ?>
                               " <?php if ($menu->tip == 0) { /* echo " data-count=\"9\""; */
    } ?>>
                                <span><?php if ($menu->tip == 0) {
        echo "g";
    } else {
        echo "C";
    } ?></span> <label><?php echo $menu->title ?></label>
                            </a>
                            <div class="pagemenus">
                                <?php if ($menu->tip==0) { ?>
                                <a href="javascript:void(0)" onclick="editcategory(<?php echo $menu->id ?>)">8</a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() ?>busycms/editpage/<?php echo $menu->id ?>">8</a>
                                <?php }?>
                                <a href="javascript:void(0);" onclick="deletebutton(<?php echo $menu->id ?>)">X</a></div>
                        </li>
    <?php } ?>
                        <li class="new">
                            <a hreF="javascript:void(0);" onclick="$('.addbutton<?php echo $catid2 ?>').slideToggle(250)">
                                <span>+</span>
                            </a>
                            <div class="addmore">
                                <ul id="more" class="icons addbutton<?php echo $catid2 ?>">
                                    <li>
                                        <ul>
                                            <li class="chart">
                                                <a href="javascript:void(0);" onclick="pageadd(0,<?php echo $catid2 ?>)">category</a>
                                            </li>
                                            <li class="down"><a href="javascript:void(0);" onclick="pageadd(1,<?php echo $catid2 ?>)">page</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
<?php }
if (is_numeric($catid3)) { ?>
                    <ul class="tabs pagecol<?php echo $catid3 ?> lastcol" onmousemove="$('#orderkatid').val(<?php echo $catid3 ?>)">
    <?php
    $sql = $this->db->query("select * from pages where catid=" . $catid3 . " order by reorder asc");
    foreach ($sql->result() as $menu) {
        ?>
                            <li class="<?php echo "page"; if ($catid3 == $menu->id) { echo " current"; } ?>" id="recordsArray_<?php echo $menu->id ?>">
                                <a href="javascript:void(0);">
                                    <span>}</span> <?php echo $menu->title ?>
                                </a>
                                <div class="pagemenus">
                                <?php if ($menu->tip==0) { ?>
                                <a href="javascript:void(0)" onclick="editcategory(<?php echo $menu->id ?>)">8</a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() ?>busycms/editpage/<?php echo $menu->id ?>">8</a>
                                <?php }?>
                                <a href="javascript:void(0);" onclick="deletebutton(<?php echo $menu->id ?>)">X</a></div>
                            </li>
    <?php } ?>
                        <li class="new">
                            <a hreF="javascript:void(0);" onclick="$('.addbutton<?php echo $catid3 ?>').slideToggle(250)">
                                &nbsp;
                                <span>+</span>
                            </a>
                            <div class="addmore">
                                <ul id="more" class="icons addbutton<?php echo $catid3 ?>" style="top:-30px;width:95px;left:170px;">
                                    <li>
                                        <ul>
                                            <li class="down"><a href="javascript:void(0);" onclick="pageadd(1,<?php echo $catid3 ?>)">page</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
<?php } ?>
            </div>
            <div id="sezgin">
                
            </div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>

<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>