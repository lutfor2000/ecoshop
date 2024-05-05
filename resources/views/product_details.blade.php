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
    <li><a href="{{route('product_all')}}">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>	
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="{{asset('uploads/product_photo/'.$product_info->product_photo)}}" title="Fujifilm FinePix S2950 Digital Camera">
				<img src="{{asset('uploads/product_photo/'.$product_info->product_photo)}}" style="width:100%" alt="Fujifilm FinePix S2950 Digital Camera"/>
            </a>
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                     @foreach (App\Models\Feature_photo::where('product_id',$product_info->id)->get() as $Featured_photo)
                       <a href="{{asset('uploads/product_featured_photo/'.$Featured_photo->product_feature_photo)}}"> <img style="width:29%" src="{{asset('uploads/product_featured_photo/'.$Featured_photo->product_feature_photo)}}" alt="no Photo"/></a>
                     @endforeach
                    </div>
                </div>
              <!--  
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  -->
              </div>
			  
			 <div class="btn-toolbar">
			  <div class="btn-group">
				<span class="btn"><i class="icon-envelope"></i></span>
				<span class="btn" ><i class="icon-print"></i></span>
				<span class="btn" ><i class="icon-zoom-in"></i></span>
				<span class="btn" ><i class="icon-star"></i></span>
				<span class="btn" ><i class=" icon-thumbs-up"></i></span>
				<span class="btn" ><i class="icon-thumbs-down"></i></span>
			  </div>
			</div>
			</div>
			<div class="span6">
				<h3>{{$product_info->product_name}} </h3>
				<small>({{$product_info->product_sort_des}})</small>
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm" action="{{route('addtocard',$product_info->id)}}" method="POST">
					@csrf
				  <div class="control-group">
					<label class="control-label"><span>${{$product_info->product_price}}</span></label>
					<div class="controls">
					<input type="number" name="cart_quantity" class="span1" placeholder="Qty"/>
						@error('cart_quantity')
						<small class="text-warning">{{$message}}</small>
						@enderror
					  <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
				  </div>
				</form>
				
				<hr class="soft"/>
				<h4>{{$product_info->product_quantity}} items in stock</h4>
				@if (session('error'))
				<small class="alert text-danger">{{session('error')}}</small>
				@endif
				<hr class="soft clr"/>
				<p>
				 {{$product_info->product_description}}
				</p>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
              <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Product Name: </td><td class="techSpecTD2">{{$product_info->product_name}}</td></tr>
                @if ($product_info->producttocaregoryrle)  
				<tr class="techSpecRow"><td class="techSpecTD1">Category: </td><td class="techSpecTD2">{{$product_info->producttocaregoryrle->category_name}}</td></tr>
                @endif
				<tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">{{$product_info->product_model}}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">description:</td><td class="techSpecTD2">{{$product_info->product_sort_des}}</td></tr>
				
				</tbody>
				</table>
				
				<h5>Features</h5>
				<p>
			      {{$product_info->product_description}}
				</p>
              </div>
		<div class="tab-pane fade" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane" id="listView">

			@foreach ($releted_products as $product)
			@php
			$id =Crypt::encrypt($product->id);
			@endphp	
			<hr class="soft"/>
			<div class="row">	  
					<div class="span2">
					<img src="{{asset('uploads/product_photo/'.$product->product_photo)}}" alt="Not Photo"/>
					</div>
					<div class="span4">
						<h3>New | Available</h3>				
						<hr class="soft"/>
						  <h5>{{$product->product_name}}</h5>
						<p>
							{{$product->product_description}}
						</p>
						<a class="btn btn-small pull-right" href="{{route('product_details',$id)}}">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
					<form class="form-horizontal qtyFrm">
					<h3> ${{$product->product_price}}.00</h3>
					<label class="checkbox">
						<input type="checkbox">  Adds product to compair
					</label><br/>
			     <div class="btn-group">
					
				  <a href="{{route('product_details',$id)}}" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
				  <a href="{{route('product_details',$id)}}" class="btn btn-large"><i class="icon-zoom-in"></i></a>
				 </div>
				</form>
				</div>
			</div>
			@endforeach
			{{-- <hr class="soft"/>
			<div class="row">	  
					<div class="span2">
					<img src="{{asset('ecoshop')}}/themes/images/products/7.jpg" alt=""/>
					</div>
					<div class="span4">
						<h3>New | Available</h3>				
						<hr class="soft"/>
						<h5>Product Name </h5>
						<p>
						Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - 
						that is why our goods are so popular..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
						<h3> $222.00</h3>
						<label class="checkbox">
						<input type="checkbox">  Adds product to compair
						</label><br/>
						<div class="btn-group">
						<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
						<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
						</div>
						</form>
					</div>
			</div>
			
			<hr class="soft"/>
			<div class="row">	  
					<div class="span2">
					<img src="{{asset('ecoshop')}}/themes/images/products/8.jpg" alt=""/>
					</div>
					<div class="span4">
						<h3>New | Available</h3>				
						<hr class="soft"/>
						<h5>Product Name </h5>
						<p>
						Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - 
						that is why our goods are so popular..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
						<h3> $222.00</h3>
						<label class="checkbox">
						<input type="checkbox">  Adds product to compair
						</label><br/>
						<div class="btn-group">
						<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
						<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
						</div>
						</form>
					</div>
			</div>
			<hr class="soft"/>
				<div class="row">	  
					<div class="span2">
					<img src="{{asset('ecoshop')}}/themes/images/products/9.jpg" alt=""/>
					</div>
					<div class="span4">
						<h3>New | Available</h3>				
						<hr class="soft"/>
						<h5>Product Name </h5>
						<p>
						Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - 
						that is why our goods are so popular..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
						<h3> $222.00</h3>
						<label class="checkbox">
						<input type="checkbox">  Adds product to compair
						</label><br/>
						<div class="btn-group">
						<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
						<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
						</div>
						</form>
					</div>
			</div>
			<hr class="soft"/> --}}
		</div>
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
                    @forelse ($releted_products as $product)	
					  @include('letter_part/product_part')
                    @empty
					<li class="text-center d-block">
						<span class="text-danger">Product Not Found</span>
					</li>
                    @endforelse


				  </ul>
			<hr class="soft"/>
			</div>
		</div>
				<br class="clr">
					 </div>
		</div>
          </div>

	</div>
</div>
</div> </div>
</div>
<!-- MainBody End ============================= --> 
@endsection