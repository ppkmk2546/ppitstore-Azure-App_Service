<div>
    @section('title') {{'| Products'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">

          <!--Start Dashboard Content-->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">All Products
                    <div class="card-action">
                        <div class="row">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="Search Product..." wire:model="searchTerm" />
                                </div>
                                <div class="col-md-4" style="padding: 0px 0px 0px 0px !important;">
                                    <a class="btn btn-success" href="{{route('admin.addproducts')}}">Add New</a>
                                </div>
                        </div>
                    </div>
                 </div>
                   <div class="table-responsive">
                       @if (Session::has('message'))
                         <div align="center" class="alert alert-success">{{ Session::get('message') }}</div>
                       @endif
                        <table class="table align-items-center table-flush table-borderless">
                          <thead>
                           <tr>
                             <th>ID</th>
                             <th>Category</th>
                             <th>Image</th>
                             <th>Product Name</th>
                             <th>Quantity</th>
                             <th>Status</th>
                             <th>Price</th>
                             <th>Sale Price</th>
                             {{-- <th>Created at</th> --}}
                             <th>Last Updated</th>
                             <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                               @if(count($products) > 0)
                                    @foreach ($products as $product)
                                        <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td><img src="{{asset('assets/images/products')}}/{{$product->image}}" width="60"></td>
                                        <td>{{$product->name}}</td>
                                        <td align="center">{{$product->quantity}}</td>
                                        @if($product->quantity > 0)
                                            <td>In Stock</td>
                                        @elseif($product->quantity <= 0)
                                            <td>Out of Stock</td>
                                        @endif
                                        <td>฿{{number_format(($product->regular_price), 2);}}</td>
                                        <td>฿{{number_format(($product->sale_price), 2);}}</td>
                                        {{-- <td>{{$product->created_at}}</td> --}}
                                        <td>{{$product->updated_at}}</td>
                                        <td>
                                            <a class="hovcolor" href="{{route('admin.editproduct',['product_slug'=>$product->slug])}}"><i class="zmdi zmdi-edit"></i> Edit</a><br>
                                            {{-- <a class="dancolor" href="#" wire:click.prevent="thorwdelete"><i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete</a> --}}
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td style="padding: 20px" colspan="10" class="text-center">
                                            <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ไม่มีสินค้าให้คุณจัดการ</p>
                                            <a href="{{route('admin.addproducts')}}" class="btn btn-success" style="font-size: 18px" title="เพิ่มสไลด์ใหม่"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสินค้า</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-xs-1" align="center" style="padding-bottom: 30px">
                            <!-- Pagination -->
                            @if(count($products))
                            <div>
                                {{$products->links('livewire-pagination-links')}}
                            </div>
                            @endif
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

        @if(count($products) > 0)
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
                        <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบสินค้าชิ้นนี้?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" style="font-size: 16px;" class="btn btn-danger" wire:click.prevent="deleteProduct({{$product->id}})">ลบ</button>
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
                        <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบสินค้าชิ้นนี้?</p>
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
