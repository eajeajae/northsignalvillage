<div class="modal" tabindex="-1" id="editOtherdonationModal" aria-labelledby="editOtherdonationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Other Donations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="editOtherdonationForm" enctype="multipart/form-data" class="row g-3">
          @csrf
          <input type="hidden" id="edit_otherdonation_id">
          <div class="form-group">
            <label>Category</label>
            <select class="form-select" aria-label="Default select example" id="edit_otherdonation_category" name="category">
              <option selected>Select Category</option>
              <option value="foods">Foods</option>
              <option value="clothes">Clothes</option>
              <option value="hygiene">Hygiene</option>
              <option value="others">Others</option>
            </select>
          </div>
          <div class="form-group">
            <label>Items</label>
            <select class="form-select" aria-label="Default select example" id="edit_otherdonation_items" name="items">
            <option selected>Select Item</option>
            <option value="canned goods">Canned Goods</option>
            <option value="noodles">Noodles</option>
            <option value="water">Water</option>
            <option value="underwears">Underwears</option>
            <option value="tops">Top (t-shirt, sando)</option>
            <option value="pants">Pants (shorts, pantalon)</option>
            <option value="toothbrush">Toothbrush</option>
            <option value="toothpaste">Toothpaste</option>
            <option value="soap">Soap</option>
            <option value="others">Others</option>
         </select>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" name="quantity" id="edit_otherdonation_quantity">
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit" id="otherdonationUpdate">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>