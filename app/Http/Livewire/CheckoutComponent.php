<?php

namespace App\Http\Livewire;

use Cart;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderMail;
use App\Models\Profile;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Orderitem;
use App\Models\Transaction;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutComponent extends Component
{
    public $ship_to_different_address;

    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $line1;
    public $line2;
    public $country;
    public $city;
    public $province;
    public $district;
    public $zipcode;

    public $ship_firstname;
    public $ship_lastname;
    public $ship_mobile;
    public $ship_email;
    public $ship_line1;
    public $ship_line2;
    public $ship_country;
    public $ship_city;
    public $ship_province;
    public $ship_district;
    public $ship_zipcode;

    public $payment_method;
    public $thankyou;

    public $card_no;
    public $exp_month;
    public $exp_year;
    public $cvc;

    public function mount()
    {
        $userProfile = Profile::where('user_id', Auth::user()->id)->first();
        if(!$userProfile){
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();
        }
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->profile->image;
        $this->firstname = $user->profile->firstname;
        $this->lastname = $user->profile->lastname;
        $this->mobile = $user->profile->mobile;
        $this->line1 = $user->profile->line1;
        $this->line2 = $user->profile->line2;
        $this->city = $user->profile->city;
        $this->province = $user->profile->province;
        $this->district = $user->profile->district;
        $this->country = $user->profile->country;
        $this->zipcode = $user->profile->zipcode;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'line1' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
        ]);

        if($this->ship_to_different_address)
        {
            $this->validateOnly($fields, [
                'ship_firstname' => 'required',
                'ship_lastname' => 'required',
                'ship_mobile' => 'required|numeric',
                'ship_email' => 'required|email',
                'ship_line1' => 'required',
                'ship_country' => 'required',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_district' => 'required',
                'ship_zipcode' => 'required',
                'payment_method' => 'required',
            ]);
        }

        if($this->payment_method == 'card')
        {
            $this->validateOnly($fields, [
                'card_no' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'cvc' => 'required|numeric'
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'line1' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
        ]);

        if($this->payment_method == 'card')
        {
            $this->validate([
                'card_no' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'cvc' => 'required|numeric'
            ]);
        }

        if($this->ship_to_different_address)
        {
            $this->validate([
                'ship_firstname' => 'required',
                'ship_lastname' => 'required',
                'ship_mobile' => 'required|numeric',
                'ship_email' => 'required|email',
                'ship_line1' => 'required',
                'ship_country' => 'required',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_district' => 'required',
                'ship_zipcode' => 'required',
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->ship_firstname;
            $shipping->lastname = $this->ship_lastname;
            $shipping->mobile = $this->ship_mobile;
            $shipping->email = $this->ship_email;
            $shipping->line1 = $this->ship_line1;
            $shipping->line2 = $this->ship_line2;
            $shipping->country = $this->ship_country;
            $shipping->city = $this->ship_city;
            $shipping->province = $this->ship_province;
            $shipping->district = $this->ship_district;
            $shipping->zipcode  = $this->ship_zipcode;
            $shipping->save();
        }

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = session()->get('checkout')['subtotal'];
            $order->discount = session()->get('checkout')['discount'];
            $order->tax = session()->get('checkout')['tax'];
            $order->total = session()->get('checkout')['total'];
            $order->firstname = $this->firstname;
            $order->lastname = $this->lastname;
            $order->mobile = $this->mobile;
            $order->email = $this->email;
            $order->line1 = $this->line1;
            $order->line2 = $this->line2;
            $order->country = $this->country;
            $order->city = $this->city;
            $order->province = $this->province;
            $order->district = $this->district;
            $order->zipcode  = $this->zipcode;
            $order->status = 'ordered';
            $order->is_shipping_different = $this->ship_to_different_address ? 1:0;
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

        if($this->payment_method == 'cod')
        {
            $this->makeTransaction($order->id,'pending');
            $this->resetCart();
        }
        else if($this->payment_method == 'card')
        {
            $stripe = Stripe::make('sk_test_51KW7gAHtFtVFXvfME8ZxDUaeNRP37tDS9aY2Tj3UiaczjAxaBIsEJxFK0WDhNa2iroAnmia7DjPdXIIKsAJvQNnm00j5xER7rn');

            try{
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $this->card_no,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->cvc,
                    ]
                ]);

                if(!isset($token['id']))
                {
                    session()->flash('stripe_error','The stripe token was not generated correctly!');
                    $this->thankyou = 0;
                }

                $customer = $stripe->customers()->create([
                    'name' => $this->firstname . ' ' . $this->lastname,
                    'email' =>$this->email,
                    'phone' =>$this->mobile,
                    'address' => [
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode,
                        'city' => $this->city,
                        'state' => $this->province . ' ' . $this->district,
                        'country' => $this->country,
                    ],
                    'shipping' => [
                        'name' => $this->firstname . ' ' . $this->lastname,
                        'address' => [
                            'line1' => $this->line1,
                            'postal_code' => $this->zipcode,
                            'city' => $this->city,
                            'state' => $this->province . ' ' . $this->district,
                            'country' => $this->country,
                        ],
                    ],
                    'source' => $token['id'],
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'THB',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'การชำระเงินสำหรับหมายเลขการสั่งซื้อที่ ' . $order->id,
                ]);

                if($charge['status'] == 'succeeded')
                {
                    $this->makeTransaction($order->id,'approved');
                    $this->resetCart();
                }
                else
                {
                    $this->makeTransaction($order->id,'declined');
                    $order = Order::find($order->id);
                    $order->status = 'cancelled';
                    $order->save();
                    session()->flash('stripe_error','Error in Transaction!');
                    $this->thankyou = 0;
                }
            } catch(\Exception $e){
                session()->flash('stripe_error',$e->getMessage());
                $this->makeTransaction($order->id,'declined');
                $order = Order::find($order->id);
                $order->status = 'cancelled';
                $order->save();
                $this->thankyou = 0;
            }
        }
        $this->sendOrderConfirmationMail($order);
    }

    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($order_id,$status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->payment_method;
        $transaction->status = $status;
        $transaction->save();
    }

    public function sendOrderConfirmationMail($order)
    {
        Mail::to($order->email)->send(new OrderMail($order));
    }

    public function verifyForCheckout()
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        else if($this->thankyou)
        {
            return redirect()->route('thankyou');
        }
        else if(!session()->get('checkout'))
        {
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout("layouts.base");
    }
}
