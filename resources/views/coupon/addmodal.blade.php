<div class="modal fade" id="addcoupontModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form  id="couponfrom" method="POST" >
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="addModalLabel">Coupon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- Erorr Message Start --}}
                   <div class="mb-3"><span id="error" class="alert text-danger"></span></div>
                {{-- Erorr Message End --}}
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Name</label>
                      <input type="text" class="form-control" name="coupon_name"  placeholder="Coupon Name">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Discount</label>
                      <input type="number" class="form-control" name="discount_amount"  placeholder="Coupon Discount">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Expire Date</label>
                      <input type="date" class="form-control p-2" name="expire_date">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon User Limit</label>
                      <input type="number" class="form-control" name="uses_limit"  placeholder="User Limit">
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