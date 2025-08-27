<div>
@section('title') {{'Cart'}}@endsection
<!-- Breadcrumbs -->
<div class="breadcrumbs cart-color">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="{{route('product.cart')}}">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        @if(Cart::instance('cart')->count() > 0)
        <div class="row">
            <div class="col-12">
                @if(Session::has('success_message'))
                <div style="padding-bottom: 20px;">
                    <div class="alert alert-success" align="center" style="padding: 10px 0px 10px 0px;">
                        <strong>Success</strong> {{ Session::get('success_message') }}
                    </div>
                </div>
                @endif
                <!-- Shopping Summery -->
                <table class="table shopping-summery table-flush">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">REMOVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::instance('cart')->content() as $item)
                        <tr>
                            <td data-title="Product"><img src="{{ asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a></p>
                                {{-- <p class="product-des">{{$item->model->description}}</p> --}}
                            </td>
                            @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                <td class="price" data-title="Price"><span>฿{{number_format(($item->model->sale_price), 2);}}</span></td>
                            @else
                                <td class="price" data-title="Price"><span>฿{{number_format(($item->model->regular_price), 2);}}</span></td>
                            @endif
                            <td class="qty" data-title="Qty">
                            <!-- Input Order -->
                            @if($item->model->quantity > 0)
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[1]" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quant[1]" class="input-number" data-max="1" data-max="120" value="{{$item->qty}}" disabled>
                                    <div class="button plus">
                                        @if($item->model->quantity > $item->qty)
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]" wire:click.prevent="increaseQuantity('{{$item->rowId}}')">
                                                <i class="ti-plus"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            @else
                                @php $emptyCheck = 1; @endphp
                                <h6 align="center">Out of Stock</h6>
                            @endif
                            </td>
                            <td class="total-amount" data-title="Total"><span>฿{{number_format(($item->subtotal), 2);}}</span></td>
                            @if($item->model->quantity > 0)
                                <td class="action" data-title="Remove"><a href="#" wire:click.prevent="destory('{{$item->rowId}}')"><i class="ti-trash remove-icon"></i></a></td>
                            @else
                                <td class="action" data-title="Remove"><a href="#" wire:click.prevent="destoryUnorm('{{$item->rowId}}')"><i class="ti-trash remove-icon"></i></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        @else
            @php $emptyCheck = 1; @endphp
            <table class="table shopping-summery">
                <thead>
                    <tr class="main-hading">
                        <th>PRODUCT</th>
                        <th>NAME</th>
                        <th class="text-center">UNIT PRICE</th>
                        <th class="text-center">QUANTITY</th>
                        <th class="text-center">TOTAL</th>
                        <th class="text-center">REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" align="center">
                            <p class="d-flex justify-content-center" style="font-size: 20px; padding-bottom: 5px;">ไม่มีสินค้าอยู่ในตะกร้า</p>
                            <a href="/shop" class="btn" style="color: #fff; font-size: 20px;">เลือกซื้อสินค้า</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        @endif
    </div>

</div>
<div class="shopping-sumcart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            @if(!Session::has('coupon'))
                            <div class="left">
                                <div class="coupon">
                                    <div class="checkbox" wire:ignore>
										<label class="checkbox-inline" for="2"><input name="news" id="2" value="1" type="checkbox" wire:model="haveCouponCode"> ฉันมีคูปองส่วนลด</label>
									</div>
                                    @if($haveCouponCode == 1)
                                    <form wire:submit.prevent="applyCouponCode">
                                        @if(Session::has('coupon_message'))
                                        <div class="alert alert-danger" role="danger">
                                            {{ Session::get('coupon_message') }}
                                        </div>
                                        @endif
                                        <input name="Coupon" placeholder="ใส่รหัสคูปองของคุณ" wire:model="couponCode" />
                                        <button type="submit" class="btn">Apply</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li>ยอดรวมทั้งหมด (บาท)<span>{{number_format((Cart::instance('cart')->subtotal()), 2);}} ฿</span></li>
                                    @if(Session::has('coupon'))
                                        <li>ส่วนลด ({{Session::get('coupon')['code']}}) <a href="#" wire:click.prevent="removeCoupon" title="Remove Coupon"><i class="fa fa-times text-dander"></i></a> <span style="color: #f00;">-{{number_format(($discount), 2);}} ฿</span></li>
                                        <li>ยอดรวมทั้งหมดเมื่อลดราคา<span>{{number_format(($subtotalAfterDiscount), 2);}} ฿</span></li>
                                        <li>ภาษีมูลค่าเพิ่ม ({{config('cart.tax')}}%)<span>{{number_format(($taxAfterDiscount), 2);}} ฿</span></li>
                                        <li>ค่าจัดส่ง<span>จัดส่งฟรี</span></li>
                                        <li class="last" style="color: #f00">ราคาสุทธิที่ต้องชำระ (บาท)<span style="color: #f00">{{number_format(($totalAfterDiscount), 2);}} ฿</span></li>
                                    @else
                                    <li>ภาษีมูลค่าเพิ่ม ({{config('cart.tax')}}%)<span> {{number_format((Cart::instance('cart')->tax()), 2);}} ฿</span></li>
                                    <li>ค่าจัดส่ง<span>จัดส่งฟรี</span></li>
                                    <li class="last" style="color: #f00; font-size: 16px;">ราคาสุทธิที่ต้องชำระ<span style="color: #f00">{{number_format((Cart::instance('cart')->total()), 2);}} ฿</span></li>
                                    @endif
                                </ul>
                                <div class="button5">
                                    @if($emptyCheck == 1)
                                        @isset($item)
                                            <a class="btn chkout">กรุณาลบสินค้าที่หมดออก</a>
                                        @endisset
                                    @endif
                                    <a href="#" wire:click.prevent="checkout" class="btn chkout" <?php if($emptyCheck == 1){?> style="display:none;" <?php } ?>>ตรวจสอบที่อยู่และชำระเงิน</a>
                                    <a href="/" class="btn chkout">เลือกซื้อสินค้าต่อ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->
</div>
