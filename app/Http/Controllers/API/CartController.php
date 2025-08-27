<?php

namespace App\Http\Controllers\API;

use Cart;
use Validator;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\CartItem;
use Symfony\Component\VarDumper\VarDumper;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
   public function cart($email)
   {
      Cart::instance('cart')->restore($email);
      $wishlist = Cart::instance('cart')->content();
      $wishlistUser = array();
      $item = "";
      $i = 0;
      foreach($wishlist as $keyWish=>$item){
        $wishlistUser[$i]["rowId"] = $item->rowId;
        $wishlistUser[$i]["id"] = $item->id;
        $wishlistUser[$i]["name"] = $item->name;
        $wishlistUser[$i]["wishlist_qty"] = $item->qty;
        $wishlistUser[$i]["tax"] = $item->tax;
        $wishlistUser[$i]["price"] = number_format($item->price,2);
        $wishlistUser[$i]["priceAdd"] = $item->price;
        $wishlistUser[$i]["image"] = $item->model->image;
        $wishlistUser[$i]["product_quantity"] = $item->model->quantity;
        $i += 1;
      }

      return response($wishlistUser);
   }

   public function totalTax($email)
   {
        Cart::instance('cart')->restore($email);
        $totaltax = Cart::instance('cart')->tax();
        $taxcart = array();
        $taxcart[0]["total_tax"] = $totaltax;
        $response = [
            'totaltax' => $totaltax
        ];

      return response($response);
   }

   public function addCart(Request $request)
   {
        $email_user = $request->email;
        $product_id = $request->id;
        $product_name = $request->name;
        $qty = $request->qty;
        $product_price = $request->price;

        Cart::instance('cart')->restore($email_user);
        Cart::instance('cart')->add($product_id,$product_name,$qty,$product_price)->associate('App\Models\Product');
        Cart::instance('cart')->store($email_user);

        return response()->json(array('status'=>'true','message'=>'ใส่สินค้าในตะกร้าสำเร็จ'));
    }

    public function removeCart(Request $request)
    {
        Cart::instance('cart')->restore($request->email);
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        Cart::instance('cart')->store($request->email);

        return response()->json(array('status'=>'true','message'=>"ลบสินค้าในตะกร้าสำเร็จ"));
    }

    public function updateCart(Request $request)
    {
        Cart::instance('cart')->restore($request->email);
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::instance('cart')->update($rowId , $qty);
        Cart::instance('cart')->store($request->email);

        return response()->json(array('status'=>'true','message'=>"ปรับจำนวนเรียบร้อย"));
   }
}
