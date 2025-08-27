<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Dashboard | OrderDetails @yield('title')</title>
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
  <!-- Tracking Timeline -->
  <link rel="stylesheet" href="{{ asset('dash_assets/css/track-timeline.css') }}">
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

    <li id="@if($order->status == "ordered")'act_btn'@endif">
        <a href="{{ route('admin.ordersPending')}}">
            <i class="zmdi zmdi-hourglass"></i> <span>Orders Pending</span>
        </a>
    </li>

    <li id="@if($order->status == "packing")'act_btn'@elseif($order->status == "order_confirmed")'act_btn'@endif">
        <a href="{{ route('admin.ordersPacking')}}">
            <i class="zmdi zmdi-check-circle"></i> <span>Orders Pack&AddTrack</span>
        </a>
    </li>

    <li id="@if($order->status == "shipping")'act_btn'@endif">
        <a href="{{ route('admin.ordersShipping')}}">
            <i class="zmdi zmdi-truck"></i> <span>Orders Shipping</span>
        </a>
    </li>

    <li id="@if($order->status == "delivered")'act_btn'@endif">
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

<div>
    @section('title') {{'| OrderDetails'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">

        @isset($response)
        <!-- Start Tracking Area -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header" style="font-size: 20px">Delivery status : @if($response[0]->status_ship == "True") Delivery Success @else Shipping @endif
                        <div class="card-action">
                            @if($order->status == "shipping")
                                @if($response[0]->status_ship == "True")
                                    <form action="{{ route('admin.confirmdelivery') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <button type="submit" class="btn btn-primary mb-2" title="Confirm Order Status">Confirm Delivery</button>
                                    </form>
                                @endif
                            @endif
                            @if($order->status == 'shipping')
                                <a href="{{route('admin.ordersShipping')}}" class="btn btn-success btn-block" title="Go back to all order">All Orders</a>
                            @elseif($order->status == 'delivered')
                                <a href="{{route('admin.ordersDelivered')}}" class="btn btn-success btn-block" title="Go back to all order">All Orders</a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="content">
                                        <ul class="timeline">
                                            @for ($i = 0; $i < count($response); $i++)
                                                @if($i==0)
                                                    @php $oldstatus = $response[$i]->status @endphp
                                                    <li class="event" style="border: none; !important" data-date="{{$response[$i]->date}}  {{$response[$i]->time}}">
                                                        <h3>{{$response[$i]->status}}</h3>
                                                    </li>
                                                @endif
                                                @if($i > 0)
                                                    @if($oldstatus !=  $response[$i]->status)
                                                        <li class="event" style="border: none; !important" data-date="{{$response[$i]->date}}  {{$response[$i]->time}}">
                                                            <h3>{{$response[$i]->status}}</h3>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tracking Area -->
        @endisset

        <!-- Start Status Area -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header" style="font-size: 20px">รายละเอียดการสั่งซื้อ
                        <div class="card-action">
                            @empty($response)
                                @if($order->status == 'ordered')
                                    <a href="{{route('admin.ordersPending')}}" class="btn btn-success">All Orders</a>
                                @elseif($order->status == 'packing' || 'order_confirmed')
                                    <a href="{{route('admin.ordersPacking')}}" class="btn btn-success">All Orders</a>
                                @elseif($order->status == 'shipping')
                                    <a href="{{route('admin.ordersShipping')}}" class="btn btn-success">All Orders</a>
                                @elseif($order->status == 'delivered')
                                    <a href="{{route('admin.ordersDelivered')}}" class="btn btn-success">All Orders</a>
                                @endif
                            @endempty
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <tr>
                                @if(Session::has('message'))
                                    <div align="center" class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div align="center" class="alert alert-danger">{{ Session::get('error_message') }}</div>
                                @endif
                                <th>Order ID</th>
                                <td>{{$order->id}}</td>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Status</th>
                                <td>{{$order->status}}</td>
                                @if($order->status == "delivered")
                                    <th>Dalivery Date</th>
                                    <td>{{$order->delivered_date}}</td>
                                @elseif($order->status == "cancelled")
                                    <th>Cancellation Date</th>
                                    <td>{{$order->cancelled_date}}</td>
                                @endif
                                <th>Tracking Number</th>
                                @isset($response)
                                    <td>{{$order->tracking_number}}</td>
                                @endisset
                                @empty($response)
                                    @if(isset($order->tracking_number))
                                        <form action="{{ route('admin.savetrack') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <td><input name="tracking_num" value="{{$order->tracking_number}}" type="text" class="form-control" id="input-3" placeholder="Update Tracking Number" /></td>
                                            <td><button id="save" type="submit" class="btn btn-success btn-lg btn-block">Update</button></td>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.savetrack') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <td><input name="tracking_num" type="text" class="form-control" id="input-3" placeholder="ADD Tracking Number" /></td>
                                            <td><button id="save" type="submit" class="btn btn-success btn-lg btn-block">Save</button></td>
                                        </form>
                                    @endif
                                @endempty
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Status Area -->

        <!--Start Ordered Items Content-->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">รายการสินค้าที่สั่งซื้อ
                    <div class="card-action">
                        {{-- add some action --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">PID</th>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="text-center">{{$item->product->id}}</td>
                                    <td><img src="{{ asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}" width="80px"></td>
                                    <td><a href="{{route('product.details',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a></td>
                                    <td>฿{{number_format(($item->price), 2);}}</td>
                                    <td class="text-center"><p>{{$item->qty}}</p></td>
                                    <td>฿{{number_format(($item->price * $item->qty), 2);}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <div class="right">
                            <ul style="padding-top: 20px;">
                                <li>ยอดรวมทั้งหมด (บาท)<span>{{number_format(($order->subtotal), 2);}} ฿</span></li>
                                <li>ภาษีมูลค่าเพิ่ม ({{config('cart.tax')}}%)<span> {{number_format(($order->tax), 2);}} ฿</span></li>
                                <li>ค่าจัดส่ง<span>จัดส่งฟรี</span></li>
                                <li class="last" style="color: #f00; font-size: 16px;">ราคาสุทธิที่ต้องชำระ<span style="color: #f00">{{number_format(($order->total), 2);}} ฿</span></li>
                            </ul>
                        </div>
                    </div>
                 </div>
               </div>
             </div>
            </div>
        <!--End Row-->

        <!--Start Billing Details Content-->
            <div class="row">
                <div class="col-12 col-lg-12">
                  <div class="card">
                    <div class="card-header" style="font-size: 20px">ที่อยู่เรียกเก็บเงินและจัดส่งสินค้า
                     <div class="card-action">
                        <div class="dropdown">
                            {{-- add action --}}
                         </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <tr>
                                <th>ชื่อจริง</th>
                                <td>{{$order->firstname}}</td>
                                <th>นามสกุล</th>
                                <td>{{$order->lastname}}</td>
                            </tr>
                            <tr>
                                <th>ที่อยู่ Email</th>
                                <td>{{$order->email}}</td>
                                <th>หมายเลขโทรศัพท์</th>
                                <td>{{$order->mobile}}</td>
                            </tr>
                            <tr>
                                <th>รายละเอียดที่อยู่บรรทัดที่ 1</th>
                                <td>{{$order->line1}}</td>
                                <th>รายละเอียดที่อยู่บรรทัดที่ 2</th>
                                <td>{{$order->line2}}</td>
                            </tr>
                            <tr>
                                <th>เมืองหรือจังหวัด</th>
                                <td>{{$order->city}}</td>
                                <th>เขตหรืออำเภอ</th>
                                <td>{{$order->province}}</td>
                            </tr>
                            <tr>
                                <th>รหัสไปรษณีย์</th>
                                <td>{{$order->zipcode}}</td>
                                <th>แขวงหรือตำบล</th>
                                <td>{{$order->district}}</td>
                            </tr>
                            <tr>
                                <th>ประเทศ</th>
                                <td>{{$order->country}}</td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
               </div>
            <!--End Row-->

            <!--Start Shipping Details Content-->
            @if($order->is_shipping_different)
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                        <div class="card-header" style="font-size: 20px">ที่อยู่สำหรับจัดส่งสินค้า
                            <div class="card-action">
                            <div class="dropdown">
                                {{-- add action --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-borderless">
                                <tr>
                                    <th>ชื่อจริง</th>
                                    <td>{{$order->shipping->firstname}}</td>
                                    <th>นามสกุล</th>
                                    <td>{{$order->shipping->lastname}}</td>
                                </tr>
                                <tr>
                                    <th>ที่อยู่ Email</th>
                                    <td>{{$order->shipping->email}}</td>
                                    <th>หมายเลขโทรศัพท์</th>
                                    <td>{{$order->shipping->mobile}}</td>
                                </tr>
                                <tr>
                                    <th>รายละเอียดที่อยู่บรรทัดที่ 1</th>
                                    <td>{{$order->shipping->line1}}</td>
                                    <th>รายละเอียดที่อยู่บรรทัดที่ 2</th>
                                    <td>{{$order->shipping->line2}}</td>
                                </tr>
                                <tr>
                                    <th>เมืองหรือจังหวัด</th>
                                    <td>{{$order->shipping->city}}</td>
                                    <th>เขตหรืออำเภอ</th>
                                    <td>{{$order->shipping->province}}</td>
                                </tr>
                                <tr>
                                    <th>รหัสไปรษณีย์</th>
                                    <td>{{$order->shipping->zipcode}}</td>
                                    <th>แขวงหรือตำบล</th>
                                    <td>{{$order->shipping->district}}</td>
                                </tr>
                                <tr>
                                    <th>ประเทศ</th>
                                    <td>{{$order->shipping->country}}</td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--End Row-->

            <!--Start Transaction Details Content-->
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                        <div class="card-header" style="font-size: 20px">รายละเอียดการชำระเงิน
                            <div class="card-action">
                            <div class="dropdown">
                                {{-- add action --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-borderless">
                                <tr>
                                    <th>วิธีการการชำระเงิน</th>
                                    <td>
                                        @if($order->transaction->mode == 'cod')
                                            ชำระเงินปลายทาง (Cash On Deliverly)
                                        @elseif($order->transaction->mode == 'card')
                                            ชำระเงินด้วยบัตรเครดิตหรือเดบิตการ์ด (Credit/DebitCard)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>สถานะ</th>
                                    <td>{{$order->transaction->status}}</td>
                                </tr>
                                <tr>
                                    <th>วันที่ทำรายการ</th>
                                    <td>{{$order->transaction->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            <!--End Row-->

            <!--End Dashboard Content-->
            <!--start overlay-->
                  <div class="overlay toggle-menu"></div>
            <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div>
</div>

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

<script>
    document.getElementById("update").addEventListener("click",function () {
        var timeoutID = window.setTimeout(function () {
            window.location.reload();
        }, 2000);
    });
</script>

<script>
    var element = document.getElementById("'act_btn'");
    element.classList.add("active");
</script>

@livewireScripts

@stack('scripts')

</body>
</html>
