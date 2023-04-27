<!-- Modal -->
<div class="modal fade" id="showMyCertificateModal" tabindex="-1" aria-labelledby="showMyCertificateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">My request (certificate)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group row g-3" method="post" id="myCertificateshowForm" enctype="multipart/form-data">
          @csrf
          <!-- end of barangay certificate --> 
          <input type="hidden" id="show_mycertificate_id">
          <div class="d-inline-flex p-2 justify-content-end">
						<div class="">
							<select id="show_mycertificate_typeofrequest_id" name="typeofrequest_id" class="form-select" disabled>
								<option value="2">Late Registration of Live Birth</option>
								<option value="3">Public Attorneys Office (PAO)</option>
								<option value="4">Medical Assistance</option>
                <option value="5">Philippines Veterans Office (PVAO)</option>
                <option value="6">Burial Assistance</option>
                <option value="7">No Derogatory Record/Good Moral</option>
                <option value="8">Actual Occupancy/Land Titling</option>
                <option value="9">Residency</option>
							</select>
						</div>
            <div class="">
              <select id="show_mycertificate_status" name="status" class="form-select" disabled>
                <option value="in cart">In cart</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="ready for pick-up/delivery">Ready for pick-up/delivery</option>
                <option value="received">Received</option>
              </select>
            </div>
					</div>
          <div class="row g-3">
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="purpose">Purpose of Clearance/Certificate:</span>
                  <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="purpose" id="show_mycertificate_purpose" name="purpose" readonly>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="input-group mb-3">
                  <span class="input-group-text" id="purpose">Are you a registered voter of this barangay?(Rehistrado ka ba?): </span>
                  <input type="text" class="form-control" id="show_mycertificate_isRegistered" name="isRegistered" readonly>
                </div>
            </div>
            <div class="col-sm-12">
              <div class="input-group mb-3">
                  <span class="input-group-text" id="purpose">Do you have pending case before the Barangay/Lupon Tagamayapa?:</span>
                  <input type="text" class="form-control" id="show_mycertificate_havePendingCase" name="havePendingCase" readonly>
                </div>
            </div>
          </div> 
          <!-- end of row g-3 -->
          <hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
          <!-- start of personal information -->
            <div class="col-sm-9">
              <label for="name" class="form-label">Name :</label>
              <input type="text" class="form-control" id="show_mycertificate_name" name="name" readonly>
            </div>
            <div class="col-sm-3">
              <label for="gender" class="form-label">Gender :</label>
              <input type="text" class="form-control" id="show_mycertificate_gender" name="gender" readonly>
              <br>
            </div>
            <div class="col-sm-4">
              <label for="birthdate" class="form-label">Birthday :</label>
              <input type="date" class="datepicker form-control" data-date-format="mm/dd/yyyy" class="form-control" id="show_mycertificate_birthdate" name="birthdate" readonly>
            </div>
            <div class="col-sm-4">
              <label for="p_birth" class="form-label">Place of Birth :</label>
              <input type="text" class="form-control" id="show_mycertificate_p_birth" name="p_birth" readonly>
            </div>
            <div class="col-sm-4">
              <label for="nationality" class="form-label">Nationality :</label>
              <input type="text" class="form-control" id="show_mycertificate_nationality" name="nationality" readonly>
            </div>
            <div class="col-sm-6">
              <label for="contact_num" class="form-label">Contact No. :</label>
              <input type="text" class="form-control" id="show_mycertificate_contact_num" name="contact_num"readonly>
            </div>
            <div class="col-sm-6">
              <label for="c_status" class="form-label">Civil Status :</label>
              <select id="show_mycertificate_c_status" class="form-select" name="c_status" readonly>
                <option selected>Choose civil status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="widowed">Widowed</option>
                <option value="divorced">Divorced</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="address" class="form-label">Address :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="show_mycertificate_addressNo" name="addressNo" placeholder="No." readonly>
            </div>
            <div class="col-sm-8">
              <select id="show_mycertificate_street" name="street" class="form-select" readonly>
                <option value="1st Ave.">1st Ave.</option>
                <option value="10th Ave.">10th Ave.</option>
                <option value="10th St.">10th St.</option>
                <option value="11th Ave.">11th Ave.</option>
                <option value="11th St.">11th St.</option>
                <option value="2nd Ave.">2nd Ave.</option>
                <option value="3rd Ave.">3rd Ave.</option>
                <option value="4th Ave.">4th Ave.</option>
                <option value="4th St.">4th St.</option>
                <option value="5th Ave.">5th Ave.</option>
                <option value="5th St.">5th St.</option>
                <option value="6th Ave.">6th Ave.</option>
                <option value="6th St.">6th St.</option>
                <option value="7th Ave.">7th Ave.</option>
                <option value="7th St.">7th St.</option>
                <option value="8th Ave.">8th Ave.</option>
                <option value="8th St.">8th St.</option>
                <option value="9th Ave.">9th Ave.</option>
                <option value="9th St.">9th St.</option>
                <option value="Aguho St.">Aguho St.</option>
                <option value="Anonas St.">Anonas St.</option>
                <option value="Atis St.">Atis St.</option>
                <option value="Balimbing Ext.">Balimbing Ext.</option>
                <option value="Balimbing St.">Balimbing St.</option>
                <option value="Bravo St.">Bravo St.</option>
                <option value="Chesa St.">Chesa St.<option>
                <option value="Chico St.">Chico St.</option>
                <option value="Durian Ext.">Durian Ext.</option>
                <option value="Durian St.">Durian St.</option>
                <option value="Guiho St.">Guiho St.</option>
                <option value="Guyabano St.">Guyabano St.</option>
                <option value="Ilang-ilang St.">Ilang-ilang St.</option>
                <option value="Ipil-ipil St.">Ipil-ipil St.</option>
                <option value="Kaimito St.">Kaimito St.</option>
                <option value="Kasoy St.">Kasoy St.</option>
                <option value="Karamay St.">Karamay St.</option>
                <option value="Kawayan St..">Kawayan St..</option>
                <option value="Langka St.">Langka St.</option>
                <option value="Mabolo Ext.">Mabolo Ext.</option>
                <option value="Mabolo St.">Mabolo St.</option>
                <option value="Macopa Ext.">Macopa Ext.</option>
                <option value="Macopa St.">Macopa St.</option>
                <option value="Mangga St.">Mangga St.</option>
                <option value="Mangustan St.">Mangustan St.</option>
                <option value="Mansanas St.">Mansanas St.</option>
                <option value="Marang St.">Marang St.</option>
                <option value="Molave St.">Molave St.</option>
                <option value="Narra St.">Narra St.</option>
                <option value="Pajo St.">Pajo St.</option>
                <option value="Papaya Ext.">Papaya Ext.</option>
                <option value="Pili St.">Pili St.</option>
                <option value="Salamat Ext.">Salamat Ext.</option>
                <option value="Sampaguita St.">Sampaguita St.</option>
                <option value="Sampaloc Ext.">Sampaloc Ext.</option>
                <option value="Sampaloc St.">Sampaloc St.</option>
                <option value="Santol St.">Santol St.</option>
                <option value="Sineguelas St.">Sineguelas St.</option>
                <option value="Tindalo St.">Tindalo St.</option>
                <option value="Yakal St.">Yakal St.</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="addressZone" name="addressZone" placeholder="Zone" readonly> 
            </div>
            <div class="col-sm-8">
              <label for="provincialAddress" class="form-label">Provincial Address :</label>
              <input type="text" class="form-control" id="provincialAddress" name="provincialAddress" readonly>
            </div>
            <div class="col-sm-4">
              <label for="living" class="form-label">Year since living in the Barangay:</label>
              <input type="text" class="form-control" id="show_mycertificate_yearLiving" name="yearLiving" readonly>
            </div>
            <div class="col-sm-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="i-certify" id="show_mycertificate_areYouSure" name="areYouSure" checked>
                <label class="form-check-label" for="areYouSure">I hereby certify that the above information is true and correct to the best of my knowledge</label>
              </div>
            </div>
          <!-- end of personal information  -->

          <div class="d-grid gap-2 justify-content-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
