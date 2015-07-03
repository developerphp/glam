<?php $this->load->view('busycms/includes/head') ?>

<script>
    function adduser(durum,cat)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/adduser",
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
    
    function edituser(userid)
    {
        $.fn.modal({
            theme:      "white",
            width:      "100px",
            height:     "100px",
            layout:     "elastic",
            url:        "<?php echo base_url() ?>busycms/edituser/"+userid,
            padding:    "50px"
            //animation:  "flipInX"
        });
    }
        
    

    $(document).ready(function() {
            $.initialize();
            $.demo();
    });

    function deleteuser(id)
    {
        $.ajax({
        url: '<?php echo base_url() ?>busycms/userdelete/'+id,
        success: function(data) { $('#sezgin').html(data); }
                });
    }

</script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con">
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <ul class="userstabs" onmousemove="$('#orderkatid').val(0)">
                    <?php
                    $sql = $this->db->query("select * from admins order by id asc");
                    foreach ($sql->result() as $user) {
                        ?>
                        <li id="recordsArray_<?php echo $user->id ?>">
                            <a href="javascript:void(0);" onclick="edituser(<?php echo $user->id ?>)">
                                <table>
                                    <tr>
                                        <td width="10"><span style="line-height:10px;font-size:30px;">d</span></td>
                                        <td><label id="namesurnamelabel<?php echo $user->id ?>"><?php echo $user->namesurname ?></label></td>
                                    </tr>
                                </table>
                            </a>
                            <div class="pagemenus">
                                <a href="javascript:void(0)" onclick="edituser(<?php echo $user->id ?>)">.</a>
                                <a href="javascript:void(0)" onclick="$('#deletemenu<?php echo $user->id ?>').fadeIn(1)">X</a></div>
                            <div class="deletemenu" id="deletemenu<?php echo $user->id ?>">
                                <div>Delete User ?<br/>
                                <label onclick="deleteuser(<?php echo $user->id ?>)">Yes</label> or <label onclick="$('#deletemenu<?php echo $user->id ?>').fadeOut(1)">No</label>&nbsp;&nbsp;
                                </div>
                            </div>
                        </li>
<?php } ?>
                    <li class="new">
                        <a href="javascript:void(0);" onclick="adduser()">
                            <span>+</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="sezgin">
                
            </div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>

<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>