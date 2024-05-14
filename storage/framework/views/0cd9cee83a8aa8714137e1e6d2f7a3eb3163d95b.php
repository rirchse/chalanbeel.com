<?php if(Session::has('success')): ?>

	<div class="alert alert-success col-md-8" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">		
			<strong>Success:</strong> <?php echo Session::get('success'); ?>

			<i class="material-icons alert-i" onclick="this.parentNode.parentNode.style.display = 'none';">clear</i>	
		</div>		
	</div>

<?php endif; ?>

<?php if(Session::has('error')): ?>

	<div class="alert alert-danger col-md-8" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">		
			<strong>Error:</strong> <?php echo Session::get('error'); ?>

			<i class="material-icons alert-i" onclick="this.parentNode.parentNode.style.display = 'none';">clear</i>	
		</div>		
	</div>

<?php endif; ?>

<?php if(count($errors) > 0): ?>

	<div class="alert alert-danger" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">
			<strong>Errors:</strong>
			<ul>
			
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<li><?php echo $error; ?></li>


			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			</ul>
			<span class="pull-right" style="position:absolute; right:0;top:0">
				<i class="material-icons alert-i" onclick="this.parentNode.parentNode.parentNode.style.display = 'none';">clear</i>	
			</span>
		</div>		

	</div>

<?php endif; ?><?php /**PATH /srv/www/cbt/resources/views/partials/messages.blade.php ENDPATH**/ ?>