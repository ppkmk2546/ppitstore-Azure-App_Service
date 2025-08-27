<div>
    @section('title') {{'| Pending Orders'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">
          <!--Start Dashboard Content-->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">คำสั่งซื้อที่รอการยืนยันคำสั่งซื้อ
                  <div class="card-action">
                     <div class="dropdown">
                     {{-- <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                      <i class="icon-options"></i>
                     </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"> Test_drop</a>
                        </div> --}}
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
                             <th class="text-center">Order Date</th>
                             <th colspan="2"><div align="center" style="vertical-align: middle;">Action</div></th>
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
                                            @if($order->status == 'order_confirmed')
                                                <td><div align="center" style="vertical-align: middle;">Confirmed</div></td>
                                                <input style="display: none" name="track" type="text" class="form-control" id="input-2" value="{{$order->status}}" />
                                            @else
                                                <td><div align="center" style="vertical-align: middle;">{{$order->status}}</div></td>
                                            @endif
                                            <input style="display: none" name="track" type="text" class="form-control" id="input-2" value="{{$order->tracking_number}}" />
                                            <td class="text-center">{{$order->created_at}}</td>
                                            <td style="padding-left: 10px; padding-right: 10px;">
                                                <div class="dropdown" align="center" style="vertical-align: middle;">
                                                    <button type="submit" class="btn btn-info btn-sm" >Details</button>
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Status</button>
                                                    <div class="dropdown-menu">
                                                        @if($order->status == "ordered")
                                                            <a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'order_confirmed')">Confirm Order</a>
                                                            <a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'cancelled')">cancelled Order</a>
                                                        @elseif($order->status == "order_confirmed")
                                                        <a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'packing')">Packing Order</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                @else
                                    <tr>
                                        <td style="padding: 20px" colspan="10" class="text-center">
                                            <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ไม่มีคำสั่งซื้อให้ตรวจสอบ</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-xs-1 text-center" style="padding-bottom: 30px">
                            <!-- Pagination -->
                            <div>
                                {{$orders->links('livewire-pagination-links')}}
                            </div>
                            <!--/ End Pagination -->
                        </div>
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
