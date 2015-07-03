<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache" />
        <title><?php echo $page_title; ?></title>
        <meta name="description" content="<?php echo $page_desc; ?>" />
	<link rel="stylesheet" href="<?php echo base_url() ?>busycms/static/stylesheets/app.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>busycms/static/stylesheets/sezgin.css" />
	<script src="<?php echo base_url() ?>busycms/static/scripts/library.js"></script>
	<script src="<?php echo base_url() ?>busycms/static/scripts/base.js"></script>
        <script src="<?php echo base_url() ?>busycms/static/scripts/modal.js"></script>
  	<script src="<?php echo base_url() ?>busycms/static/scripts/initialize.js"></script>  
        <script src="<?php echo base_url() ?>busycms/static/scripts/jquery.betterTooltip.js"></script>  
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
                    
                    
                    $(document).ready(function() {
                            $('.tTip').betterTooltip({speed: 100, delay: 100});

                    });
                    
        </script>
        
        
