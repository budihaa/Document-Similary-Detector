<form id="form-ajax" method="POST" action="{{ $category->exists ? route('category.update', $category->id) : route('category.store') }}" onsubmit="return false;" autocomplete="off">
	<input type="hidden" name="_method" value="{{ $category->exists ? "PUT" : "POST" }}">
	<div class="modal-header">
		<h4 class="modal-title">{{ $category->exists ? 'Edit Kategori: ' . $category->category_name : "" }}</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="category_name" class="control-label">Nama Kategori</label>
			<input type="text" class="form-control " id="category_name" name="category_name" value="{{ $category->exists ? $category->category_name : "" }}" required>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
		<button type="button" id="btn-submit" class="btn btn-success">Simpan</button>
	</div>
</form>

