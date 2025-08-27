<div>
    @section('title') {{'Edit Profile'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('user.profile')}}">My Profile<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Edit Profile</a></li>
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
                Edit Profile
            </div>
            <div class="panel-body">
                @if(Session::has('message'))
                    <div align="center" class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <form wire:submit.prevent="updateProfile" style="padding-top: 10px;">
                    <div class="row">
                    <div class="col-md-4">
                        @if($newimage)
                            <img src="{{$newimage->temporaryUrl()}}" width="100%" />
                        @elseif($image)
                            <img src="{{asset('assets/images/profiles')}}/{{$image}}" width="100%" />
                        @else
                            <img src="{{asset('assets/images/profiles/default_profile.png')}}" width="100%" />
                        @endif
                        <div style="padding-top: 10px;">
                            <input type="file" class="form-control" wire:model="newimage" />
                        </div>
                    </div>
                    <div class="col-md-8 textp">
                        <p><b>UserName : </b><input type="text" class="form-control" wire:model="name" /></p>
                        <p><b>Email : </b>{{$email}}</p>
                        <p><b>Firstname : </b><input type="text" class="form-control" wire:model="firstname" /></p>
                        <p><b>Lastname : </b><input type="text" class="form-control" wire:model="lastname" /></p>
                        <p><b>Phone : </b><input type="text" class="form-control" wire:model="mobile" /></p>
                        <hr>
                        <p><b>Address Line1 : </b><input type="text" class="form-control" wire:model="line1" /></p>
                        <p><b>Address Line2 : </b><input type="text" class="form-control" wire:model="line2" /></p>
                        <p><b>City : </b><input type="text" class="form-control" wire:model="city" /></p>
                        <p><b>Province : </b><input type="text" class="form-control" wire:model="province" /></p>
                        <p><b>District : </b><input type="text" class="form-control" wire:model="district" /></p>
                        <p><b>Country : </b><input type="text" class="form-control" wire:model="country" /></p>
                        <p><b>Zip Code : </b><input type="text" class="form-control" wire:model="zipcode" /></p>
                        <div style="padding-top: 10px;">
                            <a href="{{ route('user.profile')}}"><button type="button" class="btn pull-right" style="font-size: 16px;">ยกเลิก</button></a>
                            <button type="submit" class="btn pull-right" style="font-size: 16px;">บันทึก</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
