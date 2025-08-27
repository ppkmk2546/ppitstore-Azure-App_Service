<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class SlideController extends Controller
{
   public function slide(){
        $slide = HomeSlider::all();
        $slideShow = array();
        foreach($slide as $key=>$value){
            $slideShow[$key]["id"] = $value->id;
            $slideShow[$key]["title"] = $value->title;
            $slideShow[$key]["subtitle"] = $value->subtitle;
            $slideShow[$key]["price"] = $value->price;
            $slideShow[$key]["image"] = $value->image;
            $slideShow[$key]["status"] = $value->status;
        }

        return response()->json($slideShow);
   }
}
