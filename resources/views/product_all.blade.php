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
    </ul>	
	<hr class="soft"/>
	<form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
			<select>
              <option>Priduct name A - Z</option>
              <option>Priduct name Z - A</option>
              <option>Priduct Stoke</option>
              <option>Price Lowest first</option>
            </select>
		</div>
	  </form>
	  
{{-- <div id="myTab" class="pull-right">
 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div> --}}
<br class="clr"/>
<div class="tab-content">
	
	<div class="tab-pane  active" id="blockView">
		<div class="coustomer_search">
			<ul class="thumbnails">
				@foreach ($product_all as $product)
					@include('letter_part/product_part')
				@endforeach
				
			  </ul>
		</div>
	<hr class="soft"/>
	</div>
</div>

	{{-- <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
	<div class="pagination">
			<ul>
			<li><a href="#">&lsaquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">...</a></li>
			<li><a href="#">&rsaquo;</a></li>
			</ul>
			</div> --}}
			<br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
    
@endsection