<?php $__env->startSection('title', 'Create User Payment'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
        <div class="col-md-6">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img src="<?php echo e($base_url); ?>/images/<?php echo e(($customer->image? $customer->image:'avatar.png')); ?>" class="img">
                </a>
            </div>

            <div class="card-body"><br>
                <h4 class="card-title"><b><?php echo e($customer->first_name.' '.$customer->last_name); ?></b></h4>
                <h6 class="card-category text-gray"></b><?php echo e($customer->contact); ?></b></h6>
                <a class="btn btn-rose btn-round" href="#pablo">details</a>
            </div>
        </div>
    </div>
    </div><!-- end row --> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/user_payment_complete.blade.php ENDPATH**/ ?>