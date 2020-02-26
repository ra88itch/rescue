$(document).ready(function(){
	$('#add-insurance').click(function (){
		var html_insurance =	'<div class="row"><div class="col-xs-12"><hr></div></div>';
		
		html_insurance +=	'<div class="row"><div class="col-xs-12 col-sm-4"><div class="form-group"><input type="text" class="form-control" name="profile_detail[insurance]['+index_insurance+'][medical_rights]" placeholder="สิทธิการรักษาพยาบาล" value=""></div></div>';

		html_insurance +=	'<div class="col-xs-12 col-sm-4"><div class="form-group"><input type="text" class="form-control" name="profile_detail[insurance]['+index_insurance+'][medical_rights_hospital]" placeholder="โรงพยาบาลที่เข้ารับการรักษา" value=""></div></div>';

		html_insurance +=	'<div class="col-xs-12 col-sm-4"><div class="form-group"><input type="text" class="form-control" name="profile_detail[insurance]['+index_insurance+'][medical_rights_insurance]" placeholder="หน่วยงาน/บริษัทที่ทำประกัน" value=""></div></div></div>';

		index_insurance++;

		$('#contact-insurance .panel-body.contact-insurance').append(html_insurance);
	});

	$('#add-training').click(function (){
		var html_training =	'<div class="row"><div class="col-xs-12"><hr></div></div>';

		html_training +=	'<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">';
		
		html_training +=	'<select class="form-control" name="profile_training['+index_training+'][training_id]">';
		html_training +=	$('#select-training-template').html();		
		html_training +=	'</select>';	
		html_training +=	'<input type="hidden" name="profile_training['+index_training+'][do]" value="add">';	
		html_training +=	'</div>';

		index_training++;

		$('#profile-training #profile-training-form').append(html_training);
	});
	
	$('.btn-form-submit').click(function (){
		var thisID = $(this).attr('id');
		switch(thisID) {
			case 'form-submit-create':
				var form_action = root+current_location+'/create';
				break;

			case 'form-submit-edit':
				var form_action = root+current_location+'/edit/'+detail_id;
				break;

			default:
				var form_action = root+current_location+'/lists';
		} 

		$('#form-submit').attr('action', form_action);
		
		var img_data = cropper.getDataURL();
		$("#image-data").val(img_data);

		if($("#form-submit").valid() === true){
			$('#form-submit').submit();		
		}
	});
	
	$('.btn-delete-training').click(function (){
		var thisVal = $(this).val();
		$('#'+thisVal).toggleClass('text-danger');

		$(this).toggleClass('btn-danger');
		var btn_delete_training = $(this).html();
		if(btn_delete_training == 'ลบ'){
			$(this).html('ยกเลิก');
			$('#do_'+thisVal).val('delete');
		}else{
			$(this).html('ลบ');	
			$('#do_'+thisVal).val('');		
		}
	});
    
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: 'avatar.png'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		this.files = [];
	})
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
	})
	$('.btn-browse-image').on('click', function(){
		$('#file').click();
	})
});