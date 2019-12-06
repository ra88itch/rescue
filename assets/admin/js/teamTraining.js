$(document).ready(function(){	
	$('.btn-form-submit').click(function (){
		var thisID = $(this).attr('id');
		switch(thisID) {
			case 'form-submit-create':
				var form_action = root+'teamTraining/create';
				break;

			case 'form-submit-edit':
				var form_action = root+'teamTraining/edit/'+detail_id;
				break;

			default:
				var form_action = root+'teamTraining/lists';
		} 

		$('#form-submit').attr('action', form_action);

		if($("#form-submit").valid() === true){
			$('#form-submit').submit();		
		}
	});
});