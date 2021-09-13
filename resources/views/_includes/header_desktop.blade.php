<header class="header-desktop">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="header-wrap">
				<form class="form-header" action="{{ route('searchbox') }}" method="POST" autocomplete="off">
					<input class="au-input au-input--xl" type="text" name="search" placeholder="Cari dokumen hasil deteksi..." />
					<button class="au-btn--submit" type="submit"><i class="zmdi zmdi-search"></i></button>
				</form>
				<div class="header-button">
					<div class="account-wrap">
						<div class="account-item clearfix js-item-menu">
							<div class="image">
								<img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->name }}" />
							</div>
							<div class="content">
								<a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
							</div>
							<div class="account-dropdown js-dropdown">
								<div class="info clearfix">
									<div class="image">
										<a href="#"><img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="Foto {{ Auth::user()->name }}" /></a>
									</div>
									<div class="content">
										<h5 class="name">
											<a href="#">{{ Auth::user()->name }}</a>
										</h5>
										<span class="email">{{ Auth::user()->email }}</span>
									</div>
								</div>
								<div class="account-dropdown__body">
									<div class="account-dropdown__item">
										<a href="#"><i class="zmdi zmdi-account"></i>Account</a>
									</div>
									<div class="account-dropdown__item">
										<a href="#"><i class="zmdi zmdi-settings"></i>Setting</a>
									</div>
								</div>
								<div class="account-dropdown__footer">
									<a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
