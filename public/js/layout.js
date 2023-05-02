$( document ).ready(function() {

	/* $.ajax({
		url:'/unassignedEmployees',
		success:function(data){	
			$('.filteremployees').append(data);						
		}
	})
 */
	const floors = ["MZ","7","8","9","10"];
	let promises = [];
	floors.map(function(floor) {
		let request=$.ajax({
			url:'/layout/office/seat/'+floor,
			success:function(data){	
				$('#floor'+floor).html(data);						
			}
		})
		promises.push(request)
	});

$.when.apply(null, promises).then( function(){
	$('.2shared').hide();
	$('.3shared').hide();
	$('#floors').fadeIn('slow');	
    DragDropHandler()
		callmeman();
		DragDropHandler()
		dropenables()
		$( ".employeesassigned" ).on('drop',function(event,ui){
    		console.log(ui);
		$(ui.draggable)
			 .mouseover(function() {
          
		  $( this ).find( ".editEmp" ).show();
		 })
		 .mouseout(function() {
			$( this ).find( ".editEmp" ).hide();;
		 });
		});
    });
});

$("input[name=weekdays],input[name=shift]").click(function(){
	shiftAndDayValue()
});
function shiftAndDayValue(){
	var day = $("input[name=weekdays]:checked").val()			
	  var shift = $("input[name=shift]:checked").val()		
		$('.seatdiv').hide();
		$('.opendiv').hide();
		$('.'+shift+'shared.'+day).show();
		$('.'+shift+'shared.'+day).show();
		/*$('.checkboxesDays input:checked').each(function(i, obj) {
			if(day==$(this).val()){
				$(this).prop('disabled', true);
			}else{
				$(this).prop('disabled', false);
			}
			
		}) */
		
}

function closeWeekdayTip(id){
	$('.'+id).hide();
}

function buttoninfo(element) {
     $('.info'+element).show();
}

function showButton(element) {      
    $( element ).find( ".editEmp" ).show();
}

function hideButton(element) {
     $( element ).find( ".editEmp" ).hide();;
}

$("input[name=floor]").click(function(){
	let floorChecked = $("input[name=floor]:checked").val()
	if(floorChecked=='MZ'){
	$("#floorMZ").fadeIn('slow');
	$("#floor7").hide();
	$("#floor8").hide();
	$("#floor9").hide();
	$("#floor10").hide();
	}

	else if(floorChecked=='7'){
		$("#floorMZ").hide();
		$("#floor10").hide();
		$("#floor8").hide();
		$("#floor9").hide();
		$("#floor7").fadeIn('slow');
	}
	else if(floorChecked=='PH'){
		$("#floorMZ").hide();
		$("#floor7").hide();
		$("#floor8").hide();
		$("#floor10").fadeIn('slow');
		$("#floor9").hide();
	}

	else if(floorChecked=='9'){
		$("#floorMZ").hide();
		$("#floor7").hide();
		$("#floor9").fadeIn('slow');
		$("#floor8").hide();
		$("#floor10").hide();
	}

	else if(floorChecked=='8'){
		$("#floorMZ").hide();
		$("#floor8").fadeIn('slow');
		$("#floor7").hide();
		$("#floor9").hide();
		$("#floor10").hide();
	}
  });

function DragDropHandler(){
    $( ".employees li, .employeesassigned li" ).draggable({
			helper: function() {
					$(this).find('.avatar').show();
					$(this).find('.avatar').css("width", "25px");
					$(this).find('.avatar').css("height", "25px");	
					$(this).css("width", "25px");
					$(this).css("height", "65px");
					return $("<div style='opacity: 0.9; '></div>").append($(this).find('.avatar').clone());
			},	
 			
			
			start: function(event, ui) {			
				$(this).hide(); 
				$(this).find('ui.tooltip').remove();  
		 	},
			stop: function(event, ui) {
				$(this).css("opacity", "1"); 
				$(this).find('.avatar').css("width", "20px");
		 		$(this).find('.avatar').css("height", "20px");  
		 		$(this).fadeIn(); 
				var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
           		var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
            	$(this).css("left" , l);
            	$(this).css("top" , t);

				console.log($(this).position("left"));
				console.log(t);
          
	 		},	
		});

		$( ".employeesassigned" ).droppable({
			over: function(event, ui) {
				console.log(ui)
				dropenables()
   				if ($(this).has('.vat').length ) {
      				$(this).droppable('disable');
       			}else{
					$(this).droppable('enable');
				}
			},	

			drop: function(event, ui ) {
				if(!$(this).has("li."+$(ui.draggable).attr('value')).length){
					spotidBefore=$('li.'+$(ui.draggable).attr('value')).closest('ul').attr('id')
					spotSplitBefore = spotidBefore.split('-');
					spotUpdated=$(this).attr('id')
					spotSplitUpdated=spotUpdated.split('-');	
				$(ui.draggable).find('.avatar').css({top: '0px', left: '0px', position:'relative'});
 				$(ui.draggable).css("background", "initial");
				$(ui.draggable).css("border", "initial"); 
				ui.draggable.appendTo(this).fadeIn();
				
					if(spotSplitBefore[0].length>0){
						if(spotSplitBefore[0]!==spotUpdated[0]){
							$('.'+spotSplitBefore[0]).find("li.vat").remove();		
						}
					}		
				
				$(this).find("li.open").remove();
				callmeman();
 				$(ui.draggable).find('.avatar').addClass("picture"); 
 				$(ui.draggable).find('.picletters').addClass("Name");
				var dayf = $("input[name=weekdays]:checked").val()			
  				var shiftf = $("input[name=shift]:checked").val()
				$('.checkbox'+$(ui.draggable).attr('value')+' input:checked').each(function() {
					
					$(this).prop('checked', false);
					$(this).prop('disabled', false);
				})
				$('#checkbox'+$(ui.draggable).attr('value')+dayf).prop('checked', true);	
				$('#checkbox'+$(ui.draggable).attr('value')+dayf).prop('disabled', true);
				 
 				}
			}
		});
    		
		// $(".employees" ).droppable({
      	// 		activeClass: "hola",
      	// 		hoverClass: "lol",      				
      	// 		drop: function( event, ui ) {	
		// 			$(ui.draggable).css("border", "initial"); 
        // 			ui.draggable.prependTo(this).fadeIn();	 
		// 			dropenables();
		// 			callmeman();
		// 			$(ui.draggable).find('.avatar').removeClass("picture"); 
		// 			$(ui.draggable).find('.picletters').show(); 
		// 			$(ui.draggable).find('.picletters').removeClass("Name"); 
		// 			$(ui.draggable).find('.information').hide(); 
					
      	// 		}
    	// });		
}


function dropenables(){
	$('ul.employeesassigned').droppable('enable');	     	
}

function callmeman(){	
	$('ul.employeesassigned').each(function(i, obj) {
		if ($(obj).has('.vat').length ) {
			$(obj).css("border", "initial");
			idseat=$(obj).attr('id')
			$(this).find("li.open").remove();
		}  
		else {	 
			if(!$(obj).has('.open').length){  	
				$(obj).append('<li value=0 class="open"></li>');
			}
			$(obj).css("height","30px");
			$(obj).css("width","30px");
			$(obj).css("border", "3px dashed #1A436C");			
	 	}	 
	});
	shiftAndDayValue()
}	

function checkedboxes(obj,idemp){
	console.log(obj);
	
	var weekDay = $("input[name=weekdays]:checked").val()		
	spotid=$('li.'+idemp).closest('ul').attr('id')
	spotSplit = spotid.split('-');
	var arr=[]
	var arr2=[]
	
	$("input:checked", obj).each(function(value, index, self) {
		console.log('ul#'+spotSplit[0]+'-'+$(this).val()+'-'+spotSplit[2]);
		if(!$('ul#'+spotSplit[0]+'-'+$(this).val()+'-'+spotSplit[2]).has('.vat').length){
			$('li.'+idemp+':last').clone().appendTo('ul#'+spotSplit[0]+'-'+$(this).val()+'-'+spotSplit[2])
			arr.push($(this).val())
		}else{
			vel=$('ul#'+spotSplit[0]+'-'+$(this).val()+'-'+spotSplit[2]).children('li.vat').val()
			console.log(vel);
			if(vel!=idemp){
				alert("This seat is occupied by someone else in this day "+$(this).val())
				$('li.'+idemp).find('#checkbox'+idemp+$(this).val()).prop('checked', false)
			}
		}	
    });
	
	arr.forEach((element) => {
		$('li.'+idemp).find('#checkbox'+idemp+element).prop('checked', true)
	});
				
	$("input:not(:checked)", obj).each(function(value, index, self) {
		$('ul#'+spotSplit[0]+'-'+$(this).val()+'-'+spotSplit[2]).find("li."+idemp).remove();		
		arr2.push($(this).val())
	});
	
	arr2.forEach((element) => {
		$('li.'+idemp).find('#checkbox'+idemp+element).prop('checked', false)
	});

	callmeman()
	DragDropHandler()                
}

function switchBoxes(obj,idemp){
	var daysWeek=['Mo','Tu','We','Th','Fr']
	spotid=$('li.'+idemp).closest('ul').attr('id')
	spotSplit = spotid.split('-');

	if(obj.checked==true){
		daysWeek.forEach((element) => {
			for(i=1;i<4;i++){
				if(!$('ul#'+spotSplit[0]+'-'+element+'-'+i).has('.vat').length){
					$('li.'+idemp+':last').clone().appendTo('ul#'+spotSplit[0]+'-'+element+'-'+i)
				}
			}
			$('li.'+idemp).find('#checkbox'+idemp+element).prop('checked', true)
		});
		
		$('li.'+idemp).find('.checkboxesDays').hide()	
	}else{
		daysWeek.forEach((element) => {
			for(i=1;i<4;i++){
				if(element==spotSplit[1] && i==spotSplit[2]){
					$('li.'+idemp).find('.checkboxesDays').children('input[type=checkbox]').prop('checked', false);
					$('li.'+idemp).find('#checkbox'+idemp+element).prop('checked', true)
					
				}else{
					$('ul#'+spotSplit[0]+'-'+element+'-'+i).find("li.vat").remove();								
				}
			}
		});
		$('li.'+idemp).find('.checkboxesDays').show()
				
	}
	callmeman()
	DragDropHandler()
}