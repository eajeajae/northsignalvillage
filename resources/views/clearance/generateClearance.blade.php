<!-- Modal -->
<div class="modal fade" id="generateclearanceModal" tabindex="-1" aria-labelledby="generateclearanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate clearance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form class="form-group row g-3" action="{{ route('clearance.processClearance') }}" method="post" id="clearancegenerateForm">
          {{ csrf_field() }}
          <input type="hidden" id="generate_clearance_id"> 
          <div class="col-sm-8">
            <label for="control_no" class="form-label card_tags">OR Blg.:</label>
            <input type="text" id="generate_clearance_control_no" name="control_no" style="border:none; background-color:transparent;"> 
          </div>
          <input type="hidden" id="generate_clearance_created_at" name="created_at" date_format="YYYY-MM-DD"> 
          <div class="d-inline-flex p-2 justify-content-center ">
            <p class="card_tags">PAHINTULOT NG BARANGAY</p>
					</div>
          <br>
					<!-- start of personal information -->
          <div class="row">
            <div class="col-sm-12">
              <p>SA KINAUUKULAN:</p>
            </div>
            <div class="col-sm-4 d-flex justify-content-end">
              Binibigyang pahintulot si 
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control card_tags" id="generate_clearance_name" name="name" readonly style="border:none; background-color:transparent;">
            </div>
            <div class="col-sm-2 d-flex justify-content-end">
              naninirahan sa 
            </div>
            <div class="col-sm-3">
              <input type="text" class="form-control card_tags" id="generate_clearance_address" name="address" style="border:none; background-color:transparent;" readonly>
            </div>
            <div class="col-sm-9 d-flex justify-content-start">
              North Signal Village, Lungsod ng Taguig, kaugnay sa kanyang kahilingan
            </div>
            <div class="col-sm-2 d-flex justify-content-start">
              para sa
            </div>
            <div class="col-sm-8 d-flex justify-content-start">
              <input type="text" class="form-control card_tags" id="generate_clearance_typeofdoc" name="typeofdoc" style="border:none; background-color:transparent;" readonly>
            </div>
            <div class="modal-footer">
              <div class="d-grid gap-2 justify-content-end">
                <button class="btn btn-success" type="submit" id="clearanceGenerate">Generate</button>
              </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
