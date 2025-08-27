<div>
    @section('title') {{'Orders'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs cart-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section" style="background: #fff;">
        <div class="container-fluid" style="width: 80%;">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header" style="font-size: 20px; font-weight: 500; color: #fff; background-color: #333;">All Orders
                            <div class="card-action">
                                <div class="shop-top shop">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Filter By :</label>
                                                <div style="display: inline-flex;">
                                                    <div class="nice-select current form-control form-control-sm" tabindex="0">
                                                        <span class="current">{{$filtering}}</span>
                                                        <ul class="list">
                                                            <li wire:click="filtering('Show All')" data-value="default" class="option">Show All</li>
                                                            <li wire:click="filtering('Ordered')" data-value="ordered" class="option">Ordered</li>
                                                            <li wire:click="filtering('Confirmed')" data-value="order_confirmed" class="option">Confirmed</li>
                                                            <li wire:click="filtering('Packing')" data-value="packing" class="option">Packing</li>
                                                            <li wire:click="filtering('Shipping')" data-value="shipping" class="option">Shipping</li>
                                                            <li wire:click="filtering('Delivered')" data-value="delivered" class="option">Delivered</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Shopping Summery -->
                    <div class="table-responsive">
                        @if (Session::has('order_message'))
                            <div align="center" style="color: #fff;" class="alert alert-success">{{ Session::get('order_message') }}</div>
                        @endif
                        <table class="m-0 align-items-center table shopping-summery table-flush">
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
                                                    <div><button type="submit" style="color: #fff;" class="btn btn-info btn-sm">Details</button><br></div>
                                                    {{-- <a type="submit" style="color: #fff;" href="{{route('user.order.details',['order_id'=>$order->id])}}" class="btn btn-info btn-sm">Details</a><br> --}}
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
                        <!-- Pagination -->
                        <div align="center" style="padding-left: 26%">
                            {{$orders->links('livewire-pagination-links')}}
                        </div>
                        <!--/ End Pagination -->
                    </div>
                    <!--/ End Shopping Summery -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
</div>
