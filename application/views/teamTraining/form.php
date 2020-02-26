<?php
$this->load->view('_header');
$this->load->view('_sidebar');

$team = $team[0];
$team_prefix = json_decode($team->name_prefix);
//var_dump($team_prefix);

$js_var = new stdClass;
$submit = 'create';
if(isset($detail)){
	$js_var->detail_id = $detail->id;
	$submit = 'update';
}
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

					<div class="header">
						<h4 class="title">การฝึกอบรม</h4>
						<p class="category"><?php echo $team->fullname; ?></p>
					</div>

					<div class="content">	
					<hr>
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label for="mobile">ชื่อหลักสูตร<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" name="code" placeholder="เช่น EMR, EMT" value="<?php if(isset($detail)){ echo $detail->code; } ?>" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label for="mobile">ชื่อเต็ม<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" name="name" placeholder="" value="<?php if(isset($detail)){ echo $detail->name; } ?>" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label for="mobile">หน่วยงานที่จัดฝึกอบรม<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" name="trainer" placeholder="" value="<?php if(isset($detail)){ echo $detail->trainer; } ?>" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label for="mobile">วันที่จัดฝึกอบรม<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" name="training_date" placeholder="" value="<?php if(isset($detail)){ echo $detail->training_date; } ?>" required>
								</div>
							</div>
						</div>

						<input type="hidden" name="do" value="<?php echo $submit; ?>">
						<?php 
						if(isset($detail) && $detail != false){
						echo '<input type="hidden" name="id" value="'.$detail->id.'">';
						}
						// require_once('teamTrainingFormSubmit.php'); 
						$this->load->view('teamTraining/formSubmit');
						?>
						
					</div>
				</div>
</form>
			</div>
		</div>
	</div>
</div>
<?php
$footerResponse = new stdClass;
$footerResponse->js_var = $js_var;
$this->load->view('_footer', $footerResponse);
?>