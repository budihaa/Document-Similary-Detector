@extends('_layouts.app')

@section('title', 'Kategori')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css" />
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="top-campaign">
			<div class="overview-wrap m-b-35">
				<h3 class="title-5">Kategori</h3>
				<button data-url="{{ route('category.create') }}" class="au-btn au-btn-icon au-btn--green modal-create"><i class="zmdi zmdi-plus"></i>Tambah Kategori</button>
			</div>
			<div class="table-responsive">
				<table id="datatable" class="table table-top-campaign">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Kategori</th>
							<th><i class="fas fa-clock"></i> Dibuat pada</th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Nama Kategori</th>
							<th><i class="fas fa-clock"></i> Dibuat pada</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<script>
	$(function() {
		$('#datatable').dataTable({
			processing: true,
			serverSide: true,
			ajax: '{{ route("category.json") }}',
			columns: [
				{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex',
					render: function(data, meta, full, type) {
						return data + '.';
					}
				},
				{ data: 'category_name', name: 'category_name' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'action', name: 'action', searchable: false, orderable: false, className: "text-center" }
			],
			order: [
				[1, 'asc']
			]
		});
	});
</script>
@endpush
