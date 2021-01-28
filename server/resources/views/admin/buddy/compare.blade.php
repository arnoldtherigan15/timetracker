@extends('layouts.app', ['title' => 'Compare buddy Log Time\'s'])

@section('content')
<!-- main content -->

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                  <canvas id="canvas"></canvas>

                </div>
              </div>
              
        </div>
    </div>
</div>

<!-- end main content -->
@endsection

@section('js_top')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js" integrity="sha512-90vH1Z83AJY9DmlWa8WkjkV79yfS2n2Oxhsi2dZbIv0nC4E6m5AbH8Nh156kkM7JePmqD6tcZsfad1ueoaovww==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
@endsection

@section('js_bottom')
  
  <script>
    let buddiesLogTime = <?=json_encode($buddiesLogTime)?>;
    let labels = _.uniq(buddiesLogTime.map(log => {
        let date = new Date(log.date)
        return date.toLocaleDateString("id-ID", { weekday: 'long', month: 'long', day: 'numeric' }) 
    }))
    let buddies = _.groupBy(buddiesLogTime, "buddy.name")

    let randomColor = () => {
      var r = Math.floor(Math.random() * 255);
      var g = Math.floor(Math.random() * 255);
      var b = Math.floor(Math.random() * 255);
      return "rgb(" + r + "," + g + "," + b + ")";
    };
    
    let datasets = []
    
    _.forOwn(buddies, (value, key) => { 
      color = randomColor()
      datasets.push({
        label: key,
        fill: false,
        backgroundColor:color,
        borderColor: color,
        data: value.map( val => +`${val.total_hours}.${val.total_minutes}`)
      })
    });
 

		var config = {
			type: 'line',
			data: {
				labels: labels,
				datasets
			},
			options: {
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                  var label = data.datasets[tooltipItem.datasetIndex].label || '';
                  return `${label} ${tooltipItem.yLabel} jam`
                },
               
            }
        },
				responsive: true,
				title: {
					display: true,
					text: 'Komparasi antar buddy'
				},
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + " jam";
                    }
                }
            }]
        } 
			}
		};

			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
  </script>
@endsection