<div>
    @section('title') {{'| Add New Product'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">
        <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-body">
                 <div class="card-title" style="font-size: 20px">
                     Add New Product
                     <div class="float-right">
                        <a href="{{route('admin.products')}}" class="btn btn-success">All Products</a>
                    </div>
                </div>
                 <hr>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div align="center" class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form class="form-horiozontal" wire:submit.prevent="addProduct">
                        <div align="center">
                            <p style="font-size: 18px; margin-bottom: .65rem;">Preview Product Image</p>
                            @if($image)
                                <img src="{{$image->temporaryUrl()}}" alt="preview image" width="250px" style="padding-bottom: 15px" />
                            @else
                                <img src="https://via.placeholder.com/250x250" alt="placeholder image" width="250" style="padding-bottom: 15px" />
                            @endif
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input-1">Product Image</label>
                            <input style="cursor: pointer" type="file" class="form-control" wire:model="image" />
                            @error('image') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-2">Product Name</label>
                            <input type="text" class="form-control" id="input-2" placeholder="Product Name" wire:model="name" wire:keyup="generateSlug" />
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control" id="short_description" placeholder="Short Description" wire:model="short_description"></textarea>
                            @error('short_description') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <div wire:ignore>
                                <textarea class="form-control" id="description" placeholder="Description" wire:model="description"></textarea>
                                @error('description') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-6">Regular Price</label>
                            <input type="number" class="form-control" id="input-6" placeholder="Regular Price" wire:model="regular_price" />
                            @error('regular_price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-7">Sale Price</label>
                            <input type="number" class="form-control" id="input-7" placeholder="Sale Price" wire:model="sale_price" />
                            @error('sale_price') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-3">Product Slug</label>
                            <input type="text" class="form-control" id="input-3" placeholder="Product Slug" wire:model="slug" />
                            @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-8">SKU</label>
                            <input type="text" class="form-control" id="input-8" placeholder="SKU" wire:model="SKU" />
                            @error('SKU') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-11">Quantity</label>
                            <input type="number" class="form-control" id="input-10" placeholder="Quantity" wire:model="quantity" />
                            @error('quantity') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-10">Featured</label>
                            <select for="input-10" class="form-control" wire:model="featured">
                                <option value="0">No</option>
                                <option value="1">Yes</option></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-12">Category</label>
                            <select for="input-12" class="form-control" wire:model="category_id" wire:change="changeSubcategory">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-13">Subcategory</label>
                            <select for="input-13" class="form-control" wire:model="scategory_id">
                                <option value="0">Select Subcategory</option>
                                @foreach ($scategories as $scategory)
                                    <option value="{{$scategory->id}}">{{$scategory->name}}</option>
                                @endforeach
                            </select>
                            @error('scategory_id') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="input-1">Product Gallery (Choose Multiple Files At once)</label>
                            <input style="cursor: pointer" type="file" class="form-control" wire:model="images" multiple />
                            @error('images') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        </div>
                        <div align="center">
                            @if($images)
                                <p style="font-size: 18px; margin-bottom: .65rem;">Preview Gallery Image</p>
                                @foreach($images as $image)
                                    <img src="{{$image->temporaryUrl()}}" width="150px" style="padding-bottom: 15px" />
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>
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
        $(function(){
            tinymce.init({
                selector: '#description',
                plugins: 'autolink lists media table',
                setup:function(editor){
                    editor.on('change',function(e){
                        tinyMCE.triggerSave();
                        var d_data = $('#description').val();
                        @this.set('description',d_data);
                    });
                }
            });
        });
    </script>

    <script>
        var element = document.getElementById("act_pro");
        element.classList.add("active");
    </script>

@endpush
