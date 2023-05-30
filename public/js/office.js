$( document ).ready(function() {

	$.ajax({
	   url:'/layout/office/unassignedEmployees',
	   success:function(data){	
		   $('.filterunassignedemployees').append(data);						
	   }
   })

   $.ajax({
	   url:'/layout/office/assignedEmployees',
	   success:function(data){	
		   $('.filterEmpInLayout').append(data);						
	   }
   })

   const floors = ["MZ","7","8","9","10"];
   let promises = [];
   floors.map(function(floor) {
	   let request=$.ajax({
		   url:'/layout/office/seat/'+floor,
		   async : true,
		   success:function(data){	
			   $('#floor'+floor).html(data);						
		   }
	   })
	   promises.push(request)
   });
   
$.when.apply(null, promises).then( function(){
	$('#Mo').click();
   	$('#MZ').click();
   	$('#1').click();
	$('#floors').fadeIn('slow');	
	callmeman(false);
	$('.spinload').remove();

   });
});

$("input[name=weekdays],input[name=shift]").click(function(){
   shiftAndDayValue()
});

function shiftAndDayValue(){
   var day = $("input[name=weekdays]:checked").val()	
   var shift = $("input[name=shift]:checked").val()
	cleanlookforSeatEmployee()
	   $('.seatdiv').hide();
	   $('.opendiv').hide();
	   $('.'+shift+'shared.'+day).show();
	   $('.admin.'+day).show(); 
	   $('.checkboxesDaysMultiple input:checked').each(function() {		   
			$(this).prop('checked', false);
			$(this).prop('disabled', false);
		})
	   $('#checkboxMultiple'+day).prop('checked',true);
	   $('#checkboxMultiple'+day).prop('disabled',true);
	//    $('.admin').show();

}

function showButton(element) {   
   $('.divseat').css('z-index', 0);
   
   if($(element).attr('data-element')=='employee')  {
	   $( element ).find( ".editEmp" ).show();	
	   seatId=$('li.'+element.value).closest("ul").attr('id');
	   
	   $('#divseat'+seatId).css('z-index', 1);
   }else{

	   $('#divseat'+element.value).css('z-index', 1);
   }
}

function hideButton(element) {
	$( element ).find( ".editEmp" ).hide();
   //  $('.divseat').css('z-index', 0);
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
		   
			}
	   });

	   $( ".employeesassigned" ).droppable({
		   over: function(event, ui) {
		   
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
				   var daysWeek=['Mo','Tu','We','Th','Fr']
					   
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
			  
				$(ui.draggable).find('.avatar').addClass("picture"); 
				$(ui.draggable).find('.picletters').addClass("Name");
			    var dayf = $("input[name=weekdays]:checked").val()			
			 	 var shiftf = $("input[name=shift]:checked").val()
			    $('.checkbox'+$(ui.draggable).attr('value')+' input:checked').each(function() {		
				   $(this).prop('checked', false);
				   $(this).prop('disabled', false);
			   })  
			   $('.checkboxesDaysMultiple input:checked').each(function() {
					$('#checkbox'+$(ui.draggable).val()+$(this).val()).prop('checked', true);
			   })
			   $('#checkbox'+$(ui.draggable).attr('value')+dayf).prop('checked', true);	
			   $('#checkbox'+$(ui.draggable).attr('value')+dayf).prop('disabled', true);
			 $(ui.draggable).addClass("edited"); 
			   oldSeat=$(ui.draggable).attr("data-seat")
			console.log(oldSeat);
		   
			   if(oldSeat== "unassigned" ){
				   $(this).removeClass('Mo Tu We Th Fr')
				   $(this).addClass(dayf)
				   
				   daysWeek.forEach((element) => {
					   if(element!=dayf){
						   $('#divseat'+$(this).attr("id")).find('.opendiv').addClass(element)
					   }
				   });

			   }
		   
			 
			   

			   $(this).prop('checked', false);
			   $(ui.draggable).attr("data-seat",$(this).attr("id"))
			   seatShift=$(this).attr("id").split('-');
			   ulSpot=$(this).attr('id')
			   
			   $('#'+ulSpot).removeClass('Mo Tu We Th Fr');
			   daysArr=[]
			   
			   $('.checkbox'+$(ui.draggable).val()+' input:checked').each(function() {
				   
				  if(daysArr.indexOf($(this).attr('value')) === -1){
				   daysArr.push($(this).attr('value'))
				   //  days+=$(this).attr('value')+' '; 
				   
				 }     
				 $('#'+ulSpot).addClass($(this).attr('value'));
			   });

			   $('#divseat'+ulSpot).find('.opendiv').removeClass('Mo Tu We Th Fr')
			   daysWeek.forEach((element) => {
				   if(daysArr.indexOf(element) === -1){
					   $('#divseat'+ulSpot).find('.opendiv').addClass(element)
				   }
			   });

			   $(".employeesInLayout tr").filter(function(event, row) {
				   if($(row).text().indexOf($(ui.draggable).val()) > -1){
					   $(row).closest("tr").remove();
				   }
				   
				 });


			   $('.employeesInLayout').append(`<tr>
			   <td>
				   <a href="#" OnClick="lookforSeatEmployee('${$(this).attr("id")}','${$(ui.draggable).val()}','${dayf}')">${seatShift[0]}</a>
			   </td>
			   <td>
				  <a href="#" OnClick="lookforSeatEmployee('${$(this).attr("id")}','${$(ui.draggable).val()}','${dayf}')">${seatShift[1]}</a>
			  </td>
			  <td>
				  <a href="#" OnClick="lookforSeatEmployee('${$(this).attr("id")}','${$(ui.draggable).val()}','${dayf}')">${$(ui.draggable).find('.picletters').text()}</a>
			  </td>
			  <td>
				  <a href="#" OnClick="lookforSeatEmployee('${$(this).attr("id")}','${$(ui.draggable).val()}','${dayf}')">${$(ui.draggable).val()}</a>
				  </td>
				 </tr> `);

				 callmeman(true);
				
				 $('#'+oldSeat).find("li.open").addClass('edited')
				 $('#'+oldSeat).addClass('Mo Tu We Th Fr')
				 $('#divseat'+oldSeat).find('.opendiv').removeClass('Mo Tu We Th Fr')

				}
		   }
	   });
		   
	   $(".employees" ).droppable({ 
		   activeClass: "hola",
				 hoverClass: "lol", 
		   over: function(event, ui) {
			   
		   
			   },	
				 drop: function( event, ui ) {
			   
				   $(ui.draggable).css("border", "initial"); 
				   ui.draggable.prependTo(this).fadeIn();	 
				   dropenables();
				   callmeman(false);
				   $(ui.draggable).find('.avatar').removeClass("picture"); 
				   $(ui.draggable).find('.picletters').show(); 
				   $(ui.draggable).find('.picletters').removeClass("Name"); 
				   $(ui.draggable).find('.information').hide(); 
				   $(ui.draggable).find('.information').hide(); 

				   oldSeat=$(ui.draggable).attr("data-seat")



				   $('#'+oldSeat).addClass('Mo Tu We Th Fr')
				   $('#divseat'+oldSeat).find('.opendiv').removeClass('Mo Tu We Th Fr')
					   
				   $('#'+oldSeat).find("li.open").addClass('edited')
				   $(this).prop('checked', false);
				   $(ui.draggable).attr("data-seat",$(this).attr("id"))
				   $(ui.draggable).removeClass("edited");
				   

				   $('.checkbox'+$(ui.draggable).attr('value')+' input:checked').each(function() {		
					   $(this).prop('checked', false);
					   $(this).prop('disabled', false);
				   }) 
   
				   $(".employeesInLayout tr").filter(function(event, row) {
					   if($(row).text().indexOf($(ui.draggable).val()) > -1){
						   $(row).closest("tr").remove();
					   }

					 });
				 }
	   });		

	   $(window).on('shown.bs.modal', function() { 
   
		   $( ".employees li, .employeesassigned li" ).draggable({ disabled: true })
	   });
	   
	   $(window).on('hidden.bs.modal', function() { 
		   $( ".employees li, .employeesassigned li" ).draggable( { disabled: false } )
		   daysArr=[];
		   $('.checkboxesDaysMultiple input:checked').each(function() {		   
			daysArr.push($(this).attr('id'))
			})
		   $('#'+$("input[name=weekdays]:checked").val()).click();
		   callmeman(false)
		   daysArr.forEach((element) => {
				$('#'+element).prop('checked',true)
			}); 
	   });
}


function dropenables(){
   $('ul.employeesassigned').droppable('enable');	     	
}

function callmeman(flag){	
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
		   $(obj).css("border", "3px dashed #3F59A7");			
		}	 
   });
   if(flag==false){
	   shiftAndDayValue()
   }
}	

function checkedboxes(obj,idemp){
   
   $('li.'+idemp).addClass("edited"); 
   spot=($('li.'+idemp)[0].parentElement.id); 
   var daysWeek=['Mo','Tu','We','Th','Fr']
   $('#'+spot).removeClass('Mo Tu We Th Fr');
   $('#divseat'+spot).find('.opendiv').removeClass('Mo Tu We Th Fr')
   
	   
		daysArr=[]
	   $('.checkbox'+idemp+' input:checked').each(function() {
		
		 if(daysArr.indexOf($(this).attr('value')) === -1){
		   daysArr.push($(this).attr('value'))
		   //  days+=$(this).attr('value')+' '; 
		   $('#'+spot).addClass($(this).attr('value'));
		 }      
	   });

	   
	   
	   daysWeek.forEach((element) => {
		   if(daysArr.indexOf(element) === -1){
			   $('#divseat'+spot).find('.opendiv').addClass(element)
		   }
	   }); 
  
	   
}

function switchBoxes(obj,seatId){
   var daysWeek=['Mo','Tu','We','Th','Fr']
   var day = $("input[name=weekdays]:checked").val()	
   var shift = $("input[name=shift]:checked").val()
   
   
   seatSplit=seatId.split('-'); 
   
   if(obj.checked==false){
		
		let cont=0;
	   
	   for(i=1;i<5;i++){
		
			if($("#"+seatSplit[0]+'-'+i).find('li.vat').val()!==undefined){
				cont++
				console.log("EMPLOYEE "+$("#"+seatSplit[0]+'-'+i).find('li.vat').val()+" IS ASSIGNED "+seatSplit[0]+'-'+i);
			}

	   }
	   if(cont>1){
		console.log("multiple EMPLOYEEs please unassign  and leave just one");
		$(".sharedSwitchInput"+seatId).prop('checked',true)
	   }else{
		$("#switchText"+seatId).text('Not Shared')
		for(i=1;i<5;i++){
		   $("#"+seatSplit[0]+'-'+i).removeClass(i+'shared')
		   $("#open"+seatSplit[0]+'-'+i).removeClass(i+'shared')

		   if($("#"+seatSplit[0]+'-'+i).find('li.vat').val()!==undefined){
			$("#"+seatSplit[0]+'-'+i).find('li.vat').appendTo("#"+seatSplit[0]+'-'+shift).fadeIn();
		}

		   
	   	}

	   
	   $("#"+seatId).addClass('admin')
	   $("#open"+seatId).addClass('admin')}
   }else{
	  
	   $("#switchText"+seatId).text('Shared')
	   for(i=1;i<5;i++){	
		   $("#switchText"+seatSplit[0]+'-'+i).text('Shared')
		   $(".sharedSwitchInput"+seatSplit[0]+'-'+i).prop('checked',true)
		   $("#"+seatSplit[0]+'-'+i).addClass(i+'shared')
		   $("#open"+seatSplit[0]+'-'+i).addClass(i+'shared')
		   if($("#"+seatSplit[0]+'-'+i).find('li.vat').val()!==undefined){
				$("#"+seatSplit[0]+'-'+i).find('li.vat').appendTo("#"+seatSplit[0]+'-'+shift);
				
			}
	   }
	   $("#"+seatId).removeClass('admin')	
	   $("#open"+seatId).removeClass('admin')
   }

   if($("#"+seatId).find('li.vat').val()!==undefined){
		$("#"+seatId).find('li.vat').addClass('edited')	
	}else{
		$("#"+seatId).find('li.open').addClass('edited')	
	}
   checkedboxes(obj,$("#"+seatId).find('li.vat').val())
   
   callmeman(true)
}

function saveLayout(){
   var data=[]
   var daysArr=[]
   $( "li.edited" ).each(function (i) {
	   days=""
	   empid=$(this).val()
	   spot=($(this)[0].parentElement.id).split('-'); 
	   if(empid>0){
		   daysArr=[]
		   $('.checkbox'+empid+' input:checked').each(function() {
			
			 if(daysArr.indexOf($(this).attr('value')) === -1){
			   daysArr.push($(this).attr('value'))
			   days+=$(this).attr('value')+','; 
			 }            
		   });
		   
	   }else{
		   days="Mo,Tu,We,Th,Fr,"
		//    shared=true
	   }

	   shared=$('.sharedSwitchInput'+$(this)[0].parentElement.id).prop('checked')

	   days = days.slice(0, -1)
	   data.push({
				   empid:empid,
				   spot:spot[0],
				   shift:spot[1],
				   days:days,
				   shared:shared
				 })
   });
  
   datos = {"_token" :$('#token').val(),"data":data};
   Swal.fire({
	title: 'Do you want to save the changes?',
	showDenyButton: true,
	confirmButtonText: 'Save',
	denyButtonText: `Don't save`,
  }).then((result) => {
	if (result.isConfirmed) {
		data=JSON.stringify(datos)
		console.log(data);
		$.ajax({
			url:'/api/layout/save', 
			type: 'post',
			dataType: 'json',
			async: false,
			contentType: "application/json; charset=utf-8",
			data:JSON.stringify(datos),
			success:function(resp){	
				console.log(resp)
				Swal.fire('Saved!', '', 'success')		
			}
		})
	 
	} else if (result.isDenied) {
	  Swal.fire('Changes are not saved', '', 'info')
	}
  })
  
}	

$('#filterEmp').keyup(function () {
   input = document.getElementById('filterEmp');
   upperText = input.value.toUpperCase();

   $(".employeesInLayout tr").filter(function() {
		 $(this).toggle($(this).text().toUpperCase().indexOf(upperText) > -1)
   });
});


function lookforSeatEmployee(seatId,empid,weekdays){

   let shift=seatId.split("-");
   let floor=seatId.split("");
   let day=weekdays.split(",");

   cleanlookforSeatEmployee()

   if(floor[0]=='1'){
	   floor='PH'
   }else if(floor[0]=='M'){
	   floor='MZ'
   }else{
	   floor=floor[0]
   }

   $('#'+day[0]).click();
   $('#'+floor).click();
   $('#'+shift[1]).click();
   $('#divseat'+seatId).find('.markerSeat').addClass('markerSeatAnimation').show();
   $('#divseat'+seatId).css('z-index', 1);

   setTimeout(function(){
	   $('#divseat'+seatId).find('.markerSeat').removeClass('markerSeatAnimation').fadeOut();
	   
	   if($('#seatModal'+seatId).is(':visible')==false){
		   $('#divseat'+seatId).css('z-index', 0);
	   }
   }, 10000)
}

function cleanlookforSeatEmployee(){
   $('.markerSeat').removeClass('markerSeatAnimation').hide();
   $('.divseat').css('z-index', 0);
}

function showModalOpen(){
	// $('#seatModalMZ154-1').modal('show');
	// $('#myModal').modal('hide');
	alert('There is an employee assigned to this seat if you want to change seat type first change day and shift where the employee is assigned ')
 }