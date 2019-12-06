<div id="profile-training" class="tab-pane fade row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#profile-training-collapse">ข้อมูลการฝึกอบรม</a>
							</h4>
						</div>
						<div id="profile-training-collapse" class="panel-collapse collapse in">
							<div class="panel-body profile-training" id="profile-training-form">
							<?php 
							$html_training = '<p class="text-center">ไม่พบข้อมูล</p>';
							$js_var->index_training = 0;
							if(isset($detail_training) && $detail_training !== false){
								$html_training = '';
								foreach($detail_training AS $value_training){
									$training_data = $training[$value_training->training_id];
									$data = '<h5>['.$training_data->code.'] '.$training_data->name.'</h5>';
									$data .= '<h6>'.$training_data->trainer.' <span class="small">[ '.$training_data->training_date.' ]</span></h6>';

									$form  = '<input type="hidden" name="profile_training['.$js_var->index_training.'][id]" value="'.$value_training->id.'">';
									$form .= '<input type="hidden" name="profile_training['.$js_var->index_training.'][profile_id]" value="'.$value_training->profile_id.'">';
									$form .= '<input type="hidden" name="profile_training['.$js_var->index_training.'][training_id]" value="'.$value_training->training_id.'">';
									$form .= '<input type="hidden" name="profile_training['.$js_var->index_training.'][image]" value="'.$value_training->image.'">';
									$form .= '<input type="hidden" name="profile_training['.$js_var->index_training.'][do]" value="" id="do_training'.$value_training->id.'">';
									$form .= '<button type="button" class="btn btn-block btn-danger btn-fill btn-delete-training" value="training'.$value_training->id.'" id="btn_delete_training'.$value_training->id.'">ลบ</button>';
									

									$html_training .= '<div class="row content" id="training'.$value_training->id.'"><div class="col-xs-6">'.$data.'</div><div class="col-xs-3"></div><div class="col-xs-3">'.$form.'</div></div>';

									$js_var->index_training++;
								}
							}
							echo $html_training;
							?>
							</div>
							<div class="panel-body no-border">
								<div class="row"><div class="col-xs-12"><hr></div></div>
								<div class="row">
									<div class="col-xs-12">
										<button type="button" class="btn btn-fill btn-block btn-primary" id="add-training">เพิ่มรายการ</button>
									</div>
								</div>
								<div class="row hidden">
								<?php
								$html_select_training_template = '<select class="form-control" id="select-training-template">';
									$html_select_training_template .= '<option value="">กรุณาเลือกการอบรม</option>';
								foreach($training AS $value_training){
									if($value_training->id != '0'){
										$html_select_training_template .= '<option value="'.$value_training->id.'">['. $value_training->code.' - '. $value_training->trainer.'] - '. $value_training->name.'</option>';
									
									}
								}
								$html_select_training_template .= '</select>';
								echo $html_select_training_template;
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

	</div>
</div>