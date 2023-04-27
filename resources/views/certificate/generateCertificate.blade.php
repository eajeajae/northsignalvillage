<!-- Modal -->
<div class="modal fade" id="generatecertificateModal" tabindex="-1" aria-labelledby="generatecertificateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Certificate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form class="form-group row g-3" action="{{ route('certificate.processCertificate') }}" method="post" id="certificategenerateForm">
          {{ csrf_field() }}
          <input type="hidden" id="generate_certificate_id"> 
          <div class="col-sm-8">
            <label for="control_no" class="form-label card_tags">Control No.:</label>
            <input type="text" id="generate_certificate_control_no" name="control_no" style="border:none; background-color:transparent;"> 
          </div>
          <input type="hidden" id="generate_certificate_created_at" name="created_at" date_format="YYYY-MM-DD"> 
          <div class="d-inline-flex p-2 justify-content-center ">
            <label for="certificate of" class="form-label card_tags">Certificate of</label>
						<div class="">
							<select id="generate_certificate_typeofdoc" name="typeofdoc" class="form-select" style="border:none; background-color:transparent;">
								<option value="Late Registration of Live Birth">Late Registration of Live Birth</option>
								<option value="Public Attorneys Office (PAO)">Public Attorneys Office (PAO)</option>
								<option value="Medical Assistance">Medical Assistance</option>
                <option value="Philippines Veterans Office (PVAO)">Philippines Veterans Office (PVAO)</option>
                <option value="Burial Assistance">Burial Assistance</option>
                <option value="No Derogatory Record/Good Moral">No Derogatory Record/Good Moral</option>
                <option value="Actual Occupancy/Land Titling">Actual Occupancy/Land Titling</option>
                <option value="Residency">Residency</option>
							</select>
						</div>
					</div>
          <hr style="border: none;
					height: 2px;
					background: #234880;"
					>
					<!-- start of personal information -->
          <div class="row">
            <div class="col-sm-12">
              <p>To Whom It May Concern:</p>
            </div>
            <div class="col-sm-4 d-flex justify-content-end">
              This is to certify that
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control card_tags" id="generate_certificate_name" name="name" readonly style="border:none; background-color:transparent;">
            </div>
            <div class="col-sm-4 d-flex justify-content-start">
              is a bonafide resident of
            </div>
            <div class="col-sm-5 d-flex justify-content-end">
              this barangay with postal address of 
            </div>
            <div class="col-sm-3">
              <input type="text" class="form-control card_tags" id="generate_certificate_address" name="address" style="border:none; background-color:transparent;" readonly>
            </div>
          <div class="col-sm-4 d-flex justify-content-start">
            North Signal Village, Taguig City
          </div>
          <div class="col-sm-12">
            <textarea class="form-control" id="complainantPrayer" name="complainantPrayer" rows="3"></textarea>
          </div>
          <div class="col-sm-6 d-flex justify-content-end">
            This certificate is issued upon request of 
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="requestof" name="requestof">
          </div>
          <div class="modal-footer">
            <div class="d-grid gap-2 justify-content-end">
              <button class="btn btn-success" type="submit" id="certificateGenerate">Generate</button>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
