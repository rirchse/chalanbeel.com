<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('partials.styles')

    @yield('stylesheets')

</head>

<body>

	@include('users.header')
		
		<div class="content">
			<div class="container-fluid">

				@yield('content')

			</div><!-- /conteiner-fluid -->
		</div><!-- /content -->

	@include('users.footer')

	<!--   Core JS Files   -->
	@include('partials.scripts')

	@yield('scripts')

	<script type="text/javascript">
		$(document).ready(function() {
			// Javascript method's body can be found in assets/js/demos.js
			demo.initDashboardPageCharts();
			demo.initVectorMap();
		});
	</script>

	<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });
</script>

</body>
</html>