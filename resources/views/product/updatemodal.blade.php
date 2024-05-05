<div class="modal fade" id="updateproductModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form  id="productupdatefrom" method="POST" >
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="addModalLabel">Product Edite</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- Erorr Message Start --}}
                   <div class="mb-3"><span id="up_error" class="alert text-danger"></span></div>
                {{-- Erorr Message End --}}

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Category Name</label>
                      <select class="form-control"  name="category_id" id="category_id">
                            <option value="">---Choose One---</option>
                        @if ($products->count())
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{($product->category_id == $category->id) ? 'selected' : '' }}>{{ucwords(strtolower($category->category_name))}}</option>
                            @endforeach
                        @endif
                      </select>
                     
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Name</label>
                      <input type="text" class="form-control" name="product_name" id="product_name" >
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Name</label>
                      <input type="text" class="form-control" name="product_sort_des" id="product_sort_des" >
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Price</label>
                      <input type="text" class="form-control" name="product_price" id="product_price" >
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Quantity</label>
                      <input type="text" class="form-control" name="product_quantity" id="product_quantity">
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Alert Quantity</label>
                      <input type="text" class="form-control" name="product_alert_quantity" id="product_alert_quantity">
                  </div>

                  
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Model</label>
                      <input type="text" class="form-control" name="product_model" id="product_model">
                    </div>

                    <div class="from-group mb-3">
                        <label for="name" class="mb-2">Discription</label>
                        <textarea class="form-control pt-5 pb-5" name="product_description"  id="product_description" rows="4"></textarea>
                    </div>

                    <div class="from-group mb-3">
                        <label for="price" class="mb-2">Product Photo</label>
                        <input type="file"  class="form-control text-center p-2" name="product_new_photo" >
                    </div> 

                    {{-- <div class="from-group mb-3">
                        <label for="price" class="mb-2">Product Feature Photo</label>
                        <input type="file"  class="form-control text-center p-2" name="product_feature_photo[]" multiple>
                    </div> --}}

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Upload</button>
              </div>
            </div>
          </div>
    </form>
</div>