<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\SlideController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\OrderHistoryController;
use App\Http\Controllers\API\AIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [App\Http\Controllers\API\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\UserController::class, 'login']);

Route::get('allCatproduct', [ProductController::class, 'allCatproduct']);
Route::get('allproduct', [ProductController::class, 'allproduct']);
Route::get('detailproduct/{id}', [ProductController::class, 'detailproduct']);
Route::get('searchproduct/{productName}', [ProductController::class, 'searchproduct']);

Route::get('profile/{Uid}', [UserController::class, 'profile']);
Route::post('updateProfile/', [UserController::class, 'updateProfile']);

Route::post('uploadvoice/', [AIController::class, 'upload']);

Route::get('catproduct/', [ProductController::class, 'categorieProduct']);

Route::get('allcatsubproduct/{id}', [ProductController::class, 'allCatSubproduct']);

Route::get('slide/', [SlideController::class, 'slide']);

Route::get('wishlist/{email}', [WishlistController::class, 'wishlist']);
Route::post('updatewishlist/', [WishlistController::class, 'updateWishlist']);

Route::get('cart/{email}', [CartController::class, 'cart']);
Route::get('cart/tax/{email}', [CartController::class, 'totalTax']);
Route::post('addCart/', [CartController::class, 'addCart']);
Route::post('removeCart/', [CartController::class, 'removeCart']);
Route::post('updateCart/', [CartController::class, 'updateCart']);
Route::post('placeOrder/', [CheckoutController::class, 'placeOrder']);
Route::post('placeOrderCreditCard/', [CheckoutController::class, 'placeOrderCreditCard']);

Route::post('updateWishlist/', [WishlistController::class, 'updateWishlist']);
Route::post('removeWishlist/', [WishlistController::class, 'removeWishlist']);
Route::post('addWishlist/', [WishlistController::class, 'addWishlist']);
Route::get('review/{product_id}', [ReviewController::class, 'review']);
Route::post('up_review/', [ReviewController::class, 'addReview']);

Route::get('order-history/{Uid}', [OrderHistoryController::class, 'orderlist']);
Route::post('order-details', [OrderHistoryController::class, 'orderdetails']);
Route::post('order-track', [OrderHistoryController::class, 'usertrackOrder']);
Route::post('order-confirm', [OrderHistoryController::class, 'confirmDeliveryStatus']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\API\UserController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
