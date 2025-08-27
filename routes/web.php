<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\AboutUsComponent;

use App\Http\Controllers\AIController;

use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\ThankyouComponent;

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminAddCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCouponsComponent;
use App\Http\Livewire\Admin\AdminOrderPendingComponent;
use App\Http\Livewire\Admin\AdminOrderPackingComponent;
use App\Http\Livewire\Admin\AdminOrderShippingComponent;
use App\Http\Livewire\Admin\AdminOrderDeliveredComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Controllers\AdminReportsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('predict/{recive}', [AIController::class, 'predict']);

Route::get('AISearch', [AIController::class, 'AISearch']);

Route::get('/', HomeComponent::class);

Route::get('/shop' ,ShopComponent::class);

Route::get('/product/{slug}' ,DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}/{scategory_slug?}',CategoryComponent::class)->name('product.category');

Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('/contact-us',ContactComponent::class)->name('contact');

Route::get('/about-us',AboutUsComponent::class)->name('about');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//route For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/summary', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    // Route::get('/user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.order.details');
    Route::get('/user/orders/{order_id}', [UserOrderDetailsComponent::class, 'usertrackOrder'])->name('user.order.details');
    Route::post('/user/orders/save-tracking', [UserOrderDetailsComponent::class, 'saveTracking'])->name('user.savetrack');
    Route::post('/user/confirm-delivery',[UserOrderDetailsComponent::class, 'confirmDeliveryStatus'])->name('user.confirmdelivery');
    Route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');
    Route::get('/thank-you',ThankyouComponent::class)->name('thankyou');
    Route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');
    Route::get('/user/profile',UserProfileComponent::class)->name('user.profile');
    Route::get('/user/profile/edit',UserEditProfileComponent::class)->name('user.editprofile');
    Route::get('/cart' ,CartComponent::class)->name('product.cart');
    Route::get('/checkout' ,CheckoutComponent::class)->name('checkout');
});

//route For Admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/category', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}/{scategory_slug?}', AdminEditCategoryComponent::class)->name('admin.editcategory');
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add', AdminAddProductComponent::class)->name('admin.addproducts');
    Route::get('/admin/products/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct');
    Route::get('/admin/reports', [AdminReportsController::class, 'Piechart'])->name('admin.reports');
    Route::post('/admin/reports/custom-view-pie', [AdminReportsController::class, 'PieChange'])->name('admin.PieChange');
    Route::post('/admin/reports/custom-view-bar', [AdminReportsController::class, 'BarChange'])->name('admin.BarChange');

    Route::get('/admin/slider', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    Route::get('/admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');
    Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');

    Route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('/admin/coupon/add',AdminAddCouponsComponent::class)->name('admin.addcoupon');
    Route::get('/admin/coupon/edit/{coupon_id}',AdminEditCouponsComponent::class)->name('admin.editcoupon');

    Route::get('/admin/pending-orders',AdminOrderPendingComponent::class)->name('admin.ordersPending');
    Route::get('/admin/packing-orders',AdminOrderPackingComponent::class)->name('admin.ordersPacking');
    Route::get('/admin/shipping-orders',AdminOrderShippingComponent::class)->name('admin.ordersShipping');
    Route::get('/admin/delivered-orders',AdminOrderDeliveredComponent::class)->name('admin.ordersDelivered');
    Route::get('/admin/orders/{order_id}', [AdminOrderDetailsComponent::class, 'admintrackOrder'])->name('admin.orderdetails');
    Route::post('/admin/orders/save-tracking', [AdminOrderDetailsComponent::class, 'saveTracking'])->name('admin.savetrack');
    Route::post('/admin/confirm-delivery',[AdminOrderDetailsComponent::class, 'confirmDeliveryStatus'])->name('admin.confirmdelivery');

    Route::get('/admin/contact-us',AdminContactComponent::class)->name('admin.contact');
    Route::get('/admin/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
