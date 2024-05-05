<div class="container">
    <div class="row justify-content-center">
         <div class="col-lg-12">
             <div class="card">
                <div class="card-header bg-info">Customer Dashboard</div>
                <div class="card-body">
                  @if (session('customer_mess'))
                  <div class="alert alert-danger">{{session('customer_mess')}}</div>
                  @endif
                  @if (session('order_status'))
                  <div class="alert alert-success">{{session('order_status')}}</div>
                  @endif
                    <table class = "table table-bordered text-center">
                        <thead>
                           <tr>
                              <th>Serial No</th>
                              <th>Customer Name</th>
                              <th>Phone Number</th>
                              <th>City Name</th>
                              <th>Address</th>
                              <th>Total</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                        <tr>
                           <td>{{$loop->index+1}}</td>
                           <td>{{$order->customer_name}}</td>
                           <td>{{$order->customer_phone}}</td>
                           <td>{{$order->city_name}}</td>
                           <td>{{$order->customer_address}}</td>
                           <td>{{$order->total}}</td>
                           <td>
                              <div class="btn-group text-center ">
                                 @php
                                   $id =Crypt::encrypt($order->id);
                                 @endphp
                                 <a href="{{route('customer.edit',$id)}}" class="btn btn-sm btn-outline-info"> <i class="fa-regular fa-pen-to-square"></i></a>
                                 <a href="{{route('customerdelete',$id)}}" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash"></i></a>
                              </div>
                           </td>
                        </tr> 
                        @endforeach
                        </tbody>
                   </table>
                </div>
             </div>
         </div>
    </div>
</div>