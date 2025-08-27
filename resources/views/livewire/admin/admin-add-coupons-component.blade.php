<div>
    @section('title') {{'| Add New Coupon'}}@endsection
    <div class="content-wrapper" style="padding-bottom: 242px">
        <div class="container-fluid">
        <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-body">
                 <div class="card-title" style="font-size: 20px">
                     Add New Coupon
                     <div class="float-right">
                        <a href="{{route('admin.coupons')}}" class="btn btn-success">All Coupons</a>
                    </div>
                </div>
                 <hr>
                <div class="panel-body col-xs-1" align="center">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form class="form-horiozontal" wire:submit.prevent="storeCoupon">
                        <div class="form-group">
                            <label for="input-1">Coupon Code</label>
                            <input type="text" class="form-control input-md col-md-5" id="input-1" placeholder="Coupon Code name you want to use" wire:model="code">
                            @error('code') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="input-2">Category Type</label>
                            <select class="form-control input-md col-md-5" wire:model="type">
                                <option value="">Select Category Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percentage</option>
                            </select>
                            @error('type') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="input-1">Coupon Value</label>
                            <input type="text" class="form-control input-md col-md-5" id="input-1" placeholder="Coupon Value" wire:model="value">
                            @error('value') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="input-1">Cart Value</label>
                            <input type="text" class="form-control input-md col-md-5" id="input-1" placeholder="Cart Value" wire:model="cart_value">
                            @error('cart_value') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="input-1">Expiry Date</label>
                            <input id="expire-date" type="text" class="form-control input-md col-md-5" placeholder="Expiry Date" wire:model="expiry_date">
                            @error('expiry_date') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success px-5">Save</button>
                        </div>
                    </form>
                </div>
               </div>
               </div>
            </div>
          </div>
          <!--End Row-->
        </div>
        </div>
    </div>
    </div>

    @push('scripts')
    <script>
        jQuery(document).ready(function($) {
        if (window.jQuery().datetimepicker) {
            $('#expire-date').datetimepicker({
                // Formats
                format: 'Y-MM-DD',

                // Your Icons
                // as Bootstrap 4 is not using Glyphicons anymore
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            })
            .on('dp.hide',function(ev){
                var data = $('#expire-date').val();
                @this.set('expiry_date',data);
            });
        }
    });
    </script>
    <script>
        var element = document.getElementById("act_cou");
        element.classList.add("active");
    </script>
    @endpush
