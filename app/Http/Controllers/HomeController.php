<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Order_details;
use App\Models\Order;
use App\Models\User;

use Carbon\Carbon;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
//============User Page View Start================================>
    public function index(){
        $users = User::latest()->paginate(5);
        $user_trashs = User::onlyTrashed()->latest()->get();
        $orders = Order::latest()->get();
        return view('home',compact('users','orders','user_trashs'));
    }
//============User Page View End================================>

//============User Profile View Start================================>
   function Profile($user_id){
      $user_id = Crypt::decrypt($user_id);
      $profiles =User::find($user_id);
      return view('profile.index',compact('profiles'));
   }
//============User Profile View End================================>

//============User Profile Update Start================================>
   function ProfileUpdate(Request $request){
          $request->validate([
             'user_photo' => 'required',
             'name' => 'required',
             'email' => 'required',
          ]);

          if (User::find($request->id)->user_photo != "default.jpg"){
            $old_photo_path = base_path('public/uploads/user_photo/').User::find($request->id)->user_photo;
            unlink($old_photo_path);
            
            $random_photo_name = Str::random(10).time().".".$request->user_photo->getClientOriginalExtension();
            $user_photo = $request->file('user_photo');
            Image::make($user_photo)->resize(350, 350)->save(base_path('public/uploads/user_photo/').$random_photo_name);
             
            User::find($request->id)->update([
                'user_photo' =>$random_photo_name,
                'name' =>$request->name,
                'email' =>$request->email,
           ]);
           
            }else{
            
            $random_photo_name_two = Str::random(10).time().".".$request->user_photo->getClientOriginalExtension();
            $user_photo = $request->file('user_photo');
            Image::make($user_photo)->resize(350, 350)->save(base_path('public/uploads/user_photo/').$random_photo_name_two);
            
            User::find($request->id)->update([
                'user_photo' =>$random_photo_name_two,
                'name' =>$request->name,
                'email' =>$request->email,
           ]);
        
        }

        return response()->json('File Update Successfull');


   }
//============User Profile Upade End================================>

//============User Profile Delete End================================>
   function ProfileDelete(Request $request){
      if (User::where('id',$request->user_id)->exists()) {
         User::find($request->user_id)->delete();
   } 
   return response()->json([
         'status' => 'success',
   ]);
   }
//============User Profile Delete End================================>

//============User Profile Restore Start================================>
   function ProfileRestore(Request $request){
      User::onlyTrashed()->where('id',$request->user_id)->restore();
      return response()->json([
         'status' => 'success',
      ]);
   }
//============User Profile Restore End================================> 

//============User Profile Force Delete Start================================>
   function ProfileForcedelete(Request $request){
      if (User::onlyTrashed()->where('id',$request->user_id)->exists()){
         $old_photo_path = base_path('public/uploads/user_photo/').User::onlyTrashed()->find($request->user_id)->user_photo;
         unlink($old_photo_path);
         User::onlyTrashed()->where('id',$request->user_id)->forceDelete();
         }
 
         return response()->json([
             'status' => 'success',
         ]);
}
//============User Profile Force Delete End================================>

//============User Profile User Search Start================================>
   function userSearch(Request $request){
      $users = User::where('name','like','%'.$request->search_string.'%')
      ->orWhere('email','like','%'.$request->search_string.'%')
      ->orderBy('id','desc')
      ->paginate(5);
      if($users->count() >= 1){
         return view('search_page/usersearch',compact('users'))->render();
      }else{
         return response()->json([
            'status' => 'nothing_found'
      ]);
      }
   }
//============User Profile User Search End================================>

//============User Profile User Pagination End================================>
function userPagination(Request $request){
   $users = User::latest()->paginate(5);
   return view('search_page/usersearch',compact('users'))->render();
}
//============User Profile User Pagination End================================>

//============Customer Delete Start================================>
   function customerDelete($order_id){
        $order_id = Crypt::decrypt($order_id);
        Order::find($order_id)->delete();
        Order_details::where('order_id',$order_id)->delete();
        return back()->with('customer_mess','Order Delete Successfull!');
   } 
//============Customer Delete End================================>

//============Customer Edit Start================================>
   function customerEdit ($order_id){
      $order_id = Crypt::decrypt($order_id);
      $orders = Order::find($order_id);
      return view('dashboard/update',compact('orders'));
      
   } 
//============Customer Edit End================================>

//============Customer Update Start================================>
   function customerUpdate (Request $request,$order_id){
         $order_id = Crypt::decrypt($order_id);
         $request->validate([
            'customer_name'=>'required',     
            'customer_phone'=>'required',     
            'country_name'=>'required',     
            'city_name'=>'required',     
            'customer_postcode'=>'required',     
            'customer_address'=>'required',         
         ]);
         Order::find($order_id)->update($request->except('_token'));
         return redirect('home')->with('order_status','Order Update Successfull');
   } 
//============Customer Update End================================>

//============User Page View Start================================>
//============User Page View End================================>

}
