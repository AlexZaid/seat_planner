<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layout</title>
    <link rel="shortcut icon" href="/img/here_white.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>
    <link rel="stylesheet" href="/css/layout.css?v=3">
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/fontawesome/css/solid.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="/img/logo.png" alt="" width="30" height="24">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
    @auth
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="bi bi-person-workspace"></i> Layout
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
          <li><a class="dropdown-item" href="/layout/management/assignation">Assign employees to seats</a></li>
            <!--<li><a class="dropdown-item" href="/layout/office">Office</a></li>
             <li class="nav-item dropdown"><a class="dropdown-item" href="#">Management </a>
             <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/layout/management/assignation">Assign employees to seats</a></li>
                <li><a class="dropdown-item" href="/layout/management/editSeats">Create seats</a></li>
              </ul>   
            </li>--> 
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="bi bi-clipboard2-data"></i> Summary
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="/summary/facilities">Facilities Summary</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav ms-auto">
        <li class="">
          <form method="POST" action="/logout">
                  @csrf
            <a class="nav-link" href="#" onclick="this.closest('form').submit()" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-box-arrow-left"></i>  Logout
            </a>
          </form>
        </li>
      </ul>
      @else
      <ul class="nav navbar-nav ms-auto" >
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i>  Login
          </a>
          <ul class="dropdown-menu" style="left: -150%;">
            <li> 
            <div class="card" style="border: none;">
              <div class="card-body">
              @if (session()->get('error'))
                <div class="alert alert-danger" role="alert">
                  {{ session()->get('error') }}
                </div>
              @endif          
                <form method="POST" action="/login">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <br/>
                  <button type="submit" class="btn btn-primary" style="">Submit</button>
                </form>
              </div>
            </div>
            </li>
            <li><hr class="dropdown-divider"></li>
          </ul>
        </li>
         
        </li>
      </ul>
      @endauth
    </div>
  </div>
</nav>

  @yield('content')
  
</body>
<footer class="pt-3 mt-4 text-muted border-top">
          HERE&copy; 2023
</footer>
</html>
<style>
  /*.dropdown:hover > .dropdown-menu{
    display:block;

  }*/


    body{
        margin:0;
        padding:0;
        font-family: sans-serif;
    }
    .color-container{
        width:16px;
        height:16px;
        display: inline-block;
        border-radius:4px;
    }

    a{
        text-decoration:none;
    }
</style>