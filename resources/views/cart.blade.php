@extends('layouts.ecoshop')
@section('body')
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
     @include('sidebar/sitbar')
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{route('ecoshop')}}">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>{{$carts->count()}} Item(s) </small>]<a href="{{route('ecoshop')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	<form action="{{route('cardupdate')}}" method="POST">
		@csrf
	    <table class="table table-bordered card_table">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
                  <th>Avaiable Stock</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
				@php
					 $subtotal = 0;
				@endphp
                @forelse ($carts as $cart)
                 <tr>
                <td> <img width="60" src="{{asset('uploads/product_photo/'.$cart->producttocart->product_photo)}}" alt="Not Photo"/></td>
                    <td class="p-2">{{$cart->producttocart->product_name}}</td>
                    <td>
                      <div class="input-append"><input type="number" name="cart_quantity[{{$cart->id}}]" class="span1" value="{{$cart->cart_quantity}}"><a class="btn btn-danger" id="carddelete"  data-id="{{$cart->id}}" type="submit"><i class="icon-remove icon-white"></i></a></div>
                    </td>
                    <td>${{$cart->producttocart->product_price}}</td>
                    <td><span class="badge badge-info">Stock:{{$cart->producttocart->product_quantity}}</span></td>
                    <td>${{$cart->producttocart->product_price *$cart->cart_quantity }}.00</td>
					@php
						$subtotal += ($cart->producttocart->product_price * $cart->cart_quantity);
					@endphp
                  </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-danger">
                            Not Product Show
                        </td>
                    </tr>
                @endforelse
				<tr>
					<td colspan="5" style="text-align:right">Total Price:</td>
					<td> ${{$subtotal}}.00</td>
				  </tr>
				<tr>
					<td colspan="5" style="text-align:right">Discount:</td>
					<td>{{$coupon_discount}}%</td>
			    </tr>
				<tr>
					<td colspan="5" style="text-align:right">Discount(Total):</td>
					<td>${{($coupon_discount/100) * $subtotal}}.00</td>
			    </tr>
				 <tr>
					<td colspan="5" style="text-align:right"><strong>TOTAL:</strong></td>
					<td> ${{$subtotal-(($coupon_discount/100) * $subtotal)}}.00</td>
				  </tr>
					@php
					   session([
						'session_coupon_name' => $coupon_name,
						'session_discount' => $coupon_discount,
						'session_subtotal' => $subtotal,
						'total_discount' => ($coupon_discount/100) * $subtotal,
						'session_total' => $subtotal - (($coupon_discount/100) * $subtotal),
						]);
					@endphp
				</tbody>
            </table>
		
		
            <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<form class="form-horizontal">
				<div class="control-group">
				<label class="control-label"><strong> COUPON CODE: </strong> </label>
				<div class="control-group">
				<input type="text" class="input-medium"  placeholder="Coupon Code" id="coupon_input">
				<button type="button" class="btn" id="apply_coupon_btn">APPLY</button>
				</div>
				  @if (session('coupon_errors'))
					<span class="alert text-danger">{{session('coupon_errors')}}</span>
				  @endif
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table>
	<button type="submit" class="btn btn-large"><i class="icon-arrow-left"></i> Update </button>
	@if ($carts->count())
	<a href="{{route('checkout')}}" class="btn btn-large pull-right">CHECKOUT <i class="icon-arrow-right"></i></a>
	@else
	<a href="{{route('product_all')}}" class="btn btn-large pull-right">ADD CART ITEM <i class="icon-arrow-right"></i></a>
	@endif
</form>
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
@endsection
{{-- @section('footer_section')
@include('ajax/cardallajax')	
@endsection --}}