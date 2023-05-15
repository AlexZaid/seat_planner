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
	    <th scope="col">Key</th>
	    <th scope="col">Update</th>
	  </tr>
	</thead>
	<tbody class="searchinKeySP" >
@foreach ($keys as $key )      
   <tr>
     <th scope="row">{{$key->seatName}}</th>
     <td><input class="form-control" 
	 			name="{{$key->shift}}" 
				id="inptxt{{$key->seatName}}" 
				type="text"  
				value="{{$key->seatKeys}}" 
				disabled="disabled">
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
     	var keysEdited ="";
       	$( ".edited" ).each(function (i) {
       	keysEdited += $(this).val()+",";					
      	});
				
		var seatsEdt ="";
       	$( ".edited" ).each(function (i) {
			seatid=$(this).attr('id').slice(6);
			seatid = seatid.substring(0, seatid.length - 1);
       	seatsEdt += seatid+",";					
      	});
		
		var shiftEdited ="";
       	$( ".edited" ).each(function (i) {
			shiftEdited += $(this).attr('name')+",";					
      	});
	
	datas = [{name:"shiftEdited",value:shiftEdited},{name:"keysEdited",value:keysEdited},{name:"accion",value:2},{name:"seatsEdt",value:seatsEdt}];
	 $.ajax({
        data: datas,
        url: '../pages/_layoutsystem/saveUpdateKeys.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
           $("#keysupdtable").empty();
            $("#keysupdtable").removeData();
            $("#keysupdtable").html('');
            $("#keysupdtable").html(response);
			alertify.success("Keys updated");
        }
        
    }); 

}
</script>