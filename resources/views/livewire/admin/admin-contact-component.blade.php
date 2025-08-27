<div>
    @section('title') {{'| Messages'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">

          <!--Start Dashboard Content-->
            <div class="row">
             <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-header" style="font-size: 20px">ข้อความจากผู้เยี่ยมชมและผู้ใช้งานเว็บไซต์
                    <div class="card-action">
                        {{-- Add some action --}}
                    </div>
                 </div>
                   <div class="table-responsive">
                       @if (Session::has('message'))
                         <div align="center" class="alert alert-success">{{ Session::get('message') }}</div>
                       @endif
                        <table class="table align-items-center table-flush table-borderless">
                          <thead>
                           <tr>
                             <th>#</th>
                             <th>ชื่อผู้ส่ง</th>
                             <th>อีเมล</th>
                             <th>เบอร์โทรศัพท์</th>
                             <th>ข้อความที่ส่งมา</th>
                             <th>ส่งมา ณ วันที่</th>
                           </tr>
                           </thead>
                           <tbody>
                            @if(count($contacts) > 0)
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($contacts as $contact)
                                <tr>
                                <td>{{$i++}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->message}}</td>
                                <td>{{$contact->created_at}}</td>
                                @endforeach
                            @else
                                <tr>
                                    <td style="padding: 20px" colspan="10" class="text-center">
                                        <p id="refreshtry" style="margin-bottom: .65rem; font-size: 18px;">ยังไม่มีข้อตวามใดส่งมาในขณะนี้</p>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="col-xs-1" align="center" style="padding-bottom: 30px">
                            <!-- Pagination -->
                            @if(count($contacts))
                            <div>
                                {{$contacts->links('livewire-pagination-links')}}
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
</div>
