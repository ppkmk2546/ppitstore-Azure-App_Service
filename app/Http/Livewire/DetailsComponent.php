<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Sale;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        $cart_count = Cart::instance('cart')->count();
        $this->emitTo('cart-count-component','refreshComponent',$cart_count);
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function increaseQuantity()
    {
        $this->qty++;

    }

    public function decreaseQuantity()
    {
        if($this->qty > 1)
        {
            $this->qty--;
        }
    }

    public function addTowishlist($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
    }

    public function removeFromwishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }


    public function render()
    {
        $subcategory = "";

        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        $product = Product::where('slug' ,$this->slug)->first();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        $subcategory = Subcategory::find($product->subcategory_id);
        return view('livewire.details-component' ,['product'=>$product, 'subcategory'=>$subcategory, 'related_products'=>$related_products, 'sale'=>$sale])->layout('layouts.base');
    }
}
