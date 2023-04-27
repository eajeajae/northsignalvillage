
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- CSS Files -->
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
  <link href="../assets/css/sidebar-ui.css" rel="stylesheet" />
    <label for="" class="menu-btn">
        <button class="navbar-toggler" type="button" id="btn" onclick="openNav()">
          <i class="fas fa-bars"></i>
        </button>
      </label> 
    <div class="sidebar" id="sidebar">
      <div class="logo" id="logo-wrapper">
        <a class="navbar-brand" id="logo-link" href="{{route('landingpage.index')}}"> 
          <img src="/images/logo.png" alt="" width="200" height="50" class="d-inline-block align-text-top" id="logo-image">
        </a>
      </div>
      <div class="sidebar-wrapper accordion accordion-flush" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{route('aboutbrgy.index')}}" id="aboutbrgy-show">
            <i class="fas fa-info-circle"></i><p>About Barangay</p>
            </a>
          </li>
          <li>
            <a href="{{route('complaint.index')}}" id="complaint-show">
            <i class="fas fa-file"></i><p>Report/Complaints</p>
            </a>
          </li>
          <li>
            <a href="{{route('clearance.index')}}" id="clearance-show">
            <i class="far fa-file-alt"></i><p>Request Clearance</p>
            </a>
          </li>
          <li>
            <a href="{{route('certificate.index')}}" id="certificate-show">
            <i class="fas fa-certificate"></i><p>Request Certificate</p>
            </a>
          </li>
          <li>
            <a href="{{route('barangayid.index')}}" id="barangayid-show">
            <i class="fas fa-id-card"></i><p>Request Barangay ID</p>
            </a>
          </li>
          <li>
            <a href="{{route('schedulevaccine.index')}}" id="scheduling-show">
            <i class="fas fa-calendar-alt"></i><p>Schedule Vaccination</p>
            </a>
          </li>
          <li>
            <a href="{{route('scholarship.index')}}" id="scholarship-show">
            <i class="fas fa-user-graduate"></i><p>Scholarship Application</p>
            </a>
          </li>
          <hr style="background-color: white;" >  
          <li>
            <a href="{{route('applicant.create')}}" id="job-show">
            <i class="fas fa-briefcase"></i><p>Apply for a Job</p>
            </a>
          </li>

          <!-- bottom menu -->
          <li id="bottom-menu">
            <p style="position: absolute; bottom: 0;">
            Want to Donate? <a href="{{route('donation.index')}}">Click here</a>
          </p>
          </li>
        
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
       <!-- Navbar -->
       <nav class="navbar navbar-expand-lg navbar-transparent " id="navbar-menu">
        <div class="container-fluid">
          <div class="collapse navbar-collapse d-flex justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <button type="button" class="btn btn-round btn-outline-default btn-simple btn-icon no-caret" data-bs-toggle="modal" data-bs-target="#contactUsModal" style="color: black;">
                <i class="fas fa-envelope" style="color:black;"></i>
              </button>
            </ul>
            <ul class="navbar-nav">
              <div class="dropdown">
                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" style="color: black;">
                  <i class="fa fa-user" style="color:black;"></i>
                </button>
                <div class="dropdown-menu dropdown-pull-right">
                  <a class="dropdown-item" href="{{route('resident.profile')}}">Profile</a>
                  <a class="dropdown-item" href="{{route('resident.myrequest')}}">Requests</a>
                  <hr>
                  <a class="dropdown-item" href="{{route('resident.setting')}}">Settings</a>
                  <a class="dropdown-item text-danger" href="{{route('logout')}}">Logout</a>
                </div>
              </div>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  @include('emails.contactus')
    <!-- for fa-envelope -->
      <!-- End Navbar for registered users -->
</div>
@extends('layouts.scripts')
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  
  </script>
