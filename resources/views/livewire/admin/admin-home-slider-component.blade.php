<div>
    @section('title') {{'| Home Sliders'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">

          <!--Start Dashboard Content-->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">All Sliders
                  <div class="card-action">
                     <div class="dropdown">
                     <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                      <i class="icon-options"></i>
                     </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.addhomeslider')}}">Add New Slider</a>
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
                             <th>Image</th>
                             <th>Title</th>
                             <th>Subtitle</th>
                             <th>Price</th>
                             <th>Link</th>
                             <th>Status</th>
                             <th>Created at</th>
                             <th>Updated at</th>
                             <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            @if(count($sliders) > 0)
                               @foreach ($sliders as $slider)
                                <tr>
                                <td>{{$slider->id}}</td>
                                <td><img src="{{asset('assets/images/sliders')}}/{{$slider->image}}" width="120"></td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->subtitle}}</td>
                                <td>฿{{number_format(($slider->price), 2);}}</td>
                                <td>{{$slider->link}}</td>
                                <td>{{$slider->status == 1 ? 'Active':'Inactive'}}</td>
                                <td>{{$slider->created_at}}</td>
                                <td>{{$slider->updated_at}}</td>
                                <td>
                                    <a class="hovcolor" href="{{route('admin.edithomeslider',['slide_id'=>$slider->id])}}"><i class="zmdi zmdi-edit"></i> Edit</a><br>
                                    <a class="dancolor" href="#" wire:click.prevent="thorwdelete"><i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete</a>
                                </td>
                                </tr>
                               @endforeach
                            @else
                                <tr>
                                    <td style="padding: 20px" colspan="10" class="text-center">
                                        <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">คุณยังไม่มีสไลด์ให้จัดการ</p>
                                        <a href="{{route('admin.addhomeslider')}}" class="btn btn-success" style="font-size: 18px" title="เพิ่มสไลด์ใหม่"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสไลด์</a>
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

    @if(count($sliders) > 0)
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบสไลด์นี้?</p>
                </div>
                <div class="modal-footer">
                <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" style="font-size: 16px;" class="btn btn-danger" wire:click.prevent="deleteSlide({{$slider->id}})">ลบ</button>
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบสไลด์นี้?</p>
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
