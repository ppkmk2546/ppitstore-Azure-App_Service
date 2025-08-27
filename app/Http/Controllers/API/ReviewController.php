<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Review;

use function PHPUnit\Framework\isEmpty;

class ReviewController extends Controller
{

    public function addReview(Request $request)
    {
        $review = new Review();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->order_item_id = $request->item_id;
        $review->save();

        $orderItem = OrderItem::find($request->item_id);
        $orderItem->rstatus = true;
        $orderItem->save();

        $response = [
            'message' => 'Review Product successfully',
            'status' => 'true'
        ];
        return response($response, 200);
    }

    public function review($product_id){
        $orderItem = OrderItem::where("product_id",$product_id)->where("rstatus",true)->get();
        $reviewResult = array();
        $reviewShow = array();
        foreach($orderItem as $index=>$item){
            $reviewShow[$index]['review'] = $item->review;
            $reviewShow[$index]['user_image'] = $item->order->user->profile->image;
            $reviewShow[$index]['user_name'] = $item->order->user->name;
        }

        foreach($reviewShow as $key=>$itemReview){
           if($itemReview["review"] != null){
                $reviewResult[$key]['id'] = $itemReview["review"]["id"];
                $reviewResult[$key]['rating'] = $itemReview["review"]["rating"];
                $reviewResult[$key]['comment'] = $itemReview["review"]["comment"];
                $reviewResult[$key]['created_at'] = ($itemReview["review"]["created_at"])->diffForHumans();
                $reviewResult[$key]['image'] = $itemReview["user_image"];
                $reviewResult[$key]['name'] = $itemReview["user_name"];
           }
        }
        return response()->json($reviewResult);
    }
}
