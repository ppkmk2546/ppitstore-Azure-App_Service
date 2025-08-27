<div>
    @section('title') {{'About Us'}}@endsection
    <!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row" style="padding-top: 80px; padding-bottom: 80px;">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							<h3>ยินดีต้อนรับเข้าสู่ <span>VITZARD Computer Group</span></h3>
							<p>เว็บแอพพลิเคชั่นนี้มีวัตถุประสงค์เพื่อจัดทำเป็นโครงงานของวิชาเตรียมฝึกสหกิจและประสบการณ์วิชาชีพ (Preparation for Cooperative Training and Professional Experience) วิชาปัญญาประดิษฐ์ (Artificial Intelligence) และวิชาวิศวกรรมซอฟต์แวร์ (Software Engineering)</p>
							<p>โดยตัวเว็บไซต์ถูกพัฒนาด้วยภาษา PHP และใช้งาน Laravel Framework ที่ศึกษาจากวิชาเตรียมฝึกสหกิจและประสบการณ์วิชาชีพ ถูกนำมาใช้งานเพื่อความปลอดภัย และความสะดวกในการพัฒนาเว็บแอพพลิเคชั่น ซึ่งตัวเว็บไซต์มีการออกแบบตามขั้นตอนที่ได้ศึกษาจากวิชาวิชาวิศวกรรมซอฟต์แวร์ และมีฟังก์ชั่นการค้นหาสินค้าด้วยเสียง (Voice Recognition) ที่ได้ศึกษามาจากวิชาปัญญาประดิษฐ์ </p>
							<div class="button">
								<a href="/" class="btn">หน้าหลัก</a>
								<a href="/contact-us" class="btn primary">ติดต่อเรา</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img overlay">
							<div class="button">
								<a href="https://www.youtube.com/watch?v=oZGdYa6HRwE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div>
							<img src="{{asset('assets/images/info/vid_thum.png')}}" alt="Promotion">
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->

	<!-- Start Team -->
	<section id="team" class="team section">
		<div class="container">
			<div class="row" style="padding-top: 80px;">
				<div class="col-12">
					<div class="section-title">
						<h2 style="font-size: 40px">สมาชิกกลุ่ม</h2>
						<p style="font-size: 20px">มหาวิทยาลัยเทคโนโลยีราชมงคลตะวันออก วิทยาเขตจักรพงษภูวนารถ คณะบริหารธุรกิจและเทคโนโลยีสารสนเทศ สาขาวิชาวิทยาการคอมพิวเตอร์ </p>
					</div>
				</div>
			</div>
            <div class="container">
			<div class="row" style="padding-bottom: 80px;" align="center">
                    <!-- Single Team -->
                    <div class="col" style="padding: 0;">
                        <div class="single-team" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <!-- Image -->
                            <div class="image">
                                <img src="{{asset('assets/images/info/0264404610018.jpg')}}" alt="นายโชค ไตรรัตนพิพัฒน์">
                            </div>
                            <!-- End Image -->
                            <div class="info-head">
                                <!-- Info Box -->
                                <div class="info-box">
                                    <h4 class="name"><a href="#">นายโชค ไตรรัตนพิพัฒน์</a></h4>
                                    <span class="designation">รหัสนักศึกษา 026440461001-8</span><br>
                                    <span class="designation">รับผิดชอบการพัฒนาเว็บแอพพลิเคชั่น<br>และนำ A.I. มาใช้งาน</span>
                                </div>
                                <!-- End Info Box -->
                                <!-- Social -->
                                <div class="social-links">
                                    <ul class="social">
                                        <li><a href="https://www.facebook.com/VaderBean/" target="blank"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <!-- End Social -->
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                    <div class="col" style="padding: 0;">
                        <div class="single-team" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <!-- Image -->
                            <div class="image">
                                <img src="{{asset('assets/images/info/0264404610059.jpg')}}" alt="นายนิธิ ทิวารี">
                            </div>
                            <!-- End Image -->
                            <div class="info-head">
                                <!-- Info Box -->
                                <div class="info-box">
                                    <h4 class="name"><a href="#">นายนิธิ ทิวารี</a></h4>
                                    <span class="designation">รหัสนักศึกษา 026440461005-9</span><br>
                                    <span class="designation">รับผิดชอบการเขียน Diagram<br>เทรน A.I. และรูปเล่มโครงการ</span>
                                </div>
                                <!-- End Info Box -->
                                <!-- Social -->
                                <div class="social-links">
                                    <ul class="social">
                                        <li><a href="https://www.facebook.com/profile.php?id=100004418299262" target="blank"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <!-- End Social -->
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
			</div>
		</div>
	</section>
	<!--/ End Team Area -->
</div>
