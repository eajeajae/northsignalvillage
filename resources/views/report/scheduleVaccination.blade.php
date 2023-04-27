@extends('layouts.master')

@section('title')
	Report | Vaccination Schedule
@endsection
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel mb-5" id="main-panel">
    <div class="row">
      <div class="col-sm-12">
        <figure class="highcharts-figure">
          <div id="scheduleVaccinationContainer"></div>
        </figure>
      </div>
      <div class="col-sm-12 mt-5">
        <div class="table-responsive">
          <table class="table table-hover" id="reportsScheduleVaccinationTable">
            <thead>
              <tr>
                <th>Count</th>
                <th>Street</th>
              </tr>
            </thead>
            <tfoot>
              <th>Count</th>
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
    var scheduleVaccinationData = <?php echo json_encode($scheduleVaccinationData)?>;
    var options = {
      chart: {
        renderTo: 'scheduleVaccinationContainer',
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
        text: 'Street with the most Vaccination Schedule',
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
    $.each(scheduleVaccinationData, function(index, val) {
      myarray[index] = [val.street,val.count];
    });
    options.series[0].data = myarray;
    const chart = new Highcharts.Chart(options);
  });
</script>


@endsection
