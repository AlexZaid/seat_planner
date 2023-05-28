<br/>
<label>Search</label>
<br/>
<input id="summaryfilter" type="text" class="form-control">
<br/>    
<table class="table">
	<caption>List of users</caption>
	<thead>
	  <tr>
	    <th scope="col" class="text-center">seat</th>
	    <th scope="col" class="text-center">shift</th>
	    <th scope="col" colspan="3" class="text-center">Employee</th>
	    <th scope="col" class="text-center">keys</th>
	  </tr>
	</thead>
	<tbody class="searchingcontent">
@foreach ($summaries as $summary )      
   <tr>
     <td class="text-center">{{$summary->seatName}}</td>
     <td class="text-center">{{$summary->shift}}</td>
	 <td class="text-center"><div 
            class="avatartables picture" 
            style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$summary->id_emp}}.jpg')">
        </div>
    </td>
     <td class="text-center">{{$summary->id_emp}}</td>
     <td class="text-center">{{$summary->emp_name}}</td>
     <td class="text-center">{{$summary->seatKeys}}</td>
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
 
 