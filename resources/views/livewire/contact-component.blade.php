<div>
    @section('title') {{'Contact Us'}}@endsection
    <!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
    <!-- Start Contact -->
	<section id="contact-us" class="contact-us section" style="padding: 50px 0px 50px 0px">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									<h4>ติดต่อเรา</h4>
									<h3>เขียนข้อความถึงเรา</h3>
                                    @if(Session::has('message'))
                                        <div class="alert alert-success" align="center" role="alert">
                                            {{Session::get('message')}}
                                        </div>
                                    @endif
								</div>
								<form class="form" wire:submit.prevent="sendMessage">
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>ชื่อของคุณ<span>*</span></label>
												<input name="name" type="text" wire:model="name">
                                                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>อีเมลของคุณ<span>*</span></label>
												<input name="email" type="email" wire:model="email">
                                                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>เบอร์โทรศัพท์ที่ใช้ติดต่อกลับ<span>*</span></label>
												<input name="company_name" type="text" wire:model="phone">
                                                @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
											</div>
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>ข้อความของคุณ<span>*</span></label>
												<textarea name="message"  wire:model="message"></textarea>
                                                @error('message') <p class="text-danger">{{ $message }}</p> @enderror
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn ">ส่งข้อความ</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">โทรหาเราตอนนี้:</h4>
									<ul>
                                        <li>081-057-6379</li>
										<li>099-347-6106</li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">Email:</h4>
									<ul>
										<li><a href="mailto:vitzardcomputer@gmail.com">vitzardcomputer@gmail.com</a></li>
										<li><a href="mailto:choke.tri@rmutto.ac.th">choke.tri@rmutto.ac.th</a></li>
                                        <li><a href="mailto:niti.tiv@rmutto.ac.th">niti.tiv@rmutto.ac.th</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">ที่อยู่ของเรา:</h4>
									<ul>
										<li>เลขที่ 16 ถนนลาดพร้าว แขวงวังทองหลาง เขตวังทองหลาง 10310 กรุงเทพมหานคร</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->
</div>
