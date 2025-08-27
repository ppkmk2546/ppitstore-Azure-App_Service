<div>
    @section('title') {{'Wishlist'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active">Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

        <!-- Start Wishlist -->
    <section class="product-area shop-sidebar shop">
        <div class="container" align="center">
            @if(Cart::instance('wishlist')->content()->count() > 0)
            <div class="wrap-show-advance-info-box style-1 has-countdown bslide">
                <h3 class="title-normal" align="center">รายการสินค้าที่อยากได้</h3>
                <div class="style-nav-1 wrap-products">
                        <div class="row">
                            @foreach (Cart::instance('wishlist')->content() as $item)
                            <div class="col-xl-3 col-lg-4 col-md-4 col-12 m-0">
                                    <div class="product product-style-2 single-product m-0" align="left">
                                        <div class="product-img product-thumnail">
                                            <a href="{{route('product.details',['slug'=>$item->model->slug])}}" title="{{$item->model->name}}">
                                                <figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
                                                @if($item->model->quantity > 0)
                                                    @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                        <span class="out-of-stock">Sale!</span>
                                                    @endif
                                                @else
                                                    <span class="out-of-stock">Out of Stock</span>
                                                @endif
                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$item->model->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                                </div>
                                                <div class="product-action-2">
                                                    @if($item->model->quantity > 0)
                                                        <a title="Add to cart" onclick="addcart();" href="#" wire:click.prevent="moveProductFromWishlistToCart('{{$item->rowId}}')">Move to cart</a>
                                                    @else
                                                        <div><a>Out of Stock</a></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{route('product.details',['slug'=>$item->model->slug])}}"><span>{{$item->model->name}}</span></a></h3>
                                            <div class="little_description">{{$item->model->short_description}}</div>
                                            <div class="product-price">
                                                @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                    <span>฿{{number_format(($item->model->sale_price));}}.-</span>
                                                    <span class="old">฿{{number_format(($item->model->regular_price));}}.-</span>
                                                @else
                                                    <span>฿{{number_format(($item->model->regular_price));}}.-</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
            @else
                <p class="notfound d-flex justify-content-center" style="margin-bottom: 50px;">ยังไม่มีสินค้าอยู่ในรายการสิ่งที่อยากได้ของท่าน</p>
            @endif
        </div>
    </section>
    <!-- End Wishlist -->
</div>
