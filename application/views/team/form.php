<?php
$this->load->view('_header');
$this->load->view('_sidebar');

$js_var = new stdClass;

$profile = new stdClass;
$profile->team_name		= $team[$user->team_id];
$profile->team_account  = 'ยังไม่ระบุนามเรียนขาน';

$submit = 'create';
if(isset($detail)){
	$js_var->detail_id = $detail->id;
	$profile->team_name		= $team[$detail->team_id];
	/*if($detail->team_account > 0 && $detail->team_account < 4294967295){
		$profile->team_account	= $team_account[$detail->team_account];
	}*/
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
<form id="form-submit" method="post" action="#" enctype="multipart/form-data">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#profile-basic" class="text-default">ข้อมูลพื้นฐาน</a></li>
					<li><a data-toggle="tab" href="#profile-contact">ข้อมูลการติดต่อ</a></li>
					<?php
					if(isset($detail)){
					?>
					<li><a data-toggle="tab" href="#profile-training">ข้อมูลการฝึกอบรม</a></li>
					<!-- <li><a data-toggle="tab" href="#profile-vehicle">ข้อมูลยานพาหนะ</a></li> -->
					<?php
					}
					?>
				</ul>
				<div class="card">
					<div class="content tab-content">
						
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

								<div class="row">
									<div class="col-xs-12">	

										<div class="form-group">
											<select class="form-control" name="team_account">
											<?php
											$option = '<option value="4294967295">ไม่ระบุนานเรียกขาน</option>';
											foreach($team_account AS $team_account_value){
												$option_status = '';
												if(isset($detail) && $detail->team_account == $team_account_value->id){
													$option_status = ' selected';
												}
												$option .= '<option value="'.$team_account_value->id.'"'.$option_status.'>'.$team_account_value->name.'</option>';
											}
											echo $option;
											?>
											</select>
										</div>

										<h5><?php echo $profile->team_name ; ?></h5>
										<hr>
									</div>
								</div>
							</div>
						</div>

						<?php 
						
						$this->load->view('team/formBasic');
						$this->load->view('team/formContact', $footerResponse);
						if(isset($detail)){
							$this->load->view('team/formTraining', $footerResponse);
							// $this->load->view('team/formVehicle', $footerResponse);

							echo '<input type="hidden" name="id" value="'.$detail->id.'">';
						}
						$this->load->view('formSubmit');
						?>
						<input type="hidden" name="do" value="<?php echo $submit; ?>">
						
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