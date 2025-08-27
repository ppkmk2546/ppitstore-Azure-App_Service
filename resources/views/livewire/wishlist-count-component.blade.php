<div>
        <a href="{{route('product.wishlist')}}" class="single-icon" title="Wishlist"><i class="fa fa-heart" style="font-size: 25px;" aria-hidden="true"></i>
            @if(Cart::instance('wishlist')->count() > 0)
                <span class="total-count">{{ Cart::instance('wishlist')->count() }}</span>
            @else
                <span class="total-count">0</span>
            @endif
        </a>
</div>
