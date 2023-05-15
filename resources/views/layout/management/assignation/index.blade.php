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
                  <div id="floors" onselectstart="return false"  style="background-color:#212529; display:none; position:relative; margin:30px auto; height: 650px;width: 1020px; min-width: 1020px;">                                           
						        <div id="floorMZ" style="background: url('/img/Slide1.png') no-repeat; position:absolute;  height: 100%; width: 100%;"></div>
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
<script src="/js/management.js"></script>
@endsection