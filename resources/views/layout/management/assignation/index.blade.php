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
                        @auth
                          <div class="btn-group checkboxesDaysMultiple" style="margin-left: 100px;" >
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input MoCheckMultiple" id="checkboxMultipleMo" value="Mo">  
                              <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                Monday
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input TuCheckMultiple" id="checkboxMultipleTu" value="Tu">  
                              <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                Tuesday
                              </label>
                            </div>
                              <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input WeCheckMultiple" id="checkboxMultipleWe" value="We">  
                                <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                  Wednesday
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input ThCheckMultiple" id="checkboxMultipleTh" value="Th">  
                                <label class="form-check-label"  style="padding: 1%;" for="flexCheckDefault">
                                  Thursday
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input FrCheckMultiple" id="checkboxMultipleFr" value="Fr">  
                                <label class="form-check-label" style="padding: 1%;" for="flexCheckDefault">
                                  Friday
                                </label>
                              </div>
                          </div>
                          <div class="btn-group" style="margin-left: 152px;" >
                            <button type="button" onclick="saveLayout()" class="btn btn-outline-success">Save Layout</button>
                          </div>
                        @endauth
                </div>  
          </a>
        </header>
        <div class="row"> 
                <div class="col-md-10  col-sm-10  col-xs-10  form-panel"  style="height: 700px; background-color: #cdced0;">
                  <div style="margin-top: 20%;" class="spinload d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                    </div>
                  <div id="floors" onselectstart="return false"  style="background-color: #cdced0; display:none; position:relative; margin:30px auto; height: 650px;width: 997px; min-width: 997px;">                                           
                    <div id="floorMZ" style="background: url('/img/mz.png') no-repeat; position:relative;   height: 650px;width: 1230px; min-width: 1230px;"></div>
						        <div id="floor7" style="background: url('/img/7.png') no-repeat; position:relative;     height: 650px;width: 1230px; min-width: 1230px;"></div>
						        <div id="floor8" style="background: url('/img/8.png') no-repeat; position:relative;     height: 650px;width: 1230px; min-width: 1230px;"></div>
						        <div id="floor9" style="background: url('/img/9.png') no-repeat; position:relative;     height: 650px;width: 1230px; min-width: 1230px;"></div>
						        <div id="floor10" style="background: url('/img/PH.png') no-repeat; position:relative;   height: 650px;width: 1230px; min-width: 1230px;"></div>
					        </div>
                </div>            
                <div class="col-xs-2 col-sm-2 col-md-2 form-panel" >
                    <div class="h-100 p-2 rounded-3" style="background-color: #cdced0;">
                    <input type="text" id="filterEmp" class="mb-2 form-control" placeholder="Type Seat,Employee or EmpId" aria-label="Username" aria-describedby="basic-addon1">
                      <div class="alert alert-info" role="alert">
                         Click on Seat to locate it in layout.
                      </div>
                      @auth
                        <b>Employees with not seat</b>
                        <div class=""	style="width:100%;height:270px; overflow-y: scroll;">
                          <div style="margin-top: 40%;" class="spinload d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                          <table style="display:none;" id="unassignedEmpTable" class="table table-striped-columns">
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
                      @endauth
                        <b>Employees and seats in Layout</b>
                        <div class=""	style="width:100%;height:{{Auth::check() ? '246': '538'}}px; overflow-y: scroll;">
                          <div class="filterEmpInLayout" style="" ></div>
                        </div>
                    </div>
                </div>      
        </div>       
    </div>
    </div>
     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
     <input type="hidden" name="roleEmp" id="roleEmp" value="{{ Session::get('LayoutManager') ? 'management/assignation': 'office' }}">
</main>
 @auth
    <script src="/js/management.js?v=1"></script>
  @else
    <script src="/js/office.js?v=1"></script>
 @endauth
@endsection