$( document ).ready(function() {
	 $( ".fa-power-off" ).click(function() {		
		if($(this).parent('div').find('.grid-input-text').attr('disabled')) {
			$(this).parent('div').find('.grid-input-text').removeAttr('disabled').css({'background-color':'#fff', 'color':'#000'});
			$(this).css({'color':'green'});
			
			//for cols
			var lastCol = 4;
			if($(this).attr('rel')==4 || $(this).attr('rel')==8 || $(this).attr('rel')==12 || $(this).attr('rel')==16 ) {
				$("#cols").val(4);
				lastCol = 4;
			}
			if($(this).attr('rel')==3 || $(this).attr('rel')==7 || $(this).attr('rel')==11 || $(this).attr('rel')==15 ) {
				if(lastCol != 4)
					$("#cols").val(3);
				lastCol = 3;
				
			} 
			if($(this).attr('rel')==2 || $(this).attr('rel')==6 || $(this).attr('rel')==10 || $(this).attr('rel')==14 ) {
				if(lastCol != 4 && lastCol != 3)
					$("#cols").val(2);
				lastCol = 2;
			} 
			//for rows
			var lastRow = 4;
			if($("#col-13").attr('disabled') && $("#col-14").attr('disabled') && $("#col-15").attr('disabled') && $("#col-16").attr('disabled')) {				
				lastRow = 3;
			}	
			if($("#col-9").attr('disabled') && $("#col-10").attr('disabled') && $("#col-11").attr('disabled') && $("#col-12").attr('disabled')) {
				if(lastRow==3)
					lastRow =2;
			}
			if($("#col-8").attr('disabled') && $("#col-7").attr('disabled') && $("#col-6").attr('disabled') && $("#col-5").attr('disabled')) {
				if(lastRow==2)
					lastRow =1;
			}
			$("#rows").val(lastRow);
			 
			
			
		} else {
			
			$(this).parent('div').find('.grid-input-text').attr('disabled', 'disabled').css({'background-color':'gray', 'color':'#000'});
			$(this).css({'color':'red'});
			
			
			//for rows
			var lastRow = 4;
			if($("#col-13").attr('disabled') && $("#col-14").attr('disabled') && $("#col-15").attr('disabled') && $("#col-16").attr('disabled')) {				
				lastRow = 3;
			}	
			if($("#col-9").attr('disabled') && $("#col-10").attr('disabled') && $("#col-11").attr('disabled') && $("#col-12").attr('disabled')) {
				if(lastRow==3)
					lastRow =2;
			}
			if($("#col-8").attr('disabled') && $("#col-7").attr('disabled') && $("#col-6").attr('disabled') && $("#col-5").attr('disabled')) {
				if(lastRow==2)
					lastRow =1;
			}
			$("#rows").val(lastRow);
			//console.log('lastRow'+lastRow);
			
			
			//for cols
			$("#cols").val(4);
			var lastCol = 4;
			if($("#col-4").attr('disabled') && $("#col-8").attr('disabled') && $("#col-12").attr('disabled') && $("#col-16").attr('disabled')) {
				$("#cols").val(3);
				lastCol = 3;
			}
			if($("#col-3").attr('disabled') && $("#col-7").attr('disabled') && $("#col-11").attr('disabled') && $("#col-15").attr('disabled')) {
				if(lastCol==3) {
					$("#cols").val(2);
					lastCol = 2;
				}
				
			}
			if($("#col-2").attr('disabled') && $("#col-6").attr('disabled') && $("#col-10").attr('disabled') && $("#col-14").attr('disabled')) {
				if(lastCol==2) {
					$("#cols").val(1);
				}
			}
			
			
			
			 
		}
		 
	});
	 
	 console.log('Ready function');
	$('#rows').on('change', function(){
		//console.log('Row change');
		drawGrid();
	});              
    $('#cols').on('change', function(){
		drawGrid();
	});     
	
 });
 
 function drawGrid() {
	var cols = parseInt($('#cols').val());
	var rows = $('#rows').val();
	$('.grid-input-text').attr('disabled', 'disabled');
	$( ".fa-power-off" ).css({'color':'red'});
	$('.grid-input-text').css({'background-color':'gray', 'color':'#fff'});
	var x=0;
	for(var i=0;i<rows;i++) {
		var x=i*4;	
		console.log('i-x==='+x);
		for(var j=1;j<=cols;j++) {
			 y=x+j;
			console.log('j-x=---=='+y);
			$('#col-'+y).removeAttr('disabled');
			$('#col-'+y).css({'background-color':'#fff', 'color':'#000'});
			$('#col-'+y).parent('div').find(".fa-power-off" ).css({'color':'green'});	
		}
	}
	$('#grid').show();
}

//generate slide preview
function generatePreview() {
	var rows = $('#rows').val();
	var cols = $('#cols').val();
	console.log('rows',rows);
	console.log('cols',cols);
	var str = '<table><tr><td colspan="4" class="heading">'+$('#title').val()+'</td></tr><tr><td colspan="4" class="title">'+$('#heading').val()+'</td></tr>';
	 str += '';	 
	var x=0;
	var s=0;
	for(var i=0;i<rows;i++) {
		var x=i*4;	
		s++;
		str += '<tr>';
		var tdArr = new Array();
		for(var j=1;j<=cols;j++) {
			y=x+j;
			var val = $('#col-'+y).val();
			if(val!='' && !$('#col-'+y).is(':disabled')) {
				tdArr.push(val);
				//str += '<td>'+val+'</td>';
			}				
		}
		
		for(var td =0;td<tdArr.length;td++) {
			var tdVal = tdArr[td];
			console.log('tdArr',tdArr.length);
			console.log('tdArr',tdVal);
			if(tdArr.length==1) {
				str += '<td colspan="4">'+tdVal+'</td>';
			}
			else if(tdArr.length==2) {
				str += '<td colspan="2">'+tdVal+'</td>';
			}
			else if(tdArr.length==3 && td==2) {
				str += '<td colspan="4">'+tdVal+'</td>';
			} else {
				str += '<td >'+tdVal+'</td>';
			}
			
		}
		console.log(str);
		str += '</tr>';	
	}
	 
	str += '</table>';
	//console.log(str);
	$('#flip3dSlider').html(str);
	//console.log(str);
}
