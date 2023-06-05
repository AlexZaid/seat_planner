<input id="changefilter" type="text" class="form-control">
                                       
<table class="table">
	<caption>List of users</caption>
	<thead>
	  <tr>
	    <th scope="col">oldSeat</th>
	    <th scope="col">oldShift</th>
	    <th scope="col">oldShared</th>
	    <th scope="col">newSeat</th>
	    <th scope="col">newShift</th>
	    <th scope="col">newShared</th>
	    <th scope="col">oldKeys</th>
	    <th scope="col">newKeys</th>
	    <th scope="col">newIdemp</th>
	    <th scope="col">newEmpName</th>
	  </tr>
	</thead>
	<tbody class="searchingchange">
@foreach ($changes as $change ) 
	@if(($change->newShared==false && $change->newShift==1)||(($change->newShared==true)) )
   <tr>
     <td>{{$change->oldSeat}}</td>
     <td>{{$change->oldShift}}</td>
	 @if($change->oldShared != Null)
     <td>{{$change->oldShared ? 'shared': 'not shared' }}</td>
	 @else
	 <td></td>
	 @endif
     <td>{{$change->newSeat}}</td>
     <td>{{$change->newShift}}</td>
     <td>{{$change->newShared ? 'shared': 'not shared' }}</td>
     <td>{{$change->newShared}}</td>
     <td>{{$change->newKeys}}</td>
     <td>{{$change->newIdemp}}</td>
     <td>{{$change->newEmpName}}</td>
   </tr> 
   @endif                         
@endforeach
	</tbody>
</table>
<script>
$(document).ready(function () {
    $('#changefilter').keyup(function () {
       	var value = $(this).val().toLowerCase();
    	$(".searchingchange tr").filter(function() {
      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   		});
	});
});
 
</script>
 
