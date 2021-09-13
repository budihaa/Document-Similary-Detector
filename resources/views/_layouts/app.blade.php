<!DOCTYPE html>
<html lang="en">

<head>
    @include('_includes.head')
    @stack('styles')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        @include('_includes/header_mobile')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
		@include('_includes/sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            @include('_includes/header_desktop')
            <!-- HEADER DESKTOP-->

			<!-- MAIN CONTENT-->
			<div class="main-content">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						@yield('content')
					</div>
				</div>
			</div>
			{{-- footer --}}
			<div class="row">
				<div class="col-md-12">
					<footer class="footer copyright">
						<p>Copyright © {{ date('Y') }} DSD. All rights reserved. Created with <i class="fas fa-heart text-danger"></i> by Budi Haryono</a>.</p>
					</footer>
				</div>
			</div>
			{{-- footer --}}
			<!-- END MAIN CONTENT-->
        </div>
		<!-- END PAGE CONTAINER-->

	</div>

	{{-- Modal --}}
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content"></div>
		</div>
	</div>

    @include('_includes/scripts')
    @stack('scripts')
</body>

</html>
