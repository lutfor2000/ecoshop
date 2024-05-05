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