@extends('_layouts.app')

@section('title', 'Detect Document')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<strong>Master Dokumen</strong>
			</div>
			<div class="card-body card-block">
				<form action="{{ $masterDocs->exists ? route('all-documents.update', $masterDocs->id) : route('all-documents.store') }}" method="POST" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">

					@csrf
					<input type="hidden" name="_method" value="{{ $masterDocs->exists ? "PUT" : "POST" }}">

					{{-- @if ($masterDocs->exists)
						<input type="hidden" name="id" value="{{ $masterDocs->id }}">
					@endif --}}

					<div class="row form-group {{ $errors->has('category_id') ? "has-danger" : "" }}">
						<div class="col col-md-3">
							<label for="category_id" class=" form-control-label">Kategori <span class="text-danger">*</span></label>
						</div>
						<div class="col-12 col-md-9">
							<select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? "is-invalid" : "" }}" required>
								<option value=""> -------- Pilih kategori -------- </option>
								@foreach ($categories as $data)
									<option value="{{ $data->id }}" {{ $data->id === $masterDocs->category_id ? 'selected' : '' }}>{{ $data->category_name }}</option>
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
							<input type="text" id="title" name="title" placeholder="Judul Dokumen" class="form-control {{ $errors->has('title') ? "is-invalid" : "" }}" required value="{{ $masterDocs->exists ? $masterDocs->title : '' }}">
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
							<input type="text" id="created_by" name="created_by" placeholder="Nama pembuat atau penulis dokumen" class="form-control {{ $errors->has('created_by') ? "is-invalid" : "" }}" required value="{{ $masterDocs->exists ? $masterDocs->created_by : '' }}">
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
							<input type="file" class="form-control-file" id="file" name="file" accept="application/pdf" {{ $masterDocs->exists ? '' : 'required' }}>
							@if ($errors->has('file'))
								<div class="invalid-feedback">{{ $errors->first('file') }}</div>
							@endif
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
