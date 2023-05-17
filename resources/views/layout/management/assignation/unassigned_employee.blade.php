<ul id="unassigned" class="employees" style="display: flex; align-content: center; flex-direction: column; align-items: center;">  
@foreach ($ly_employee as $employee )      
				<li class="vat {{$employee->id_emp}}" style="margin-left: 2px; margin-top: 2px;" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" data-element="employee" value="{{$employee->id_emp}}"  data-seat="employees">
				    <a style="display:none;" href="#">{{$employee->first_name." ".$employee->last_name." ".$employee->id_emp}}</a>
					<div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
		    	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" data-bs-toggle="modal" data-bs-target="#employeeModal{{$employee->id_emp}}" class="editEmp buttoninfo{{$employee->id_emp}}" >Edit</button>
		    	    </div> 
				    <div class="avatar picture" id="{{$employee->id_emp}}k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$employee->id_emp}}.jpg')">
				    </div>
				    <div class="picletters Name" >{{$employee->first_name." ".$employee->last_name}}
				    </div>
					<div class="modal fade" id="employeeModal{{$employee->id_emp}}" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h1 class="modal-title fs-5" id="employeeModalLabel">Modal title</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <b>Weekdays:</b><br/>
								<div onclick="checkedboxes(this,'{{$employee->id_emp}}')" class="checkbox{{$employee->id_emp}} checkboxesDays">
									<input type="checkbox" class="MoCheck" id="checkbox{{$employee->id_emp}}Mo" value="Mo" {{ false !== strpos($employee->weekdays, 'Mo') ? 'checked': '' }}> <label for="cbox2">Monday</label><br/>
									<input type="checkbox" class="TuCheck" id="checkbox{{$employee->id_emp}}Tu" value="Tu" {{ false !== strpos($employee->weekdays, 'Tu') ? 'checked': '' }}> <label for="cbox2">Tuesday</label><br/>
									<input type="checkbox" class="WeCheck" id="checkbox{{$employee->id_emp}}We" value="We" {{ false !== strpos($employee->weekdays, 'We') ? 'checked': '' }}> <label for="cbox2">Wednesday</label><br/>
									<input type="checkbox" class="ThCheck" id="checkbox{{$employee->id_emp}}Th" value="Th" {{ false !== strpos($employee->weekdays, 'Th') ? 'checked': '' }}> <label for="cbox2">Thursday</label><br/>
									<input type="checkbox" class="FrCheck" id="checkbox{{$employee->id_emp}}Fr" value="Fr" {{ false !== strpos($employee->weekdays, 'Fr') ? 'checked': '' }}> <label for="cbox2">Friday</label>
								</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				</li>	
@endforeach
</ul>