<div>
    @section('title') {{'| Manage Home Categories'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">
        <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-body">
                 <div class="card-title" style="font-size: 20px">
                     Manage Home Categories
                </div>
                 <hr>
                <div class="panel-body col-xs-1" align="center">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form class="form-horiozontal" wire:submit.prevent="updateHomeCategory">
                        <div class="form-group">
                            <label for="input-1">Choose Categories</label><br>
                            <div wire:ignore>
                                <select name="categories[]" for="input-1" multiple="multiple" class="sel_categories form-control input-md col-md-5" wire:model="selected_categories">
                                    @foreach($categories as $category)
                                        <option style="background: none" value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-2">Number of Products to show at home</label>
                            <input type="text" class="form-control input-md col-md-5" id="input-2" placeholder="Number of Products to show at home" wire:model="numberofproducts">
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
        $(document).ready(function(){
            $('.sel_categories').select2({
                placeholder: 'Choose Categories',
                allowClear: true
            });
            $('.sel_categories').on('change', function (e) {
                var data = $('.sel_categories').select2("val");
                @this.set('selected_categories', data);
            });
        });
    </script>
@endpush
