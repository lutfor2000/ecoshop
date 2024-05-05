<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
        @php
        $carts = App\Models\Card::where('ip_address', request()->ip())->get();
        $subtotal = 0;
      @endphp
      @foreach ($carts as $cart)
        @php
        $subtotal += $cart->producttocart->product_price * $cart->cart_quantity;
        @endphp
      @endforeach

      @if ($carts->count())    
      <div class="well well-small"><a id="myCart" href="{{route('cart')}}"><img src="{{asset('ecoshop')}}/themes/images/ico-cart.png" alt="cart">{{$carts->count()}} Items in your cart  <span class="badge badge-warning pull-right">${{$subtotal}}.00</span></a></div>
      @else    
      <div class="well well-small"><a id="myCart" href="{{route('product_all')}}">Add Item</span></a></div>
      @endif

{{--------- Category Item Start -------}}
    @php
        $categorys = App\Models\Category::latest()->get();
    @endphp
        <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach ($categorys as $category)
        @php
        $id =Crypt::encrypt($category->id);
        @endphp
          <li><a href="{{route('categorywiseshop',$id)}}">{{strtoupper($category->category_name)}}</a></li>
        @endforeach
    </ul>
{{--------- Category Item End -------}}
    <br/>
       @php
            $random_product = App\Models\Product::inRandomOrder()->limit(3)->get();
       @endphp

       @foreach ($random_product as $product)
       @php
       $id =Crypt::encrypt($product->id);
       @endphp 
       <div class="thumbnail">
         <img src="{{asset('uploads/product_photo/'.$product->product_photo)}}" alt="Bootshop panasonoc New camera"/>
         <div class="caption">
           <h5>Panasonic</h5>
             <h4 style="text-align:center"><a class="btn" href="{{route('product_details',$id)}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{route('product_details',$id)}}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">${{$product->product_price}}.00</a></h4>
         </div>
       </div>
       @endforeach
      <br/>
        
</div>
<!-- Sidebar end=============================================== -->