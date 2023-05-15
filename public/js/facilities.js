$( document ).ready(function() {
	loadSummary()
	// loadChanges()
	loadKeys()
});

function loadSummary(){
	$.ajax({
		url:'/summary/facilities/summary',
		success:function(data){	
			$('.filtersummary').append(data);						
		}
	})
}

function loadChanges(){
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

function loadKeys(){
	$.ajax({
		url:'/summary/facilities/keys',
		success:function(data){	
			$('.filterkeys').append(data);						
		}
	})
}