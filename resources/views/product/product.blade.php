@extends('layouts.otika')
@section('title')
   Product Page 
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
                    <button type="button" class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#addproductModal">
                        Add Item
                    </button>
                </div>

                {{-- <div class="input-group input-group-sm w-50 mb-3">
                    <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" class="form-control" placeholder="Srarch Here"  id="search" name="all_search" aria-describedby="basic-addon1">
                </div>   --}}
            </div>
         
             <div id="table-data" class="text-center">
                 <table class = " table  table-bordered text-center mb-4">
                    <div>
                     <thead>
                         <tr>
                             <th>Serial No</th>
                             <th>Category</th>
                             <th>Name</th>
                             <th>Sort Desc</th>
                             <th>Price</th>
                             <th>Quantity</th>
                             {{-- <th>Brand</th> --}}
                             <th>Photo</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($products as $product)
                         <tr>
                             <td>{{$loop->index+1}}</td>
                             <td>
                                @if ($product->producttocaregoryrle)
                                {{ucwords(strtolower($product->producttocaregoryrle->category_name))}}
                                @else
                                  <small class="text-danger">Empty Category</small>
                                @endif
                             </td>
                             <td>{{ucwords(strtolower($product->product_name))}}</td>
                             <td>{{$product->product_sort_des}}</td>
                             <td>{{$product->product_price}}</td>
                             <td>{{$product->product_quantity}}</td>
                             {{-- <td>{{$product->product_model}}</td> --}}
                             
                             <td>
                                <img src="{{asset("uploads/product_photo/".$product->product_photo)}}" class="w-20 h-20"  alt="not found">
                             </td>
                             <td>
                             <div class="btn-group text-center ">
                                 <a type="submit" class="btn btn-sm btn-warning product_edit_btn"
                                 data-bs-toggle="modal" data-bs-target="#updateproductModal"
                                 data-id="{{$product->id}}" 
                                 data-category_id="{{$product->category_id}}" 
                                 data-product_name="{{$product->product_name}}" 
                                 data-product_sort_des="{{$product->product_sort_des}}" 
                                 data-product_price="{{$product->product_price}}" 
                                 data-product_quantity="{{$product->product_quantity}}" 
                                 data-product_alert_quantity="{{$product->product_alert_quantity}}" 
                                 data-product_model="{{$product->product_model}}" 
                                 data-product_description="{{$product->product_description}}" 
                                 href = ""><i class="fa-regular fa-pen-to-square"></i></a>
                                 
                                 <a type="submit" class="btn btn-sm btn-info product_delete_btn"
                                 data-id="{{$product->id}}"
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
                 {{$products->links('pagination::bootstrap-5')}}
            </div>
        </div>
        @include('product/addmodal')
        @include('product/updatemodal')
        
      </div>
</div>
@endsection
@section('footer_script')
 @include('ajax/productajax')
@endsection