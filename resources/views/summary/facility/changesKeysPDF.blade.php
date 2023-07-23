<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Layout</title>
    <link rel="shortcut icon" href="/img/here_white.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800">
  </head>
<body>
<table class="table table-bordered ">
	<thead style="background-color:#00afaa; color:white;">
	<tr>
    	<th colspan="2"  class="text-center" >Employee</th>
    	<th colspan="3"  class="text-center" >Seat</th>
    	<th colspan="2"  class="text-center" >Keys</th>
    	<th colspan="2"  class="text-center" ></th>
  	</tr>
	
	  <tr>
        <th scope="col">Emp ID</th>
	    <th scope="col">Name</th>
	    <th scope="col">New Seat</th>
	    <th scope="col">Shift</th>
	    <th scope="col">Shared</th>
	    <th scope="col">Current employee Keys</th>
	    <th scope="col">New Keys</th>
	    <th scope="col">Date</th>
	    <th scope="col">Signature</th>
	    <th scope="col">Observation</th>
	  </tr>
	</thead>
	<tbody class="searchingchange">
	@php $empid=-1 @endphp
	@php $people=array(); @endphp
@foreach ($changes as $change ) 
	@if(($change->newShared==false && $change->newShift==1)||(($change->newShared==true)) )
		@if(($change->id_emp!=$empid))
		        @php  
                   if (in_array($change->id_emp, $people)==false&&$change->id_emp>0 ):
		        @endphp
   		        	<tr>
   		        	  <td>{{$change->id_emp>0 ? $change->id_emp: '' }}</td>
   		        	  <td>{{$change->empName ? $change->empName: 'open seat'}}</td>
   		        	  <td>{{$change->newSeat}}</td>
   		        	  <td>{{$change->newShift}}</td>
   		        	  <td>{{$change->newShared ? 'shared': 'not shared' }}</td>
   		        	  <td>{{$change->oldKeys}}</td>
   		        	  <td>{{$change->id_emp>0 ? $change->newKeys: '' }}</td>
   		        	  <td></td>
   		        	  <td></td>
   		        	  <td></td>
   		        	</tr>
                @php  
		        	endif;
                    $people[] = $change->id_emp;
		        @endphp   	
		@endif  
   @endif                         
@endforeach
	</tbody>
</table>
</body>
</html>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

body {
  font-family: "Muli", sans-serif;
  font-weight: 400;
}
</style>
