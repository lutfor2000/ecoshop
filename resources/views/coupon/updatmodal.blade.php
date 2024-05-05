<div class="modal fade" id="updatecoupontModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form  id="couponupdatefrom" method="POST" >
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="updateModalLabel">Coupon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- Erorr Message Start --}}
                   <div class="mb-3"><span id="up_error" class="alert text-danger"></span></div>
                {{-- Erorr Message End --}}
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Name</label>
                      <input type="text" class="form-control" name="coupon_name" id="coupon_name">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Discount</label>
                      <input type="number" class="form-control" name="discount_amount"  id="discount_amount">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon Expire Date</label>
                      <input type="date" class="form-control p-2" name="expire_date" id="expire_date">
                  </div>
                  <div class="from-group mb-3">
                      <label for="name" class="mb-2">Coupon User Limit</label>
                      <input type="number" class="form-control" name="uses_limit" id="uses_limit">
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