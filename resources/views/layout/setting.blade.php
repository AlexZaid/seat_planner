@extends('frame')
@section('content')
<main>
    <div class="container-fluid py-4">
        <header class="pb-3 mb-4 border-bottom">
          <a class="d-flex align-items-center text-dark text-decoration-none">
             <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2 " role="group" aria-label="First group">
                          <input type="radio" class="btn-check" name="weekdays" id="btnradio1" value="Mo">
                          <label class="btn btn-outline-primary" for="btnradio1">Mo</label>
                          <input type="radio" class="btn-check" name="weekdays" id="btnradio2" value="Tu">
                          <label class="btn btn-outline-primary" for="btnradio2">Tu</label>
                          <input type="radio" class="btn-check" name="weekdays" id="btnradio3" value="We">
                          <label class="btn btn-outline-primary" for="btnradio3">We</label>
                          <input type="radio" class="btn-check" name="weekdays" id="btnradio4" value="Th">
                          <label class="btn btn-outline-primary" for="btnradio4">Th</label>
                          <input type="radio" class="btn-check" name="weekdays" id="btnradio5" value="Fr">
                          <label class="btn btn-outline-primary" for="btnradio5">Fr</label>
                        </div>
                        <div class="btn-group me-2 floorsOption" role="group" aria-label="Second group">
                          <input type="radio" class="btn-check" name="floor" id="MZ" value="MZ" >
                          <label class="btn btn-outline-primary" for="MZ">MZ</label>
                          <input type="radio" class="btn-check" name="floor" id="7" value="7" >
                          <label class="btn btn-outline-primary" for="7">7</label>
                          <input type="radio" class="btn-check" name="floor" id="8" value="8" >
                          <label class="btn btn-outline-primary" for="8">8</label>
                          <input type="radio" class="btn-check" name="floor" id="9" value="9" >
                          <label class="btn btn-outline-primary" for="9">9</label>
                          <input type="radio" class="btn-check" name="floor" id="PH" value="PH" >
                          <label class="btn btn-outline-primary" for="PH">PH</label>
                        </div>
                        <div class="btn-group" role="group" aria-label="Third group">
                          <input type="radio" class="btn-check" name="shift" id="1" value="1">
                          <label class="btn btn-outline-primary" for="1">1</label>
                          <input type="radio" class="btn-check" name="shift" id="2" value="2">
                          <label class="btn btn-outline-primary" for="2">2</label>
                          <input type="radio" class="btn-check" name="shift" id="3" value="3">
                          <label class="btn btn-outline-primary" for="3">3</label>
                        </div>
                </div>
          </a>
        </header>
        <div class="row">  
                 <div id="floors"  class="col-md-2 col-sm-8 col-xs-8 bg-warning  form-panel"  onselectstart="return false"  style="margin:0 auto; margin-top:15px; background:url({{asset('img/Slide1.png')}}) no-repeat; height: 650px; min-width: 1050px;">                                           
						      <div id="floorMZ" style="position:absolute; height: 100%; width: 100%;">
                      <ul id=""  class="panzoom-exclude seat employeesassigned " style="height:30px; width:30px; border:3px dashed #1A436C; padding: 0px; top:7.301415384615384%; left:22.36647619047619%;">
	                           <div class="seatName"><p style="margin-top: 1px;"></p></div>
	                        		<li class="vat "  value=""  style="margin-left: 2px;margin-top: 2px;">
	                            	    <div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
	                            	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" onclick="buttoninfo('')" class="editEmp buttoninfo" >Edit</button>
	                            	    </div> 
	                            	    <div class="container info information" style="display:none;width: 150px;background-color: #f4f4fd;left: -4px;top: 52px;position: absolute;z-index: 100;">
	                        			<button type="button" class="close" aria-label="Close" onclick="closeWeekdayTip('info')" ><span style="color:red;" aria-hidden="true">&times;</span></button>
	                        				<br/>
	                        				<b>Weekdays:</b><br/>
	                        				<div onclick="checkedboxes(this,'')" class="checkbox checkboxesDays">
	                        					<input type="checkbox" class="MoCheck" id="checkboxMo" value="Mo" > <label for="cbox2">Monday</label><br/>
	                        					<input type="checkbox" class="TuCheck" id="checkboxTu" value="Tu" > <label for="cbox2">Tuesday</label><br/>
	                        					<input type="checkbox" class="WeCheck" id="checkboxWe" value="We" > <label for="cbox2">Wednesday</label><br/>
	                        					<input type="checkbox" class="ThCheck" id="checkboxTh" value="Th" > <label for="cbox2">Thursday</label><br/>
	                        					<input type="checkbox" class="FrCheck" id="checkboxFr" value="Fr" > <label for="cbox2">Friday</label>
	                        				</div>	
	                        				<br/>
	                        				<b>Shared:</b><br/>
	                        				<label onclick="" class="switch switchLabel">
	                          					<input onchange="switchBoxes(this,'')" type="checkbox" class="sharedSwitchInput">
	                          					<span class="slider round"></span>
	                        				</label>
	                        			</div>
	                            	    <div class="avatar picture" id="k" style="background-image:url('https://ourpeople.in.here.com/HRPhotos/.jpg')">
	                            	    </div>
	                            	    <div class="picletters Name" >
	                            	    </div>
	                            	</li>     
	                        </ul>
                  </div>
						      <div id="floor7"></div>
						      <div id="floor8"></div>
						      <div id="floor9"></div>
						      <div id="floor10"></div>
					      </div>	    
                 <div style="z-index:4" id="dropZone" class="col-md-2 col-sm-8 col-xs-8 bg-warning  form-panel" >
                    <div class="h-100 p-2 text-bg-dark rounded-3">
                         <div class=""	style="height:650px;">
                         <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Seat Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Floor</label>
                               <select class="custom-select" id="floorSelect">
                                <option selected>Choose...</option>
                                <option value="MZ">MZ</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="PH">PH</option>
                              </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                          <button type="button" onclick="saveSeat()" class="btn btn-primary">create seat</button>
                        </div>
                    </div>
                </div>    
        </div>       
    </div>
    <footer class="pt-3 mt-4 text-muted border-top">
          HERE&copy; 2023
    </footer>
    </div>
</main>
<script src="{{ asset('js/setting.js') }}"></script>
@endsection