<li class="span3">
    <div class="thumbnail">
        @php
        $id =Crypt::encrypt($product->id);
        @endphp	
        <a  href="{{route('product_details',$id)}}"><img src="{{asset('uploads/product_photo/'.$product->product_photo)}}" alt="Not Found"/></a>
        <div class="caption">
        <h5>{{$product->product_name}}</h5>
        <p> 
            {{$product->product_sort_des}} 
        </p>
        
        <h4 style="text-align:center"><a class="btn" href="{{route('product_details',$id)}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{route('product_details',$id)}}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">${{$product->product_price}}.00</a></h4>
        </div>
    </div>
    </li>