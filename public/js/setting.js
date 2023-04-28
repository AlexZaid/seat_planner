$( document ).ready(function() {
	DragDropHandler()
	 });


function DragDropHandler(){
    $( ".seat" ).draggable({
			start: function(event, ui) {				 
				// ui.position.left = 0;
				// ui.position.top = 0;
			},
			drag: function(event, ui) 
			{

				div=$("#floors").css('transform')
				var values = div.split('(')[1];
				values = values.split(')')[0];
				values = values.split(',');
				zoomScale=values[0];
				console.log(values[0]);
				var changeLeft = ui.position.left - ui.originalPosition.left; // find change in left
        		var newLeft = ui.originalPosition.left + changeLeft / (( zoomScale)); // adjust new left by our zoomScale

        		var changeTop = ui.position.top - ui.originalPosition.top; // find change in top
        		var newTop = ui.originalPosition.top + changeTop / zoomScale; // adjust new top by our zoomScale

        		ui.position.left = newLeft;
        		ui.position.top = newTop;
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
				console.log(t);
				console.log(l);
				
	 		}
		});
}

let elem = document.getElementById('floors')
let panzoom = Panzoom(elem,{ animate: true })
elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)

function saveSeat(){
	var data = {
        "_token": $('#token').val(),
		"seatName": "sas",
		"floor": "9",
		"description": "sas",
		"posLeft": "sas",
		"posTop": "sas"
    };

	$.ajax({
		url:'/api/seat/save', 
		type: 'post',
		dataType: 'json',
		async: false,
		contentType: "application/json; charset=utf-8",
		data:JSON.stringify(data),
		success:function(resp){	
			console.log(resp)		
		}
	})
}