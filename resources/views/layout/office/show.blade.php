@foreach ($seats as $seat )
	@php
		$days = str_replace(',', ' ', $seat->weekdays);
		$classShared = $seat->shift. "shared ";
		$seatId=$seat->seatName.'-'.$seat->shift;
	@endphp
	<div class=" " id="divseat{{$seat->seatName}}" style="position: absolute; top: {{$seat->posTop}}px;  left:  {{$seat->posLeft}}px;">
		<ul id="{{$seatId}}" class="seat{{$seat->seatName}} seatdiv employeesassigned {{$classShared.' '.$days}} " style="padding: 0px;">
		   <div class="seatName"><p style="margin-top: 1px;">{{$seat->seatName}}</p></div>
		    @if ($seat->id_emp!=0)
				<li class="vat {{$seat->id_emp}}" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" value="{{$seat->id_emp}}" data-seat="{{$seatId}}" style="margin-left: 1px;">
		    	    <div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
		    	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" onclick="buttoninfo('{{$seat->id_emp}}')" class="editEmp buttoninfo{{$seat->id_emp}}" >Edit</button>
		    	    </div> 
		    	    <div class="container info{{$seat->id_emp}} information" style="display:none;width: 150px;background-color: #f4f4fd;left: -4px;top: 52px;position: absolute;z-index: 100;">
					<button type="button" class="close" aria-label="Close" onclick="closeWeekdayTip('info{{$seat->id_emp}}')" ><span style="color:red;" aria-hidden="true">&times;</span></button>
						<br/>
						<b>Weekdays:</b><br/>
						<div onclick="checkedboxes(this,'{{$seat->id_emp}}')" class="checkbox{{$seat->id_emp}} checkboxesDays">
							<input type="checkbox" class="MoCheck" id="checkbox{{$seat->id_emp}}Mo" value="Mo" {{ false !== strpos($seat->weekdays, 'Mo') ? 'checked': '' }}> <label for="cbox2">Monday</label><br/>
							<input type="checkbox" class="TuCheck" id="checkbox{{$seat->id_emp}}Tu" value="Tu" {{ false !== strpos($seat->weekdays, 'Tu') ? 'checked': '' }}> <label for="cbox2">Tuesday</label><br/>
							<input type="checkbox" class="WeCheck" id="checkbox{{$seat->id_emp}}We" value="We" {{ false !== strpos($seat->weekdays, 'We') ? 'checked': '' }}> <label for="cbox2">Wednesday</label><br/>
							<input type="checkbox" class="ThCheck" id="checkbox{{$seat->id_emp}}Th" value="Th" {{ false !== strpos($seat->weekdays, 'Th') ? 'checked': '' }}> <label for="cbox2">Thursday</label><br/>
							<input type="checkbox" class="FrCheck" id="checkbox{{$seat->id_emp}}Fr" value="Fr" {{ false !== strpos($seat->weekdays, 'Fr') ? 'checked': '' }}> <label for="cbox2">Friday</label>
						</div>	
						<br/>
						<b>Admin:</b><br/>
						<label onclick="" class="switch switchLabel{{$seat->id_emp}}">
		  					<input onchange="switchBoxes(this,'{{$seat->id_emp}}')" type="checkbox" class="sharedSwitchInput{{$seat->id_emp}}">
		  					<span class="slider round"></span>
						</label>
					</div>
		    	    <div class="avatar picture" id="{{$seat->id_emp}}k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$seat->id_emp}}.jpg')">
		    	    </div>
		    	    <div class="picletters Name" >{{$seat->id_emp}}
		    	    </div>
		    	</li>
			@endif      
		</ul>
		<div  class="opendiv  {{$classShared }} open{{$seat->seatName}} {{ false === strpos($seat->weekdays,'Mo') ? 'Mo': '' }}
											{{ false === strpos($seat->weekdays,'Tu') ? 'Tu': '' }}
											{{ false === strpos($seat->weekdays,'We') ? 'We': '' }}
											{{ false === strpos($seat->weekdays,'Th') ? 'Th': '' }}
											{{ false === strpos($seat->weekdays,'Fr') ? 'Fr': '' }}
		" style="padding: 0px;">
		     fghdhdfgh 
		</div>
	</div>
@endforeach

