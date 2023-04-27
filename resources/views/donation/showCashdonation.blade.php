<div class="modal" tabindex="-1" id="showCashdonationModal" aria-labelledby="showCashdonationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Cash Donations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="cashdonationForm" enctype="multipart/form-data" class="row g-3">
          @csrf
          <input type="hidden" id="edit_cashdonation_id">
          <div class="form-group">
            <label>G-Cash Full Name</label>
            <input type="text" class="form-control"  name="gcashName" id="edit_cashdonation_gcashName" readonly>
          </div>
          <div class="form-group">
            <label>G-Cash Number</label>
            <input type="text" class="form-control"  name="gcashPhoneNum" id="edit_cashdonation_gcashPhoneNum" readonly>
          </div>
          <div class="form-group">
            <label>Donor Name</label>
            <input type="text" class="form-control" name="donorName" id="edit_cashdonation_donorName" readonly>
          </div>
          <div class="form-group">
            <label>Amount Donated</label>
            <input type="text" class="form-control" name="amountDonated" id="edit_cashdonation_amountDonated" readonly>
          </div>
          <div class="col-sm-12">
						<div id="edit_cashdonation_receipt_img">

						</div>
					</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>