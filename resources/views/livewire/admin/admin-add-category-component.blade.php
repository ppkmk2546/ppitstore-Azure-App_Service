<div>
@section('title') {{'| Add New Category'}}@endsection
<div class="content-wrapper">
    <div class="container-fluid">
    <div class="container">
    <div class="row mt-3">
        <div class="col-12 col-lg-12">
           <div class="card">
             <div class="card-body">
             <div class="card-title" style="font-size: 20px">
                 Add New Category
                 <div class="float-right">
                    <a href="{{route('admin.categories')}}" class="btn btn-success">All Categories</a>
                </div>
            </div>
             <hr>
            <div class="panel-body col-xs-1" align="center">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('message')}}
                    </div>
                @endif
                <form class="form-horiozontal" wire:submit.prevent="storeCategory">
                    <div class="form-group">
                        <label for="input-1">Category Name</label>
                        <input type="text" class="form-control input-md col-md-5" id="input-1" placeholder="New Category Name" wire:model="name" wire:keyup="generateSlug">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-2">Category Slug</label>
                        <input type="text" class="form-control input-md col-md-5" id="input-2" placeholder="New Category Slug" wire:model="slug">
                        @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-3">Main Category</label>
                        <select id="input-3" class="form-control input-md col-md-5" wire:model="category_id">
                            <option value="">None</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
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
    var element = document.getElementById("act_cats");
    element.classList.add("active");
</script>
@endpush
