<div>
    @section('title') {{'Write Review'}}@endsection
    <!-- Breadcrumbs -->
    <div class="breadcrumbs cart-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li><a href="{{route('user.orders')}}">Orders<i class="ti-arrow-right"></i></a></li>
                            {{-- <li><a href="{{route('user.order.details',['order_id'=>$orderItem->order->id])}}">Orders Details<i class="ti-arrow-right"></i></a></li> --}}
                            <li><a href="#" onclick="history.back()">Orders Details<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Review Product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <style>
    .form .form-group input {
        width: 100%;
        height: 45px;
        padding: 10px 20px;
        background: #fff;
        border: 1px solid #ddd;
        resize: none;
        border-radius: 0;
        color: #333;
    }
    </style>
    <!-- Start Review Area -->
    <div class="section">
        <div class="container-fluid" style="padding: 30px 0; width: 60%;">
            <div class="row">
                <div class="col-12">
                    <div class="ratting-main">
                        <h5 style="padding: 25px 0px 25px 0px;">Add Review For</h5>
                        <!-- Single Rating -->
                        <div class="single-rating">
                            <div class="row">
                                <div class="col-lg-2 col-12">
                                    <div class="rating-author">
                                        <img src="{{ asset('assets/images/products') }}/{{$orderItem->product->image}}" alt="{{$orderItem->product->name}}" style="height: 120px; width: 120px;">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-12" style="padding-left: 0px;">
                                    <div class="rating-des">
                                        <strong>{{$orderItem->product->name}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Rating -->
                    </div>
                    <!-- Review -->
                    <!--/ End Review -->
                    <!-- Form -->
                    <form class="form" wire:submit.prevent="addReview">
                        <div class="comment-review">
                            <div class="add-review">
                                <h5 style="padding-top: 30px;">Add A Review</h5>
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <p class="alert alert-success" role="alert" align="center">{{ session()->get('message') }}</p>
                        @endif
                        <div class="comment-form-rating" style="padding-bottom: 25px;">
                            <span>Your rating</span>
                            <p class="stars">
                                <label for="rated-1"></label>
                                <input type="radio" id="rated-1" name="rating" value="1" wire:model="rating">
                                <label for="rated-2"></label>
                                <input type="radio" id="rated-2" name="rating" value="2" wire:model="rating">
                                <label for="rated-3"></label>
                                <input type="radio" id="rated-3" name="rating" value="3" wire:model="rating">
                                <label for="rated-4"></label>
                                <input type="radio" id="rated-4" name="rating" value="4" wire:model="rating">
                                <label for="rated-5"></label>
                                <input type="radio" id="rated-5" name="rating" value="5" checked="checked" wire:model="rating">
                                @error('rating') <span class="text-danger">{{$message}}</span>@enderror
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label>Write a review<span>*</span></label>
                                    <textarea name="message" rows="6" wire:model="comment"></textarea>
                                    @error('comment') <span class="text-danger">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group button5">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</div>
