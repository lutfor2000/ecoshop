@extends('layouts.ecoshop')
@section('eco_title')
	Customer Login
@endsection
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
		<li class="active">Login</li>
    </ul>
	<h3>Login</h3>	
	<div class="well">
     @if (session('customer_login_erorr'))
     <div class="alert alert-danger">{{session('customer_login_erorr')}}</div>
     @endif  
	<form class="form-horizontal" action="{{route('customerloin.post')}}" method="POST" >
        @csrf
	     <div class="control-group">
            <label class="control-label" for="input_email">Email <sup>*</sup></label>
            <div class="controls">
            <input type="text" name="email" placeholder="Email"><br>
            @error('email')
              <small class="text-warning">{{$message}}</small>
            @enderror
            </div>
	     </div>

	     <div class="control-group">
            <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
            <div class="controls">
            <input type="password" name="password" placeholder="Password"><br>
            @error('password')
              <small class="text-warning">{{$message}}</small>
            @enderror
            </div>
	     </div>	  
		
	 </div>
	
     <button class="btn  btn-large btn-success" type="submit">Login</button><br><br>
     <div class="thumbnail">
       <a href="{{route('customer.register')}}">Registration Here</a>
    </div>

</form>
</div>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
@endsection