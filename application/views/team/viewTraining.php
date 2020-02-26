<div id="profile-training" class="tab-pane fade row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
		<?php 
		$html_training = 'ไม่พบข้อมูล';
		if(isset($detail_training) && $detail_training != ''){
			$html_training = '';
			foreach($detail_training AS $value_training){
				$training_data = $training[$value_training->training_id];
				$data = '<h5>['.$training_data->code.'] '.$training_data->name.'</h5>';
				$data .= '<h6>'.$training_data->trainer.' <span class="small">[ '.$training_data->training_date.' ]</span></h6>';

				$html_training .= '<div class="row content"><div class="col-xs-8">'.$data.'</div><div class="col-xs-4"></div></div>';
			}
		}
		echo $html_training;
		?>
	</div>
</div>