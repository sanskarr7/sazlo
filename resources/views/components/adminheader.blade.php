<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Barcob Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="Dashboard/vendors/feather/feather.css">
  <link rel="stylesheet" href="Dashboard/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="Dashboard/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="Dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="Dashboard/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="Dashboard/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="Dashboard/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="Dashboard/images/favicon.png" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="Dashboard/images/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="Dashboard/images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <h4 class="">&nbsp; &nbsp; &nbsp; This is the Admin Dashboard</h4>
        <ul class="navbar-nav navbar-nav-right">
        
          <!-- <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="Dashboard/images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout 
              </a>
            </div>
          </li> -->
         
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('/admin') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Our Products</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ URL::to('adminProducts') }}">View All</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Our Customer</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{URL::to('ourCustomers')}}">View All</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="icon-bar-graph menu-icon"></i>
            <span class="menu-title">Our Orders</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('ourOrders') }}">View All</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ URL::to('logout') }}">Logout</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ URL::to('adminProfile') }}">Profile</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-ban menu-icon"></i>
            <span class="menu-title">Categories</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ URL::to('adminCategoriesC') }}">Add Category</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Customer Reviews</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ URL::to('reviews') }}">Manage Reviews</a></li>
            </ul>
        </div>
    </li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#teachersMenu" aria-expanded="false" aria-controls="teachersMenu">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Our Teachers</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="teachersMenu">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('teachers') }}">Manage Teachers</a>
            </li>
        </ul>
    </div>
</li>

</ul>

      </nav>