<header class="header-mobile d-block d-lg-none">
	<div class="header-mobile__bar">
		<div class="container-fluid">
			<div class="header-mobile-inner">
				<a class="logo" href="index.html">
					<img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin" />
				</a>
				<button class="hamburger hamburger--slider" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<nav class="navbar-mobile">
		<div class="container-fluid">
			<ul class="navbar-mobile__list list-unstyled">
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
		</div>
	</nav>
</header>
