$(document).ready(function(){
	// All Document
	$('#message_x').click(function(){
		$('#messsage').addClass('hide');
	});
	document.addEventListener('touchmove', function(event) {
		event = event.originalEvent || event;
		if(event.scale > 1) {
			event.preventDefault();
		}
	}, false);
	document.addEventListener("contextmenu", function(event){
		event.preventDefault();
	}, false);
});