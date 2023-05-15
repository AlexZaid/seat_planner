@extends('frame')
@section('content')
<main>
    <div class="container-fluid py-4">
        <header class="pb-2 mb-2 border-bottom">
          <a class="d-flex align-items-center text-dark text-decoration-none">
            <span class="fs-4">Facilities</span>
          </a>
        </header>
        <div class="row">   
                <div class="col-md-10 form-panel"  style="margin:0 auto; margin-top:15px;  ">
                      <ul class="nav nav-tabs">
                          <li class="nav-item">
                              <a href="#Summary" class="nav-link active" data-bs-toggle="tab">Summary</a>
                          </li>
                          <li class="nav-item">
                              <a href="#Changes" class="nav-link" data-bs-toggle="tab">Changes</a>
                          </li>
                          <li class="nav-item">
                              <a href="#Keys" class="nav-link" data-bs-toggle="tab">Keys</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane fade show active" id="Summary">
                           <div class="filtersummary" style="margin:0 auto;width:70%; height: 700px; overflow-y:auto"></div>
                         
                          </div>
                          <div class="tab-pane fade" id="Changes">
                             <div class="filterchanges" style="margin:0 auto;width:70%; height: 700px; overflow-y:auto"></div>
                          </div>
                          <div class="tab-pane fade" id="Keys">
                              <div class="filterkeys" style="margin:0 auto;width:70%; height: 700px; overflow-y:auto"></div>
                          </div>
                      </div>         
                </div>                  
        </div>       
    </div>
    </div>
     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</main>
<script src="/js/facilities.js"></script>
@endsection