<div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form  id="productfrom" method="POST" >
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="addModalLabel">Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- Erorr Message Start --}}
                   <div class="mb-3"><span id="error" class="alert text-danger"></span></div>
                {{-- Erorr Message End --}}

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Category Name</label>
                      <select class="form-control"  name="category_id">
                            <option value="">---Choose One---</option>
                            @if ($categories->count())
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{ucwords(strtolower($category->category_name))}}</option>
                                @endforeach 
                            @endif
                           
                      </select>
                     
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Name</label>
                      <input type="text" class="form-control" name="product_name"  placeholder="Product Name">
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Short Description</label>
                      <input type="text" class="form-control" name="product_sort_des"  placeholder="Product Name">
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Price</label>
                      <input type="text" class="form-control" name="product_price"  placeholder="Product Price">
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Quantity</label>
                      <input type="text" class="form-control" name="product_quantity"  placeholder="Product Quantity">
                  </div>

                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Alert Quantity</label>
                      <input type="text" class="form-control" name="product_alert_quantity"  placeholder="Product Alert Quantity">
                  </div>

                  
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Product Model</label>
                      <input type="text" class="form-control" name="product_model"  placeholder="Product Modle">
                    </div>

                    <div class="from-group mb-3">
                        <label for="name" class="mb-2">Discription</label>
                        <textarea class="form-control pt-5 pb-5" name="product_description"  placeholder="Product Description" rows="4"></textarea>
                    </div>

                    <div class="from-group mb-3">
                        <label for="price" class="mb-2">Product Photo</label>
                        <input type="file"  class="form-control text-center p-2" name="product_photo" >
                    </div> 

                    <div class="from-group mb-3">
                        <label for="price" class="mb-2">Product Feature Photo</label>
                        <input type="file"  class="form-control text-center p-2" name="product_feature_photo[]" multiple>
                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Upload</button>
              </div>
            </div>
          </div>
    </form>
</div>