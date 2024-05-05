@extends('layouts.otika')
@section('title')
   Coupon Page 
@endsection
@section('content')
<div class="col-lg-12 m-auto mt-3">
    <div class="card">
        <div class="card-header bg-info">
         Coupon
        </div>
        <div class="card-body">

            <div class="tabe_heat d-flex">
                 <div class="tabale_left w-50">
                    <button type="button" class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#addcoupontModal">
                        Add Coupon
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
                             <th>Coupon Name</th>
                             <th>Discount</th>
                             <th>Expire Date</th>
                             <th>User Limit</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($coupons as $coupon)
                         <tr>
                             <td>{{$loop->index+1}}</td>
                             <td>{{ucwords(strtolower($coupon->coupon_name))}}</td>
                             <td>{{$coupon->discount_amount}}</td>
                             <td>{{$coupon->expire_date}}</td>
                             <td>{{$coupon->uses_limit}}</td>
                             <td>
                             <div class="btn-group text-center ">
                                 <a type="submit" class="btn btn-sm btn-warning coupon_edit_btn"
                                 data-bs-toggle="modal" data-bs-target="#updatecoupontModal"
                                 data-id="{{$coupon->id}}" 
                                 data-coupon_name="{{$coupon->coupon_name}}" 
                                 data-discount_amount="{{$coupon->discount_amount}}" 
                                 data-expire_date="{{$coupon->expire_date}}" 
                                 data-uses_limit="{{$coupon->uses_limit}}" 
                                 href = ""><i class="fa-regular fa-pen-to-square"></i></a>
                                 
                                 <a type="submit" class="btn btn-sm btn-info cupon_delete_btn"
                                 data-id="{{$coupon->id}}"
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
                 {{$coupons->links('pagination::bootstrap-5')}}
            </div>
        </div>
        @include('coupon/addmodal')
        @include('coupon/updatmodal')
        
      </div>
</div>
@endsection
@section('footer_script')
 @include('ajax/couponajax')
@endsection