<table class="table">
	<thead>
	  <tr>
	    <th scope="col">Seat</th>
	    <th scope="col">Shift</th>
	    <th scope="col">Employee</th>
		<th scope="col">EmpId</th>
	  </tr>
	</thead>
	<tbody class="employeesInLayout" >
@foreach ($ly_employee as $employee )
	@php
		$seatId=$employee->seatName.'-'.$employee->shift;
	@endphp
   <tr>
     	<td>
	 		<a href="#" OnClick="lookforSeatEmployee('{{$seatId}}','{{$employee->id_emp}}','{{$employee->weekdays}}')">{{$employee->seatName}}</a>
     	</td>
     	<td>
			<a href="#" OnClick="lookforSeatEmployee('{{$seatId}}','{{$employee->id_emp}}','{{$employee->weekdays}}')">{{$employee->shift}}</a>
		</td>
		<td>
			<a href="#" OnClick="lookforSeatEmployee('{{$seatId}}','{{$employee->id_emp}}','{{$employee->weekdays}}')">{{$employee->first_name." ".$employee->last_name}}</a>
		</td>
		<td>
			<a href="#" OnClick="lookforSeatEmployee('{{$seatId}}','{{$employee->id_emp}}','{{$employee->weekdays}}')">{{$employee->id_emp}}</a>
		</td>
   </tr>                          
@endforeach
	</tbody>
</table>