@extends('frame')
@section('content')
<main>
    <div class="container-fluid py-4">
        <header class="pb-3 mb-4 border-bottom">
          <a class="d-flex align-items-center text-dark text-decoration-none">
            <span class="fs-4">Layout</span>
          </a>
        </header>
        <div class="row">   
                <div class="col-md-10 form-panel"  style="overflow: auto; height: 700px; ">
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
                <div id="floors" onselectstart="return false"  style=" display:none; margin-top:20px;position:absolute;background: url('img/Slide1.png') no-repeat; height: 650px; width: 1000px;">                                           
						      <div id="floorMZ"></div>
						      <div id="floor7"></div>
						      <div id="floor8"></div>
						      <div id="floor9"></div>
						      <div id="floor10"></div>
					      </div>	
                </div>            
                <div class="col-sm-2 col-md-2 form-panel" >
                    <div class="h-100 p-2 text-bg-dark rounded-3">
                        <input type="text" class="mb-2 form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <div class=""	style="width:20px;height:700px; overflow-y: scroll;">
                          <table class="table table-dark table-striped-columns">
                            <thead>
                                <tr style="background-color: whitesmoke; text-align:center;">
                            		<th><b>Employees with not seat</b></th>
                                </tr>
                            </thead>
                            <tbody class="filteremployees"   >
                            </tbody>
                          </table>
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
<script src="{{ asset('js/layout.js') }}"></script>
@endsection