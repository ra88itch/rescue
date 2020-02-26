<?php
$contact = new stdClass;
if(isset($detail_contact) && $detail_contact != ''){
	$contact->contact	= json_decode($detail_contact->contact, false);
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
					<label for="mobile">โทรศัพท์มือถือ<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="profile_detail[contact][mobile]" placeholder="โทรศัพท์มือถือ" value="<?php 
					if(isset($contact->contact)){ 
						echo $contact->contact->mobile; 
					} ?>" required>	
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="home">โทรศัพท์บ้าน</label>
					<input type="text" class="form-control" name="profile_detail[contact][home]" placeholder="โทรศัพท์มือถือ" value="<?php 
					if(isset($contact->contact)){ 
						echo $contact->contact->home; 
					} ?>">	
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="email">อีเมล</label>
					<input type="text" class="form-control" name="profile_detail[contact][email]" placeholder="โทรศัพท์มือถือ" value="<?php 
					if(isset($contact->contact)){ 
						echo $contact->contact->email; 
					} ?>">	
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="form-group">
					<label for="line">ไลน์ ไอดี</label>
					<input type="text" class="form-control" name="profile_detail[contact][line]" placeholder="โทรศัพท์มือถือ" value="<?php 
					if(isset($contact->contact)){ 
						echo $contact->contact->line; 
					} ?>">	
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
						<div id="contact-family" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="married">สถานะภาพ</label>
										<input type="text" class="form-control" name="profile_detail[basic][married]" placeholder="สถานะภาพ" value="<?php 
										if(isset($contact->basic)){ 
											echo $contact->basic->married; 
										} ?>">	
									</div>
									<div class="form-group">
										<label for="married_name">ชื่อคู่สมรส</label>
										<input type="text" class="form-control" name="profile_detail[basic][married_name]" placeholder="ชื่อคู่สมรส" value="<?php 
										if(isset($contact->basic)){ 
											echo $contact->basic->married_name; 
										} ?>">	
									</div>
									<div class="form-group">
										<label for="parent">จำนวนบุตร</label>
										<input type="text" class="form-control" name="profile_detail[basic][parent]" placeholder="จำนวนบุตร" value="<?php 
										if(isset($contact->basic)){ 
											echo $contact->basic->parent; 
										} ?>">	
									</div>
									<div class="form-group">
										<label for="parent_name_">ชื่อบุตร (กรณีมีมากกว่า 1 ให้ใช้ "/" คั่น)</label>
										<input type="text" class="form-control" name="profile_detail[basic][parent_name]" placeholder="ชื่อบุตร" value="<?php 
										if(isset($contact->basic->parent_name)){ 
											echo $contact->basic->parent_name; 
										} ?>">	
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="father_name">ชื่อบิดา</label>
										<input type="text" class="form-control" name="profile_detail[basic][father_name]" placeholder="ชื่อบิดา" value="<?php 
										if(isset($contact->basic)){ 
											echo $contact->basic->father_name; 
										} ?>">	
									</div>
									<div class="form-group">
										<label for="mother_name">ชื่อมารดา</label>
										<input type="text" class="form-control" name="profile_detail[basic][mother_name]" placeholder="ชื่อมารดา" value="<?php 
										if(isset($contact->basic)){ 
											echo $contact->basic->mother_name; 
										} ?>">	
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
						<div id="contact-address" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">ที่อยู่ปัจจุบัน</label>
										<textarea class="form-control" name="profile_detail[address][current_address]" placeholder="ที่อยู่ปัจจุบัน"><?php 
										if(isset($contact->address->current_address) && $contact->address->current_address != ''){ echo $contact->address->current_address ; }else{ echo '-'; } 
										?></textarea>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label for="title">ที่อยู่ตามทะเบียนบ้าน</label>
										<textarea class="form-control" name="profile_detail[address][address]" placeholder="ที่อยู่ตามทะเบียนบ้าน" required><?php 
										if(isset($contact->address->address) && $contact->address->address != ''){ echo $contact->address->address ; }else{ echo '-'; } 
										?></textarea>
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
						<div id="contact-education" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="degree">วุฒิการศึกษาสูงสุด</label>
										<input type="text" class="form-control" name="profile_detail[education][degree]" placeholder="วุฒิการศึกษาสูงสุด" value="<?php 
										if(isset($contact->education)){ 
											echo $contact->education->degree; 
										} ?>">	
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="education">สถานศึกษา</label>
										<input type="text" class="form-control" name="profile_detail[education][education]" placeholder="สถานศึกษา" value="<?php 
										if(isset($contact->education)){ 
											echo $contact->education->education; 
										} ?>">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label for="major">สาขาวิชา</label>
										<input type="text" class="form-control" name="profile_detail[education][major]" placeholder="สาขาวิชา" value="<?php 
										if(isset($contact->education)){ 
											echo $contact->education->major; 
										} ?>">
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
						<div id="contact-insurance" class="panel-collapse collapse in">
							<div class="panel-body contact-insurance">
								<?php
								$js_var->index_insurance = 0;
								$html_insurance = '';
								if(isset($contact->insurance) && $contact->insurance != ''){
									foreach($contact->insurance AS $value_insurance){
									$html_insurance .=	'<div class="row"><div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights]" placeholder="สิทธิการรักษาพยาบาล" value="'.$value_insurance->medical_rights.'">
														</div></div>';
									$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights_hospital]" placeholder="โรงพยาบาลที่เข้ารับการรักษา" value="'.$value_insurance->medical_rights_hospital.'">
														</div></div>';
									$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights_insurance]" placeholder="หน่วยงาน/บริษัทที่ทำประกัน" value="'.$value_insurance->medical_rights_insurance.'">
														</div></div></div>';

									$js_var->index_insurance++;
									}
								}else{
									$html_insurance .=	'<div class="row"><div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights]" placeholder="สิทธิการรักษาพยาบาล" value="">
														</div></div>';
									$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights_hospital]" placeholder="โรงพยาบาลที่เข้ารับการรักษา" value="">
														</div></div>';
									$html_insurance .=	'<div class="col-xs-12 col-sm-4"><div class="form-group">
															<input type="text" class="form-control" name="profile_detail[insurance]['.$js_var->index_insurance .'][medical_rights_insurance]" placeholder="หน่วยงาน/บริษัทที่ทำประกัน" value="">
														</div></div></div>';
									$js_var->index_insurance ++;
								}
								echo $html_insurance;
								?>
							</div>
							<div class="panel-body no-border">
								<div class="row"><div class="col-xs-12"><button type="button" class="btn btn-fill btn-block btn-primary" id="add-insurance">เพิ่มรายการ</button></div></div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

	</div>
</div>