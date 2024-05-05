<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profile/{user_id}', [App\Http\Controllers\HomeController::class, 'Profile'])->name('profile');
Route::post('profile/update', [App\Http\Controllers\HomeController::class, 'ProfileUpdate'])->name('prfileupdate');
Route::get('user/profile/delete', [App\Http\Controllers\HomeController::class, 'ProfileDelete'])->name('profile.delete');
Route::get('force/delete/user/profile/delete', [App\Http\Controllers\HomeController::class, 'ProfileForcedelete'])->name('profile.forcedelete');
Route::get('user/search/profile', [App\Http\Controllers\HomeController::class, 'userSearch'])->name('user.search');
Route::get('pagination/user/search/profile', [App\Http\Controllers\HomeController::class, 'userPagination'])->name('user.pagination');
Route::get('user/restore/profile', [App\Http\Controllers\HomeController::class, 'ProfileRestore'])->name('profile.restore');
Route::get('customer/delete/{order_id}', [App\Http\Controllers\HomeController::class, 'customerDelete'])->name('customerdelete');
Route::get('customer/edit/{order_id}', [App\Http\Controllers\HomeController::class, 'customerEdit'])->name('customer.edit');
Route::post('customer/update/{order_id}', [App\Http\Controllers\HomeController::class, 'customerUpdate'])->name('customer.update');


//=====================BannerController Start======================================>
Route::get('banner', [BannerController::class,'Banner'])->name('banner');
Route::post('banner/post', [BannerController::class,'bannerpost'])->name('bannerpost');
Route::post('banner/update', [BannerController::class,'bannerUpdate'])->name('bannerupdate');
Route::get('banner/delete', [BannerController::class,'bannerDelete'])->name('banner.delete');
Route::get('banner/search', [BannerController::class,'bannerSearch'])->name('banner.search');

// Route::get('contact', [FrontendController::class,'contact'])->name('contact');
//=====================BannerController End======================================>


//=====================FrontendController Start======================================>
Route::get('/', [FrontendController::class,'HomePage'])->name('ecoshop');
Route::get('product/all', [FrontendController::class,'ProductAll'])->name('product_all');
Route::get('cart', [FrontendController::class,'Cart'])->name('cart');
Route::get('cart/{coupon_name}',[FrontendController::class, 'cart'])->name('cartwithcoupon');
Route::post('cart/update', [FrontendController::class,'cartUpdate'])->name('cardupdate');
Route::get('checkout', [FrontendController::class,'checkOut'])->name('checkout');
Route::get('checkout/post', [FrontendController::class,'checkoutPost'])->name('checkoutpost');
Route::get('product/details/{product_id}', [FrontendController::class,'productDetails'])->name('product_details');
Route::get('categorywiseshop/{category_id}', [FrontendController::class,'categorywiseShop'])->name('categorywiseshop');
Route::get('coustomerproduct/search', [FrontendController::class,'coustomerproductSearch'])->name('coustomerproduct.search');
Route::get('customer/register', [FrontendController::class,'customerRegister'])->name('customer.register');
Route::post('customer/post/register', [FrontendController::class,'customerRegisterPost'])->name('customerregistar.post');
Route::get('customer/login', [FrontendController::class,'customerLogin'])->name('customer.login');
Route::post('customer/login/post', [FrontendController::class,'customerLoginPost'])->name('customerloin.post');
//=====================FrontendController End======================================>

//=====================CategoryController Start======================================>
Route::get('category', [CategoryController::class,'category'])->name('category');
Route::post('category/post', [CategoryController::class,'categoryInsert'])->name('category.insert');
Route::post('category/update', [CategoryController::class,'categoryUpdate'])->name('category.update');
Route::get('category/delete', [CategoryController::class,'categoryDelete'])->name('category.delete');
Route::get('category/restore', [CategoryController::class,'categoryRestore'])->name('category.restore');
Route::get('category/force/delete', [CategoryController::class,'categoryForceDelete'])->name('category.forcedelete');
Route::get('category/all/delete', [CategoryController::class,'categoryAllDelete'])->name('category.alldelete');
Route::get('category/pagination', [CategoryController::class,'categoryPagination'])->name('category.pagination');
Route::get('category/search', [CategoryController::class,'categorySearch'])->name('category.search');
//=====================CategoryController End======================================>

//=====================ProductController Start======================================>
Route::get('product', [ProductController::class,'Product'])->name('product');
Route::post('product/insert', [ProductController::class,'ProductInsert'])->name('product.insert');
Route::post('product/update', [ProductController::class,'ProductUpdate'])->name('product.update');
Route::get('product/delete', [ProductController::class,'ProductDelete'])->name('product.delete');
Route::get('product/pagination', [ProductController::class,'ProductPagination'])->name('product.pagination');
Route::get('product/search', [ProductController::class,'ProductSearch'])->name('product.search');
//=====================ProductController End======================================>

//=====================CartController Start======================================>
Route::post('add/card/{product_id}', [CartController::class,'addCart'])->name('addtocard');
Route::get('delete/cart', [CartController::class,'cartDelete'])->name('card.delete');
//=====================CartController End======================================>

//=====================CouponController Start======================================>
Route::get('coupon', [CouponController::class,'Coupon'])->name('coupon');
Route::post('coupon/insert', [CouponController::class,'couponInsert'])->name('coupon.insert');
Route::post('coupon/update', [CouponController::class,'couponUpdate'])->name('coupon.update');
Route::get('coupon/delete', [CouponController::class,'couponDelete'])->name('coupon.delete');
Route::get('coupon/search', [CouponController::class,'couponSearch'])->name('coupon.search');
Route::get('coupon/pagination', [CouponController::class,'couponPagination'])->name('coupon.pagination');
//=====================CouponController End======================================>

//=====================BannerController Start======================================>
//=====================BannerController End======================================>
