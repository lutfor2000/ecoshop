<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use Image;


class CategoryController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('checkrole');
}
//===================Category Page View Start===================================>
function category(){
    $categories = Category::latest()->paginate(5);
    $category_trasheds = Category::onlyTrashed()->latest()->get(); 
    return view('category.category',compact('categories','category_trasheds'));
}
//===================Category Page View End===================================>

//===================Category date Insert Start===================================>
function categoryInsert(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_photo' => 'required',
          ],
          [
            'category_name.required' => 'Name is required',
            'category_name.uniqu' => 'Product Alredy Exists',
            'category_photo.required' => 'Photo is required',
          ]);

          $random_photo_name = Str::random(10).time().".".$request->category_photo->getClientOriginalExtension();
          $category_photo = $request->file('category_photo');
          Image::make($category_photo)->resize(160, 160)->save(base_path('public/uploads/category_photo/').$random_photo_name);
          
          Category::insert($request->except('_token','category_photo')+[
           'category_photo' =>$random_photo_name,
           'created_at' => Carbon::now(),   
          ]);

          return response()->json('File Update Successfull');
}
//===================Category date Insert End===================================>

//===================Category Item Update Start===================================>
function categoryUpdate(Request $request){
        $request->validate([
            'category_name' => 'required',
            'category_new_photo' => 'required',
            ],
            [
            'category_name.required' => 'Name is Empty',
            'category_new_photo.required' => 'Select Your Photo',
        ]);


        if ($request->hasFile('category_new_photo')){
            //Delete Old Photo Start
            $old_photo_path = base_path('public/uploads/category_photo/').Category::find($request->id)->category_photo;
            unlink($old_photo_path);
            
            //Upload New Photo Start-------------------------------------->
            $random_photo_name = Str::random(10).time().".".$request->category_new_photo->getClientOriginalExtension();
            $category_photo = $request->file('category_new_photo');
            Image::make($category_photo)->resize(160, 160)->save(base_path('public/uploads/category_photo/').$random_photo_name);
            //Upload New Photo End-------------------------------------->
            Category::where('id',$request->id)->update([
                'category_name' =>$request->category_name,
                'category_photo' =>$random_photo_name,
             ]);
           }

           return response()->json('File Update Successfull');
}
//===================Category Item Update End===================================>

//===================Category Item Delete Start===================================>
function categoryDelete(Request $request){
    Category::find($request->category_id)->delete();

    return response()->json([
        'status' => 'success',
    ]);
}
//===================Category Item All Delete End===================================>

//===================Category Item All Delete Start===================================>
// function categoryAllDelete(Request $request){
//    return $old_photo_path = base_path('public/uploads/category_photo/').Category::onlyTrashed()->sum('deleted_at');
//     unlink($old_photo_path);
//     Category::onlyTrashed('deleted_at')->forceDelete();
//     return response()->json([
//         'status' => 'success',
//     ]);
// }
//===================Category Item Delete End===================================>

//===================Category Item Restore Start===================================>
function categoryRestore(Request $request){
    Category::onlyTrashed()->where('id',$request->category_id)->restore();
    return response()->json([
        'status' => 'success',
    ]);
}
//===================Category Item Restore End===================================>

//===================Category Force Delete Start===================================>
function categoryForceDelete(Request $request){
    if (Category::onlyTrashed()->where('id',$request->category_id)->exists()){
        $old_photo_path = base_path('public/uploads/category_photo/').Category::onlyTrashed()->find($request->category_id)->category_photo;
        unlink($old_photo_path);
        Category::onlyTrashed()->where('id',$request->category_id)->forceDelete();
        }

        return response()->json([
            'status' => 'success',
        ]);
}
//===================Category Force Delete End===================================>


//===================Category Pagination Start===================================>
function categoryPagination(Request $request){
    $categories = Category::latest()->paginate(5);
    return view('pagination/category',compact('categories'))->render();
}
//===================Category Pagination End===================================>

//===================Category Item Search Start===================================>
function categorySearch(Request $request){
    $categories = Category::where('category_name','like','%'.$request->search_string.'%')
     ->orderBy('id','desc')
     ->paginate(5);
     if($categories->count() >= 1){
         return view('search_page/categorysearch',compact('categories'))->render();
     }else{
        return response()->json([
            'status' => 'nothing_found'
       ]);
     }
}
//===================Category Item Search End===================================>







//===================Category Page View Start===================================>
//===================Category Page View End===================================>
}
