<div class="modal fade" id="ctegoryUpadeModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form  id="categoeyupdatefrom" method="POST" >
        @csrf
        <input type="hidden" id="id" name="id">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="addModalLabel">Category Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- Erorr Message Start --}}
                   <div class="mb-3"><span id="update_error" class="alert text-danger"></span></div>
                {{-- Erorr Message End --}}
               
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="category_name">
                  </div>

                    <div class="from-group mb-3">
                        <label for="price" class="mb-2">Category New Photo</label>
                        <input type="file"  class="form-control text-center p-2" name="category_new_photo" >
                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Update</button>
              </div>
            </div>
          </div>
    </form>
</div>