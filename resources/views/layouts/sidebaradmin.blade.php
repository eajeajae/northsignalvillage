  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/sidebar-ui.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.min.css" integrity="sha512-x2AeaPQ8YOMtmWeicVYULhggwMf73vuodGL7GwzRyrPDjOUSABKU7Rw9c3WNFRua9/BvX/ED1IK3VTSsISF6TQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
    <div class="sidebar">
      <div class="logo">
        <a class="navbar-brand" href="{{route('admin.dashboard')}}">
          <img src="/images/logo.png" alt="" width="200" height="50" class="d-inline-block align-text-top">
        </a>
      </div>
      <div class="sidebar-wrapper accordion accordion-flush" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{route('admin.dashboard')}}">
            <i class="fas fa-chart-bar"></i><p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="{{route('barangayid.viewall')}}" id="aboutbrgy-show">
            <i class="fas fa-id-card"></i><p>Barangay ID requests</p>
            </a>
          </li>
          <li>
            <a href="{{route('certificate.viewall')}}" id="aboutbrgy-show">
            <i class="fas fa-certificate"></i><p>Certificates</p>
            </a>
          </li>
          <li>
            <a href="{{route('clearance.viewall')}}" id="aboutbrgy-show">
            <i class="fas fa-file-alt"></i><p>Clearances</p>
            </a>
          </li>
          <li>
            <a href="{{route('complaint.viewall')}}" id="complaint-show">
            <i class="fas fa-file"></i><p>Report/Complaints</p>
            </a>
          </li>
          <li>
            <a href="{{route('schedulevaccine.viewall')}}" id="scheduling-show">
            <i class="fas fa-calendar-alt"></i><p>Vaccination Schedules</p>
            </a>
          </li>
          <li>
            <a href="{{route('scholarship.viewall')}}" id="scholarship-show">
            <i class="fas fa-user-graduate"></i><p>Scholarship Applications</p>
            </a>
          </li>
          <li>
            <a href="{{route('applicant.viewall')}}">
            <i class="fas fa-briefcase"></i><p>Applicants</p>
            </a>
          </li>
          <li>
            <a href="{{route('scholarship.viewall')}}" id="scholarship-show">
            <i class="fas fa-donate"></i><p>Donations</p>
            </a>
          </li>
          <hr style="background-color: white;" >  
          <div id="accordionExample" class="accordion">
            <li class="accordion-item">
              <a href="#" class="accordionSidebarbtn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <i class="fas fa-sort-down"></i><p>Reports</p>
              </a>
            </li>
          </div>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewBrgyidReport')}}" class="accordion-body">
            <i class="fas fa-id-card"></i></i><p>Barangay ID</p>
            </a>
          </li>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewCertificateReport')}}" class="accordion-body">
            <i class="fas fa-certificate"></i><p>Certificates</p>
            </a>
          </li>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewClearanceReport')}}" class="accordion-body">
              <i class="fas fa-file-alt"></i><p>Clearances</p>
            </a>
          </li>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewComplaintReport')}}" class="accordion-body">
              <i class="fas fa-file"></i><p>Complaints</p>
            </a>
          </li>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewVaccinationScheduleReport')}}" class="accordion-body">
            <i class="fas fa-calendar-week"></i><p>Scheduled Vaccination</p>
            </a>
          </li>
          <li id="collapseTwo" class="accordion-collapse collapse accordionSidebarList" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <a href="{{route('report.viewDonationReport')}}" class="accordion-body">
            <i class="fas fa-hand-holding-usd"></i><p>Donations</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
       <!-- Navbar -->
       <nav class="navbar navbar-expand-lg navbar-transparent ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>

          </div>
          <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
            <ul class="navbar-nav">
              <div class="dropdown">
                <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" style="color: black;">
                {{ Auth::guard('web')->user()->name }}  <i class="fa fa-user" style="color:black;"></i>
                </button>
                <div class="dropdown-menu dropdown-pull-right">
                  <a class="dropdown-item" href="{{route('resident.profile')}}">My Profile</a>
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

</div>
@extends('layouts.scripts')
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
