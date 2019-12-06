<?php
$contact = new stdClass;
$mobile = '#';
$home = '#';
$email = '#';
$line = '#';
if(isset($detail_contact) && $detail_contact != ''){
	$contact->contact	= json_decode($detail_contact->contact, false);
	if($contact->contact->mobile != ''){
		$mobile = 'tel:'.$contact->contact->mobile;
	}
	if($contact->contact->home != ''){
		$home = 'tel:'.$contact->contact->home;
	}
	if($contact->contact->email != ''){
		$email = 'mailto:'.$contact->contact->email;
	}
	if($contact->contact->line != ''){
		$line = 'http://line.me/ti/p/~'.$contact->contact->line;
	}

	$contact->basic		= json_decode($detail_contact->basic, false);
	$contact->address	= json_decode($detail_contact->address, false);
	$contact->education = json_decode($detail_contact->education, false);
	$contact->insurance = json_decode($detail_contact->insurance, false);

}
?>
<div id="profile-contact" class="tab-pane fade row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

		<div class="row">
			<div class="col-xs-12">
				<h5>ข้อมูลการติดต่อ</h5>
			</div>

			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="title">โทรศัพท์มือถือ</label>
					<a class="btn btn-block btn-<?php if($mobile=='#'){ echo 'danger disabled'; }else{ echo 'success btn-fill'; } ?>" href="<?php echo $mobile; ?>"><i class="pe-7s-call"></i> <?php echo $contact->contact->mobile; ?></a>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="title">โทรศัพท์บ้าน</label>
					<a class="btn btn-block btn-<?php if($home=='#'){ echo 'danger disabled'; }else{ echo 'success btn-fill'; } ?>" href="<?php echo $home; ?>"><i class="pe-7s-call"></i> <?php echo $contact->contact->home; ?></a>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="title">อีเมล</label>
					<a class="btn btn-block btn-<?php if($email=='#'){ echo 'danger disabled'; }else{ echo 'success btn-fill'; } ?>" href="<?php echo $email; ?>"><i class="pe-7s-mail"></i> <?php echo $contact->contact->email; ?></a>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="title">ไลน์ ไอดี</label>
					<a class="btn btn-block btn-<?php if($line=='#'){ echo 'danger disabled'; }else{ echo 'success btn-fill'; } ?>" href="<?php echo $line; ?>"><i class="pe-7s-chat"></i> <?php echo $contact->contact->line; ?></a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#contact-family">ข้อมูลครอบครัว</a>
							</h4>
						</div>
						<div id="contact-family" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">สถานะภาพ</label>
										<h5><?php if($contact->basic->married != ''){ echo $contact->basic->married; }else{ echo '-'; } ?></h5>
									</div>
									<div class="form-group">
										<label for="title">ชื่อคู่สมรส</label>
										<h5><?php if($contact->basic->married_name != ''){ echo $contact->basic->married_name; }else{ echo '-'; } ?></h5>
									</div>
									<div class="form-group">
										<label for="title">จำนวนบุตร</label>
										<h5><?php if($contact->basic->parent != ''){ echo $contact->basic->parent; }else{ echo '-'; } ?></h5>
									</div>
									<div class="form-group">
										<label for="title">ชื่อบุตร</label>
										<h5><?php if($contact->basic->parent_name != ''){ echo str_replace('/','<br>',$contact->basic->parent_name); }else{ echo '-'; } ?></h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">ชื่อบิดา</label>
										<h5><?php if($contact->basic->father_name != ''){ echo $contact->basic->father_name; }else{ echo '-'; } ?></h5>
									</div>
									<div class="form-group">
										<label for="title">ชื่อมารดา</label>
										<h5><?php if($contact->basic->mother_name != ''){ echo $contact->basic->mother_name; }else{ echo '-'; } ?></h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#contact-address">ที่อยู่</a>
							</h4>
						</div>
						<div id="contact-address" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">ที่อยู่ปัจจุบัน</label>
										<h5><?php if($contact->address->current_address != ''){ echo $contact->address->current_address ; }else{ echo '-'; } ?></h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">ที่อยู่ตามทะเบียนบ้าน</label>
										<h5><?php if($contact->address->address != ''){ echo $contact->address->address ; }else{ echo '-'; } ?></h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#contact-education">การศึกษา</a>
							</h4>
						</div>
						<div id="contact-education" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="title">วุฒิการศึกษาสูงสุด</label>
										<h5><?php if($contact->education->degree != ''){ echo $contact->education->degree ; }else{ echo '-'; } ?></h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="title">สถานศึกษา</label>
										<h5><?php if($contact->education->education != ''){ echo $contact->education->education ; }else{ echo '-'; } ?></h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="title">สาขาวิชา</label>
										<h5><?php if($contact->education->major != ''){ echo $contact->education->major ; }else{ echo '-'; } ?></h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#contact-insurance">การรักษาพยาบาล/ประกัน</a>
							</h4>
						</div>
						<div id="contact-insurance" class="panel-collapse collapse">
							<div class="panel-body">
								<?php
								if($contact->insurance != ''){
									$html_insurance = '';
									foreach($contact->insurance AS $value_insurance){
										$html_insurance .=	'<div class="row"><div class="col-xs-12 col-sm-4"><div class="form-group">
																<label for="title">สิทธิการรักษาพยาบาล</label>	<h5>'.$value_insurance->medical_rights.'</h5>
															</div></div>';
										$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
																<label for="title">โรงพยาบาลที่เข้ารับการรักษา</label>	<h5>'.$value_insurance->medical_rights_hospital.'</h5>
															</div></div>';
										$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
																<label for="title">หน่วยงาน/บริษัทที่ทำประกัน</label>	<h5>'.$value_insurance->medical_rights_insurance.'</h5>
															</div></div></div>';
									}
								}else{
									$html_insurance = '-';
								}
								echo $html_insurance;
								?>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

	</div>
</div>