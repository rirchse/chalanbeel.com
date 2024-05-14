<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php echo $__env->make('partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('stylesheets'); ?>

</head>

<body ng-app="cbTech" style="background:url(/images/bg.jpg) center center">

	<?php echo $__env->make('homes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<?php echo $__env->yieldContent('content'); ?>

	<?php echo $__env->make('homes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!--   Core JS Files   -->
	<?php echo $__env->make('partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->yieldContent('scripts'); ?>

	<script type="text/javascript">
    $().ready(function() {
    	demo.checkFullPageBackgroundImage();
    	setTimeout(function() {
    		// after 1000 ms we add the class animated to the login/register card
    		$('.card').removeClass('card-hidden');
    	}, 700)
    });
  </script>

</body>
</html><?php /**PATH /srv/www/cbt/resources/views/home.blade.php ENDPATH**/ ?>