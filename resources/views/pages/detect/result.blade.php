<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Hasil Deteksi')
    @include('_includes.head')
    <style type="text/css">
        .page-container {
            padding-left: 0;
        }

        .menu-sidebar {
            background: transparent;
            z-index: 3;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('_includes/header_mobile')
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
        </aside>

        <div class="page-container">
            @include('_includes/header_desktop')

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Hasil Deteksi Dokumen</h3>
                                        <canvas id="result-chart" class="chartjs-render-monitor"
                                            style="display: block;"></canvass>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-5 m-b-40">Term yang menjadi acuan perhitungan</h3>
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <ul class="list-group text-center">
                                                    <li class="list-group-item active">{{ $detect->title }} (Dokumen
                                                        Anda)</li>
                                                    @foreach (unserialize($detect->text) as $val)
                                                    <li class="list-group-item">{{ $val }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            @foreach ($results as $result)
                                            <div class="col-md-4 mb-4">
                                                <ul class="list-group text-center">
                                                    <li class="list-group-item active">{{ $result->title }}</li>
                                                    @foreach (unserialize($result->text) as $text)
                                                    <li class="list-group-item">{{ $text }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <footer class="footer copyright">
                        <p>Copyright © {{ date('Y') }} DSD. All rights reserved. Created with <i
                                class="fas fa-heart text-danger"></i> by Budi Haryono</a>.</p>
                    </footer>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    @include('_includes/scripts')

    <script type="text/javascript">
        $( function() {
				var horizonalLinePlugin = {
					afterDraw: function(chartInstance) {
						var yScale = chartInstance.scales["y-axis-0"];
						var canvas = chartInstance.chart;
						var ctx = canvas.ctx;
						var index;
						var line;
						var style;

						if (chartInstance.options.horizontalLine) {
							for (index = 0; index < chartInstance.options.horizontalLine.length; index++) {
								line = chartInstance.options.horizontalLine[index];

								if ( ! line.style) {
									style = "rgba(169,169,169, .6)";
								} else {
									style = line.style;
								}

								if (line.y) {
									yValue = yScale.getPixelForValue(line.y);
								} else {
									yValue = 0;
								}

								ctx.lineWidth = 3;

								if (yValue) {
									ctx.beginPath();
									ctx.moveTo(0, yValue);
									ctx.lineTo(canvas.width, yValue);
									ctx.strokeStyle = style;
									ctx.stroke();
								}

								if (line.text) {
									ctx.fillStyle = style;
									ctx.fillText(line.text, 0, yValue + ctx.lineWidth);
								}
							}
							return;
						};
					}
				};
				Chart.pluginService.register(horizonalLinePlugin);

				var ctx = document.getElementById("result-chart");
				ctx.height = 150;
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: [
						@foreach ($results as $result)
						{!! '"'.str_replace(' ', '\n', $result->title).'",' !!}
						@endforeach
                        'test'
						],
						datasets: [
						{
							label: "Tingkat Kemiripan",
							data: [
							@foreach ($results as $result)
							{!! number_format($result->result * 100, 2) . ',' !!}
							@endforeach
                            100
							],
							borderWidth: "2",
							borderColor: [
							@foreach ($results as $result)
							@if (number_format($result->result * 100, 2) >= $garisBatas)
							{!! "'#D50000'," !!}
							@else
							{!! "'#00C853'," !!}
							@endif
							@endforeach
							],
							backgroundColor: [
							@foreach ($results as $result)
							@if (number_format($result->result * 100, 2) >= $garisBatas)
							{!! "'#FF1744'," !!}
							@else
							{!! "'#00E676'," !!}
							@endif
							@endforeach
							]
						}
						]
					},
					options: {
						horizontalLine: [{
							y: {{ $garisBatas }},
							style: "#FDD835",
							text: "Min"
						}],
						tooltips: {
							mode: 'label',
							callbacks: {
								label: function(tooltipItem, data) {
									return data['datasets'][0]['data'][tooltipItem['index']] + '%';
								}
							}
						},
						legend: {
							// display: false,
							position: 'top',
							labels: {
								fontFamily: 'Poppins'
							}
						},
						scales: {
							xAxes: [{
								ticks: {
									fontFamily: "Poppins"
								}
							}],
							yAxes: [{
								scaleLabel: { display: true, labelString: 'Persentase Kemiripan' },
								ticks: {
									beginAtZero: true,
									fontFamily: "Poppins"
								},
							}]
						}
					},
					plugins: [{
						beforeInit: function(chart) {
							chart.data.labels.forEach(function(e, i, a) {
								if (/\n/.test(e)) {
									a[i] = e.split(/\n/);
								}
							});
						}
					}]
				});

			} );
    </script>
</body>

</html>
