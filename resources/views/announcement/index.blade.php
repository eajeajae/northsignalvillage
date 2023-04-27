@extends('layouts.master')

@section('title')
  E-Public Service North Signal
@endsection 

@section('content')
@include('layouts.navbar')
<style>
  body{
    background-color: whitesmoke;
  }
</style>
<div class="container container-announcement">
  <div class="row ">
    <div class="col-sm-8 my-4">
      @foreach($announcements as $announcement) 
      <div class="card mb-4" style="max-width: auto;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$announcement->heading}}</h5>
              <p class="card-text">{{$announcement->caption}}</p>
              <p class="card-text"><small class="text-muted">Posted at: {{$announcement->created_at}}</small></p>
            </div>
          </div>
          <div class="col-md-4">
            <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                @foreach($announcement as $item)
                <div class="carousel-item active">
                  <img src="{{ asset('article_images/'.$announcement->article_img) }}" class="img-fluid rounded-start"  style="width: 100%; height: 15vw;object-fit: cover;">
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
        </div>
      </div>
      @endforeach
      <div class="d-flex justify-content-center">
        <div class="pagination">
          {!! $announcements->links("pagination::bootstrap-4") !!}
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-4 justify-content-center">
      <figure class="highcharts-figure">
        <div id="complaintContainer"></div>
      </figure>
      <br>
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted">Here are the list of complaints and which street it did happen.</h6>
          @foreach($complaintStreets as $complaintStreet)
          <p class="card-text">Complaint about <span style="font-weight:bolder;">{{$complaintStreet->complaintDesc}}</span> in <span style="font-weight:bolder;">{{$complaintStreet->locationStreet}}</span></p>
          @endforeach
        </div>
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
          text: 'Most Complaints in the barangay',
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
@endsection