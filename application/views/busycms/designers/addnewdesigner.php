<?php $this->load->view('busycms/includes/head') ?>
<script type="text/javascript" src="<?php echo base_url() ?>busycms/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>busycms/static/scripts/app.js"></script>
<script>
               
    $(document).ready(function() {
        $.initialize();
        $.demo();
        
        $.datepicker.formatDate('yy-mm-dd', new Date(2007, 1 - 1, 26));
        
    });
</script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con">
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <table style="display:none;">
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                </table>
                <ul class="tabs pagecol0" onMouseMove="$('#orderkatid').val(0)" style="height:380px;">
                    &nbsp;
                </ul>
                <div class="editcontent">
                    <form name="addnewdesigner" id="addnewdesigner" onSubmit="return false;">
                        <b>Title</b><br/>
                        <span>Please enter the title</span>
                        <input type="text" name="title" /><br/>
                        <input type="hidden" name="tip" value="<?php echo $tip; ?>" />
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <div class="buttons">
                            <button onClick="submitform('busycms/','addnewdesigner'); return false;">Add New</button>
                            <div style="position:relative;">
                            <label style="position:absolute;right:155px;top:-32px;">cancel</label> <a href="#" onclick="location.href='<?php echo base_url() ?>busycms/designers/?tip=<?php echo $tip?>'" style="font-family: Icons;font-size:20px;top:-40px;position:absolute;right:130px;">X</a>
                            </div>
                        </div>
                        <div id="addnewdesigner_back">
                        </div>
                    </form>
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