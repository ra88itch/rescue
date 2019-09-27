$(document).ready(function(){
	if(errorAction == 'success'){
		setTimeout(function(){
			window.location = base_url;
		}, 2000);
	}else if(errorAction == 'failed'){
		$('#password').focus();
	}else{
		$('#username').focus();
	}
});