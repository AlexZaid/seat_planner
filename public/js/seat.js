$( document ).ready(function() {
	loadFloors()
});

function loadFloors(){
const floors = ["MZ","7","8","9","10"];
	let promises = [];
	floors.map(function(floor) {
		let request=$.ajax({
			url:'/layout/management/editSeats/seat/'+floor,
			async : true,
			success:function(data){	
				$('#floor'+floor).html(data);						
			}
		})
		promises.push(request)
	});

$.when.apply(null, promises).then( function(){
	$('#floors').fadeIn('slow');	
	DragDropHandler()
	$('#MZ').click();
});
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
    $( ".seat" ).draggable({
			
			start: function(event, ui) {				 
				// ui.position.left = 0;
				// ui.position.top = 0;
			},
			drag: function(event, ui) 
			{
				$(this).css({
					"position": "relative"})
      
				div=$("#floors").css('transform')
				var values = div.split('(')[1];
				values = values.split(')')[0];
				values = values.split(',');
				zoomScale=values[0];
				console.log(values[0]);
				var changeLeft = ui.position.left - ui.originalPosition.left; // find change in left
        		var newLeft = ui.originalPosition.left + changeLeft / (( zoomScale)); // adjust new left by our zoomScale

        		var changeTop = ui.position.top - ui.originalPosition.top; // find change in top
        		var newTop = ui.originalPosition.top + changeTop / (( zoomScale)); // adjust new top by our zoomScale
				console.log(changeTop);
				console.log(newTop);
        		ui.position.left = newLeft;
        		ui.position.top = newTop; 
			},
			stop: function(event, ui) {
				$(this).css({
					"position": "absolute"})
				$(this).css("opacity", "1"); 
				$(this).find('.avatar').css("width", "20px");
		 		$(this).find('.avatar').css("height", "20px");  
		 		$(this).fadeIn(); 
				var l = ( (100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width"))).toFixed(2) );
           		var t = ( (100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height"))).toFixed(2) );
            	$(this).css("left" , l+"%" );
            	$(this).css("top" , t+"%" );
			
				let floor=$(this).find('ul').attr("data-floor");

				$(".seatsPositions"+floor+" tr").filter(function(event, row) {
					
					if($(row).text().indexOf($(ui.helper).find('ul').attr('id')) > -1){
						$(row).closest("tr").remove();
					}
					
				  });
 
 
				$('.seatsPositions'+floor).append(`<tr>
				<td class='seatNametd' >
					${$(this).find('ul').attr('id')}
				</td>
				<td class='posToptd'>
				   ${t}
			   </td>
			   <td class='posLefttd'>
				  ${l}
			   </td>
			  
				</tr> `);
				
	 		}
		}).on('mousedown', function(e) {
			$(this).css({
				"position": "relative"})
		}).mouseleave(function (e) {
			$(this).css({
				"position": "absolute"})
		 });
}

let elem = document.getElementById('floors')
let zoomInButton = document.getElementById('zoomInButton')
let zoomOutButton = document.getElementById('zoomOutButton')
 let resetButton = document.getElementById('resetButton')
let rangeInput = document.getElementById('rangeInput')

let panzoom = Panzoom(elem,{ contain: null,animate: true })
zoomInButton.addEventListener('click', panzoom.zoomIn)
zoomOutButton.addEventListener('click', panzoom.zoomOut)
resetButton.addEventListener('click', panzoom.reset)
rangeInput.addEventListener('input', (event) => {
  panzoom.zoom(event.target.valueAsNumber)
})
elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel) 

function saveSeats(){

	var data=[]
	$(".seatsPositions tr").each(function(event, row) {
		data.push({
			seatName:$(this).find('.seatNametd').text(),
			posTop:$(this).find('.posToptd').text(),
			posLeft:$(this).find('.posLefttd').text()
		}) 
		
	});

	datos = {"_token" :$('#token').val(),"data":data};
	
	data=JSON.stringify(datos)
	console.log(data);
	Swal.fire({
		title: 'Do you want to save the changes?',
		showDenyButton: true,
		confirmButtonText: 'Save',
		denyButtonText: `Don't save`,
	  }).then((result) => {

		if (result.isConfirmed) {
			$.ajax({
				url:'/api/seat/save', 
				type: 'post',
				dataType: 'json',
				async: false,
				contentType: "application/json; charset=utf-8",
				data:JSON.stringify(datos),
				success:function(resp){	
			
					Swal.fire('Saved!', '', 'success')
				}
			})  
		  
		} 
		
		else if (result.isDenied) {
		  Swal.fire('Changes are not saved', '', 'info')
		}
	  })
	
}