<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminOrderShippingComponent extends Component
{
    use WithPagination;

    public function updateOrderStatus($order_id,$status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if($status == "delivered")
        {
            $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
        }
        else if($status == "cancelled")
        {
            $order->cancelled_date = DB::raw('CURRENT_TIMESTAMP');
        }
        $order->save();
        session()->flash('order_message', 'Order status updated successfully!');
    }

    public function render()
    {
        $orders = Order::where('status', 'shipping')->orderBy('created_at', 'desc')->paginate(12);
        return view('livewire.admin.admin-order-shipping-component',['orders'=>$orders])->layout('layouts.admin-dash');
    }
}
