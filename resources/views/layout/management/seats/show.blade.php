@php
	$tbody="";
@endphp
@foreach ($seats as $seat )
	<div class="seat divseat panzoom-exclude " id="divseat{{$seat->seatName}}" style="width: 25px; position: relative; top: {{$seat->posTop}}%;  left:  {{$seat->posLeft}}%;">
		<img src="/img/marker.png" class="markerSeat" style="display:none; position: absolute; top: -70px; left:-14px;" width="50" height="50">
		<ul id="{{$seat->seatName}}" class="seat{{$seat->seatName}} seatdiv employeesassigned "  data-floor="{{$seat->floor}}" style="height:30px; width:30px; border:3px dashed #1A436C; padding: 0px; z-index: 1;">
		  	
			<button type="button" id="seatButton{{$seat->seatName}}" value="{{$seat->seatName}}" data-element="seat" 
			class="btn btn-primary btnSeatName" 
			style="cursor:pointer;"
			 data-bs-toggle="modal" data-bs-target="#seatModal{{$seat->seatName}}">
			 {{$seat->seatName}}</button>
		   			<div class="modal fade" id="seatModal{{$seat->seatName}}" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true">
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
							<b id="switchText{{$seat->seatName}}"></b><br/>
							<label onclick="" class="switch switchLabel{{$seat->seatName}}">
		  						<input onchange="switchBoxes(this,'{{$seat->seatName}}')" type="checkbox" class="sharedSwitchInput{{$seat->seatName}}">
		  						<span class="slider round"></span>
							</label>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				<li class="vat "   data-element="employee" value="" data-seat="{{$seat->seatName}}" style="margin-left: 2px; margin-top: 2px;">
		    	    <a style="display:none;" href="#"></a>		
					<div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
		    	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" data-bs-toggle="modal" data-bs-target="#employeeModal" class="editEmp buttoninfo" >Edit</button>
		    	    </div> 
		    	    <div class="avatar picture" id="" style="">
		    	    </div>
		    	    <div class="picletters Name" >
		    	    </div>
					<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h1 class="modal-title fs-5" id="employeeModalLabel">Modal title</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <b>Weekdays:</b><br/>
								<div onclick="" class="checkbox checkboxesDays">
									<input type="checkbox" class="MoCheck" id="checkboxMo" value="Mo" > <label for="cbox2">Monday</label><br/>
									<input type="checkbox" class="TuCheck" id="checkboxTu" value="Tu" > <label for="cbox2">Tuesday</label><br/>
									<input type="checkbox" class="WeCheck" id="checkboxWe" value="We" > <label for="cbox2">Wednesday</label><br/>
									<input type="checkbox" class="ThCheck" id="checkboxTh" value="Th" > <label for="cbox2">Thursday</label><br/>
									<input type="checkbox" class="FrCheck" id="checkboxFr" value="Fr" > <label for="cbox2">Friday</label>
								</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
		    	</li>   
		</ul>
				<div id="open{{$seat->seatName}}" class="opendiv  open{{$seat->seatName}} " style="padding: 0px; display:none;">
				     open 
				</div>
	</div>
	@php
		//$data[] =array("seatName" =>  $seat->seatName, "posTop" => $seat->posTop, "posLeft" => $seat->posLeft);
		$tbody.="<tr><td class='seatNametd'>".$seat->seatName."</td><td  class='posToptd'>".$seat->posTop."</td><td  class='posLefttd'>".$seat->posLeft."</td><tr>"; 
	@endphp

@endforeach
<table class="table" style="display:none;">
  <tbody class="seatsPositions{{$seat->floor}} seatsPositions">
  @php echo $tbody; @endphp
  </tbody>
</table>
	


		
