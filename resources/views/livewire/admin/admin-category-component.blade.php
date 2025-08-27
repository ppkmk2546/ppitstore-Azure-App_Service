<div>
@section('title') {{'| Categories'}}@endsection
<div class="content-wrapper">
    <div class="container-fluid">
      <!--Start Dashboard Content-->
        <!-- Model Content -->
        <div class="row">
         <div class="col-12 col-lg-12">
           <div class="card">
             <div class="card-header" style="font-size: 20px">All Categories
              <div class="card-action">
                 <div class="dropdown">
                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                  <i class="icon-options"></i>
                 </a>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{route('admin.addcategory')}}">Add New Category</a>
                   </div>
                  </div>
                 </div>
             </div>
             <style>
                 .sclist{
                    list-style: none;
                 }
             </style>
               <div class="table-responsive">
                   @if (Session::has('message'))
                     <div align="center" style="height: 100%;" class="alert alert-success">{{ Session::get('message') }}</div>
                   @endif
                    <table class="table align-items-center table-flush table-borderless">
                      <thead>
                       <tr>
                         <th>ID</th>
                         <th>Category Name</th>
                         <th>Slug</th>
                         <th>Sub Category</th>
                         <th>Created at</th>
                         <th>Updated at</th>
                         <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>
                           @if(count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        <ul class="sclist">
                                            @foreach($category->subcategories as $scategory)
                                                <li><i class="fa fa-caret-right"></i> {{$scategory->name}}
                                                    <a title="Edit Subcategory" class="hovcolor" href="{{route('admin.editcategory',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}"><i class="fa fa-edit"></i></a>
                                                    <a title="Delete Subcategory" class="delsubcolor" href="#" wire:click.prevent="thorwsubdelete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    <td>
                                        <a class="hovcolor" href="{{route('admin.editcategory',['category_slug'=>$category->slug])}}"><i class="zmdi zmdi-edit"></i> Edit</a><br>
                                        <a class="dancolor" href="#" wire:click.prevent="thorwdelete"><i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete</a>
                                    </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td style="padding: 20px" colspan="10" class="text-center">
                                        <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ไม่มีหมวดหมู่ให้คุณจัดการ</p>
                                        <a href="{{route('admin.addcategory')}}" class="btn btn-success" style="font-size: 18px" title="เพิ่มสไลด์ใหม่"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มหมวดหมู่</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="col-xs-1" align="center" style="padding-bottom: 30px">
                        <!-- Pagination -->
                        @if(count($categories))
                        <div>
                            {{$categories->links('livewire-pagination-links')}}
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
    <!-- Button trigger modal -->

    @if($categories->count() > 0)
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบหมวดหมู่นี้?</p>
                </div>
                <div class="modal-footer">
                <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" style="font-size: 16px;" class="btn btn-danger" wire:click.prevent="deleteCategory({{$category->id}})">ลบ</button>
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบหมวดหมู่นี้?</p>
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

    @if($categories->count() > 0)
        <!-- Modal -->
        <div class="modal fade" id="confirmsubdelete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true" wire:ignore.self>
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบหมวดหมู่ย่อยนี้?</p>
                </div>
                <div class="modal-footer">
                <button type="button" style="font-size: 16px;" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" style="font-size: 16px;" class="btn btn-danger" wire:click.prevent="deleteSubcategory({{$scategory->id}})">ลบ</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Modal -->
    @else
        <!-- Modal -->
        <div class="modal fade" id="confirmsubdelete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true" wire:ignore.self>
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
                    <p style="color: #fff; font-size: 22px; font-weight: 500; padding: 20px;" align="center">คุณแน่ใจหรือว่าต้องการลบหมวดหมู่ย่อยนี้?</p>
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
