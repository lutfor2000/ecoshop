@extends('layouts.otika')
@section('title')
   Category Page 
@endsection
@section('content')
<div class="col-lg-12 m-auto mt-3">
    <div class="card">
        <div class="card-header bg-info">
         Category
        </div>
        <div class="card-body">

            <div class="tabe_heat d-flex">
                 <div class="tabale_left w-50">
                    <button type="button" class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#addctegoryModal">
                        Add Item
                    </button>
                </div>

                <div class="input-group input-group-sm w-50 mb-3">
                    <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" class="form-control" placeholder="Srarch Here"  id="all_search" name="all_search" aria-describedby="basic-addon1">
                </div>  
            </div>
         
             <div id="table-data" class="text-center">
                 <table class = " tab_refe table  table-bordered text-center mb-4">
                    <div>
                     <thead>
                         <tr>
                             <th>Serial No</th>
                             <th>Name</th>
                             <th>Photo</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($categories as $category)
                         <tr>
                             <td>{{$loop->index+1}}</td>
                             <td>{{ucwords(strtolower($category->category_name))}}</td>
                             <td>
                                <img src="{{asset("uploads/category_photo/".$category->category_photo)}}" class="w-20 h-20"  alt="not found">
                             </td>
                             <td>
                             <div class="btn-group text-center ">
                                 <a type="submit" class="btn btn-sm btn-warning category_edit_btn"
                                 data-bs-toggle="modal" data-bs-target="#ctegoryUpadeModal"
                                 data-id="{{$category->id}}" 
                                 data-category_name="{{$category->category_name}}" 
                                 data-category_photo="{{$category->category_photo}}" 
                                 href = ""><i class="fa-regular fa-pen-to-square"></i></a>
                                 
                                 <a type="submit" class="btn btn-sm btn-info category_delete_btn"
                                 data-id="{{$category->id}}"
                                 href = ""><i class="fa-regular fa-trash-can"></i></a>
                             </div>
                             </td>
                         </tr> 
                         @empty
                         <tr class="text-center">
                             <td colspan="20" class="text-danger"> <small>No Data To Show</small></td>
                         </tr>
                         @endforelse
                     </tbody>
                 </table>
                 {{$categories->links('pagination::bootstrap-5')}}
            </div>
        </div>
        @include('category/categoryaddmodal')
        @include('category/categoryupdatemodal')
      </div>
</div>

<div class="col-lg-12 m-auto mt-3">
    <div class="card">
        <div class="card-header bg-info">
         Category Trush
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-sm btn-warning mb-2" id="all_delete_category">
                All Delete
            </button>
             <div  class="text-center">
                 <table class = "table table-bordered text-center mb-4" id="table-trash">
                     <thead>
                         <tr>
                             <th>Serial No</th>
                             <th>Name</th>
                             <th>Photo</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($category_trasheds as $category_trashed)
                         <tr>
                             <td>{{$loop->index+1}}</td>
                             <td>{{ucwords(strtolower($category_trashed->category_name))}}</td>
                             <td>
                                <img src="{{asset("uploads/category_photo/".$category_trashed->category_photo)}}" class="w-20 h-20"  alt="not found">
                             </td>
                             <td>
                             <div class="btn-group text-center ">
                                 <a type="submit" class="btn btn-sm btn-warning category_restore_btn"
                                 data-id="{{$category_trashed->id}}" 
                                 href = ""><i class="fa fa-undo"></i></a>
                                 
                                 <a type="submit" class="btn btn-sm btn-info category_forcedelete_btn"
                                 data-id="{{$category_trashed->id}}"
                                 href = ""><i class="fa fa-unlink"></i></a>
                             </div>
                             </td>
                         </tr> 
                         @empty
                         <tr class="text-center">
                             <td colspan="20" class="text-danger"> <small>No Data To Show</small></td>
                         </tr>
                         @endforelse
                     </tbody>
                 </table>
            </div>
        </div>
      </div>
</div>
@endsection
@section('footer_script')
 @include('ajax/categoryajax')
@endsection