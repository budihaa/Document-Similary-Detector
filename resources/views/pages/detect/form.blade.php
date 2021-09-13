@extends('_layouts.app')

@section('title', 'Detect Document')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<strong>Silahkan masukan data dokumen yang anda ingin bandingkan terlebih dahulu</strong>
			</div>
			<div class="card-body card-block">
				<form action="{{ $detect->exists ? route('detect.update', $detect->id) : route('detect.store') }}" method="POST" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">

					@csrf
					<input type="hidden" name="_method" value="{{ $detect->exists ? "PUT" : "POST" }}">

					@if ($detect->exists)
						<input type="hidden" name="id" value="{{ $detect->id }}">
					@endif

					<div class="row form-group {{ $errors->has('category_id') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="category_id" class=" form-control-label">Kategori <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? "is-invalid" : "" }}" required>
								<option value="" {{ $detect->exists ? "" : "selected" }} disabled> -------- Pilih kategori -------- </option>
								@foreach ($categories as $data)
									<option value="{{ $data->id }}" {{ $data->id === $detect->category_id ? 'selected' : '' }}>{{ $data->category_name }}</option>
								@endforeach
							</select>
							@if ($errors->has('category_id'))
								<div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
							@endif
						</div>
					</div>

					<div class="row form-group {{ $errors->has('title') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="title" class=" form-control-label">Judul <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="title" name="title" placeholder="Judul Dokumen" class="form-control {{ $errors->has('title') ? "is-invalid" : "" }}" required value="{{ $detect->exists ? $detect->title : '' }}">
							@if ($errors->has('title'))
								<div class="invalid-feedback">{{ $errors->first('title') }}</div>
							@endif
						</div>
					</div>

					<div class="row form-group {{ $errors->has('created_by') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="created_by" class=" form-control-label">Penulis <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="created_by" name="created_by" placeholder="Nama pembuat atau penulis dokumen" class="form-control {{ $errors->has('created_by') ? "is-invalid" : "" }}" required value="{{ $detect->exists ? $detect->created_by : '' }}">
							@if ($errors->has('created_by'))
								<div class="invalid-feedback">{{ $errors->first('created_by') }}</div>
							@endif
						</div>
					</div>

					<div class="row form-group {{ $errors->has('file') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="file" class="form-control-label">File Dokumen <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<input type="file" class="form-control-file" id="file" name="file" accept="application/pdf" {{ $detect->exists ? '' : 'required' }}>
							@if ($errors->has('file'))
								<div class="invalid-feedback">{{ $errors->first('file') }}</div>
							@endif
						</div>
					</div>

					<hr>

					<div class="row form-group {{ $errors->has('file') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="file" class="form-control-label">Bandingkan Dengan <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<select class="select2 m-b-10 master-docs" style="width: 100%" multiple="multiple" data-placeholder="----- Pilih dokumen -----" name="master_doc_id[]" id="master_docs" disabled>
                        	</select>
                        <span class="help-block"><small>Anda dapat memilih lebih dari 1 dokumen untuk dibandingkan.</small></span>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-dot-circle"></i> Submit
					</button>
					<button type="reset" class="btn btn-danger">
						<i class="fa fa-ban"></i> Reset
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
	$( function() {
		$('.select2').select2();

		$('#category_id').on('change', function() {
			$('.master-docs').empty().prop('disabled', true);

			$.ajax({
				url: '{{ route('detect.master-docs') }}',
				type: 'GET',
				data: { category_id: $(this).val() },
			})
			.done(function(response) {
				$('.master-docs').prop('disabled', false);

				const data = $.parseJSON(response);
				$.each(data, function(i, val) {
					$('.master-docs').append(`<option value="${val.id}">${val.title} - ${val.created_by}</option>`);
				});
			})
			.fail(function(err) {
				console.log(err);
			});
		});

	} );
</script>
@endpush
