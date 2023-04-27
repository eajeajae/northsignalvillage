<!-- Modal -->
<div class="modal fade" id="editApplicationModal" tabindex="-1" aria-labelledby="editApplicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Application</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateAdminForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="edit_application_id">
					<div class="col-sm-12 d-flex justify-content-center">
						<div id="edit_application_resume">
							
						</div>
					</div>
          <div class="modal-footer">
            <button id="adminUpdateSubmit" type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
