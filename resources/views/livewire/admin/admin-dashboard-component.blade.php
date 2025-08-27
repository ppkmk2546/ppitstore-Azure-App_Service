<div>
    @section('title')@endsection
    <div class="content-wrapper">
        <div class="container-fluid">

      <!--Start Dashboard Content-->
        <div class="card mt-3">
        <div class="card-content">
            <div class="row row-group m-0">
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$totalSales}} <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           {{-- <div class="progress-bar" style="width:{{$totalSales}}%"></div> --}}
                        </div>
                      <p class="mb-0 text-white small-font" style="font-size: 18px;">คำสั่งซื้อทั้งหมด <span class="float-right">{{$totalSales}} ออเดอร์</span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{number_format(($totalRevenue), 2)}} <span class="float-right">&#3647;</span></h5>
                        <div class="progress my-3" style="height:3px;">
                           {{-- <div class="progress-bar" style="width:{{number_format(($totalRevenue * 10 /100000))}}%"></div> --}}
                        </div>
                      <p class="mb-0 text-white small-font" style="font-size: 18px;">รายได้ทั้งหมด <span class="float-right">{{number_format(($totalRevenue), 2)}} บาท</span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$todaySales}} <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           {{-- <div class="progress-bar" style="width:{{$todaySales}}%"></div> --}}
                        </div>
                      <p class="mb-0 text-white small-font" style="font-size: 18px;">คำสั่งซื้อวันนี้ <span class="float-right">{{$todaySales}} ออเดอร์</span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{number_format(($todayRevenue), 2)}} <span class="float-right">&#3647;</span></h5>
                        <div class="progress my-3" style="height:3px;">
                           {{-- <div class="progress-bar" style="width:{{number_format(($todayRevenue * 10 /100000))}}%"></div> --}}
                        </div>
                      <p class="mb-0 text-white small-font" style="font-size: 18px;">รายได้วันนี้ <span class="float-right">{{number_format(($todayRevenue), 2)}} บาท</span></p>
                    </div>
                </div>
            </div>
        </div>
     </div>


        <div class="row">
         <div class="col-12 col-lg-12">
           <div class="card" style="padding-bottom: 30px">
             <div class="card-header" style="font-size: 20px">คำสั่งซื้อทั้งหมด
              <div class="card-action">
                 <div class="dropdown">
                    {{-- Add some Action --}}
                  </div>
                </div>
            </div>
            <div class="table-responsive">
                @if (Session::has('order_message'))
                  <div align="center" class="alert alert-success">{{ Session::get('order_message') }}</div>
                @endif
                 <table class="table align-items-center table-flush table-borderless">{{-- table-borderless --}}
                   <thead>
                    <tr>
                      <th>ID</th>
                      <th>Subtotal</th>
                      <th>Discount</th>
                      <th>Tax</th>
                      <th>Total</th>
                      <th>FullName</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th><div align="center" style="vertical-align: middle;">Status</div></th>
                      <th>Order Date</th>
                      <th><div align="center" style="vertical-align: middle;">Action</div></th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($orders) > 0)
                            @foreach ($orders as $order)
                            <form method="GET" action="{{route('admin.orderdetails',['order_id'=>$order->id])}}">
                            @csrf
                                 <tr>
                                    <td>{{$order->id}}<input style="display: none" name="id" type="text" class="form-control" id="input-2" value="{{$order->id}}" /></td>
                                    <td>฿{{number_format(($order->subtotal), 2)}}</td>
                                    <td>฿{{number_format(($order->discount), 2)}}</td>
                                    <td>฿{{number_format(($order->tax), 2)}}</td>
                                    <td>฿{{number_format(($order->total), 2)}}</td>
                                    <td>{{$order->firstname}} {{$order->lastname}}</td>
                                    <td>{{$order->mobile}}</td>
                                    <td>{{$order->email}}</td>
                                    <td><div align="center" style="vertical-align: middle;">{{$order->status}}</div></td>
                                    <input style="display: none" name="track" type="text" class="form-control" id="input-2" value="{{$order->tracking_number}}" />
                                    <td>{{$order->created_at}}</td>
                                    <td style="padding: 0rem;">
                                        <div align="center" style="vertical-align: middle;">
                                            {{-- <a class="btn btn-info btn-sm" href="{{route('admin.orderdetails',['order_id'=>$order->id])}}">Details</a><br> --}}
                                            <button type="submit" class="btn btn-info btn-sm">Details</button><br>
                                        </div>
                                    </td>
                                 </tr>
                            </form>
                            @endforeach
                         @else
                             <tr>
                                 <td style="padding: 20px" colspan="10" class="text-center">
                                     <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ไม่มีออเดอร์ให้แสดงผล</p>
                                 </td>
                             </tr>
                         @endif
                     </tbody>
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
