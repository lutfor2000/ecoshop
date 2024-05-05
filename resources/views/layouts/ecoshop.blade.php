
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('eco_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="{{asset('ecoshop/themes/bootshop/bootstrap.min.css')}}" media="screen"/>
    <link href="{{asset('ecoshop/themes/css/base.css')}}" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="{{asset('ecoshop/themes/css/bootstrap-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('ecoshop/themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
<!-- Google-code-prettify -->	
	<link href="{{asset('ecoshop/themes/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('ecoshop')}}/themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('ecoshop')}}/themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('ecoshop')}}/themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('ecoshop')}}/themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{asset('ecoshop')}}/themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome!<strong>
		@auth
		 {{ucwords(strtolower(Auth::user()->name))}}
		@else	
		<a href="{{route('customer.login')}}">Login</a>
		@endauth
	</strong></div>
	@if (App\Models\Card::where('ip_address', request()->ip())->count() != 0)
	<div class="span6">
		  @php
			  $carts = App\Models\Card::where('ip_address', request()->ip())->get();
			  $subtotal = 0;
		  @endphp
		  @foreach ($carts as $cart)
			  @php
			  $subtotal += $cart->producttocart->product_price * $cart->cart_quantity;
			  @endphp
		  @endforeach
		 <div class="pull-right">
		  <span class="btn btn-mini">${{$subtotal}}.00</span>
		  <a href="{{route('cart')}}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{App\Models\Card::where('ip_address', request()->ip())->count()}} ] Total Items</span> </a> 
		</div>
   </div>
	@endif

</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="{{route('ecoshop')}}"><img src="{{asset('ecoshop')}}/themes/images/logo.png" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="post" action="products.html" >
		<input class="customer_search" type="text" placeholder="Search Product" />
		{{-- id="srchFld" --}}
		  {{-- <select class="srchTxt">
			<option>All</option>
			<option>CLOTHES </option>
			<option>FOOD AND BEVERAGES </option>
			<option>HEALTH & BEAUTY </option>
			<option>SPORTS & LEISURE </option>
			<option>BOOKS & ENTERTAINMENTS </option>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button> --}}
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="special_offer.html">Specials Offer</a></li>
	 <li class=""><a href="normal.html">Delivery</a></li>
	 <li class=""><a href="contact.html">Contact</a></li>
	 <li class="">
	 <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login Customer</h3>
		  </div>
		  <div class="modal-body">
			@if (session('customer_login_erorr'))
			<div class="alert alert-danger">{{session('customer_login_erorr')}}</div>
			@endif 
			<form class="form-horizontal loginFrm" action="{{route('customerloin.post')}}" method="POST">
				@csrf
			  <div class="control-group">								
				<input type="text" name="email" placeholder="Email"><br>
				@error('email')
				  <small class="text-warning">{{$message}}</small>
			    @enderror
			  </div>
			  <div class="control-group">
				<input type="password" name="password" id="password_id" placeholder="Password" ><br>
				@error('password')
				  <small class="text-warning">{{$message}}</small>
			    @enderror
			  </div>

			  <div class="control-group">
				<label class="checkbox">
				<input type="checkbox" name="remember" onclick = "showPassword()"> Remember me
				</label>
				<script>
					function showPassword() {
						var x = document.getElementById("password_id");
						if (x.type === "password") {
							x.type = "text";
						}else{
							x.type = "password";
						}  
					}
				</script>
			  </div>
			  
			  <button type="submit" class="btn btn-success">Sign in</button>
			  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				   <a href="{{route('customer.register')}}">Registration</a>
			</form>		
		  </div>
	</div>
	</li>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->
 
@yield('body')

<!-- Footer ================================================================== -->
<div id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>  
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.html">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="{{asset('ecoshop')}}/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="{{asset('ecoshop')}}/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="{{asset('ecoshop')}}/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Bootshop</p>
	</div><!-- Container End -->
	</div>
    
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="{{asset('ecoshop')}}/themes/js/jquery.js" type="text/javascript"></script>
	<script src="{{asset('ecoshop')}}/themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{asset('ecoshop')}}/themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="{{asset('ecoshop')}}/themes/js/bootshop.js"></script>
    <script src="{{asset('ecoshop')}}/themes/js/jquery.lightbox-0.5.js"></script>
	{{-- @yield('footer_section') --}}
    @include('ajax/fontendajax')
	
	
<span id="themesBtn"></span>
</body>
</html>