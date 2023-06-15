<ul id="unassigned" class="employees" style="display: flex; height:25000px; align-content: center; flex-direction: column; align-items: center;">  
@foreach ($ly_employee as $employee )   
	@php
		$stylePic="";
		$stylePicli="";
		if($employee->hasPic) {
			$profilePic="https://ourpeople.in.here.com/HRPhotos/".$employee->id_emp.".jpg";
		}else{
			$profilePic="/img/employeesPic/".$employee->id_emp.".jpg";
			$stylePic="	background-position-x: -11px;
    					background-position-y: -16px;
    					background-size: 151%;";

			$stylePicli="background-position-x: 3px;
    				   background-position-y: 3px;";
		}	
	@endphp
				<li class="vat {{$employee->id_emp}}" style="margin-left: 2px; margin-top: 2px;" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" data-element="employee" value="{{$employee->id_emp}}"  data-seat="employees">
				    <a style="display:none;" href="#">{{$employee->first_name." ".$employee->last_name." ".$employee->id_emp}}</a>
					<div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
		    	        <button type="button" style="display:none;" data-bs-toggle="modal" data-bs-target="#employeeModal{{$employee->id_emp}}" class="editEmp buttoninfo{{$employee->id_emp}}" ><i class="bi bi-person-vcard"></i></button>
		    	    </div> 
				    <div class="avatar picture" id="{{$employee->id_emp}}k" style="background-image:url('{{$profilePic}}'); {{$stylePicli}}">
				    </div>
				    <div class="picletters Name" >{{$employee->first_name." ".$employee->last_name}}
				    </div>
					<div class="modal fade" id="employeeModal{{$employee->id_emp}}" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h1 class="modal-title fs-5" id="employeeModalLabel">Employee Information</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
							<div class="d-flex justify-content-center">
								<div class="avatarModal picture" id="{{$employee->id_emp}}k" style="background-image:url('{{$profilePic}}'); {{$stylePic}}">
		    	    			</div>
							</div>
					        <div class="d-flex justify-content-center">
								 <b>{{$employee->first_name." ".$employee->last_name}}</b>
							</div>
							<div class="d-flex justify-content-center">
								{{$employee->user_lvl}}
							</div>
							<div class="d-flex justify-content-center">
								<b>Email:</b>&nbsp; {{$employee->email}}
							</div>
							<div class="d-flex justify-content-center">
								@if($employee->managerName)
									<b>Manager:</b>&nbsp; {{$employee->managerName}}
								@endif
							</div>
							<div class="d-flex justify-content-center">
								<a href="https://ourpeople.in.here.com/OurPeople/OurPeople.php?u={{$employee->id_emp}}" class="button" target="_blank">View complete profile</a>
							</div>
							<br/>
							<div class="d-flex justify-content-center">
								<b>Days in the office:</b>
							</div>
							<div class="d-flex justify-content-center">
								<div onclick="checkedboxes(this,'{{$employee->id_emp}}')" class="checkbox{{$employee->id_emp}} checkboxesDays">
									<input type="checkbox" class="MoCheck" id="checkbox{{$employee->id_emp}}Mo" value="Mo" {{ false !== strpos($employee->weekdays, 'Mo') ? 'checked': '' }} {{ Auth::check() ? '': 'disabled' }}> <label for="cbox2">Monday</label><br/>
									<input type="checkbox" class="TuCheck" id="checkbox{{$employee->id_emp}}Tu" value="Tu" {{ false !== strpos($employee->weekdays, 'Tu') ? 'checked': '' }} {{ Auth::check() ? '': 'disabled' }}> <label for="cbox2">Tuesday</label><br/>
									<input type="checkbox" class="WeCheck" id="checkbox{{$employee->id_emp}}We" value="We" {{ false !== strpos($employee->weekdays, 'We') ? 'checked': '' }} {{ Auth::check() ? '': 'disabled' }}> <label for="cbox2">Wednesday</label><br/>
									<input type="checkbox" class="ThCheck" id="checkbox{{$employee->id_emp}}Th" value="Th" {{ false !== strpos($employee->weekdays, 'Th') ? 'checked': '' }} {{ Auth::check() ? '': 'disabled' }}> <label for="cbox2">Thursday</label><br/>
									<input type="checkbox" class="FrCheck" id="checkbox{{$employee->id_emp}}Fr" value="Fr" {{ false !== strpos($employee->weekdays, 'Fr') ? 'checked': '' }} {{ Auth::check() ? '': 'disabled' }}> <label for="cbox2">Friday</label>
								</div>
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