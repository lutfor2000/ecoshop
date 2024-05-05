<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
class CouponController extends Controller
{
    public function __construct(){

    $this->middleware('auth');
    $this->middleware('checkrole');
    
    }
//===========Coupone Page View Start=====================================>
   function Coupon(){
    $coupons = Coupon::latest()->paginate(5); 
    return view('coupon.index',compact('coupons'));
   } 
//===========Coupone Page View End=====================================>   

//===========Coupone Insert Start=====================================>
   function couponInsert(Request $request){
       $request->validate([
        "coupon_name" => "required|unique:coupons",
        "discount_amount" => "required",
        "expire_date" => "required",
        "uses_limit" => "required",
       ]);

       Coupon::insert($request->except('_token')+[
        'created_at' => Carbon::now(), 
       ]);
       return response()->json('File Upload Successfull');
   }
//===========Coupone Insert End=====================================>

//===========Coupone Update Start=====================================>
function couponUpdate(Request $request){
    $request->validate([
        "coupon_name" => "required",
        "discount_amount" => "required",
        "expire_date" => "required",
        "uses_limit" => "required",
       ]);

       Coupon::find($request->id)->update($request->except('_token'));
       
       return response()->json('File Upload Successfull');   
}
//===========Coupone Update End=====================================>

//===========Coupone Delete Start=====================================>
function couponDelete(Request $request){
    Coupon::find($request->coupon_id)->delete();

    return response()->json([
        'status' => 'success',
    ]);
}
//===========Coupone Delete End=====================================>

//===========Coupone Search Start=====================================>
function couponSearch(Request $request){
    $coupons = Coupon::where('coupon_name','like','%'.$request->search_string.'%')
    ->orWhere('discount_amount','like','%'.$request->search_string.'%')
    ->orderBy('id','desc')
    ->paginate(5);
    if($coupons->count() >= 1){
        return view('search_page/couponsearch',compact('coupons'))->render();
    }else{
       return response()->json([
           'status' => 'nothing_found'
      ]);
    }
}
//===========Coupone Search End=====================================>

//===========Coupone Pagination Start=====================================>
function couponPagination(Request $request){
    $coupons = Coupon::latest()->paginate(5);
    return view('pagination/coupon',compact('coupons'))->render();
}
//===========Coupone Pagination End=====================================>

//===========Coupone Search Start=====================================>
//===========Coupone Search End=====================================>


}
