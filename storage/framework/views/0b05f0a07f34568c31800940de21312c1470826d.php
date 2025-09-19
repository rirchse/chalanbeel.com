<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php echo $__env->make('partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('stylesheets'); ?>

</head>

<body>

	<?php echo $__env->make('admins.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<div class="content">
			<div class="container-fluid">

				<?php echo $__env->yieldContent('content'); ?>

			</div><!-- /conteiner-fluid -->
		</div><!-- /content -->

	<?php echo $__env->make('admins.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!--   Core JS Files   -->
	<?php echo $__env->make('partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->yieldContent('scripts'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			// Javascript method's body can be found in assets/js/demos.js
			// demo.initDashboardPageCharts();
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
</html><?php /**PATH /srv/www/cbt/resources/views/admin.blade.php ENDPATH**/ ?>