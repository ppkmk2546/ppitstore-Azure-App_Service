<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrdersComponent extends Component
{
    public $filtering;

    public function filtering($filtering)
    {
        $this->filtering = $filtering;
    }

    public function mount()
    {
        $this->filtering = "Show All";
    }

    use WithPagination;
    public function render()
    {
        if($this->filtering=='Ordered')
        {
            $orders = Order::where('user_id', Auth::user()->id)->where('status','ordered')->orderBy('created_at', 'desc')->paginate(5);
        }
        else if($this->filtering=='Confirmed')
        {
            $orders = Order::where('user_id', Auth::user()->id)->where('status','order_confirmed')->orderBy('created_at', 'desc')->paginate(5);
        }
        else if($this->filtering=='Packing')
        {
            $orders = Order::where('user_id', Auth::user()->id)->where('status','packing')->orderBy('created_at', 'desc')->paginate(5);
        }
        else if($this->filtering=='Shipping')
        {
            $orders = Order::where('user_id', Auth::user()->id)->where('status','shipping')->orderBy('created_at', 'desc')->paginate(5);
        }
        else if($this->filtering=='Delivered')
        {
            $orders = Order::where('user_id', Auth::user()->id)->where('status','delivered')->orderBy('created_at', 'desc')->paginate(5);
        }
        else{
            $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('livewire.user.user-orders-component',['orders'=>$orders])->layout('layouts.base');
    }
}
