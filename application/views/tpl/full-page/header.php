<!DOCTYPE html>
<html lang="en">
<head>
	<title>ArchIntel</title>

	<meta charset="utf-8">
	<meta name="author" content="geekO' IT Solutions">
	<meta name="tags" content="ArchIntel" />
	<meta name="robots" content="index, follow">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<meta property="og:title" content="ArchIntel" />
	<meta property="og:image" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="">


	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta name="twitter:title" content="">
	<meta name="twitter:description" content="">
	<meta name="twitter:creator" content="@ruelrule05">
	<meta name="twitter:image:src" content="">
	<meta name="twitter:domain" content="">

	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <link href='<?php echo base_url('assets/css/pace.min.css'); ?>' rel='stylesheet' type='text-css'>
   <script type='text/javascript' src='<?php echo base_url('assets/js/pace.min.js'); ?>'></script>

	<link href='https://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" media="screen">
   <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets/css/font-awesome.min.css'); ?>'>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/c3.min.css'); ?>">
   <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets/css/style.css'); ?>'>
	<?php
		if(isset($css))
			foreach($css as $c){
				echo '<link rel="stylesheet" type="text/css" href="'.$c.'">';
			}
	?>

</head>
<body class="boxed-mode">
   <div class="wrapper">
