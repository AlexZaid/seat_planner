
@extends('frame')
@section('content')
<main>
    <div class="container-fluid py-4">
        <header class="pb-3 mb-4 border-bottom">
          <a class="d-flex align-items-center text-dark text-decoration-none">
              <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2 " role="group" aria-label="First group">
                          <input type="radio" class="btn-check" name="weekdays" id="Mo" value="Mo">
                          <label class="btn btn-outline-primary" for="Mo">Mo</label>
                          <input type="radio" class="btn-check" name="weekdays" id="Tu" value="Tu">
                          <label class="btn btn-outline-primary" for="Tu">Tu</label>
                          <input type="radio" class="btn-check" name="weekdays" id="We" value="We">
                          <label class="btn btn-outline-primary" for="We">We</label>
                          <input type="radio" class="btn-check" name="weekdays" id="Th" value="Th">
                          <label class="btn btn-outline-primary" for="Th">Th</label>
                          <input type="radio" class="btn-check" name="weekdays" id="Fr" value="Fr">
                          <label class="btn btn-outline-primary" for="Fr">Fr</label>
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
                        <div class="btn-group me-2 " role="group" aria-label="Third group">
                          <input type="radio" class="btn-check" name="shift" id="1" value="1">
                          <label class="btn btn-outline-primary" for="1">1</label>
                          <input type="radio" class="btn-check" name="shift" id="2" value="2">
                          <label class="btn btn-outline-primary" for="2">2</label>
                          <input type="radio" class="btn-check" name="shift" id="3" value="3">
                          <label class="btn btn-outline-primary" for="3">3</label>
                          <input type="radio" class="btn-check" name="shift" id="4" value="4">
                          <label class="btn btn-outline-primary" for="4">4</label>
                        </div>
                            <div class="btn-group" role="group" aria-label="Third group">                          
                           
                            <button id="zoomInButton">Zoom in</button>
                            <button id="zoomOutButton">Zoom out</button>
                            <button id="resetButton">Reset</button>
                            <input id="rangeInput" class="range-input" type="hidden" min="0.1" max="4" step="0.1" value="1">
                            <div>
                              <input type="checkbox" id="disable-pan" checked=""><label for="disable-pan">Enable panning</label>
                            </div>
                        </div>
                        <div class="btn-group checkboxesDaysMultiple" style="margin-left: 100px;" >
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input MoCheckMultiple" id="checkboxMoMultiple" value="Mo">  
                            <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                              Monday
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input TuCheckMultiple" id="checkboxTuMultiple" value="Tu">  
                            <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                              Tuesday
                            </label>
                          </div>
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input WeCheckMultiple" id="checkboxWeMultiple" value="We">  
                              <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                Wednesday
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input ThCheckMultiple" id="checkboxThMultiple" value="Th">  
                              <label class="form-check-label"  style="padding: 1%;" for="flexCheckDefault">
                                Thursday
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input FrCheckMultiple" id="checkboxFrMultiple" value="Fr">  
                              <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                Friday
                              </label>
                            </div>
                        </div>
                        <div class="btn-group" style="margin-left: 152px;" >
                          <button type="button" onclick="saveLayout()" class="btn btn-outline-success">Save Layout</button>
                        </div>
                </div>  
          </a>
        </header>
        <div class="row"> 
                <div class="col-md-10  col-sm-10  col-xs-10  form-panel"  style="height: 700px; background-color:#212529;">
                  <div id="floors" onselectstart="return false"  style="background-color:#212529; display:block; position:relative; margin:30px auto; height: 650px;width: 1020px; min-width: 1020px;">                                           
						        <div id="floorMZ" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;">
                       <ul id=""  class="panzoom-exclude seat employeesassigned " style="height:30px; width:30px; border:3px dashed #1A436C; padding: 0px; z-index: 1; top:27.846153846153847%; left:50.294117647058826%;">
	                           <div class="seatName"><p style="margin-top: 1px;"></p></div>
	                        		<li class="vat "  value=""  style="margin-left: 2px;margin-top: 2px;">
	                            	    <div style="height: 78px;background-color:#ffffff00;width: 51px;position: absolute;left: -14px;">
	                            	        <button type="button" style="display:none; left: -4px;top: 52px;position: absolute;" onclick="buttoninfo('')" class="editEmp buttoninfo" >Edit</button>
	                            	    </div> 
	                            	    <div class="container info information" style="display:none;width: 150px;background-color: #f4f4fd;left: -4px;top: 52px;position: absolute;z-index: 100;">
	                        			<button type="button" class="close" aria-label="Close" onclick="closeWeekdayTip('info')" ><span style="color:red;" aria-hidden="true">&times;</span></button>
	                        				<br/>
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
						        <div id="floor7" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;"></div>
						        <div id="floor8" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;"></div>
						        <div id="floor9" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;"></div>
						        <div id="floor10" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;"></div>
					        </div>
                </div>            
                <div class="col-xs-2 col-sm-2 col-md-2 form-panel" >
                    <div class="h-100 p-2 text-bg-dark rounded-3">
                    <input type="text" id="filterEmp" class="mb-2 form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <b>Employees with not seat</b>
                        <div class=""	style="width:100%;height:300px; overflow-y: scroll;">
                          <table class="table table-dark table-striped-columns">
                            <thead>
                              <tr>
                            		<th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><div class="filterunassignedemployees" style="margin-left: -14%;" ></div></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <b>Employees in Layout</b>
                        <div class=""	style="width:100%;height:250px; overflow-y: scroll;">
                          <div class="filterEmpInLayout" style="" ></div>
                        </div>
                    </div>
                </div>      
        </div>       
    </div>
    </div>
     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</main>
<script src="/js/setting.js"></script>
@endsection