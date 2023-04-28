@foreach ($ly_employee as $employee )
	<tr>
        <td class="table-primary">
			<ul id="" class="employees" style="">             
				<li class="vat {{$employee->id_emp}}" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" value="{{$employee->id_emp}}"  style="margin-left: 1px;">
				    <div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
				        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" onclick="buttoninfo('{{$employee->id_emp}}')" class="editEmp buttoninfo{{$employee->id_emp}}" >Edit</button>
				    </div> 
				    <div class="container info{{$employee->id_emp}} information" style="display:none;width: 150px;background-color: #f4f4fd;left: -4px;top: 52px;position: absolute;z-index: 100;">
					<button type="button" class="close" aria-label="Close" onclick="closeWeekdayTip('info{{$employee->id_emp}}')" ><span style="color:red;" aria-hidden="true">&times;</span></button>
						<br/>
						<b>Weekdays:</b><br/>
						<div onclick="checkedboxes(this,'{{$employee->id_emp}}')" class="checkbox{{$employee->id_emp}} checkboxesDays">
							<input type="checkbox" class="MoCheck" id="checkbox{{$employee->id_emp}}Mo" value="Mo" > <label for="cbox2">Monday</label><br/>
							<input type="checkbox" class="TuCheck" id="checkbox{{$employee->id_emp}}Tu" value="Tu" > <label for="cbox2">Tuesday</label><br/>
							<input type="checkbox" class="WeCheck" id="checkbox{{$employee->id_emp}}We" value="We" > <label for="cbox2">Wednesday</label><br/>
							<input type="checkbox" class="ThCheck" id="checkbox{{$employee->id_emp}}Th" value="Th" > <label for="cbox2">Thursday</label><br/>
							<input type="checkbox" class="FrCheck" id="checkbox{{$employee->id_emp}}Fr" value="Fr" > <label for="cbox2">Friday</label>
						</div>	
						<br/>
						<b>Shared:</b><br/>
						<label onclick="" class="switch switchLabel{{$employee->id_emp}}">
							<input onchange="switchBoxes(this,'{{$employee->id_emp}}')" type="checkbox" class="sharedSwitchInput{{$employee->id_emp}}">
							<span class="slider round"></span>
						</label>
					</div>
				    <div class="avatar picture" id="{{$employee->id_emp}}k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$employee->id_emp}}.jpg')">
				    </div>
				    <div class="picletters Name" >{{$employee->first_name}}
				    </div>
				</li>
			</ul>
		</td>
	</tr>
@endforeach

