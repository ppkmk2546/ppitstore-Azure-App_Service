<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminOrderDeliveredComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('status', 'delivered')->orderBy('created_at', 'desc')->paginate(12);
        return view('livewire.admin.admin-order-delivered-component',['orders'=>$orders])->layout('layouts.admin-dash');
    }
}
