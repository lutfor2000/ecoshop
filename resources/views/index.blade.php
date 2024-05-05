@extends('layouts.ecoshop')

@section('body')   
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			
           @foreach ($banners as $banner)
		   <div class="item ">
			<div class="container">
			  <a href="register.html"><img style="width:100%" src="{{asset('uploads/banner_photo/'.$banner->banner_photo)}}" alt="special offers"/></a>
			  <div class="carousel-caption">
					<h4>Second Thumbnail label</h4>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				  </div>
			</div>
		  </div>
		   @endforeach

		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
        @include('sidebar/sitbar')
<!-- Sidebar end=============================================== -->
		<div class="span9">		
			<div class="well well-small">
			<h4>Latest Products <small class="pull-right"></small></h4>
		</div>
		<div class="coustomer_search">

			<ul class="thumbnails">
			  @forelse ($products as $product)
				  @include('letter_part/product_part')
			  @empty
				<li class="text-center d-block">
				   <span class="text-danger">Product Not Found</span>
				</li>	
			  @endforelse
			  
			</ul>	
		</div>

		</div>
		</div>
	</div>
</div>


@endsection