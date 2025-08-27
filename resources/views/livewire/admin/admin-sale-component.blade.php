<div>
    @section('title') {{'| Sale Setting'}}@endsection
    <div class="content-wrapper" style="padding-bottom: 498px">
        <div class="container-fluid">
        <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title" style="font-size: 20px">
                            Sale Setting
                        </div>
                    <hr>
                        <div class="panel-body col-xs-1" align="center">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <form class="form-horiozontal" wire:submit.prevent="updateSale">
                                <div class="form-group">
                                    <label>Status</label>
                                        <select class="form-control input-md col-md-5" wire:model="status">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Sale Date</label>
                                    <input type="text" id="sale-date" placeholder="YYYY/MM/DD H:M:S" class="form-control input-md col-md-5" wire:model="sale_date">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
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
        $('#sale-date').datetimepicker({
            // Formats
            format: 'Y-MM-DD HH:mm:ss',

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
            var data = $('#sale-date').val();
            @this.set('sale_date',data);
        });
    }
});
</script>
@endpush
