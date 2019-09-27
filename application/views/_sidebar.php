<!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->
<div class="sidebar" data-color="blue">
	<div class="sidebar-wrapper">
		<div class="logo">
			<a href="<?php echo $root; ?>" class="simple-text">
				<img src="<?php echo $root; ?>assets/images/rtm-logo-wh.png" class="img-responsive">
			</a>
		</div>

		<ul class="nav">
			<li<?php if(isset($current_location) && $current_location == 'team'){ echo ' class="active"'; } ?>>
				<a href="<?php echo $root; ?>team">
					<i class="pe-7s-users"></i>
					<p>My Team</p>
				</a>
			</li>
			<li<?php if(isset($current_location) && $current_location == 'teamAccount'){ echo ' class="active"'; } ?>>
				<a href="<?php echo $root; ?>teamAccount">
					<i class="pe-7s-id"></i>
					<p>Team Account</p>
				</a>
			</li>
			<li<?php if(isset($current_location) && $current_location == 'teamTraining'){ echo ' class="active"'; } ?>>
				<a href="<?php echo $root; ?>teamTraining">
					<i class="pe-7s-study"></i>
					<p>Training</p>
				</a>
			</li>
			<?php /*
			<li<?php if(isset($current_location) && $current_location == 'manager'){ echo ' class="active"'; } ?>>
				<a href="<?php echo $root; ?>manager">
					<i class="pe-7s-star"></i>
					<p>Manager</p>
				</a>
			</li>
			*/ ?>
			<li<?php if(isset($current_location) && $current_location == 'setting'){ echo ' class="active"'; } ?>>
				<a href="<?php echo $root; ?>setting">
					<i class="pe-7s-tools"></i>
					<p>Setting</p>
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="main-panel">
	<nav class="navbar navbar-default navbar-fixed">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?php echo $root; ?>profile">
							<p>ยินดีต้อนรับ, <?php echo strtoupper($user->username); ?></p>
						</a>
					</li>
					<li>
						<a href="<?php echo $root; ?>logout">
							<p>ออกจากระบบ</p>
						</a>
					</li>
					<li class="separator hidden-lg hidden-md"></li>
				</ul>
			</div>
		</div>
	</nav>