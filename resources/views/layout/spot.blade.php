@foreach ($ly_spots as $spot )
	@php
    	$seatExplode = explode ("-", $spot->id_spot);
		$spotNumber = $seatExplode[0];
    	$day = $seatExplode[1];
   		$shift = $seatExplode[2];
		$classShared = $shift. "shared " . $day;
	@endphp
	<div class="{{$classShared}} spotdiv " id="divspot{{$spot->id_spot}}" style="height:20px; width:20px; position: absolute; top: {{$spot->ptop}}px;  left:  {{$spot->pleft}}px;">
	<ul id="{{$spot->id_spot}}" class="spot{{$spot->id_spot}} employeesassigned " style="padding: 0px;">
	   <div class="seatName"><p style="margin-top: 1px;">{{$spot->id_spot}}</p></div>
	    @if ($spot->id_emp!=0)
			<li class="vat {{$spot->id_emp}}" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" value="{{$spot->id_emp}}"  style="margin-left: 1px;">
	    	    <div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
	    	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" onclick="buttoninfo('{{$spot->id_emp}}')" class="editEmp buttoninfo{{$spot->id_emp}}" >Edit</button>
	    	    </div> 
	    	    <div class="container info{{$spot->id_emp}} information" style="display:none;width: 150px;background-color: #f4f4fd;left: -4px;top: 52px;position: absolute;z-index: 100;">
				<button type="button" class="close" aria-label="Close" onclick="closeWeekdayTip('info{{$spot->id_emp}}')" ><span style="color:red;" aria-hidden="true">&times;</span></button>
					<br/>
					<b>Weekdays:</b><br/>
					<div onclick="checkedboxes(this,'{{$spot->id_emp}}')" class="checkbox{{$spot->id_emp}} checkboxesDays">
						<input type="checkbox" class="MoCheck" id="checkbox{{$spot->id_emp}}Mo" value="Mo" {{ false !== strpos($spot->weekdays, 'Mo') ? 'checked': '' }}> <label for="cbox2">Monday</label><br/>
						<input type="checkbox" class="TuCheck" id="checkbox{{$spot->id_emp}}Tu" value="Tu" {{ false !== strpos($spot->weekdays, 'Tu') ? 'checked': '' }}> <label for="cbox2">Tuesday</label><br/>
						<input type="checkbox" class="WeCheck" id="checkbox{{$spot->id_emp}}We" value="We" {{ false !== strpos($spot->weekdays, 'We') ? 'checked': '' }}> <label for="cbox2">Wednesday</label><br/>
						<input type="checkbox" class="ThCheck" id="checkbox{{$spot->id_emp}}Th" value="Th" {{ false !== strpos($spot->weekdays, 'Th') ? 'checked': '' }}> <label for="cbox2">Thursday</label><br/>
						<input type="checkbox" class="FrCheck" id="checkbox{{$spot->id_emp}}Fr" value="Fr" {{ false !== strpos($spot->weekdays, 'Fr') ? 'checked': '' }}> <label for="cbox2">Friday</label>
					</div>	
					<br/>
					<b>Shared:</b><br/>
					<label onclick="" class="switch switchLabel{{$spot->id_emp}}">
	  					<input onchange="switchBoxes(this,'{{$spot->id_emp}}')" type="checkbox" class="sharedSwitchInput{{$spot->id_emp}}">
	  					<span class="slider round"></span>
					</label>
				</div>
	    	    <div class="avatar picture" id="{{$spot->id_emp}}k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$spot->id_emp}}.jpg')">
	    	    </div>
	    	    <div class="picletters Name" >{{$spot->first_name}}
	    	    </div>
	    	</li>
		@endif      
	</ul>
	</div>
@endforeach

