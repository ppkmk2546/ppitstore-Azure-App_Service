<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Database\Factories\CategoryFactory;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function allCatproduct(){
        $subcat = Category::all();
        $product = Product::all();
        $productSel = array();
        $subProduct = array();
        foreach($subcat as $keySub=>$valueSub){
            $productSel = array();
            $catSearch =  Product::where('category_id',$valueSub->id)->limit(3)->get();
            foreach($catSearch as $key=>$value){
                $productSel[$key]["id"] =  $value->id;
                $productSel[$key]["name"] = $value->name;
                $productSel[$key]["regular_price"] = number_format($value->regular_price,2);
                $productSel[$key]["priceAdd"] = $value->regular_price;
                $productSel[$key]["quantity"] = $value->quantity;
                $productSel[$key]["image"] = $value->image;
                $productSel[$key]["cat_id"] = $value->category_id;
            }
            $subProduct[$keySub]["subname"] = $valueSub->name;
            $subProduct[$keySub]["item"] = $productSel;
        }
        return response()->json($subProduct);
    }

    public function allCatSubproduct($id){
        $subcat = Subcategory::where('category_id',$id)->get();
        $productSel = array();
        $subProduct = array();
        foreach($subcat as $keySub=>$valueSub){
            $catSearch =  Product::where('category_id',$id)->get();
            foreach($catSearch as $key=>$value){
                $productSel[$key]["id"] =  $value->id;
                $productSel[$key]["name"] = $value->name;
                $productSel[$key]["image"] = $value->image;
                $productSel[$key]["regular_price"] = number_format($value->regular_price,2);
            }
            $subProduct[$keySub]["subname"] = $valueSub->name;
            $subProduct[$keySub]["item"] = $productSel;
        }
        return response()->json($productSel);
    }

    public function allproduct(){
        $product = Product::all()->take(20);
        $productSel = array();
        foreach($product as $key=>$item){
            $productSel[$key]["id"] =  $item->id;
            $productSel[$key]["name"] = $item->name;
            $productSel[$key]["regular_price"] = number_format($item->regular_price,2);
            $productSel[$key]["quantity"] = $item->quantity;
            $productSel[$key]["image"] = $item->image;
        }
        return response()->json($productSel);
    }

    public function detailproduct($id){
        $product = Product::where("id", $id)->get();
        $productSel = array();
        foreach($product as $key=>$item){
            $productSel[$key]["id"] =  $item->id;
            $productSel[$key]["name"] = $item->name;
            $productSel[$key]["short_description"] = $item->short_description;
            $productSel[$key]["description"] = $item->description;
            $productSel[$key]["priceAdd"] = $item->regular_price;
            $productSel[$key]["regular_price"] = number_format($item->regular_price,2);
            $productSel[$key]["quantity"] = $item->quantity;
            $productSel[$key]["image"] = $item->image;
            $productSel[$key]["images"] = $item->images;
        }
        return response()->json($productSel);
    }

    public function searchproduct($productName){

        $product = Product::where("name",'LIKE','%'.$productName.'%')->get();
        $productSel = array();
        $productSelall = array();

        if(count($product) == 0 ){
            $productall = Product::all();
            foreach($productall as $key=>$item){
                $productSelall[$key]["id"] =  $item->id;
                $productSelall[$key]["name"] = $item->name;
                $productSelall[$key]["image"] = $item->image;
            }
            return response()->json($productSelall);
        }else{

            foreach($product as $key=>$item){
                $productSel[$key]["id"] =  $item->id;
                $productSel[$key]["name"] = $item->name;
                $productSel[$key]["image"] = $item->image;
            }
            return response()->json($productSel);
        }
    }

    public function categorieProduct(){
        $product = Category::all();
        $productSel = array();
        $productCat = array();
        foreach($product as $key=>$item){
            $productCat[$key]["id"] =  $item->id;
            $productCat[$key]["name"] = $item->name;
            $productCat[$key]["image"] =  "$item->image";
        }
        return response()->json($productCat);
    }
}

?>
