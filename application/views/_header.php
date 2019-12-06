<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?php echo $root; ?>assets/images/favicon.ico">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

	<title><?php echo strtoupper($title); ?></title>


	<?php
	foreach($css AS $cssrow){
		echo '<link href="'.$root.'assets/css/'.$cssrow.'" rel="stylesheet" type="text/css" />';
	}
	?>
	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Prompt:400,700,300' rel='stylesheet' type='text/css'> 
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="wrapper">
