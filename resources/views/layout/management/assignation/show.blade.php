@foreach ($seats as $seat )
	@php
		$days = str_replace(',', ' ', $seat->weekdays);
		
		$classShared = $seat->shift. "shared ";
		$seatId=$seat->seatName.'-'.$seat->shift;	
		if($seat->shared==false&&$seat->shift==1) {
			$classShared = "admin ";
		}elseif($seat->shared==false&&($seat->shift==2||$seat->shift==3||$seat->shift==4)){
			$classShared = "";
		}		
	@endphp 
	<div class="divseat" id="divseat{{$seatId}}" style="position: absolute; top: {{$seat->posTop}}%;  left:  {{$seat->posLeft}}%; width: 25px;">
		<img src="/img/marker.png" class="markerSeat" style="display:none; position: absolute; top: -70px; left:-14px;" width="50" height="50">
		<ul id="{{$seatId}}" class="seat{{$seat->seatName}} seatdiv employeesassigned {{$classShared.' '.$days}} " style="padding: 0px;">
		  	
			<button type="button" id="seatButton{{$seatId}}" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" value="{{$seatId}}" data-element="seat" 
			class="btn btn-primary btnSeatName" 
			style="cursor:pointer;"
			 data-bs-toggle="modal" data-bs-target="#seatModal{{$seatId}}">
			 {{$seat->seatName}}</button>
		   			<div class="modal fade" id="seatModal{{$seatId}}" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true">
					  <div class="modal-dialog" >
					    <div class="modal-content">
					      <div class="modal-header">
						  	<i class="fa-solid fa-gear" style="color:#48dad0"></i>
							&nbsp;&nbsp;
					        <h1 class="modal-title fs-5" id="seatModalLabel">Seat</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					       	<br/>
							<b id="switchText{{$seatId}}">{{ $seat->shared ? 'Shared': 'Not Shared' }}:</b><br/>
							<label onclick="" class="switch switchLabel{{$seatId}}">
		  						<input onchange="switchBoxes(this,'{{$seatId}}')" type="checkbox" class="sharedSwitchInput{{$seatId}}" {{ $seat->shared ? 'checked': '' }}>
		  						<span class="slider round"></span>
							</label>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
		    @if (($seat->id_emp!=0 && $seat->shared==true) || ($seat->id_emp!=0 && $seat->shared==false &&  $seat->shift==1 ) )
				<li class="vat {{$seat->id_emp}}" onmouseenter="showButton(this)" onmouseleave="hideButton(this)" data-element="employee" value="{{$seat->id_emp}}" data-seat="{{$seatId}}" style="margin-left: 2px; margin-top: 2px;">
		    	    <a style="display:none;" href="#">{{$seat->first_name." ".$seat->last_name." ".$seat->id_emp}}</a>		
					<div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
		    	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" data-bs-toggle="modal" data-bs-target="#employeeModal{{$seat->id_emp}}" class="editEmp buttoninfo{{$seat->id_emp}}" >Edit</button>
		    	    </div> 
		    	    <div class="avatar picture" id="{{$seat->id_emp}}k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/{{$seat->id_emp}}.jpg')">
		    	    </div>
		    	    <div class="picletters Name" >{{$seat->first_name." ".$seat->last_name}}
		    	    </div>
					<div class="modal fade" id="employeeModal{{$seat->id_emp}}" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h1 class="modal-title fs-5" id="employeeModalLabel">Modal title</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <b>Weekdays:</b><br/>
								<div onclick="checkedboxes(this,'{{$seat->id_emp}}')" class="checkbox{{$seat->id_emp}} checkboxesDays">
									<input type="checkbox" class="MoCheck" id="checkbox{{$seat->id_emp}}Mo" value="Mo" {{ false !== strpos($seat->weekdays, 'Mo') ? 'checked': '' }}> <label for="cbox2">Monday</label><br/>
									<input type="checkbox" class="TuCheck" id="checkbox{{$seat->id_emp}}Tu" value="Tu" {{ false !== strpos($seat->weekdays, 'Tu') ? 'checked': '' }}> <label for="cbox2">Tuesday</label><br/>
									<input type="checkbox" class="WeCheck" id="checkbox{{$seat->id_emp}}We" value="We" {{ false !== strpos($seat->weekdays, 'We') ? 'checked': '' }}> <label for="cbox2">Wednesday</label><br/>
									<input type="checkbox" class="ThCheck" id="checkbox{{$seat->id_emp}}Th" value="Th" {{ false !== strpos($seat->weekdays, 'Th') ? 'checked': '' }}> <label for="cbox2">Thursday</label><br/>
									<input type="checkbox" class="FrCheck" id="checkbox{{$seat->id_emp}}Fr" value="Fr" {{ false !== strpos($seat->weekdays, 'Fr') ? 'checked': '' }}> <label for="cbox2">Friday</label>
								</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
		    	</li>
			@endif      
		</ul>
		@php
				$classDays="";
				
					if(strpos($seat->weekdays,'Mo')===false){
						$classDays.="Mo ";
					} 
					if(strpos($seat->weekdays,'Tu')===false){
						$classDays.="Tu ";
					} 
					if(strpos($seat->weekdays,'We')===false){
						$classDays.="We ";
					} 
					if(strpos($seat->weekdays,'Th')===false){
						$classDays.="Th ";
					} 
					if(strpos($seat->weekdays,'Fr')===false){
						$classDays.="Fr ";
					} 

				@endphp 
				<div id="open{{$seatId}}" class="opendiv {{$classShared}} open{{$seat->seatName}} {{$classDays}}" style="padding: 0px;">
				     <div class="openSeats">
					 <button type="button" id="" onclick="showModalOpen()" class="btn btn-primary btnSeatName" style="cursor:pointer;">
			 {{$seat->seatName}}</button>
					 </div> 
				</div>
	</div>
@endforeach

