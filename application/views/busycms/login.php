<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<title>Dashboard</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>busycms/static/stylesheets/app.css" />
	<script src="<?php echo base_url() ?>busycms/static/scripts/library.js"></script>
	<script src="<?php echo base_url() ?>busycms/static/scripts/login.js"></script>
        <script>
                function submitform(linki,form){
                    $.ajax({  
                            type: 'POST',
                            url: '<?php echo base_url() ?>'+linki+form+'_do',
                            data: $('#'+form).serialize(),
                            error:function(){ $('#'+form+'_back').html("Hata Var."); }, 
                            success: function(veri) { 
                            $('#'+form+'_back').html(veri);
                            }
                            });
                            return false;
                    } 
    </script>
</head>
<body>
	<div id="welcome">
		<div id="password" style="display:block;">
                    <form action="<?php echo base_url() ?>busycms" onsubmit="return false;" id="loginform">
			<div class="input username"><input name="username" type="text" placeholder="User name" /></div>
			<div class="input password"><input name="password" type="password" placeholder="Password" /></div>
			<button onclick="submitform('busycms/','loginform')">Log in</button>
                        <div id="loginform_back"></div>
                    </form>
		</div>
	</div>
</body>
</html>