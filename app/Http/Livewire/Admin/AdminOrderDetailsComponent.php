<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminOrderDetailsComponent extends Component
{
    public $order_id;
    public $tracking_num;

    public function mount($order_id)
    {
        $order = Order::find($this->order_id);
        $this->order_id = $order_id;
        $this->tracking_num = $order->tracking_number;
    }

    public function saveTracking(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->tracking_number = $request->tracking_num;
        $order->status = "shipping";
        $order->save();
        session()->flash('tracking_message', 'TrackingNumber updated successfully');
        return redirect('/admin/packing-orders');
    }

    public function admintrackOrder(Request $request){
        if($request->track != null)
        {
            try{
                $result = Http::timeout(40)->post('https://script.google.com/macros/s/AKfycbw-sW7yDrzfhHOGcycY4MiUx-wBygWHBJlq6DmwyaN2yLLczaKJlcz__cqZOtV93B2MVg/exec?action=addUser', [
                    'ID' => $request->track
                ]);
                $data['response'] = json_decode( $result );

                $order = Order::where('id', $request->id)->first();

            }catch(Exception $exception){
                session()->flash('error_message', 'Something wrong with our tracking system! Try again later.');
                $response = "";
                $order = Order::where('id', $request->id)->first();
                return view('livewire.admin.admin-order-details-component',['order'=>$order])->layout('layouts.admin-dash');
            }

            return view('livewire.admin.admin-order-details-component',['order'=>$order], $data)->layout('layouts.admin-dash');
        }
        else
        {
            $response = "";
            $order = Order::where('id', $request->id)->first();
            return view('livewire.admin.admin-order-details-component',['order'=>$order])->layout('layouts.admin-dash');
        }
    }

    public function confirmDeliveryStatus(Request $request){
        $order = order::find($request->order_id);
        $order->status = "delivered";
        $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
        if($order->transaction->mode == 'cod'){
            $transaction = Transaction::find($order->transaction->id);
            $transaction->status = "approved";
            $transaction->save();
        }
        session()->flash('order_message', 'Order status updated successfully!');
        return redirect('/admin/shipping-orders');
    }

    // public function render()
    // {
    //     $order = Order::find($this->order_id);
    //     return view('livewire.admin.admin-order-details-component',['order'=>$order])->layout('layouts.admin-dash');
    // }
}
