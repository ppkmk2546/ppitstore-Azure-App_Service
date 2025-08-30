<div>

@section('title') {{'Home'}}@endsection
<!-- Slider Area -->
<section class="hero-slider">
    <!-- Single Slider -->
    <div class="single-slider">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-9 offset-lg-3 col-12">
                    <div class="text-inner">
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <div class="hero-text">
                                    <h1><span style="color: #fff">NEW PRODUCTS ON SALE!!! </span>Nvidia RTX 3090</h1>
                                    <p style="color: #fff">Nvidia has release new gpu in this year <br> The new gpu is RTX 3090. <br> Available now at VITZARD COMPUTER!</p>
                                    <div class="button">
                                        <a href="{{asset('/product/vga-asus-rog-strix-rtx3090-o24g-gaming-24gb-gddr6x')}}" class="btn">Buy Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->

<!--MAIN SLIDE-->
<section class="small-banner section" wire:ignore>
<div class="container">
    <div class="wrap-main-slide bslide">
        <div id="intro" class="slide-carousel owl-carousel style-nav-1 main-slider" data-items="1" data-loop="true" data-nav="true" data-dots="true">
            @foreach($sliders as $slide)
                <div class="item-slide" style="cursor: pointer">
                    <img src="{{ asset('assets/images/sliders') }}/{{$slide->image}}" alt="" class="img-slide">
                    <div class="slide-info slide-1">
                        <h2 class="f-title"><b style="color: #fff; text-shadow: 2px 2px 4px #000000;">{{$slide->title}}</b></h2>
                        <span class="subtitle" style="color: #fff; text-shadow: 2px 2px 4px #000000;">{{$slide->subtitle}}</span>
                        <p class="sale-info" style="color: #fff; text-shadow: 2px 2px 4px #000000;">Only price: <span class="price">฿ {{number_format(($slide->price));}}</span></p>
                        <a href="{{ asset($slide->link) }}" class="btn-link">Shop Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</section>
<!--END MAIN SLIDE-->

<!--On Sale-->
@if($sproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
<div class="container">
    <div class="wrap-show-advance-info-box style-1 has-countdown bslide reslide">
        <h3 class="title-box">On Sale </h3>
            <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d H:i:s') }}" wire:ignore></div>
            <!-- Use carousel-->
            <div class="style-nav-1 wrap-products p-slider owl-carousel reslide" data-items="4" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"4"}}' wire:ignore>
            <!-- Not Use carousel-->
            {{-- <div class="style-nav-1 wrap-products"> --}}
            {{-- <div class="row"> --}}
            @php
                $witems = Cart::instance('wishlist')->content()->pluck('id');
            @endphp
            @foreach($sproducts as $sproduct)
                {{-- <div class="col-xl-3 col-lg-4 col-md-4 col-12"> --}}
                    <div class="product product-style-2 single-product">
                        <div class="product-img product-thumnail">
                                <a href="{{route('product.details',['slug'=>$sproduct->slug])}}" title="{{$sproduct->name}}">
                                <figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$sproduct->image}}" alt="{{$sproduct->name}}"></figure>
                                @if($sproduct->quantity > 0)
                                    <span class="out-of-stock">SALE!</span>
                                @else
                                    <span class="out-of-stock">Out of Stock</span>
                                @endif
                                </a>
                            <div class="button-head">
                                <div class="product-action">
                                    @if($witems->contains($sproduct->id))
                                        <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$sproduct->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                    @else
                                        @if($sproduct->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                            <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$sproduct->id}}, '{{$sproduct->name}}',{{$sproduct->sale_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                        @else
                                            <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$sproduct->id}}, '{{$sproduct->name}}',{{$sproduct->regular_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                        @endif
                                    @endif
                                </div>
                                <div class="product-action-2">
                                    @if($sproduct->quantity > 0)
                                        <a title="Add to Cart" href="#" onclick="addcart();" wire:click.prevent="store({{$sproduct->id}},'{{$sproduct->name}}',{{$sproduct->sale_price}})">Add to cart</a>
                                    @else
                                        <div><a>Out of Stock</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product.details',['slug'=>$sproduct->slug])}}">{{$sproduct->name}}</a></h3>
                            <div class="little_description">{{$sproduct->short_description}}</div>
                                <div class="product-price">
                                    <span>฿{{number_format(($sproduct->sale_price));}}.-</span>
                                    <span class="old">฿{{number_format(($sproduct->regular_price));}}.-</span>
                                </div>
                        </div>
                    </div>
                {{-- </div> --}}
            @endforeach
            {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endif
<!--End On Sale-->

<!-- Start Midium Banner  -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            <!-- Single Banner  -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset('assets\images\min_slider\presenter_patza_01.png')}}" alt="Presenter Patza854">
                    <div class="content" style="padding-top: 25px;">
                        <p style="color: #fff; font-size: 18px; text-shadow: 2px 2px #000;">พรีเซ็นต์เตอร์คนใหม่ของเรา!</p>
                        <h3 style="color: #fff; text-shadow: 2px 2px 4px #000000">ใช้โค้ด <span >PATZA854</span><br><span style="color: #fff; text-shadow: 2px 2px 4px #000000">ลดทันที <span style="color: rgb(223, 22, 22);">854</span>  บาท!</span></h3>
                        <a href="/shop" style="font-size: 16px;">เลือกซื้อเลย!</a>
                    </div>
                </div>
            </div>
            <!-- /End Single Banner  -->
             <!-- Single Banner  -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset('assets\images\min_slider\Presenter_pat2.png')}}" alt="Presenter Patza854">
                    <div class="content" style="padding-top: 25px;">
                        <p style="color: #fff; font-size: 18px; text-shadow: 2px 2px #000;">วันนี้คุณมีคอมหรือยัง?</p>
                        <h3 style="color: #fff; text-shadow: 2px 2px 4px #000000">ถ้ายังก็ซื้อกับเราเลย! <br><span style="color: #fff; text-shadow: 2px 2px 4px #000000">PATZAรับประกัน</span></h3>
                        <a href="/shop" style="font-size: 16px;">เลือกซื้อเลย!</a>
                    </div>
                </div>
            </div>
            <!-- /End Single Banner  -->
        </div>
    </div>
</section>
<!-- End Midium Banner -->

<div class="container">
    <!--Latest Products-->
    <div class="wrap-show-advance-info-box style-1 has-countdown bslide" wire:ignore>
        <h3 class="title-normal" align="center">Latest Products {{session('output')}}</h3>
        <!-- Use carousel-->
        <div class="style-nav-1 wrap-products p-slider owl-carousel popular-slider">
        {{-- <!-- Not Use carousel--> --}}
        {{-- <div class="style-nav-1 wrap-products"> --}}
            {{-- <div class="row"> --}}
                @php
                    $witems = Cart::instance('wishlist')->content()->pluck('id');
                @endphp
                @foreach($lproducts as $lproduct)
                {{-- <div class="col-xl-3 col-lg-4 col-md-4 col-12"> --}}
                    <div class="product product-style-2 single-product m-0">
                        <div class="product-img product-thumnail">
                            <a href="{{route('product.details',['slug'=>$lproduct->slug])}}" title="{{$lproduct->name}}">
                                <figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$lproduct->image}}" alt="{{$lproduct->name}}"></figure>
                                @if($lproduct->quantity > 0)
                                    @if($lproduct->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                        <span class="out-of-stock">SALE!</span>
                                    @else
                                        <span class="new">New!</span>
                                    @endif
                                @else
                                    <span class="new">Out of Stock</span>
                                @endif
                            </a>
                            <div class="button-head">
                                <div class="product-action">
                                    @if($witems->contains($lproduct->id))
                                        <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$lproduct->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                    @else
                                        @if($lproduct->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                            <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$lproduct->id}}, '{{$lproduct->name}}',{{$lproduct->sale_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                        @else
                                            <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$lproduct->id}}, '{{$lproduct->name}}',{{$lproduct->regular_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                        @endif
                                    @endif
                                </div>
                                <div class="product-action-2">
                                    @if($lproduct->quantity > 0)
                                        @if($lproduct->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                            <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$lproduct->id}},'{{$lproduct->name}}',{{$lproduct->sale_price}})">Add to cart</a>
                                        @else
                                            <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$lproduct->id}},'{{$lproduct->name}}',{{$lproduct->regular_price}})">Add to cart</a>
                                        @endif
                                    @else
                                        <div><a>Out of Stock</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product.details',['slug'=>$lproduct->slug])}}">{{$lproduct->name}}</a></h3>
                            <div class="little_description">{{$lproduct->short_description}}</div>
                            <div class="product-price">
                                @if($lproduct->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                    <span>฿{{number_format(($lproduct->sale_price));}}.-</span>
                                    <span class="old">฿{{number_format(($lproduct->regular_price));}}.-</span>
                                @else
                                    <span>฿{{number_format(($lproduct->regular_price));}}.-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                @endforeach
            {{-- </div> --}}
        {{-- </div> --}}
        </div>
    </div>
</div>

<!-- Start Product Categories Area -->
<div class="product-area section">
    <div class="container">
        <div class="wrap-show-advance-info-box style-1 bslide bords">
            <h3 class="title-normal" align="center">Product Categories</h3>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top: 10px" wire:ignore>
                            @foreach($categories as $key=>$category)
                                <li class="nav-item"><a class="nav-link {{$key==0 ? 'active':''}}" data-toggle="tab" href="#category_{{$category->id}}" role="tab">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        @php
                            $witems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach ($categories as $key=>$category)
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show {{$key==0 ? 'active':''}}" id="category_{{$category->id}}" role="tabpanel" wire:ignore.self>
                            <div class="tab-single">
                                <div class="row">
                                    @php
                                        $c_products = DB::table('products')->where('category_id',$category->id)->get()->take($no_of_products);
                                    @endphp
                                        @foreach ($c_products as $c_product)
                                            <div class="col-xl-3 col-md-4 col-12">
                                                <div class="product product-style-2 single-product m-0">
                                                    <div class="product-img product-thumnail">
                                                        <a href="{{route('product.details',['slug'=>$c_product->slug])}}" title="{{$c_product->name}}">
                                                            <figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$c_product->image}}" alt="{{$c_product->name}}"></figure>
                                                            @if($c_product->quantity > 0)
                                                                @if($c_product->sale_price && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                                    <span class="out-of-stock">SALE!</span>
                                                                @endif
                                                            @else
                                                                <span class="out-of-stock">Out of Stock</span>
                                                            @endif
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action">
                                                                @if($witems->contains($c_product->id))
                                                                    <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$c_product->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                                                @else
                                                                    @if($c_product->sale_price && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                                        <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$c_product->id}}, '{{$c_product->name}}',{{$c_product->sale_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                                                    @else
                                                                        <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$c_product->id}}, '{{$c_product->name}}',{{$c_product->regular_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="product-action-2">
                                                                @if($c_product->quantity > 0)
                                                                    @if($c_product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                                        <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$c_product->id}},'{{$c_product->name}}',{{$c_product->sale_price}})">Add to cart</a>
                                                                    @else
                                                                        <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$c_product->id}},'{{$c_product->name}}',{{$c_product->regular_price}})">Add to cart</a>
                                                                    @endif
                                                                @else
                                                                    <div><a>Out of Stock</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="{{route('product.details',['slug'=>$c_product->slug])}}">{{$c_product->name}}</a></h3>
                                                        <div class="little_description">{{$c_product->short_description}}</div>
                                                        <div class="product-price">
                                                            @if($c_product->sale_price && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                                <span>฿{{number_format(($c_product->sale_price));}}.-</span>
                                                                <span class="old">฿{{number_format(($c_product->regular_price));}}.-</span>
                                                            @else
                                                                <span>฿{{number_format(($c_product->regular_price));}}.-</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

</div>
