<div id="header">
        <ul class="con">
            <li class="dashboard">
                <a href="#home">Busy Cms</a>
            </li>
            <li class="count indicator" style="display:none;">
                <span data-count="8">Notifications</span>
            </li>
            <li class="messages" style="display:none;">
                <span>Messages</span>
            </li>
        </ul>
	</div>
	<div id="stream">
	    <div class="con">
	        <div class="tile" id="hello" style="position:relative;">
	            <h2><span>Hi,</span> <?php echo $this->session->userdata('busynamesurname') ?></h2>
	            <ul class="nav">
                        <li>
	                    <a href="#" onclick="location.href='http://www.facebook.com/pages/aisha/20077223504'" title="Add Pages" target="_blank">
                                <img src="<?php echo base_url() ?>busycms/static/images/64-Facebook-Like.png" height="30" style="margin-top:10px;" />
                            </a>
	                </li>
	                <li>
	                    <a href="#" onclick="location.href='http://twitter.com/AyseTolga'" target="_blank">
                                <img src="<?php echo base_url() ?>busycms/static/images/64-Twitter.png" height="30" style="margin-top:10px;" />
                            </a>
	                </li>
	                <li class="adminbutton">
	                    <a href="<?php echo base_url() ?>busycms/users/" onclick="location.href='<?php echo base_url() ?>busycms/users/'" class="tTip" title="Add New User">a</a>
	                </li>                        
	                <li>
	                    <a href="<?php echo base_url() ?>busycms/logout" onclick="location.href='<?php echo base_url() ?>busycms/logout'"  class="tTip" title="Logout BusyCms">I</a>
	                </li>
	            </ul>
	        </div>
                <!--<a class="tile<?php if ($page=="dashboard") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/dashboard">
	            <span class="vector">1</span>
	            <span class="title"><strong>DASHBOARD</strong></span>
	            <span class="desc"><strong>View Dashboard</strong></span>
	        </a>-->
	        <!-- <a class="tile<?php if ($page=="pages") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/pages/" onclick="location.href='<?php echo base_url() ?>busycms/pages/'">
	            <span class="vector">C</span>
	            <span class="title"><strong>PAGES</strong></span>
	            <span class="desc"><strong>Manage Content</strong></span>
	        </a> -->
                <!--
	        <a class="tile<?php if ($page=="events") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/events/" onclick="location.href='<?php echo base_url() ?>busycms/events/'">
	            <span class="vector">a</span>
	            <span class="title"><strong>EVENTS</strong></span>
	            <span class="desc"><strong>Events Manage</strong></span>
	        </a>-->
                <a class="tile<?php if ($page=="products") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/products/" onclick="location.href='<?php echo base_url() ?>busycms/products/'">
	            <span class="vector">L</span>
	            <span class="title"><strong>PRODUCTS</strong></span>
	            <span class="desc"><strong>Manage Products</strong></span>
	        </a>
                <!--<a class="tile" href="http://mail.earthproductions.com" target="_blank">
	            <span class="vector">A</span>
	            <span class="title"><strong>E-MAIL</strong></span>
	            <span class="desc"><strong>Email Manage</strong></span>
	        </a>-->
	        <!-- <a class="tile<?php if ($page=="orders") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/orders/" onclick="location.href='<?php echo base_url() ?>busycms/orders/'">
	            <span class="vector">D</span>
	            <span class="title"><strong>ORDERS</strong></span>
	            <span class="desc"><strong>Manage Orders</strong></span>
	        </a>
                <a class="tile<?php if ($page=="members") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/products/" onclick="location.href='<?php echo base_url() ?>busycms/members/'">
	            <span class="vector">a</span>
	            <span class="title"><strong>MEMBERS</strong></span>
	            <span class="desc"><strong>Manage Members</strong></span>
	        </a> -->
<!--                <a class="tile<?php if ($page=="schedule") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/schedule/" onclick="location.href='<?php echo base_url() ?>busycms/schedule/'">
	            <span class="vector">7</span>
	            <span class="title"><strong>SCHEDULE</strong></span>
	            <span class="desc"><strong>Manage Schedule</strong></span>
	        </a>-->
                <!-- <a class="tile<?php if ($page=="districts") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/districts/" onclick="location.href='<?php echo base_url() ?>busycms/districts/'">
	            <span class="vector">7</span>
	            <span class="title"><strong>DISTRICTS</strong></span>
	            <span class="desc"><strong>Manage Districts</strong></span>
	        </a>
                <a class="tile<?php if ($page=="blockday") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/blockday/" onclick="location.href='<?php echo base_url() ?>busycms/blockday/'">
	            <span class="vector">R</span>
	            <span class="title"><strong>BLOCK DAY</strong></span>
	            <span class="desc"><strong>Blocked Days</strong></span>
	        </a>
	        <a class="tile<?php if ($page=="blockclock") { echo " selected"; } ?>" href="<?php echo base_url() ?>busycms/blockclock/" onclick="location.href='<?php echo base_url() ?>busycms/blockclock/'">
	            <span class="vector">R</span>
	            <span class="title"><strong>BLOCK CLOCK</strong></span>
	            <span class="desc"><strong>Blocked Clocks</strong></span>
	        </a> -->
	    </div>
	</div>