<?php $this->load->view('busycms/includes/head') ?>

</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">
            <div class="editevent-left">
                <div class="top-title">
                    <h2><span>Üyeler</span></h2>                        
                </div>                
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title" style="height:25px;">
<!--                        <input type="text" name="search" class="search_user" />-->
                        &nbsp;
                    </div>
                    <div id="productslist">
                        <ul>
                        <?php 
                        $sql=$this->db->query("select * from users");
                        foreach($sql->result() as $user) {?>                        
                            <li>
                                <table width="100%">
                                    <tr>
                                        <td width="200">
                                            <b><?php echo $user->name_surname ?></b><br/>
                                            <?php echo $user->email ?>
                                        </td>
                                        <td width="300">
                                            <?php 
                                            $q=$this->db->query("select * from adresler where user_id=".$this->db->escape($user->id)." limit 0,1");
                                            foreach($q->result() as $adres) { ?>
                                            <?php echo $adres->adres ?><br/>
                                            <?php echo $adres->semt ?>
                                            <?php }?>
                                        </td>
                                        <td width="20">&nbsp;</td>
                                        <td>
                                            <?php
                                            foreach($q->result() as $adres) {
                                            echo $adres->mobile ?><br/>
                                            <?php echo $adres->telefon;
                                            }?>
                                        </td>
                                        <td align="right">
                                            <a href="mailto:<?php echo $user->email ?>"><img src="<?php echo base_url() ?>busycms/images/sendmessage.jpg" style="margin-right:10px;" /></a>
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