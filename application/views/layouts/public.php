<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html>
 <head>
	<meta http-equiv="Content-Type" content="text/html;charset=us-ascii">
	<meta http-equiv="expires" content="0" />
	<meta name="Robots" content="index,follow">

	<link href="<?php echo base_url() ?>css/common.css" rel="stylesheet" type="text/css" media="screen" title="default">

	<script language="javascript" type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.min.js"></script>
	
	<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url() ?>js/common.js"></script>
	
	<script language="javascript">
	var url_base = "<?php echo base_url();?>";
	</script>

	<title></title>
</head>

<body id="home">
	<div><?php echo flash_msg() ?></div>

	<?php echo $header; ?>


	<div class="container">
		<?php echo $content_body; ?>
	</div>

	<?php echo $footer; ?>


<p><br />Page rendered in {elapsed_time} seconds</p>

</body>

</html>