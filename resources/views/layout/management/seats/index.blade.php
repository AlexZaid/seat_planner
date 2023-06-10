
@extends('frame')
@section('content')
<main>
    <div class="container-fluid py-4">
        <header class="pb-3 mb-4 border-bottom">
          <a class="d-flex align-items-center text-dark text-decoration-none">
              <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
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
                           
                            <button id="zoomInButton">Zoom in</button>
                            <button id="zoomOutButton">Zoom out</button>
                            <button id="resetButton">Reset</button>
                            <input id="rangeInput" class="range-input" type="hidden" min="0.1" max="4" step="0.1" value="1">
                            <div>
                              <input type="checkbox" id="disable-pan" checked=""><label for="disable-pan">Enable panning</label>
                            </div>
                        </div>
                        <div class="btn-group" style="margin-left: 152px;" >
                          <button type="button" onclick="saveSeats()" class="btn btn-outline-success">Save Seats</button>
                        </div>
                </div>  
          </a>
        </header>
        <div class="row"> 
                <div class="col-md-10  col-sm-10  col-xs-10  form-panel"  style="height: 700px; background-color:#212529;">
                  <div id="floors" onselectstart="return false"  style="background-color:#212529; display:none; position:relative; margin:30px auto; height: 650px;width: 997px; min-width: 997px;">                                           
						        <div id="floorMZ" style="background: url('/img/mz.png') no-repeat; position:relative;  height: 650px;width: 997px; min-width: 997px;"></div>
						        <div id="floor7" style="background: url('/img/7.png') no-repeat; position:relative;    height: 650px;width: 997px; min-width: 997px;"></div>
						        <div id="floor8" style="background: url('/img/8.png') no-repeat; position:relative;    height: 650px;width: 997px; min-width: 997px;"></div>
						        <div id="floor9" style="background: url('/img/9.png') no-repeat; position:relative;    height: 650px;width: 997px; min-width: 997px;"></div>
						        <div id="floor10" style="background: url('/img/PH.png') no-repeat; position:relative;  height: 650px;width: 997px; min-width: 997px;"></div>
					        </div>
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
    </div>
    
     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</main>
<script src="/js/seat.js"></script>
@endsection