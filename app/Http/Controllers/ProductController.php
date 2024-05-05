<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\Feature_photo;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
public function __construct(){

$this->middleware('auth');
$this->middleware('checkrole');

}
//===============Product Page View Start===========================>
function Product(){
    $categories = Category::latest()->get();
    $products = Product::latest()->paginate(5);
    return view('product.product',compact('categories','products'));
}
//===============Product Page View End===========================>

//===============Product Insert Start===========================>
function ProductInsert(Request $request){
     $request->validate([
        'category_id' => 'required',
        'product_name' => 'required',
        'product_sort_des' => 'required',
        'product_price' => 'required',
        'product_quantity' => 'required',
        'product_alert_quantity' => 'required',
        'product_model' => 'required',
        'product_description' => 'required',
        'product_photo' => 'required',
        'product_feature_photo' => 'required',
     ]);
    
     $random_photo_name = Str::random(10).time().".".$request->product_photo->getClientOriginalExtension();
     $product_photo = $request->file('product_photo');
     Image::make($product_photo)->resize(500, 375)->save(base_path('public/uploads/product_photo/').$random_photo_name);

    $product_id = Product::insertGetId($request->except('_token','product_photo','product_feature_photo')+[
        'product_photo' => $random_photo_name,   
        'created_at' => Carbon::now(),   
    ]);

    //featured Photo Processin Start-------------------------------->
    if ($request->hasFile('product_feature_photo')){
        foreach ($request->file('product_feature_photo') as $single_featured_photo){
            //Photo Uplodae Processing   
            $random_photo_name = Str::random(10).time().".".$single_featured_photo->getClientOriginalExtension();
            $product_photo = $single_featured_photo;
            Image::make($product_photo)->resize(500, 375)->save(base_path('public/uploads/product_featured_photo/').$random_photo_name);
            //Photo database Insart Processing
            Feature_photo::insert([
            'product_id' => $product_id,
            'product_feature_photo' => $random_photo_name,
            'created_at' => Carbon::now(),
            ]);

      }
   }
//featured Photo Processin End--------------------------------> 


    return response()->json('File Update Successfull');

}
//===============Product Insert End===========================>

//===============Product Update Start===========================>
function ProductUpdate(Request $request){
    $request->validate([
        'product_name' => 'required',
        'product_sort_des' => 'required',
        'product_price' => 'required',
        'product_quantity' => 'required',
        'product_alert_quantity' => 'required',
        'product_model' => 'required',
        'product_description' => 'required',
        // 'product_photo' => 'required',
     ]);

     if ($request->hasFile('product_new_photo')){
        //Delete Old Photo Start
        $old_photo_path = base_path('public/uploads/product_photo/').Product::find($request->id)->product_photo;
        unlink($old_photo_path);
        
        //Upload New Photo Start-------------------------------------->
        $random_photo_name = Str::random(10).time().".".$request->product_new_photo->getClientOriginalExtension();
        $product_photo = $request->file('product_new_photo');
        Image::make($product_photo)->resize(500, 375)->save(base_path('public/uploads/product_photo/').$random_photo_name);
        //Upload New Photo End-------------------------------------->
        Product::find($request->id)->update($request->except('_token','product_new_photo')+[
            'product_photo' =>$random_photo_name, 
        ]);
       }
       Product::find($request->id)->update($request->except('_token','product_new_photo'));

    //    if (Feature_photo::where('product_id',$request->id)->exists()) {
    //     foreach (Feature_photo::where('product_id',$request->id)->get() as  $single_featured_photo){
    //         $feature_photo_path = base_path('public/uploads/product_featured_photo/').$single_featured_photo->product_feature_photo;
    //         unlink($feature_photo_path);
    //     }

    //     foreach ($request->file('product_feature_photo') as $single_featured_photo){
    //         //Photo Uplodae Processing   
    //         $random_photo_name = Str::random(10).time().".".$single_featured_photo->getClientOriginalExtension();
    //         $product_photo = $single_featured_photo;
    //         Image::make($product_photo)->resize(1500, 1500)->save(base_path('public/uploads/product_featured_photo/').$random_photo_name);
    //         //Photo database Insart Processing
    //         Feature_photo::find($request->id)->update([
    //             'product_feature_photo' =>$random_photo_name, 
    //         ]);
    //     }
    //    }


       return response()->json('File Update Successfull');

}
//===============Product Update End===========================>

//===============Product Delete Start===========================>
function ProductDelete(Request $request){
    if (Product::where('id',$request->product_id)->exists()) {
        $old_photo_path = base_path('public/uploads/product_photo/').Product::find($request->product_id)->product_photo;
        unlink($old_photo_path);
        Product::find($request->product_id)->delete();
    } 
    //----------Feature Photo Delete Start----------------->
    if (Feature_photo::where('product_id',$request->product_id)->exists()) {
            foreach (Feature_photo::where('product_id',$request->product_id)->get() as  $single_featured_photo){
            $feature_photo_path = base_path('public/uploads/product_featured_photo/').$single_featured_photo->product_feature_photo;
            unlink($feature_photo_path);
            Feature_photo::where('product_id',$request->product_id)->Delete();
            }
        }
    //----------Feature Photo Delete End----------------->

    return response()->json([
        'status' => 'success',
    ]);
}
//===============Product Delete End===========================>

//===============Product Page Pagination Start===========================>
function ProductPagination(Request $request){
    $products = Product::latest()->paginate(5);
    return view('pagination/product',compact('products'))->render();
}
//===============Product Page Pagination End===========================> 

//===============Product Search Start===========================>
function ProductSearch(Request $request){
    $products = Product::where('product_name','like','%'.$request->search_string.'%')
    ->orWhere('product_sort_des','like','%'.$request->search_string.'%')
    ->orderBy('id','desc')
    ->paginate(5);
    if($products->count() >= 1){
        return view('search_page/productsearch',compact('products'))->render();
    }else{
       return response()->json([
           'status' => 'nothing_found'
      ]);
    }
}
//===============Product Search End===========================>

//===============Product Page View Start===========================>
//===============Product Page View End===========================>



}
