<div id="profile-vehicle" class="tab-pane fade row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">		
		<?php 
		$js_var->index_vehicle = 0;
		if(isset($detail_vehicle) && $detail_vehicle !== false){
			foreach($detail_vehicle AS $vehicle_value){
				$v_detail = json_decode($vehicle_value->detail);
				$v_images = json_decode($vehicle_value->images);
		?>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								
								<input type="hidden" class="form-control" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][id]" value="<?php echo $vehicle_value->id; ?>">	
								<a data-toggle="collapse" href="#vehicle-<?php echo $vehicle_value->id;?>">
									<strong>[<?php if(isset($v_detail->brand)){ echo $v_detail->brand; }?>/<?php if(isset($v_detail->series)){ echo $v_detail->series; };?>]</strong>
								</a>
							</h4>
						</div>
						<div id="vehicle-<?php echo $vehicle_value->id;?>" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-xs-12 col-sm-3">
									<label for="brand">ยี่ห้อรถ</label>
									<input type="text" class="form-control" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][detail][brand]" placeholder="Toyota/Isuzu/Nissan" value="<?php if(isset($v_detail->brand)){ echo $v_detail->brand; } ?>">									
								</div>

								<div class="col-xs-12 col-sm-3">
									<label for="brand">รุ่น</label>
									<input type="text" class="form-control" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][detail][series]" value="<?php if(isset($v_detail->series)){ echo $v_detail->series; } ?>">									
								</div>

								<div class="col-xs-12 col-sm-3">
									<label for="brand">สี</label>
									<input type="text" class="form-control" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][detail][color]" value="<?php if(isset($v_detail->color)){ echo $v_detail->color; } ?>">									
								</div>

								<div class="col-xs-12 col-sm-3">
									<label for="brand">หมายเลขทะเบียน</label>
									<input type="text" class="form-control" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][detail][number]" value="<?php if(isset($v_detail->number)){ echo $v_detail->number; } ?>">									
								</div>

								<div class="col-xs-12 col-sm-6">
									<label for="brand">รูปรถด้านหน้า</label>
									<?php //$v_images->front; ?>
									<input type="file" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][front]">	
									<input type="hidden" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][images][front]">						
								</div>

								<div class="col-xs-12 col-sm-6">
									<label for="brand">รูปรถด้านหลัง</label>
									<?php //$v_images->behind; ?>
									<input type="file" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][behind]">	
									<input type="hidden" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][images][behind]">					
								</div>

								<div class="col-xs-12 col-sm-6">
									<label for="brand">รูปรถข้างซ้าย</label>
									<?php //$v_images->left; ?>
									<input type="file" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][left]">
									<input type="hidden" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][images][left]">					
								</div>

								<div class="col-xs-12 col-sm-6">
									<label for="brand">รูปรถข้างขวา</label>
									<?php //$v_images->right; ?>
									<input type="file" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][right]">	
									<input type="hidden" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][images][right]">				
								</div>

								<div class="col-xs-12">
									<label for="brand">เอกสารสำเนาประจำรถ</label>
									<?php //$v_images->copies; ?>
									<input type="file" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][copies]">
									<input type="hidden" class="" name="profile_vehicle[<?php echo $js_var->index_vehicle; ?>][images][copies]">					
								</div>


							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>

		<?php $js_var->index_vehicle++;
			}
		} ?>

	</div>
</div>