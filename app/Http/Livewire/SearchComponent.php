<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Sale;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;

    public $min_price;
    public $max_price;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function psize($pagesize)
    {
        $this->pagesize = $pagesize;
    }

    public function sorting($sorting)
    {
        $this->sorting = $sorting;
    }

    public function mount()
    {
        $this->sorting = "Default sorting";
        $this->pagesize = 9;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));

        $this->min_price = Product::min('regular_price');
        $this->max_price = Product::max('regular_price');
    }

    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $cart_count = Cart::instance('cart')->count();
        $this->emitTo('cart-count-component','refreshComponent',$cart_count);
        // session()->flash('success_message', 'Item added in Cart');
        // return redirect()->route('product.cart');
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

    use WithPagination;
    public function render()
    {
        if($this->sorting=='Sort by newness')
        {
            $products = Product::where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=='Sort by price: low to high')
        {
            $products = Product::where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=='Sort by price: high to low')
        {
            $products = Product::where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }

        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        $categories = Category::all();
        $sale = Sale::find(1);
        $popular_products = Product::inRandomOrder()->limit(3)->get();
        return view('livewire.search-component',['products'=> $products, 'categories'=>$categories, 'sale'=>$sale, 'popular_products'=>$popular_products])->layout("layouts.base");
    }
}
