@extends('_layouts.app')

@section('title', 'Master Dokumen')

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
		<div class="top-campaign">
			<div class="overview-wrap m-b-35">
				<h3 class="title-5">Master Dokumen</h3>
				<a href="{{ route('all-documents.create') }}" class="au-btn au-btn-icon au-btn--green"><i class="zmdi zmdi-plus"></i>Tambah Dokumen</a>
			</div>
			<div class="table-responsive">
				<table id="datatable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><i class="fas fa-clock"></i> Dibuat pada</th>
							<th>Kategori</th>
							<th>Judul</th>
							<th>Penulis</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<th><i class="fas fa-clock"></i> Dibuat pada</th>
							<th>Kategori</th>
							<th>Judul</th>
							<th>Penulis</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@stop

@push('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<script>
	$(function() {
		$('#datatable').dataTable({
			processing: true,
			serverSide: true,
			ajax: '{{ route("all-documents.json") }}',
			columns: [
				{ data: 'created_at' },
				{ data: 'category_name' },
				{ data: 'title', className: 'title' },
				{ data: 'created_by' },
				{ data: 'action', searchable: false, orderable: false, className: "text-center" }
			],
			order: [
				[0, 'desc']
			]
		});

	});
</script>
@endpush
