<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Dashboard @yield('title')</title>
  <!-- loader-->
  <link href="{{ asset('dash_assets/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('dash_assets/js/pace.min.js') }}"></script>
  <!--favicon-->
  <link rel="icon" href="{{ asset('dash_assets/images/favicon.png') }}" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="{{ asset('dash_assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="{{ asset('dash_assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('dash_assets/css/bootstrap-datetimepicker.css') }}" />
  <!-- animate CSS-->
  <link href="{{ asset('dash_assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('dash_assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('dash_assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('dash_assets/css/app-style.css') }}" rel="stylesheet"/>
  <!-- Select2 -->
  <link href="{{ asset('dash_assets/css/select2.min.css') }}" rel="stylesheet"/>
  @livewireStyles
</head>

<body class="bg-theme bg-theme2">

<!-- Start wrapper-->
<div id="wrapper">

<!--Start sidebar-wrapper-->
 <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
   <div class="brand-logo">
    <a href="{{ route('admin.dashboard')}}">
     <img src="{{ asset('dash_assets/images/favicon.png') }}" class="logo-icon" alt="logo icon">
     <h5 class="logo-text">VITZARD COMPUTER</h5>
   </a>
 </div>
 <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
    <li>
      <a href="{{ route('admin.dashboard')}}">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <li id="act_ordered">
        <a href="{{ route('admin.ordersPending')}}">
            <i class="zmdi zmdi-hourglass"></i> <span>Orders Pending</span>
        </a>
    </li>

    <li id="act_orderpacking">
        <a href="{{ route('admin.ordersPacking')}}">
            <i class="zmdi zmdi-check-circle"></i> <span>Orders Pack&AddTrack</span>
        </a>
    </li>

    <li id="act_ordershipping">
        <a href="{{ route('admin.ordersShipping')}}">
            <i class="zmdi zmdi-truck"></i> <span>Orders Shipping</span>
            {{-- <small class="badge float-right badge-light">New Order</small> --}}
        </a>
    </li>

    <li id="act_delivered">
        <a href="{{ route('admin.ordersDelivered')}}">
            <i class="zmdi zmdi-case-check"></i> <span>Orders Delivered</span>
        </a>
    </li>

    <li id="act_cats">
      <a href="{{ route('admin.categories')}}">
        <i class="zmdi zmdi-collection-bookmark"></i> <span>Categories</span>
      </a>
    </li>

    <li id="act_pro">
      <a href="{{ route('admin.products')}}">
        <i class="fa fa-archive" aria-hidden="true"></i> <span>Products</span>
      </a>
    </li>

    <li>
        <a href="{{ route('admin.reports')}}">
            <i class="zmdi zmdi-chart"></i> <span>Reports</span>
        </a>
    </li>

    <li class="sidebar-header">Manage & Setting</li>
    <li id="act_mhs">
      <a href="{{ route('admin.homeslider')}}">
        <i class="zmdi zmdi-view-carousel"></i> <span>Manage Home Slider</span>
      </a>
    </li>

    <li>
      <a href="{{ route('admin.homecategories')}}">
        <i class="zmdi zmdi-tag"></i> <span>Manage Home Categories</span>
      </a>
    </li>

    <li>
        <a href="{{ route('admin.sale')}}">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Sale Setting</span>
        </a>
    </li>

    <li id="act_cou">
        <a href="{{ route('admin.coupons')}}">
            <i class="zmdi zmdi-ticket-star"></i> <span>All Coupons</span>
        </a>
    </li>

    <li class="sidebar-header">Responded From User</li>
    <li>
        <a href="{{route('admin.contact')}}"><i class="zmdi zmdi-comment-alt-text text-success"></i> <span>Contact Messages</span></a>
    </li>

    <li>
        <a href="https://dashboard.stripe.com/test/payments" target="blank"><i class="fa fa-credit-card-alt text-info"></i> <span>Payments Gateway</span></a>
    </li>

  </ul>

 </div>
 <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
<nav class="navbar navbar-expand fixed-top">
<ul class="navbar-nav mr-auto align-items-center">
  <li class="nav-item">
    <a class="nav-link toggle-menu" href="javascript:void();">
     <i class="icon-menu menu-icon"></i>
   </a>
  </li>
  {{-- <li class="nav-item">
    <form class="search-bar">
      <input type="text" class="form-control" placeholder="Enter keywords">
       <a href="javascript:void();"><i class="icon-magnifier"></i></a>
    </form>
  </li> --}}
</ul>

<ul class="navbar-nav align-items-center right-nav-link">
    <div>
  <li class="nav-item">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
      <span class="user-profile"><img src="{{asset('assets/images/profiles')}}/{{Auth::user()->profile->image}}" class="img-circle" alt="user avatar"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
     <li class="dropdown-item user-details">
      <a href="javaScript:void();">
         <div class="media">
           <div class="avatar"><img class="align-self-start mr-3" src="{{asset('assets/images/profiles')}}/{{Auth::user()->profile->image}}" alt="user avatar"></div>
          <div class="media-body">
          <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
          <p class="user-subtitle">{{ Auth::user()->email }}</p>
          </div>
         </div>
        </a>
      </li>
        <li class="dropdown-divider"></li>
        <a class="hovcolor" href="/">
            <li class="dropdown-item">
                <i class="icon-home mr-2"></i> Go to Shopping Page
            </li>
        </a>
        <li class="dropdown-divider"></li>
        <a href="https://mail.google.com/mail/u/2/#inbox" target="blank">
            <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        </a>
        <li class="dropdown-divider"></li>
        <form method="POST" action="{{ route('logout')}}">
        @csrf
        <a class="hovcolor" href="{{ route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
            <li class="dropdown-item">
                <i class="icon-power mr-2"></i> Logout
            </li>
        </a>
      </form>
    </ul>
  </li>
</div>
</ul>

</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>

{{$slot}}

<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<!--Start footer-->
<footer class="footer">
  <div class="container">
    <div class="text-center">
      Copyright © 2022 VITZARD Computer Group All Rights Reserved.
    </div>
  </div>
</footer>
<!--End footer-->

</div><!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dash_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('dash_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('dash_assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('dash_assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- simplebar js -->
<script src="{{ asset('dash_assets/plugins/simplebar/js/simplebar.js') }}"></script>
<!-- sidebar-menu js -->
<script src="{{ asset('dash_assets/js/sidebar-menu.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('dash_assets/js/app-script.js') }}"></script>
<!-- Chart js -->
<script src="{{ asset('dash_assets/plugins/Chart.js/Chart.min.js') }}"></script>
<!-- Index js -->
<script src="{{ asset('dash_assets/js/index.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('dash_assets/js/select2.min.js') }}"></script>
<!-- Tiny Html -->
<script src="https://cdn.tiny.cloud/1/1yzizjof5v9lndey4qvwmnnxmlijxv1y0e8rcsxouphbvehn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    window.addEventListener('show-delete-modal', event => {
        $('#confirmdelete').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmdelete').modal('hide');
    })
</script>

<script>
    window.addEventListener('show-subdelete-modal', event => {
        $('#confirmsubdelete').modal('show');
    })

    window.addEventListener('hide-subdelete-modal', event => {
        $('#confirmsubdelete').modal('hide');
    })
</script>

@livewireScripts

@stack('scripts')

</body>
</html>
