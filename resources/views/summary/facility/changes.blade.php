<a href="/summary/facilities/keysPDF" target="_blank">Print keys to employees pdf</a>
<br/>
<br/>
<table class="table table-bordered ">
	<caption>List of changes</caption>
	<thead>
	<tr>
    	<th colspan="3"  class="text-center" >From</th>
    	<th colspan="3"  class="text-center" >To</th>
    	<th colspan="2"  class="text-center" >Keys</th>
    	<th colspan="2"  class="text-center" >Employee</th>
  	</tr>
	
	  <tr>
	    <th scope="col">Old Seat</th>
	    <th scope="col">Shift</th>
	    <th scope="col">Shared</th>
	    <th scope="col">New Seat</th>
	    <th scope="col">Shift</th>
	    <th scope="col">Shared</th>
	    <th scope="col">Current employee Keys</th>
	    <th scope="col">New Keys</th>
	    <th scope="col">Number ID</th>
	    <th scope="col">Name</th>
	  </tr>
	</thead>
	<tbody class="searchingchange">
	@php $empid=-1 @endphp
@foreach ($changes as $change ) 
	@if(($change->newShared==false && $change->newShift==1)||(($change->newShared==true)) )
		@if(($change->id_emp!=$empid))
		@php  
			if($change->id_emp!=0){
				$empid=$change->id_emp;
			}
		@endphp
   			<tr>
   			  <td>{{$change->oldSeat}}</td>
   			  <td>{{$change->oldShift}}</td>
				 @if($change->oldShared !== Null)
   			  <td>{{$change->oldShared ? 'shared': 'not shared' }}</td>
				 @else
				 <td></td>
				 @endif
   			  <td>{{$change->newSeat}}</td>
   			  <td>{{$change->newShift}}</td>
   			  <td>{{$change->newShared ? 'shared': 'not shared' }}</td>
   			  <td>{{$change->oldKeys}}</td>
   			  <td>{{$change->id_emp>0 ? $change->newKeys: '' }}</td>
   			  <td>{{$change->id_emp>0 ? $change->id_emp: '' }}</td>
   			  <td>{{$change->empName ? $change->empName: 'open seat'}}</td>
   			</tr>
		@endif  
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
 
