<table class="table">
	<caption>List of keys</caption>
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
     <th scope="row">{{ 1==$key->shift ? 'A': 'B' }}</th>
     <td><input class="inptxt form-control" 
	 			name="{{$key->shift}}" 
				id="inptxt{{$key->seatName.$key->shift}}" 
				type="text"  
				value="{{$key->seatKeys}}" 
				disabled="disabled"
				data-infokey="{{$key->seatName}},{{$key->shift}}"
				>
     	</td>
     	<td>
	 		<center>
				<button id="btnEdit{{$key->seatName.$key->shift}}" 
						class="btn btnEdit btn-primary btn-xs" 
						onclick="enableInput('{{$key->seatName.$key->shift}}')" 
						type="submit">Edit
				</button>
				<button style="display: none;" 
						id="btnCancl{{$key->seatName.$key->shift}}" 
						class="btn btnCancl btn-danger btn-xs" 
						onclick="cancelInput('{{$key->seatName.$key->shift}}')" 
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

function infoSaved(){
$(".inptxt").removeClass('edited');
$(".btnEdit").show();
$(".btnCancl").hide();
$(".inptxt").prop('disabled', true);

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
			infoSaved()
        }
        
    });

}
</script>