<!-- Modal -->
<div class="modal fade" id="editResidentModal" tabindex="-1" aria-labelledby="editResidentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editResidentForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="edit_resident_id">
          <input type="hidden" name="edit_resident_user_id" id="user_id">
					<div class="d-inline-flex p-2 justify-content-end">
            <div class="ms-3">
							<select id="edit_resident_status" name="status" class="form-select">
								<option selected>Change Status</option>
								<option value="verified">Verified</option>
								<option value="deactivate">Deactivate</option>
								<option value="not verified">Not Verified</option>
							</select>
						</div>
					</div>
          <div class="form-group col-sm-12" id="edit_resident_valid_id" name="valid_id">
            
          </div>
					<div class="col-sm-3">
						<div class="justify-content-center ms-5 mt-3" id="edit_resident_avatar">
							
						</div>
					</div>
					<div class="col-sm-9">
						<div class="row">
							<div class="form-group col-sm-12"> 
								<label for="name" class="form-label">Name :</label>
								<input type="text" class="form-control" id="edit_resident_name" name="name">
							</div> 
							<div class="form-group col-sm-3"> 
								<label for="age" class="form-label">Age :</label>
								<input type="text" class="form-control" id="edit_resident_age" name="age">
							</div> 
              <div class="form-group col-sm-3"> 
								<label for="gender" class="form-label">Gender :</label>
								<input type="text" class="form-control" id="edit_resident_gender" name="gender">
							</div> 
							<div class="form-group col-sm-6"> 
								<label for="birthdate" class="form-label">Birthday :</label>
								<input type="date" class="datepicker form-control" data-date-format="mm/dd/yyyy" class="form-control" id="edit_resident_birthday" name="birthday">
							</div>
							<div class="form-group col-sm-6">
								<label for="phone_num" class="form-label">Contact No. :</label>
								<input type="text" class="form-control" id="edit_resident_phone_num" name="phone_num">
							</div>
							<div class="col-sm-6">
								<label for="edit_avatar" class="form-label text-md-end">{{ __('Avatar') }}</label>
								<input class="form-control" type="file" id="edit_avatar" name="avatar">
							</div>
							<div class="form-group col-sm-12 mb-5"> 
								<label for="email" class="form-label">Email :</label>
								<input type="email" class="form-control" id="edit_resident_email" name="email">
							</div> 
							<h6>Home Address</h6>

							<div class="form-group col-sm-2">
								<label for="address" class="form-label">No :</label>
								<input type="text" class="form-control" id="edit_resident_addressNo" name="addressNo">
							</div>
							<div class="form-group col-sm-8">
							  <label for="inputState" class="form-label">Street</label>
								<select id="edit_resident_street" name="street" class="form-select">
									<option selected>Choose street</option>
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
									<option value="Chesa St.">Chesa St.</option>
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
							<div class="form-group col-sm-2">
								<label for="address" class="form-label">Zone :</label>
								<input type="text" class="form-control" id="edit_resident_addressZone" name="addressZone">
							</div>
						</div>
					</div>
          <div class="modal-footer">
            <button id="residentUpdateSubmit" type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
