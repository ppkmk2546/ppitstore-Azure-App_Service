<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminOrderPendingComponent extends Component
{
    use WithPagination;

    public function updateOrderStatus($order_id,$status)
    {
        $order = Order::find($order_id);
        if($status == "order_confirmed"){
            $order->status = $status;
        }else if($status == "cancelled"){
            $order->status = $status;
            $order->cancelled_date = DB::raw('CURRENT_TIMESTAMP');
        }
        $order->save();
        session()->flash('order_message', 'Order status updated successfully!');
    }

    public function render()
    {
        $orders = Order::where('status', 'ordered')->orderBy('created_at', 'desc')->paginate(12);
        return view('livewire.admin.admin-order-pending-component',['orders'=>$orders])->layout('layouts.admin-dash');
    }
}
