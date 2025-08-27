<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Cart;
use Illuminate\Support\Facades\Auth ;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Orchestra\Testbench\TestCase;
use Symfony\Component\VarDumper\VarDumper;

class WishlistController extends Controller
{
   public function wishlist($email)
   {
      Cart::instance('wishlist')->restore($email);
      $wishlist = Cart::instance('wishlist')->content();
      $wishlistUser = array();
      $item = "";
      $i = 0;
      foreach($wishlist as $keyWish=>$item){
         $wishlistUser[$i]["rowId"] = $item->rowId;
         $wishlistUser[$i]["id"] = $item->id;
         $wishlistUser[$i]["name"] = $item->name;
         $wishlistUser[$i]["wishlist_qty"] = $item->qty;
         $wishlistUser[$i]["tax"] = number_format($item->tax,2);
         $wishlistUser[$i]["price"] = number_format($item->price,2);
         $wishlistUser[$i]["priceAdd"] =$item->price;
         $wishlistUser[$i]["image"] = $item->model->image;
         $wishlistUser[$i]["product_quantity"] = $item->model->quantity;
         $i += 1;
         foreach($item as $key=>$value){
            $item = $value;
         }
      }
        return response($wishlistUser);
   }

   public function addWishlist(Request $request)
   {
        $email_user = $request->email;
        $product_id = $request->id;
        $product_name = $request->name;
        $qty = $request->qty;
        $product_price = $request->price;


        Cart::instance('wishlist')->restore($email_user);
        Cart::instance('wishlist')->add($product_id,$product_name,$qty,$product_price)->associate('App\Models\Product');
        Cart::instance('wishlist')->store($email_user);
        return response()->json(array('status'=>'true','message'=>'เพิ่มรายการเรียบร้อย'));
    }

    public function removeWishlist(Request $request)
    {
        Cart::instance('wishlist')->restore($request->email);
        $rowId = $request->rowId;

        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('wishlist')->store($request->email);

        return response()->json(array('status'=>'true','message'=>"ลบรายการเรียบร้อย"));
    }

    public function updateWishlist(Request $request)
    {
        Cart::instance('wishlist')->restore($request->email);

        $rowId = $request->rowId;
        $qty = $request->qty;

        Cart::instance('wishlist')->update($rowId , $qty);
        Cart::instance('wishlist')->store($request->email);

        return response()->json(array('status'=>'true','message'=>"ปรับจำนวนเรียบร้อย"));
    }
}
