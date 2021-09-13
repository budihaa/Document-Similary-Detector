@extends('_layouts.app')

@section('title', 'Deteksi Dokumen')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css" />
<style type="text/css">
.title {
	width: 25%;
}
</style>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3 class="title-5 m-b-35"><i class="zmdi zmdi-search-in-file"></i> Riwayat Deteksi Dokumen
			<a href="{{ route('detect.create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small float-right">
				<i class="zmdi zmdi-plus"></i> Deteksi
			</a>
		</h3>
		<div class="table-data__tool"></div>
		<div class="table-responsive table-responsive-data2">
			<table id="datatable" class="table table-data2">
				<thead>
					<tr>
						<th><i class="fas fa-clock"></i> Dibuat pada</th>
						<th>Kategori</th>
						<th>Judul</th>
						<th>Penulis</th>
						<th></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- END DATA TABLE -->
	</div>
</div>
@stop

@push('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<script>
	$( function() {

		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{ route("detect.datatable") }}',
			columns: [
				{ data: 'created_at' },
				{ data: 'category_name' },
				{ data: 'title', className: 'title' },
				{ data: 'created_by' },
				{ data: 'action', searchable: false, orderable: false, className: "text-center" }
			],
			order: [
				[0, 'desc']
			],
			createdRow: function( row, data, dataIndex ) {
      			$(row).addClass('tr-shadow');
      		}
		});

	} );
</script>
@endpush
