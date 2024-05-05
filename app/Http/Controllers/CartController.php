<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Product;
use Carbon\Carbon;

class CartController extends Controller
{

function addCart(Request $request,$product_id){
   $request->validate([
      'cart_quantity' => 'required',
      // 'product_photo' => 'required',
   ]);
   if ($request->cart_quantity > Product::find($product_id)->product_quantity ) {
      return back()->with('error','Stock Not Available');
   }
   if (Card::where('product_id',$product_id)->where('ip_address',request()->ip())->exists()) {
      Card::where('product_id',$product_id)->where('ip_address', request()->ip())->increment('cart_quantity', $request->cart_quantity);
   }else{
       Card::insert([
        'product_id' => $product_id,
        'cart_quantity' => $request->cart_quantity,
        'ip_address' => request()->ip(),
        'created_at' => Carbon::now(),
       ]);
   }

   return back()->with('cart_status');

}

//==================Cart Delete Start============================================>
function cartDelete(Request $request){
   Card::find($request->cart_id)->delete();

   return response()->json([
       'status' => 'success',
   ]);
}
//==================Cart Delete End============================================>



}
