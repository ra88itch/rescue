<?php

$this->load->view('_header');
$this->load->view('_sidebar');
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
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<div class="row">								
							<form method="GET" action="<?php echo $root; ?>team/lists">
								<div class="col-md-6">
									<input type="text" class="form-control" name="search" placeholder="ค้นหาชื่อ" value="<?php echo $this->input->get('search');?>">		
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-block btn-default btn-fill" value="search">ค้นหา</button>
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-block btn-primary btn-fill" onclick="window.location.href = '<?php echo $root; ?>team/create'">สร้างรายการใหม่</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">

						<div class="row">
						<?php 
						$html = '<div class="col-xs-12 text-center">ไม่มีข้อมูล "'.$this->input->get('search').'"</div>';
						if(isset($lists) && $lists != false){ 
							$html = '';											
							foreach($lists AS $detail){
								$image_path = 'data:image/png;base64,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';
								if($detail->image != ''){
									$image_path = $root.'assets/uploads/'.$detail->image;
								}	

								$age = 'N/A';
								if($detail->dob != '0000-00-00'){
									$birth_year = DATE('Y', strtotime($detail->dob));
									$current_year = DATE('Y');
									$age = $current_year - $birth_year;
								}

								$image_disabled = '';											
								
								$account = 'ไม่มีนามเรียกขาน';
								if($detail->team_account > 0 && $detail->team_account < 4294967295){
									$account = $team_account[$detail->team_account];
								}

								switch($detail->status){
									case 10:
										$status_class = ' text-warning';
										break;

									case 100:
										$status_class = ' text-danger';
										break;

									default:
										$status_class = '';
										break;
								}

								$hotline = '#';
								$hotline_class = 'danger disabled';
								if($detail->hotline != ''){
									$hotline = 'tel:'.$detail->hotline;
									$hotline_class = 'success btn-fill';
								}

								

								$html .= '
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-2'.$status_class.'">
							<p>
								<img src="'.$image_path.'" class="img-responsive center-block">
							</p>
							<p><label>รหัสประจำตัว : </label> '.$detail->code.'</p>
							<p><label>นามเรียกขาน : </label> '.$account.'</p>
							<p><label>ชื่อ : </label> '.$detail->firstname.' ['.$detail->nickname.']</p>
							<p><label>สกุล : </label> '.$detail->lastname.'</p>
							<p>
								<label>สถานะ : </label> '.$status[$detail->status].'
								<span class="pull-right"><label>อายุ : </label> '.$age.'</span>
							</p>
							<p class="text-center">												
								<a class="btn btn-block btn-'.$hotline_class.'" href="'.$hotline.'"><i class="pe-7s-call"></i> '.$detail->hotline.'</a>
							</p>
							<p class="text-center">												
								<a class="btn btn-block btn-info btn-fill" href="'.$root.'team/view/'.$detail->id.'">เรียกดู</a>
							</p>
							<p class="text-center">												
								<a class="btn btn-block btn-warning btn-fill" href="'.$root.'team/edit/'.$detail->id.'">แก้ไข</a>
							</p>
							<p class="text-center">	
								<form method="POST" action="#">
								<input type="hidden" name="id" value="'.$detail->id.'">
								</form>
							</p>
						</div>';
						/*
								<button type="submit" name="submit" class="btn btn-block btn-warning btn-fill" value="holiday">
									ระงับรหัส
								</button>
								<button type="submit" name="submit" class="btn btn-block btn-danger btn-fill" value="delete">
									พ้นสภาพ
								</button>*/
							}
						}
						echo $html;
						?>
						</div>
											
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		if(isset($pagination) && $pagination != false){ ?>
		<div class="row">
			<div class="col-md-12 text-right">
			<?php echo $pagination; ?>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
<?php
$this->load->view('_footer');
?>