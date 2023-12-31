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
	    <th scope="col" colspan="1" class="text-center" >Old Seat-Shift</th>
	    <th scope="col" class="text-center">Currently employee Keys</th>   
	    <th scope="col" class="text-center"></th>
	    <th scope="col" colspan="1" class="text-center" >New Seat-Shift</th>
	    <th scope="col" class="text-center">New Keys</th>
		<th scope="col" class="text-center"></th>
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
     <td  class="text-center" >{{$keyloan->oldSeat.'-'.$keyloan->oldShift}}</td>
     <td  class="text-center" >{{$keyloan->oldKeys}}</td>
     <td  class="text-center" >
                            <i class="bi bi-lock-fill fa-2x" id="lock{{$keyloan->id_emp}}" style="color:#e22525;"></i>   
							<label onclick="" class="switch switchkeyloanLabel{{$keyloan->id_emp}}">
		  						<input onchange="switchkeyloan(this,'{{$keyloan->id_emp}}')"  data-info="{{$keyloan->id_emp}},{{$keyloan->newSeatKey}},{{$keyloan->newSeat}},{{$keyloan->newShift}}" type="checkbox" class="switchkeyloan switchkeyloanInput{{$keyloan->id_emp}}" {{ $keyloan->keyReturned ? 'checked': '' }}>
		  						<span class="slider sliderkeyloans round"></span>
							</label>
	 </td> 
     <td  class="text-center" >{{$keyloan->newSeat.'-'.$keyloan->newShift}}</td>
     <td  class="text-center" >{{$keyloan->newKeys}}</td>
	 <td  class="text-center" >
    	<input type="checkbox" id="newKeyCheckEmp{{$keyloan->id_emp}}" value="second_checkbox">
	 </td>
    
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
		let newKeyCheckEmp=$('#newKeyCheckEmp'+info[0]).prop('checked')
		console.log(newKeyCheckEmp);
        data.push({
				   empid:info[0],
				   newKey:info[1],
				   spot:info[2],
				   shift:info[3],
				   unlocked:true,
				   newKeyCheck:newKeyCheckEmp
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
			beforeSend:function(){
				$('.filterKeyLoans').empty();	
			},
			success:function(){	
				
				Swal.fire('Saved!', '', 'success')	
				loadKeyLoans()
				loadSummary()	
			}
		})
	 
	} else if (result.isDenied) {
	  Swal.fire('Changes are not saved', '', 'info')
	}
  })

}


</script>
 
