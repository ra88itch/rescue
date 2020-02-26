<?php

?>
<div id="profile-vehicle" class="tab-pane fade row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
		<div class="row">

			<div class="col-xs-12 col-sm-6 col-md-3">
				<img src="<?php echo $image_path; ?>" class="img-responsive center-block">
			</div>

			<div class="col-xs-12 col-sm-6 col-md-9">
				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-7">
						<div class="form-group">
							<label for="title">ชื่อ-สกุล</label>
							<h5><?php echo $detail->title.$detail->firstname,' ',$detail->lastname,' [',$detail->nickname,']'; ?></h5>
						</div>
						<div class="form-group">
							<label for="title">วัน/เดือน/ปี เกิด</label>
							<h5><?php echo $profile->dob; ?></h5>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-5">	
						<div class="form-group">
							<label for="title">รหัสประจำตัว</label>
							<h5><?php echo $detail->code; ?></h5>
						</div>										
						<div class="form-group">
							<label for="title">หมู่โลหิต</label>
							<h5><?php echo $profile->blood; ?></h5>
						</div>									
						<div class="form-group">
							<label for="title">สถานะ</label>
							<h5><?php echo $profile->status; ?></h5>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div>
</div>