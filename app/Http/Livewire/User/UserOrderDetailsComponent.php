<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Http;


class UserOrderDetailsComponent extends Component
{
    public $order_id;
    public $tracking_num;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status = "cancelled";
        $order->cancelled_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
        session()->flash('order_message', 'Order Cancelled Successfully!');
    }

    public function usertrackOrder(Request $request){
        if($request->track != null)
        {
            try{
                $result = Http::timeout(40)->post('https://script.google.com/macros/s/AKfycbw-sW7yDrzfhHOGcycY4MiUx-wBygWHBJlq6DmwyaN2yLLczaKJlcz__cqZOtV93B2MVg/exec?action=addUser', [
                    'ID' => $request->track
                ]);
                $data['response'] = json_decode( $result );

                $order = Order::where('user_id', Auth::user()->id)->where('id', $request->id)->first();

            }catch(Exception $exception){
                session()->flash('error_message', 'Something wrong with our tracking system! Try again later.');
                $response = "";
                $order = Order::where('id', $request->id)->first();
                return view('livewire.user.user-order-details-component',['order'=>$order])->layout('layouts.base');
            }

            return view('livewire.user.user-order-details-component',['order'=>$order], $data)->layout('layouts.base');
        }
        else
        {
            $response = "";
            $order = Order::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            return view('livewire.user.user-order-details-component',['order'=>$order])->layout('layouts.base');
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
        session()->flash('order_message', 'Order status comfirmed!');
        return redirect('/user/orders');
    }

    // public function render()
    // {
    //     $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
    //     return view('livewire.user.user-order-details-component',['order'=>$order])->layout('layouts.base');
    // }
}
