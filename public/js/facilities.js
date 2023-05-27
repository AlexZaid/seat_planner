$( document ).ready(function() {
	loadSummary()
	loadChanges()
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
	$.ajax({
		url:'/summary/facilities/changes',
		success:function(data){	
			$('.filterchanges').append(data);						
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