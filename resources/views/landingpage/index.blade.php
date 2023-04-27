@extends('layouts.master')

@section('title')
  E-Public Service North Signal
@endsection 

@section('content')
@if(Auth::check())
  @if(Auth::user()->role == 'resident')
  @include('layouts.sidebar')
  <!-- main panel -->
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="homeToken">
  <div class="container" id="home">
    <div class="main-panel" id="main-panel">
      <div class="panel-header panel-header-lg">
        <div class="text-center">
          <h1>Welcome to Barangay North Signal E-public service</h1>
        </div>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center" id="banner-announcement">
              <h2>Announcement</h2>
            </div>
          </div>
          @if(count($announcements) > 0)
          @foreach ($announcements as $announcement)
          <div class="card mb-3" style="max-width: auto;">
            <div class="row g-0">
              <div class="col-md-4">   
                <div id="carouselExample" class="carousel slide">
                  <div class="carousel-inner">
                    @foreach($announcement as $item)
                    <div class="carousel-item active">
                      <img src="{{ asset('article_images/'.$announcement->article_img) }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    @endforeach
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title" style="font-weight:bolder;">{{ $announcement->heading }}</h5>
                  <p class="card-text" style="font-weight:100px;"> {{ $announcement->caption }}</p>
                  <p class="card-text"><small class="text-muted">Posted at: {{$announcement->created_at}}</small></p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <div class="d-flex justify-content-center">
            <div class="pagination">
              {!! $announcements->links("pagination::bootstrap-4") !!}
            </div>
          </div>
          
          @else
          <div class="col-sm-12 text-center">
            <h2>No announcements yet...</h2>
          </div>
          @endif
        </div>
    </div>
    <div class="container">
      <div id="analytics-complaints" class="row align-items-center">
        <div class="col-sm-7">
          <h3>Pricelist in requesting:</h3>
          <div class="accordion accordion-flush" id="accordionPricelist">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-barangayId" aria-expanded="false" aria-controls="flush-barangayId">
                  Barangay ID
                </button>
              </h2>
              <div id="flush-barangayId" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionPricelist">
                <div class="accordion-body row">
                  @foreach($requestdocuments as $requestdocument)
                  @if($requestdocument->category == 'Barangay ID')
                  <div class="col-sm-8">
                    <p>{{$requestdocument->typeofdoc}}</p>
                  </div>
                  <div class="col-sm-3">
                    <p>{{$requestdocument->price}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-clearances" aria-expanded="false" aria-controls="flush-clearances">
                  Clearance
                </button>
              </h2>
              <div id="flush-clearances" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionPricelist">
                <div class="accordion-body row">
                  @foreach($requestdocuments as $requestdocument)
                  @if($requestdocument->category == 'Clearances')
                  <div class="col-sm-8">
                    <p>{{$requestdocument->typeofdoc}}</p>
                  </div>
                  <div class="col-sm-3">
                    <p>{{$requestdocument->price}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-certificates" aria-expanded="false" aria-controls="flush-certificates">
                  Certificate
                </button>
              </h2>
              <div id="flush-certificates" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionPricelist">
                <div class="accordion-body row">
                  @foreach($requestdocuments as $requestdocument)
                  @if($requestdocument->category == 'Certificates')
                  <div class="col-sm-8">
                    <p>{{$requestdocument->typeofdoc}}</p>
                  </div>
                  <div class="col-sm-3">
                    <p>{{$requestdocument->price}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-filingComplaints" aria-expanded="false" aria-controls="flush-filingComplaints">
                  Filing of complaint
                </button>
              </h2>
              <div id="flush-filingComplaints" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionPricelist">
                <div class="accordion-body row">
                  @foreach($requestdocuments as $requestdocument)
                  @if($requestdocument->category == 'Complaint')
                  <div class="col-sm-8">
                    <p>{{$requestdocument->typeofdoc}}</p>
                  </div>
                  <div class="col-sm-3">
                    <p>{{$requestdocument->price}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-permits" aria-expanded="false" aria-controls="flush-permits">
                  Permits
                </button>
              </h2>
              <div id="flush-permits" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionPricelist">
                <div class="accordion-body row">
                  @foreach($requestdocuments as $requestdocument)
                  @if($requestdocument->category == 'Permits')
                  <div class="col-sm-8">
                    <p>{{$requestdocument->typeofdoc}}</p>
                  </div>
                  <div class="col-sm-3">
                    <p>{{$requestdocument->price}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <figure class="highcharts-figure">
            <div id="complaintContainer"></div>
          </figure>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
<footer class="text-center text-white mt-3">

<!-- Copyright -->
<div class="text-center p-3" style="color:black;">
  Barangay North Signal E-Public Service © All Rights Reserved 2022 <br>
  Visit <a class="text-black" href="https://www.facebook.com/NorthSignalVillage">Barangay North Signal Village</a>, for more info
</div>
<!-- Copyright -->
</footer>
<!-- Footer -->
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      var complaintData = <?php echo json_encode($complaintData)?>;
      var options = {
        chart: {
          renderTo: 'complaintContainer',
          plotBackgroundColor : null,
          plotBorderWidth : null, 
          plotShadow : false,
          options3d: {
              enabled: true,
              alpha: 45,
              beta: 0
          }
        },
        title: {
          text: 'Streets with the most complaints in the barangay',
          align: 'left'
        },
        subtitle: {
          text: 'This data are based on the filed complaints by our dear residents, please be aware of your surroundings',
          align: 'left'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
              enabled: true,
              format: '{point.name}'
            }
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        },
        series: [{
          type: 'pie',
          name: 'Count',
        }]
      }
      myarray = [];
      $.each(complaintData, function(index, val) {
        myarray[index] = [val.street,val.count];
      });
      options.series[0].data = myarray;
      const chart = new Highcharts.Chart(options);
    });
  </script>
  @endif
@else
@include('layouts.navbar')
<div class="page-header-image" data-parallax="true" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('/assets/img/brgy1.jpg');
  display: block;
  width: 100%;
  height: 125vh;
  background-size: cover;
  background-repeat: no-repeat;">
  <div class="container-fluid">
    <div class="row row-header d-flex justify-content-center">
      <div class="col-sm-6 header-logo">
        <img src="/images/logo-barangay.png" alt="" style="height:350px; width:350px;">
        <br>
      </div>
      <div class="col-sm-6 header-content">
        <h3 style="font-weight:bolder;" >Barangay North Signal E-Public Service</h3>
        <p>Electronic Public Services is provided by the barangay North Signal Village to extend the services to the residents. The system provides services and transactions you wish to have in the barangay, such as requesting clearances, certificates, permits, barangay ID, scheduling a vaccination to the health center, and even filing a complaint. E-public service also includes scholarships, submission of resumes for residents who wish to have a job, and donation drives for those in need. All of these services are now in digital form.</p>
        <a class="btn btn-success"role="button" href="{{route('landingpage.latestUpdate')}}">Latest Update >></a>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row my-5 d-flex justify-content-center">
    <div class="col-sm-4">
      <div class="card" id="mvg-card">
        <div id="mvg-header">
          <h2 class="card-title text-center">Our Goals</h2>
          <i class="fas fa-bullseye fa-9x" style="color:#234880; text-align:center;"></i>
        </div>
        <div class="card-body text-center" id="mission-vision-goal">
          <p class="card-text">To improve the living standard; provide health and safety, promote prosperity; Improve moral, peace and pride, comfort and convenience of the inhabitants of Barangay North Signal Village , Taguig City.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card" id="mvg-card">
        <div id="mvg-header">
          <h2 class="card-title text-center">Our Missions</h2>
          <i class="fas fa-rocket fa-7x" style="color:#234880; text-align:center;"></i>
        </div>
        <div class="card-body text-center" id="mission-vision-goal">
          <p class="card-text">North Signal Village aims to enable its citizenry gain access to education, skills and livelihood trainings, sports and other programs that can equip and make them capable of earning an income to help raise their standard of living to live productive ad decent live. And to be able to actively carry out the mandates and ensure transparency, honesty and efficiemcy in the delivery of services in the Barangay.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card" id="mvg-card">
        <div id="mvg-header">
          <h2 class="card-title text-center"">Our Vision</h2>
          <i class="fas fa-binoculars fa-9x" style="color:#234880; text-align:center;"></i>
        </div>
        <div class="card-body text-center" id="mission-vision-goal">
          <p class="card-text">Barangay North Signal Village takes pride in its people coming from all over the various regions of the archipelago, diverse in its origin and culturem but united in its effort, to establish a verdant community that is peaceful, healthy and livable.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-sm-6 my-4">
      <h3>Pricelist in requesting:</h3>
      <div class="accordion accordion-flush" id="accordionPricelist">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-barangayId" aria-expanded="false" aria-controls="flush-barangayId">
              Barangay ID
            </button>
          </h2>
          <div id="flush-barangayId" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionPricelist">
            <div class="accordion-body row">
              @foreach($requestdocuments as $requestdocument)
              @if($requestdocument->category == 'Barangay ID')
              <div class="col-sm-8">
                <p>{{$requestdocument->typeofdoc}}</p>
              </div>
              <div class="col-sm-3">
                <p>{{$requestdocument->price}}</p>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-clearances" aria-expanded="false" aria-controls="flush-clearances">
              Clearance
            </button>
          </h2>
          <div id="flush-clearances" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionPricelist">
            <div class="accordion-body row">
              @foreach($requestdocuments as $requestdocument)
              @if($requestdocument->category == 'Clearances')
              <div class="col-sm-8">
                <p>{{$requestdocument->typeofdoc}}</p>
              </div>
              <div class="col-sm-3">
                <p>{{$requestdocument->price}}</p>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-certificates" aria-expanded="false" aria-controls="flush-certificates">
              Certificate
            </button>
          </h2>
          <div id="flush-certificates" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionPricelist">
            <div class="accordion-body row">
              @foreach($requestdocuments as $requestdocument)
              @if($requestdocument->category == 'Certificates')
              <div class="col-sm-8">
                <p>{{$requestdocument->typeofdoc}}</p>
              </div>
              <div class="col-sm-3">
                <p>{{$requestdocument->price}}</p>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-filingComplaints" aria-expanded="false" aria-controls="flush-filingComplaints">
              Filing of complaint
            </button>
          </h2>
          <div id="flush-filingComplaints" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionPricelist">
            <div class="accordion-body row">
              @foreach($requestdocuments as $requestdocument)
              @if($requestdocument->category == 'Complaint')
              <div class="col-sm-8">
                <p>{{$requestdocument->typeofdoc}}</p>
              </div>
              <div class="col-sm-3">
                <p>{{$requestdocument->price}}</p>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-permits" aria-expanded="false" aria-controls="flush-permits">
              Permits
            </button>
          </h2>
          <div id="flush-permits" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionPricelist">
            <div class="accordion-body row">
              @foreach($requestdocuments as $requestdocument)
              @if($requestdocument->category == 'Permits')
              <div class="col-sm-8">
                <p>{{$requestdocument->typeofdoc}}</p>
              </div>
              <div class="col-sm-3">
                <p>{{$requestdocument->price}}</p>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 my-4">
      <h3>Contact Us Form</h3>
      <form method="get" id="contactusForm" class="row g-3 my-4">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
          <label for="inquiry" class="form-label">Message</label>
          <textarea class="form-control" id="inquiry" rows="3" name="inquiry"></textarea>
        </div>
      </div>
      <div class="d-flex justify-content-end mb-4">
        <button type="submit" class="btn btn-success" id="contactusSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
<footer class="text-center text-white">

<!-- Copyright -->
<div class="text-center p-3" style="color:black;">
  Barangay North Signal E-Public Service © All Rights Reserved 2022 <br>
  Visit <a class="text-black" href="https://www.facebook.com/NorthSignalVillage">Barangay North Signal Village</a>, for more info
</div>
<!-- Copyright -->
</footer>
<!-- Footer -->
@endif
@endsection