<div>
    @section('title') {{'Summary'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Summary</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <div class="content">
        <style>
            .content {
            padding-top: 40px;
            padding-bottom: 40px;
            }
            .icon-stat {
                display: block;
                overflow: hidden;
                position: relative;
                padding: 15px;
                margin-bottom: 1em;
                background-color: #fff;
                border-radius: 4px;
                border: 1px solid #ddd;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.19);
            }
            .icon-stat-label {
                display: block;
                color: rgb(20, 20, 20);
                font-size: 13px;
            }
            .icon-stat-value {
                display: block;
                font-size: 28px;
                font-weight: 600;
            }
            .icon-stat-visual {
                position: relative;
                top: 22px;
                display: inline-block;
                width: 32px;
                height: 32px;
                border-radius: 4px;
                text-align: center;
                font-size: 16px;
                line-height: 30px;
            }
            .bg-primary {
                color: #fff;
                background: #186ab8 !important;
            }
            .bg-secondary {
                color: #fff;
                background: #0d5ace !important;
            }
            .bg-fourth {
                color: #fff;
                background: #0a8106 !important;
            }
            .bg-five {
                color: #fff;
                background: #e41f1f !important;
            }

            .icon-stat-footer {
                padding: 10px 0 0;
                margin-top: 10px;
                color: #aaa;
                font-size: 12px;
                border-top: 1px solid #eee;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                    <div class="col-xs-8 text-left" style="padding-left: 15px;">
                        <span class="icon-stat-label" style="font-size: 15px;">จำนวนเงินที่ใช้ไป</span>
                        <span class="icon-stat-value">฿ {{number_format(($totalCost), 2)}}</span>
                    </div>
                    <div class="col text-right">
                        <a class="icon-stat-visual bg-primary" style="color: #fff;">฿</a>
                    </div>
                    </div>
                    <div class="icon-stat-footer">
                    <i class="fa fa-clock-o"></i> อัพเดทล่าสุด
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                    <div class="col-xs-8 text-left" style="padding-left: 15px;">
                        <span class="icon-stat-label" style="font-size: 15px;">การสั่งซื้อทั้งหมด</span>
                        <span class="icon-stat-value">{{$totalPurchase}}</span>
                    </div>
                    <div class="col text-right">
                        <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                    </div>
                    </div>
                    <div class="icon-stat-footer">
                    <i class="fa fa-clock-o"></i> อัพเดทล่าสุด
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                    <div class="col-xs-8 text-left" style="padding-left: 15px;">
                        <span class="icon-stat-label" style="font-size: 15px;">รายการที่ส่งสำเร็จ</span>
                        <span class="icon-stat-value">{{$totalDelivered}}</span>
                    </div>
                    <div class="col text-right">
                        <i class="fa fa-check-circle icon-stat-visual bg-fourth"></i>
                    </div>
                    </div>
                    <div class="icon-stat-footer">
                    <i class="fa fa-clock-o"></i> อัพเดทล่าสุด
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                    <div class="col-xs-8 text-left" style="padding-left: 15px;">
                        <span class="icon-stat-label" style="font-size: 15px;">รายการที่ถูกยกเลิก</span>
                        <span class="icon-stat-value">{{$totalCancelled}}</span>
                    </div>
                    <div class="col text-right">
                        <i class="fa fa-times-circle icon-stat-visual bg-five"></i>
                    </div>
                    </div>
                    <div class="icon-stat-footer">
                    <i class="fa fa-clock-o"></i> อัพเดทล่าสุด
                    </div>
                </div>
                </div>
            </div>

            <!-- Shopping Cart -->
        <div class="section" style="background: #fff;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.19);">
                            <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">All Orders</div>
                        @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                        @endif
                        <!-- Shopping Summery -->
                        <div class="table-responsive">
                        <table class="m-0 table shopping-summery table-flush">
                            <thead>
                                <tr class="main-hading">
                                    <th>PID</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Fullname</th>
                                    <th>Moblie</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">More Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders) > 0)
                                            @foreach ($orders as $order)
                                            <form method="GET" action="{{route('user.order.details',['order_id'=>$order->id])}}">
                                            @csrf
                                                <tr>
                                                    <td data-title="PID">{{$order->id}}<input style="display: none" name="id" type="text" class="form-control" id="input-2" value="{{$order->id}}" /></td>
                                                    <td data-title="Subtotal">฿{{number_format(($order->subtotal), 2)}}</td>
                                                    <td data-title="Discount">฿{{number_format(($order->discount), 2)}}</td>
                                                    <td data-title="Tax">฿{{number_format(($order->tax), 2)}}</td>
                                                    <td data-title="Total Price">฿{{number_format(($order->total), 2)}}</td>
                                                    <td data-title="Firstname" class="text-center">{{$order->firstname}} {{$order->lastname}}</td>
                                                    <td data-title="Phone" class="text-center">{{$order->mobile}}</td>
                                                    <td data-title="Status" class="text-center">{{$order->status}}</td>
                                                    <input style="display: none" name="track" type="text" class="form-control" id="input-2" value="{{$order->tracking_number}}" />
                                                    <td data-title="Order Date" class="text-center">{{$order->created_at}}</td>
                                                    <td data-title="More Details" class="text-center">
                                                        {{-- <a style="color: #fff;" class="btn btn-info btn-sm" href="{{route('user.order.details',['order_id'=>$order->id])}}">Details</a><br> --}}
                                                        <button type="submit" style="color: #fff;" class="btn btn-info btn-sm">Details</button><br>
                                                    </td>
                                                </tr>
                                            </form>
                                            @endforeach
                                        @else
                                            <tr class="justify-content-center">
                                                <td style="padding: 20px; vertical-align: middle;" colspan="20" class="text-center" align="center">
                                                    <p id="refreshtry" style="margin-bottom: .65rem; font-size: 20px;">ไม่มีออเดอร์ให้แสดงผล</p>
                                                    <a href="/shop" class="btn" style="color: #fff; font-size: 20px;">เลือกซื้อสินค้า</a>
                                                </td>
                                            </tr>
                                        @endif
                                </tbody>
                        </table>
                        </div>
                        <!--/ End Shopping Summery -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Shopping Cart -->

        </div>
    </div>
</div>
