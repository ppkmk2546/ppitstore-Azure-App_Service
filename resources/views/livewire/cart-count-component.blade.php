<div>
    <a href="/cart" class="single-icon" title="Cart"><i class="ti-bag" style="font-size: 25px;"></i><span class="total-count">{{ Cart::instance('cart')->count() }}</span></a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            @if(Cart::instance('cart')->count() > 0)
                <span class="cart-count">{{ Cart::instance('cart')->count() }}</span>
                <span> Items</span>
                <a href="{{route('product.cart')}}">View Cart</a>
            @else
                <span class="cart-count">0</span><span> Items</span>
            @endif
        </div>
        <ul class="shopping-list">
            @if(Cart::instance('cart')->count() > 0)
            @foreach(Cart::instance('cart')->content() as $item)
            <li>
                <a href="#" class="remove" title="Remove this item" wire:click.prevent="destory('{{$item->rowId}}')"><i class="fa fa-remove"></i></a>
                <a class="cart-img" href="#"><img src="{{ asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></a>
                <h4><a href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a></h4>
                <p class="quantity">{{$item->qty}}x -
                    @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                        <span class="amount">฿{{number_format(($item->model->sale_price), 2);}}</span></p>
                    @else
                        <span class="amount">฿{{number_format(($item->model->regular_price), 2);}}</span></p>
                    @endif
            </li>
            @endforeach
            @else
            <li>
                <h4 align="center" style="margin: 50px">ไม่มีสินค้าอยู่ในตะกร้า</h4>
            </li>
            @endif
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">฿{{number_format((Cart::instance('cart')->total()), 2);}}</span>
            </div>
            @if(Cart::instance('cart')->count() > 0)
                <a href="{{route('product.cart')}}" class="btn btn-primary">Go to Cart</a>
            @endif
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>
