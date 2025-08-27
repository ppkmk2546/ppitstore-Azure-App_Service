<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderHistoryController extends Controller
{
    public function orderlist($Uid) {
        $orders = Order::where('user_id', $Uid)->orderBy('created_at', 'desc')->get();
        return response($orders, 201);
    }

    public function orderdetails(Request $request) {
        $order = Order::where('user_id', $request->Uid)->where('id', $request->order_id)->first();
        $listitemUser = array();
        $item = "";
        $i = 0;
        foreach($order->orderitems as $keyOrder=>$item) {
            $listitemUser[$i]["PID"] = $item->product->id;
            $listitemUser[$i]["Image"] = $item->product->image;
            $listitemUser[$i]["Name"] = $item->product->name;
            $listitemUser[$i]["unit_price"] = number_format(($item->price), 2);
            $listitemUser[$i]["quantity"] = $item->qty;
            $listitemUser[$i]["total_price"] = number_format(($item->price * $item->qty), 2);
            if($order->status == 'delivered' && $item->rstatus == false) {
                $listitemUser[$i]["review"] = "false";
            }elseif($order->status == 'delivered' && $item->rstatus == true) {
                $listitemUser[$i]["review"] = "true";
            }else{
                $listitemUser[$i]["review"] = "inprocess";
            }
            if($order->transaction->mode == 'cod') {
                $listitemUser[$i]["payment_method"] = "ชำระเงินปลายทาง (Cash On Deliverly)";
            }elseif($order->transaction->mode == 'card') {
                $listitemUser[$i]["payment_method"] = "ชำระเงินด้วยบัตรเครดิตหรือเดบิตการ์ด (Credit/DebitCard)";
            }
            $listitemUser[$i]["payment_status"] = $order->transaction->status;
            $listitemUser[$i]["payment_date"] = $order->transaction->created_at;
            $listitemUser[$i]["order_item_id"] = $item->id;
            $i += 1;
        }
        return response($listitemUser, 201);
    }

    public function usertrackOrder(Request $request){
        if($request->track != null)
        {
            try{
                $result = Http::timeout(40)->post('https://script.google.com/macros/s/AKfycbw-sW7yDrzfhHOGcycY4MiUx-wBygWHBJlq6DmwyaN2yLLczaKJlcz__cqZOtV93B2MVg/exec?action=addUser', [
                    'ID' => $request->track
                ]);
                $data['response'] = json_decode( $result );


            }catch(Exception $exception){
                $data['response'] = 'try again later';
                return response($data['response'], 401);
            }

            return response($data['response'], 201);
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
        $response = [
            'message' => 'Order status comfirmed!',
            'status' => 'true'
        ];

        return response($response, 201);
    }
}
