<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function destory($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        session()->flash('success_message', 'Item has been removed.');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function checkout()
    {
        if(Auth::check())
        {
            return redirect()->route('checkout');
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout()
    {
        if(!Cart::instance('cart')->count() > 0)
        {
            session()->forget('checkout');
            return;
        }

        session()->put('checkout',[
            'discount' => 0,
            'subtotal' => Cart::instance('cart')->subtotal(),
            'tax' => Cart::instance('cart')->tax(),
            'total' => Cart::instance('cart')->total()
        ]);

    }

    public function render()
    {
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
        }

        $sale = Sale::find(1);
        return view('livewire.cart-count-component', ['sale'=>$sale]);
    }
}
