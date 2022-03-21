<?php

   $sst = \App\Models\setting::find(1);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Admin dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicons-->
  <link rel="shortcut icon" href="img\favicon.ico" type="{{asset('content/admin')}}/image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('content/admin')}}/img\apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('content/admin')}}/img\apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('content/admin')}}/img\apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('content/admin')}}/img\apple-touch-icon-144x144-precomposed.png">
  
  <!-- Bootstrap core CSS-->
  <link href="{{asset('content/admin')}}/vendor\bootstrap\css\bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="{{asset('content/admin')}}/css\admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{asset('content/admin')}}/vendor\font-awesome\css\font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="{{asset('content/admin')}}/vendor\datatables\dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="{{asset('content/admin')}}/css\custom.css" rel="stylesheet">
  @stack('css')
  <style>
    li.dropLi {
    background: #0e0e0e;
    border-bottom: 1px solid#2f2f2f;
}
li.nav-item:hover {
    background: #252f3a;
}
li.nav-item {
    transition: .5s;
}
  </style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="/"><img src="{{asset('storage/upload/logo')}}/{{$sst->logo}}" data-retina="true" alt="" width="142" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
<?php 
   $orderCount = \App\Models\Order::where('order_method', 'delivery')->where('pageView', 0)->count();
   $admin = auth()->user()->id;

   $user = \App\Models\Admin::find($admin);
 ?>

@if($user->rule_id == 2)
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{url('/admin/dashboard')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>


    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistingss23" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Manage Order</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseMylistingss23">
            <li class="dropLi">

              <a href="{{url('/admin/order-get-new')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Order</span>
              </a>
            </li>
             <li class="dropLi">
              <a href="{{url('/admin/order')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Order Details</span>
              </a>
            </li>
          </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="{{url('admin/profile')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Profile</span>
          </a>
    </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
                                                      data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </li>
  @elseif($user->rule_id == 1)

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{url('/admin/dashboard')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

<?php 
   $orderCount = \App\Models\Order::where('order_method', 'delivery')->where('pageView', 0)->count();

 ?>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistingss23" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Manage Order</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseMylistingss23">
            <li class="dropLi">

              <a href="{{url('/admin/order-get-new')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Order</span>
              </a>
            </li>
             <li class="dropLi">
              <a href="{{url('/admin/order')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Order Details</span>
              </a>
            </li>
          </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistingss" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Manage Category</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseMylistingss">
            <li class="dropLi">

              <a href="{{url('/admin/category')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Category</span>
              </a>
            </li>
             <li class="dropLi">
              <a href="{{url('/admin/sub-category')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Sub Category</span>
              </a>
            </li>
          </ul>
    </li>
    <li class="nav-item" >
          <a href="{{url('/admin/product')}}" class="nav-link">
            <i class="fa fa-product-hunt"></i>
            <span class="nav-link-text">Manage Product</span>
          </a>
    </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{url('/admin/rider')}}">
            <i class="fa fa-user-circle-o"></i>
            <span class="nav-link-text">All Rider</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{url('/admin/customer')}}">
            <i class="fa fa-users"></i>
            <span class="nav-link-text">Manage Customers</span>
          </a>
        </li>
        <?php 
        $reCount = \App\Models\Reservation::where('status', 0)->count();

         ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{url('/admin/reservation')}}">
            <i class="fa fa-cutlery"></i>
            <span class="nav-link-text">Reservation</span>
            @if($reCount > 0)
              <span  class="badge badge-pill badge-danger">new({{$reCount}})</span>
            @endif
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{url('/admin/caterer')}}">
            <i class="fa fa-first-order"></i>
            <span class="nav-link-text">Caterer</span>
          </a>
        </li> 
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="{{url('/admin/report')}}">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span class="nav-link-text">Reports</span>
          </a>
        </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistingss1" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Manage Website Setting</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseMylistingss1">
            <li class="dropLi">

              <a href="{{route('home.page')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Home Page 1</span>
              </a>
            </li>
          </ul>
    </li>
     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistingss122" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Manage Genaral Setting</span>
          </a>
           <ul class="sidenav-second-level collapse" id="collapseMylistingss122">
            <li class="dropLi">

              <a href="{{url('/admin/seo')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Seo</span>
              </a>
            </li>
             <li class="dropLi">

              <a href="{{url('/admin/general')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Genaral Setting</span>
              </a>
            </li>
            <li class="dropLi">

              <a href="{{url('/admin/calendar')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Sale Calendar</span>
              </a>
            </li>
            <li class="dropLi">

              <a href="{{url('/admin/point')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Customer Point List</span>
              </a>
            </li>


            <li class="dropLi">

              <a href="{{url('/admin/shipping')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Shipping Cost</span>
              </a>
            </li>
            <li class="dropLi">

              <a href="{{url('/admin/offer')}}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Offer Products</span>
              </a>
            </li>


          </ul>
    </li>


     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="{{url('admin/profile')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Profile</span>
          </a>
    </li>
    <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
                                                      data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </li>
</ul>
@else
d
@endif

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>


  @yield('content')


  <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © Iftekhar Hossain</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Bootstrap core JavaScript-->

      <!-- jd na paile / bodole \ daw -->

      <script src="{{asset('content/admin')}}/vendor/jquery/jquery.min.js"></script>

      <script src="{{asset('content/admin')}}/vendor\bootstrap\js\bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="{{asset('content/admin')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="{{asset('content/admin')}}/vendor/chart.js/Chart.js"></script>
      <script src="{{asset('content/admin')}}/vendor/datatables/jquery.dataTables.js"></script>
      <script src="{{asset('content/admin')}}/vendor/datatables/dataTables.bootstrap4.js"></script>
      <script src="{{asset('content/admin')}}/vendor/jquery.selectbox-0.2.js"></script>
      <script src="{{asset('content/admin')}}/vendor/retina-replace.min.js"></script>
      <script src="{{asset('content/admin')}}/vendor/jquery.magnific-popup.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{asset('content/admin')}}/js/admin.js"></script>
      <!-- Custom scripts for this page-->
      <script src="{{asset('content/admin')}}/js/admin-charts.js"></script>
      
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      @stack('js')
    
  </body>
  </html>
  