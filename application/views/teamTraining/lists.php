<?php
$this->load->view('_header');
$this->load->view('_sidebar');
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
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<div class="row">								
							<form method="GET" action="<?php echo $root; ?>training/lists">
								<div class="col-md-6">
									<input type="text" class="form-control" name="search" placeholder="ค้นหาชื่อ" value="<?php echo $this->input->get('search');?>">		
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-block btn-default btn-fill" value="search">ค้นหา</button>
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-block btn-primary btn-fill" onclick="window.location.href = '<?php echo $root; ?>training/create'">สร้างรายการใหม่</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">

				<div class="card">
					<div class="header">
						<h4 class="title">การฝึกอบรม</h4>
						<p class="category"><?php echo $team[$user->team_id]; ?></p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<tbody>
								<?php
								$html_team_account = '';
								if($lists != false){
									foreach($lists AS $value_team_account){
										$html_team_account .=	'<tr>
																<td>['.$value_team_account->code.'] - '.$value_team_account->name.'</td>
															';
										$html_team_account .=	'<td width="15%">
																<a href="'.$root.'teamTraining/edit/'.$value_team_account->id.'" class="btn btn-block btn-fill btn-warning">แก้ไข</a>
															</td>';
										$html_team_account .=	'<td width="15%">
																<form action="'.$root.'teamTraining/lists" method="post">
																<input type="hidden" name="id" value="'.$value_team_account->id.'">
																<button type="submit" name="submit" value="delete" class="btn btn-block btn-fill btn-danger">ลบ</button>
																</form>
															</td></tr>';
									}
								}else{
										//$html_team_account .=	'<tr><td class="text-center">ไม่มีข้อมูล</td><td></td><td></td></tr>';
								}
								echo $html_team_account;
								?>
							</tbody>
						</table>
					</div>



				</div>

			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('_footer');
?>