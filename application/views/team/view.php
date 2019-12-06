<?php
$this->load->view('_header');
$this->load->view('_sidebar');

$profile = new stdClass;
$profile->team_name		= 'N/A';
$profile->team_account  = 'ไม่มีนามเรียกขาน';
if(isset($detail)){
	$profile->team_name		= $team[$detail->team_id];	
	if($detail->team_account > 0 && $detail->team_account < 4294967295){
		$profile->team_account	= $team_account[$detail->team_account];
	}
}
?>
<div class="content content-view">
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
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#profile-basic" class="text-default">ข้อมูลพื้นฐาน</a></li>
					<li><a data-toggle="tab" href="#profile-contact">ข้อมูลการติดต่อ</a></li>
					<li><a data-toggle="tab" href="#profile-training">ข้อมูลการฝึกอบรม</a></li>
					<li><a data-toggle="tab" href="#profile-vehicle">ข้อมูลยานพาหนะ</a></li>

					<li class="pull-right"><a href="<?php echo $root; ?>team/edit/<?php echo $detail->id; ?>" class="btn btn-fill btn-warning">แก้ไข</a></li>
					<li class="pull-right"><a href="<?php echo $root; ?>team" class="btn btn-fill btn-default">กลับ</a></li>
				</ul>
				<div class="card">
					<div class="content tab-content">
						
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

								<div class="row">
									<div class="col-xs-12">										
										<h3><?php echo $profile->team_account ; ?></h3>
										<h5><?php echo $profile->team_name ; ?></h5>
										<hr>
									</div>
								</div>
							</div>
						</div>

						<?php						
						$this->load->view('team/viewBasic');
						$this->load->view('team/viewContact');
						$this->load->view('team/viewTraining');
						$this->load->view('team/viewVehicle');
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('_footer');
?>