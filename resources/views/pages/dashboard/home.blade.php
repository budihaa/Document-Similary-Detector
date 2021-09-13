@extends('_layouts/app')

@section('title', 'Beranda')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="overview-wrap">
			<h2 class="title-1">overview</h2>
		</div>
	</div>
</div>
<div class="row m-t-25">
	<div class="col-sm-6 col-lg-4">
		<div class="overview-item overview-item--c1">
			<div class="overview__inner">
				<div class="overview-box clearfix">
					<div class="icon">
						<i class="zmdi zmdi-format-list-bulleted"></i>
					</div>
					<div class="text">
						<h2>{{ $category }}</h2>
						<span>Kategori</span>
					</div>
				</div>
				<div class="overview-chart">
					<canvas id="widgetChart1"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-lg-4">
		<div class="overview-item overview-item--c2">
			<div class="overview__inner">
				<div class="overview-box clearfix">
					<div class="icon">
						<i class="fas fa-book"></i>
					</div>
					<div class="text">
						<h2>{{ $masterDocs }}</h2>
						<span>Master Dokumen</span>
					</div>
				</div>
				<div class="overview-chart">
					<canvas id="widgetChart2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-lg-4">
		<div class="overview-item overview-item--c3">
			<div class="overview__inner">
				<div class="overview-box clearfix">
					<div class="icon">
						<i class="zmdi zmdi-search-in-file"></i>
					</div>
					<div class="text">
						<h2>{{ $detect }}</h2>
						<span>Total Deteksi</span>
					</div>
				</div>
				<div class="overview-chart">
					<canvas id="widgetChart3"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="au-card recent-report">
			<div class="au-card-inner">
				<h3 class="title-2">Laporan Aktivitas Deteksi Oleh Pengguna Bulan Ini</h3>
				<hr><br>
				<div class="recent-report__chart">
					<div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
						<div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
							<div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
						</div>
						<div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
							<div style="position:absolute;width:100%;height:100%;left:0; top:0"></div>
						</div>
					</div>
                    <canvas id="activity" height="250" width="390" class="chartjs-render-monitor" style="display: block; width: 390px; height: 250px;"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$( function() {

		// Recent Report
		const brandProduct = 'rgba(0,181,233,0.8)';

		var labels = [
			@foreach ($activity as $item)
				{!! "'".date('d/M/Y', strtotime($item->date))."'," !!}
			@endforeach
		];
		var data = [
			@foreach ($activity as $item)
			{!! "".$item->counter."," !!}
			@endforeach
		];

		var ctx = document.getElementById("activity");
		if (ctx) {
			ctx.height = 250;
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: labels,
					datasets: [
						{
							label: 'My First dataset',
							backgroundColor: brandProduct,
							borderColor: 'transparent',
							pointHoverBackgroundColor: '#fff',
							borderWidth: 0,
							data: data
						},
					]
				},
				options: {
					maintainAspectRatio: true,
					legend: {
						display: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								drawOnChartArea: true,
								color: '#f2f2f2'
							},
							ticks: {
								fontFamily: "Poppins",
								fontSize: 12
							}
						}],
						yAxes: [{
							scaleLabel: { display: true, labelString: 'Jumlah Deteksi' },
							ticks: {
								beginAtZero: true,
								maxTicksLimit: 5,
								fontFamily: "Poppins",
								fontSize: 12,
								userCallback: function(label, index, labels) {
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							gridLines: {
								display: true,
								color: '#f2f2f2'
							}
						}]
					},
					elements: {
						point: {
							radius: 0,
							hitRadius: 10,
							hoverRadius: 4,
							hoverBorderWidth: 3
						}
					}
				}
			});
		}

	} );
</script>
@endpush
