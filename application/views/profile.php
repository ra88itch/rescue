<?php
$this->load->view('_header');
$this->load->view('_sidebar');

$js_var = new stdClass;

if(isset($detail)){
	$submit = 'update';
}

$footerResponse = new stdClass;
$footerResponse->js_var = $js_var;
?>
<div class="content content-view">
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
			<div class="col-xs-12">
<form id="form-submit" method="post" action="#">
				<div class="card">
					<div class="content tab-content">
						
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

								<div class="row">
									<div class="col-xs-12">	
										<h5><?php echo $detail->fullname ; ?></h5>
										<hr>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">	

										<div class="form-group">
											<label for="fullname">ชื่อผู้ใช้งาน<span class="text-danger"> *</span></label>
											<input type="text" class="form-control" value="<?php echo strtoupper($user->username); ?>" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">	

										<div class="form-group">
											<label for="fullname">เปลี่ยนรหัสผ่าน</label>
											<input type="password" class="form-control" name="password" value="">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-xs-12 col-md-3 col-md-offset-1 col-lg-2 col-lg-offset-2">
							</div>
							<div class="col-xs-12 col-md-3 col-md-offset-2 col-lg-2 col-lg-offset-2">
								<input type="hidden" name="do" value="<?php echo $submit; ?>">
							</div>
							<div class="col-xs-12 col-md-3 col-lg-2">
								<button class="btn btn-block btn-fill btn-success">บันทึกข้อมูล</button>
							</div>
						</div>
						
					</div>
				</div>
</form>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('_footer', $footerResponse);
?>