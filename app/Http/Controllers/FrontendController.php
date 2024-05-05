<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Card;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Category;

use App\Models\User;
use Carbon\Carbon;
use Auth,Hash;

class FrontendController extends Controller
{

//=================Home Page View Start=========================================>
function HomePage(){
    $products = Product::latest()->get();
    $banners = Banner::latest()->get();
    $categoris = Category::latest()->get();
    return view('index',compact('banners','categoris','products'));
}
//=================Home Page View End=========================================>

//=================Home Product Details Page Start=========================================>
function productDetails($product_id){
    $product_id = Crypt::decrypt($product_id);
    
    $product_info = Product::find($product_id);
    $products = Product::latest()->get();
    $product_category_id = Product::find($product_id)->category_id;
    $releted_products = Product::where('category_id',$product_category_id)->where('id','!=',$product_id)->get();
 return view('product_details',compact('product_info','releted_products','products'));
}
//=================Home Product Details Page End=========================================>

//=================Home Product All Start=========================================>
function ProductAll(){
    $product_all = Product::latest()->get();
   return view('product_all',compact('product_all'));
}
//=================Home Product All End=========================================>

//=================Home Cart Start=========================================>
function Cart($coupon_name = ""){
    $coupon_discount = 0;
if ($coupon_name == ""){
$coupon_discount = 0;
}
else {

if (Coupon::where('coupon_name',$coupon_name)->exists()){
if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_name)->first()->expire_date){
return back()->with('coupon_errors','Coupon Date Expart');
}
else{
if (Coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
$coupon_discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
} 
else{
return back()->with('coupon_errors','Coupon Limit End');
}
}
} 
else{
echo "Invalit Coupon Name";
return back()->with('coupon_errors','Invaliat Coupon Name');  
}

}
    $carts = Card::latest()->get();
   return view('cart',compact('carts','coupon_discount','coupon_name'));
}
//=================Home Cart End=========================================>

//=================Cart Page Update Start=========================================>
function cartUpdate (Request $request){
    foreach ($request->cart_quantity as $cart_id => $cart_quantity){
        if (Product::find(Card::find($cart_id)->product_id)->product_quantity >= $cart_quantity ){
            Card::find($cart_id)->update([
                'cart_quantity' => $cart_quantity,
            ]);
        }
    }
    return back();
}
//=================Cart Page Update End=========================================>  

//=================CategorywiseShop Start=========================================>
function categorywiseShop($category_id){
    $category_id = Crypt::decrypt($category_id);
    $category_products = Product::where('category_id',$category_id)->get();
    return view('categorywiseshop',compact('category_products',));
}
//=================CategorywiseShop End=========================================>

//=================Coustomer Product Search Start=========================================>
function coustomerproductSearch(Request $request){
    $products = Product::where('product_name','like','%'.$request->search_string.'%')
    ->orWhere('product_sort_des','like','%'.$request->search_string.'%')
    ->orderBy('id','desc')
    ->paginate(5);
    if($products->count() >= 1){
        return view('search_page/coustomersearch',compact('products'))->render();
    }else{
       return response()->json([
           'status' => 'nothing_found'
      ]);
    }
}
//=================Coustomer Product Search End=========================================>

//=================Check Out Start=========================================>
function checkOut(){
    return view('checkout');
}
//=================Check Out End=========================================>

//=================Check Out Start=========================================>
function checkoutPost(Request $request){
    $request->validate([
        'customer_name'=>'required',
        'customer_email'=>'required',
        'customer_phone'=>'required',
        'country_name'=>'required',
        'city_name'=>'required',
        'customer_postcode'=>'required',
        'customer_address'=>'required',
    ]);

    if ($request->payment_option == 1) {
       echo "Online Payment";
    } else {
//order Tabale data insert
       $order_id = Order::insertGetId($request->except('_token')+[
            'user_id' => Auth::id(),
            'payment_status' => 1,
            'discount' => session('session_discount'),
            'subtotal' => session('session_subtotal'),
            'total' => session('session_total'),
            'created_at' => Carbon::now()
        ]);
//Order details Tabale data insert

//Order Details Data Insert Start
        $carts = Card::where('ip_address', request()->ip())->select('id','product_id','cart_quantity')->get();
        foreach ($carts as $cart){
        Order_details::insert([
            'order_id' => $order_id,
            'product_id' => $cart->product_id,
            'quantity' => $cart->cart_quantity,
            'created_at' => Carbon::now()
        ]);
        //Product quantity decerement to product tabele
        Product::find($cart->product_id)->decrement('product_quantity',$cart->cart_quantity);
        //cart Item delete
        Card::find($cart->id)->delete();
        }      
//Order Details Data Insert End


    }
    return back()->with('checkout_status','Order Corform Successfull!');
    
}
//=================Check Out End=========================================>

//=================Customer Register Start=========================================>
function customerRegister(){
    return view('customerregister');
}
//=================Customer Register End=========================================>
//=================Customer Register Start=========================================>
function customerRegisterPost(Request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=>'required|min:6',
    ]);
    User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 2,
        'created_at' => Carbon::now()
    ]);
    
   return back()->with('customer_registar_message','Your Registration Successfull!');
}
//=================Customer Register End=========================================>

//=================Customer Login Start=========================================>
function customerLogin(){
    return view('customerlogin');
}
//=================Customer Login End=========================================>

//=================Customer Login Post Start=========================================>
function customerLoginPost(Request $request){
    $request->validate([
        'email'=>'required',
        'password'=>'required|min:6',
    ]);
  if (User::where('email',$request->email)->exists()){
    $db_password = User::where('email',$request->email)->first()->password;
      //Customer Password Check Start---------------------------->
      if (Hash::check($request->password,$db_password)) {

          if (Auth::attempt($request->except('_token'))){
            return redirect()->intended('home');
          }
          
      } else {
        return back()->with('customer_login_erorr','Your Password is Wroing!');
      }
     //Customer Password Check Start---------------------------->
  }
  else{
     return back()->with('customer_login_erorr','Your Email is Wroing!');
  }
  
}
//=================Customer Login Post End=========================================>

//=================Home Page View Start=========================================>
//=================Home Page View End=========================================>





}
