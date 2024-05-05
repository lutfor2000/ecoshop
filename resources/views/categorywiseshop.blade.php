@extends('layouts.ecoshop')
@section('body')
<div id="mainBody">
	<div class="container">
	<div class="row">
        <!-- Sidebar ================================================== -->
            @include('sidebar/sitbar')
        <!-- Sidebar End================================================== -->
		<div class="span9">		
			<div class="well well-small">
			<h4>Category Products <small class="pull-right"></small></h4>
		</div>
			  <ul class="thumbnails">
				@forelse ($category_products as $product)	
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
@endsection  