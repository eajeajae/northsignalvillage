$(document).ready(function() {
  var userData = $userData;
    const chart = new Highcharts.Chart({
        chart: {
          renderTo: 'highchartsContainer',
          type: 'column',
          options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
          }
        },
        xAxis: {
          categories: ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis: {
          title: {
            enabled: false
          }
        },
        tooltip: {
          headerFormat: '<b>{point.key}</b><br>',
          pointFormat: 'Registered users: {point.y}'
        },
        title: {
          text: 'Registered Users in Tech-service, per month 2023',
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
          data: userData,
          colorByPoint: true
        }]
      });
      
      function showValues() {
        document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d.alpha;
        document.getElementById('beta-value').innerHTML = chart.options.chart.options3d.beta;
        document.getElementById('depth-value').innerHTML = chart.options.chart.options3d.depth;
      }
      
      // Activate the sliders
      document.querySelectorAll('#sliders input').forEach(input => input.addEventListener('input', e => {
        chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
        showValues();
        chart.redraw(false);
      }));
      
      showValues();
    });