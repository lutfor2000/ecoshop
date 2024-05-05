@extends('layouts.otika')

@section('content')
<div class="container">
    <div class="row">
          <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header bg-info text-light">Profile Photo Upload</div>
                <div class="card-body" id="card_body">
                     

                     
                      {{-- Erorr Message Start --}}
                      <span id="profile_error" class="alert text-danger"></span>
                      {{-- Erorr Message End --}}
                    
                    <form id="profile_from" >
                        @csrf
                        <input type="hidden" value="{{$profiles->id}}" name="id">
                        <input type="hidden" value="{{$profiles->user_photo}}" name="user_photo">
                        <div class="form-group mt-3 text-center">
                            <img src="{{asset('uploads/user_photo/'.$profiles->user_photo)}}"  width="100" alt="Not found" >
                         </div>

                         <div class="form-group mt-3">
                            <label >Profile Name</label>
                            <input type="text" class="form-control p-2" name="name" value="{{$profiles->name}}">
                            {{-- @error('user_photo')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="form-group mt-3">
                            <label >Email</label>
                            <input type="text" class="form-control p-2" name="email" value="{{$profiles->email}}">
                            {{-- @error('user_photo')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>

                         <div class="form-group mt-3">
                            <label >Profile Photo</label>
                            <input type="file" class="form-control p-2" name="user_photo" required>
                            {{-- @error('user_photo')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}
                         </div>
                         <div class="btn-group  mt-3">
                         <button type="submit" class="btn btn-info">Add Now</button>
                         </div>
                     </form>


                </div>
            </div>
          </div>
    </div>
</div>
@endsection
@section('footer_script')
 @include('ajax/profileajax')
@endsection