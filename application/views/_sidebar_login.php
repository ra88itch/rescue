<?php
$sidebar_nav['register'] = 'ลงทะเบียน';
$sidebar_nav['login'] = 'เข้าสู่ระบบ';
$sidebar_nav['forget-password'] = 'ลืมรหัสผ่าน';
?>
<!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->
<div class="sidebar" data-color="blue">
	<div class="sidebar-wrapper">
		<div class="logo">
			<a href="<?php echo $root; ?>" class="simple-text">
				<img src="<?php echo $root; ?>assets/images/rtm-logo-wh.png" class="img-responsive">
			</a>
		</div>

		<ul class="nav">
			<li>
				<p>ระบบ <b>Rescue Team Management</b> อยู่ในช่วงทดสอบการใช้งาน, คุณสามารถสร้าง <a href="<?php echo $root; ?>register">Rescue Team</a> ของคุณได้</p>
				<p>ขอบคุณที่้เป็นส่วนหนึ่งในการทดสอบระบบกับเรา</p>
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
					<?php
					foreach($sidebar_nav AS $key=>$value){
						if(isset($current_location) && $current_location != $key){
							echo '<li><a href="',$root,$key,'"><p>',$value,'</p></a></li>';
						}
					}
					?>
					<li class="separator hidden-lg hidden-md"></li>
				</ul>
			</div>
		</div>
	</nav>