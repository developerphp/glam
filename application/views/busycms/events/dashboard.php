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
            url: '<?php echo base_url() ?>busycms/eventdelete/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function publish(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/eventpublish/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }

    function deletebutton(id) {
        $('.notification .hide').click();
        txt='<br/>Delete is event <br/><br/><a style="color:#000;" href="javascript:void(0)" onclick="deleteevent('+id+')">Yes</a> or \n\
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

<style type="text/css">
		.calendar {
			font-family: Arial; font-size: 12px;
                        width:auto;
		}
		table.calendar {
			margin: auto; border-collapse: collapse;
		}
		
                .calendar tr td {
                    text-align:center;
                }
                .calendar .days td {
			width: 30px; height: 30px;
                        overflow:hidden;
			border: 1px solid #999;
			vertical-align: middle;
                        position:relative;
                        text-align: center;
                        color:#000;
                        font-size:14px;
		}
                
		.calendar .days td:hover {
			background-color: #FFF;
		}
                                
                .calendar .days td .gun0 { background:#b482ff;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; }
                .calendar .days td .gun1 { background:#7fa2fe;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; }
                .calendar .days td .gun2 { background:#629193;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; } 
                .calendar .days td .gun3 { background:#e45e90;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; } 
                .calendar .days td .gun4 { background:#8ab470;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; } 
                .calendar .days td .gun5 { background:#c178b6;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; } 
                .calendar .days td .gun6 { background:#c07979;font-weight:bold;font-size:20px;position:absolute;top:0;left:0;padding:9px; }
                
		.calendar .highlight {
			font-weight: bold; color: #00F;
		}
	</style>

</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">
            <?php
            $tr_ay = array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık');
            $gunler = array('Pzr', 'Pzt', 'Sal', 'Çrş', 'Prş', 'Cum', 'Cmt');
            $yerler=array('','Ghetto','Sessions','Teras');
           
            $nextmonth=$month+1;
            $nextyear=$year;
            
            $backmonth=$month-1;
            $backyear=$year;
            ?>
            <table style="display:none;">
                <tr>
                    <td></td>
                </tr>
            </table>
            <div class="top-title">
                <?php 
                if ($month==12) { $nextmonth=1; $nextyear=$year+1; }
                if ($month==1) { $backmonth=12; $backyear=$year-1; }
                ?>
                            <h2><span><?php echo $tr_ay[$month - 1] ?></span> <?php echo $year ?></h2>                        
                            <button onclick="location.href='<?php echo base_url() ?>busycms/addnewevent'">Create New Event</button>
                </div>
            <?php if (strlen($month) == 1) {
                            $month = "0" . $month;
             } ?>
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <div class="events">
                    <ul class="userstabs" onmousemove="$('#orderkatid').val(0)">
                            <?php
                            $sql = $this->db->query("select * from events where eventdate like '".$year."-".$month."-%%' order by eventdate asc");
                            foreach ($sql->result() as $event) {
                            $gun=strftime('%w',strtotime($event->eventdate));    
                            ?>
                            <li id="recordsArray_<?php echo $event->id ?>" class="gun<?php echo $gun ?>">
                                <a href="javascript:void(0);" onclick="edituser(<?php echo $event->id ?>)">
                                    <table width="100%">
                                        <tr>
                                            <td width="200">
                                                <div class="eventdate">
                                                    <?php
                                                    echo strftime("%d", strtotime($event->eventdate))." <b>".$gunler[$gun]."</b> <label>[".$event->eventclock.":".$event->eventminute."] (".$yerler[$event->venue].")</label>";
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="eventtitle" width="300">
                                                <a href="<?php echo base_url() ?>busycms/editevent/<?php echo $event->id ?>">
                                                    <label id="namesurnamelabel<?php echo $event->id ?>"><?php echo $event->title ?></label>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="eventmenus">
                                                    <a href="<?php echo base_url() ?>busycms/editevent/<?php echo $event->id ?>" onclick="location.href='<?php echo base_url() ?>busycms/editevent/<?php echo $event->id ?>'">8</a>
                                                    <a href="javascript:void(0)" onclick="deletebutton(<?php echo $event->id ?>)">X</a>
                                                </div>
                                            </td>
                                            <td align="right">
                                                <div class="icons">
                                                <?php 
                                                $sql=$this->db->query("select * from eventartists where eventid=".$this->db->escape($event->id)."");
                                                if ($sql->num_rows()>0) { $artisticon="var"; } else { $artisticon="yok"; }
                                                ?>
                                                <?php if (strlen($event->description)>0) { $descicon="var"; } else { $descicon="yok"; } ?>
                                                <?php if (strlen($event->link)>0) { $linkicon="var"; } else { $linkicon="yok"; } ?>
                                                    <span class="<?php echo $artisticon ?>">a</span>&nbsp;&nbsp;
                                                    <span class="<?php echo $linkicon ?>">.</span>&nbsp;&nbsp;
                                                    <span class="<?php echo $descicon ?>">}</span>&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;<span style="cursor:pointer;" id="publish<?php echo $event->id ?>" <?php if ($event->publish==1) { echo "class=\"blackpublish\""; } else { echo "class=\"graypublish\""; } ?> onclick="publish(<?php echo $event->id ?>)">=</span>&nbsp;&nbsp;
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
                <div class="datefilters">
                    <div style="margin-left:20px;position:relative;margin-top:10px;">
                        <div style="margin-left:10px;position:relative;">
                            <div style="position:absolute;width:100px;left:30px;top:15px;">
                                <select onchange="location.href='<?php echo base_url() ?>busycms/events/?month='+this.value+'&year=<?php echo $year ?>'">
                                    <?php for($i=1;$i<=12;$i++) { ?>
                                    <option value="<?php echo $i ?>" <?php if($i==$month) { echo "selected=\"selected\""; } ?>><?php echo $tr_ay[$i-1] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div style="position:absolute;width:100px;left:140px;top:15px;">
                                <select onchange="location.href='<?php echo base_url() ?>busycms/events/?month=<?php echo $month ?>&year='+this.value">
                                    <?php for($i=date('Y')-5;$i<=date('Y')+1;$i++) { ?>
                                    <option <?php if($i==$year) { echo "selected=\"selected\""; } ?>><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div style="font-family:Icons;position:absolute;font-size:20px;left:0px;top:20px;">
                                <a style="color:#000;text-decoration:none;" href="#" onclick="location.href='<?php echo base_url() ?>busycms/events/?month=<?php echo $backmonth ?>&year=<?php echo $backyear ?>'"><</a>
                                <a style="color:#000;text-decoration:none;margin-left:225px;" href="#" onclick="location.href='<?php echo base_url() ?>busycms/events/?month=<?php echo $nextmonth ?>&year=<?php echo $nextyear ?>'">></a>
                            </div>
                        </div>
                        <div style="padding-top:80px;">
                        <?php echo $calendar; ?>
                        </div>
                    </div>
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