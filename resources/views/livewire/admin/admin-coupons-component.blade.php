<div>
    @section('title') {{'| All Coupons'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">
          <!--Start Dashboard Content-->
            <!-- Model Content -->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">
                    All Coupons
                  <div class="card-action">
                     <div class="dropdown">
                     <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                      <i class="icon-options"></i>
                     </a>
                      <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="{{route('admin.addcoupon')}}">Add New Coupons</a>
                       </div>
                      </div>
                     </div>
                 </div>
                   <div class="table-responsive">
                       @if (Session::has('message'))
                         <div align="center" style="height: 100%;" class="alert alert-success">{{ Session::get('message') }}</div>
                       @endif
                        <table class="table align-items-center table-flush table-borderless">
                          <thead>
                           <tr>
                             <th>ID</th>
                             <th>Coupon Code</th>
                             <th>Coupon Type</th>
                             <th>Coupon Value</th>
                             <th>Cart Value</th>
                             <th>Expiry Date</th>
                             <th>Created at</th>
                             <th>Updated at</th>
                             <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                               @if(count($coupons) > 0)
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                        <td>{{$coupon->id}}</td>
                                        <td>{{$coupon->code}}</td>
                                        <td>{{$coupon->type}}</td>
                                        @if($coupon->type == 'fixed')
                                            <td>฿{{number_format(($coupon->value), 2);}}</td>
                                        @else
                                            <td>{{number_format(($coupon->value));}} %</td>
                                        @endif
                                        <td>฿{{number_format(($coupon->cart_value), 2);}}</td>
                                        <td>{{$coupon->expiry_date}}</td>
                                        <td>{{$coupon->created_at}}</td>
                                        <td>{{$coupon->updated_at}}</td>
                                        <td>
                                            <a class="hovcolor" href="{{route('admin.editcoupon',['coupon_id'=>$coupon->id])}}"><i class="zmdi zmdi-edit"></i> Edit</a><br>
                                            <a class="dancolor" href="#" wire:click.prevent="thorwdelete"><i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete</a>
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td style="padding: 20px" colspan="10" class="text-center">
                                            <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ไม่มีคูปองให้คุณจัดการ</p>
                                            <a href="{{route('admin.addcoupon')}}" class="btn btn-success" style="font-size: 18px" title="เพิ่มสไลด์ใหม่"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มคูปอง</a>
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
        <!-- Button trigger modal -->

        @if($coupons->count() > 0)
            <!-- Modal -->
            <div class="modal fade" id="confirmdelete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i style="color: #ffa217; font-size: 22px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i><b style="color: #fff; font-size: 22px;"> คำเตือน!</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div align="center"><i style="color: #f00; font-size: 70px;" class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                        <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบคูปองนี้?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" style="font-size: 16px;" class="btn btn-danger" wire:click.prevent="deleteCoupon({{$coupon->id}})">ลบ</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Modal -->
        @else
            <!-- Modal -->
            <div class="modal fade" id="confirmdelete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i style="color: #ffa217; font-size: 22px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i><b style="color: #ffa217; font-size: 22px;"> คำเตือน!</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div align="center"><i style="color: #f00; font-size: 70px;" class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                        <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบคูปองนี้?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" style="font-size: 16px;" class="btn btn-danger">ลบ</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Modal -->
        @endif

    </div>
