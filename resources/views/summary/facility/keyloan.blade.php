<br/>
<label>Search</label>
<br/>
<input id="keyloanfilter" type="text" class="form-control">
<br/> 
                                                            
<table class="table">
	<caption>List of users</caption>
	<thead>
	  <tr>
	    <th scope="col" colspan="3" class="text-center">Employee</th>
	    <th scope="col" colspan="2" class="text-center" >Old Seat/Shift</th>
	    <th scope="col" class="text-center">Old Keys</th>   
	    <th scope="col" class="text-center"></th>
	    <th scope="col" colspan="2" class="text-center" >New Seat/Shift</th>
	    <th scope="col" class="text-center">New Keys</th>
	  </tr>
	</thead>
	<tbody class="searchingkeyloan">
@foreach ($keyloans as $keyloan )      
   <tr>
     <td><div 
            class="avatartables picture" 
            style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$keyloan->id_emp}}.jpg')">
        </div>
    </td>
     <td  class="text-center" >{{$keyloan->id_emp}}</td>
     <td  class="text-center" >{{$keyloan->empName}}</td>
     <td  class="text-center" >{{$keyloan->seatName}}</td>
     <td  class="text-center" >{{$keyloan->shift}}</td>
     <td  class="text-center" >{{$keyloan->seatKeys}}</td>
     <td  class="text-center" >
                            <i class="bi bi-lock-fill fa-2x" id="lock{{$keyloan->id_emp}}" style="color:#e22525;"></i>   
							<label onclick="" class="switch switchkeyloanLabel{{$keyloan->id_emp}}">
		  						<input onchange="switchkeyloan(this,'{{$keyloan->id_emp}}')"  data-info="{{$keyloan->id_emp}},{{$keyloan->seatName}},{{$keyloan->shift}}" type="checkbox" class="switchkeyloan switchkeyloanInput{{$keyloan->id_emp}}" {{ $keyloan->keyReturned ? 'checked': '' }}>
		  						<span class="slider sliderkeyloans round"></span>
							</label></td>
     <td  class="text-center" >{{$keyloan->newSeatName}}</td>
     <td  class="text-center" >{{$keyloan->newShift}}</td>
     <td  class="text-center" >{{$keyloan->newSeatKeys}}</td>
    
   </tr>                          
@endforeach
	</tbody>
</table>

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<script>
$(document).ready(function () {
    $('#keyloanfilter').keyup(function () {
       	var value = $(this).val().toLowerCase();
    	$(".searchingkeyloan tr").filter(function() {
      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   		});
	});
});

function switchkeyloan(obj,idEmp){
    console.log(obj);
    if(obj.checked!==false){
        $('#lock'+idEmp).removeClass('bi-lock-fill').addClass('bi-unlock-fill');
        $('#lock'+idEmp).css("color","#00afaa");
    }else{
        $('#lock'+idEmp).removeClass('bi-unlock-fill').addClass('bi-lock-fill');
        $('#lock'+idEmp).css("color","#e22525");
    }

}

function savekeyLoans(){
    var data=[]
    
    $( '.switchkeyloan:checked' ).each(function (i) {
	    let information=$(this).attr('data-info');
        let info=information.split(',');
        data.push({
				   empid:info[0],
				   spot:info[1],
				   shift:info[2],
				   unlocked:true
			    })
   });
   datos = {"_token" :$('#token').val(),"data":data};
   console.log(datos);
   
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
			url:'/api/keyLoan/save', 
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


</script>
 
