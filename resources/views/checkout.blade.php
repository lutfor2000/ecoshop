@extends('layouts.ecoshop')
@section('eco_title')
	Checkout
@endsection
@section('body')
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
     @include('sidebar/sitbar')
<!-- Sidebar end=============================================== -->
   @auth
		@if (Auth::user()->role == 2)
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="index.html">Home</a> <span class="divider">/</span></li>
					<li class="active">Check Out</li>
				</ul>
				<h3>Logged As ({{Auth::user()->name}})</h3>	
				<hr class="soft"/>
					@if (session('checkout_status'))
					<div class="alert alert-success">{{session('checkout_status')}}</div>
					@endif
				<form action="{{route('checkoutpost')}}">
						<div class="row">
						<div class="span3">
							<div class="well">
							<h4>YOUR ORDERS</h4><br/>
				
							<div class="control-group">
								<ul id="sideManu" class="nav nav-tabs ">
									<li><label class="control-label">Coupon Name : <strong>{{session('session_coupon_name')}}</strong></label></li>
								</ul>
								<ul id="sideManu" class="nav nav-tabs ">
									<li><label class="control-label">Discount :  <strong>{{session('session_discount')}}(%)</strong></label></li>
								</ul>
								<ul id="sideManu" class="nav nav-tabs ">
									<li><label class="control-label">Total Discount : <strong> ${{session('total_discount')}}.00</strong></label></li>
								</ul>
								<ul id="sideManu" class="nav nav-tabs ">
									<li><label class="control-label">Sub Total : <strong>${{session('session_subtotal')}}.00</strong></label></li>
								</ul>
								<ul id="sideManu" class="nav nav-tabs ">
									<li><label class="control-label"> <strong>TOTAL : ${{session('session_total')}}.00</strong></label></li>
								</ul>
							</div>
						</div>
						</div>
						<div class="span1"> &nbsp;</div>
						<div class="span6">
							<div class="well">
							<h4>ORDER DETAILS</h4>
							<div class="control-group">
								<label class="control-label">Customer Name</label>
								<div class="controls">
								<input class="span3" value="{{Auth::user()->name}}" name="customer_name" type="text"  placeholder="Name..."><br>
								@error('customer_name')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
								<input type="email" value="{{Auth::user()->email}}" name="customer_email" class="span3" placeholder="Email..."><br>
								@error('customer_email')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">Phone Number</label>
								<div class="controls">
									<input type="number" class="span3" name="customer_phone" placeholder="Phone..."><br>
									@error('customer_phone')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">Country</label>
								<div class="controls">
									<select  class="span3" name="country_name">
										<option>----Select Country----</option>
										<option value="bangladesh">Bangladesh </option>
										<option value="nepal"> Nepal </option>
										<option value="vuthan"> Vuthan </option>
									</select><br> 
									@error('country_name')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">City</label>
								<div class="controls">
									<select class="span3" name="city_name">
										<option>----Select City----</option>
										<option value="rangpur">Rangpur </option>
										<option value="dhaka"> Dhaka </option>
										<option value="khulna"> Khulna </option>
										<option value="borisahal"> Borishal </option>
										<option value="chottogram"> Chottogram </option>
										<option value="sylhet"> Sylhet </option>
									</select> <br>
									@error('city_name')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">Post Code</label>
								<div class="controls">
								<input type="text" class="span3" name="customer_postcode" placeholder="Postcode..."><br>
									@error('customer_postcode')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>
				
							<div class="control-group">
								<label class="control-label">Address</label>
								<div class="controls">
									<textarea name="customer_address"  class="span3" cols="4" rows="3" placeholder="Enter Address..." ></textarea><br>
									@error('customer_address')
											<small class="text-warning">{{$message}}</small>
									@enderror
								</div>
							</div>

							<ul class="nav text-center" id="sideManu" >                            
									<li>
										<label for="card">Credit Card</label>
										<input id="card" type="radio" name="payment_option" value="1" checked>
									</li><br>
									<li>
										<label for="delivery">Cash on Delivery</label>
										<input id="delivery" type="radio" name="payment_option" value="2">
									</li>
								</ul>
									
							<div class="control-group">
								<div class="controls">
								<button type="submit" class="btn btn-warning">ORDER CONFORM</button>
								</div>
							</div>
						</div>
						</div>
					</div>	
				</form>
			</div>
		@else
			<div class="span9">
				<div class="control-group">
					<h2 class="text-warning">You are admin, You can not Chackut</h2>
				</div>
			</div>
		@endif  
   @else
		<div  class="span9">
			<div class="control-group">
				<h2 class="text-danger">You are not Logged</h2>
				<h5 class="mb-2">If you already have an account -> <a class="text-info" href="{{route('customer.login')}}">Login Here</a></h5>
				<h5>To open new account -> <a class="text-info" href="{{route('customer.register')}}">Registration Here</a></h5>
			</div>
		</div>
   @endauth

</div>
</div>
</div>
<!-- MainBody End ============================= -->

    @endsection