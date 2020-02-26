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
						<h4 class="title">นามเรียกขาน</h4>
						<p class="category"><?php echo $team->fullname; ?></p>
					</div>

					<div class="content">
						
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="<?php echo $team_prefix->prefix->th; ?>" value="<?php if(isset($detail)){ echo $detail->name; }else{ echo $team_prefix->prefix->th; } ?>" required>
								</div>
							</div>
						</div>

						<input type="hidden" name="do" value="<?php echo $submit; ?>">
						<?php 
						if(isset($detail) && $detail != false){
						echo '<input type="hidden" name="id" value="'.$detail->id.'">';
						}
						$this->load->view('formSubmit');
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