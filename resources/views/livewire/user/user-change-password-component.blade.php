<div>
    @section('title') {{'Change Password'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs cart-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li><a href="#" class="active">Change Password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 15px;">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        @if(Session::has('password_success'))
                            <div class="alert alert-success" align="center" role="alert">
                                {{Session::get('password_success')}}
                            </div>
                        @endif
                        @if(Session::has('password_error'))
                            <div class="alert alert-success" align="center" role="alert">
                                {{Session::get('password_error')}}
                            </div>
                        @endif
                        <div align="center" style="padding-top: 25px">
                            <form wire:submit.prevent="changePassword">
                                <div class="form-group">
                                    <label  class="col-md-2">Current Password</label>
                                    <input type="password" class="col-md-6" placeholder="Current Password"  name="current_password" wire:model="current_password" />
                                    @error('current_password') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">New Password</label>
                                    <input type="password" class="col-md-6" placeholder="New Password" class="form-control" name="password" wire:model="password" />
                                    @error('password') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Confirm Password</label>
                                    <input type="password" class="col-md-6" placeholder="Confirm Password" class="form-control" name="password_confirmation" wire:model="password_confirmation" />
                                    @error('password_confirmation') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <button type="submit" class="btn btn-sm">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
