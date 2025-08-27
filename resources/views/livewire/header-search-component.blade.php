<!-- Search Form -->
    <div class="search-top">
        <div class="top-search" title="Push to Search"><a href="#0"><i class="ti-search"></i></a></div>
        <!-- Search Form -->
        <div class="search-top">
            <form class="search-form" action="{{route('product.search')}}">
                <input type="text" value="{{$search}}" placeholder="Search here..." name="search">
                <button title="Search" value="search" type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
        <!--/ End Search Form -->
    </div>
    <!--/ End Search Form -->
    <div class="mobile-nav"></div>
</div>
<div class="col-lg-8 col-md-7 col-12">
        <form action="{{route('product.search')}}" id="form-search-top" name="form-search-top">
            <div class="search-bar-top wrap-search">
                <div class="search-bar wrap-search-form">
                    <div class="nice-select custom-style wrap-list-cate" tabindex="0">
                        <input type="hidden" name="product_cat" value="{{$product_cat}}" id="product-cate">
                        <input type="hidden" name="product_cat_id" value="{{$product_cat_id}}" id="product-cate-id">
                        <a href="#" class="link-control current">{{str_split($product_cat,12)[0]}}</a>
                        <ul class="list list-cate">
                            <li data-value="All Category" class="option level-0">All Category</li>
                            @foreach($categories as $category)
                                <li class="option level-1" data-id="{{$category->id}}">{{$category->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                        <input name="search" value="{{$search}}" placeholder="Search Products Here....." type="search">
                        <button class="btnn" type="submit" title="Search" form="form-search-top"><i class="ti-search"></i></button>
        </form>
        <div id="controls">
            <button id="recordButton" type="button" class="btn-ssearch" title="Search with your voice"><i class="fa fa-microphone" aria-hidden="true"></i></button>
            <button id="pauseButton" type="button" style="visibility: hidden; background-color: #f00;" class="btn-ssearch" title="Search with your voice"><i class="fa fa-microphone" aria-hidden="true"></i></button>
            <button id="stopButton" type="button" style="visibility: hidden; background-color: #f00;" class="btn-ssearch" title="Search with your voice"><i class="fa fa-microphone" aria-hidden="true"></i></button>
        </div>
        <div id="formats"></div>
  	        <ol id="recordingsList"></ol>
        </div>
    </div>
</div>



@push('scripts')
    <script src="{{ asset('rec_js/recorder.js') }}"></script>
    <script src="{{ asset('rec_js/app.js') }}"></script>
@endpush
