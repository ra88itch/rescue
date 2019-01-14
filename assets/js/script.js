// SET STATIC PARAMS
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
var myNav = document.getElementById('myStickyNav');
if(myNav){
	var sticky = myNav.offsetTop;
}
var supplier_product = [];

// jQUERY Func
$(document).ready(function(){
	$("input[name='search']").keypress(function(e) {
		if(e.which == 13) {
			$( '.filter-form-submit' ).submit();
		}
	});
	if(myNav){
		$( window ).scroll(function() {
			sticky = sticky+50;
			if ($(window).scrollTop() >= sticky) {
				myNav.className = 'sticky';
			} else {
				myNav.className = '';
			}
		});
	}
	$('#res-nav').click(function(e){
		e.preventDefault();
		var x = document.getElementById('myTopnav');
		if (x.className === 'topnav text-center') {
			x.className += ' responsive';
		} else {
			x.className = 'topnav text-center';
		}	
	});
	setInit();
	setSelectInit();
});


// STATIC FUNC
function callJson( _url, _successfunction, _data  ){
	$.post(_url, _data, _successfunction , "json" );
}
function setInit(){
	$('.do-go-back').click(function(e){
		e.preventDefault();
		var back = $('.top-content .form-action-btn .back').attr('href');
		location = back; 
	});
	$('.do-filter-submit').click(function(e){
		$( '.filter-form-submit' ).submit();
	});
	
	$('#do-browse').click(function(e){
		$( '#fileToUpload' ).click();
	});	
	$( '#fileToUpload' ).change(function(e){	
		preview_image(e);
	});
	$('.do-change-submit').change(function(e){
		$( '.form-submit' ).submit();
	});
	$('.do-report-submit').change(function(e){
		$( '.form-report-submit' ).submit();
	});
	if($( '.form-submit' ).length > 0){
		if($( '.view-do-change-submit' ).length == 0){
			$('footer').show();
		}
		$('.do-submit').click(function(e){			
			window.onbeforeunload = null;
			$( '.form-submit' ).submit();
		});	
		
		$('.form-submit').submit(function( event ) {
			var validator = $(this).validate();
			validator.form();
			if(validator.form() == false){
				event.preventDefault();	
			}
		});	
	}else{
		$('footer').hide();
	}

	if(ask_before_leave != false ){
		window.onbeforeunload = function(event) {
			var s = "You have unsaved changes. Really leave?";

			event = event || window.event;
			if (event) {
				// This is for IE
				event.returnValue = s;
			}

			deleteTempUpload();

			// This is for all other browsers
			return s;
		}
	}

	zeroUploadDocument();

	$('#start-date').datetimepicker({
		 format: 'DD-MM-YYYY'
	});

	$('#end-date').datetimepicker({
		 format: 'DD-MM-YYYY'
	});

	$('#start-month').datetimepicker({
         viewMode: 'months',
		 format: 'MM-YYYY'
	});

	$('#end-month').datetimepicker({
         viewMode: 'months',
		 format: 'MM-YYYY'
	});

	$('.select-filter-form-submit').change(function(e){
		$( '#submit' ).click();
	});
}
function preview_image(event) {
	var reader = new FileReader();
	reader.onload = function(){
		$('.image_preview_frame').css('background', '#fff url('+ reader.result +') no-repeat center center / cover');
	}
	reader.readAsDataURL(event.target.files[0]);
}
function setSelectInit(){
	$('.select-do-change-submit').change(function(e){
		var thisVal = $(this).val();
		var thisID = $(this).attr('id');
		thisID = thisID.replace('id', '');

		if(thisVal != ''){
			if(thisVal == 'delete'){
				if (confirm('Confirm delete')) {
					location = root + module + '/' + thisVal +'/'+ thisID; 
				}			
			}
			location = root + module + '/' + thisVal + '/' + thisID;
		}
	});

	$('.select-do-setting-change-submit').change(function(e){
		var thisVal = $(this).val();
		var thisMethd = $(this).attr('methd');
		var thisID = $(this).attr('id');
		thisID = thisID.replace('id', '');

		if(thisVal != ''){
			if(thisVal == 'delete'){
				if (confirm('Confirm delete')) {
					location = root + module + '/' + thisMethd + '/' + thisVal + '/' + thisID;
				}			
			}
			location = root + module + '/' + thisMethd + '/' + thisVal + '/' + thisID;
		}
	});
}

function uploadDocument(met){
	var formData = new FormData($('.form-submit')[0]);	
	console.log(formData);

	$.ajax({
		url: root + 'upload/'+met+'/',
		type: 'POST',
		enctype: 'multipart/form-data',
		data: formData,
		dataType: 'json',
		cache: false,
		contentType: false,
		processData: false,
		success: function(response) {
			if(response.errorCode == '0'){
				var html = '<div class="col-xs-9"><i class="fa fa-file" aria-hidden="true"></i> '+response.fullname+'</div><div class="col-xs-3"><a href="'+response.del_path+'" class="form-control btn btn-danger">DELETE</a></div>';
				$('#document-lists').append(html);
			}else{
				alert(response.error_massage);
			}
		},
		error: function() {
			alert('ไม่สามารถอัพโหลดรายการได้');		
		}
	});
	$('.upload-product-document, .upload-import-document').val(''); //.upload-import-document

}

function zeroUploadDocument(){
	// Set our target URL
	var _temp = $('#_temp').val();
	ZeroUpload.setURL( root + 'upload/'+module+'Documents/'+module_id+'/'+_temp );
	
	// Set the maximum upload size (should match your server-side limit)
	ZeroUpload.setMaxBytes( 8 * 1024 * 1024 ); // 8 MB
	
	// Now let's define some event listeners...
	
	ZeroUpload.on( 'start', function(files, userData) {
		// Upload has started
		// `files` is an array of files queued for upload
		// `userData` is your user data value, if applicable
		$("#upload-bar").text('0%');
		$("#upload-bar").width('0%');
		$('#upload-progress').show();
	} );
	
	ZeroUpload.on('progress', function(progress, userData) {
		// Upload is in progress.
		// `progress.amount` is the upload progress from 0.0 to 1.0
		// `progress.percent` is the textual percentage, e.g. "50%"
		// 'userData' is your user data value, if applicable.
		$("#upload-bar").text(progress.percent);
		$("#upload-bar").width(progress.percent);
	} );
	
	ZeroUpload.on('complete', function(response, userData) {
		// Upload is complete!
		// `response.code` is the HTTP response code, e.g. 200
		// `response.data` is the raw data from the server
		// 'userData' is your user data value, if applicable.
		response = jQuery.parseJSON(response.data);
		if(response.errorCode == '0'){			
			$('#upload-progress').hide();
			$('#document-lists').append(response.del_path_html);
		}else{	
			$('#upload-progress').hide();
			alert($(response.error_massage).text());
		}
	} );
	
	ZeroUpload.on('error', function(type, msg, userData) {
		// An error occurred!
		// 'type' will be one of the error IDs shown below.
		// 'message' is the error description string.
		// 'userData' is your user data value, if applicable.
		//$('#results').html( '<span style="font-weight:bold; color:red;">ERROR: [' + type + "]: " + msg + '</span>' );
		alert(msg);
	} );
	
	// Initialize library
	ZeroUpload.init();
	
	// Assign our drop target
	ZeroUpload.addDropTarget( '#mydrop' );
}
function uploadMoveStart(){
}
function uploadMoveProgress(progress){	
	console.log(progress);
}
function uploadMoveComplete(html){
}


function setMaterialInit(){
	adjustMaterialRequestQty();
}

function setMaterialProduct(response){

}

function adjustMaterialRequestQty(){	
	$('.do-adjust-up').click(function(e){
		var thisID = $(this).attr('id');		
		thisID = thisID.replace('do-adjust-up-', '');
		
		var this_qty = $('#response-request-qty-'+thisID).val();
		doAdjustMaterialRequestQty(thisID,this_qty,'add');
	});
	$('.do-adjust-down').click(function(e){
		var thisID = $(this).attr('id');		
		thisID = thisID.replace('do-adjust-down-', '');
		
		var this_qty = $('#response-request-qty-'+thisID).val();
		doAdjustMaterialRequestQty(thisID, this_qty,'remove');
	});
	$('.response-request-qty').change(function(e){
		var thisID = $(this).attr('id');		
		thisID = thisID.replace('response-request-qty-', '');
		
		var this_qty = $(this).val();
		doAdjustMaterialRequestQty(thisID, this_qty,'manual');
	});
	
}
function doAdjustMaterialRequestQty(product, qty, adjust){
	var balance = $('#balance-product-'+product).val();
	if(adjust == 'add'){
		qty++;
	}else if(adjust == 'remove'){
		qty--;	
	}

		
	if(module == 'materialTemplate'){
		callJson( root+'api/adjustTemplate/', setCookieMKTMR, { product:product, qty:qty } );	

		if(qty > 0){
			$('#response-request-qty-'+product).val(qty);	
		}else{
			$('#request-material-'+product).hide();	
		}
	
	}else{
		if(qty > balance){	
			alert('Your material not enough to request.');
			$('#response-request-qty-'+product).val(balance);	
		}else{	
			callJson( root+'api/adjustCart/', setCookieMKTMR, { product:product, qty:qty } );

			if(qty > 0){
				$('#response-request-qty-'+product).val(qty);	
			}else{
				$('#request-material-'+product).hide();	
			}	
		
		}		
	}
}

function setCookieMKTMR(response, status, xhr){
	console.log('response');
	console.log(response);
	console.log('status');
	console.log(status);
	console.log('xhr');
	console.log(xhr);
}

function deleteTempUpload(){
	callJson( root+'api/deleteTempUpload/', setCookieMKTMR, { deleted:'temp' } );
}

function setMovement(){
	$('.movement-do-change-submit').change(function(e){
		var thisVal = $(this).val();
		var thisID = $(this).attr('id');
		thisID = thisID.replace('id', '');

		if(thisVal == 'view' || thisVal == 'edit'){	
			var thisHREF = $(this).attr('data-'+thisVal);	
			console.log(thisHREF);
			location = thisHREF;
		}else{	
			var href = location.href;		
			$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(location.href);
				if(results != null){
					return results[1] || '';				
				}else{
					return null;
				}
			}
			var data = $.urlParam('data');
			var search = $.urlParam('search');

			if(thisVal != ''){
				if(data == null){
					var new_href = href + '?data=' + thisID;	
				}else{			
					var new_href = href + '%2C' + thisID;			
				}			
			}else{
				var dataArr = data.split('%2C');
				dataArr.splice( $.inArray(thisID, dataArr), 1 );

				if(search != null){
					var new_href = 'http://' + location.hostname + location.pathname + '?part_machine='+$.urlParam('part_machine')+'&category='+$.urlParam('category')+'&shelf='+$.urlParam('shelf')+'&search='+$.urlParam('search')+'&data=' + dataArr.join('%2C');
					}else{			
					var new_href = 'http://' + location.hostname + location.pathname + '?data=' + dataArr.join('%2C');		
				}
			} 		
			location.href = new_href;
		}
	});
}