<div>
@section('title') {{'Checkout'}}@endsection
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                        <li><a href="{{route('product.cart')}}">Cart<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<style>
    input {
    width: 100%;
    height: 45px;
    line-height: 50px;
    padding: 0 20px;
    border-radius: 3px;
    border-radius: 3px;
    color: #333 !important;
    border: #b3b3b3 1px solid;
    background: #F6F7FB;
}
</style>

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2 style="padding-bottom: 10px;">ที่อยู่เรียกเก็บเงินและจัดส่งสินค้า</h2>
                    {{-- <p>กรุณากรอกข้อมูลในช่องที่มี <a style="color: #f00">*</a> ให้ครบถ้วน</p> --}}
                    <!-- Form -->
                <form class="form" wire:submit.prevent="placeOrder" onsubmit="$('#processing').show();">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>ชื่อจริง<span>*</span></label>
                                <input type="text" name="fname" placeholder="ชื่อจริงของคุณ" required="required" wire:model="firstname">
                                @error('firstname')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>นามสกุล<span>*</span></label>
                                <input type="text" name="lastname" placeholder="นามสกุลของคุณ" required="required" wire:model="lastname">
                                @error('lastname')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>ที่อยู่ Email<span>*</span></label>
                                <input type="email" name="email" placeholder="Email ของคุณ" required="required" wire:model="email">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>หมายเลขโทรศัพท์<span>*</span></label>
                                <input type="number" name="number" placeholder="หมายเลขโทรศัพท์ของคุณ" required="required" wire:model="mobile">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>รายละเอียดที่อยู่บรรทัดที่ 1<span>*</span></label>
                                <input type="text" name="address" placeholder="รายละเอียดที่อยู่เช่น เลขที่บ้าน, ตรอกหรือซอย, อี่นๆ" required="required" wire:model="line1">
                                @error('line1')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>รายละเอียดที่อยู่บรรทัดที่ 2</label>
                                <input type="text" name="address" placeholder="รายละเอียดเพิ่มเติมเช่น สีบ้าน, ระยะทางจากปากซอย, อี่นๆ" wire:model="line2">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>ประเทศ<span>*</span></label>
                                <input type="text" name="country" placeholder="ประเทศไทย" required="required" wire:model="country">
                                @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>เมืองหรือจังหวัด<span>*</span></label>
                                <input type="text" name="city" placeholder="เช่น กรุงเทพมหานคร" required="required" wire:model="city">
                                @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>เขตหรืออำเภอ<span>*</span></label>
                                <input type="text" name="province" placeholder="เช่น เขตวังทองหลาง" required="required" wire:model="province">
                                @error('province')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>แขวงหรือตำบล<span>*</span></label>
                                <input type="text" name="district" placeholder="เช่น แขวงวังทองหลาง" required="required" wire:model="district">
                                @error('district')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์<span>*</span></label>
                                <input type="text" name="post" placeholder="เช่น 10310" required="required" wire:model="zipcode">
                                @error('zipcode')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group create-account">
                                <label style="cursor: pointer;">
                                    <input id="cbox" type="checkbox" value="1" wire:model="ship_to_different_address">
                                    ต้องการใช้ที่อยู่จัดส่งอื่น?
                                </label>
                            </div>
                        </div>
                    </div>

                    <!--/ End Form -->
                    @if($ship_to_different_address)
                        <h2 style="padding-bottom: 10px; padding-top: 10px;">ที่อยู่สำหรับจัดส่งสินค้า</h2>
                        <p>กรุณากรอกข้อมูลในช่องที่มี <a style="color: #f00">*</a> ให้ครบถ้วน</p>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>ชื่อจริง<span>*</span></label>
                                    <input type="text" name="ship_firstname" placeholder="ชื่อจริงของคุณ" required="required" wire:model="ship_firstname">
                                    @error('ship_firstname')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>นามสกุล<span>*</span></label>
                                    <input type="text" name="ship_lastname" placeholder="นามสกุลของคุณ" required="required" wire:model="ship_lastname">
                                    @error('ship_lastname')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>ที่อยู่ Email<span>*</span></label>
                                    <input type="email" name="ship_email" placeholder="Email ของคุณ" required="required" wire:model="ship_email">
                                    @error('ship_email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>หมายเลขโทรศัพท์<span>*</span></label>
                                    <input type="number" name="number" placeholder="หมายเลขโทรศัพท์ของคุณ" required="required" wire:model="ship_mobile">
                                    @error('ship_mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>รายละเอียดที่อยู่บรรทัดที่ 1<span>*</span></label>
                                    <input type="text" name="ship_line1" placeholder="รายละเอียดที่อยู่เช่น เลขที่บ้าน, ตรอกหรือซอย, อี่นๆ" required="required" wire:model="ship_line1">
                                    @error('ship_line1')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>รายละเอียดที่อยู่บรรทัดที่ 2</label>
                                    <input type="text" name="ship_line2" placeholder="รายละเอียดเพิ่มเติมเช่น สีบ้าน, ระยะทางจากปากซอย, อี่นๆ" wire:model="ship_line2">
                                    @error('ship_line2')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>ประเทศ<span>*</span></label>
                                    <input type="text" name="ship_country" placeholder="ประเทศไทย" required="required" wire:model="ship_country">
                                    @error('ship_country')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>เมืองหรือจังหวัด<span>*</span></label>
                                    <input type="text" name="ship_city" placeholder="เช่น กรุงเทพมหานคร" required="required" wire:model="ship_city">
                                    @error('ship_city')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>เขตหรืออำเภอ<span>*</span></label>
                                    <input type="text" name="ship_province" placeholder="เช่น เขตวังทองหลาง" required="required" wire:model="ship_province">
                                    @error('ship_province')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>แขวงหรือตำบล<span>*</span></label>
                                    <input type="text" name="ship_district" placeholder="เช่น แขวงวังทองหลาง" required="required" wire:model="ship_district">
                                    @error('ship_district')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>รหัสไปรษณีย์<span>*</span></label>
                                    <input type="text" name="ship_zipcode" placeholder="เช่น 10310" required="required" wire:model="ship_zipcode">
                                    @error('ship_zipcode')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                    </div>

                    <div class="col-lg-4 col-12">
                    <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2 style="font-size: 18px;">ยอดรวมทั้งหมด</h2>
                        <div class="content">
                            <ul>
                                <li>ยอดรวมทั้งหมด (บาท)<span>฿{{number_format((Session::get('checkout')['subtotal']), 2);}}</span></li>
                                <li>ภาษีมูลค่าเพิ่ม (7%)<span>฿{{number_format((Session::get('checkout')['tax']), 2);}}</span></li>
                                <li>ค่าจัดส่ง<span>จัดส่งฟรี</span></li>
                                <li class="last">ราคาสุทธิที่ต้องชำระ (บาท)<span style="color: #f00;">฿{{number_format((Session::get('checkout')['total']), 2);}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>ช่องทางการชำระเงิน</h2>
                        <div class="content" style="padding: 10px 30px;">
                            <div class="choose-payment-methods">
                                <label class="payment-method" style="cursor: pointer;">
                                    <input name="payment-method" id="payment-method-cod" value="cod" type="radio" wire:model="payment_method">
                                    <span>ชำระเงินปลายทาง (COD)</span>
                                    <span class="payment-desc">ทำการชำระเงินเมื่อสินค้าส่งถึงท่าน (Cash On Delivery)</span>
                                </label>
                                <label class="payment-method" style="cursor: pointer;">
                                    <input name="payment-method" id="payment-method-card" value="card" type="radio" wire:model="payment_method">
                                    <span>บัตรเครดิตหรือเดบิต (Debit/Credit Card)</span>
                                    <span class="payment-desc">รองรับบัตรได้ดังนี้ MasterCard, Visa</span>
                                </label>
                                @error('payment_method')<span class="text-danger">{{ $message }}</span>@enderror

                                @if($payment_method == 'card')
                                    <p style="padding-top: 10px; padding-bottom: 10px; font-weight: 600;">กรุณากรอกข้อมูลบัตรให้ครบถ้วน</p>
                                @if(Session::has('stripe_error'))
                                    <div class="alert alert-danger" style="color:#fff" role="alert">{{Session::get('stripe_error')}}</div>\
                                @endif
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="card-no">หมายเลขบัตร (Card Number) :</label>
                                            <input type="text" name="card-no" placeholder="Card Number" required="required" wire:model="card_no">
                                            @error('card_no')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exp-month">เดือนที่หมดอายุ (Expiry Month) :</label>
                                            <input type="text" name="exp-month" placeholder="MM" required="required" wire:model="exp_month">
                                            @error('exp_month')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exp-year">ปีที่หมดอายุ (Expiry Year) :</label>
                                            <input type="text" name="exp-year" placeholder="YYYY" required="required" wire:model="exp_year">
                                            @error('exp_year')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="cvc">รหัสความปลอดภัย (CVC) :</label>
                                            <input id="cvc" type="password" name="cvc" placeholder="CVC" required="required" wire:model="cvc">
                                            @error('cvc')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Payment Method Widget -->
                    <div class="single-widget payement">
                        <div class="content">
                            <img src="{{ asset('assets/images/payment-method.png') }}" alt="#">
                        </div>
                    </div>
                    <!--/ End Payment Method Widget -->
                    <!-- Button Widget -->
                    @if($errors->isEmpty())
                    <div wire:ignore id="processing" style="font-size: 22px; margin-bottom: 20px; color: green; display:none" align="center">
                        <i class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>
                        <span>กำลังดำเนินการ...</span>
                    </div>
                    @endif
                    <div class="single-widget get-button">
                        <div class="content">
                            <div class="button">
                                <button class="btn" type="submit" style="font-size: 20px;">ดำเนินการชำระเงิน</button>
                            </div>
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Checkout -->
</div>
