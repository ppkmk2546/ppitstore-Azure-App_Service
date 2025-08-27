<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>@yield('title') OrderDetails | VITZARD Computer</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->
    <!-- Tracking ProcessBar -->
    <link rel="stylesheet" href="{{ asset('assets/css/process.css') }}">
    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
	<!-- Fancybox -->
	{{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}"> --}}
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/flex-slider.min.css') }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    <!-- Owl Carousel Min -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- Nouislider Min -->
    <link rel="stylesheet" href="{{ asset('assets/css/nouislider.css') }}">
    <!-- Tracking Timeline -->
    <link rel="stylesheet" href="{{ asset('assets/css/track-timeline.css') }}">

	<!-- Vitzard Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slide-theme.css') }}">

	<!-- Color CSS -->
	<link rel="stylesheet" href="{{ asset ('assets/css/color/color1.css') }}">

	<link rel="stylesheet" href="#" id="colors">
    @livewireStyles
</head>
<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i><a href="tel:0810576379"> (081)-057-6379</a></li>
								<li><i class="ti-email"></i><a href="mailto:vizardcomputer@gmail.com"> vizardcomputer@gmail.com</a></li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
                                @if(Route::has('login'))
                                    @auth
                                        @if(Auth::user()->utype === 'ADM')
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="My Account" href="#">
                                                    @if(Auth::user()->profile === null)
                                                        <img src="{{ asset('assets/images/profiles/default_profile.png') }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle" width="30">
                                                    @else
                                                        <img style="box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 8px 16px 0 rgba(0, 0, 0, 0.19);" src="{{asset('assets/images/profiles')}}/{{Auth::user()->profile->image}}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle" width="30">
                                                    @endif
                                                     {{ Auth::user()->name }}
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('admin.dashboard')}}">
                                                        <li class="dropdown-item" >
                                                            Dashboard
                                                        </li>
                                                    </a>
                                                    <a href="{{ route('user.profile')}}">
                                                        <li class="dropdown-item" >
                                                            My Profile
                                                        </li>
                                                    </a>
                                                    <form method="POST" action="{{ route('logout')}}">
                                                        @csrf
                                                        <a href="{{ route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <li class="dropdown-item" >
                                                                Logout
                                                            </li>
                                                        </a>
                                                    </form>
                                                </ul>
                                            </li>
                                        @elseif(Auth::user()->utype === 'USR')
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="My Account" href="#">
                                                    @if(Auth::user()->profile === null)
                                                        <img src="{{ asset('assets/images/profiles/default_profile.png') }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle" width="30">
                                                    @else
                                                        <img style="box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 8px 16px 0 rgba(0, 0, 0, 0.19);" src="{{asset('assets/images/profiles')}}/{{Auth::user()->profile->image}}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle" width="30">
                                                    @endif
                                                     {{ Auth::user()->name }}
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('user.dashboard')}}">
                                                        <li class="dropdown-item" >
                                                            Summary
                                                        </li>
                                                    </a>
                                                    <a href="{{ route('user.orders')}}">
                                                        <li class="dropdown-item" >
                                                            My Orders
                                                        </li>
                                                    </a>
                                                    <a href="{{ route('user.profile')}}">
                                                        <li class="dropdown-item" >
                                                            My Profile
                                                        </li>
                                                    </a>
                                                    <a href="{{ route('user.changepassword')}}">
                                                        <li class="dropdown-item" >
                                                            Change Password
                                                        </li>
                                                    </a>
                                                    <form method="POST" action="{{ route('logout')}}">
                                                        @csrf
                                                        <a href="{{ route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <li class="dropdown-item" >
                                                                Logout
                                                            </li>
                                                        </a>
                                                    </form>
                                                </ul>
                                            </li>
                                        @endif
                                    @else
                                        <li><a title="Login to your Account." href="{{route('login')}}"><i class="ti-power-off"></i>Login</a></li>
                                        <li><a title="Don't have yet? Create your Account." href="{{route('register')}}"><i class="ti-pencil"></i>Register</a></li>
                                    @endif
                                @endif
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
						</div>
						<!--/ End Logo -->
                        <!-- Search Form -->
                        @livewire('header-search-component')

                        <!-- End Search Form -->
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
                            <div class="sinlge-bar">
                                @livewire('wishlist-count-component')
                            </div>
							<div class="sinlge-bar shopping">
								@livewire('cart-count-component')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						@if(Request::is('/'))
                            <div class="col-lg-3">
                                @livewire('navbar-component')
                            </div>
                        @endif
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li class="{{'/' == request()->path() ? 'active' : ''}}"><a href="/">Home</a></li>
												<li class="{{'shop' == request()->path() ? 'active' : ''}}"><a href="/shop">All Products</a></li>
                                                <li class="{{'about-us' == request()->path() ? 'active' : ''}}"><a href="/about-us">About Us</a></li>
												<li class="{{'contact-us' == request()->path() ? 'active' : ''}}"><a href="/contact-us">Contact Us</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

<div>
    @section('title') {{'OrderDetails'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs cart-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{route('user.orders')}}">Orders<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Orders Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <div style="background-color: #eee;">
        <div class="container-fluid" style="width: 70%">
            <div class="row" style="padding-top: 40px;">
                <div class="col-12 col-lg-12">
                    <div class="card" style="background-color: #fff; border-color: #eee;">
                    <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">Order status
                        <div class="card-action" style="float: right;">
                            <!-- Add some action -->
                            <a href="{{route('user.orders')}}" class="orbtn btn-primal btn-block text-center" title="Go back to all order">All Orders</a>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main">
                                            <ul id="pro_ul">
                                                <li id="pro_li">
                                                    <i class="icon_bar uil uil-clipboard-notes"></i>
                                                    <div class="progress_bar one {{ $order->status ==  'ordered' ? 'active' : '' }}">
                                                        <p class="para"></p>
                                                        <i class="uil uil-check"></i>
                                                    </div>
                                                    <p class="text_bar">Ordered</p>
                                                </li>
                                                <li id="pro_li">
                                                    <i class="icon_bar uil uil-check-circle"></i>
                                                    <div class="progress_bar two {{ $order->status ==  'order_confirmed' ? 'active' : '' }}">
                                                        <p class="para"></p>
                                                        <i class="uil uil-check"></i>
                                                    </div>
                                                    <p class="text_bar">Order Confirmed</p>
                                                </li>
                                                <li id="pro_li">
                                                    <i class="icon_bar uil uil-box"></i>
                                                    <div class="progress_bar three {{ $order->status ==  'packing' ? 'active' : '' }}">
                                                        <p class="para"></p>
                                                        <i class="uil uil-check"></i>
                                                    </div>
                                                    <p class="text_bar">Packing</p>
                                                </li>
                                                <li id="pro_li">
                                                    <i class="icon_bar uil uil-truck"></i>
                                                    <div class="progress_bar four {{ $order->status ==  'shipping' ? 'active' : '' }}">
                                                        <p class="para"></p>
                                                        <i class="uil uil-check"></i>
                                                    </div>
                                                    <p class="text_bar">Shipping In Process</p>
                                                </li>
                                                <li id="pro_li">
                                                    <i class="icon_bar uil uil-map-marker"></i>
                                                    <div class="progress_bar five {{ $order->status ==  'delivered' ? 'active' : '' }}">
                                                        <p class="para"></p>
                                                        <i class="uil uil-check"></i>
                                                    </div>
                                                    <p class="text_bar">Delivered Success</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @isset($response)
    <!-- Start Tracking Area -->
    <div style="background: #eee;">
        <div class="container-fluid" style="width: 70%">
            <div class="row" style="padding-top: 40px;">
                <div class="col-12 col-lg-12">
                    <div class="card" style="background-color: #fff; border-color: #eee;">
                    <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">Delivery status : @if($response[0]->status_ship == "True") Delivery Success @else Shipping @endif
                        <div class="card-action" style="float: right;">
                            <!-- Add some action -->
                            @if($order->status == "shipping")
                                @if($response[0]->status_ship == "True")
                                    <form action="{{ route('user.confirmdelivery') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <button type="submit" class="conbtn btn-con btn-block mb-2" title="Confirm you have recive the shipping">Confirm Delivery</button>
                                    </form>
                                @endif
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
                                                        <li class="event" data-date="{{$response[$i]->date}}  {{$response[$i]->time}}">
                                                            <h3>{{$response[$i]->status}}</h3>
                                                        </li>
                                                    @endif
                                                    @if($i > 0)
                                                        @if($oldstatus !=  $response[$i]->status)
                                                            <li class="event" data-date="{{$response[$i]->date}}  {{$response[$i]->time}}">
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
            </div>
        </div>
    </div>
    <!-- End Tracking Area -->
    @endisset

    <!-- Start Status Area -->
    <div style="background: #eee;">
        <div class="container-fluid" style="width: 70%">
            <div class="row" style="padding-top: 40px;">
                <div class="col-12 col-lg-12">
                    <div class="card" style="background-color: #fff; border-color: #eee;">
                    <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">ที่อยู่เรียกเก็บเงินและจัดส่งสินค้า
                        <div class="card-action" style="float: right;">
                            @empty($response)
                                <a href="{{route('user.orders')}}" class="orbtn btn-primal">All Orders</a>
                            @endempty
                            {{-- @if($order->status == 'ordered')
                                <a href="#" class="orbtn btn-cancel" wire:click="cancelOrder">Cancel Order</a>
                            @endif --}}
                        </div>
                        </div>
                        <div class="table-responsive">
                            @if (Session::has('order_message'))
                                <div align="center" style="color: #fff;" class="alert alert-success">{{ Session::get('order_message') }}</div>
                            @endif
                            @if(Session::has('error_message'))
                                <div align="center" style="color: #fff;" class="alert alert-danger">{{ Session::get('error_message') }}</div>
                            @endif
                            <table class="m-0 table table-flush table-bordered" style="color: #000; background-color: rgb(255, 255, 255);">
                                <tr>
                                    <th>Order ID</th>
                                    <td>{{$order->id}}</td>
                                    <th>Order Date</th>
                                    <td>{{$order->created_at}}</td>
                                    <th>Status</th>
                                    <td>{{$order->status}}</td>
                                    @if($order->status == "delivered")
                                        <th>Dalivery Date</th>
                                        <td style="color: #07d418;">{{$order->delivered_date}}</td>
                                    @elseif($order->status == "cancelled")
                                        <th>Cancellation Date</th>
                                        <td style="color: #f00;">{{$order->cancelled_date}}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status Area -->


    <!--Start Ordered Items Content-->
    <div class="shopping-cart section" style="background: #eee; padding: 20px 0px;">
        <div class="container-fluid" style="width: 70%">
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card" style="background-color: #333; border-color: #eee;">
                 <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">รายการสินค้าที่สั่งซื้อ
                    <div class="card-action" style="float: right;">
                        {{-- add action --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table shopping-summery table-flush" style="color: #000; background-color: #fff;">{{-- table-borderless --}}
                        <thead>
                        <tr class="main-hading">
                            <th class="text-center">PID</th>
                            <th class="text-center">IMAGE</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            @if($order->status == 'delivered' && $order->rstatus == false)
                                <th class="text-center">REVIEW</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td data-title="Product ID" class="text-center">{{$item->product->id}}</td>
                                    <td data-title="Image" class="text-center"><img src="{{ asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}"></td>
                                    <td data-title="Name"><a href="{{route('product.details',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a></td>
                                    <td data-title="UNIT PRICE" class="text-center">฿{{number_format(($item->price), 2);}}</td>
                                    <td data-title="QUANTITY" class="text-center"><p>{{$item->qty}}</p></td>
                                    <td data-title="TOTAL PRICE" class="text-center">฿{{number_format(($item->price * $item->qty), 2);}}</td>
                                    @if($order->status == 'delivered' && $item->rstatus == false)
                                        <td data-title="REVIEW" class="text-center relink"><a href="{{route('user.review',['order_item_id'=>$item->id])}}">Write Review</a></td>
                                    @elseif($order->status == 'delivered' && $item->rstatus == true)
                                        <td data-title="REVIEW" class="text-center">Already Reviewed</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <div class="detail-sum">
                            <ul>
                                <li>ยอดรวมทั้งหมด (บาท)<span>{{number_format(($order->subtotal), 2);}} ฿</span></li>
                                <li>ภาษีมูลค่าเพิ่ม ({{config('cart.tax')}}%)<span> {{number_format(($order->tax), 2);}} ฿</span></li>
                                <li>ค่าจัดส่ง<span>จัดส่งฟรี</span></li>
                                <li class="last" style="color: #f00;">ราคาสุทธิที่ต้องชำระ<span style="color: #f00">{{number_format(($order->total), 2);}} ฿</span></li>
                            </ul>
                        </div>
                    </div>
                 </div>
               </div>
             </div>
            </div>
            <!--End Row-->
        </div>
    </div>

    <div style="background: #eee;">
        <div class="container-fluid" style="width: 70%">
            <!--Start Billing Details Content-->
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-12 col-lg-12">
                  <div class="card" style="background-color: #fff; border-color: #eee;">
                    <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">ที่อยู่เรียกเก็บเงินและจัดส่งสินค้า
                     <div class="card-action">
                        <div class="dropdown">
                            {{-- add action --}}
                         </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="m-0 table table-flush table-bordered" style="color: #000; background-color: #fff;">
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
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-12 col-lg-12">
                        <div class="card" style="background-color: #fff; border-color: #eee;">
                        <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">ที่อยู่สำหรับจัดส่งสินค้า
                            <div class="card-action">
                            <div class="dropdown">
                                {{-- add action --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="m-0 table table-flush table-bordered" style="color: #000; background-color: #fff;">
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
                <div class="row" style="padding-bottom: 60px;">
                    <div class="col-12 col-lg-12">
                        <div class="card" style="background-color: #fff; border-color: #eee;">
                        <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">รายละเอียดการชำระเงิน
                            <div class="card-action">
                            <div class="dropdown">
                                {{-- add action --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="m-0 table table-flush table-bordered" style="color: #000; background-color: #fff;">
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
        </div>
         <!-- End container-fluid-->
    </div>
</div>

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4 style="font-size: 18px;">จัดส่งฟรี</h4>
                    <p style="font-size: 16px;">จัดส่งฟรีไม่มีขั้นต่ำ!</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4 style="font-size: 18px;">ชำระเงินปลอดภัย</h4>
                    <p style="font-size: 16px;">ชำระเงินปลอดภัย 100%</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4 style="font-size: 18px;">ราคาสินค้าดี</h4>
                    <p style="font-size: 16px;">รับรองราคาดีกว่าพรี่รับมาแพง</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->

<!-- Start Footer Area -->
<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row" style="padding-top: 20px; padding-bottom: 40px;">
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo">
                            <a href="/"><img src="{{ asset('assets/images/logo2.png') }}" alt="#"></a>
                        </div>
                        <p class="text">เว็บไซต์ของเราให้บริการขายเครื่องคอมพิวเตอร์และอุปกรณ์ไอที ซึ่งเราอยากมอบประสบการณ์การซื้อสินค้าผ่านระบบออนไลน์ที่ดีเยี่ยมและใช้งานง่ายให้แก่ผู้ใช้งาน</p>
                        <p class="call">มีคำถาม? โทรหาเราได้ตลอด 24 ชั่วโมง<span><a href="tel:0810576379">(081)-057-6379</a></span></p>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>ข้อมูลเพิ่มเติม</h4>
                        <ul>
                            <li><a href="/about-us">เกี่ยวกับเรา</a></li>
                            <li><a href="#">คำถามที่พบบ่อย (FAQ)</a></li>
                            <li><a href="#">ข้อตกลงและเงื่อนไข</a></li>
                            <li><a href="/contact-us">ติดต่อเรา</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>ระบบบริการลูกค้า</h4>
                        <ul>
                            <li><a href="#">วิธีการชำระเงิน</a></li>
                            <li><a href="#">การขนส่งสินค้า</a></li>
                            <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>ติดต่อสอบถาม</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>เลขที่ 16 ถนนลาดพร้าว แขวงวังทองหลาง เขตวังทองหลาง</li>
                                <li>10310 กรุงเทพมหานคร.</li>
                                <li>vitzardcomputer@gmail.com</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <ul>
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p style="font-size: 14px;">Copyright © 2022 VITZARD Computer Group All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="{{ asset('assets/images/payments.png') }}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- Color JS -->
<script src="{{ asset('assets/js/colors.js') }}"></script>
<!-- Slicknav JS -->
<script src="{{ asset('assets/js/slicknav.min.js') }}"></script>
<!-- Owl Carousel JS -->
{{-- <script src="{{ asset('assets/js/owl-carousel.js') }}"></script> --}}
<!-- Owl Carousel Min JS -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup JS -->
<script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
<!-- Fancybox JS -->
<script src="{{ asset('assets/js/facnybox.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<!-- Countdown JS -->
<script src="{{ asset('assets/js/finalcountdown.min.js') }}"></script>
<!-- Nice Select JS -->
<script src="{{ asset('assets/js/nicesellect.js') }}"></script>
<!-- Ytplayer JS -->
{{-- <script src="{{ asset('assets/js/ytplayer.min.js') }}"></script> --}}
<!-- Flex Slider JS -->
<script src="{{ asset('assets/js/flex-slider.js') }}"></script>
<!-- ScrollUp JS -->
<script src="{{ asset('assets/js/scrollup.js') }}"></script>
<!-- Onepage Nav JS -->
<script src="{{ asset('assets/js/onepage-nav.min.js') }}"></script>
<!-- Easing JS -->
<script src="{{ asset('assets/js/easing.js') }}"></script>
<!-- Active JS -->
<script src="{{ asset('assets/js/active.js') }}"></script>
<!-- Functions JS -->
<script src="{{ asset('assets/js/functions.js') }}"></script>
<!-- Nouislider JS -->
<script src="{{ asset('assets/js/nouislider.js') }}"></script>
<!-- Process JS -->
<script src="{{ asset('assets/js/process.js') }}"></script>
<!-- Tiny Html -->
<script src="https://cdn.tiny.cloud/1/1yzizjof5v9lndey4qvwmnnxmlijxv1y0e8rcsxouphbvehn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    var owl = $('.main-slider');
    owl.owlCarousel({
        items:1,
        nav:true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        loop:true,
        autoplay:true,
        autoplayTimeout:8000,
        autoplayHoverPause:true
    });
</script>

<script>
    function togglePass() {
        var x = document.getElementById("password-field");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script>
    var coll = document.getElementsByClassName("collapsiblesub");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        }
    });
    }
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')

@livewireScripts

</body>
</html>
