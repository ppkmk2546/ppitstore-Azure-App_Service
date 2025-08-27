<div>
 @section('title') {{'Search Result'}}@endsection
 <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Searching Result</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    <section class="product-area shop-sidebar shop" style="margin: 30px 0px 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Categories</h3>
                                <ul class="categor-list">
                                    @foreach($categories as $category)
                                    <li class="category-item {{count($category->subCategories) > 0 ? 'has-child-cate':''}}">
                                            <a style="font-size: 17px;" href="{{route('product.category',['category_slug'=>$category->slug])}}">{{$category->name}}</a>
                                        @if(count($category->subCategories) > 0)
                                            <a class="collapsiblesub" style="font-size: 17px;"></a>
                                            <ul class="contentsub">
                                                @foreach($category->subCategories as $scategory)
                                                    <li class="category-item">
                                                        <a style="font-size: 15px;" href="{{route('product.category',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}"><i class="fa fa-caret-right"></i> {{$scategory->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--/ End Single Widget -->
                            <!-- Shop By Price -->
							<div class="single-widget range">
								<h3 class="title">Shop by Price</h3>
									<div class="price-filter">
										<div class="price-filter-inner">
                                            <div>
                                                <div id="slider" wire:ignore class="noUiSlider"></div>
                                                <div class="label-input" style="padding-top: 40px">
                                                    <span><b>PRICE</b> <b class="range_price">฿{{number_format(($min_price));}} - ฿{{number_format(($max_price));}}</b></span>
                                                </div>
                                            </div>
										</div>
									</div>
							    </div>
						<!--/ End Shop By Price -->
                            <!-- Single Widget -->
                        <div class="single-widget recent-post" wire:ignore>
                            <h3 class="title">Popular Products</h3>
                            @foreach($popular_products as $p_product)
                            <!-- Single Post -->
                            <div class="single-post first">
                                <a href="{{route('product.details',['slug'=>$p_product->slug])}}">
                                    <div class="image imagehov">
                                        <figure><img src="{{ asset('assets/images/products')}}/{{$p_product->image}}" alt="{{$p_product->name}}"></figure>
                                    </div>
                                    <div class="content">
                                        <h5><a href="{{route('product.details',['slug'=>$p_product->slug])}}">{{$p_product->name}}</a></h5>
                                        @if($p_product->sale_price > 0  && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                            <p class="bnorm_price">฿{{number_format(($p_product->sale_price));}}.-</p>
                                            <p class="old_price">฿{{number_format(($p_product->regular_price));}}.-</p>
                                        @else
                                            <p class="bnorm_price">฿{{number_format(($p_product->regular_price));}}.-</p>
                                        @endif
                                        <ul class="reviews">
                                            <div class="rating-main">
                                                <style>
                                                    .color-gray{
                                                        color: #e6e6e6 !important;
                                                    }
                                                    .width-0-percent{
                                                        width: 0%;
                                                    }
                                                    .width-20-percent{
                                                        width: 20%;
                                                    }
                                                    .width-40-percent{
                                                        width: 40%;
                                                    }
                                                    .width-60-percent{
                                                        width: 60%;
                                                    }
                                                    .width-80-percent{
                                                        width: 80%;
                                                    }
                                                    .width-100-percent{
                                                        width: 100%;
                                                    }
                                                    .yellstar{
                                                        color: #ffc107 !important;
                                                    }
                                                </style>
                                                <ul class="rating">
                                                    @php
                                                        $avgrating = 0;
                                                    @endphp
                                                    @foreach($p_product->orderItems->where('rstatus',1) as $orderItem)
                                                        @php
                                                            $allcomments = $p_product->orderItems->where('rstatus',1)->count();
                                                            $avgrating = $avgrating + $orderItem->review->rating / $allcomments;
                                                        @endphp
                                                    @endforeach
                                                    @for($i=1;$i<=5;$i++)
                                                        @if($i<=$avgrating)
                                                            <li><i class="fa fa-star yellstar"></i></li>
                                                        @else
                                                            <li><i class="fa fa-star color-gray"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <!-- End Single Post -->
                            @endforeach
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Show :</label>
                                        <div style="display: inline-flex;">
                                        <div class="nice-select current form-control form-control-sm" tabindex="0">
                                            <span class="current">{{$pagesize}}</span>
                                            <ul class="list">
                                                <li wire:click="psize(9)" class="option">9</li>
                                                <li wire:click="psize(12)" class="option">12</li>
                                                <li wire:click="psize(16)" class="option">16</li>
                                                <li wire:click="psize(18)" class="option">18</li>
                                                <li wire:click="psize(24)" class="option">24</li>
                                                <li wire:click="psize(32)" class="option">32</li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <div style="display: inline-flex;">
                                        <div class="nice-select current form-control form-control-sm" tabindex="0">
                                            <span class="current">{{$sorting}}</span>
                                            <ul class="list">
                                                <li wire:click="sorting('Default sorting')" data-value="default" class="option">Default sorting</li>
                                                <li wire:click="sorting('Sort by newness')" data-value="date" class="option">Sort by newness</li>
                                                <li wire:click="sorting('Sort by price: low to high')" data-value="price-lh" class="option">Sort by price: low to high</li>
                                                <li wire:click="sorting('Sort by price: high to low')" data-value="price-hl" class="option">Sort by price: high to low</li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    @if($products->count() > 0)
                    <div class="row">
                        @php
                            $witems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="product product-style-2 single-product" style="margin-top: 10px">
                                    <div class="product-img product-thumnail">
                                        <a href="{{route('product.details',['slug'=>$product->slug])}}" title="{{$product->name}}">
                                            <figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{$product->name}}"></figure>
                                            @if($product->quantity > 0)
                                                @if($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                    <span class="out-of-stock">Sale!</span>
                                                @endif
                                            @else
                                                <span class="out-of-stock">Out of Stock</span>
                                            @endif
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                @if($witems->contains($product->id))
                                                    <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$product->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                                @else
                                                    <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$product->id}}, '{{$product->name}}',{{$product->regular_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                                @endif
                                            </div>
                                            <div class="product-action-2">
                                                @if($product->quantity > 0)
                                                    @if($product->sale_price > 0  && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                        <a title="Add to cart" onclick="addcart();" href="#" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->sale_price}})">Add to cart</a>
                                                    @else
                                                        <a title="Add to cart" onclick="addcart();" href="#" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})">Add to cart</a>
                                                    @endif
                                                @else
                                                    <div><a>Out of Stock</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product.details',['slug'=>$product->slug])}}"><span>{{$product->name}}</span></a></h3>
                                        <div class="little_description">{{$product->short_description}}</div>
                                        <div class="product-price">
                                            @if($product->sale_price > 0  && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                <span>฿{{number_format(($product->sale_price));}}.-</span>
                                                <span class="old">฿{{number_format(($product->regular_price));}}.-</span>
                                            @else
                                                    <span>฿{{number_format(($product->regular_price));}}.-</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12">
                            <!-- Pagination -->
                            @if(count($products))
                            <div class="pagination">
                                <a href="#">{{$products->links('livewire-pagination-links')}}</a>
                            </div>
                            @endif
                            <!--/ End Pagination -->
                        </div>
                </div>
                @else
                    <p class="notfound d-flex justify-content-center">ไม่พบรายการสินค้าที่ท่านกำลังค้นหา</p>
                @endif
            </div>
            </div>
        </div>
    </section>
    <!--/ End Product Style 1  -->
    </div>

    @push('scripts')

    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [{{$min_price}}, {{$max_price}}],
            connect:true,
            range: {
                'min': {{$min_price}},
                'max': {{$max_price}}
            },
            pips: {
                mode: 'steps',
                stepped: true,
                density:4
            }
        });

        slider.noUiSlider.on('update', function(value){
            @this.set('min_price',value[0]);
            @this.set('max_price',value[1]);
        })
    </script>

    @endpush
