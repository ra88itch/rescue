<?php
require_once('_header.php');
require_once('_sidebar_login.php');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row<?php if(!isset($message) || $message == ''){ echo ' hide'; } ?>" id="messsage">
			<div class="col-md-12">
				<div class="card <?php if(isset($message) && $message != ''){ echo $message_action; } ?>" id="message_action">
					<div id="message_txt"><?php if(isset($message) && $message != ''){ echo $message; }else{ echo 'ALERT'; } ?></div>
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
								<h3>Forget Password</h3>
							</div>
						</div>
						
						<form method="POST" action="#">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="username">Username หรือ Email</label>
									<input type="text" class="form-control" name="username" placeholder="Username หรือ Email" value="">	
								</div>										
							</div>	
						</div>
						<div class="row">
							<div class="col-xs-12">							
								<div class="form-group">
									<button type="submit" class="btn btn-block btn-fill btn-primary" name="submit" value="forget-password">ยืนยัน</button>
								</div>	
							</div>
						</div>
						</form>

						<div class="row">
							<div class="col-xs-12 text-center">									
								<a class="text-primary" href="<?php echo $root; ?>login">เข้าสู่ระบบ</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require_once('_footer.php');
?>