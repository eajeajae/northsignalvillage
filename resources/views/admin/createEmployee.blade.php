<div class="modal fade" id="addAdminModal" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: bolder;">Add Admin</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addAdminForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group col-sm-12"> 
            <label for="name" class="form-label">Name :</label>
            <input type="text" class="form-control" id="name" name="name">
          </div> 
					<div class="form-group col-sm-2"> 
            <label for="age" class="form-label">Age :</label>
            <input type="text" class="form-control" id="age" name="age">
          </div> 
          <div class="form-group col-sm-6"> 
						<label for="birthdate" class="form-label">Birthday :</label>
          	<input type="date" class="datepicker form-control" data-date-format="YYYY-MM-DD" class="form-control" id="birthdate" name="birthdate">
          </div>
          <div class="form-group col-sm-4"> 
            <label for="gender" class="form-label">Gender :</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
              <label class="form-check-label" for="gender">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
              <label class="form-check-label" for="gender">Female</label>
            </div>
          </div> 
          <div class="form-group col-sm-6">
						<label for="phoneNum" class="form-label">Contact No. :</label>
            <input type="text" class="form-control" id="phoneNum" name="phoneNum">
					</div>
          <div class="form-group col-sm-6">
            <label for="avatar" class="form-label">Avatar</label>
            <input class="form-control form-control-sm" type="file" id="avatar" name="avatar">
          </div>
          <div class="form-group col-sm-6">
          <select class="form-select" aria-label="Default select example" name="role" id="role">
            <option selected>Select Position</option>
            <option value="admin">Admin</option>
            <option value="super admin">Super admin</option>
            <option value="regular employee">Employee</option>
          </select>
					</div>
					<hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
					<h6>Home Address</h6>

					<div class="form-group col-sm-3">
            <input type="text" class="form-control" id="addressNo" name="addressNo" placeholder="Address No.">
					</div>
					<div class="col-sm-8">
						<select id="street" name="street" class="form-select">
							<option selected>Street</option>
							<option value="1st Ave.">1st Ave.</option>
							<option value="10th Ave.">10th Ave.</option>
							<option value="10th St.">10th St.</option>
							<option value="11th Ave.">11th Ave.</option>
							<option value="11th St.">11th St.</option>
							<option value="2nd Ave.">2nd Ave.</option>
							<option value="3rd Ave.">3rd Ave.</option>
							<option value="4th Ave.">4th Ave.</option>
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
					<hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
					<div class="form-group">
						<label for="email" class="form-label">Email Address:</label>
            <input type="text" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
					</div>
					<div class="form-group">
						<label for="confirmPassword" class="form-label">Confirm Password:</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
          <div class="modal-footer">
            <button id="addAdminbtn" type="submit" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
