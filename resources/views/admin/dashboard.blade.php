@extends('layouts.master')

@section('title')
	Dashboard
@endsection
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel mb-5" id="main-panel">
    <div class="card card-dashboard">
      <div class="card-body card-body-dashboard mx-4">
        <div class="row">
          <div class="col-sm-8">
            <div id="banner-form">
              <h2>OVERVIEW</h2>
            </div>
          </div>
          <div class="col-sm-4 d-flex justify-content-end">
            <div id="banner-form">
              <a href="{{route('admin.announcement')}}" role="button" class="btn btn-success">+ Announcement</a>
            </div>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-sm-8">
            <figure class="highcharts-figure">
              <div id="highchartsContainer"></div>
            </figure>
          </div>
          <div class="col-sm-4 card-resident">
            @if(empty($residents))
            <div class="card mb-3" style="max-width: 540px; background-color: whitesmoke;">
              <div class="row g-0">
                <div class="col-md-4">
                <i class="fas fa-user fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-title" class="card-title card_tags">Users registered in Tech-service</p>
                    <h5 class="card-text">---</h5>
                    <a href="{{route('resident.viewall')}}" class="card-text"><small class="text-muted">Resident Count</small></a>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="card mb-3" style="max-width: 540px; background-color: white;">
              <div class="row g-0">
                <div class="col-md-4">
                <i class="fas fa-user fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p style="font-size: 12px;" class="card-title card_tags">Resident registered in Tech-service</p>
                    <h2 class="card-text">{{$residents}}</h2>
                    <a href="{{route('resident.viewall')}}" class="card-text"><small class="text-muted">Resident Count</small></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if(empty($residents))
            <div class="card mb-3" style="max-width: 540px; background-color: white;" >
              <div class="row g-0">
                <div class="col-md-4">
                <i class="fas fa-user-cog fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-title" class="card-title card_tags">Admin registered in Tech-service</p>
                    <h5 class="card-text">---</h5>
                    <a href="{{route('admin.viewall')}}" class="card-text"><small class="text-muted">Admin Count</small></a>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="card mb-3" style="max-width: 540px; background-color: white;">
              <div class="row g-0">
                <div class="col-md-4">
                <i class="fas fa-user-cog fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p style="font-size: 12px;" class="card-title card_tags">Admin registered in Tech-service</p>
                    <h2 class="card-text">{{$admins}}</h2>
                    <a href="{{route('admin.viewall')}}" class="card-text"><small class="text-muted">Admin Count</small></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7">
            <figure class="highcharts-figure">
              <div id="certclearancesContainer"></div>
            </figure>
          </div>
          <div class="col-sm-5">
            <figure class="highcharts-figure">
              <div id="complaintDescContainer"></div>
            </figure>
          </div>
        </div>  
        <div class="row">
          <div class="col-sm-7">
            <figure class="highcharts-figure">
              <div id="complaintsContainer"></div>
            </figure>
          </div>
          <div class="col-sm-5">
            <figure class="highcharts-figure">
              <div id="complaintStreetContainer"></div>
            </figure>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-6">
            <figure class="highcharts-figure">
              <div id="scholarshipschoolContainer"></div>
            </figure>
          </div>
          <div class="col-sm-6">
            <figure class="highcharts-figure">
              <div id="scholarshipcourseContainer"></div>
            </figure>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-8">
            <figure class="highcharts-figure">
              <div id="donationContainer"></div>
            </figure>
          </div>
          <div class="col-sm-4">
            @if(empty($donation_totalAmount))
            <div class="card my-5 text-center" style="max-width: 540px; max-height: auto; background-color: white;">
              <div class="row g-0">
                <h6 style="color: #234880; font-weight: bolder;" class="card-title">Total Amount of Donation</h6>
                <div class="col-md-4">
                  <i class="fas fa-donate fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body mx-3 my-2">
                    <h5 class="card-text">---</h5>
                    <a href="{{route('donation.viewall')}}" class="card-text"><small class="text-muted">Donation Total</small></a>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="card my-5 text-center" style="max-width: 540px; background-color: white;">
              <div class="row g-0">
                <h6 style="color: #234880; font-weight: bolder;" class="card-title">Total Amount of Donation</h6>
                <div class="col-md-4">
                  <i class="fas fa-donate fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body mx-3 my-2">
                    <h2 class="card-text">{{$donation_totalAmount}}</h2>
                    <a href="{{route('donation.viewall')}}" class="card-text"><small class="text-muted">Total Donation</small></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	var verifiedResidentsDataChart = <?php echo json_encode($verifiedResidentsDataChart)?>;
  var notverifiedResidentsDataChart = <?php echo json_encode($notverifiedResidentsDataChart)?>;
  Highcharts.chart('highchartsContainer',{
        xAxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
          title: {
            enabled: false
          }
        },
        title: {
          text: 'Registered resident in Tech-service, per month 2023',
          align: 'left'
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle' 
        },
        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
            }
          }
        },
        series: [{
          name: 'Verified',
          data: verifiedResidentsDataChart
        }, {
          name:'Not verified',
          data: notverifiedResidentsDataChart
        }],

        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });

</script>
<script text="text/javascript">
  var barangayidDataChart = <?php echo json_encode($barangayidDataChart)?>;
  var certificatesDataChart = <?php echo json_encode($certificatesDataChart)?>;
  var clearancesDataChart = <?php echo json_encode($clearancesDataChart)?>;
  const chart = new Highcharts.Chart({
    chart: {
      renderTo: 'certclearancesContainer',
      type: 'column',
      options3d: {
        enabled: true,
        viewDistance: 25
      }
    },
    xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
      title: {
        enabled: false
      }
    },
    title: {
      text: 'Requested barangay ID, certificates and clearances, 2023',
      align: 'left'
    },
    legend: {
      align: 'center',
        verticalAlign: 'bottom',
        x: 0,
        y: 0
    },
    plotOptions: {
      column: {
        depth: 25
      }
    },
    series: [{
      name: 'Certificates',
      data: [<?php echo join($certificatesDataChart, ',') ?>],
      showInLegend: true
    }, {
      name:'Clearances',
      data: clearancesDataChart,
      showInLegend: true
    }, {
      name:'Barangay ID',
      data: barangayidDataChart,
      showInLegend: true
    }],
  });

</script>
<script type="text/javascript">
  $(document).ready(function() {
    var scholarSchools = <?php echo json_encode($scholarSchools)?>;
    var options = {
      chart: {
        renderTo: 'scholarshipschoolContainer',
        plotBackgroundColor : null,
        plotBorderWidth : null, 
        plotShadow : false,
      },
      title: {
        text: 'School of scholarship applicants',
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
      series: [{
        type: 'pie',
        name: 'School',
        showInLegend: true
      }]
    }
    myarray = [];
    $.each(scholarSchools, function(index, val) {
      myarray[index] = [val.scholarSchool,val.count];
    });
    options.series[0].data = myarray;
    const chart = new Highcharts.Chart(options);
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      var complaintDescData = <?php echo json_encode($complaintDescData)?>;
      var options = {
        chart: {
          renderTo: 'complaintDescContainer',
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
          text: 'Common Complaints',
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
      $.each(complaintDescData, function(index, val) {
        myarray[index] = [val.complaint,val.count];
      });
      options.series[0].data = myarray;
      const chart = new Highcharts.Chart(options);
    });
</script>
<script text="text/javascript">
  var complaintDataChart = <?php echo json_encode($complaintDataChart)?>;
  Highcharts.chart('complaintsContainer',{
    chart: {
      type: 'cylinder',
      options3d: {
        enabled: true,
        viewDistance: 25
      }
    },
    xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
      title: {
        enabled: false
      }
    },
    title: {
      text: 'Filed complaints per month, 2023',
      align: 'left'
    },
    legend: {
      enabled: false
    },
    plotOptions: {
      column: {
        depth: 25
      }
    },
    series: [{
      name: 'Complaints',
      data: complaintDataChart,
      showInLegend: true
    }],
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      var complaintStreetData = <?php echo json_encode($complaintStreetData)?>;
      var options = {
        chart: {
          renderTo: 'complaintStreetContainer',
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
          text: 'Streets with most complaints',
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
      $.each(complaintStreetData, function(index, val) {
        myarray[index] = [val.street,val.count];
      });
      options.series[0].data = myarray;
      const chart = new Highcharts.Chart(options);
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var scholarCourses = <?php echo json_encode($scholarCourses)?>;
    var options = {
      chart: {
        renderTo: 'scholarshipcourseContainer',
        plotBackgroundColor : null,
        plotBorderWidth : null, 
        plotShadow : false,
      },
      title: {
        text: 'Course of scholarship applicants',
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
      series: [{
        type: 'pie',
        name: 'School', 
        innerSize: '50%',
        showInLegend: true
      }]
    }
    myarray = [];
    $.each(scholarCourses, function(index, val) {
      myarray[index] = [val.scholarCourse,val.count];
    });
    options.series[0].data = myarray;
    const chart = new Highcharts.Chart(options);
  });
</script>
<script text="text/javascript">
  var donation_permonth = <?php echo json_encode($donation_permonth)?>;
  var donation_total = <?php echo json_encode($donation_total)?>;
  Highcharts.chart('donationContainer',{
    chart: {
      type: 'column',
      options3d: {
        enabled: true,
        viewDistance: 25
      }
    },
    xAxis: {
      categories: donation_permonth
    },
    yAxis: {
      title: {
        text: false
      }
    },
    title: {
      text: 'Total Amount of Donation (GCASH), 2023',
      align: 'left'
    },
    legend: {
      enabled: false
    },
    plotOptions: {
      column: {
        depth: 25
      }
    },
    series: [{
      name: 'Total Amount per month',
      data: donation_total
    }]
  });

</script>
<!-- Modal -->
<div class="modal fade" id="allAnnouncementModal" aria-labelledby="allAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">All of the anouncement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <table class="table table-hover" id="announcementTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Heading</th>
                <th>Caption</th>
                <th class="actionsCol">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <th>ID</th>
              <th>Heading</th>
              <th>Caption</th>
            </tfoot>
          </table> 
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#announcementModal" data-bs-toggle="modal">Add Announcement</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="announcementModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn btn-primary" data-bs-target="#allAnnouncementModal" data-bs-toggle="modal" style= color: black; border:none;"><</button>
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Add Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="announcementForm" method="post" action="{{route('admin.storeAnnouncement')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group"> 
            <label for="article_img[]" class="control-label" style="font-weight: bolder;">Article Image</label>
            <input type="file" class="form-control" id="article_img[]" name="article_img[]" multiple>
          </div> 
          <div class="form-group"> 
            <label for="heading" class="control-label" style="font-weight: bolder;">Heading: </label>
            <input type="text" class="form-control" id="heading" name="heading">
          </div>
          <div class="form-group">
            <label for="" class="control-label" style="font-weight: bolder;">Caption</label>
            <textarea class="form-control" id="caption" name="caption" rows="3"></textarea>
          <div class="modal-footer">
            
            <button id="announcementSubmit" type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

@endsection
