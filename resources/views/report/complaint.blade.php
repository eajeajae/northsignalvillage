@extends('layouts.master')

@section('title')
	Report | Filed Complaints
@endsection
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel mb-5" id="main-panel">
    <div class="row">
      <div class="col-sm-12">
        <figure class="highcharts-figure">
          <div id="complaintContainer"></div>
        </figure>
      </div>
      <div class="col-sm-12 mt-5">
        <div class="table-responsive">
          <table class="table table-hover" id="reportsComplaintTable">
            <thead>
              <tr>
                <th>Count</th>
                <th>Complaint</th>
                <th>Street</th>
              </tr>
            </thead>
            <tfoot>
              <th>Count</th>
              <th>Complaint</th>
              <th>Street</th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
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
        text: 'Street with the most Complaints',
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
        name: 'Count',
        drilldown: 'Count'
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
