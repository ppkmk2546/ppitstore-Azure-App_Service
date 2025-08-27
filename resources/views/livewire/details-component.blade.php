<div>
    @section('title') {{$product->name}}@endsection
    <!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                                <li><a href="/shop">All Product Categories</a><i class="ti-arrow-right"></i></li>
                                <li><a href="{{route('product.category',['category_slug'=>$product->category->slug])}}">{{$product->category->name}}</a><i class="ti-arrow-right"></i></li>
                                <li><a href="{{route('product.category',['category_slug'=>$product->category->slug, 'scategory_slug'=>$subcategory->slug])}}">{{$subcategory->name}}</a><i class="ti-arrow-right"></i></li>
								<li class="active"><a href="#" style="cursor: default;">{{$product->name}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop Single -->
		<section class="shop single section p-0">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="row" style="padding-top: 40px">
									<div class="col-lg-6 col-12">
										<!-- Product Slider -->
										<div class="product-gallery" wire:ignore>
											<!-- Images slider -->
											<div class="flexslider-thumb">
												<ul class="slides">
													<li data-thumb="{{ asset('assets/images/products')}}/{{$product->image}}" rel="adjustX:10, adjustY:">
														<img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{$product->name}}">
													</li>
                                                    @php
                                                        $images = explode(",",$product->images);
                                                    @endphp
                                                    @foreach($images as $image)
                                                        @if($image)
                                                            <li data-thumb="{{ asset('assets/images/products')}}/{{$image}}">
                                                                <img src="{{ asset('assets/images/products')}}/{{$image}}" alt="{{$product->name}}">
                                                            </li>
                                                        @endif
                                                    @endforeach
												</ul>
											</div>
											<!-- End Images slider -->
										</div>
										<!-- End Product slider -->
									</div>
									<div class="col-lg-6 col-12">
										<div class="product-des">
                                            @php
                                                $witems = Cart::instance('wishlist')->content()->pluck('id');
                                            @endphp
											<!-- Description -->
											<div class="short">
												<h4>{{$product->name}}</h4>
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
                                                    </style>
                                                    <ul class="rating">
                                                        @php
                                                            $avgrating = 0;
                                                        @endphp
                                                        @foreach($product->orderItems->where('rstatus',1) as $orderItem)
                                                            @php
                                                                $allcomments = $product->orderItems->where('rstatus',1)->count();
                                                                $avgrating = $avgrating + $orderItem->review->rating / $allcomments;
                                                            @endphp
                                                        @endforeach
                                                        @for($i=1;$i<=5;$i++)
                                                            @if($i<=$avgrating)
                                                                <li><i class="fa fa-star"></i></li>
                                                            @else
                                                                <li><i class="fa fa-star color-gray"></i></li>
                                                            @endif
                                                        @endfor
													</ul>
													<a href="#" class="total-review">({{$product->orderItems->where('rstatus',1)->count()}}) Review</a>
												</div>
                                                @if($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                    <p class="price"><span class="discount">฿{{number_format(($product->sale_price));}}</span>
                                                    <del class="regprice"><s class="regprice">฿{{number_format(($product->regular_price));}}</s></del></p>
                                                @else
												    <p class="price"><span class="discount">฿{{number_format(($product->regular_price));}}</span></p>
                                                @endif
												<p class="description">
                                                    {{$product->short_description}}
                                                </p>
											</div>
											<!--/ End Description -->
											<!-- Product Buy -->
											<div class="product-buy">
												<div class="quantity">
													<h6>Quantity :</h6>
													<!-- Input Order -->
													<div class="input-group">
														<div class="button minus">
															<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[1]" wire:click.prevent="decreaseQuantity">
																<i class="ti-minus"></i>
															</button>
														</div>
														    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="120" wire:model="qty" disabled>
														<div class="button plus">
                                                            @if($product->quantity > $this->qty)
                                                                <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]" wire:click.prevent="increaseQuantity">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            @endif
														</div>
													</div>
													<!--/ End Input Order -->
												</div>
												<div class="add-to-cart">
                                                    @if($product->quantity > 0)
                                                        @if($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                            <a href="#" class="btn" onclick="addcart();" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->sale_price}})">Add to cart</a>
                                                        @else
                                                            <a href="#" class="btn" onclick="addcart();" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})">Add to cart</a>
                                                        @endif
                                                    @endif

                                                    @if($witems->contains($product->id))
                                                        <a href="#" class="btn min" title="Remove from your Wishlist" style="background-color: #F7941D" wire:click.prevent="removeFromwishlist({{$product->id}})"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    @else
                                                        @if($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                            <a title="Wishlist" href="#" class="btn min" wire:click.prevent="addTowishlist({{$product->id}}, '{{$product->name}}',{{$product->sale_price}})"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                        @else
                                                            <a title="Wishlist" href="#" class="btn min" wire:click.prevent="addTowishlist({{$product->id}}, '{{$product->name}}',{{$product->regular_price}})"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                        @endif
                                                    @endif

												</div>
												<p class="cat">Category :<a href="{{route('product.category',['category_slug'=>$product->category->slug])}}">{{$product->category->name}}</a></p>
												<p class="availability">Availability :
                                                    @if($product->quantity > 0)
                                                        <b>In Stock : {{$product->quantity}}</b>
                                                    @else
                                                        <b>Out of Stock</b>
                                                    @endif
                                                </p>
											</div>
											<!--/ End Product Buy -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="product-info">
											<div class="nav-main">
												<!-- Tab Nav -->
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
													<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
												</ul>
												<!--/ End Tab Nav -->
											</div>
											<div class="tab-content" id="myTabContent">
												<!-- Description Tab -->
												<div class="tab-pane fade show active" id="description" role="tabpanel">
													<div class="tab-single">
														<div class="row">
															<div class="col-12">
																<div class="single-des">
                                                                    {!! $product->description !!}
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--/ End Description Tab -->
												<!-- Reviews Tab -->
												<div class="tab-pane fade" id="reviews" role="tabpanel">
													<div class="tab-single review-panel" style="padding-bottom: 60px">
														<div class="row">
															<div class="col-12">
                                                                <div class="ratting-main">
                                                                    <div class="avg-ratting">
                                                                        <h4>Score {{$avgrating}} <span>(Overall)</span></h4>
                                                                        <span>Based on {{$product->orderItems->where('rstatus',1)->count()}} Comments</span>
                                                                    </div>
                                                                    @foreach($product->orderItems->where('rstatus',1) as $orderItem)
                                                                    <!-- Single Rating -->
                                                                    <div class="single-rating" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">
                                                                        <div class="rating-author">
                                                                            <img src="{{asset('assets/images/profiles')}}/{{$orderItem->order->user->profile->image}}" alt="{{$orderItem->order->user->name}}" />
                                                                        </div>
                                                                        <div class="rating-des">
                                                                            <h6>{{$orderItem->order->user->name}} - <time class="woocommerce-review__published-date" datetime="2022-02-14 20:00" >{{Carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y g:i A')}}</time></h6>
                                                                            <div class="ratings">
                                                                                <div class="star-rating">
                                                                                    <span class="width-{{ $orderItem->review->rating * 20}}-percent">Rated <strong class="rating">{{$orderItem->review->rating}}</strong> out of 5</span>
                                                                                </div>
                                                                            </div>
                                                                            <p>{{$orderItem->review->comment}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <!--/ End Single Rating -->
                                                                    @endforeach
                                                                </div>
																<!-- Review -->
																<!--/ End Review -->
															</div>
														</div>
													</div>
												</div>
												<!--/ End Reviews Tab -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section bslide" style="padding-bottom: 20px; padding-top: 110px;">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="style-nav-1 wrap-products p-slider owl-carousel popular-slider bords"  data-items="4" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"4"}}' wire:ignore>
                        @php
                            $witems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach ($related_products as $r_product)
						<!-- Start Single Product -->
						<div class="product product-style-2 single-product">
							<div class="product-img product-thumnail">
								<a href="{{route('product.details',['slug'=>$r_product->slug])}}">
									<figure><img class="default-img" src="{{ asset('assets/images/products')}}/{{$r_product->image}}" alt="{{$r_product->name}}"></figure>
                                    @if($r_product->quantity > 0)
                                        @if($r_product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                            <span class="out-of-stock">Sale!</span>
                                        @endif
                                    @else
                                        <span class="out-of-stock">Out of Stock</span>
                                    @endif
								</a>
								<div class="button-head">
									<div class="product-action">
										@if($witems->contains($r_product->id))
                                            <a title="Wishlist" href="#" wire:click.prevent="removeFromwishlist({{$r_product->id}})"><i class="fa fa-heart fill-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Remove from your Wishlist</span></a>
                                        @else
                                            @if($r_product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$r_product->id}}, '{{$r_product->name}}',{{$r_product->sale_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                            @else
                                                <a title="Wishlist" href="#" wire:click.prevent="addTowishlist({{$r_product->id}}, '{{$r_product->name}}',{{$r_product->regular_price}})"><i class="fa fa-heart" style="padding-right: .5rem" aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                            @endif
                                        @endif
									</div>
									<div class="product-action-2">
                                        @if($r_product->quantity > 0)
                                            @if($r_product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                                <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$r_product->id}},'{{$r_product->name}}',{{$r_product->sale_price}})">Add to cart</a>
                                            @else
                                                <a title="Add to Cart" onclick="addcart();" href="#" wire:click.prevent="store({{$r_product->id}},'{{$r_product->name}}',{{$r_product->regular_price}})">Add to cart</a>
                                            @endif
                                        @else
                                            <div><a>Out of Stock</a></div>
                                        @endif
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="{{route('product.details',['slug'=>$r_product->slug])}}">{{$r_product->name}}</a></h3>
                                <div class="little_description">{{$r_product->short_description}}</div>
                                <div class="product-price">
                                    @if($r_product->sale_price > 0  && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                        <span>฿{{number_format(($r_product->sale_price));}}.-</span>
                                        <span class="old">฿{{number_format(($r_product->regular_price));}}.-</span>
                                    @else
                                        <span>฿{{number_format(($r_product->regular_price));}}.-</span>
                                    @endif
                                </div>
							</div>
						</div>
						<!-- End Single Product -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
</div>
