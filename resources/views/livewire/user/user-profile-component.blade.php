<div>
    @section('title') {{'My Profile'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">My Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <style>
        .textp p{
            padding-bottom: 4px;
        }

    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="panel-heading" style="font-size: 22px;">
                Profile
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-4">
                    @if($user->profile->image)
                        <img src="{{asset('assets/images/profiles')}}/{{$user->profile->image}}" width="100%">
                    @else
                        <img src="{{asset('assets/images/profiles/default_profile.png')}}" width="100%">
                    @endif
                </div>
                <div class="col-md-8 textp">
                    <p><b>User Name : </b>{{$user->name}}</p>
                    <p><b>Full Name : </b>{{$user->profile->firstname}} {{$user->profile->lastname}}</p>
                    <p><b>Email : </b>{{$user->email}}</p>
                    <p><b>Phone : </b>{{$user->profile->mobile}}</p>
                    <hr>
                    <p><b>Address Line1 : </b>{{$user->profile->line1}}</p>
                    <p><b>Address Line2 : </b>{{$user->profile->line2}}</p>
                    <p><b>City : </b>{{$user->profile->city}}</p>
                    <p><b>Province : </b>{{$user->profile->province}}</p>
                    <p><b>District : </b>{{$user->profile->district}}</p>
                    <p><b>Country : </b>{{$user->profile->country}}</p>
                    <p><b>Zip Code : </b>{{$user->profile->zipcode}}</p>
                    <a href="{{route('user.editprofile')}}" class="btn pull-right" style="color: #fff; font-size: 20px;">แก้ไขข้อมูล</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
