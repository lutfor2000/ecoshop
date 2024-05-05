@extends('layouts.otika')
@section('title')
  Order Update
@endsection
@section('content')
<div class="col-lg-6 m-auto mt-3">
    <div class="card">
        <div class="card-header bg-info">
         Order Edit
        </div>
        <div class="card-body">
            @php
                $id =Crypt::encrypt($orders->id);
            @endphp
            <form action="{{route('customer.update',$id)}}" method="POST">
                @csrf
                 <div class="form-group mt-3">
                    <label >Name</label>
                    <input type="text" class="form-control" name="customer_name" value="{{$orders->customer_name}}">
                    @error('customer_name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>
               
                 <div class="form-group mt-3">
                    <label >Phone Number</label>
                    <input type="number" class="form-control" name="customer_phone" value="{{$orders->customer_phone}}">
                    @error('customer_phone')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>
               
                 <div class="form-group mt-3">
                    <label >Country Name</label>
                    <input type="text" class="form-control" name="country_name" value="{{$orders->country_name}}">
                    @error('country_name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>
               
                 <div class="form-group mt-3">
                    <label >City Name</label>
                    <input type="text" class="form-control" name="city_name" value="{{$orders->city_name}}">
                    @error('city_name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>
                   
                 <div class="form-group mt-3">
                    <label >Post Code</label>
                    <input type="text" class="form-control" name="customer_postcode" value="{{$orders->customer_postcode}}">
                    @error('customer_postcode')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                 </div>
                   
                 <div class="from-group mb-3">
                    <label>Address</label>
                    <textarea class="form-control pt-5 pb-5" name="customer_address" rows="4">{{$orders->customer_address}}</textarea>
                    @error('customer_address')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
               
                 <div class="btn-group  mt-3">
                 <button type="submit" class="btn btn-primary">Update Now</button>
                 </div>
             </form>
            
        </div>
      </div>
</div>
@endsection
