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
                    <form name="addnewevent" id="addnewevent" onSubmit="return false;">
                        <div style="position:relative;">
                            <label style="position:absolute;right:22px;top:8px;">cancel</label> <a href="#" onclick="location.href='<?php echo base_url() ?>busycms/events/'" style="font-family: Icons;font-size:20px;position:absolute;right:0;">X</a>
                        </div><br/><br/>
                        <b>Event Title</b><br/>
                        <span>Please enter the event title</span>
                        <input type="text" name="title" /><br/>
                        <div class="clear"></div>
                        <div style="width:300px;float:left;position:relative;">
                            <b>Event Date</b><br/>
                            <span>Please enter the event date</span>
                            <input type="text" id="date" name="date" /><br/>
                        </div>   
                        <div style="width:200px;float:left;margin-left:20px;">
                            <b>Event Time </b><br/>
                            <span>Please enter the time of Event </span>
                            <table>
                            <tr>
                                <td width="60"><input type="text" name="clock" placeHolder="00" style="width:50px;" /></td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="minute" placeHolder="00" style="width:50px;" />
                                </td>
                            </tr>
                        </table>
                        </div>
                        <div class="clear"></div>
                        <div class="buttons">
                            <button onClick="submitform('busycms/','addnewevent'); return false;">Create Event</button>
                        </div>
                        <div id="addnewevent_back">
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