@extends('layouts.master')

@section('title')
	Report | Donations
@endsection
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel mb-5" id="main-panel">
    <div class="row">
      <div class="col-sm-12">
        <figure class="highcharts-figure">
          <div id="otherdonationContainer"></div>
        </figure>
      </div>
      <div class="col-sm-12 mt-5">
        <div class="table-responsive">
          <table class="table table-hover" id="reportsOtherdonationTable">
            <thead>
              <tr>
                <th>Sum</th>
                <th>Items</th>
              </tr>
            </thead>
            <tfoot>
              <th>Sum</th>
              <th>Items</th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
 $(document).ready(function() {
  var otherdonationData = <?php echo json_encode($otherdonationData)?>;
  var options = {
    chart: {
      renderTo: 'otherdonationContainer',
      plotBackgroundColor : null,
        plotBorderWidth : 0, 
        plotShadow : false,
    },
    title: {
      text: 'Other Donations, 2023',
      align: 'left',
      y: 60
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
      type: 'pie',
      name: 'Total Count',
      innerSize: '40%',
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
  }
  myarray = [];
    $.each(otherdonationData, function(index, val) {
      myarray[index] = [val.items,val.sum];
    });
    options.series[0].data = myarray;
    const chart = new Highcharts.Chart(options);
});
</script>


@endsection
