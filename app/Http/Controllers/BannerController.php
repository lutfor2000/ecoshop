<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use Carbon\Carbon;
use Image;

class BannerController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('checkrole');
}
//===========================Banner Page View Start==========================================>
function Banner(){
    $banners = Banner::latest()->paginate(5);
    return view('banner.index',compact('banners'));
}
//===========================Banner Page View End==========================================>

//===========================Banner Page View Start==========================================>
function bannerpost(Request $request){
    $request->validate([    
        'banner_photo'=>'required',     
        'banner_title'=>'required',     
        'banner_desc'=>'required',     
    ]);

   $random_photo_name = Str::random(10).time().".".$request->banner_photo->getClientOriginalExtension();
   $banner_photo = $request->file('banner_photo');
   Image::make($banner_photo)->resize(1170, 480)->save(base_path('public/uploads/banner_photo/').$random_photo_name);
   
   Banner::insert($request->except('_token','banner_photo')+[
    'banner_photo' =>$random_photo_name,
    'created_at' => Carbon::now(),   
   ]);
   return back()->with('banner_success_mess','Banner Added Successfull');

}
//===========================Banner Page View End==========================================>

//===========================Banner Update Start==========================================>
function bannerUpdate(Request $request){
    $request->validate([    
        'banner_photo'=>'required',     
        'banner_title'=>'required',     
        'banner_desc'=>'required',     
    ]);


    if ($request->hasFile('banner_new_photo')){
        //Delete Old Photo Start
        $old_photo_path = base_path('public/uploads/banner_photo/').Banner::find($request->id)->banner_photo;
        unlink($old_photo_path);
        
        //Upload New Photo Start-------------------------------------->
        $random_photo_name = Str::random(10).time().".".$request->banner_new_photo->getClientOriginalExtension();
        $banner_photo = $request->file('banner_new_photo');
        Image::make($banner_photo)->resize(1170, 480)->save(base_path('public/uploads/banner_photo/').$random_photo_name);
        //Upload New Photo End-------------------------------------->
        Banner::where('id',$request->id)->update([
            'banner_title' =>$request->banner_title,
            'banner_desc' =>$request->banner_desc,
            'banner_photo' =>$random_photo_name,
       ]);
       }
      Banner::where('id',$request->id)->update([
        'banner_title' =>$request->banner_title,
        'banner_desc' =>$request->banner_desc,
        
      ]);

      return response()->json('File Update Successfull');
}
//===========================Banner Update End==========================================>

//===========================Banner Item Delete Start==========================================>
function bannerDelete(Request $request){
    if (Banner::where('id',$request->banner_id)->exists()) {
        $old_photo_path = base_path('public/uploads/banner_photo/').Banner::find($request->banner_id)->banner_photo;
        unlink($old_photo_path);
        Banner::find($request->banner_id)->delete();
    } 
    return response()->json([
        'status' => 'success',
    ]);
}
//===========================Banner Item Delete End==========================================>

//===========================Banner Item Search Start==========================================>
function bannerSearch(Request $request){
    $banners = Banner::where('banner_title','like','%'.$request->search_string.'%')
       ->orWhere('banner_desc','like','%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        if($banners->count() >= 1){
            return view('search_page/bannersearch',compact('banners'))->render();
        }else{
            return response()->json([
                 'status' => 'nothing_found'
            ]);
        }
}
//===========================Banner Item Search End==========================================>

//===========================Banner Page View Start==========================================>
//===========================Banner Page View End==========================================>
//===========================Banner Page View Start==========================================>
//===========================Banner Page View End==========================================>
}
