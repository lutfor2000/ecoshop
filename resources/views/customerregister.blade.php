@extends('layouts.ecoshop')
@section('eco_title')
	Customer Registration
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
		<li class="active">Registration</li>
    </ul>
	<h3> Registration</h3>	
	<div class="well">
        @if (session('customer_registar_message'))
        <div class="alert alert-success">{{session('customer_registar_message')}}</div>
        @endif
	<form class="form-horizontal" action="{{route('customerregistar.post')}}" method="POST" >
        @csrf
		 <div class="control-group">
            <label class="control-label" for="inputFname1">Your Name <sup>*</sup></label>
            <div class="controls">
            <input type="text" name="name" placeholder="Your Name"><br>
            @error('name')
				<small class="text-warning">{{$message}}</small>
			@enderror
            </div>
		 </div>

	     <div class="control-group">
            <label class="control-label" for="input_email">Email <sup>*</sup></label>
            <div class="controls">
            <input type="email" name="email" placeholder="Email"><br>
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

	     <div class="control-group">
            <label class="control-label" for="inputPassword1">Confirm Password <sup>*</sup></label>
            <div class="controls">
            <input type="password" name="password" placeholder="Confirm Password">
            </div>
	     </div>	  
	 </div>
	
     <button class="btn  btn-large btn-success" type="submit">Register</button><br><br>
     <div class="thumbnail">
      <p> <strong> <a href="{{route('customer.login')}}">Login Here</a></strong></p>
     </div>
    
</form>
</div>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
@endsection