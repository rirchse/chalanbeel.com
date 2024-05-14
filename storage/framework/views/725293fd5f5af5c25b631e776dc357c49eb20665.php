
<?php $__env->startSection('title', 'Change Admin Password'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">settings</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Update This Admin Password</h4>

    <?php echo Form::model($admin, ['route' => ['admin.change.password', $admin->id], 'method' => 'PUT', 'files' => true]); ?>

        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="user_id" value="<?php echo e($admin->id); ?>">
                
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', $admin->email, ['class' => 'form-control', 'disabled' => 'disabled'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('password', 'New Password', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('confirm_password', 'Confirm New Password', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::password('password_confirmation', ['class' => 'form-control'])); ?>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-rose pull-right">Update Password</button>
        <div class="clearfix"></div>
    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/edit_admin_password.blade.php ENDPATH**/ ?>