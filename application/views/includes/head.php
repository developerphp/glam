<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title>GLAM</title>

<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="http://cloud.typography.com/7245092/665028/css/fonts.css" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext" rel="stylesheet" type="text/css">

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>

<script>
	var base_url='<?php echo base_url() ?>';
</script>

<script src="<?php echo base_url('assets/js/glam.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bottle_add.js') ?>"></script>
<script src="<?php echo base_url('assets/js/mobile.js') ?>"></script>

<script type="text/javascript">
$( document ).ready( function() {
	
	$('.login_button').click( function() {
		$('.alerts_box').slideDown( function(){
			$('.alerts_box').delay( 3000 ).slideUp();
		});
	});	
});
</script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    