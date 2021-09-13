<aside class="menu-sidebar d-none d-lg-block">
	<div class="logo">
		<a href="#">
			<img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin" />
		</a>
	</div>
	<div class="menu-sidebar__content js-scrollbar1">
		<nav class="navbar-sidebar">
			<ul class="list-unstyled navbar__list">
				<li>
					<a href="{{ route('home') }}"><i class="fas fa-home"></i>Beranda</a>
				</li>
				<li>
					<a href="{{ route('category.index') }}"><i class="fas fa-list-ul"></i>Kategori</a>
				</li>
				<li>
					<a href="{{ route('all-documents.index') }}"><i class="fas fa-book"></i>Master Dokumen</a>
				</li>
				<li>
					<a href="{{ route('detect.index') }}"><i class="zmdi zmdi-search-in-file"></i>Deteksi Dokumen !</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>
