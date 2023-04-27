<!-- Modal -->
<div class="modal fade" id="generateSummonLetterModal" tabindex="-1" aria-labelledby="generateSummonLetterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Summon Letter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form class="form-group row g-3" action="{{ route('complaint.processSummon') }}" method="post" id="clearancegenerateForm">
          {{ csrf_field() }}
          <input type="hidden" id="generate_complaint_id"> 
          <input type="hidden" id="generate_complaint_created_at" name="created_at" date_format="YYYY-MM-DD"> 
          <div class="d-inline-flex p-2 justify-content-center ">
            <p class="card_tags">OFFICE OF THE LUPON TAGAPAMAYAPA</p>
					</div>
          <br>
          <div class="col-sm-6">
            <label for="caseNo" class="form-label card_tags">Case No.:</label>
            <input type="text" id="generate_complaint_caseNo" name="caseNo" style="border:none; background-color:transparent;"> 
            <br>
            <label for="forComplainantName" class="form-label card_tags">For:</label>
            <input type="text" id="generate_complaint_forComplainantName" name="forComplainantName" style="border:none; background-color:transparent;"> 
          </div>
          <div class="col-sm-6">
            <label for="complainantName" class="form-label card_tags">Complainant</label>
            <input type="text" id="generate_complaint_complainantName" name="complainantName" style="border:none; background-color:transparent;"> 
            <p class="card_tags">VS.</p>
            <label for="respondentName" class="form-label card_tags">Respondent</label>
            <input type="text" id="generate_complaint_respondentName" name="respondentName" style="border:none; background-color:transparent;"> 
          </div>
          <div class="col-sm-12 d-flex justify-content-center">
            <p class="card_tags">SUMMONS</p>
          </div>
          <div class="col-sm-6 d-flex justify-content-center">
            <label for="toRespondents" class="form-label card_tags">To:</label>
            <input type="text" id="generate_complaint_toRespondents" name="toRespondents" style="border:none; background-color:transparent;">
          </div>
					<!-- start of personal information -->
          <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
              <p>RESPONDENTS</p>
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
              You are hereby summoned to appear before me in person, together with your witness, on 
            </div>
            <div class="col-sm-5">
              <label for="mediationSchedule" class="form-label">the</label>
              <input class="card_tags" type="text" id="generate_complaint_mediationSchedule" name="mediationSchedule" style="border:none; background-color:transparent;">
            </div>
            <div class="col-sm-7 d-flex justify-content-end">
              then and there to answer the complaint made before me
            </div>
            <div class="col-sm-12">
              copy of which is attached here to, for mediation of your dispute with complainant/s.
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
            You are hereby warned that if you refuse or willfully fail to appear in obedience to this summons, you 
            </div>
            <div class="col-sm-12 d-flex justify-content-start">
              may be barred from filling any counterclaim arising from said complaint.
            </div>
            <div class="col-sm-12 card_tags">
              FAIL NOT or else face punishment as for contempt of court.
            </div>
            <div class="col-sm-12 d-flex justify-content-start">
              <input type="text" class="form-control card_tags" id="generate_complaint_created_at" name="created_at" style="border:none; background-color:transparent;" readonly>
            </div>
            <div class="col-sm-5">
              <label for="punongBarangay" class="form-label">Punong Barangay:</label>
              <input type="text" class="form-control" type="text" id="generate_complaint_punongBarangay" name="punongBarangay">
            </div>
            <div class="modal-footer">
              <div class="d-grid gap-2 justify-content-end">
                <button class="btn btn-success" type="submit" id="complaintGenerate">Generate</button>
              </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
