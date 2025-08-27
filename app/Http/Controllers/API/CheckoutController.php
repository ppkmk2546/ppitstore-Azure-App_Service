<?php

namespace App\Http\Controllers\API;

use Cart;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderMail;
use App\Models\Profile;
use App\Models\Shipping;
use App\Models\Orderitem;
use App\Models\Transaction;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        $fields = $request->validate([
            'Uid' => 'required' ,
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'line1' => 'required',
            'line2' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required'
        ]);

            Cart::instance('cart')->restore($request->email);
            $order = new Order();
            $order->user_id = $request->Uid;
            $order->subtotal = Cart::instance('cart')->subtotal();
            $order->discount = 0.00;
            $order->tax = Cart::instance('cart')->tax();
            $order->total = Cart::instance('cart')->total();
            $order->firstname = $request->firstname;
            $order->lastname = $request->lastname;
            $order->mobile = $request->mobile;
            $order->email = $request->email;
            $order->line1 = $request->line1;
            $order->line2 = $request->line2;
            $order->country = $request->country;
            $order->city = $request->city;
            $order->province = $request->province;
            $order->district = $request->district;
            $order->zipcode  = $request->zipcode;
            $order->status = 'ordered';
            $order->is_shipping_different = 0;
            $order->save();

            foreach(Cart::instance('cart')->content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->price;
                $orderItem->qty = $item->qty;
                $orderItem->save();
                $products = Product::all();
                $product = $products->find($item->id);
                $product->quantity=$product->quantity - $item->qty;
                $product->save();
            }

        if($request->payment_method == 'cod')
        {
            $this->makeTransaction($request->Uid,$request->payment_method,$order->id,'pending');
            $this->resetCart($request->email);
        }
        $this->sendOrderConfirmationMail($order);
        return response()->json(array('status'=>'true','message'=>"ทำการสั่งซื้อสำเร็จ"));
    }

    public function placeOrderCreditCard(Request $request)
    {
        $fields = $request->validate([
            'Uid' => 'required' ,
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'line1' => 'required',
            'line2' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required'
        ]);

        if($request->payment_method == 'card')
        {
            $request->validate([
                'card_no' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'cvc' => 'required|numeric'
            ]);
        }

            Cart::instance('cart')->restore($request->email);
            $order = new Order();
            $order->user_id = $request->Uid;
            $order->subtotal = Cart::instance('cart')->subtotal();
            $order->discount = 0.00;
            $order->tax = Cart::instance('cart')->tax();
            $order->total = Cart::instance('cart')->total();
            $order->firstname = $request->firstname;
            $order->lastname = $request->lastname;
            $order->mobile = $request->mobile;
            $order->email = $request->email;
            $order->line1 = $request->line1;
            $order->line2 = $request->line2;
            $order->country = $request->country;
            $order->city = $request->city;
            $order->province = $request->province;
            $order->district = $request->district;
            $order->zipcode  = $request->zipcode;
            $order->status = 'ordered';
            $order->is_shipping_different = 0;
            $order->save();

            foreach(Cart::instance('cart')->content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->price;
                $orderItem->qty = $item->qty;
                $orderItem->save();
                $products = Product::all();
                $product = $products->find($item->id);
                $product->quantity=$product->quantity - $item->qty;
                $product->save();
            }

        if($request->payment_method == 'card')
        {
            $stripe = Stripe::make('sk_test_51KW7gAHtFtVFXvfME8ZxDUaeNRP37tDS9aY2Tj3UiaczjAxaBIsEJxFK0WDhNa2iroAnmia7DjPdXIIKsAJvQNnm00j5xER7rn');

            try{
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->card_no,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvc,
                    ]
                ]);

                if(!isset($token['id']))
                {
                    return response([
                        'message' => 'The stripe token was not generated correctly!',
                        'status' => 'false'
                    ], 401);
                }

                $customer = $stripe->customers()->create([
                    'name' => $request->firstname . ' ' . $request->lastname,
                    'email' =>$request->email,
                    'phone' =>$request->mobile,
                    'address' => [
                        'line1' => $request->line1,
                        'postal_code' => $request->zipcode,
                        'city' => $request->city,
                        'state' => $request->province . ' ' . $request->district,
                        'country' => $request->country,
                    ],
                    'shipping' => [
                        'name' => $request->firstname . ' ' . $request->lastname,
                        'address' => [
                            'line1' => $request->line1,
                            'postal_code' => $request->zipcode,
                            'city' => $request->city,
                            'state' => $request->province . ' ' . $request->district,
                            'country' => $request->country,
                        ],
                    ],
                    'source' => $token['id'],
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'THB',
                    'amount' => $order->total,
                    'description' => 'การชำระเงินสำหรับหมายเลขการสั่งซื้อที่ ' . $order->id,
                ]);

                if($charge['status'] == 'succeeded')
                {
                    $this->makeTransaction($request->Uid,$request->payment_method,$order->id,'approved');
                    $this->resetCart($request->email);
                }
                else
                {
                    $this->makeTransaction($request->Uid,$request->payment_method,$order->id,'declined');
                    $order = Order::find($order->id);
                    $order->status = 'cancelled';
                    $order->save();
                    return response([
                        'message' => 'stripe_error','Error in Transaction!',
                        'status' => 'false'
                    ], 401);
                }
            } catch(\Exception $e){
                $this->makeTransaction($request->Uid,$request->payment_method,$order->id,'declined');
                $order = Order::find($order->id);
                $order->status = 'cancelled';
                $order->save();
                return response([
                    'message' => 'stripe_error',$e->getMessage(),
                    'status' => 'false'
                ], 401);
            }
        }
        $this->sendOrderConfirmationMail($order);
        return response()->json(array('status'=>'true','message'=>"ทำการสั่งซื้อสำเร็จ"));
    }

    public function resetCart($email)
    {
        Cart::instance('cart')->restore($email);
        Cart::instance('cart')->destroy($email);
        Cart::instance('cart')->store($email);
    }

    public function makeTransaction($Uid,$payment_method,$order_id,$status)
    {
        $transaction = new Transaction();
        $transaction->user_id = $Uid;
        $transaction->order_id = $order_id;
        $transaction->mode = $payment_method;
        $transaction->status = $status;
        $transaction->save();
    }

    public function sendOrderConfirmationMail($order)
    {
        Mail::to($order->email)->send(new OrderMail($order));
    }

}
