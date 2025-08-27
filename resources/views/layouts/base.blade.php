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
    <title>@yield('title') | VITZARD Computer</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->
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
                                                    @if(Auth::user()->profile->image === null)
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
                                                    @if(!Auth::user()->profile)
                                                        <img src="{{ asset('assets/images/profiles/default_profile.png') }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle" width="30">
                                                    @elseif(Auth::user()->profile->image === null)
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

    {{$slot}}

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

    <script src="{{ asset('assets/js/alert.js') }}"></script>

    @stack('scripts')

    @livewireScripts

</body>
</html>
