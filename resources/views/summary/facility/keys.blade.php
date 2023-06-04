<label>Search:</label>
                <input id="searchKeySP" type="text" class="form-control">
            </div>
			 <div class="col-sm-4" style="padding:20px;">
			 <label><button class="btn btn-success btn-md" onclick="SaveInput()" type="submit">Save</button>  </label>
			<br><br>
			</div>
<table class="table">
	<caption>List of users</caption>
	<thead>
	  <tr>
	    <th scope="col">Seat</th>
	    <th scope="col">Shift</th>
	    <th scope="col">Key</th>
	    <th scope="col">Update</th>
	  </tr>
	</thead>
	<tbody class="searchinKeySP" >
@foreach ($keys as $key )      
   <tr>
     <th scope="row">{{$key->seatName}}</th>
     <th scope="row">{{$key->shift}}</th>
     <td><input class="form-control" 
	 			name="{{$key->shift}}" 
				id="inptxt{{$key->seatName}}" 
				type="text"  
				value="{{$key->seatKeys}}" 
				disabled="disabled"
				data-infokey="{{$key->seatName}},{{$key->shift}}"
				>
     	</td>
     	<td>
	 		<center>
				<button id="btnEdit{{$key->seatName}}" 
						class="btn btn-primary btn-xs" 
						onclick="enableInput('{{$key->seatName}}')" 
						type="submit">Edit
				</button>
				<button style="display: none;" 
						id="btnCancl{{$key->seatName}}" 
						class="btn btn-danger btn-xs" 
						onclick="cancelInput('{{$key->seatName}}')" 
						type="submit">Cancel
				</button>
			</center>
		</td>
   </tr>                          
@endforeach
	</tbody>
</table>

<script>
$(document).ready(function () {
    $('#searchKeySP').keyup(function () {
       	var value = $(this).val().toLowerCase();
    	$(".searchinKeySP tr").filter(function() {
      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   		});
	});
});
 

function enableInput(idseat){
$("#inptxt"+idseat).prop('disabled', false);
 $("#inptxt"+idseat).addClass('edited');
$("#btnEdit"+idseat).hide();
$("#btnCancl"+idseat).show();
$("#inptxt"+idseat).focus();
$("#inptxt"+idseat).select();
}

function cancelInput(idseat){
	$("#inptxt"+idseat).removeClass('edited');
$("#btnEdit"+idseat).show();
$("#btnCancl"+idseat).hide();
$("#inptxt"+idseat).prop('disabled', true);
	datas = [{name:"idseat",value:idseat},{name:"accion",value:1}];
	 $.ajax({
        data: datas,
        url: '../pages/_layoutsystem/saveUpdateKeys.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
           console.log(response);
		   document.getElementById('inptxt'+idseat).value = response;
		   
        }
    }); 

}

function SaveInput(){

	var data=[]
    
    $( '.edited' ).each(function (i) {
	    let information=$(this).attr('data-infokey');
        let info=information.split(',');
        data.push({
				   spot:info[0],
				   shift:info[1],
				   seatKey:$(this).val()
			    })
   });
   datos = {"_token" :$('#token').val(),"data":data};
   console.log(datos);
  	$.ajax({
        data: datos,
        url: '/api/key/save',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
          
			Swal.fire('Saved!', '', 'success')	
        }
        
    });

}
</script>