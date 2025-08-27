<div>
    @section('title') {{'| Edit Slide'}}@endsection
    <div class="content-wrapper">
        <div class="container-fluid">
        <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-lg-12">
               <div class="card">
                 <div class="card-body">
                 <div class="card-title" style="font-size: 20px">
                     Edit Slide
                     <div class="float-right">
                        <a href="{{route('admin.homeslider')}}" class="btn btn-success">All Slides</a>
                    </div>
                </div>
                 <hr>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div align="center" class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form class="form-horiozontal" wire:submit.prevent="updateSlide">
                        <div align="center">
                            <p style="font-size: 18px; margin-bottom: .65rem;">Preview Slide Image</p>
                            @if($newimage)
                                <img src="{{$newimage->temporaryUrl()}}" alt="preview image" height="200px" style="padding-bottom: 15px" />
                            @else
                                <img src="{{asset('assets/images/sliders')}}/{{$image}}" alt="old image" height="200px" style="padding-bottom: 15px" />
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-1">Slide Image (Size at least W:H : 1170x500)</label>
                                <input style="cursor: pointer" type="file" wire:model="newimage" class="form-control" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-2">Title</label>
                                <input type="text" class="form-control" id="input-2" wire:model="title" placeholder="Title" required />
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-3">Subtitle</label>
                                <input type="text" class="form-control" id="input-3" wire:model="subtitle" placeholder="Subtitle" />
                                @error('subtitle')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-4">Price</label>
                                <input type="number" class="form-control" id="input-4" wire:model="price" placeholder="Price" required/>
                                @error('price')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-5">Link</label>
                                <input type="text" class="form-control" id="input-5" wire:model="link" placeholder="Link" />
                                @error('link')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-6">Status</label>
                                <select for="input-6" class="form-control" wire:model="status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
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
    var element = document.getElementById("act_mhs");
    element.classList.add("active");
</script>
@endpush
