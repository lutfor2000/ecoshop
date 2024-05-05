<ul class="thumbnails">
    @forelse ($products as $product)	
        @include('letter_part/product_part')
    @empty
      <li class="text-center d-block">
         <span class="text-danger">Product Not Found</span>
      </li>	
    @endforelse
    
  </ul>	