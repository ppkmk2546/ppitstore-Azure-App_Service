<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminOrderPackingComponent extends Component
{
    use WithPagination;

    public function updateOrderStatus($order_id,$status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        $order->save();
        session()->flash('order_message', 'Order status updated successfully!');
        return redirect()->route('admin.ordersPacking');

    }

    public function render()
    {
        $orders = Order::where('status', 'order_confirmed')->orwhere('status', 'packing')->orderBy('created_at', 'desc')->paginate(12);
        return view('livewire.admin.admin-order-packing-component',['orders'=>$orders])->layout('layouts.admin-dash');
    }
}
