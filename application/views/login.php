<?php
require_once('_header.php');
require_once('_sidebar_login.php');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row<?php if(!isset($errorDesc) || $errorDesc == ''){ echo ' hide'; } ?>" id="messsage">
			<div class="col-md-12">
				<div class="card <?php if(isset($errorDesc) && $errorDesc != ''){ echo $errorAction; } ?>" id="message_action">
					<div id="message_txt"><?php if(isset($errorDesc) && $errorDesc != ''){ echo $errorDesc; }else{ echo 'ALERT'; } ?></div>
					<span id="message_x">X</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-md-12">
								<h3>Login</h3>
							</div>
						</div>
						
						<form method="POST" action="#">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="username">Username หรือ Email</label>
									<input type="text" class="form-control" name="username" id="username" placeholder="Username หรือ Email" value="<?php if(isset($post)){ echo $post['username']; } ?>">	
								</div>										
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">									
								<div class="form-group">
									<label for="password">รหัสผ่าน</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="password" value="">
								</div>						
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">							
								<div class="form-group">
									<button type="submit" class="btn btn-block btn-fill btn-primary" name="submit" value="login">เข้าสู่ระบบ</button>
								</div>	
							</div>
						</div>						
						</form>

						<div class="row">
							<div class="col-xs-12 text-center">									
								<a class="text-primary" href="<?php echo $root; ?>forget-password">ลืมรหัสผ่าน ?</a>
								<span class="text-primary">|</span>
								<a class="text-primary" href="<?php echo $root; ?>register">ลงทะเบียน</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
// DEFINE VAR
var base_url = '<?php echo $root; ?>';
var errorAction = '<?php if(isset($errorAction)){ echo $errorAction; } ?>';
</script>
<?php
require_once('_footer.php');
?>