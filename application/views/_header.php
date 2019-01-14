<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/png" href="<?php echo $root; ?>assets/images/favicon.png">

	<title><?php if(isset($active_nav)){  echo $active_nav,' - '; } ?><?php echo $title; ?></title>

	<?php //<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" /> ?>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="<?php echo $root; ?>assets/css/bootstrap.min.css"/>

	<!-- Bootstrap lib select   -->
	<link rel="stylesheet" href="<?php echo $root; ?>assets/css/bootstrap-select.min.css"/>

	<!-- Bootstrap lib select   -->
	<link rel="stylesheet" href="<?php echo $root; ?>assets/css/easy-autocomplete.min.css"/>
	<link rel="stylesheet" href="<?php echo $root; ?>assets/css/easy-autocomplete.themes.min.css"/>

	<link rel="stylesheet" href="<?php echo $root; ?>assets/css/bootstrap-datetimepicker.min.css"/>

    <!--  Icon Web font     -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--  CSS for Custom      -->
	<link href="<?php echo $root; ?>assets/css/style.css" rel="stylesheet" />
</head>
<body>
	<header>
      <!-- Fixed navbar -->
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="<?php echo $root; ?>"><img src="<?php echo $root; ?>assets/images/logo_white_trans.png" style="max-height:40px;"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if(isset($active_nav) && $active_nav == 'dashboard'){  echo ' active'; } ?>">
						<a class="nav-link" href="<?php echo $root; ?>dashboard"><?php echo $this->lang->line('nav_dashboard'); ?></a>
					</li>
					<li class="nav-item<?php if(isset($active_nav) && $active_nav == 'notify'){  echo ' active'; } ?>">
						<a class="nav-link" href="<?php echo $root; ?>notify"><?php echo $this->lang->line('nav_notify'); ?></a>
					</li>
					<li class="nav-item<?php if(isset($active_nav) && $active_nav == 'report'){  echo ' active'; } ?>">
						<a class="nav-link" href="<?php echo $root; ?>report"><?php echo $this->lang->line('nav_report'); ?></a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item<?php if(isset($active_nav) && $active_nav == 'profile'){  echo ' active'; } ?>">
						<a class="nav-link" href="<?php echo $root; ?>profile"><?php echo $this->lang->line('nav_profile'); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $root; ?>logout"><?php echo $this->lang->line('nav_logout'); ?></a>
					</li>
				</ul>
<?php /*
            <li class="nav-item<?php if(isset($active_nav) && $active_nav == 'dashboard'){  echo ' active'; } ?>">
              <a class="nav-link" href="<?php echo $root; ?>dashboard">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" placeholder="Search" aria-label="Search" type="text">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
*/ ?>
			</div>
		</nav>
	</header>
<?php 
if(isset($error_massage) && $error_massage != ''){
?>	
	<section class="massage-content">
		<div class="container">
			<div class="row">
				<div class="col-12">		
				<?php echo '<div class="alert alert-'.$error_class.'">'.$error_massage.'</div>'; ?>	
				</div>
			</div>
		</div>
	</section>
<?php 
}
?>	