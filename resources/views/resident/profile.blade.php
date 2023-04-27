@extends('layouts.master')

@section('title')
	My Profile
@endsection 
@if(Auth::user()->role == 'resident')
@include('layouts.sidebar')
@else
@include('layouts.sidebaradmin')
@endif
@section('content')
<div class="container">
	<div class="main-panel">
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-validId" id="img01">
      <div id="caption"></div>
    </div>
    <div class="row g-3">
			<div class="col-sm-12" id="banner-form">
				<h2>MY PROFILE</h2>
			</div>
      <div class="card card-form">
        <div class="card-body mx-5 my-5">
          <div class="row g-3">
            <div class="col-sm-4">
              <img class="rounded-circle d-block avatar" src="{{ asset('storage/users/'.Auth::user()->avatar) }}" alt="Image" height="250px" width="250px"/>
            </div>
            <div class="col-sm-5 mx-4" >
              <h6><span id="tag">Name: </span>{{ Auth::user()->name }} </h6>
              <h6><span id="tag">Gender: </span>{{ Auth::user()->gender }} </h6>
              <h6><span id="tag">Age: </span> {{ Auth::user()->age }} </h6>
              <h6><span id="tag">Birthdate: </span> {{ Auth::user()->birthdate }}</h6>
              <h6><span id="tag">Contact Number: </span> {{ Auth::user()->phoneNum }}</h6>
              <hr>

              <h6><span id="tag">No: </span> {{ Auth::user()->addressNo }}  </h6>
              <h6><span id="tag">Street: </span> {{ Auth::user()->street }} </h6>
              <h6><span id="tag">Zone: </span> {{ Auth::user()->addressZone }} </h6>
            </div>
            <div class="col-sm-2">
              <img class="d-block avatar" src="{{ asset('storage/users/'.Auth::user()->valid_id) }}" alt="Valid-id" height="100px" width="150px" id="myValidId"/>
            </dv>			
          </div>
          @if(Auth::user()->role == 'resident')
          <hr class="my-3" style="border: none;
          height: 2px;
          background: #234880;"
          > 
          <div class="row">
            <div class="col-sm-12 my-2">
              <h6 class="card_tags">MY REQUESTS</h6>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="certificates-tab" data-bs-toggle="tab" data-bs-target="#certificates-tab-pane" type="button" role="tab" aria-controls="certificates-tab-pane" aria-selected="true">Certificates</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="clearances-tab" data-bs-toggle="tab" data-bs-target="#clearances-tab-pane" type="button" role="tab" aria-controls="clearances-tab-pane" aria-selected="false">Clearances</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="barangayids-tab" data-bs-toggle="tab" data-bs-target="#barangayids-tab-pane" type="button" role="tab" aria-controls="barangayids-tab-pane" aria-selected="false">Barangay ID</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="complaints-tab" data-bs-toggle="tab" data-bs-target="#complaints-tab-pane" type="button" role="tab" aria-controls="complaints-tab-pane" aria-selected="false">Complaints</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="certificates-tab-pane" role="tabpanel" aria-labelledby="certificates-tab" tabindex="0">
                @if(count($certificaterequests) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Certificate</th>
                            <th>Status</th>
                            <th class="actionsCol">Actions</th>
                          </tr>
                        </thead>
                            @foreach($certificaterequests as $certificaterequest)
                        <tbody>
                          <tr>
                            <th>{{$certificaterequest->control_no}}</th>
                            <td>{{$certificaterequest->typeofdoc}}</td>
                            <td>{{$certificaterequest->status}}</td>
                            <td>
                              <button class="btn btn-xs btn-primary showMyCertificatebtn" value="{{$certificaterequest->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                              @if($certificaterequest->status == 'pending')
                              <button class="btn btn-xs btn-primary editMyCertificatebtn" value="{{$certificaterequest->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                              @else
                              <button class="btn btn-xs btn-primary editMyCertificatebtn" value="{{$certificaterequest->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                              @endif
                            </td>
                          </tr>
                        </tbody>
                            @endforeach
                      </table>
                      <div class="d-flex justify-content-center">
                        <div class="pagination">
                          {!! $certificaterequests->links("pagination::bootstrap-4") !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent requests...
                @endif
              </div>
              <div class="tab-pane fade" id="clearances-tab-pane" role="tabpanel" aria-labelledby="clearances-tab" tabindex="0">
                @if(count($clearancerequests) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Certificate</th>
                            <th>Status</th>
                            <th class="actionsCol">Actions</th>
                          </tr>
                        </thead>
                            @foreach($clearancerequests as $clearancerequest)
                        <tbody>
                          <tr>
                            <th>{{$clearancerequest->control_no}}</th>
                            <td>{{$clearancerequest->typeofdoc}}</td>
                            <td>{{$clearancerequest->status}}</td>
                            <td>
                              <button class="btn btn-xs btn-primary showMyClearancebtn" value="{{$clearancerequest->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                              @if($clearancerequest->status == 'pending')
                              <button class="btn btn-xs btn-primary editMyClearancebtn" value="{{$clearancerequest->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                              @else
                              <button class="btn btn-xs btn-primary editMyClearancebtn" value="{{$clearancerequest->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                              @endif
                            </td>
                          </tr>
                        </tbody>
                            @endforeach
                      </table>
                      <div class="d-flex justify-content-center">
                        <div class="pagination">
                          {!! $clearancerequests->links("pagination::bootstrap-4") !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent requests...
                @endif
              </div>
              <div class="tab-pane fade" id="barangayids-tab-pane" role="tabpanel" aria-labelledby="barangayids-tab" tabindex="0">
                @if(count($barangayidrequests) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th class="actionsCol">Actions</th>
                          </tr>
                        </thead>
                          @foreach($barangayidrequests as $barangayidrequest)
                          <tbody>
                            <tr>
                              <th>{{$barangayidrequest->id}}</th>
                              <td>{{$barangayidrequest->status}}</td>
                              <td>
                                <button class="btn btn-xs btn-primary showMyBarangayidbtn" value="{{$barangayidrequest->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                                @if($barangayidrequest->status == 'pending')
                                <button class="btn btn-xs btn-primary editMyBarangayIdbtn" value="{{$barangayidrequest->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                                @else
                                <button class="btn btn-xs btn-primary editMyBarangayIdbtn" value="{{$barangayidrequest->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                          @endforeach
                      </table>
                      <div class="d-flex justify-content-center">
                        <div class="pagination">
                          {!! $barangayidrequests->links("pagination::bootstrap-4") !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent requests...
                @endif
              </div>
              <div class="tab-pane fade" id="complaints-tab-pane" role="tabpanel" aria-labelledby="complaints-tab" tabindex="0">
                @if(count($filedcomplaints) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Complaint</th>
                            <th>Status</th>
                            <th class="actionsCol">Actions</th>
                          </tr>
                        </thead>
                          @foreach($filedcomplaints as $filedcomplaint)
                          <tbody>
                            <tr>
                              <th>{{$filedcomplaint->caseNo}}</th>
                              <td>{{$filedcomplaint->complaintDesc}}</td>
                              <td>{{$filedcomplaint->status}}</td>
                              <td>
                                <button class="btn btn-xs btn-primary showMyComplaintbtn" value="{{$filedcomplaint->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                                @if($filedcomplaint->status == 'pending')
                                <button class="btn btn-xs btn-primary editMyComplaintbtn" value="{{$filedcomplaint->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                                @else
                                <button class="btn btn-xs btn-primary editMyComplaintbtn" value="{{$filedcomplaint->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                          @endforeach
                      </table>
                      <div class="d-flex justify-content-center">
                        <div class="pagination">
                          {!! $filedcomplaints->links("pagination::bootstrap-4") !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent complaint...
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 my-2">
              <h6 class="card_tags">MY SUBMITTED APPLICATION</h6>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="scholarships-tab" data-bs-toggle="tab" data-bs-target="#scholarships-tab-pane" type="button" role="tab" aria-controls="scholarships-tab-pane" aria-selected="true">Scholarship</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job-tab-pane" type="button" role="tab" aria-controls="job-tab-pane" aria-selected="false">Job</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="scholarships-tab-pane" role="tabpanel" aria-labelledby="scholarships-tab" tabindex="0">
                @if(count($scholarshipapplications) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Comment</th>
                          <th>Status</th>
                          <th class="actionsCol">Actions</th>
                        </tr>
                      </thead>
                      @foreach($scholarshipapplications as $scholarshipapplication)
                      <tbody>
                        <tr>
                          <th>{{$scholarshipapplication->id}}</th>
                          <th>{{$scholarshipapplication->comment}}</th>
                          <td>{{$scholarshipapplication->status}}</td>
                          <td>
                            <button class="btn btn-xs btn-primary showMyScholarshipApplicationbtn" value="{{$scholarshipapplication->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                            @if($scholarshipapplication->status == 'waiting for evaluation')
                            <button class="btn btn-xs btn-primary editMyScholarshipApplicationbtn" value="{{$scholarshipapplication->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                            @else
                            <button class="btn btn-xs btn-primary editMyScholarshipApplicationbtn" value="{{$scholarshipapplication->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                            @endif
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                    <div class="d-flex justify-content-center">
                      <div class="pagination">
                        {!! $scholarshipapplications->links("pagination::bootstrap-4") !!}
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent requests...
                @endif
              </div>
              <div class="tab-pane fade" id="job-tab-pane" role="tabpanel" aria-labelledby="job-tab" tabindex="0">
                @if(count($jobapplications) > 0)
                <div class="col-sm-12">
                  <div class="container">
                    <div class="table-responsive">
                      <table id="allMyrequests" class="table display" style="width:100%"	>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Job</th>
                            <th>Company Name</th>
                            <th class="actionsCol">Actions</th>
                          </tr>
                        </thead>
                          @foreach($jobapplications as $jobapplication)
                          <tbody>
                            <tr>
                              <th>{{$jobapplication->id}}</th>
                              <td>{{$jobapplication->job}}</td>
                              <td>{{$jobapplication->companyName}}</td>
                              <td>
                                <button class="btn btn-xs btn-primary showMyClearancebtn" value="{{$jobapplication->id}}" id='button-show-request'><i class='fas fa-eye'></i></button>
                                @if($jobapplication->status == 'waiting list')
                                <button class="btn btn-xs btn-primary editMyClearancebtn" value="{{$jobapplication->id}}" id='button-edit-request'><i class='fas fa-edit'></i></button>
                                @else
                                <button class="btn btn-xs btn-primary editMyClearancebtn" value="{{$jobapplication->id}}" id='button-edit-request' disabled><i class='fas fa-edit'></i></button>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                          @endforeach
                      </table>
                      <div class="d-flex justify-content-center">
                        <div class="pagination">
                          {!! $jobapplications->links("pagination::bootstrap-4") !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                There's no recent submitted applications...
                @endif
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  var modal = document.getElementById("myModal");
  var img = document.getElementById("myValidId");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  var span = document.getElementsByClassName("close")[0];

  span.onclick = function() { 
    modal.style.display = "none";
  }
</script>
@include('barangayid.editMybarangayid')
@include('barangayid.showMybarangayid')
@include('certificate.editMycertificate')
@include('certificate.showMycertificate')
@include('clearance.editMyclearance')
@include('clearance.showMyclearance')
@include('complaint.editMycomplaint')
@include('complaint.showMycomplaint')
@include('scholarship.editMyscholarshipapplication')
@include('scholarship.showMyapplication')
@endsection