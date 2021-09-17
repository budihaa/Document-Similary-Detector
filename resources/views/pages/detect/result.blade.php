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
                                        <h3 class="title-5 mb-4">Perhitungan TF - IDF</h3>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover">
                                                    <tr class="text-center">
                                                        <th>Term</th>
                                                        <th>{{ $detect->title }} (Dokumen Deteksi)</th>
                                                        @foreach ($results as $result)
                                                        <th>{{ $result->title }}</th>
                                                        @endforeach
                                                    </tr>
                                                    @foreach (unserialize($detect->tf_idf) as $term => $tfIdf)
                                                    <tr class="text-center">
                                                        <th>{{ $term }}</th>
                                                        <td>{{ $tfIdf }}</td>
                                                        @foreach ($results as $result)
                                                        @foreach (unserialize($result->tf_idf) as $t => $tfIdfMaster)
                                                        @if ($term === $t)
                                                        <td>{{ $tfIdfMaster }}</td>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </table>
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
                            <p>Copyright © {{ date('Y') }} DSD. All rights reserved.</p>
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

                $.ajax({
                    url: '{!! route('detect.chart', ['id' => $detect->id]) !!}',
                    method: 'GET',
                    dataType: 'JSON'
                }).done(function(data) {
                    new Chart(ctx, {
					type: 'bar',
					data: {
						labels: data.labels,
						datasets: data.datasets,
					},
					options: {
						horizontalLine: [{
							y: {{ $garisBatas }},
							style: "#FDD835",
							text: ""
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
									fontFamily: "Poppins",
                                    beginAtZero: true,
                                    min: 0,
                                    max: 100,
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
					}],
				});
                }).fail(function() {
                    alert('Gagal');
                });
			} );
        </script>
</body>

</html>
