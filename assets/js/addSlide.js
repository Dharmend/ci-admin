/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addSlide");
	
	var validator = addUserForm.validate({
		
	});
});

function validatePreview() {
	var err = 0;
	$( ".required" ).each(function( index ) {
	  if($( this ).attr('disabled')=='' || $( this ).attr('disabled')=='disabled') {
		//do nothing
	  } else if ($( this ).val()=='') {
		err++;
	  } else {
		  //do nothing
	  }
	});
	
	if(err>0) {
		alert(err);
		var addUserForm = $("#addSlide");
		addUserForm.submit();
	} else {
		generatePreview();
		
	}
}
