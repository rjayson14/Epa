<!DOCTYPE html>
<html lang="en">

<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  @laravelPWA
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="shortcut icon" href="{{asset('images/epa2.png')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->

  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/horizontal-layout-light/style.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  

 <!-- Custom style CSS -->
  <style type="text/css">
    body {
            background: url("{{ asset('images/assd.jpg')}}") no-repeat fixed center;
        }
    .dataTables_paginate
    {
      float: right !important;
    }
    .dataTables_empty {
      text-align: center;
    }
    .dataTables_info {
      position: absolute;
      /* margin-top: 10px; */
    }
    .modal-header {
      background-color: #007bff;
      color: #FFF;
    }
    .sidebar-mini .main-sidebar .sidebar-brand a .header-logo  {
      height: 35px;
    }
    input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .pointer {cursor: pointer;}
        
        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/loading.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:120px 120px;
        }
        @media (min-width: 768px) {
            .modal-xl {
                width: 100%;
                max-width:1700px;
            }
        }
        
</style>

  
</head>

<body>
  <div id="myDiv" class="loader" style='display:none;'></div>
  <div class="container-scroller">
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0" style='background-color:white !important;'>
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="{{url('/')}}"><img src="{{asset('images/header.png')}}" alt="logo"/></a>
              <a class="navbar-brand brand-logo-mini" href="{{url('/')}}"><img src="{{asset('images/logo-mini.png')}}" alt="logo"/></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
             
              <ul class="navbar-nav navbar-nav-right">
                
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class='text-dark'>{{auth()->user()->name}} - {{auth()->user()->id}}</span>
                    <img src="{{auth()->user()->avatar}}"  onerror="this.src='{{URL::asset('/images/no_image.png')}}';" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="logout();show();" >
                      <i class="ti-power-off text-primary"></i>
                      Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="ti-menu"></span>
              </button>
            </div>
          </div>
        </nav>
        <nav class="bottom-navbar"style='background-color:#2cf66f !important;' >
          <div class="container">
            @if(auth()->user()->role == "Administrator")
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                  <i class="icon-grid menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/teachers')}}">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">Teachers</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/students')}}">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">Students</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Attendances</span>
                  <i class="menu-arrow"></i></a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="{{url('/attendances/Student')}}">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/attendances/Teacher')}}">Teachers</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/settings')}}">
                  <i class="icon-cog menu-icon"></i>
                  <span class="menu-title">Settings</span>
                </a>
              </li>
            </ul>
            @endif
            @if(auth()->user()->role == "Student")
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                  <i class="icon-grid menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/my-attendance')}}">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">My Attendance</span>
                </a>
              </li>
              <li class="nav-item" style='padding-left:900px;'>
                {{-- <a class="nav-link" href="#"> --}}
                  {{-- <i class="icon-grid menu-icon"></i> --}}
                  <span class="menu-title"></span>
                {{-- </a> --}}
              </li>
            </ul>
            @endif
            @if(auth()->user()->role == "Teacher")
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                  <i class="icon-grid menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/my-attendance')}}">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">My Attendance</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/subjects')}}">
                  <i class="icon-layers menu-icon"></i>
                  <span class="menu-title">Classes</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/attendances/Student')}}">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">Students</span>
                </a>
              </li>
              <li class="nav-item" style='padding-left:700px;'>
                {{-- <a class="nav-link" href="#"> --}}
                  {{-- <i class="icon-grid menu-icon"></i> --}}
                  <span class="menu-title"></span>
                {{-- </a> --}}
              </li>
            </ul>
            @endif
          </div>
        </nav>
      </div>
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel" style = "background:#ccf8ca;">
      <!-- Main Content -->
          @yield('content')
          {{-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}}.  
            </div>
          </footer> --}}
        </div>
      </div>
  </div>
  @yield('footer')
  <script type='text/javascript'>
    function show()
    {
        document.getElementById("myDiv").style.display="block";
    }
    function logout()
    {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>
  <!-- General JS Scripts -->

  <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <!-- Plugin js for this page -->
  <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('js/dataTables.select.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/settings.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <!-- endinject -->
  <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
  <!-- Custom js for this page-->
  <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <script src="{{asset('js/Chart.roundedBarCharts.js')}}"></script>
  <script src="{{ asset('assets/js/page/datatables.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  @include('sweetalert::alert')
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>