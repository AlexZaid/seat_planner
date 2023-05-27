<input id="summaryfilter" type="text" class="form-control">

<table class="table">
	<caption>List of users</caption>
	<thead>
	  <tr>
	    <th scope="col">seat</th>
	    <th scope="col">shift</th>
	    <th scope="col">employee id</th>
	    <th scope="col">employee name</th>
	    <th scope="col">keys</th>
	  </tr>
	</thead>
	<tbody class="searchingcontent">
@foreach ($summaries as $summary )      
   <tr>
     <td >{{$summary->seatName}}</td>
     <td>{{$summary->shift}}</td>
     <td>{{$summary->id_emp}}</td>
     <td>{{$summary->emp_name}}</td>
     <td>{{$summary->seatKeys}}</td>
   </tr>                          
@endforeach
	</tbody>
</table>
<script>
$(document).ready(function () {
    $('#summaryfilter').keyup(function () {
       	var value = $(this).val().toLowerCase();
    	$(".searchingcontent tr").filter(function() {
      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   		});
	});
});
 
</script>
 
 